<?php

namespace App\OpenApi\Responses;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ErrorUnauthenticatedResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('Unauthenticated.'),
        );

        return Response::create('ErrorUnauthenticated')
            ->description('Not logged in')
            ->content(
                MediaType::json()->schema($response)
            )
            ->statusCode(401);
    }
}
