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
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('slug');
            $table->string('brand')->nullable();
            $table->text('small_description')->nullable();
            $table->mediumText('description')->nullable();
            $table->integer('original_price');
            $table->integer('selling_price')->nullable();
            $table->integer('quantity')->nullable();
            $table->tinyInteger('trending')->default('0')->comment('0 => hidden & 1 = visible');
            $table->tinyInteger('status')->default('0')->comment('0 => hidden & 1 = visible');
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->mediumText('meta_description')->nullable();

            // Foreign Keys
            $table->foreign('category_id')->references('id')->on('categories');
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
