<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockSubCategory extends Model
{
    public function stockCategory(){
        return $this->belongsTo(StockCategory::class);
    }

  
    


    use HasFactory;
}
