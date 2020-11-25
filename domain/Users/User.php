<?php

namespace Domain\Users;

use App\Domain\Shared\Traits\HasUuid;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Infrastructure\Users\Repositories\Facades\RoleRepository;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasUuid, SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function setPasswordAttribute(string $password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role')
            ->using(new class extends Pivot {
                use HasUuid;
            })
            ->withPivot('id')
            ->withTimestamps();
    }

    public function setRoleAttribute(?Role $role)
    {
        return $this->roles[] = $role;
    }

    public static function makeOwner(array $data, Role $role): User
    {
        $user = new User($data);
        $user->role = $role;
        return $user;
    }

}
