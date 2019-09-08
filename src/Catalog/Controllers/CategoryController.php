<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Catalog\Requests\CategoryRequest;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;

class CategoryController
{
    /**
     * Category Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $categoryRepository
     */
    public function __construct(
        CategoryModelInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show Category Index Page.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = $this->categoryRepository->all();

        return view('avored::catalog.category.index')
            ->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $tabs = Tab::get('catalog.category');

        return view('avored::catalog.category.create')
            ->with(compact('tabs'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request->all());

        return redirect()->route('admin.category.index')
            ->with('successNotification', __(
                'avored::system.notification.store',
                ['attribute' => __('avored::catalog.category.title')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $tabs = Tab::get('catalog.category');

        return view('avored::catalog.category.edit')
            ->with(compact('category', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\CategoryRequest $request
     * @param \AvoRed\Framework\Database\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.category.index')
            ->with('successNotification', __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::catalog.category.title')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Category  $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.delete',
                ['attribute' => __('avored::catalog.category.title')]
            ),
        ]);
    }
}
