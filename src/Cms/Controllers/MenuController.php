<?php

namespace AvoRed\Framework\Cms\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Models\Contracts\MenuInterface;
use AvoRed\Framework\System\Controllers\Controller;
use AvoRed\Framework\Models\Contracts\MenuGroupInterface;
use AvoRed\Framework\Models\Database\MenuGroup;
use AvoRed\Framework\Cms\Requests\MenuRequest;

class MenuController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\MenuRepository
     */
    protected $repository;

    /**
     *
     * @var \AvoRed\Framework\Models\Repository\MenuGroupRepository
     */
    protected $menuGroupRepository;

    public function __construct(
        MenuGroupInterface $menuGroupRepository,
        MenuInterface $repository
    )
    {
        $this->menuGroupRepository = $menuGroupRepository;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $menuGroups = $this->menuGroupRepository->all();
        if ($request->get('group_id') == 'new') {
            $menuGroup = new MenuGroup;
            $menuGroup->name = 'New Group';
        } elseif ($request->get('group_id') > 0) {
            $menuGroup = $this->menuGroupRepository->find($request->get('group_id'));
        } else {
            $menuGroup = $this->menuGroupRepository->query()->whereIsDefault(1)->first();
        }

        if(null === $menuGroup) {
            $menuGroup = new MenuGroup;
        }

        return view('avored-framework::cms.menu.index')
                    ->withMenuGroups($menuGroups)
                    ->withGroup($menuGroup);
    }

    /**
     * Display a listing of the resource.
     * 
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MenuRequest $request)
    {
        $menuGroup = $this->menuGroupRepository->find($request->get('menu_group_id'));
        if (null === $menuGroup) {
            $menuGroup = $this->menuGroupRepository->create($request->all());
        } else {
            $menuGroup->update($request->all());
        }
        $menuJson = $request->get('menu_json');
        $menuArray = json_decode($menuJson);
        
        $this->repository->truncateAndCreateMenus($menuGroup, $menuArray);

        return redirect()->route('admin.menu.index')
                        ->with('notificationText', 'Menu Save Successfully!!');
    }
}
