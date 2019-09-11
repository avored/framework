<?php

namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Page;
use AvoRed\Framework\Cms\Requests\PageRequest;
use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Support\Facades\Widget;

class PageController
{
    /**
     * Page Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\PageRepository
     */
    protected $pageRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\PageModelInterface $pageRepository
     */
    public function __construct(
        PageModelInterface $pageRepository
    ) {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $pages = $this->pageRepository->all();

        return view('avored::cms.page.index')
            ->with(compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $widgets = Widget::options();
        $tabs = Tab::get('cms.page');

        return view('avored::cms.page.create')
            ->with(compact('tabs'))
            ->with('widgets', $widgets);
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\PageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PageRequest $request)
    {
        $this->pageRepository->create($request->all());

        return redirect()->route('admin.page.index')
            ->with('successNotification', __('avored::system.notification.store', ['attribute' => 'Page']));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Page $page
     * @return \Illuminate\View\View
     */
    public function edit(Page $page)
    {
        $tabs = Tab::get('cms.page');
        $widgets = Widget::options();

        return view('avored::cms.page.edit')
            ->with(compact('page', 'tabs'))
            ->with(compact('widgets'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Cms\Requests\PageRequest $request
     * @param \AvoRed\Framework\Database\Models\Page  $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());

        return redirect()->route('admin.page.index')
            ->with('successNotification', __('avored::system.notification.updated', ['attribute' => 'Page']));
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Database\Models\Page  $page
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return response()->json([
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => 'Page']),
        ]);
    }
}
