<?php

namespace AvoRed\Framework\System\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\System\Requests\AdminUserImageRequest;
use AvoRed\Framework\System\Requests\AdminUserRequest;

class AdminUserController extends Controller
{
    /**
     * AdminUser Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\AdminUserRepository $adminUserRepository
     */
    protected $adminUserRepository;
    
    /**
     * Construct for the AvoRed User Controller
     * @param \AvoRed\Framework\Database\Repository\AdminUserRepository $adminUserRepository
     */
    public function __construct(
        AdminUserModelInterface $adminUserRepository
    ) {
        $this->adminUserRepository = $adminUserRepository;
    }
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminUsers = $this->adminUserRepository->all();
        
        return view('avored::system.admin-user.index')
            ->with('adminUsers', $adminUsers);
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored::system.admin-user.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\AdminUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);

        $this->adminUserRepository->create($request->all());

        return redirect()->route('admin.admin-user.index')
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'AdminUser']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\AdminUser $adminUser
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminUser $adminUser)
    {
        return view('avored::system.admin-user.edit')
            ->with('adminUser', $adminUser);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\AdminUserRequest $request
     * @param \AvoRed\Framework\Database\Models\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUserRequest $request, AdminUser $adminUser)
    {
        $adminUser->update($request->all());

        return redirect()->route('admin.admin-user.index')
            ->with('successNotification', __('avored::system.notification.updated', ['attribute' => 'AdminUser']));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\AdminUser  $adminUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminUser $adminUser)
    {
        $adminUser->delete();

        return [
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => 'AdminUser'])
        ];
    }

    /**
     * upload user image to file system.
     * @param \AvoRed\Framework\System\Requests\AdminUserImageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function upload(AdminUserImageRequest $request)
    {
        $image = $request->file('image_file');
        $path = $image->store('uploads/users', 'public');

        return [
            'success' => true,
            'path' => $path,
            'message' => __('avored::system.notification.upload', ['attribute' => 'Admin User Image'])
        ];
    }
}
