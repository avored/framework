<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ConfigurationController extends Controller
{
    /**
     * Configuration Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\ConfigurationRepository
     */
    protected $configurationRepository;

    /**
     * Construct for the AvoRed configuration controller.
     * @param \AvoRed\Framework\Database\Contracts\ConfigurationModelInterface $configurationRepository
     */
    public function __construct(
        ConfigurationModelInterface $configurationRepository
    ) {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * Show Configuration  of an AvoRed Admin.
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        $tabs = Tab::get('system.configuration');

        return view('avored::system.configuration.index')
            ->with('tabs', $tabs)
            ->with('repository', $this->configurationRepository)
            ;
    }

    /**
     * Show Configuration  of an AvoRed Admin.
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        foreach ($request->except('_token') as $code => $value) {
            /** @var \AvoRed\Framework\Database\Models\Configuration $model */
            $model = $this->configurationRepository->getModelByCode($code);
            if ($model === null) {
                $this->configurationRepository->create(['code' => $code, 'value' => $value]);
            } else {
                $model->update(['value' => $value]);
            }
        }

        return redirect()->route('admin.configuration.index')
            ->with(
                'message',
                __('avored::system.notification.save', ['attribute' => __('avored::system.configuration.title')])
            );
    }
}
