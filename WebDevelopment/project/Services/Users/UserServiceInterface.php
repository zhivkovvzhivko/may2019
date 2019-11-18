<?php

namespace Services\Users;

use Data\Users\UserDTO;
use Exception\User\RegistrationException;

interface UserServiceInterface
{
    /**
     * @param UserDTO $userDTO
     * @throws RegistrationException
     * @return mixed
     */
    public function register(UserDTO $userDTO);

    public function verifyCredentials(string $username, string $password): bool;

    public function findByUsername(string $username): UserDTO;

    public function findOne(int $id): UserDTO;
}
