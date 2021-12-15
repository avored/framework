<?php
namespace AvoRed\Framework\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends BaseModel
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'id',
        'path',
        'mime_type',
        'size',
        'origional_name',
        'documentable_id',
        'documentable_type',
    ];

    /**
     * Get the parent documentable model (user or product).
     */
    public function documentable()
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        if ($this->path) {
            return asset($this->path);
        }

        return null;
    }
}
