<?php

namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Cms\Requests\MenuGroupRequest;
use AvoRed\Framework\Database\Models\MenuGroup;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;
use Illuminate\Http\Request;

class MenuGroupController
{
    /**
     * Menu Group Repository for the Menu Controller.
     * @var \AvoRed\Framework\Database\Repository\MenuGroupModelInterface
     */
    protected $menuGroupRepository;

    /**
     * Construct for the AvoRed Menu Group Controller.
     * @param \AvoRed\Framework\Database\Contracts\MenuGroupModelInterface $menuGroupRepository
     */
    public function __construct(
        MenuGroupModelInterface $menuGroupRepository
    ) {
        $this->menuGroupRepository = $menuGroupRepository;
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 10;
        if ($request->get('filter')) {
            $menuGroups = $this->menuGroupRepository->filter($request->get('filter'));
        } else {
            $menuGroups = $this->menuGroupRepository->paginate($perPage);
        }

        return view('avored::cms.menu-group.index')
            ->with(compact('menuGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('avored::cms.menu-group.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuGroupRequest $request)
    {
        $menuGroup = $this->menuGroupRepository->create($request->all());
        
        return redirect()
            ->route('admin.menu-group.edit', ['menu_group' => $menuGroup->id])
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'Menu']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function edit(MenuGroup $menuGroup, Request $request)
    {
        $perPage = 10;
        $with = ['parent'];
        if ($request->has('filter')) {
            $filter = $request->get('filter');

            $query = $menuGroup->menus();
            $query->where('name', 'like', '%' . $filter . '%');
            $query->orWhere('type', 'like', '%' . $filter . '%');

            $menus =  $query->paginate($perPage);
        } else {
            $menus = $menuGroup->menus()->paginate(10);
        }

        return view('avored::cms.menu-group.edit')
            ->with(compact('menus', 'menuGroup'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\MenuGroupRequest $request
     * @param \AvoRed\Framework\Database\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuGroupRequest $request, MenuGroup $menuGroup)
    {
        $menuGroup->update($request->all());
        
        return redirect()->route('admin.menu-group.index')
            ->with('successNotification', __('avored::system.notification.updated', ['attribute' => 'Menu']));
    }

    /**
     * Remove the specified resource from storage.
     * @param int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        MenuGroup::destroy($id);

        return redirect()
            ->route('admin.menu-group.index')
            ->with([
                'successNotification' => __(
                    'avored::system.deleted_notification',
                    ['attribute' => __('avored::system.menu-group')]
                ),
            ]);
    }
}
