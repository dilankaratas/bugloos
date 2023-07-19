<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientCollection;
use App\Models\Patient;
use App\Models\Treatment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PatientController extends Controller
{
    /**
     * Return a JSON response containing all patients in the form of a PatientCollection
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        return response()->json(new PatientCollection(Patient::all()));
    }

    /**
     * Makes an HTTP request to retrieve patients' data from the specified API endpoint.
     * The request is authenticated using a bearer token and the response is returned as JSON.
     */


    public function save(Request $request)
    {
        $response = Http::timeout(2)
            ->withOptions(['verify' => false])
            ->withHeaders(['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $request->token])
            ->get('http://127.0.0.1:8001/api/patients');

        $mappingData = yaml_parse_file(base_path() . '/mapping.yaml');

        $models = [
            'patients' => new Patient(),
            'treatments' => new Treatment()
        ];

        $databaseData = [];
        foreach ($response->json() as $key => $item) {
            $id = $item['id'];
            foreach ($mappingData as $mapping) {
                $apiFieldName = $mapping['apiField'];
                $data = $item[$apiFieldName];

                if (isset($mapping['array']))
                {
                    foreach ($mapping['array'] as $relation)
                    {
                        $db = $relation['db'];
                        $apiFieldName = $relation['apiField'];
                        foreach ($data as $index => $value)
                        {
                            $databaseData[$db['table']][$index][$db['field']] = $value[$apiFieldName];
                        }

                    }
                }
                else
                {
                    $db = $mapping['db'];
                    $databaseData[$db['table']][$key][$db['field']] = $data;
                }
            }
        }

        foreach ($databaseData as $table => $data)
        {
            $model = $models[$table];
            foreach ($data as $record)
            {
                foreach ($record as $column => $value)
                {
                    $model->{$column} = $value;
                }
                $model->save();
            }
        }
    }
}
