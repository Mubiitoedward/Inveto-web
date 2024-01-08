<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;
    public function getGalleryAttribute($value){
        if($value != null&& strlen($value) > 3){
           return json_decode($value);
        }
        return [];
    }
    public function setGalleryAttribute($value){
        $this->attributes['gallery'] = json_encode($value, true);
    }
}
