<?php

namespace AvoRed\Framework\Database\Contracts;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\Language;

interface LanguageModelInterface extends BaseInterface
{
    /**
     * Make All Language Status to Disabled
     * 
     * @return bool
     */
    public function makeAllDisabled(): bool;
}
