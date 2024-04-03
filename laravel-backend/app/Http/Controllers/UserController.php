<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;
use App\Shgridable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    use Shgridable;

    const COLUMNS = [
        'id',
        'email',
        'name',
        'email_verified_at',
        'role_id',
        'created_at',
        'updated_at',
    ];

    const ResourceClass = UserResource::class;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response()->json($this->getIndex($request, self::COLUMNS, 'users', self::ResourceClass));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_name' => ['required', 'exists:roles,name'],
        ]);

        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->role_id = Role::where('name', $request->role_name)->first()->id;
        $user->save();

        return response()->json(['data' => new UserResource($user)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return ['data' => new UserResource($user)];
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'nullable|email|unique:users',
            'name' => 'nullable',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role_name' => ['nullable', 'exists:roles,name'],
        ]);
        if ($request->email) {
            $user->email = $request->email;
        }
        if ($request->name) {
            $user->name = $request->name;
        }
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ($request->role_name) {
            $user->role_id = Role::where('name', $request->role_name)->first()->id;
        }

        $user->save();

        return response()->json(['data' => new UserResource($user)], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'Successfully deleted'], Response::HTTP_OK);
    }
}
