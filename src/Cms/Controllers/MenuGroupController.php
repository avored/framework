<?php

namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Cms\Requests\MenuRequest;
use AvoRed\Framework\Database\Models\MenuGroup;
use AvoRed\Framework\Support\Facades\Menu;
use AvoRed\Framework\Database\Contracts\MenuModelInterface;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;

class MenuGroupController
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
        $menuGroups = $this->menuGroupRepository->all();

        return view('avored::cms.menu.index')
            ->with(compact('menuGroups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategoryOptionForMenuBuilder();
        $frontMenus = Menu::frontMenus();
        $menus = [];


        return view('avored::cms.menu.create')
            ->with(compact('frontMenus', 'menus', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuRequest $request)
    {
        $menuGroup = $this->menuGroupRepository->create($request->all());
        $menus = json_decode($request->get('menu_json'));

        $this->saveMenus($menuGroup, $menus);

        return redirect()
            ->route('admin.menu-group.index')
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'Menu']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\MenuGroup $menuGroup
     * @return \Illuminate\View\View
     */
    public function edit(MenuGroup $menuGroup)
    {
        $categories = $this->categoryRepository->getCategoryOptionForMenuBuilder();
        $frontMenus = Menu::frontMenus();
        $menus = $this->menuGroupRepository->getTreeByIdentifier($menuGroup->identifier);

        return view('avored::cms.menu.edit')
            ->with(compact('categories', 'menus', 'frontMenus', 'menuGroup'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @param \AvoRed\Framework\Database\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(MenuRequest $request, MenuGroup $menuGroup)
    {
        $menuGroup->menus()->delete();
        $menuGroup->update($request->all());
        $menus = json_decode($request->get('menu_json'));

        $this->saveMenus($menuGroup, $menus);

        return redirect()->route('admin.menu-group.index')
            ->with('successNotification', __('avored::system.notification.updated', ['attribute' => 'Menu']));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\MenuGroup  $menuGroup
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(MenuGroup $menuGroup)
    {
        $menuGroup->delete();

        return response()->json([
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => 'Menu']),
        ]);
    }

    /**
     * set the categories url for menu.
     * @param \AvoRed\Framework\Database\Models\MenuGroup
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @param \\AvoRed\Framework\Database\Models\Menu $parent
     * @return void
     */
    public function saveMenus(MenuGroup $menuGroup, $menus, $parent = null)
    {
        foreach ($menus as $menu) {
            $data = [
                'name' => $menu->name,
                'url' => $menu->url,
            ];

            if ($parent !== null) {
                $data['parent_id'] = $parent->id;
            }
            $menuModel = $menuGroup->menus()->create($data);

            if (isset($menu->submenus) && count($menu->submenus) > 0) {
                $this->saveMenus($menuGroup, $menu->submenus, $menuModel);
            }
        }
    }
}
