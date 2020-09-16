<?php

namespace AvoRed\Framework\Report\Report;

use Illuminate\Http\Request;

interface ReportInterface
{
    /**
     * Options that is required to for the report filter
     * @return mixed
     */
    public function options();

    /**
     * Report data based on the given filter
     * @param Request $request
     * @return mixed
     */
    public function data(Request $request);

}
