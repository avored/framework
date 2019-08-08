<?php
namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Database\Contracts\MenuModelInterface;
use AvoRed\Framework\Database\Contracts\MenuGroupModelInterface;
use AvoRed\Framework\Database\Models\Menu;
use AvoRed\Framework\Cms\Requests\MenuRequest;
use Illuminate\Http\Request;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use function GuzzleHttp\json_decode;
use AvoRed\Framework\Database\Models\MenuGroup;

class MenuController
{
    /**
     * Menu Repository for the Menu Controller
     * @var \AvoRed\Framework\Database\Repository\MenuRepository $menuRepository
     */
    protected $menuRepository;

    /**
     * Menu Group Repository for the Menu Controller
     * @var \AvoRed\Framework\Database\Repository\MenuGroupRepository $menuGroupRepository
     */
    protected $menuGroupRepository;

    /**
     * Menu Controller for the Install Command
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository $categoryRepository
     */
    protected $categoryRepository;
    
    /**
     * Construct for the AvoRed install command
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
        $categories = $this->categoryRepository->getCategoryOptionForMenuBuilder();

        return view('avored::cms.menu.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $menuGroup = $this->menuGroupRepository->create($request->all());
        $menus = json_decode($request->get('menu_json'));
        
        $this->saveMenus($menuGroup, $menus);
        
        return redirect()->route('admin.menu.index')
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'Menu']));
    }

    /**
     * set the categories url for menu
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
                'url' => $menu->url
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
