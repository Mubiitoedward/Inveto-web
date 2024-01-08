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
        Schema::table('admin_users', function (Blueprint $table) {
            $table->string('company_id')
            ->nullable();
            $table->string('First_name')
            ->nullable();
            $table->string('last_name')
            ->nullable();
            $table->string('status')
            ->nullable();
            $table->string('phone')
            ->nullable();
            $table->string('address')
            ->nullable();
            $table->string('about')
            ->nullable();


            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_users', function (Blueprint $table) {
            //
        });
    }
};
