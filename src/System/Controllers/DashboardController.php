<?php
namespace AvoRed\Framework\System\Controllers;

class DashboardController
{
    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('avored::admin');
    }
}
