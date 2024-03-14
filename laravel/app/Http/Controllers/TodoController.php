<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TodoController extends Controller
{
    /**
     * Index
     *
     * Displays all the todos related to the logged in user.
     */
    public function index()
    {
        $user = Auth::user();

        return response()->json(Todo::where('user_id', $user->id)->get());
    }

    /**
     * Store
     *
     * Creates a new todo related to the logged in user.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'required|max:255|string',
            'completed' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $todo = Todo::create([
            'id' => Str::orderedUuid(),
            'task' => $validated['task'],
            'completed' => $validated['completed'],
            'user_id' => $request->user()->id,
        ]);

        return response()->json($todo, 201);
    }

    /**
     * Show
     *
     * Returns a single todo from its id.
     * The todo must be related to the logged in user.
     */
    public function show(Todo $todo)
    {
        return $todo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $validator = Validator::make($request->all(), [
            'task' => 'nullable|max:255|string',
            'completed' => 'nullable|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $todo->update($validated);

        return response()->json($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return response(null, 204);
    }
}
