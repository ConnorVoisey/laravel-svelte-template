<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Show Profile
     *
     * Displays the logged in users profile information.
     */
    public function user()
    {
        // $user = Auth::user();

        DB::listen(function ($query) {
            Log::debug($query->sql); // Log the SQL query
            Log::debug($query->bindings); // Log the query bindings
            Log::debug($query->time); // Log the query execution time
        });

        $permissions = Auth::user()->getPermissionsViaRoles()->map(fn ($per) => $per->name);
        $user = Auth::user();
        $userArr = Auth::user()->toArray();
        $userArr['permissions'] = $permissions;
        $userArr['roles'] = $user->roles->map(fn ($role) => $role->name);

        return response()->json($userArr);
    }
}
