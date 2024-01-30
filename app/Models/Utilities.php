<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Utilities{

        public static function success($data, $message)
    {
        //set header response to json
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'code' => 1,
            'message' => $message,
            'data' => $data,
        ]);
        // die();
    }

    public static function error($message)
    {
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'code' => 0,
            'message' => $message,
            'data' => null,
        ]);
        
    }

}