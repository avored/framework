<?php

namespace AvoRed\Framework\User\Controllers;

use AvoRed\Framework\System\Controllers\Controller;
use AvoRed\Framework\Models\Contracts\UserInterface;
use AvoRed\Framework\User\DataGrid\UserDeleteRequestDataGrid;

class UserDeleteRequestController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\UserRepository
     */
    protected $repository;

    public function __construct(UserInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $deletedUsers = $this->repository
            ->query()
            ->withTrashed()
            ->whereStatus('DELETE_IN_PROGRESS');
        
        $dataGrid = new UserDeleteRequestDataGrid($deletedUsers);

        return view('avored-framework::user.user-delete-request.index')
            ->withDataGrid($dataGrid->dataGrid);
    }
    /**
     * Display a listing of the resource.
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function destroy($id)
    {
        $deletedUser = $this->repository
            ->query()
            ->withTrashed()
            ->whereId($id)->first();

        $deletedUser->forceDelete();
        
        return redirect()->route('admin.user-delete-request.index');
    }

}
