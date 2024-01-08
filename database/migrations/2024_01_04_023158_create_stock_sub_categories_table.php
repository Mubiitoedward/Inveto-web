<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
use App\Models\StockCategory;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stock_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class)->nullable();
            $table->foreignIdFor(StockCategory::class)->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('measurement_unit');

            $table->string('status')
            ->nullable()
            ->default("active");
            $table->bigInteger('current_quantity')->nullable()->default(0);
            $table->bigInteger('reorder_level')->nullable()->default(0);
            $table->bigInteger('buying_price')->nullable()->default(0);
            $table->bigInteger('selling_price')->nullable()->default(0);
            $table->bigInteger('expected_profit')->nullable()->default(0);
            $table->bigInteger('earned_profit')->nullable()->default(0); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_sub_categories');
    }
};
