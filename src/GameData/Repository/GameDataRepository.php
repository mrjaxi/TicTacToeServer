<?php


namespace App\GameData\Repository;


use App\GameData\Model\GameData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class GameDataRepository extends ServiceEntityRepository implements GameDataRepositoryInterface
{

    private $manager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($registry, GameData::class);
    }

    /**
     * @return GameData[]
     */
    public function all(): array
    {
        return parent::findAll();
    }

    /**
     * @param $id int
     * @return GameData
     */
    public function oneById(int $id): GameData
    {
        /**
         * @var GameData $gamedata
         */
        $gamedata = parent::findOneBy(['matchid' => $id]);

        if ($gamedata == null){
            throw new \RuntimeException("Матч не найден");
        }

        return $gamedata;
    }

    /**
     * @param GameData $gamedata
     * @return GameData
     */
    public function save(GameData $gamedata): GameData
    {
        $this->manager->persist($gamedata);
        $this->manager->flush();

        return $gamedata;
    }

    /**
     * @param GameData $gamedata
     * @return GameData
     */
    public function update(GameData $gamedata): GameData
    {
        $this->manager->flush();

        return $gamedata;
    }
}