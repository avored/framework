<?php
namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Database\Contracts\PageModelInterface;
use AvoRed\Framework\Database\Models\Page;
use AvoRed\Framework\Cms\Requests\PageRequest;

class PageController
{
    /**
     * Page Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\PageRepository $pageRepository
     */
    protected $pageRepository;
    
    /**
     * Construct for the AvoRed install command
     * @param \AvoRed\Framework\Database\Repository\PageRepository $pageRepository
     */
    public function __construct(
        PageModelInterface $pageRepository
    ) {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->pageRepository->all();

        return view('avored::cms.page.index')
            ->with('pages', $pages);
    }

     /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored::cms.page.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\System\Requests\PageRequest $request
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('avored::cms.page.edit')
            ->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\System\Requests\PageRequest $request
     * @param \AvoRed\Framework\Database\Models\Page  $page
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return [
            'success' => true,
            'message' => __('avored::system.notification.delete', ['attribute' => 'Page'])
        ];
    }
}
