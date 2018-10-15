<?php

namespace AvoRed\Framework\Models\Database;

class Country extends BaseModel
{
    protected $fillable = [
        'name',
        'code',
        'phone_code',
        'currency_code',
        'currency_symbol',
        'lang_code'
    ];

    public function states()
    {
        return $this->hasMany(State::class);
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
}
