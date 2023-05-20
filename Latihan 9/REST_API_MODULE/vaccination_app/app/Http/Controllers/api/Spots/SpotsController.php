<?php

namespace App\Http\Controllers\api\Spots;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpotVaccineResource;
use App\Models\Spot;
use App\Models\SpotVaccine;
use Illuminate\Http\Request;

class SpotsController extends Controller
{
    public function index () {
        $spotVaccine = Spot::latest()->get();

        return returnData([
            'spots' => SpotVaccineResource::collection($spotVaccine)
        ]);
    }

    public function spotById($id){
        if (request('date')){
            $ymd = date('Y-m-d', \request('date'));
        } else {
            $ymd = date('Y-m-d');
        }

        $spotVaccine = Spot::where('id', $id)->first();


        if (is_null($spotVaccine) )
        {
            return returnMessage('Data Not Found', 404);
        } else {
           if (date('Y-m-d', strtotime($spotVaccine->created_at)) === $ymd) {
               return returnData([
                   'date' => date('F d, Y', strtotime($spotVaccine->created_at)),
                   'spot' => [
                       'id' => $spotVaccine->id,
                       'spot' => [
                           'id' => $spotVaccine->id,
                           'name' => $spotVaccine->name,
                           'address' => $spotVaccine->address,
                           'serve' => $spotVaccine->serve,
                           'capacity' => $spotVaccine->capacity
                       ],
                       'vaccinations_count' => count($spotVaccine->vaccination)
                   ]
               ]);
           }
           return returnMessage('Data Not Found', 404);
        }
    }
}
