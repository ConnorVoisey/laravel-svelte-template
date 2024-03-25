<?php

namespace App\Http\Controllers;

class OpenapiController extends Controller
{
    public function docs()
    {
        return view('openapiDocs');
    }
}
