<?php

namespace AvoRed\Framework\System\Controllers;

class SpaController
{
    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('avored::spa.index');
    }
}
