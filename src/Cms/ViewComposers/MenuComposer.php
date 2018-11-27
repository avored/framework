<?php

namespace AvoRed\Framework\Cms\ViewComposers;

use Illuminate\View\View;
use AvoRed\Framework\Menu\Facades\Menu as MenuFacade;
use AvoRed\Framework\Models\Contracts\MenuInterface;
use AvoRed\Framework\Models\Contracts\CategoryInterface;

class MenuComposer
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\MenuRepository
     */
    protected $menuRepository;
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\CategoryRepository
     */
    protected $categoryRepository;

    public function __construct(
        MenuInterface $menuRepository,
        CategoryInterface $categoryRepository
    ) {
        $this->menuRepository = $menuRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View $view
     * @return void
     */
    public function compose(View $view)
    {
        $frontMenus = MenuFacade::all();
        $categories = $this->categoryRepository->all();
        //$menus = $this->menuRepository->parentsAll();

        $view->with('categories', $categories)
            ->with('frontMenus', $frontMenus);
            //->with('menus', $menus);
    }
}
