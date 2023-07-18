<?php

namespace App\Http\Controllers;

use App\Http\Resources\PatientCollection;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PatientController extends Controller
{
    public function index()
    {
        return response()->json(new PatientCollection(Patient::all()));
    }

    public function save(Request $request)
    {
        $response = Http::timeout(2)
            ->withOptions(['verify' => false])
            ->withHeaders(['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $request->token])
            ->get('http://127.0.0.1:8001/api/patients');

        return $response->json();
    }
}
