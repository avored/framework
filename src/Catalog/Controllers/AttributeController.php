<?php
namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Catalog\Requests\AttributeRequest;

class AttributeController
{
    /**
     * Attribute Repository for the Attribute Controller
     * @var \AvoRed\Framework\Database\Repository\AttributeRepository $attributeRepository
     */
    protected $attributeRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\AttributeRepository $attributeRepository
     */
    public function __construct(
        AttributeModelInterface $attributeRepository
    ) {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $properties = $this->attributeRepository->all();

        return view('avored::catalog.attribute.index')
            ->with('properties', $properties);
    }

     /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('avored::catalog.attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\AttributeRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AttributeRequest $request)
    {
        $attribute = $this->attributeRepository->create($request->all());
        $this->saveAttributeDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::catalog.attribute.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Attribute $attribute
     * @return \Illuminate\View\View
     */
    public function edit(Attribute $attribute)
    {
        return view('avored::catalog.attribute.edit')
            ->with('attribute', $attribute);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\AttributeRequest $request
     * @param \AvoRed\Framework\Database\Models\Attribute  $attribute
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {
        $attribute->update($request->all());
        $this->saveAttributeDropdownOptions($attribute, $request);

        return redirect()->route('admin.attribute.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::catalog.attribute.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Attribute  $attribute
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::catalog.attribute.title')]
            )
        ]);
    }

    /**
     * Save Attribute Dropdown options
     * @param \\AvoRed\Framework\Database\Models\Attribute  $attribute
     * @param \AvoRed\Framework\Catalog\Requests\AttributeRequest $request
     * @return void
     */
    public function saveAttributeDropdownOptions(Attribute $property, AttributeRequest $request)
    {
        if ($request->get('dropdown_option') !== null && count($request->get('dropdown_option')) > 0) {
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
