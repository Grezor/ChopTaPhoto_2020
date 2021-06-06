<?php

namespace App\Entities;

class User
{
    public const ROLE_ADMIN = 1;
    public const ROLE_BUYER = 2;

    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private int $role;

    public function __construct(
        int $id,
        string $name,
        string $email,
        string $password,
        int $role
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }
}
