<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    public function test()
    {
        $frontendUrl = config('app.frontend_url');
        $apiKey = config('app.api_key');
        $response = Http::withHeaders([
            'X-API-Key' => $apiKey,
        ])->get($frontendUrl . '/users');
        if ($response->successful()) {
            $users = $response->json();

            return response()->json(['users' => $users]);
        } else {
            return response()->json(['error' => 'Failed to retrieve users'], $response->status());
        }
    }


    public function index()
    {
        $frontendUrl = config('app.frontend_url');
        $apiKey = config('app.api_key');

        $response = Http::withHeaders([
            'X-API-Key' => $apiKey,
        ])->get($frontendUrl . '/users');

        $users = [];

        if ($response->successful()) {
            $responseData = $response->json();
            $users = $responseData['users'];
        }

        $search = request()->query('search');

        if ($search) {
            $users = array_filter($users, function ($user) use ($search) {
                return strpos(strtolower($user['email']), strtolower($search)) !== false ||
                       strpos(strtolower($user['firstname']), strtolower($search)) !== false ||
                       strpos(strtolower($user['lastname']), strtolower($search)) !== false ||
                       strpos(strtolower($user['mobile_number']), strtolower($search)) !== false ||
                       // Add other fields for search as needed
                       strpos(strtolower($user['usertype']), strtolower($search)) !== false ||
                       strpos(strtolower($user['status']), strtolower($search)) !== false;
            });
        }

        $perPage = 10; // Change this value according to your preference
        $currentPage = request()->query('page', 1);

        $totalUsers = count($users);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedUsers = array_slice($users, $offset, $perPage);

        $paginatedUsers = new LengthAwarePaginator(
            $paginatedUsers,
            $totalUsers,
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => ['search' => $search]]
        );

        return view('admin.users.index', compact('paginatedUsers'));
    }


}
