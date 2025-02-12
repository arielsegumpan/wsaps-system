<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'url',
        'alt_text',
        'display_order',
        'is_primary'
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'display_order' => 'integer',
        'is_primary' => 'boolean'
    ];


    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
