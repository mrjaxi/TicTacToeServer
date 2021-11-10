<?php


namespace App\Users\Repository;

use App\Users\Model\Users;

interface UserRepositoryInterface
{
    /**
     * @return Users[]
     */
    public function all() : array;

    /**
     * @param $id int
     * @return Users
     */
    public function one(int $id) : Users;

    /**
     * @param Users $user
     * @return Users
     */
    public function save(Users $user) : Users;

    /**
     * @param Users $users
     * @return Users
     */
    public function update(Users $users) : Users;
}