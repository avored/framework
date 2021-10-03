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
        $this->savePropertyDropdownOptions($property, $request);

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

        $this->savePropertyDropdownOptions($property, $request);

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


    /**
     * Save Property Dropdown options.
     * @param \\AvoRed\Framework\Database\Models\Property  $property
     * @param \AvoRed\Framework\Catalog\Requests\PropertyRequest $request
     * @return void
     */
    private function savePropertyDropdownOptions(Property $property, PropertyRequest $request)
    {
        if (($request->get('field_type') === 'RADIO' || $request->get('field_type') === 'SELECT')) {
            $property->dropdownOptions()->delete();
        }
        if (($request->get('field_type') === 'RADIO' ||
            $request->get('field_type') === 'SELECT') &&
            count($request->get('dropdown_option')) > 0
        ) {
            foreach ($request->get('dropdown_option') as $key => $option) {
                if (empty($option)) {
                    continue;
                }

                if (is_string($key)) {
                    $property->dropdownOptions()->create(['display_text' => $option]);
                } else {
                    $optionModel = $property->dropdownOptions()->find($key);
                    $optionModel->update(['display_text' => $option]);
                }
            }
        }
    }
}
