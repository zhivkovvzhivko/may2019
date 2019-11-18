<?php

namespace Services\Users;

use Data\Users\UserDTO;
use Repositories\Users\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    const MIN_UESR_LENGTH = 5;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserDTO $userDTO)
    {
        if ($userDTO->getPassword() != $userDTO->getConfirmPassword()) {
            throw new \Exception('Password missmatch');
        }

        if (strlen($userDTO->getUsername()) < self::MIN_UESR_LENGTH) {
            throw new \Exception('User length too short');
        }

        $password_hash = password_hash($userDTO->getPassword(), PASSWORD_ARGON2I);
        $userDTO->setPassword($password_hash);

        $this->userRepository->register($userDTO);
    }
}