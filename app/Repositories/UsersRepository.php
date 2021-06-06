<?php

namespace App\Repositories;

use App\Entities\User;
use PDO;

class UsersRepository
{
    private PDO $db;

    /**
     * __construct
     * @param  mixed $db
     * @return void
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * findByEmail
     * @param  mixed $email
     * @return User
     */
    public function findByEmail(string $email): User|null
    {
        $request = $this->db->prepare('SELECT id, name, email, password, role FROM users WHERE email = :email');
        $request->execute([
            ':email' => $email
        ]);

        return $this->makeUser($request->fetch());
    }

    /**
     * makeUser
     *
     * @param  mixed $user
     * @return User
     */
    private function makeUser(array|bool $user): User|null
    {
        if ($user === false) {
            return null;
        }

        return new User(
            $user['id'],
            $user['name'],
            $user['email'],
            $user['password'],
            $user['role']
        );
    }
}
