<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\AuthenticateSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class AuthenticateRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('AuthenticateCreate')
            ->description('Authentication request')
            ->content(
                MediaType::json()->schema(AuthenticateSchema::ref())
            );
    }
}
