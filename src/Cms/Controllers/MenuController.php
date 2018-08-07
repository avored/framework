<?php

namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Models\Database\Menu;
use AvoRed\Framework\Models\Database\Category;
use Illuminate\Http\Request;
use AvoRed\Framework\Menu\Facade as MenuFacade;
use AvoRed\Framework\Models\Contracts\MenuInterface;
use AvoRed\Framework\System\Controllers\Controller;

class MenuController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\MenuRepository
     */
    protected $repository;

    public function __construct(MenuInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frontMenus = MenuFacade::all();
        $categories = Category::all();
        $menus = $this->repository->parentsAll();

        return view('avored-framework::menu.index')
                    ->with('categories', $categories)
                    ->with('frontMenus', $frontMenus)
                    ->with('menus', $menus);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menuJson = $request->get('menu_json');
        $menuArray = json_decode($menuJson);

        $this->repository->truncateAndCreateMenus($menuArray);

        return redirect()->route('admin.menu.index')
                        ->with('notificationText', 'Menu Save Successfully!!');
    }
}
