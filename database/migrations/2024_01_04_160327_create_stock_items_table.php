<?php

use App\Models\Company;
use App\Models\FinancilaPeriod;
use App\Models\StockCategory;
use App\Models\StockSubCategory;
use App\Models\User;
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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Company::class);
            $table->foreignIdFor(User::class,'created_by_id');
            $table->foreignIdFor(StockCategory::class);
            $table->foreignIdFor(StockSubCategory::class);
            $table->foreignIdFor(FinancilaPeriod::class);
            $table->string('name');
            $table->string('sku');
            $table->string('generate_sku');
            $table->string('update_sku');
            $table->string('barcode');
            $table->string('description');
            $table->string('image');
            $table->string('gallery');

            $table->bigInteger('buying_price')
            ->default(0);
            $table->bigInteger('selling_price')
            ->default(0);
            $table->bigInteger('orriginal_quantity')
            ->default(0);
            $table->bigInteger('current_quantity')
            ->default(0);
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
