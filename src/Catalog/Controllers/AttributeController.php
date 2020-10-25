<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Catalog\Requests\AttributeRequest;
use AvoRed\Framework\Catalog\Requests\AttributeImageRequest;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use Illuminate\Http\Request;

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
        $attributes = $this->attributeRepository->paginate();
        
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
        if ($request->get('dropdown_options') !== null && count($request->get('dropdown_options')) > 0) {
            $attribute->dropdownOptions()->delete();
            foreach ($request->get('dropdown_options') as $key => $option) {
                if (empty($option['display_text'])) {
                    continue;
                }
                
                // $optionModel = $attribute->dropdownOptions()->find($key);

                // if ($optionModel === null) {
                $attribute->dropdownOptions()->create($option);
                // } else {
                //     $optionModel->update($option);
                // }
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
        $files = $request->file('files');
        // foreach ($files as $file) {
        $path = $files->store('uploads/catalog/attributes', 'avored');
        // }

        
        return response()->json([
            'success' => true,
            'path' => $path,
            'message' => __('avored::system.notification.upload', ['attribute' => 'Attribute Image']),
        ]);
    }

    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->attributeRepository->filter($request->get('filter'));
    }
}
