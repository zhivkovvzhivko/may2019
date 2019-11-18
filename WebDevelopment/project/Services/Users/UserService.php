<?php

namespace Services\Users;

use Data\Users\UserDTO;
use Repositories\Users\UserRepositoryInterface;
use Services\Encryption\EncryptionServiceInterface;

class UserService implements UserServiceInterface
{
    const MIN_UESR_LENGTH = 5;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var EncryptionServiceInterface
     */
    private $encryptionService;

    public function __construct(UserRepositoryInterface $userRepository, EncryptionServiceInterface $encryptionService)
    {
        $this->userRepository = $userRepository;
        $this->encryptionService = $encryptionService;
    }

    public function register(UserDTO $userDTO)
    {
        if ($userDTO->getPassword() != $userDTO->getConfirmPassword()) {
            throw new \Exception('Password missmatch');
        }

        if (strlen($userDTO->getUsername()) < self::MIN_UESR_LENGTH) {
            throw new \Exception('User length too short');
        }

        $password_hash = $this->encryptionService->hash($userDTO->getPassword());
        $userDTO->setPassword($password_hash);

        $this->userRepository->register($userDTO);
    }

    public function verifyCredentials(string $username, string $password): bool
    {
        $user = $this->userRepository->getByUsername($username);

        return $this->encryptionService->verify($password, $user->getPassword());
    }
}