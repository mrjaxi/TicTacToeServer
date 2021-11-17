<?php


namespace App\Users\Service;


use App\Users\Model\Users;

interface UsersServiceInterface
{
    /**
     * @param string $userName
     * @param string $userPassword
     * @return string
     */
    public function createUser(string $userName, string $userPassword) : string;

    /**
     * @param $userName
     * @param $userPassword
     * @return Users
     */
    public function loginUser(string $userName, string $userPassword) : Users;

    /**
     * @param string $token
     * @return Users
     */
    public function getUserByToken(string $token) : Users;

    /**
     * @return array
     */
    public function getUsers() : array;

    /**
     * @param Users $user
     * @return bool
     */
    public function updateUserCredentials(Users $user) : bool;

    /**
     * @param int $id
     * @return string
     */
    public function deleteUserById(int $id) : string;

    /**
     * @param string $username
     * @return string
     */
    public function deleteUserByName(string $username) : string;
}