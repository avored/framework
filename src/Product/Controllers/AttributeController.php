<?php

namespace AvoRed\Framework\Product\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Product\DataGrid\AttributeDataGrid;
use AvoRed\Framework\Models\Database\Attribute as Model;
use AvoRed\Framework\Product\Requests\AttributeRequest;
use AvoRed\Framework\Models\Contracts\AttributeInterface;
use AvoRed\Framework\System\Controllers\Controller;

class AttributeController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\AttributeRepository
    */
    protected $repository;

    public function __construct(AttributeInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributeGrid = new AttributeDataGrid($this->repository->query());

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
     * @param \AvoRed\Framework\Product\Requests\AttributeRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttributeRequest $request)
    {
        $attribute = $this->repository->create($request->all());
        $this->_saveDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index');
    }

    /**
     * @param \AvoRed\Framework\Models\Database\Attribute $attribute
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Model $attribute)
    {
        return view('avored-framework::product.attribute.edit')->with('model', $attribute);
    }

    public function update(AttributeRequest $request, Model $attribute)
    {
        $attribute->update($request->all());

        $this->_saveDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index');
    }

    /**
     * @param \AvoRed\Framework\Models\Database\Attribute $attribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Model $attribute)
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
        $attribute = Model::find($request->get('id'));

        return view('avored-framework::product.attribute-card-values')
            ->with('attribute', $attribute);
    }

    /**
     * Get the Element Html in Json Response.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function getElementHtml(Request $request)
    {
        $attributes = $this->repository->findMany($request->get('attribute_id'));

        $tmpString = '__RANDOM__STRING__';
        $view = view('avored-framework::product.get-element')
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
    private function _saveDropdownOptions($attribute, $request)
    {
        if (null !== $request->get('dropdown-options')) {
            if (null != $attribute->attributeDropdownOptions()->get() &&
                $attribute->attributeDropdownOptions()->get()->count() >= 0
                ) {
                $attribute->attributeDropdownOptions()->delete();
            }

            foreach ($request->get('dropdown-options') as $key => $val) {
                if ($key == '__RANDOM_STRING__') {
                    continue;
                }

                $attribute->attributeDropdownOptions()->create($val);
            }
        }
    }
}
