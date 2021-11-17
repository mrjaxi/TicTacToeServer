<?php


namespace App\Users\Repository;


use App\Users\Model\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use http\Exception\RuntimeException;

class UsersRepository extends ServiceEntityRepository implements UserRepositoryInterface
{

    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, Users::class);
    }

    /**
     * @return Users[]
     */
    public function all(): array
    {
        return parent::findAll();
    }

    /**
     * @param $id int
     * @return Users
     */
    public function oneById(int $id): Users
    {
        /** @var Users $user */
        $user = parent::findOneBy(['id' => $id]);

        if ($user == null){
            throw new \RuntimeException("Пользователь не найден");
        }

        return $user;
    }

    /**
     * @param string $name
     * @return Users
     */
    public function oneByUserName(string $name): Users
    {
        /** @var Users $user */
        $user = parent::findOneBy(['username' => $name]);

        if ($user == null){
            throw new \RuntimeException("Пользователь не найден");
        }

        return $user;
    }

    /**
     * @param $userName string
     * @return bool
     */
    public function oneByUserNameBool(string $userName): bool
    {
        $user = parent::findOneBy(['username' => $userName]);

        if ($user == null){
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param $userName string
     * @param $password string
     * @return Users
     */
    public function findOneByNameAndPassword(string $userName, string $password) : Users
    {
        $userFind = parent::findOneBy([
            'username' => $userName
        ]);

        if ($userFind == null){
            throw new \RuntimeException("Пользователь не найден");
        }

        /** @var Users $user */
        $user = parent::findOneBy([
            'username' => $userName,
            'password' => $password
        ]);

        if ($user == null){
            throw new \RuntimeException("Неверный пароль");
        }

        return $user;
    }

    /**
     * @param $token string
     * @return Users
     */
    public function findOneByToken(string $token) : Users
    {
        /**
         * @var Users $user
         */
        $user = parent::findOneBy([
            'usertoken' => $token
        ]);

        if (!isset($user)){
            throw new \RuntimeException("Пользователя не удалось найти findOneByToken");
        }

        return $user;
    }

    /**
     * @param Users $user
     * @return Users
     */
    public function save(Users $user): Users
    {
        $this->manager->persist($user);
        $this->manager->flush();

        return $user;
    }

    /**
     * @param Users $users
     * @return Users
     */
    public function update(Users $users) : Users
    {
        $this->manager->flush();

        return $users;
    }

    /**
     * @param int $id
     * @return string
     */
    public function deleteById(int $id) : string
    {
        $findById = $this->oneById($id);

        $this->manager->remove($findById);
        $this->manager->flush();

        return "Пользователь удалён";
    }

    /**
     * @param string $name
     * @return string
     */
    public function deleteByName(string $name) : string
    {
        $findByName = $this->oneByUserName($name);

        $this->manager->remove($findByName);
        $this->manager->flush();

        return "Пользователь удалён";
    }
}