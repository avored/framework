<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Contracts\LanguageInterface;
use AvoRed\Framework\Models\Database\Language;
use Illuminate\Support\Collection;

class LanguageRepository implements LanguageInterface
{
    /**
     * Find a Language by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Language
     */
    public function find($id)
    {
        return Language::find($id);
    }

    /**
     * Get all Language
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Language::all();
    }

    /**
     * Paginate Language
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Language::paginate($noOfItem);
    }

    /**
     * Get a Language Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Language::query();
    }

    /**
     * Create a Language Record
     *
     * @return \AvoRed\Framework\Models\Language
     */
    public function create($data)
    {
        return Language::create($data);
    }

    /**
     * Get All Language Options for Dropdown Field
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function options()
    {
        return $this->all()->pluck('name', 'id');
    }

    /**
     * Get Default Language for the Store
     *
     * @return \AvoRed\Framework\Models\Language
     */
    public function getDefault()
    {
        return Language::whereIsDefault(1)->first();
    }

    /**
     * Get Addtional Languages for the store
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAdditionalLanguages()
    {
        return Language::whereIsDefault(0)->get();
    }
}
