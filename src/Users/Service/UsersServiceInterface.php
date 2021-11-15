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
     * @param int $id
     * @param string $incomePassword
     * @return bool
     */
    public function checkUserPasswordHash(int $id, string $incomePassword) : bool;

    /**
     * @return array
     */
    public function getUsers() : array;

    /**
     * @param Users $user
     * @return bool
     */
    public function updateUserCredentials(Users $user) : bool;
}