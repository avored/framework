<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Catalog\Requests\PropertyRequest;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use Illuminate\Http\Request;

class PropertyController
{
    /**
     * Property Repository for the Property Controller.
     * @var \AvoRed\Framework\Database\Repository\PropertyRepository
     */
    protected $propertyRepository;

    /**
     * Construct for the AvoRed property controller.
     * @param \AvoRed\Framework\Database\Contracts\PropertyModelInterface $propertyRepository
     */
    public function __construct(
        PropertyModelInterface $propertyRepository
    ) {
        $this->propertyRepository = $propertyRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $properties = $this->propertyRepository->paginate();

        return view('avored::catalog.property.index')
            ->with(compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('catalog.property');
        $dataTypeOptions = Property::PROPERTY_DATATYPES;
        $fieldTypeOptions = Property::PROPERTY_FIELDTYPES;

        return view('avored::catalog.property.create')
            ->with(compact('dataTypeOptions', 'fieldTypeOptions', 'tabs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\PropertyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PropertyRequest $request)
    {
        $property = $this->propertyRepository->create($request->all());
        $this->savePropertyDropdownOptions($property, $request);

        return redirect()->route('admin.property.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::catalog.property.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Property $property
     * @return \Illuminate\View\View
     */
    public function edit(Property $property)
    {
        if ($property->field_type === 'SELECT' || $property->field_type === 'RADIO') {
            $property->load('dropdownOptions');
        }
        
        $tabs = Tab::get('catalog.property');
        $dataTypeOptions = Property::PROPERTY_DATATYPES;
        $fieldTypeOptions = Property::PROPERTY_FIELDTYPES;

        return view('avored::catalog.property.edit')
            ->with(compact('property', 'dataTypeOptions', 'fieldTypeOptions', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\PropertyRequest $request
     * @param \AvoRed\Framework\Database\Models\Property  $property
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PropertyRequest $request, Property $property)
    {
        $property->update($request->all());
        $this->savePropertyDropdownOptions($property, $request);

        return redirect()->route('admin.property.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::catalog.property.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Property  $property
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Property $property)
    {
        $property->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::catalog.property.title')]
            ),
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
        if (! ($request->get('field_type') === 'RADIO' || $request->get('field_type') === 'SELECT')) {
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

    
    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->propertyRepository->filter($request->get('filter'));
    }
}
