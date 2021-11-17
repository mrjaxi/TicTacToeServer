<?php


namespace App\Game\Repository;


use App\Game\Model\Game;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class GameRepository extends ServiceEntityRepository implements GameRepositoryInterface
{
    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, Game::class);
    }

    /**
     * @param $id int
     * @return Game
     */
    public function findById($id): Game
    {
        /**
         * @var Game $game
         */
        $game = parent::findOneBy(['id' => $id]);

        return $game;
    }

    /**
     * @param $id int
     * @return Game
     */
    public function findOneByUserId($id): Game
    {
        /**
         * @var Game $game
         */
        $game = parent::findOneBy(['userid' => $id]);

        if ($game == null){
            throw new \RuntimeException("Игра не найдена");
        }

        return $game;
    }

    /**
     * @param int $id
     * @return Game[]
     */
    public function findByUserId($id): array
    {
        /**
         * @var Game[] $game
         */
        $game = parent::findBy(['userid' => $id]);

        if ($game == null){
            throw new \RuntimeException("Игр нет");
        }

        return $game;
    }

    /**
     * @param $id int
     * @return Game
     */
    public function findByGameDataId($id): Game
    {
        /**
         * @var Game $game
         */
        $game = parent::findOneBy(['relmatchid' => $id]);

        return $game;
    }

    /**
     * @param Game $game
     * @return Game
     */
    public function save(Game $game): Game
    {
        $this->manager->persist($game);
        $this->manager->flush();

        return $game;
    }

    /**
     * @param Game $game
     * @return Game
     */
    public function update(Game $game): Game
    {
        $this->manager->flush();
        return $game;
    }
}