<?php

function validation($request, $data)
{
    $val = \Illuminate\Support\Facades\Validator::make($request->all(),$data);

    if ($val->fails()) return returnData(['errors' => $val->errors()]);

}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
function returnMessage($message, $code = 200)
{
    return response()->json([
        'message' => $message
    ], $code);
}

/**
 * Store a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 */
function returnData(Array $data, $code = 200)
{
    return response()->json($data, $code);
}


function ziAuth($req) {
    $society = \App\Models\Society::where('login_tokens', $req->token)->first();

    if (is_null($society)) return returnMessage('Invalid Token', 401);

    return $society;
}

