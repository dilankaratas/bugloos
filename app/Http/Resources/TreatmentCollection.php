<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TreatmentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray($request): array
    {
        /**
         * Transforms the treatment collection into an array, including 'id' and 'name' properties for each treatment.
         */

        return $this->collection->map(function ($data) {
            return [
                'id' => $data->id,
                'name' => $data->name,
            ];
        })->toArray();
    }
}
