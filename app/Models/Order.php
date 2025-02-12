<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'product_id',
        'order_number',
        'order_total_price',
        'order_status',
        'order_currency',
        'shipping_address_id',
        'billing_address_id',
        'is_billing_same_as_shipping',
        'order_notes',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_billing_same_as_shipping' => 'boolean',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function shippingAddress() : BelongsTo
    {
        return $this->belongsTo(Address::class, 'shipping_address_id');
    }

    public function billingAddress() : BelongsTo
    {
        return $this->belongsTo(Address::class, 'billing_address_id');
    }
}
