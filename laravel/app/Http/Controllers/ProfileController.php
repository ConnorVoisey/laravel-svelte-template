<?php

namespace App\Http\Controllers;

use App\OpenApi\Responses\UserResponse;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes\Operation;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;
use Vyuldashev\LaravelOpenApi\Attributes\Response;

#[PathItem]
class ProfileController extends Controller
{
    /**
     * Show Profile
     *
     * Displays the logged in users profile information.
     */
    #[Operation(tags: ['Requires Auth', 'Profile'])]
    #[Response(factory: UserResponse::class)]
    public function user()
    {
        return response()->json(Auth::user());
    }

    //TODO: add methods to update the users profile information
}
