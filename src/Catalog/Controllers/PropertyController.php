<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Catalog\Requests\PropertyRequest;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PropertyController extends Controller
{
    /**
     * @var PropertyRepository $propertyRepository
     */
    protected $propertyRepository;
    /**
     *
     * @param PropertyRepositroy $repository
     */
    public function __construct(
        PropertyModelInterface $repository
    ) {
        $this->propertyRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = $this->propertyRepository->paginate();

        return view('avored::catalog.property.index')
        ->with('properties', $properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataTypeOptions = Property::PROPERTY_DATATYPES;
        $fieldTypeOptions = Property::PROPERTY_FIELDTYPES;
        $tabs = Tab::get('catalog.property');

        return view('avored::catalog.property.create')
            ->with('dataTypeOptions', $dataTypeOptions)
            ->with('fieldTypeOptions', $fieldTypeOptions)
            ->with('tabs', $tabs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PropertyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $property = $this->propertyRepository->create($request->all());
        $this->propertyRepository->savePropertyDropdown($request, $property);

        return redirect(route('admin.property.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit(Property $property)
    {
        $tabs = Tab::get('catalog.property');

        $dataTypeOptions = Property::PROPERTY_DATATYPES;
        $fieldTypeOptions = Property::PROPERTY_FIELDTYPES;
        $tabs = Tab::get('catalog.property');

        $property->load('dropdownOptions');

        return view('avored::catalog.property.edit')
            ->with('dataTypeOptions', $dataTypeOptions)
            ->with('fieldTypeOptions', $fieldTypeOptions)
            ->with('tabs', $tabs)
            ->with('property', $property);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PropertyRequest  $request
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());
        $this->propertyRepository->savePropertyDropdown($request, $property);
        return redirect(route('admin.property.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Property $property
     * @return \Illuminate\Http\Response
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.property')])
        ]);
    }
}
