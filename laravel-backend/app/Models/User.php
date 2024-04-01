<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasUuids, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // TODO: implement an actual working relationship here
    // public function permissions()
    // {
    //     return $this->hasManyThrough(Permission::class, Role::class);
    // }
    public function permissions()
    {
        return $this->role->permissions();
    }

    public function hasPermissions(array $permissionNames)
    {
        $permissionsCount = User::query()
            ->select('COUNT(*)')
            ->leftJoin('permission_role', 'permission_role.role_id', '=', 'users.role_id')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->where('users.id', '=', $this->id)
            ->whereIn('permissions.name', $permissionNames)
            ->count();

        return count($permissionNames) === $permissionsCount;
    }

    public function assignRole(string $roleName)
    {
        $role = Role::where('name', $roleName)->firstOrFail();
        $this->role_id = $role->id;
        $this->save();
    }
}
