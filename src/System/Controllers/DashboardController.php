<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Support\Facades\Widget;

class DashboardController
{
    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orderWidget = Widget::get('avored-total-order');
        $customerWidget = Widget::get('avored-total-customer');
        $revenueWidget = Widget::get('avored-total-revenue');
      
        
        return view('avored::admin', compact('orderWidget', 'customerWidget', 'revenueWidget'));
    }
}
