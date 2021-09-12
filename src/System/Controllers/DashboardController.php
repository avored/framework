<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Routing\Controller;
class DashboardController extends Controller
{
    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('avored::admin');
    }
}
