<?php

namespace AvoRed\Framework\Theme;

use RecursiveIteratorIterator;
use Symfony\Component\Yaml\Yaml;
use Illuminate\Support\Collection;
use League\Flysystem\MountManager;
use Illuminate\Support\Facades\File;
use Illuminate\Filesystem\Filesystem;
use League\Flysystem\Filesystem as Flysystem;
use League\Flysystem\Adapter\Local as LocalAdapter;
use Symfony\Component\Finder\Iterator\RecursiveDirectoryIterator;

class Manager
{
    /**
     * @var \Illuminate\Support\Collection $themeList
     */
    public $themeList;

    /**
     * @var \Illuminate\Filesystem\Filesystem $files
     */
    public $files;

    /**
     * @var bool $themeLoaded
     */
    public $themeLoaded = false;

    /**
     * Construct for the theme Manager
     *
     * @param \Illuminate\Filesystem\Filesystem $files
     */
    public function __construct(Filesystem $files)
    {
        $this->files = $files;
        $this->themeList = Collection::make([]);
    }

    /**
     * Return All available theme Collection
     * @return \Illuminate\Support\Collection $themeList
     */
    public function all()
    {
        if ($this->themeLoaded === false) {
            $this->loadThemes();
        }

        return $this->themeList;
    }

    protected function loadThemes()
    {
        $themePath = base_path('themes');

        if (File::exists($themePath)) {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($themePath, RecursiveDirectoryIterator::FOLLOW_SYMLINKS)
            );

            $iterator->setMaxDepth(2);
            $iterator->rewind();

            while ($iterator->valid()) {
                if (($iterator->getDepth() > 1) &&
                    $iterator->isFile() &&
                    ($iterator->getFilename() == 'register.yml')) {
                    $filePath = $iterator->getPathname();
                    $themeRegisterContent = File::get($filePath);

                    $data = Yaml::parse($themeRegisterContent);

                    $assetFolderName = isset($data['asset_folder_name']) ? $data['asset_folder_name'] : 'assets';

                    $data['view_path'] = $iterator->getPath() . DIRECTORY_SEPARATOR . 'views';
                    $data['asset_path'] = $iterator->getPath() . DIRECTORY_SEPARATOR . $assetFolderName;
                    $data['lang_path'] = base_path('resources/lang');

                    $this->themeList->put($data['identifier'], $data);
                }
                $iterator->next();
            }

            $this->themeLoaded = true;
        }

        return $this;
    }

    /**
     * Put the theme into an collection
     *
     * @param string $identifier
     * @param array $themeInfo
     * @return self $this
     */
    public function put($identifier, $themeInfo)
    {
        $this->themeList->put($identifier, $themeInfo);

        return $this;
    }

    /**
     * Get the theme into an collection
     *
     * @param string $identifier
     * @return array $themInfo
     */
    public function get($identifier)
    {
        if ($this->themeLoaded === false) {
            $this->loadThemes();
        }

        return $this->themeList->get($identifier);
    }

    /**
     * Get the ThemeInfo By Path
     *
     * @param string $path
     * @return array $themInfo
     */
    public function getByPath($path)
    {
        foreach ($this->themeList as $theme => $themeInfo) {
            $path1 = $this->pathSlashFix($path);
            $path2 = $this->pathSlashFix($themeInfo['path']);

            if ($path1 == $path2) {
                $actualTheme = $this->themeList[$theme];
                break;
            }
        }

        return $actualTheme;
    }

    /**
     * Publish theme asset to a public directory
     *
     * @param string $from
     * @param string $to
     * @return mixed $isSuccess|Exception
     */
    public function publishItem($from, $to)
    {
        if ($this->files->isDirectory($from)) {
            return $this->publishDirectory($from, $to);
        }

        throw new \Exception("Can't locate path: <{$from}>");
    }

    /**
     * Publish the directory to the given directory.
     *
     * @param  string  $from
     * @param  string  $to
     * @return void
     */
    protected function publishDirectory($from, $to)
    {
        $this->moveManagedFiles(new MountManager([
                                                     'from' => new Flysystem(new LocalAdapter($from)),
                                                     'to' => new Flysystem(new LocalAdapter($to)),
                                                 ]));
    }

    /**
     * Move all the files in the given MountManager.
     *
     * @param  \League\Flysystem\MountManager  $manager
     * @return void
     */
    protected function moveManagedFiles($manager)
    {
        foreach ($manager->listContents('from://', true) as $file) {
            if ($file['type'] === 'file' && (!$manager->has('to://' . $file['path']))) {
                $manager->put('to://' . $file['path'], $manager->read('from://' . $file['path']));
            }
        }
    }

    /**
     * Remove Slash and return back
     * @param string $path
     * @return string $path
     */
    protected function pathSlashFix($path)
    {
        return (DIRECTORY_SEPARATOR === '\\') ? str_replace('/', '\\', $path) : str_replace('\\', '/', $path);
    }
}
