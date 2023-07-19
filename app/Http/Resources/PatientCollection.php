<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PatientCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        /**
         * Convert the patient collection to an array containing certain properties.
         */
        return $this->collection->map(function ($data) {
            return [
                'id' => $data->id,
                'name' => $data->name,
                'surname' => $data->surname,
                'email' => $data->email,
                'treatments' => new TreatmentCollection($data->treatments),
            ];
        })->toArray();
    }
}

