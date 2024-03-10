<?php

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\TodoSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class StoreTodoRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('TodoCreate')
            ->description('Todo data')
            ->content(
                MediaType::json()->schema(TodoSchema::ref())
            );
    }
}
