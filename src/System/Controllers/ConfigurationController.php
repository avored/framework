<?php
namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;

class ConfigurationController
{
    /**
     * Configuration Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\ConfigurationRepository $configurationRepository
     */
    protected $configurationRepository;
    
    /**
     * Construct for the AvoRed language controller
     * @param \AvoRed\Framework\Database\Repository\ConfigurationRepository $configurationRepository
     */
    public function __construct(
        ConfigurationModelInterface $configurationRepository
    ) {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * Show Configuration  of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('avored::system.configuration.index')
            ->with('repository', $this->configurationRepository);
    }

    /**
     * Show Configuration  of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->except('_token') as $code => $value) {
            $model = $this->configurationRepository->getModelByCode($code);
            if ($model === null) {
                $this->configurationRepository->create(['code' => $code, 'value' => $value]);
            } else {
                $model->update(['value' => $value]);
            }
        }
        return redirect()->route('admin.configuration.index')
            ->with(
                'successNotification',
                __('avored::system.notification.save', ['attribute' => __('avored::system.configuration.title')])
            );
    }
}
