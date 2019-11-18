<?php

namespace Services\Users;

use Data\Users\UserDTO;

interface UserServiceInterface
{
    /**
     * @param UserDTO $userDTO
     * @throws \Exception
     * @return mixed
     */
    public function register(UserDTO $userDTO);
}
