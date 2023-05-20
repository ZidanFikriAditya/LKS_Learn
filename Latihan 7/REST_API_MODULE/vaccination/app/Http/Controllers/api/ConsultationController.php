<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
use App\Models\Society;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    private $society;

    function __construct(Request $request) {
        $society = Society::where('login_tokens', $request->token)->first();
        $this->society = $society;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $societies = Consultation::latest()->get(['id', 'status', 'disease_history', 'current_symptoms', 'doctor_notes', 'doctor_id']);

        return response()->json([
            'consultations' => ConsultationResource::collection($societies)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validate = validation($request, [
            'disease_history' => 'required|string',
            'current_symptoms' => 'required|string'
        ]);

        if ($validate) return $validate;

        $consultation = new Consultation();
        $consultation->society_id = $this->society->id;
        $consultation->disease_history = $request->disease_history;
        $consultation->current_symptoms = $request->current_symptoms;
        $consultation->save();

        return response()->json([
            "message"=> "Request consultation sent successful"
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
