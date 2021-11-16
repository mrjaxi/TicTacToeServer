<?php


namespace App\Users\Service;


use App\Users\Model\Users;
use App\Users\Repository\UserRepositoryInterface;
use Exception;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersService implements UsersServiceInterface
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository, UserPasswordEncoderInterface $encoder)
    {
        $this->repository = $repository;
    }

    /**
     * @param string $userName
     * @param string $userPassword
     * @return string
     * @throws Exception
     */
    public function createUser(string $userName, string $userPassword): string
    {
        if (!isset($userName, $userPassword)) {
            throw new \RuntimeException("Все поля должны быть заполнены");
        }

        if ($this->repository->oneByUserName($userName) == true){
            throw new \RuntimeException("Пользователь с таким именем существует");
        }

        $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

        $user = new Users($userName, $userPassword, $token);
        $this->repository->save($user);

        return $token;
    }

    /**
     * @param $userName
     * @param $userPassword
     * @return Users
     */
    public function loginUser(string $userName, string $userPassword): Users
    {
        $user = $this->repository->findOneByNameAndPassword($userName, $userPassword);

        return $user == null ? null : $user;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->repository->all();
    }

    public function updateUserCredentials($user) : bool
    {
        $response = $this->repository->update($user);

        if ($response == null){
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param string $token
     * @return Users
     */
    public function getUserByToken(string $token): Users
    {
        return $this->repository->findOneByToken($token);
    }
}