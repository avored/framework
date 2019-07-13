<?php
namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Catalog\Requests\ProductRequest;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use Illuminate\Support\Collection;
use AvoRed\Framework\Catalog\Requests\ProductImageRequest;
use AvoRed\Framework\Database\Models\ProductImage;
use Illuminate\Support\Facades\File;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface;
use AvoRed\Framework\Database\Models\CategoryFilter;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController
{
    /**
     * Product Repository for the Product Controller
     * @var \AvoRed\Framework\Database\Repository\ProductRepository $productRepository
     */
    protected $productRepository;

    /**
     * CategoryFilter Repository for the Product Controller
     * @var \AvoRed\Framework\Database\Repository\CategoryFilterRepository $categoryFilterRepository
     */
    protected $categoryFilterRepository;

    /**
     * Category Repository for the Product Controller
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository $categoryRepository
     */
    protected $categoryRepository;

    /**
     * Property Repository for the Product Controller
     * @var \AvoRed\Framework\Database\Repository\PropertyRepository $propertyRepository
     */
    protected $propertyRepository;

    /**
     * Attribute Repository for the Product Controller
     * @var \AvoRed\Framework\Database\Repository\AttributeRepository $attributeRepository
     */
    protected $attributeRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Contracts\ProductModelInterface $productRepository
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $categoryRepository
     * @param \AvoRed\Framework\Database\Contracts\PropertyModelInterface $propertyRepository
     * @param \AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface $categoryFilterRepository
     * @param \AvoRed\Framework\Database\Contracts\AttributeModelInterface $attributeRepository
     */
    public function __construct(
        ProductModelInterface $productRepository,
        CategoryModelInterface $categoryRepository,
        PropertyModelInterface $propertyRepository,
        CategoryFilterModelInterface $categoryFilterRepository,
        AttributeModelInterface $attributeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->propertyRepository = $propertyRepository;
        $this->categoryFilterRepository = $categoryFilterRepository;
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = $this->productRepository->all();

        return view('avored::catalog.product.index')
            ->with('products', $products);
    }

     /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeOptions = Product::PRODUCT_TYPES;
        return view('avored::catalog.product.create')
            ->with('typeOptions', $typeOptions);
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Contracts\Support\Renderable
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
            ->with('product', $product)
            ->with('categoryOptions', $categoryOptions)
            ->with('typeOptions', $typeOptions)
            ->with('properties', $properties)
            ->with('attributes', $attributes)
            ->with('tabs', $tabs);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @param \AvoRed\Framework\Database\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return [
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::catalog.product.title')]
            )
        ];
    }

    /**
     * Upload Product Images
     * @param \AvoRed\Framework\Catalog\Requests\ProductImageRequest $request
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(ProductImageRequest $request, Product $product)
    {
        $image = $request->file('file');
        $dbPath = $image->storePublicly('uploads/catalog/' . $product->id, 'public');

        if ($product->images === null || $product->images->count() === 0) {
            $imageModel = $product->images()->create(
                ['path' => $dbPath,
                'is_main_image' => 1]
            );
        } else {
            $imageModel = $product->images()->create(['path' => $dbPath]);
        }
        return response()->json(['image' => $imageModel]);
    }

    /**
     * Create Product Variation based on given Attributes
     * @param \Illuminate\Http\Request $request
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function createVariation(Request $request, Product $product)
    {
        $this->createProductVariation($product, $request);
       
        return response()->json(['success' => true]);
    }

    /**
     * Destroy Product Images
     * @param \AvoRed\Framework\Database\Models\ProductImage $productImage
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyImage(ProductImage $productImage)
    {
        $filePath = storage_path('app/public/' . $productImage->path);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
        $productImage->delete();
        return response()->json(['success' => true]);
    }
    
    /**
     * Save Product Category
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
     * Save Product Property
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return void
     */
    private function saveProductProperty($product, $request)
    {
        $propertyIds = Collection::make([]);
        if ($request->get('property') !== null && count($request->get('property')) > 0) {
            foreach ($request->get('property') as $propertyId => $propertyValue) {
                $propertyModel = $this->propertyRepository->find($propertyId);
                $propertyIds->push($propertyId);
                $this->attachePropertyWithCategories($propertyModel, $product);
               
                switch ($propertyModel->field_type) {
                    case 'SELECT':
                    case 'RADIO':
                        $propertyModel->saveIntegerProperty($product, $propertyValue);
                        break;

                    case 'SWITCH':
                        $propertyModel->saveBooleanProperty($product, $propertyValue);
                        break;

                    case 'DATETIME':
                        $propertyModel->saveDatetimeProperty()($product, $propertyValue);
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
     * Upload Product Image Meta Data
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return void
     */
    private function saveProductImages(Product $product, $request)
    {
        $images = $request->get('images');
        $isMainImage = $request->get('is_main_image');
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

    /**
     * Attach Given Property Model to a Product Categories
     * @param \AvoRed\Framework\Database\Models\Property $property
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @return void
     */
    private function attachePropertyWithCategories(Property $property, Product $product)
    {
        if ($product->categories !== null && $product->categories->count() > 0) {
            foreach ($product->categories as $category) {
                $data = [
                    'category_id' => $category->id,
                    'filter_id' => $property->id,
                    'type' => CategoryFilter::PROPERTY_FILTER_TYPE
                ];
                $this->categoryFilterRepository->create($data);
            }
        }
    }

    /**
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    private function createProductVariation($product, $request)
    {
        $variations = $this->getVariationsCollection($product, $request);

        //Store Product Attribute Values
        //Create Variable Profile
        // Store PRoduct and Variation Product IdS

        dd($variations);
    }

    /**
     * Get the Attribute Model from Request
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \Illuminate\Http\Request $request
     * @return array $variations
     */
    private function getVariationsCollection($product, $request)
    {
        $attributeOptions = Collection::make([]);
        $variations = Collection::make([]);
        if ($request->get('attributes') !== null && count($request->get('attributes')) > 0) {
            foreach ($request->get('attributes') as $attributeId) {
                $attributeModel = $this->attributeRepository->find($attributeId);
                $attributeOptions->push($attributeModel->dropdownOptions->pluck('id'));
            }
            $product->attributes()->sync($request->get('attributes'));
        }

        return $this->makeCombinations($attributeOptions->toArray());
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
    private function makeCombinations(array $data, array &$all = array(), array $group = array(), $value = null, $i = 0)
    {
        $keys = array_keys($data);

        if (isset($value) === true) {
            array_push($group, $value);
        }

        if ($i >= count($data)) {
            array_push($all, $group);
        } else {
            $currentKey     = $keys[$i];
            $currentElement = $data[$currentKey];
            foreach ($currentElement as $val) {
                $this->makeCombinations($data, $all, $group, $val, $i + 1);
            }
        }

        return $all;
    }
}
