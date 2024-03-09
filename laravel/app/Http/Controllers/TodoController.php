<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Rfc4122\UuidV7;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @response [
     *  {
     *    "id": 9223372036854776000,
     *    "task": "sjuwanaltitwq",
     *    "completed": false,
     *    "user_id": 1,
     *    "created_at": "2024-03-09T00:13:13.000000Z",
     *    "updated_at": "2024-03-09T00:13:13.000000Z"
     *  },
     *  {
     *    "id": 9223372036854776000,
     *    "task": "testing",
     *    "completed": false,
     *    "user_id": 1,
     *    "created_at": "2024-03-09T00:13:31.000000Z",
     *    "updated_at": "2024-03-09T00:13:31.000000Z"
     *  }
     *]
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
            'task' => 'required|max:255|string',
            'completed' => 'required|boolean',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $validated = $validator->validated();
        $todo = new Todo;
        $todo->id = UuidV7::uuid7();
        $todo->task = $validated['task'];
        $todo->completed = $validated['completed'];
        $todo->user_id = $request->user()->id;
        $todo->save();

        return response()->json($todo, 201);
    }

    /**
     * Returns a single todo from its id
     *
     * @response {
     *  "id": 4,
     *  "task": "Write more todos",
     *  "completed": false,
     *  "created_at": "",
     *  "updated_at": ""
     * }
     *
     * @group Todo
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
