<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Society;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateController extends Controller
{
    public function login(Request $request)
    {
        $validate = validation($request, [
            'id_card_number' => 'required',
            'password' => 'required|string'
        ]);

        if ($validate) {
            return $validate;
        }

        $society = Society::where('id_card_number', $request->id_card_number)->first();
        if (is_null($society)) return $this->returnMessage('ID card number not valid');

        if ($society->password === md5($request->password)) {
            $token = md5($society->id_card_number);

            $society->login_tokens = $token;
            $society->update();

            return $this->returnData([
                'token' => $society->login_tokens,
                'user' => $society
            ]);
        }

        return $this->returnMessage('Unauthenticated', 401);
    }

    public function  logout(){
        $auth = auth()->user();

        $auth->login_tokens = null;
        $auth->update();

        return $this->returnMessage('Success Log out', 200);
    }
}
