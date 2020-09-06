<?php

namespace AvoRed\Framework\Report\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use Illuminate\Support\Facades\Session;

class NewCustomerController
{
    /**
     * Customer Repository for the New Customer Controller.
     * @var \AvoRed\Framework\Database\Repository\CustomerRepository
     */
    protected $customerRepository;

    /**
     * Group by Options
     * @var array 
     */
    protected $timePeriodOptions = [
        'DAY' => 'Day',
        'WEEK' => 'Week',
        'MONTH' => 'Month',
        'YEAR' => 'Year',
    ];

    /**
     * Construct for the AvoRed configuration controller.
     * @param \AvoRed\Framework\Database\Contracts\CustomerModelInterface $customerRepository
     */
    public function __construct(
        CustomerModelInterface $customerRepository
    ) {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Show Configuration  of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        Session::put('report_new_customer', []);
        
        return view('avored::report.new-customer')
            ->with('timePeriodOptions', $this->timePeriodOptions);
    }

    /**
     * Show Configuration  of an AvoRed Admin.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function results(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $groupBy = $request->get('group_by');

        Session::put('report_new_customer', $request->all());
       
        $customers = $this->customerRepository->getNewCustomersBy($from, $to, $groupBy);
        
        return view('avored::report.new-customer')
            ->with('timePeriodOptions', $this->timePeriodOptions)
            ->with('customers', $customers);
    }
}
