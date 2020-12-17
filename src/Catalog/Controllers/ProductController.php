<?php

namespace AvoRed\Framework\Catalog\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Database\Models\ProductImage;
use AvoRed\Framework\Database\Models\CategoryFilter;
use AvoRed\Framework\Catalog\Requests\ProductRequest;
use AvoRed\Framework\Catalog\Requests\ProductImageRequest;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface;
use AvoRed\Framework\Database\Contracts\AttributeDropdownOptionModelInterface;

class ProductController
{
    /**
     * Product Repository for the Product Controller.
     * @var \AvoRed\Framework\Database\Repository\ProductRepository
     */
    protected $productRepository;

    /**
     * CategoryFilter Repository for the Product Controller.
     * @var \AvoRed\Framework\Database\Repository\CategoryFilterRepository
     */
    protected $categoryFilterRepository;

    /**
     * Category Repository for the Product Controller.
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Property Repository for the Product Controller.
     * @var \AvoRed\Framework\Database\Repository\PropertyRepository
     */
    protected $propertyRepository;

    /**
     * Attribute Repository for the Product Controller.
     * @var \AvoRed\Framework\Database\Repository\AttributeRepository
     */
    protected $attributeRepository;

    /**
     * Attribute product value repository for the product controller.
     * @var \AvoRed\Framework\Database\Repository\AttributeProductValueRepository
     */
    protected $attributeProductValueRepository;

    /**
     * Attribute product value repository for the product controller.
     * @var \AvoRed\Framework\Database\Repository\AttributeDropdownOptionModelInterface
     */
    protected $attributeDropdownOptionRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\ProductModelInterface $productRepository
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $categoryRepository
     * @param \AvoRed\Framework\Database\Contracts\PropertyModelInterface $propertyRepository
     * @param \AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface $categoryFilterRepository
     * @param \AvoRed\Framework\Database\Contracts\AttributeModelInterface $attributeRepository
     * @param \AvoRed\Framework\Database\Contracts\AttributeProductValueModelInterface $attributeProductValueRepository
     * @param \AvoRed\Framework\Database\Contracts\AttributeDropdownOptionModelInterface $attributeDropdownOptionRepository
     */
    public function __construct(
        ProductModelInterface $productRepository,
        CategoryModelInterface $categoryRepository,
        PropertyModelInterface $propertyRepository,
        CategoryFilterModelInterface $categoryFilterRepository,
        AttributeModelInterface $attributeRepository,
        AttributeProductValueModelInterface $attributeProductValueRepository,
        AttributeDropdownOptionModelInterface $attributeDropdownOptionRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->propertyRepository = $propertyRepository;
        $this->categoryFilterRepository = $categoryFilterRepository;
        $this->attributeRepository = $attributeRepository;
        $this->attributeProductValueRepository = $attributeProductValueRepository;
        $this->attributeDropdownOptionRepository = $attributeDropdownOptionRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = $this->productRepository->getAllWithoutVaiation();

        return view('avored::catalog.product.index')
            ->with(compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $typeOptions = Product::PRODUCT_TYPES;

        return view('avored::catalog.product.create')
            ->with(compact('typeOptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->create($request->all());

        return redirect()->route('admin.product.edit', ['product' => $product->id])
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::catalog.product.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $tabs = Tab::get('catalog.product');

        $product->images;

        $typeOptions = Product::PRODUCT_TYPES;
        $categoryOptions = $this->categoryRepository->options();
        $properties = $this->propertyRepository->allPropertyToUseInProduct();
        $attributes = $this->attributeRepository->all();

        return view('avored::catalog.product.edit')
            ->with(compact('product', 'categoryOptions', 'typeOptions', 'properties', 'attributes', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @param \AvoRed\Framework\Database\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        // dd($request->all());
        $product->update($request->all());
        $this->saveProductCategory($product, $request);
        $this->saveProductImages($product, $request);
        $this->saveProductProperty($product, $request);

        return redirect()
            ->route('admin.product.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::catalog.product.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        if ($product->type === 'VARIABLE_PRODUCT') {
            $varitions = $product->attributeProductValues->pluck('variation_id');

            foreach ($varitions as $varitionId) {
                dd($varitionId);
                $variableProduct = $this->productRepository->find($varitionId);
                if ($variableProduct !== null) {
                    $variableProduct->delete();
                }
            }
        }
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::catalog.product.title')]
            ),
        ]);
    }

    /**
     * Upload Product Images.
     * @param \AvoRed\Framework\Catalog\Requests\ProductImageRequest $request
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(ProductImageRequest $request, Product $product)
    {
        $image = $request->file('files');
        $dbPath = $image->store('uploads/catalog/'.$product->id, 'avored');

        if ($product->images === null || $product->images->count() === 0) {
            $imageModel = $product->images()->create(
                ['path' => $dbPath,
                'is_main_image' => 1, ]
            );
        } else {
            $imageModel = $product->images()->create(['path' => $dbPath]);
        }

        return response()->json([
            'success' => true,
            'image_model' => $imageModel,
            'message' => __('avored::user.notification.upload', ['attribute' => 'Image']),
        ]);
        
        // return response()->json(['image' => $imageModel]);
    }

    /**
     * @todo possibly can use update method instead of this one.
     * Save Product Variation based on given Attributes
     * @param \Illuminate\Http\Request $request
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveVariation(Request $request, Product $product)
    {
        $productModel = $this->productRepository->find($request->get('id'));
        $productModel->update($request->all());

        return response()->json(['success' => true, 'message' => __('avored::catalog.product.variation_save_msg')]);
    }

    /**
     * Delete Product Variation based on given Attributes.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyVariation(Product $product)
    {
        $product->delete();

        return response()->json(['success' => true, 'message' => __('avored::catalog.product.variation_delete_msg')]);
    }

    /**
     * Destroy Product Images.
     * @param \AvoRed\Framework\Database\Models\ProductImage $productImage
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyImage(ProductImage $productImage)
    {
        $filePath = storage_path('app/public/'.$productImage->path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $productImage->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Create Product Variation based on given Attributes.
     * @param \Illuminate\Http\Request $request
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function createVariation(Request $request, Product $product)
    {
        DB::transaction(function () use ($product, $request) {
            $this->makeProductVariation($product, $request);
        });

        return response()
            ->json(['success' => true, 'message' => __('avored::catalog.product.variation_create_msg')]);
    }

    /**
     * Save Product Category.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return void
     */
    private function saveProductCategory(Product $product, $request)
    {
        if ($request->get('category') !== null && count($request->get('category')) > 0) {
            $product->categories()->sync($request->get('category'));
        }
    }

    /**
     * Save Product Property.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return void
     */
    private function saveProductProperty($product, $request)
    {
        $propertyIds = Collection::make([]);
        if ($request->get('property') !== null && count($request->get('property')) > 0) {
            foreach ($request->get('property') as $propertyId => $propertyValue) {
                if ($propertyValue === null) {
                    continue;
                }
                $propertyModel = $this->propertyRepository->find($propertyId);
                $propertyIds->push($propertyId);
                //var_dump($propertyId);
                $this->attachePropertyWithCategories($propertyModel, $product);

                switch ($propertyModel->field_type) {
                    case 'SELECT':
                    case 'RADIO':
                        $propertyModel->saveIntegerProperty($product, $propertyId);
                        break;

                    case 'SWITCH':
                        $propertyModel->saveBooleanProperty($product, $propertyValue);
                        break;

                    case 'DATETIME':
                        $propertyModel->saveDatetimeProperty($product, $propertyValue);
                        break;

                    case 'TEXT':
                        $propertyModel->saveVarcharProperty($product, $propertyValue);
                        break;

                    case 'TEXTAREA':
                        $propertyModel->saveTextProperty($product, $propertyValue);
                        break;

                    default:
                        throw new \Exception('there is an error while saving an product properties');
                }
            }

            $product->properties()->sync($propertyIds);
        }
    }

    /**
     * Upload Product Image Meta Data.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return void
     */
    private function saveProductImages(Product $product, $request)
    {
        $images = $request->get('images');
        $isMainImage = $request->get('is_main_image');

        if ($images !== null && count($images) > 0) {
            foreach ($images as $id => $data) {
                $imageModel = $product->images()->find($id);
                $imageModel->alt_text = $data['alt_text'] ?? '';
                if ($isMainImage == $imageModel->id) {
                    $imageModel->is_main_image = 1;
                } else {
                    $imageModel->is_main_image = 0;
                }
                $imageModel->save();
            }
        }
    }

    /**
     * Attach Given Property Model to a Product Categories.
     * @param \AvoRed\Framework\Database\Models\Attribute $attribute
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return void
     */
    private function attacheAttributeWithCategories(Attribute $attribute, Product $product)
    {
        if ($product->categories !== null && $product->categories->count() > 0) {
            foreach ($product->categories as $category) {
                $categoryFilterFlag = $this->categoryFilterRepository->isCategoryFilterModelExist(
                    $category->id,
                    $attribute->id,
                    CategoryFilter::ATTRIBUTE_FILTER_TYPE
                );
                if (! $categoryFilterFlag) {
                    $data = [
                        'category_id' => $category->id,
                        'filter_id' => $attribute->id,
                        'type' => CategoryFilter::ATTRIBUTE_FILTER_TYPE,
                    ];
                    $this->categoryFilterRepository->create($data);
                }
            }
        }
    }

    /**
     * Attach Given Property Model to a Product Categories.
     * @param \AvoRed\Framework\Database\Models\Property $property
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return void
     */
    private function attachePropertyWithCategories(Property $property, Product $product)
    {
        if ($product->categories !== null && $product->categories->count() > 0) {
            foreach ($product->categories as $category) {
                $categoryFilterFlag = $this->categoryFilterRepository->isCategoryFilterModelExist(
                    $category->id,
                    $property->id,
                    CategoryFilter::PROPERTY_FILTER_TYPE
                );
                if (! $categoryFilterFlag) {
                    $data = [
                        'category_id' => $category->id,
                        'filter_id' => $property->id,
                        'type' => CategoryFilter::PROPERTY_FILTER_TYPE,
                    ];
                    $this->categoryFilterRepository->create($data);
                }
            }
        }
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \Illuminate\Support\Collection $variations
     * @return void
     */
    private function createProductVariations($product, $variations)
    {
        $variationIds = $product->attributeProductValues->pluck('variation_id');

        foreach ($variationIds as $variationId) {
            $this->productRepository->delete($variationId);
        }

        foreach ($variations as $variation) {
            $this->generateProductData($product, $variation);
        }
    }

    /**
     * Generate Product Data based on given variation id.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param array $options
     * @return array $data
     */
    private function generateProductData($product, $options)
    {
        $data = [
            'name' => $product->name,
            'type' => 'VARIATION',
            'qty' => $product->qty,
            'price' => $product->price,
            'cost_price' => $product->cost_price,
            'weight' => $product->weight,
            'height' => $product->height,
            'width' => $product->width,
            'length' => $product->length,
        ];

        foreach ($options as $optionId) {
            $optionModel = $this->attributeDropdownOptionRepository->find($optionId);
            $data['name'] .= ' '.$optionModel->display_text;
        }
        $data['sku'] = Str::slug($data['name']);
        $data['slug'] = Str::slug($data['name']);

        $variation = $this->productRepository->create($data);
        $attributeId = $optionModel->attribute->id;
        $this->saveAttributeProductValue($product, $options, $variation);
    }

    /**
     * Get the Attribute Model from Request.
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function makeProductVariation($product, $request)
    {
        $attributeOptions = Collection::make([]);
        if (array_unique($request->get('attributes')) !== null && count(array_unique($request->get('attributes'))) > 0) {
            foreach (array_unique($request->get('attributes')) as $attributeId) {
                /** @var \AvoRed\Framework\Database\Models\Attribute $attributeModel */
                $attributeModel = $this->attributeRepository->find($attributeId);

                $this->attacheAttributeWithCategories($attributeModel, $product);
                $optionIds = $attributeModel->dropdownOptions->pluck('id');
                $attributeOptions->push($optionIds);
            }
            $product->attributes()->sync($request->get('attributes'));
        }

        $combinations = $this->makeCombinations($attributeOptions->toArray());
        $this->createProductVariations($product, $combinations);
    }

    /**
     * Store attribute product values into database.
     * @param Product $product
     * @param Collection $attributeOptionIds
     * @param \AvoRed\Framework\Database\Models\Product $variation
     * @return void
     */
    private function saveAttributeProductValue($product, $attributeOptionIds, $variation)
    {
        foreach ($attributeOptionIds as $optionId) {
            $optionModel = $this->attributeDropdownOptionRepository->find($optionId);
            $model = $this->attributeProductValueRepository->findByAttributeProductValues(
                $product->id,
                $optionModel->attribute->id,
                $optionId,
                $variation->id
            );

            if ($model === null) {
                $data = [
                    'product_id' => $product->id,
                    'attribute_id' => $optionModel->attribute->id,
                    'attribute_dropdown_option_id' => $optionId,
                    'variation_id' => $variation->id,
                ];
                $this->attributeProductValueRepository->create($data);
            }
        }
    }

    /**
     * Generate all the possible combinations among a set of nested arrays.
     *
     * @param array $data  The entrypoint array container.
     * @param array $all   The final container (used internally).
     * @param array $group The sub container (used internally).
     * @param mixed $val   The value to append (used internally).
     * @param int   $i     The key index (used internally).
     */
    private function makeCombinations(array $data, array &$all = [], array $group = [], $value = null, $i = 0)
    {
        $keys = array_keys($data);

        if (isset($value) === true) {
            array_push($group, $value);
        }

        if ($i >= count($data)) {
            array_push($all, $group);
        } else {
            $currentKey = $keys[$i];
            $currentElement = $data[$currentKey];
            foreach ($currentElement as $val) {
                $this->makeCombinations($data, $all, $group, $val, $i + 1);
            }
        }

        return $all;
    }

    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->productRepository->filter($request->get('filter'));
    }
}
