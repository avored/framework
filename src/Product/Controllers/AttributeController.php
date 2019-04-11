<?php

namespace AvoRed\Framework\Product\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Product\DataGrid\AttributeDataGrid;
use AvoRed\Framework\Models\Database\Attribute;
use AvoRed\Framework\Product\Requests\AttributeRequest;
use AvoRed\Framework\Models\Contracts\AttributeInterface;
use AvoRed\Framework\System\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Database\AttributeDropdownOptionTranslation;

class AttributeController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\AttributeRepository
     */
    protected $attributeRepository;

    public function __construct(AttributeInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeGrid = new AttributeDataGrid($this->attributeRepository->query());

        return view('avored-framework::product.attribute.index')
            ->with('dataGrid', $attributeGrid->dataGrid);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::product.attribute.create');
    }

    /**
     * Store an Atttibute into Database and Redirect to List Route
     *
     * @param \AvoRed\Framework\Product\Requests\AttributeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttributeRequest $request)
    {
        $attribute = $this->attributeRepository->create($request->all());
        $this->saveDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index');
    }

    /**
     * @param \AvoRed\Framework\Models\Database\Attribute $attribute
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Attribute $attribute)
    {
        return view('avored-framework::product.attribute.edit')
            ->with('attribute', $attribute);
    }

    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $this->attributeRepository->update($attribute, $request->all());
        $this->saveDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index');
    }

    /**
     * @param \AvoRed\Framework\Models\Database\Attribute $attribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        return redirect()->route('admin.attribute.index');
    }

    /**
     * Get an attribute for Product Variation Modal.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function getAttribute(Request $request)
    {
        $attribute = $this->attributeRepository->find($request->get('id'));

        return view('avored-framework::product.attribute-card-values')
            ->with('attribute', $attribute);
    }

    /**
     * Get the Element Html in Json Response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getElementHtml(Request $request)
    {
        $attributes = $this->attributeRepository
            ->findMany($request->get('attribute_id'));

        $tmpString = '__RANDOM__STRING__';
        $view = view('avored-framework::product.attribute.get-element')
            ->with('attributes', $attributes)
            ->with('tmpString', $tmpString);

        return new JsonResponse(['success' => true, 'content' => $view->render()]);
    }

    /**
     * Save Attribute Drop down Options.
     *
     * @param \AvoRed\Framework\Models\Database\Attribute $attribute
     * @param \AvoRed\Framework\Product\Requests\AttributeRequest $request
     * @return void
     */
    protected function saveDropdownOptions($attribute, $request)
    {
        $this->attributeRepository->syncDropdownOptions($attribute, $request->all());
    }

    /**
     * Find a Record and Returns a Json Resrouce for that Record
     *
     * @param \AvoRed\Framework\Models\Database\Attribute $attribute
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function show(Attribute $attribute)
    {
        return view('avored-framework::product.attribute.show')
                    ->with('attribute', $attribute);
    }
}
