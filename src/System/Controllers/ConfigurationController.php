<?php
namespace AvoRed\Framework\System\Controllers;

class ConfigurationController
{
    /**
     * Show Configuration  of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('avored::system.configuration.index');
    }
}
