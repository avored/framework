<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Catalog\Requests\CategoryRequest;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\JsonResponse;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->paginate();

        return view('avored::catalog.category.index')
        ->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = $this->categoryRepository->options();
        $tabs = Tab::get('catalog.category');

        return view('avored::catalog.category.create')
            ->with('options', $options)
            ->with('tabs', $tabs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request->all());

        return redirect(route('admin.category.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $tabs = Tab::get('catalog.category');

        $options = $this->categoryRepository
            ->options();
        $options->pull($category->id);
        return view('avored::catalog.category.edit')
            ->with('category', $category)
            ->with('options', $options)
            ->with('tabs', $tabs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest  $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect(route('admin.category.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.category')])
        ]);
    }
}
