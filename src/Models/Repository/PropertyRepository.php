<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\PropertyInterface;
use AvoRed\Framework\Models\Database\Property;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Database\PropertyTranslation;
use AvoRed\Framework\Models\Database\Language;
use AvoRed\Framework\Models\Database\PropertyDropdownOption;

class PropertyRepository implements PropertyInterface
{
    /**
     * Find an Property by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Database\Property
     */
    public function find($id)
    {
        return Property::find($id);
    }

    /**
     * Find an Property collection by given an array of Ids
     *
     * @param array $id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany($ids)
    {
        return Property::whereIn('id', $ids)->get();
    }

    /**
     * Product Property Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Property::query();
    }

    /**
     * Create an Property an Return an Property Instance
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\Property
     */
    public function create($data)
    {
        return Property::create($data);
    }

    /**
     * Update Product Property 
     * @param array $data
     * @param \AvoRed\Framework\Models\Database\Property
     * @return \AvoRed\Framework\Models\Database\Property
     */
    public function update($property, $data)
    {
        if (Session::has('multi_language_enabled')) {
            $languageId = $data['language_id'];
            $languaModel = Language::find($languageId);
            
            if ($languaModel->is_default) {
                return $property->update($data);
            } else {
                $translatedModel = $property
                    ->translations()
                    ->whereLanguageId($languageId)
                    ->first();
                if (null === $translatedModel) {
                    return PropertyTranslation::create(
                        array_merge($data, ['property_id' => $property->id])
                    );
                } else {
                    $translatedModel->update(
                        $data,
                        $property->getTranslatedAttributes()
                    );

                    return $translatedModel;
                }

            }
        } else {
            return $category->update($data);
        }
    }
     
    /**
     * Sync Property Dropdown Options
     * @param \AvoRed\Framework\Models\Database\Property $property
     * @param array $data
     */
    public function syncDropdownOptions($property, $data)
    {
        $dropdownOptionsData = $data['dropdown_options'] ?? [];

        if (count($dropdownOptionsData)) {
            $defaultLanguage = Session::get('default_language');
            $languageId = $data['language_id'] ?? $defaultLanguage->id;

            if ($defaultLanguage->id != $languageId) {
                foreach ($dropdownOptionsData as $key => $val) {
                    if (empty($val['display_text'])) {
                        continue;
                    }
                    
                    if (is_int($key)) {
                        $optionModel = PropertyDropdownOption::find($key);
                        
                        $translatedModel = $optionModel
                            ->translations()
                            ->whereLanguageId($languageId)
                            ->first();
                        if (null !== $translatedModel) {
                            $translatedModel->update($val);
                        } else {
                            $optionModel
                                ->translations()
                                ->create(
                                    array_merge($val, ['language_id' => $languageId])
                                );
                        }
                    } 
                }
            } else {
                if ($property->propertyDropdownOptions()->get() != null 
                    && $property->propertyDropdownOptions()->get()->count() >= 0
                ) {
                    $property->propertyDropdownOptions()->delete();
                }

                foreach ($dropdownOptionsData as $key => $val) {
                    if (empty($val['display_text'])) {
                        continue;
                    }
                    $option = $property
                        ->propertyDropdownOptions()
                        ->create($val);
                }
            }
        }
    }
}
