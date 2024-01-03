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

    public function up(): void
    {
        Schema::create('filestorages', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable();
            $table->string('filename')->default('');
            $table->string('path')->default('');
            $table->bigInteger('userId');
            $table->timestamps();
            $table->json('api')->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filestorages');
        Schema::table('filestorages',function($table){
            $table->dropSoftDeletes();
        });
    }
};
