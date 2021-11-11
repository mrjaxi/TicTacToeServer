<?php


namespace App\Users\Service;

use App\Users\Model\Users;

interface UsersServiceInterface
{
    /**
     * @param $userName
     * @param $userPassword
     * @return string
     */
    public function createUser(string $userName, string $userPassword) : string;

    /**
     * @param $userName
     * @param $userPassword
     * @return bool
     */
    public function loginUser(string $userName, string $userPassword) : bool;

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
}