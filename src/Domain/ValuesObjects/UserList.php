<?php

namespace App\Domain\ValuesObjects;

use App\Core\Contracts\CollectionContract;
use App\Domain\Entity\User;
use App\Factories\UserFactory;
use Exception;

class UserList implements CollectionContract
{
    protected $users;

    public function __construct(array $users = [])
    {
        foreach($users as $user){
            $user = (object) $user;
            $u = UserFactory::make($user->id, $user->name, $user->email, $user->password);
            $this->add($u);
        }
    }

    /**
     * @param User $user
     * @param string|null $key
     * @return UserList
     * @throws Exception
     */
    public function add($user, string $key = null): UserList
    {
        if(is_null($key)) {
            $this->users[] = $user;
            return $this;
        }
        if(isset($this->users[$key])) {
            throw new Exception("Key $key already in use.");
        }
        $this->users[$key] = $user;
    }

    /**
     * @param $key
     * @return UserList
     * @throws Exception
     */
    public function delete($key): UserList
    {
        if(isset($this->users[$key])){
            unset($this->users[$key]);
            return $this;
        }

        if(!isset($this->users[$key])){
            throw new Exception("Invalid key $key");
        }
    }

    public function get($key)
    {
        if(isset($this->users[$key])) {
            return $this->users[$key];
        }
        if(!isset($this->users[$key])) {
            throw new Exception("Invalid key $key");
        }
    }

    public function all(): array
    {
        return $this->users;
    }
}