<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\StockSubCategory;
use App\Models\StockCategory;
use App\Models\Utils;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/register',[ApiController::class,'register']);
Route::post('auth/login',[ApiController::class,'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|Routes for stock categories
*/
Route::get('/stock-sub-categories', function (Request $request) {
    
   $q = $request->get('q');

   
   $company_id = $request->get('company_id');
   if($company_id == null){
       return response()->json([
           'data' => []
       ], 400);
   }
   $subCategories = StockSubCategory::where('company_id',$company_id)->where('name', 'like', "%$q%")
   ->orderBy('name','asc')
   ->limit(20)
   ->get();

  

   $data = [];
    foreach($subCategories as $subCategory){
        dd($subCategories);
         $data[] = [
              'id' => $subCategory->id,
              'text' => $subCategory->name,
         ];
    }
     
   return response()->json([
       'data' => $data
   ]);
});
