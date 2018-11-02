<?php

namespace AvoRed\Framework\Models\Contracts;

interface ProductDownloadableUrlInterface
{
    /**
     * Find an Downloadable Product by given Id which returns ProductDownloadableUrl Model
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\ProductDownloadableUrl
     */
    public function find($id);

    /**
     * Find an Category by given token which returns Category Model
     *
     * @param string $token
     * @return \AvoRed\Framework\Models\Database\ProductDownloadableUrl
     */
    public function findByToken($token);

    /**
     * Get an All  which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Category Collection with Limit which returns paginate class
     *
     * @param integer $noOfItem
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10);

    /**
     * Category Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create an Product Downloadable Url
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\ProductDownloadableUrl
     */
    public function create($data);
}
