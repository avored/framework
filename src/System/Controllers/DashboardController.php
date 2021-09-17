<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index() : View
    {
        return view('avored::admin');
    }
}
