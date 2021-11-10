<?php


namespace App\Users\Service;


use App\Users\Model\Users;
use App\Users\Repository\UserRepositoryInterface;
use App\Entity\User;

class UsersService implements UsersServiceInterface
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $userName
     * @param $userPassword
     * @return Users
     */
    public function createUser(string $userName, string $userPassword): Users
    {
        $user = new Users($userName, $userPassword);
        $this->repository->save($user);

        return $user;
    }

    /**
     * @param int $id
     * @param string $incomePassword
     * @return bool
     */
    public function checkUserPasswordHash(int $id, string $incomePassword): bool
    {
        return $this->repository->oneById($id)->getPassword() === $incomePassword ? true : false;
    }

    /**
     * @param $userName
     * @param $userPassword
     * @return bool
     */
    public function loginUser(string $userName, string $userPassword): bool
    {
        return $this->repository->findOneByNameAndPassword($userName, $userPassword) === true ? true : false;
    }
}