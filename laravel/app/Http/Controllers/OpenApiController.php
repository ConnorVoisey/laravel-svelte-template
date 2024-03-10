<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class OpenApiController extends Controller
{
    public function docs()
    {
        return view('openApiDocs');
    }

    public function getOpenApiJson()
    {
        $json = Storage::get('docs/openApi.json');

        return response()->json(json_decode($json));
    }
}
