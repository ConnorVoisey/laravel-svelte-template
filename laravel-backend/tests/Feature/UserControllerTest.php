<?php

use App\Models\User;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Testing\TestResponse;
use Osteel\OpenApi\Testing\ValidatorBuilder;
use Psr\Http\Message\ResponseInterface;

use function Pest\Laravel\actingAs;

function convertTestResponseToPsrResponse(TestResponse $testResponse): ResponseInterface
{
    $body = new Stream(fopen('php://temp', 'wb+'));
    $body->write($testResponse->getContent());

    // Create PSR-7 Response
    $psrResponse = new Response(
        $testResponse->getStatusCode(),
        $testResponse->headers->all(),
        $body
    );

    return $psrResponse;
}

beforeEach(function () {
    Artisan::call('db:seed');
    $this->user = User::factory()->create();
    $this->validator = ValidatorBuilder::fromYamlFile('public/openapi.yaml')->getValidator();
});

test('list users', function () {
    $response = actingAs($this->user)->get('/users');

    $response->assertStatus(200);
    $isValid = $this->validator->get(convertTestResponseToPsrResponse($response), '/users');

    expect($isValid)->toBe(true);
});

test('store user', function () {
    $userBody = User::factory()->definition();
    $userBody['password_confirmation'] = $userBody['password'];
    $userBody['role_name'] = 'admin';

    $response = actingAs($this->user)->postJson('/users', $userBody);

    $response->assertStatus(201);
    $this->assertDatabaseHas('users', ['email' => $userBody['email']]);
    $isValid = $this->validator->post(convertTestResponseToPsrResponse($response), '/users');

    expect($isValid)->toBe(true);
});

test('show user', function () {
    $user = User::first();
    $response = actingAs($this->user)->get('/users/'.$user->id);

    $response->assertStatus(200);
    $isValid = $this->validator->get(convertTestResponseToPsrResponse($response), '/users/{id}');

    expect($isValid)->toBe(true);
});

test('delete user', function () {
    $newUser = User::factory()->create();
    $response = actingAs($this->user)->delete('/users/'.$newUser->id);

    $response->assertStatus(200);
    $isValid = $this->validator->delete(convertTestResponseToPsrResponse($response), '/users/{id}');

    expect($isValid)->toBe(true);
});
