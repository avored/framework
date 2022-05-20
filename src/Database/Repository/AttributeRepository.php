<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Catalog\Requests\AttributeRequest;
use AvoRed\Framework\Database\Models\Attribute;
use AvoRed\Framework\Database\Contracts\AttributeModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class AttributeRepository extends BaseRepository implements AttributeModelInterface
{
    use FilterTrait;

    /**
     * @var Attribute $model
     */
    protected $model;

    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
        'slug',
    ];

    /**
     * Construct for the Attribute Repository
     */
    public function __construct()
    {
        $this->model = new Attribute();
    }

    /**
     * Get the model for the repository
     * @return Attribute
     */
    public function model(): Attribute
    {
        return $this->model;
    }

    /**
     * Save Attribute Dropdown options.
     * @param \AvoRed\Framework\Catalog\Requests\AttributeRequest $request
     * @param \\AvoRed\Framework\Database\Models\Attribute  $attribute
     * @return void
     */
    public function saveAttributeDropdownOptions(AttributeRequest $request, Attribute $attribute)
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
                    $attributeDropdownOption->update($option);
                } else {
                    $attribute->dropdownOptions()->create($option);
                }
                $options->push($key);
            }
            $deletedIds = $beforeAttributeIds->filter(function ($attributeId) use ($options) {
                return !$options->contains($attributeId);
            });

            foreach ($deletedIds as $key => $deletedId) {
                // $attribute->attributeProductValues()->where('id', $deletedId)->delete();
                $attribute->dropdownOptions()->where('id', $deletedId)->delete();
            }
        }
    }
}
