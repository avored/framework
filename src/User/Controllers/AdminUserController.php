<?php

namespace AvoRed\Framework\User\Controllers;

use Illuminate\Routing\Controller;
use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\User\Requests\AdminUserRequest;
use AvoRed\Framework\User\Requests\AdminUserImageRequest;
use AvoRed\Framework\Database\Contracts\RoleModelInterface;
use AvoRed\Framework\Database\Contracts\AdminUserModelInterface;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * AdminUser Repository.
     * @var \AvoRed\Framework\Database\Repository\AdminUserRepository
     */
    protected $adminUserRepository;

    /**
     * Role Repository.
     * @var \AvoRed\Framework\Database\Repository\RoleRepository
     */
    protected $roleRepository;

    /**
     * Construct for the AvoRed User Controller.
     * @param \AvoRed\Framework\Database\Contracts\AdminUserModelInterface $adminUserRepository
     * @param \AvoRed\Framework\Database\Contracts\RoleModelInterface $roleRepository
     */
    public function __construct(
        AdminUserModelInterface $adminUserRepository,
        RoleModelInterface $roleRepository
    ) {
        $this->adminUserRepository = $adminUserRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $adminUsers = $this->adminUserRepository->paginate();

        return view('avored::user.admin-user.index')
            ->with(compact('adminUsers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('user.admin-user');
        $languageOptions = ['en' => 'English'];
        $roleOptions = $this->roleRepository->options();

        return view('avored::user.admin-user.create')
            ->with(compact('roleOptions', 'tabs', 'languageOptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\AdminUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);

        $this->adminUserRepository->create($request->all());

        return redirect()->route('admin.admin-user.index')
            ->with('successNotification', __('avored::user.notification.store', ['attribute' => 'AdminUser']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\AdminUser $adminUser
     * @return \Illuminate\View\View
     */
    public function edit(AdminUser $adminUser)
    {
        $tabs = Tab::get('user.admin-user');
        $languageOptions = ['en' => 'English'];
        $roleOptions = $this->roleRepository->options();

        return view('avored::user.admin-user.edit')
            ->with(compact('adminUser', 'roleOptions', 'tabs', 'languageOptions'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\AdminUserRequest $request
     * @param \AvoRed\Framework\Database\Models\AdminUser  $adminUser
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminUserRequest $request, AdminUser $adminUser)
    {
        $adminUser->update($request->all());

        return redirect()->route('admin.admin-user.index')
            ->with('successNotification', __('avored::user.notification.updated', ['attribute' => 'AdminUser']));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\AdminUser  $adminUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AdminUser $adminUser)
    {
        $adminUser->delete();

        return response()->json([
            'success' => true,
            'message' => __('avored::user.notification.delete', ['attribute' => 'AdminUser']),
        ]);
    }

    /**
     * upload user image to file system.
     * @param \AvoRed\Framework\System\Requests\AdminUserImageRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(AdminUserImageRequest $request)
    {
        $image = $request->file('files');
        $path = $image->store('uploads/users', 'avored');

        return response()->json([
            'success' => true,
            'path' => $path,
            'message' => __('avored::user.notification.upload', ['attribute' => 'Admin User Image']),
        ]);
    }

    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->adminUserRepository->filter($request->get('filter'));
    }
}
