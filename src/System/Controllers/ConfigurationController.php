<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Models\Database\Country;
use Illuminate\Http\Request;
use AvoRed\Framework\Models\Database\Page;
use AvoRed\Framework\Models\Database\Configuration as Model;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;

class ConfigurationController extends Controller
{
    /**
     * Configuration Respository
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository
     */
    protected $repository;

    public function __construct(ConfigurationInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Model();
        $pageOptions = Page::Options();
        $countryOptions = Country::options();

        return view('avored-framework::system.configuration.index')
            ->withModel($model)
            ->withPageOptions($pageOptions)
            ->withCountryOptions($countryOptions);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            $configModel = $this->repository->findByKey($key);

            if (null === $configModel) {
                $data['configuration_key'] = $key;
                $data['configuration_value'] = $value;

                $this->repository->create($data);
            } else {
                $configModel->update(['configuration_value' => $value]);
            }
        }
        return redirect()->route('admin.configuration')
            ->with('notificationText', 'Configurações salvas com sucesso!');
    }
}
