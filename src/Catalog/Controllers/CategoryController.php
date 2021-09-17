<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Models\Category;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{

    /**
     * @var CategoryRepository $categoryRepository
     */
    protected $categoryRepository;
    /**
     * 
     * @param CategoryRepositroy $repository
     */
    public function __construct(
       CategoryModelInterface $repository 
    ) {
        $this->categoryRepository = $repository;
    }
    /**
     * Show List of an Resources.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->paginate();

        return view('avored::catalog.category.index')
            ->with('categories', $categories);
    }
}
