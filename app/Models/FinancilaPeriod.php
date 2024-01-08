<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancilaPeriod extends Model
{
    use HasFactory;

    protected static function booted()
    { 
        parent::boot();
        static::creating(function ($model) {
           $active_Finacial_period = FinancilaPeriod::where([
            'company_id'=>$model->company_id,
           'status'=>'Active'])->first();
              if($active_Finacial_period != null && $model->status == 'Active'){
               throw new \Exception("You have already an active financial period");
              }
        });

        static::updating(function ($model) {
            $active_Finacial_period = FinancilaPeriod::where(['company_id'=>$model->company_id,'status'=>'Active'])->first();
            if($model->status == 'Active'){   
            if($active_Finacial_period != null && $active_Finacial_period->id != $model->id){
                throw new \Exception("You have already an active financial period");
               }}
         });
    }
   
}
