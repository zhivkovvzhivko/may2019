<?php

namespace Services\Users;

use Data\Users\UserDTO;
use Data\Users\UserEditDTO;
use Exception\User\RegistrationException;
use Exception\User\EditProfileException;
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
            throw new RegistrationException('Password missmatch');
        }

        if (strlen($userDTO->getUsername()) < self::MIN_UESR_LENGTH) {
            throw new RegistrationException('User length too short');
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

    public function findByUsername(string $username): UserDTO
    {
        return $this->userRepository->getByUsername($username);
    }

    public function findOne(int $id): UserDTO
    {
        return $this->userRepository->getById($id);
    }

    public function edit(int $id, UserEditDTO $userEditDTO): void
    {
        $user = $this->userRepository->getById($id);
        $changePassword = false;

        if ($userEditDTO->getOldPassword() && $userEditDTO->getNewPassword()) {
            if (!$this->verifyCredentials($user->getUsername(), $userEditDTO->getOldPassword())) {
                throw new EditProfileException('Password missmatch');
            }
            $changePassword = true;
        }

        if ($changePassword) {
            $userEditDTO->setNewPassword(
                $this->encryptionService->hash($userEditDTO->getNewPassword())
            );
        }

        $this->userRepository->edit($id, $userEditDTO, $changePassword);
    }
}