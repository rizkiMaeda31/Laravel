<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $primaryKey='wishlistId';
    public function up(): void
    {
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable();
            $table->string('name');
            $table->integer('userId');
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
        Schema::dropIfExists('wishlists');
        Schema::table('wishlists',function($table){
            $table->dropSoftDeletes();
        });
    }
};
