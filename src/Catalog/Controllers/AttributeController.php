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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 10;
        if ($request->get('filter')) {
            $attributes = $this->attributeRepository->filter($request->get('filter'));
        } else {
            $attributes = $this->attributeRepository->paginate($perPage);
        }

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
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        Attribute::destroy($id);

        return redirect()->route('admin.attribute.index')
            ->with('successNotification', __(
                'avored::system.deleted_notification',
                ['attribute' => __('avored::system.attribute')]
            ));
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
            $options = collect();
            $beforeAttributeIds = $attribute->dropdownOptions()->pluck('id');
            foreach ($request->get('dropdown_options') as $key => $option) {
                if (empty($option['display_text'])) {
                    continue;
                }
                $attributeDropdownOption = $attribute->dropdownOptions()->where('id', $key)->first();
                unset($option['id']);
                if ($attributeDropdownOption !== null) {
                    $attributeDropdownOption->save($option);
                } else {
                    $attribute->dropdownOptions()->create($option);
                }
                $options->push($key);
            }
            $deletedIds = $beforeAttributeIds->filter(function ($attributeId) use ($options) {
                return !$options->contains($attributeId);
            });

            foreach ($deletedIds as $key => $deletedId) {
                $attribute->attributeProductValues()->where('id', $deletedId)->delete();
                $attribute->dropdownOptions()->where('id', $deletedId)->delete();
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
}
