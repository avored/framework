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

class ProductController
{
    /**
     * Product Repository for the Product Controller
     * @var \AvoRed\Framework\Database\Repository\ProductRepository $productRepository
     */
    protected $productRepository;

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
     * @param \AvoRed\Framework\Database\Repository\ProductRepository $productRepository
     */
    public function __construct(
        ProductModelInterface $productRepository,
        CategoryModelInterface $categoryRepository,
        PropertyModelInterface $propertyRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->images;

        $typeOptions = Product::PRODUCT_TYPES;
        $categoryOptions = $this->categoryRepository->options();
        $properties = $this->propertyRepository->allPropertyToUseInProduct();

        return view('avored::catalog.product.edit')
            ->with('product', $product)
            ->with('categoryOptions', $categoryOptions)
            ->with('typeOptions', $typeOptions)
            ->with('properties', $properties);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @param \AvoRed\Framework\Database\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $this->saveProductCategory($product, $request);
        $this->saveProductImages($product, $request);
        $this->saveProductProperty($product, $request);
        
        return redirect()->route('admin.product.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::catalog.product.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Product  $product
     * @return \Illuminate\Http\Response
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
     * Save Product Category
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return void
     */
    public function saveProductCategory(Product $product, $request)
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
    public function saveProductProperty($product, $request)
    {
        $propertyIds = Collection::make([]);
        if ($request->get('property') !== null && count($request->get('property')) > 0) {
            foreach ($request->get('property') as $propertyId => $propertyValue) {
                $propertyModel = $this->propertyRepository->find($propertyId);
                $propertyIds->push($propertyId);
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
     * Upload Product Image Meta Data
     * @param \AvoRed\Framework\Database\Models\Product $product
     * @param \AvoRed\Framework\Catalog\Requests\ProductRequest $request
     * @return void
     */
    public function saveProductImages(Product $product, $request)
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
}
