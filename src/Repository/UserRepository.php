<?php

namespace App\Repository;

use App\Domain\Entity\User;
use App\Domain\ValuesObjects\UserList;
use App\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Domain\Repositories\UserRepositoryInterface as UserPort;

class UserRepository extends Eloquent implements UserPort
{
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * @inheritDoc
     */
    public function getById(int $id): ?User
    {
        $resource = self::find($id);

        return UserFactory::make($id, $resource->name, $resource->email, $resource->password);
    }

    /**
     * @inheritDoc
     */
    public function index(): ?UserList
    {
        $users = self::all()->toArray();

        return new UserList($users);
    }

    /**
     * @param array $data
     * @return User|null
     */
    public function create(array $data): ?User
    {
        return self::create($data);
    }
}