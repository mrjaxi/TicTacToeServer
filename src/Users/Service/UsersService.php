<?php


namespace App\Users\Service;


use App\Users\Model\Users;
use App\Users\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UsersService implements UsersServiceInterface
{
    private $repository;
    private $encoder;

    public function __construct(UserRepositoryInterface $repository, UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->repository = $repository;
    }

    /**
     * @param $userName
     * @param $userPassword
     * @return string
     */
    public function createUser(string $userName, string $userPassword): string
    {
        if ($userName == null or $userPassword == null) {
            throw new \RuntimeException("Все поля должны быть заполнены");
        }

        if ($this->repository->oneByUserName($userName) == true){
            throw new \RuntimeException("Пользователь с таким именем существует");
        }

        $user = new Users($userName, $userPassword);
        $this->repository->save($user);

        $now_time = time();

        return $this->encoder->encodePassword(new User(),"{$user->getUserName()}{$now_time}");
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

    /**
     * @return array
     */
    public function getUsers(): array
    {
        return $this->repository->all();
    }
}