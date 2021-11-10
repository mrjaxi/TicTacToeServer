<?php


namespace App\Users\Repository;


use App\Users\Model\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

class UsersRepository extends ServiceEntityRepository implements UserRepositoryInterface
{

    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManager $manager)
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
    public function one(int $id): Users
    {
        /**
         * @var Users $user
         */
        $user = parent::findOneBy(['id' => $id]);
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