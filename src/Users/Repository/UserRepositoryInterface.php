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
    public function oneById(int $id) : Users;

    /**
     * @param $userName string
     * @param $password string
     * @return Users
     */
    public function findOneByNameAndPassword(string $userName, string $password) : Users;

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