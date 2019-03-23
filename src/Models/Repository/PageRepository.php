<?php

namespace AvoRed\Framework\Models\Repository;

use AvoRed\Framework\Models\Database\Page;
use AvoRed\Framework\Models\Contracts\PageInterface;
use Illuminate\Support\Facades\Session;
use AvoRed\Framework\Models\Database\Language;
use AvoRed\Framework\Models\Database\PageTranslation;

class PageRepository implements PageInterface
{
    /**
     * Find a Page by given Id
     *
     * @param $id
     * @return \AvoRed\Framework\Models\Page
     */
    public function find($id)
    {
        return Page::find($id);
    }

    /**
     * Get all Page
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return Page::all();
    }

    /**
     * Paginate Page
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate($noOfItem = 10)
    {
        return Page::paginate($noOfItem);
    }

    /**
     * Get a Page Query Builder Object
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Page::query();
    }

    /**
     * Create a Page Query
     *
     * @return \AvoRed\Framework\Models\Menu
     */
    public function create($data)
    {
        return Page::create($data);
    }


    /**
     * Update a Page
     *
     * @param \AvoRed\Framework\Models\Database\Page $page
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\Page
     */
    public function update(Page $page, array $data)
    {
        if (Session::has('multi_language_enabled')) {
            $languageId = $data['language_id'];
            $languaModel = Language::find($languageId);
            
            if ($languaModel->is_default) {
                return $page->update($data);
            } else {
                
                $translatedModel = $page
                    ->translations()
                    ->whereLanguageId($languageId)
                    ->first();
                if (null === $translatedModel) {
                    return PageTranslation::create(
                        array_merge($data, ['page_id' => $page->id])
                    );
                } else {
                    $translatedModel->update(
                        $data,
                        $page->getTranslatedAttributes()
                    );

                    return $translatedModel;
                }

            }
        } else {
            return $page->update($data);
        }
    }

}
