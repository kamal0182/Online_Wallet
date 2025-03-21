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
        schema::create('wallets' , function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->integer('seriale');
            $table->double('balance');
            $table->id('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::drop('wallets');
    }
};
