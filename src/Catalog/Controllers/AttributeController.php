<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Catalog\Requests\AttributeRequest;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class AttributeController extends Controller
{
    /**
     * @var AvoRed\Framework\Database\Repository\AttributeRepository
     */
    protected $attributeRepository;

    /**
     *
     * @param AttributeRepositroy $repository
     */
    public function __construct(
        AttributeModelInterface $repository
    ) {
        $this->attributeRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = $this->attributeRepository->paginate();

        return view('avored::catalog.attribute.index')
        ->with('attributes', $attributes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $displayAsOptions = Attribute::DISPLAY_AS;
        $tabs = Tab::get('catalog.attribute');

        return view('avored::catalog.attribute.create')
            ->with('displayAsOptions', $displayAsOptions)
            ->with('tabs', $tabs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AttributeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeRequest $request)
    {
        $attribute = $this->attributeRepository->create($request->all());
        $this->attributeRepository->saveAttributeDropdownOptions($request, $attribute);

        return redirect(route('admin.attribute.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $tabs = Tab::get('catalog.attribute');

        $displayAsOptions = Attribute::DISPLAY_AS;
        $tabs = Tab::get('catalog.attribute');

        $attribute->load('dropdownOptions');

        return view('avored::catalog.attribute.edit')
            ->with('displayAsOptions', $displayAsOptions)
            ->with('tabs', $tabs)
            ->with('attribute', $attribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AttributeRequest  $request
     * @param Attribute $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->all());
        $this->attributeRepository->saveAttributeDropdownOptions($request, $attribute);

        return redirect(route('admin.attribute.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Attribute $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.attribute')]),
        ]);
    }
}
