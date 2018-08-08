<?php

namespace AvoRed\Framework\Cms\Controllers;

use AvoRed\Framework\Models\Database\Page;
use AvoRed\Framework\Widget\Facade as Widget;
use AvoRed\Framework\Cms\DataGrid\PageDataGrid;
use AvoRed\Framework\Cms\Requests\PageRequest;
use AvoRed\Framework\Models\Contracts\PageInterface;
use AvoRed\Framework\System\Controllers\Controller;

class PageController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\PageRepository
     */
    protected $repository;

    public function __construct(PageInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageGrid = new PageDataGrid($this->repository->query()->orderBy('id', 'desc'));

        return view('avored-framework::cms.page.index')->with('dataGrid', $pageGrid->dataGrid);
    }

    /**
     * Show the form for creating a new page.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $widgetOptions = Widget::allOptions();

        return view('avored-framework::cms.page.create')
            ->with('widgetOptions', $widgetOptions);
    }

    /**
     * Store a newly created page in database.
     *
     * @param \AvoRed\Frameowork\Cms\Requests\PageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PageRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.page.index');
    }

    /**
     * Show the form for editing the specified page.
     *
     * @param \AvoRed\Framework\Models\Database\Page $page
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        $widgetOptions = Widget::allOptions();

        return view('avored-framework::cms.page.edit')
            ->with('model', $page)
            ->with('widgetOptions', $widgetOptions);
    }

    /**
     * Update the specified page in database.
     *
     * @param \AvoRed\Framework\Cms\Requests\PageRequest $request
     * @param \AvoRed\Framework\Models\Database\Page $page
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());
        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified page from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.page.index');
    }
}
