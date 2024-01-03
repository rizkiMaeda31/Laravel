<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('wishlist_products', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable();
            $table->bigInteger('wishlistId');
            $table->bigInteger('productId');
            $table->timestamps();
            $table->softDeletes();
            $table->json('api')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wishlist_products');
        Schema::table('wishlist_products',function($table){
            $table->dropSoftDeletes();
        });
    }
};
