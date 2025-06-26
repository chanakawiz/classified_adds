<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ad extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
        'contact_email',
        'contact_phone',
    ];

    /**
     * Get the category that owns the ad.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
