<?php

namespace AvoRed\Framework\User\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Models\Database\Country;
use Illuminate\Support\Collection;

class SiteCurrencyFieldsComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $countries = Country::all();
        $options = Collection::make();
        $symbolOption = Collection::make();
        foreach ($countries as $country) {
            $options->put($country->currency_code, [
                'id' => $country->currency_code,
                'name' => $country->currency_code
            ]);

            if (!empty($country->currency_symbol)) {
                $symbolOption->put($country->currency_symbol, [
                    'id' => $country->currency_symbol,
                    'name' => $country->currency_symbol
                ]);
            }
        }
        $statusOptions = Collection::make([['id' => 'ENABLED', 'name' => 'Enabled'], ['id' => 'DISABLED', 'name' => 'Disabled']]);

        $view
            ->with('codeOptions', $options)
            ->with('symbolOptions', $symbolOption)
            ->with('statusOptions', $statusOptions);
    }
}
