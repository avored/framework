<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Catalog\Requests\AttributeRequest;
use AvoRed\Framework\Catalog\Requests\AttributeImageRequest;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;

class AttributeController
{
    /**
     * Attribute Repository for the Attribute Controller.
     * @var \AvoRed\Framework\Database\Repository\AttributeRepository
     */
    protected $attributeRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\AttributeModelInterface $attributeRepository
     */
    public function __construct(
        AttributeModelInterface $attributeRepository
    ) {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $attributes = $this->attributeRepository->all();
        
        return view('avored::catalog.attribute.index')
            ->with(compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('catalog.attribute');
        $displayAsOptions = Attribute::DISPLAY_AS;

        return view('avored::catalog.attribute.create')
            ->with(compact('displayAsOptions', 'tabs'));
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
        $tabs = Tab::get('catalog.attribute');
        $displayAsOptions = Attribute::DISPLAY_AS;

        return view('avored::catalog.attribute.edit')
            ->with(compact('attribute', 'displayAsOptions', 'tabs'));
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
            ),
        ]);
    }

    /**
     * Save Attribute Dropdown options.
     * @param \\AvoRed\Framework\Database\Models\Attribute  $attribute
     * @param \AvoRed\Framework\Catalog\Requests\AttributeRequest $request
     * @return void
     */
    public function saveAttributeDropdownOptions(Attribute $attribute, AttributeRequest $request)
    {
        if ($request->get('dropdown_option') !== null && count($request->get('dropdown_option')) > 0) {
            foreach ($request->get('dropdown_option') as $key => $option) {
                if (empty($option)) {
                    continue;
                }

                $optionModel = $attribute->dropdownOptions()->find($key);

                if ($optionModel === null) {
                    $attribute->dropdownOptions()->create($option);
                } else {
                    $optionModel->update($option);
                }
            }
        }
    }

    /**
     * upload user image to file system.
     * @param \AvoRed\Framework\System\Requests\AdminUserImageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(AttributeImageRequest $request)
    {
        $image = $request->file('dropdown_options_image');
        $path = $image->store('uploads/catalog/attributes', 'public');

        return response()->json([
            'success' => true,
            'path' => $path,
            'message' => __('avored::system.notification.upload', ['attribute' => 'Attribute Image']),
        ]);
    }
}
