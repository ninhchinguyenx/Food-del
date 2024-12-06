<?php

use App\Models\Category;
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
            $table->string('name');
            $table->string('detail');
            $table->float('price_regular');
            $table->float('price_sale');
            $table->integer('quantity');
            $table->string('sku');
            $table->string('slug');
            $table->boolean('is_active');
            $table->boolean('is_show_home');
            $table->string('description');
            $table->string('more_details');
            $table->string('img_thumbnail');
            $table->foreignIdFor(Category::class)->constrained();
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
