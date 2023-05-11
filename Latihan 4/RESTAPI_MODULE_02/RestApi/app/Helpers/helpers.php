<?php

use Illuminate\Support\Facades\Validator;

function validation ($request, $data) {
    $validate = Validator::make($request->all(), $data);

    if ($validate->fails()) {
        return response()->json([
            'errors' => $validate->errors()
        ], 422);
    }
}