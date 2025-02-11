<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'prod_weight_value',
        'prod_weight_unit',
        'prod_height_value',
        'prod_height_unit',
        'prod_width_value',
        'prod_width_unit',
        'prod_depth_value',
        'prod_depth_unit',
        'prod_volume_value',
        'prod_volume_unit',
    ];


    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'prod_backorder' => 'boolean',
        'prod_requires_shipping' => 'boolean',
        'prod_published_at' => 'date',
    ];
}
