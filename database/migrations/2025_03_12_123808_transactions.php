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
        schema::create('transactions',function(Blueprint $table){
            $table->uuid('id')->primary();
            $table->double('amount');
            $table->integer('sender');
            $table->foreign('sender')->references('id')->on('users');
            $table->integer('receiver');
            $table->foreign('receiver')->references('id')->on('users');
            $table->integer('admin')->nullable();
            $table->foreign('admin')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('transactions');
    }
};
