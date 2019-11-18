<?php

namespace Repositories\Users;

use Database\DatabaseInterface;
use Data\Users\UserDTO;

class UserRepository implements UserRepositoryInterface
{
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function getAll(): \Generator
    {
        return $this->db->query("SELECT * FROM users")->execute()->fetch();
    }

    public function register(UserDTO $userDTO)
    {
        $this->db->query("INSERT INTO users (username, password) VALUES (?, ?)")
            ->execute([$userDTO->getUsername(), $userDTO->getPassword()]);
    }

    public function getByUsername(string $username): UserDTO
    {
        $user = $this->db->query("SELECT * FROM users WHERE username = ?")
            ->execute([$username])
            ->fetch()
            ->current();

        return new UserDTO($user['username'], $user['password'], '');
    }
}