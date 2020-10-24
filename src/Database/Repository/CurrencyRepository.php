<?php

namespace AvoRed\Framework\Database\Repository;

use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Currency;
use AvoRed\Framework\Database\Contracts\CurrencyModelInterface;
use AvoRed\Framework\Database\Traits\FilterTrait;

class CurrencyRepository extends BaseRepository implements CurrencyModelInterface
{
    use FilterTrait;

    /**
     * Filterable Fields
     * @var array $filterType
     */
    protected $filterFields = [
        'name',
        'code',
        'conversation_rate' 
    ];


    /**
     * @var Currency $model
     */
    protected $model;

    /**
     * Construct for the Currency Repository
     */
    public function __construct()
    {
        $this->model = new Currency();
    }

    /**
     * Get the model for the repository
     * @return Currency 
     */
    public function model(): Currency
    {
        return $this->model;
    }
    /**
     * Create Currency Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\Currency $currency
     */
    public function create(array $data): Currency
    {
        return Currency::create($data);
    }

    /**
     * Find Currency Resource into a database.
     * @param int $id
     * @return \AvoRed\Framework\Database\Models\Currency $currency
     */
    public function find(int $id): Currency
    {
        return Currency::find($id);
    }

    /**
     * Delete Currency Resource from a database.
     * @param int $id
     * @return int
     */
    public function delete(int $id): int
    {
        return Currency::destroy($id);
    }

    /**
     * Get all the categories from the connected database.
     * @return \Illuminate\Database\Eloquent\Collection $currencies
     */
    public function all() : Collection
    {
        return Currency::all();
    }

    /**
     * Get default currency from the database.
     * @return \AvoRed\Framework\Database\Models\Currency $currency
     */
    public function getDefault() : Currency
    {
        $configurationRepository = app(ConfigurationModelInterface::class);
        $id = $configurationRepository->getValueByCode('default_currency');
       
        return $this->model->find($id);
    }
}
