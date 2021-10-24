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
        'origional_name'
    ];

    /**
     * Get the parent documentable model (user or product).
     */
    public function documentable()
    {
        return $this->morphTo();
    }
}
