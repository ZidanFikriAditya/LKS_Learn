<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Society;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login (Request $request) {
        $validate = validation($request, [
            'id_card_number' => 'required|string',
            'password' => 'required|string'
        ]);

        if ($validate){
            return $validate;
        }


        $society = Society::where('id_card_number', $request->id_card_number)->where('password', md5($request->password))->first();
        if (!is_null($society)) {
            $token = md5($society->id_card_number);

            $society->login_tokens = $token;
            $society->update();

            return response()->json([
                'name' => $society->name,
                'born_date' => $society->born_date,
                'gender' => $society->gender,
                'address' => $society->address,
                'token' => $society->login_tokens,
                'regional' => $society->regional
            ]);
        }
        return response()->json(['message' => 'ID Card Number or Password incorrect']);
    }

    public function logout (Request $request) {
        $society = Society::where('login_tokens', $request->token)->first();

        if(is_null($society)) return response()->json(['message' => 'Invalid token'], 401);

        $society->login_tokens = null;
        $society->update();

        return response()->json([
            'message' => 'Logout success'
        ], 200);
    }
}
