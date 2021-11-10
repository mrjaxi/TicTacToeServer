<?php


namespace App\Users\Repository;


use App\Users\Model\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

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
        /**
         * @var Users $user
         */
        $user = parent::findOneBy(['id' => $id]);

        if ($user == null){
            throw new \RuntimeException("Пользователь не найден");
        }

        return $user;
    }

    /**
     * @param $userName string
     * @param $password string
     * @return Users
     */
    public function findOneByNameAndPassword(string $userName, string $password) : Users
    {
        /**
         * @var Users $user
         */
        $user = parent::findOneBy([
            'user_name' => $userName,
            'password' => $password
        ]);

        if ($user == null){
            throw new \RuntimeException("Пользователь не найден");
        }

        return $user;
    }

    /**
     * @param Users $user
     * @return Users
     * @throws ORMException
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
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Users $users): Users
    {
        $this->manager->flush();

        return $users;
    }
}