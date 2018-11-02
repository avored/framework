<?php

namespace AvoRed\Framework\System\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use AvoRed\Framework\Models\Database\Configuration;
use AvoRed\Framework\Theme\Facade as Theme;
use AvoRed\Framework\System\DataGrid\ThemeDataGrid;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use ZipArchive;

class ThemeController extends Controller
{
    /**
     * Configuration Repository
     *
     * @var \AvoRed\Framework\Models\Repository\ConfigurationRepository $configurationRepository
     */
    protected $configurationRepository;

    /**
     * Set the Configuration Repository for Theme Controller
     *
     * @param \AvoRed\Framework\Models\Repository\ConfigurationRepository $configurationRepository
     */
    public function __construct(ConfigurationInterface $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * Display a listing of the theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $themes = Theme::all();

        $activeTheme = $this->configurationRepository->getValueByKey('active_theme_identifier');

        $siteCurrencyGrid = new ThemeDataGrid($themes, $activeTheme);

        return view('avored-framework::system.theme.index')
            ->with('themes', $themes)
            ->with('activeTheme', $activeTheme)
            ->with('dataGrid', $siteCurrencyGrid->dataGrid);
    }

    /**
     * Show the form for creating a new theme.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avored-framework::system.theme.create');
    }

    /**
     * Store a newly created theme in database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filePath = $this->handleImageUpload($request->file('theme_zip_file'));

        $zip = new ZipArchive();

        if ($zip->open(storage_path('app/public/' . $filePath)) === true) {
            $extractPath = base_path('themes');
            $zip->extractTo($extractPath);
            $zip->close();
        } else {
            throwException('Error in Zip Extract error.');
        }

        return redirect()->route('admin.theme.index');
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function activated($name)
    {
        $theme = Theme::get($name);

        try {
            $activeThemeConfiguration = $this->configurationRepository->getValueByKey('active_theme_identifier');

            if (null !== $activeThemeConfiguration) {
                $this->configurationRepository->setValueByKey('active_theme_identifier', $theme['identifier']);
            } else {
                $this->configurationRepository->create([
                    'configuration_key' => 'active_theme_identifier',
                    'configuration_value' => $theme['identifier'],
                ]);
            }

            $activeThemePath = $this->configurationRepository->findByKey('active_theme_path');
            if (null !== $activeThemePath) {
                $this->configurationRepository->setValueByKey('active_theme_path', str_replace(base_path() . '/', '', $theme['view_path']));
            } else {
                $this->configurationRepository->create([
                    'configuration_key' => 'active_theme_path',
                    'configuration_value' => str_replace(base_path() . '/', '', $theme['view_path']),
                ]);
            }

            $fromPath = $theme['asset_path'];
            $toPath = public_path('vendor/' . $theme['name']);

            //If Path Doesn't Exist it means its under development So no need to publish anything...
            if (File::isDirectory($fromPath)) {
                Theme::publishItem($fromPath, $toPath);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.theme.index');
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function deactivated($name)
    {
        if ('avored-default' === $name) {
            throw new Exception('You are not allowed to Deactivate AvoRed-Default Theme');
        }

        $theme = Theme::get('avored-default');

        try {
            $activeThemeConfiguration = $this->configurationRepository->findByKey('active_theme_identifier');

            if (null !== $activeThemeConfiguration) {
                $activeThemeConfiguration->update(['configuration_value' => $theme['name']]);
            } else {
                $this->configurationRepository->create([
                    'configuration_key' => 'active_theme_identifier',
                    'configuration_value' => $theme['name'],
                ]);
            }

            $activeThemePathConfiguration = $this->configurationRepository->findByKey('active_theme_path');
            if (null !== $activeThemePathConfiguration) {
                $activeThemePathConfiguration->update(['configuration_value' => $theme['view_path']]);
            } else {
                $this->configurationRepository->create([
                    'configuration_key' => 'active_theme_path',
                    'configuration_value' => $theme['name'],
                ]);
            }

            //Artisan::call('vendor:publish', ['--tag' => $name]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.theme.index');
    }

    /**
     * @param \Illuminate\Http\UploadedFile $file
     */
    public function handleImageUpload($file)
    {
        $path = $file->store('uploads/themes', 'avored');

        return $path;
    }
}
