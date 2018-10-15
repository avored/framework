<?php

namespace AvoRed\Framework\Models\Database;

class UserGroup extends BaseModel
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_default'
    ];

    /**
     * One User Group has Many User Attahced with it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMAny
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
