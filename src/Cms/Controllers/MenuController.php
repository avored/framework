<?php
namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Database\Contracts\MenuModelInterface;
use AvoRed\Framework\Database\Models\Menu;
use AvoRed\Framework\Cms\Requests\MenuRequest;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;

class MenuController
{
    /**
     * Menu Repository for the Menu Controller
     * @var \AvoRed\Framework\Database\Repository\MenuRepository $menuRepository
     */
    protected $menuRepository;

    /**
     * Menu Controller for the Install Command
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository $categoryRepository
     */
    protected $categoryRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Contracts\MenuModelInterface $menuRepository
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $categoryRepository
     */
    public function __construct(
        MenuModelInterface $menuRepository,
        CategoryModelInterface $categoryRepository
    ) {
        $this->menuRepository = $menuRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();
        
        return view('avored::cms.menu.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\MenuRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
<<<<<<< HEAD
        $this->menuRepository->create($request->all());
=======
        $menuGroup = $this->menuGroupRepository
            ->find($request->get('menu_group_id'));
        if (null === $menuGroup) {
            $menuGroup = $this->menuGroupRepository->create($request->all());
        } else {
            $menuGroup->update($request->all());
        }
        $menuJson = $request->get('menu_json');
        $menuArray = json_decode($menuJson);
        
        $this->repository->truncateAndCreateMenus($menuGroup, $menuArray);
>>>>>>> parent of 6f1e4cb... Merge pull request #69 from avored/dev

        return redirect()->route('admin.menu.index')
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'Menu']));
    }

    /**
     * set the categories url for menu
     * @param
     */
    public function setCategoriesUrl($categories)
    {
        //@todo
        foreach ($categories as $category) {
            $url = route('admin.category');
            $category->url = $url;
        }

        return $categories;
    }
}
