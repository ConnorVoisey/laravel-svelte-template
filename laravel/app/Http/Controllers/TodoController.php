<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return response()->json(Todo::where('user_id', $user->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|string',
            'description' => 'required|max:255|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $todo = new Todo;
        $todo->title = $validated['title'];
        $todo->description = $validated['description'];
        $todo->user_id = $request->user()->id;
        $todo->save();

        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return response()->json($todo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
