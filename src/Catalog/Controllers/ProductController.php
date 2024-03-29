<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Catalog\Requests\ProductRequest;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\ProductModelInterface;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use AvoRed\Framework\Database\Models\Document;
use AvoRed\Framework\Database\Models\Product;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{

    /**
     * @var AvoRed\Framework\Database\Repository\ProductRepository $productRepository
     */
    protected $productRepository;

    /**
     * @var AvoRed\Framework\Database\Repository\CategoryRepository $categoryRepository
     */
    protected $categoryRepository;

    /**
     * @var AvoRed\Framework\Database\Repository\PropertyRepository $propertyRepository
     */
    protected $propertyRepository;

    /**
     *
     * @param ProductRepositroy $repository
     * @param CategoryRepositroy $categoryRepository
     * @param PropertyRepositroy $propertyRepository
     */
    public function __construct(
        ProductModelInterface $repository,
        CategoryModelInterface $categoryRepository,
        PropertyModelInterface $propertyRepository
    ) {
        $this->productRepository = $repository;
        $this->categoryRepository = $categoryRepository;
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->paginate();

        return view('avored::catalog.product.index')
        ->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typeOptions = Product::PRODUCT_TYPES;
        $options = $this->categoryRepository->options();
        $tabs = Tab::get('catalog.product');

        return view('avored::catalog.product.create')
            ->with('typeOptions', $typeOptions)
            ->with('tabs', $tabs)
            ->with('options', $options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->create($request->all());
        // $this->productRepository->saveProductDropdownOptions($request, $product);

        return redirect(route('admin.product.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $tabs = Tab::get('catalog.product');
        $options = $this->categoryRepository->options();
        $productProperties = $this->propertyRepository->getAllProductProperties();
        
        // $displayAsOptions = Product::DISPLAY_AS;
        $tabs = Tab::get('catalog.product');


        return view('avored::catalog.product.edit')
            // ->with('displayAsOptions', $displayAsOptions)
            ->with('tabs', $tabs)
            ->with('options', $options)
            ->with('productProperties', $productProperties)
            ->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest  $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());
        $this->productRepository->saveProductCategories($product, $request);

        dd($request->all());
        return redirect(route('admin.product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['product' => __('avored::system.product')])
        ]);
    }

    /**
     * Upload a product image.
     *
     * @param Product $product
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function uploadDocument(Product $product, Request $request)
    {
        $image = $request->file('image');
       
        $path = $image->store('uploads/catalog', 'public');
        $product->documents()->create([
            'path' => $path,
            'mime_type' => $image->getClientMimeType(),
            'size' => $image->getSize(),
            'origional_name' => $image->getClientOriginalName(),
        ]);
        

        return new JsonResponse([
            'success' => true,
            'data' => $product->documents,
            'message' => __('avored::system.product_success_upload_message', ['product' => __('avored::system.product')])
        ]);
    }

    /**
     * Delete a product image.
     *
     * @param Product $product
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function deleteDocument(Document $document)
    {
        $product = $document->documentable;
        $document->delete();

        return new JsonResponse([
            'success' => true,
            'data' => $product->documents,
            'message' => __('avored::system.product_success_delete_message', ['product' => __('avored::system.product')])
        ]);
    }
}
