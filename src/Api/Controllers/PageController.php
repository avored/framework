<?php

namespace AvoRed\Framework\Api\Controllers;

use Illuminate\Http\JsonResponse;
use AvoRed\Framework\Models\Database\Page;
use AvoRed\Framework\Api\Controllers\Controller;
use AvoRed\Framework\Api\Resources\Page\PageResource;
use AvoRed\Framework\Api\Resources\Page\PageCollectionResource;
use AvoRed\Framework\Cms\Requests\PageRequest;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(10);

        return new PageCollectionResource($pages);
    }

    public function store(PageRequest $request)
    {
        $page = Page::create($request->all());

        return (new PageResource($page));
    }

    public function show(Page $page)
    {
        return new PageResource($page);
    }

    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());
        return new PageResource($page);
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return JsonResponse::create(null, 204);
    }
}
