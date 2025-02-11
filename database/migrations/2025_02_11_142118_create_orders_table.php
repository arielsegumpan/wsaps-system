<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();
            $table->foreignIdFor(Product::class)->constrained()->nullOnDelete();
            $table->string('order_number', 32)->unique();
            $table->decimal('order_total_price', 12, 2)->nullable();
            $table->enum('order_status', ['new', 'processing', 'shipped', 'delivered', 'cancelled'])->default('new');
            $table->string('order_currency');
            $table->decimal('order_shipping_price')->nullable();
            $table->string('order_shipping_method')->nullable();
            $table->text('order_notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
