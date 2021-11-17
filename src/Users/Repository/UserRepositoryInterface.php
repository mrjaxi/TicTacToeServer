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
     * @param string $name
     * @return Users
     */
    public function oneByUserName(string $name): Users;

    /**
     * @param $userName string
     * @return bool
     */
    public function oneByUserNameBool(string $userName) : bool;

    /**
     * @param $userName string
     * @param $password string
     * @return Users
     */
    public function findOneByNameAndPassword(string $userName, string $password) : Users;

    /**
     * @param $token string
     * @return Users
     */
    public function findOneByToken(string $token) : Users;

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

    /**
     * @param int $id
     * @return string
     */
    public function deleteById(int $id) : string;

    /**
     * @param string $name
     * @return string
     */
    public function deleteByName(string $name) : string;
}