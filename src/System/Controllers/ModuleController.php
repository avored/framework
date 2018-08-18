<?php

namespace AvoRed\Framework\System\Controllers;

use AvoRed\Framework\Modules\Facade as Module;
use AvoRed\Framework\System\Requests\UploadModuleRequest;
use ZipArchive;
use AvoRed\Framework\System\DataGrid\ModuleDataGrid;

class ModuleController extends Controller
{
    /**
     * Display a listing of the modules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::all();
        $moduleDataGrid = new ModuleDataGrid($modules);

        return view('avored-framework::system.module.index')
            ->with('modules', $modules)
            ->with('dataGrid', $moduleDataGrid->dataGrid);
    }

    /**
     * Display upload module forms
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::system.module.create');
    }

    /**
     * Store and Extract upload module zip files
     *
     * @param \AvoRed\Framework\Http\Requests\UploadModuleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UploadModuleRequest $request)
    {
        $path = storage_path('app/' . $request->module_zip_file->store('public/uploads/modules'));

        $zip = new ZipArchive;

        if ($zip->open($path) === true) {
            $extractPath = base_path('modules');
            $zip->extractTo($extractPath);
            $zip->close();

            return redirect()->route('admin.module.index')
                        ->with('notificationText', 'Module Extracted successfully');
        } else {
            return redirect()
                    ->back()
                    ->with('errorNotificationText', 'There is some issue: Please check your permission and try again later!');
        }
    }
}
