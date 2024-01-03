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
    protected $primaryKey='logId';
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->uuid()->nullable();
            $table->string('task');
            $table->string('status');
            $table->json('detail')->nullable();
            $table->timestamps();
            $table->json('api')->nullable();;
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
        Schema::table('logs',function($table){
            $table->dropSoftDeletes();
        });
    }
};
