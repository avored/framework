<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Models\Property;
use AvoRed\Framework\Database\Contracts\PropertyModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class PropertyRepository extends BaseRepository implements PropertyModelInterface
{
    use FilterTrait;

    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
        'slug'
    ];


    /**
     * @var Property $model
     */
    protected $model;

    /**
     * Construct for the Property Repository
     */
    public function __construct()
    {
        $this->model = new Property();
    }

    /**
     * Get the model for the repository
     * @return Property
     */
    public function model(): Property
    {
        return $this->model;
    }


    public function savePropertyDropdown($request, $property)
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
