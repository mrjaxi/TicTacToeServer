<?php


namespace App\GameData\Repository;


use App\Game\Repository\GameRepositoryInterface;
use App\GameData\Model\GameData;
use App\Users\Repository\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Array_;

class GameDataRepository extends ServiceEntityRepository implements GameDataRepositoryInterface
{

    private $manager;
    private $userRepository;
    private $gameRepository;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $manager,
                                UserRepositoryInterface $userRepository, GameRepositoryInterface $gameRepository)
    {
        $this->manager = $manager;
        $this->userRepository = $userRepository;
        $this->gameRepository = $gameRepository;
        parent::__construct($registry, GameData::class);
    }

    /**
     * @return GameData[]
     */
    public function all(): array
    {
        /** @var GameData[] $gameData */
        $gameData = parent::findAll();
        if ($gameData == null){
            throw new \RuntimeException("Нет игр");
        }

        return $gameData;
    }

    /**
     * @param int $id
     * @return GameData
     */
    public function oneById(int $id): GameData
    {
        /** @var GameData $gamedata */
        $gamedata = parent::findOneBy(['matchid' => $id]);

        if ($gamedata == null){
            throw new \RuntimeException("Матч не найден");
        }

        return $gamedata;
    }

    /**
     * @param string $token
     * @return GameData[]
     */
    public function findGamesByToken(string $token) : array
    {
        $userId = $this->userRepository->findOneByToken($token)->getId();

        $gameArr = $this->gameRepository->findByUserId($userId);

        $gameDataArr = array();

        foreach ($gameArr as $game) {
            $gameData = $this->oneById($game->getId());
            array_push($gameDataArr, $gameData);
        }

        return $gameDataArr;
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

    /**
     * @param int $matchId
     * @return string
     */
    public function deleteById(int $matchId) : string
    {
        $match = $this->oneById($matchId);

        $this->manager->remove($match);
        $this->manager->flush();

        return "Игра удалена";
    }
}