<?php

namespace AvoRed\Framework\Models\Database;

use AvoRed\Framework\Widget\Facade as Widget;
use AvoRed\Framework\Models\Traits\TranslatedAttributes;

class Page extends BaseModel
{
    use TranslatedAttributes;

    /**
     * Mass Assignable Page Model Attributes
     * @var array 
     */
    protected $fillable = ['name', 'slug', 'content', 'meta_title', 'meta_description'];

    /**
     * Widget Content Tag
     * @var array 
     */
    protected $contentTags = ['%%%', '%%%'];


    /**
     * Page Model Attribute which can be translated
     * @var array $translatedAttributes 
     */
    protected $translatedAttributes = ['name', 'slug', 'content' ,'meta_title', 'meta_description'];


    /**
     * Page Model has many translation values 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translations()
    {
        return $this->hasMany(PageTranslation::class);
    }

    public function getContentAttribute($content)
    {
        $pattern = sprintf('/(@)?%s\s*(.+?)\s*%s(\r?\n)?/s', $this->contentTags[0], $this->contentTags[1]);

        $callback = function ($matches) {
            $whitespace = empty($matches[3]) ? '' : $matches[3] . $matches[3];
            $widget = Widget::get($matches[2]);
            
            if (method_exists($widget, 'render')) {
                $widgetContent = $widget->render();
            } else {
                $widgetContent = '';
            }

            return $matches[1] ? substr($matches[0], 1) : "{$widgetContent}{$whitespace}";
        };

        return preg_replace_callback($pattern, $callback, $content);
    }

    public static function options($empty = true)
    {
        $model = new static();

        $options = $model->all()->pluck('name', 'id');
        if (true === $empty) {
            $options->prepend('Please Select', null);
        }
        return $options;
    }

    /**
     * Get the content for this page model
     * @return string $content
     */
    public function getContent()
    {
        return $this->getAttribute('content', $translated = true);
    }
    
    /**
     * Get Name of this Page Model
     * @return string $name
     */
    public function getName()
    {
        return $this->getAttribute('name', $translated = true);
    }

    /**
     * Get slug of this Page Model
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->getAttribute('slug', $translated = true);
    }
    /**
     * Get Meta title of this Page Model
     * @return string $metaTitle
     */
    public function getMetaTitle()
    {
        return $this->getAttribute('meta_title', $translated = true);
    }
    /**
     * Get Meta Description of this Page Model
     * @return string $metaDescription
     */
    public function getMetaDescription()
    {
        return $this->getAttribute('meta_description', $translated = true);
    }
}
