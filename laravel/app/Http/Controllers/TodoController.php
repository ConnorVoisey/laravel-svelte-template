<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\OpenApi\RequestBodies\StoreTodoRequestBody;
use App\OpenApi\Responses\ErrorValidationResponse;
use App\OpenApi\Responses\ListTodosResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vyuldashev\LaravelOpenApi\Attributes\Operation;
use Vyuldashev\LaravelOpenApi\Attributes\PathItem;
use Vyuldashev\LaravelOpenApi\Attributes\RequestBody;
use Vyuldashev\LaravelOpenApi\Attributes\Response;

#[PathItem]
class TodoController extends Controller
{
    /**
     * Index
     *
     * Displays all the todos related to the logged in user.
     */
    #[Operation(tags: ['Requires Auth', 'Todo'])]
    #[Response(factory: ListTodosResponse::class)]
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
    #[Operation(tags: ['Requires Auth', 'Todo'])]
    #[RequestBody(factory: StoreTodoRequestBody::class)]
    #[Response(factory: ListTodosResponse::class)]
    #[Response(factory: ErrorValidationResponse::class, statusCode: 422)]
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
        $todo->task = $validated['task'];
        $todo->completed = $validated['completed'];
        $todo->user_id = $request->user()->id;
        $todo->save();

        return response()->json($todo, 201);
    }

    /**
     * Show
     *
     * Returns a single todo from its id.
     * The todo must be related to the logged in user.
     */
    #[Operation(tags: ['Requires Auth', 'Todo'])]
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
