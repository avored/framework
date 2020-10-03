<?php

namespace AvoRed\Framework\Report\Report;

use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\CustomerModelInterface;
use Illuminate\Support\Facades\Session;

class NewCustomer implements ReportInterface
{
    /**
     * Customer Repository for the Report Controller.
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
    public function options()
    {
        return $this->timePeriodOptions;
    }

    /**
     * Show Configuration  of an AvoRed Admin.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function data(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');
        $groupBy = $request->get('group_by');
        
        return $this->customerRepository->getNewCustomersBy($from, $to, $groupBy);
    }
}
