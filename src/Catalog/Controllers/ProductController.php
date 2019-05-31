<?php
namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Catalog\Requests\ProductRequest;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;

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
        dd($request->all());
        $product->update($request->all());
        $this->saveProductCategory($product, $request);
        
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
    public function saveProductCategory($product, $request)
    {
        if ($request->get('category') !== null && count($request->get('category')) > 0) {
            $product->categories()->sync($request->get('category'));
        }
    }
}
