<?php

function validation ($request, $data) {
    $validate = \Illuminate\Support\Facades\Validator::make($request->all(), $data);

    if ($validate->fails()){
        return response()->json([
            'errors' => $validate->errors()
        ], 422);
    }
}
