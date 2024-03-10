<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\OpenApi\RequestBodies\AuthenticateRequestBody;
use App\OpenApi\Responses\AuthenticateResponse;
use App\OpenApi\Responses\ErrorUnauthenticatedResponse;
use App\OpenApi\Responses\ErrorValidationResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]
class AuthenticatedSessionController extends Controller
{
    /**
     * Login
     *
     * Handle an incoming authentication request.
     *
     * @group Auth
     */
    #[OpenApi\Operation(tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: AuthenticateRequestBody::class)]
    #[OpenApi\Response(factory: AuthenticateResponse::class)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Logout
     *
     * Destroy an authenticated session.
     *
     * @group Auth
     */
    #[OpenApi\Operation(tags: ['Auth'])]
    #[OpenApi\RequestBody(factory: AuthenticateRequestBody::class)]
    #[OpenApi\Response(factory: AuthenticateResponse::class)]
    #[OpenApi\Response(factory: ErrorValidationResponse::class, statusCode: 422)]
    #[OpenApi\Response(factory: ErrorUnauthenticatedResponse::class, statusCode: 401)]
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
