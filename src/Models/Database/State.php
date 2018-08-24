<?php

namespace AvoRed\Framework\Models\Database;

class State extends BaseModel
{
    protected $fillable = [
        'country_id',
        'name',
        'code',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public static function getStateOptions($name = 'name', $id = 'id')
    {
        $model = new static();
        $options = $model->all()->pluck($name, $id);

        return $options;
    }
}
