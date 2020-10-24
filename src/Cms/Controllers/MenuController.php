<?php

namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Cms\Requests\MenuRequest;
use AvoRed\Framework\Database\Models\MenuGroup;
use AvoRed\Framework\Support\Facades\Menu;
use AvoRed\Framework\Database\Models\Menu as MenuModel;
use AvoRed\Framework\Database\Contracts\MenuModelInterface;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;
use Illuminate\Http\Request;

class MenuController
{
    /**
     * Menu Repository for the Menu Controller.
     * @var \AvoRed\Framework\Database\Repository\MenuRepository
     */
    protected $menuRepository;

    /**
     * Menu Group Repository for the Menu Controller.
     * @var \AvoRed\Framework\Database\Repository\MenuGroupRepository
     */
    protected $menuGroupRepository;

    /**
     * Menu Controller for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\MenuModelInterface $menuRepository
     * @param \AvoRed\Framework\Database\Contracts\MenuGroupModelInterface $menuGroupRepository
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $categoryRepository
     */
    public function __construct(
        MenuModelInterface $menuRepository,
        MenuGroupModelInterface $menuGroupRepository,
        CategoryModelInterface $categoryRepository
    ) {
        $this->menuRepository = $menuRepository;
        $this->menuGroupRepository = $menuGroupRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $menuGroups = $this->menuGroupRepository->paginate();

        return view('avored::cms.menu.index')
            ->with(compact('menuGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @param MenuGroup $menuGroup
     * @return \Illuminate\View\View
     */
    public function create(MenuGroup $menuGroup)
    {
        $existedMenus = $menuGroup->menus->pluck('name', 'id');
        $menuTypeOptions = MenuModel::MENU_TYPE_OPTIONS;
        $frontMenuOptions = Menu::frontMenus()->pluck('name', 'route');
        $categoryOptions = $this->categoryRepository->options('name', 'slug');

        return view('avored::cms.menu.create')
            ->with('menuGroup', $menuGroup)
            ->with('frontMenuOptions', $frontMenuOptions)
            ->with('categoryOptions', $categoryOptions)
            ->with('menuTypeOptions', $menuTypeOptions)
            ->with('existedMenus', $existedMenus);
    }

    /**
     * Store a newly created resource in storage.
     * @param MenuGroup $menuGroup
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuGroup $menuGroup, MenuRequest $request)
    {
        $menuGroup->menus()->create($request->all());   
        
        return redirect()
            ->route('admin.menu-group.edit', ['menu_group' => $menuGroup])
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'Menu']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     * @param MenuModel $menu
     * @return \Illuminate\View\View
     */
    public function edit(MenuGroup $menuGroup, MenuModel $menu)
    {
        
        $existedMenus = $menuGroup->menus->pluck('name', 'id');
        $menuTypeOptions = MenuModel::MENU_TYPE_OPTIONS;
        $frontMenuOptions = Menu::frontMenus()->pluck('name', 'route');
        $categoryOptions = $this->categoryRepository->options('name', 'slug');

        return view('avored::cms.menu.edit')
            ->with('menu', $menu)
            ->with('menuGroup', $menuGroup)
            ->with('frontMenuOptions', $frontMenuOptions)
            ->with('categoryOptions', $categoryOptions)
            ->with('menuTypeOptions', $menuTypeOptions)
            ->with('existedMenus', $existedMenus);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @param \AvoRed\Framework\Database\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuRequest $request, MenuGroup $menuGroup, MenuModel $menu)
    {
        $menu->update($request->all());

        return redirect()
            ->route('admin.menu-group.edit', ['menu_group' => $menuGroup])
            ->with('successNotification', __('avored::system.notification.updated', ['attribute' => 'Menu']));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(MenuGroup $menuGroup, MenuModel $menu)
    {
        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => 'Menu']),
        ]);
    }

    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->menuRepository->filter($request->get('filter'));
    }
}
