<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Dflydev\DotAccessData\Util;

use App\Models\Utilities;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ApiController extends BaseController
{


    public function Login(Request $request){
      
        if($request->email==null){
            Utilities::error('email is required');
        }
        // if(!filter_var($request->email==null, FILTER_VALIDATE_EMAIL)){
        //     Utilities::error('email is invalid');
        // }
    
        if($request->password==null){
            Utilities::error('Password is required');
        }
        
        $user = User::where($request->email)->first();
        if($user==null){
            Utilities::error("Account Not Found");
        }
        if(password_verify($request->password, $user->password)==false){
            Utilities::error("Invalid Password");
        }

        $company=Company::find($user->company_id);
        if($company == null){
            Utilities::error("company not found");
        }

        Utilities::success([
            'user'=>$user,
            'company'=>$company,
            
        ],"Login Successful",);



    
    }



   public function Register(Request $request){
    if($request->first_name==null){
        Utilities::error('first name is required');
    }
    if($request->last_name==null){
        Utilities::error('lastname is required');
    }
    if($request->email==null){
        Utilities::error('email is required');
    }
    // if(!filter_var($request->email==null, FILTER_VALIDATE_EMAIL)){
    //     Utilities::error('email is invalid');
    // }

    $u = User::where('email',$request->email)->first();
    if($u!==null){
        Utilities::error('email is already registered');
    }
    if($request->password==null){
        Utilities::error('Password is required');
    }
    if($request->company_name==null){
        Utilities::error('company name is required');
    }
    // if($request->currency==null){
    //     Utilities::error('currency is required');
    // }

    $new_user = new User();
    $new_user->first_name = $request->first_name;
    $new_user->last_name = $request->last_name;
    $new_user->username = $request->email;
    $new_user->email = $request->email;
    $new_user->phone = $request->phone;
    $new_user->last_name = password_hash($request, PASSWORD_DEFAULT);
    $new_user->name = $request->first_name . " ".$request->last_name;
    $new_user->company_id =1;
    $new_user->status = "active";
    $new_user->save();

    $registered_user =User::find($new_user->id);
    if($registered_user==null){
        Utilities::error('Failed to register User');
    }
    Utilities::success($registered_user,'User Registered Successefully');

$company = new Company();
$company->owner_id = $registered_user->owner_id;
$company->name = $request->company_name;
$company->email = $request->email;
$company->status ='active';
// $company->status = 'Active';

try{
    $company->save();

}catch(\Exception $e){
   Utilities::error($e->getMessage()); 
}
$registered_company = Company::find($company->id);
if($registered_company == null){
    Utilities::error('failed to register company');
}



DB::table('admin_role_users')->insert([
    'user_id' => $registered_user->id,
    'role_id' => 1,
]);
Utilities::success([
    'user'=> $registered_user,
    'company'=>$registered_company,

], "registration successful");

    die('success');


// id	
// username	
// password	
// name	
// avatar	
// remember_token	
// created_at	
// updated_at	
// company_id	
// First_name	
// last_name	
// status	
// phone	
// address	
// about	
// email

}
}
