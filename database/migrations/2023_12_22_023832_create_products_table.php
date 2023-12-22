<?php

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
            $table->string("ProductName",255);
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("brand_id");
            $table->text("ProductDescription");
            $table->unsignedTinyInteger("ProductStatus");
            $table->string("Featured",200);
            $table->integer("Price");
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
