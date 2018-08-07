<?php

namespace AvoRed\Framework\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use AvoRed\Framework\Models\Database\Country;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the currency resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('avored-framework::currency.index');
    }

}
