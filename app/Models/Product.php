<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'brand_id',
        'prod_name',
        'prod_slug',
        'prod_sku',
        'prod_barcode',
        'prod_desc',
        'prod_qty',
        'prod_security_stock',
        'is_featured',
        'is_visible',
        'prod_old_price',
        'prod_price',
        'prod_cost',
        'prod_type',
        'prod_backorder',
        'prod_requires_shipping',
        'prod_published_at',
        'prod_seo_title',
        'prod_seo_description',
        'prod_dimensions'
    ];


    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'prod_backorder' => 'boolean',
        'prod_requires_shipping' => 'boolean',
        'prod_published_at' => 'datetime',
        'prod_dimensions' => 'array', // Cast JSON to array
    ];

    public function productCategories() : BelongsToMany
    {
        return $this->belongsToMany(ProductCategory::class, 'product_product_category', 'product_id', 'product_category_id')->withTimestamps();
    }


    public function productImages() : HasMany
    {
        return $this->hasMany(ProductImage::class);
    }
}
