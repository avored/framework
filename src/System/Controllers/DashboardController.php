<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Models\Contracts\OrderInterface;
use AvoRed\Framework\Models\Contracts\UserInterface;

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
        $totalRegisteredUser = app(UserInterface::class)->all();
        $totalOrder = $this->repository->all()->count();

        return view('avored-framework::home')
            ->with('totalRegisteredUser', $totalRegisteredUser)
            ->with('totalOrder', $totalOrder);
    }
}
