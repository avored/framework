<?php

namespace AvoRed\Framework\Report\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Report\Report\NewCustomer;
use Illuminate\Support\Facades\Session;

class ReportController
{

    /**
     * Show Configuration  of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index(string $identifier)
    {
        $report = app(NewCustomer::class);
        Session::put('report_new_customer', []);
        $displayReport = false;

        return view('avored::report.new-customer')
            ->with('timePeriodOptions', $report->options())
            ->with('displayReport', $displayReport);
    }

    /**
     * Show Configuration  of an AvoRed Admin.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function results(Request $request)
    {
        $displayReport = true;
        $report = app(NewCustomer::class);
        
        Session::put('report_new_customer', $request->all());
       
        $customers = $report->data($request);
        
        return view('avored::report.new-customer')
            ->with('timePeriodOptions', $report->options())
            ->with('customers', $customers)
            ->with('displayReport', $displayReport);
    }
}
