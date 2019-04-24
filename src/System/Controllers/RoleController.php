<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Models\Role;
use AvoRed\Framework\System\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * Role Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\RoleRepository $roleRepository
     */
    protected $roleRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\RoleRepository $roleRepository
     */
    public function __construct(
        RoleModelInterface $roleRepository
    ) {
        $this->roleRepository = $roleRepository;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->all();
        
        return view('avored::system.role.index')
            ->with('roles', $roles);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored::system.role.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->roleRepository->create($request->all());

        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     * @param  \AvoRed\Framework\Database\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('avored::system.role.edit')
            ->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\RoleRequest $request
     * @param \AvoRed\Framework\Database\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->all());

        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return [
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => 'Role'])
        ];
    }
}
