<?php

namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Cms\Requests\PageRequest;
use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Models\Page;
use AvoRed\Framework\Tab\Tab;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class PageController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     *
     * @param PageRepositroy $repository
     */
    public function __construct(
        PageModelInterface $repository
    ) {
        $this->pageRepository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->pageRepository->paginate();

        return view('avored::cms.page.index')
        ->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabs = Tab::get('cms.page');

        return view('avored::cms.page.create')
            ->with('tabs', $tabs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $page = $this->pageRepository->create($request->all());

        return redirect(route('admin.page.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $tabs = Tab::get('cms.page');

        return view('avored::cms.page.edit')
            ->with('page', $page)
            ->with('tabs', $tabs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PageRequest  $request
     * @param Page $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());

        return redirect(route('admin.page.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return new JsonResponse([
            'success' => true,
            'message' => __('avored::system.success_delete_message', ['attribute' => __('avored::system.page')]),
        ]);
    }
}
