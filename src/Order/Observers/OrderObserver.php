<?php

namespace AvoRed\Framework\Order\Observers;

use AvoRed\Framework\Database\Contracts\ConfigurationModelInterface;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Widget\TotalOrder;

class OrderObserver
{
    /**
     * UserGroup Repository for controller.
     * @var \AvoRed\Framework\Database\Repository\ConfigurationModelInterface
     */
    protected $configurationRepository;

    /**
     * Construct for the AvoRed user group controller.
     * @param \AvoRed\Framework\Database\Repository\ConfigurationModelInterface $configurationRepository
     */
    public function __construct(
        ConfigurationModelInterface $configurationRepository
    ) {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * Handle the Order "created" event
     * @param \AvoRed\Framework\Database\Models\Order $order
     * @return void
     */
    public function created(Order $order)
    {
        $model = $this->configurationRepository->getModelByCode(TotalOrder::CONFIGURATION_KEY);
        if ($model === null) {
            $amount = 1;
            $data = ['code' => TotalOrder::CONFIGURATION_KEY, 'value' => $amount];
            $this->configurationRepository->create($data);
        } else {
            $amount = $model->value + 1;
            $data = ['code' => TotalOrder::CONFIGURATION_KEY, 'value' => $amount];
            $model->update($data);
        }
    }
}
