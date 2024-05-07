<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $frontendUrl = config('app.frontend_url');
        $apiKey = config('app.api_key');

        $response = Http::withHeaders([
            'X-API-Key' => $apiKey,
        ])->get($frontendUrl . '/users');

        $userCount = 0;

        if ($response->successful()) {
            $responseData = $response->json();
            $users = $responseData['users'];
            $userCount = count($users);
        }

        // Pass the user count to the view
        return view('dashboard', compact('userCount'));
    }
}
