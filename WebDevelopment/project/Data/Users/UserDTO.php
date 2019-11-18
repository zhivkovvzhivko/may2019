<?php

namespace Data\Users;

class UserDTO
{
    private $username;

    private $password;

    private $confirmPassword;

    /**
     * UserDTO constructor.
     * @param $username
     * @param $password
     * @param $confirmPassword
     */
    public function __construct($username, $password, $confirmPassword)
    {
        $this->username = $username;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * @param mixed $confirmPassword
     */
    public function setConfirmPassword($confirmPassword): void
    {
        $this->confirmPassword = $confirmPassword;
    }
}
