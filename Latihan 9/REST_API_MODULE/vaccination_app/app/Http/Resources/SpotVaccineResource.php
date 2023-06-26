<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpotVaccineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $arr = [
            'Sinovac' => false,
            'AstraZeneca' =>  false,
            'Moderna' => false,
            'Pfizer' => false,
            'Sinnopharm' => false,
        ];
        foreach ($this->spotVaccine as $key => $value){
                if ($value->vaccine){
                    $arr[$value->vaccine->name] = true;
                }
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'serve' => $this->serve,
            'capacity' => $this->capacity,
            'available_vaccines' => $arr
        ];
    }
}
