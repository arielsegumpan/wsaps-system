<?php

use App\Models\Brand;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Brand::class)->nullable()->constrained()->nullOnDelete();
            $table->string('prod_name');
            $table->string('prod_slug')->nullable()->unique();
            $table->string('prod_sku')->nullable()->unique();
            $table->string('prod_barcode')->nullable()->unique();
            $table->longText('prod_desc')->nullable();
            $table->unsignedBigInteger('prod_qty')->default(0);
            $table->unsignedBigInteger('prod_security_stock')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_visible')->default(0);
            $table->decimal('prod_old_price', 10, 2)->nullable();
            $table->decimal('prod_price', 10, 2)->nullable();
            $table->decimal('prod_cost', 10, 2)->nullable();
            $table->enum('prod_type', ['deliverable', 'downloadable'])->nullable();
            $table->boolean('prod_backorder')->default(false);
            $table->boolean('prod_requires_shipping')->default(false);
            $table->date('prod_published_at')->nullable();
            $table->string('prod_seo_title', 60)->nullable();
            $table->string('prod_seo_description', 160)->nullable();
            $table->decimal('prod_weight_value', 10, 2)->nullable()
                ->default(0.00)
                ->unsigned();
            $table->string('prod_weight_unit')->default('kg');
            $table->decimal('prod_height_value', 10, 2)->nullable()
                ->default(0.00)
                ->unsigned();
            $table->string('prod_height_unit')->default('cm');
            $table->decimal('prod_width_value', 10, 2)->nullable()
                ->default(0.00)
                ->unsigned();
            $table->string('prod_width_unit')->default('cm');
            $table->decimal('prod_depth_value', 10, 2)->nullable()
                ->default(0.00)
                ->unsigned();
            $table->string('prod_depth_unit')->default('cm');
            $table->decimal('prod_volume_value', 10, 2)->nullable()
                ->default(0.00)
                ->unsigned();
            $table->string('prod_volume_unit')->default('l');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
