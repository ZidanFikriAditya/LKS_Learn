<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function returnMessage ($message, $code =200){
        return response()->json([
            'message' => $message
        ], $code);
    }

    public function returnData (array $data, $code = 200){
        return response()->json($data, $code);
    }
}
