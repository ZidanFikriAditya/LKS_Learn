<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Society;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $validate = validation($request, [
            'id_card_number' => ['required', 'string', 'max:8'],
            'password' => ['required', 'string']
        ]);

        if ($validate) return$validate;

        $society = Society::where('id_card_number', $request->id_card_number)->where('password', md5($request->password))->first();

        if (is_null($society)) return returnMessage('ID Card Number or Password incorrect', 401);

        $token = md5($society->id_card_number);

        $society->login_tokens = $token;
        $society->update();

        return returnData([
            'name' => $society->name,
            'born_date' => $society->born_date,
            'gender' => $society->gender,
            'address' => $society->address,
            'token' => $society->login_tokens,
            'regional' => $society->regional
        ]);
    }

    public function logout (Request $request) {
        $society = \App\Models\Society::where('login_tokens', $request->token)->first();

        if (is_null($society)) return returnMessage('Invalid Token', 401);

        $society->login_tokens = null;
        $society->save();

        return returnMessage('Logout success', 200);

    }
}
