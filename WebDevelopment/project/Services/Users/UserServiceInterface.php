<?php

namespace Services\Users;

use Data\Users\UserDTO;
use Data\Users\UserEditDTO;
use Exception\User\RegistrationException;
use Exception\User\EditProfileException;

interface UserServiceInterface
{
    /**
     * @param UserDTO $userDTO
     * @throws RegistrationException
     * @return mixed
     */
    public function register(UserDTO $userDTO);

    /**
     * @param int $id
     * @param UserEditDTO $userDTO
     * @throws EditProfileException
     */
    public function edit(int $id, UserEditDTO $userDTO): void;

    public function verifyCredentials(string $username, string $password): bool;

    public function findByUsername(string $username): UserDTO;

    public function findOne(int $id): UserDTO;
}
