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
        if ($this->repository->oneByUserNameBool($userName) == true){
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
        /** @var Users $user */
        $user = $this->repository->findOneByNameAndPassword($userName, $userPassword);

        return $user;
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

        return $response == null ? false : true;
    }

    /**
     * @param string $token
     * @return Users
     */
    public function getUserByToken(string $token): Users
    {
        if (!isset($token)){
            throw new \RuntimeException("Не передан токен");
        }

        return $this->repository->findOneByToken($token);
    }

    /**
     * @param int $id
     * @return string
     */
    public function deleteUserById(int $id) : string
    {
        return $this->repository->deleteById($id);
    }

    /**
     * @param string $username
     * @return string
     */
    public function deleteUserByName(string $username) : string
    {
        return $this->repository->deleteByName($username);
    }
}