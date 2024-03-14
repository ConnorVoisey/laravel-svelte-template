<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\OpenApi\RequestBodies\RegisterRequestBody;
use App\OpenApi\Responses\AuthenticateResponse;
use App\OpenApi\Responses\ErrorValidationResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class RegisteredUserController extends Controller
{
    /**
     * Register
     *
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @group Auth
     */
    #[OpenApi\Operation(tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: RegisterRequestBody::class)]
    #[OpenApi\Response(factory: AuthenticateResponse::class)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return response()->noContent();
    }
}
