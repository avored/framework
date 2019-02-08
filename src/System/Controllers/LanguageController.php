<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\System\DataGrid\LanguageDataGrid;
use AvoRed\Framework\Models\Database\Language;
use AvoRed\Framework\System\Requests\LanguageRequest;
use AvoRed\Framework\Models\Contracts\LanguageInterface;
use Illuminate\Support\Collection;

class LanguageController extends Controller
{
   
    /**
     * Language Repository
     * @var \AvoRed\Framework\Models\Repository\LanguageRepository
     */
    protected $repository;

    public function __construct(LanguageInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataGrid = new LanguageDataGrid($this->repository->query()->orderBy('id', 'desc'));

        return view('avored-framework::system.language.index')->with('dataGrid', $dataGrid->dataGrid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::system.language.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\LanguageRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LanguageRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.language.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \AvoRed\Framework\Models\Database\Language $Language
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        return view('avored-framework::system.language.edit')
            ->with('model', $language);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \AvoRed\Framework\System\Requests\LanguageRequest $request
     * @param \AvoRed\Framework\Models\Database\Language $Language
     * @return \Illuminate\Http\Response
     */
    public function update(LanguageRequest $request, Language $language)
    {
        $language->update($request->all());

        return redirect()->route('admin.language.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \AvoRed\Framework\Models\Database\Language $Language
     * @return \Illuminate\Http\Response
     */
    public function destroy(Language $language)
    {
        $language->delete();
        return redirect()->route('admin.language.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \AvoRed\Framework\Models\Database\Language $Language
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        return view('avored-framework::system.language.show')->with('language', $language);
    }
}
