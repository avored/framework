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
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Contracts\ProductModelInterface $productRepository
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $categoryRepository
     * @param \AvoRed\Framework\Database\Contracts\PropertyModelInterface $propertyRepository
     * @param \AvoRed\Framework\Database\Contracts\CategoryFilterModelInterface $categoryFilterRepository
     */
    public function __construct(
        ProductModelInterface $productRepository,
        CategoryModelInterface $categoryRepository,
        PropertyModelInterface $propertyRepository,
        CategoryFilterModelInterface $categoryFilterRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->propertyRepository = $propertyRepository;
        $this->categoryFilterRepository = $categoryFilterRepository;
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

        return view('avored::catalog.product.edit')
            ->with('product', $product)
            ->with('categoryOptions', $categoryOptions)
            ->with('typeOptions', $typeOptions)
            ->with('properties', $properties)
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
}
