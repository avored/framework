<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Models\Contracts\OrderInterface;
use AvoRed\Framework\Models\Database\User;

class DashboardController extends Controller
{
    /**
    *
    * @var \AvoRed\Framework\Models\Repository\OrderRepository
    */
    protected $repository;

    public function __construct(OrderInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalRegisteredUser = User::all()->count();
        $totalOrder = $this->repository->all()->count();

        return view('avored-framework::home')
            ->with('totalRegisteredUser', $totalRegisteredUser)
            ->with('totalOrder', $totalOrder);
    }
}
