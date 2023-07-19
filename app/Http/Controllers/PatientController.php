<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientCollection;
use App\Models\Patient;
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

        return $response->json();
    }
}
