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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('owner_id');
            $table->string('name');
            $table->string('email')
            ->nullable();
            $table->string('logo')
            ->nullable();
            $table->string('website')
            ->nullable();
            $table->string('phone')
            ->nullable();
            $table->string('address')
            ->nullable();
            $table->string('about')
            ->nullable();
            $table->string('facebook')
            ->nullable();
            $table->string('twitter')
            ->nullable();
        
            $table->string('pobox')
            ->nullable();
            $table->string('color')
            ->nullable();
            $table->string('slogan')
            ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
