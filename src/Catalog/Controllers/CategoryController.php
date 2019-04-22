<?php
namespace AvoRed\Framework\Catalog\Controllers;

class CategoryController
{
    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('avored::catalog.category.index');
    }
}
