<?php

namespace AvoRed\Framework\Models\Contracts;

interface LanguageInterface
{
    /**
     * Find a Language by given Id which returns Language Model
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Language
     */
    public function find($id);

    /**
     * Find an All Languages which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Language Collection with Limit which returns paginate class
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Language Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a Language
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Language
     */
    public function create($data);

    /**
     * Get All Language Options for Dropdown Field
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function options();

    /**
     * Get Default Language for the store
     *
     * @return \AvoRed\Framework\Models\Language
     */
    public function getDefault();

    /**
     * Get Addtional Languages for the store
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAdditionalLanguages();
}
