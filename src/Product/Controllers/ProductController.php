<?php

namespace AvoRed\Framework\Product\Controllers;

use AvoRed\Framework\Models\Database\AttributeDropdownOption;
use AvoRed\Framework\Models\Database\ProductImage;
use AvoRed\Framework\Models\Database\Property;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Image\Facades\Image;
use AvoRed\Framework\Product\Requests\ProductRequest;
use AvoRed\Framework\Product\DataGrid\ProductDataGrid;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Contracts\ProductDownloadableUrlInterface;
use AvoRed\Framework\System\Controllers\Controller;

class ProductController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ProductRepository
     */
    protected $repository;

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\ProductDownloadableUrlRepository
     */
    protected $downRepository;

    public function __construct(ProductInterface $repository, ProductDownloadableUrlInterface $downRep)
    {
        $this->repository = $repository;
        $this->downRepository = $downRep;
    }

    /**
     * Display a listing of the resource.
     * r.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsBuilder = $this->repository->query()->where('type', '!=', 'VARIABLE_PRODUCT')->orderBy('id', 'desc');
        $productGrid = new ProductDataGrid($productsBuilder);

        return view('avored-framework::product.index')->with('dataGrid', $productGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::product.create');
    }

    /**
     * Store a newly created resource in storage.
     * @todo Change the ProductRequest Validation Rules for Store and Update
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        try {
            $product = Product::create($request->all());
        } catch (\Exception $e) {
            echo 'Error in Saving Product: ', $e->getMessage(), "\n";
        }

        //rather then redirect we just execute Edit Method here.
        // Not sure if this is a good idea???

        return redirect()->route('admin.product.edit', ['id' => $product->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\Product $product
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $attributes = Collection::make([]);

        $properties = Property::all()->pluck('name', 'id');
        $usedForAllProductProperties = Property::whereUseForAllProducts(1)->get();

        if ($product->type == 'VARIATION') {
            $attributes = AttributeDropdownOption::all()->pluck('name', 'id');
        }

        return view('avored-framework::product.edit')
            ->with('model', $product)
            ->with('propertyOptions', $properties)
            ->with('usedForAllProductProperties', $usedForAllProductProperties)
            ->with('attributeOptions', $attributes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\Product\Requests\ProductRequest $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Exception
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            //$product = ProductModel::findorfail($id);
            $product->saveProduct($request->all());

            // verify if has image (for variation cases).
            if ($request->hasFile('image') && $product->type == 'VARIABLE_PRODUCT') {
                $image = $this->repository->uploadImage($request);
                ProductImage::whereProductId($product->id)->delete();
                ProductImage::create(['product_id' => $product->id, 'path' => $image->relativePath, 'is_main_image' => true]);
            }

        } catch (\Exception $e) {
            throw new \Exception('Error in Saving Product: ' . $e->getMessage());
        }

        // I think is better to redirect to edit product.
        if ($product->type !== 'VARIABLE_PRODUCT')
            return redirect()->route('admin.product.edit', ['id' => $product->id]);

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Product::destroy($id);

        return redirect()->route('admin.product.index');
    }

    /**
     * upload image file and re sized it.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadImage(Request $request)
    {
        $this->validate($request, [
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        if ($image = $this->repository->uploadImage($request))
        {
            $tmp = $this->_getTmpString();
            return view('avored-framework::product.upload-image')
                ->with('image', $image)
                ->with('tmp', $tmp);
        }

        return view()->make('Falha ao enviar imagem');
    }

    /**
     * upload image file and resized it.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteImage(Request $request)
    {
        $path = $request->get('path');

        $fileName = pathinfo($path, PATHINFO_BASENAME);
        $relativeDir = pathinfo($path, PATHINFO_DIRNAME);

        $sizes = config('avored-framework.image.sizes');
        foreach ($sizes as $sizeName => $widthHeight) {
            $imagePath = $relativeDir . DIRECTORY_SEPARATOR . $sizeName . '-' . $fileName;

            if (File::exists(storage_path('app/public/' . $imagePath))) {
                File::delete(storage_path('app/public/' . $imagePath));
            }
        }

        if (File::exists(storage_path('app/public/' . $path))) {
            File::delete(storage_path('app/public/' . $path));
        }

        return JsonResponse::create(['success' => true]);
    }

    /**
     * Products Downloadable Main Media Download.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloadMainToken($token)
    {
        $downloadableUrl = $this->downRepository->findByToken($token);
        $path = storage_path('app/public' . DIRECTORY_SEPARATOR . $downloadableUrl->main_path);

        return response()->download($path);
    }

    /**
     * Products Downloadable Main Media Download.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function downloadDemoToken($token)
    {
        $downloadableUrl = $this->downRepository->findByToken($token);
        $path = storage_path('app/public' . DIRECTORY_SEPARATOR . $downloadableUrl->demo_path);

        return response()->download($path);
    }

    /**
     * upload image file and resized it.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function editVariation(Request $request)
    {
        $product = Product::findorfail($request->get('variation_id'));
        $view = view('avored-framework::product.variation-modal')
                            ->with('model', $product);

        return new JsonResponse(['success' => true, 'content' => $view->render(), 'modalId' => '#variation-modal-' . $product->id]);
    }

    /**
     * return random string only lower and without digits.
     *
     * @param int $length
     * @return string $randomString
     */
    public function _getTmpString($length = 6)
    {
        $pool = 'abcdefghijklmnopqrstuvwxyz';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /**
     * return random string only lower and without digits.
     *
     * @param \AvoRed\Framework\Models\Database\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('avored-framework::product.show')
                ->with('product', $product);
    }
}
