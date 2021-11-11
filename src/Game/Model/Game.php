<?php


namespace App\Game\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Game
 * @package App\Game\Model
 * @ORM\Entity()
 */
class Game
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="App\Users\Model\Users", inversedBy="id")
     * @ORM\Column(type="integer")
     */
    private $userid;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="App\GameData\Model\GameData", inversedBy="matchid")
     * @ORM\Column(type="integer")
     */
    private $relmatchid;

    /**
     * Game constructor.
     * @param $userid
     * @param $relmatchid
     */
    public function __construct($userid, $relmatchid)
    {
        $this->userid = $userid;
        $this->relmatchid = $relmatchid;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserID()
    {
        return $this->userid;
    }

    /**
     * @return mixed
     */
    public function getMatchID()
    {
        return $this->relmatchid;
    }
}