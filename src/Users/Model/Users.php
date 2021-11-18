<?php

namespace App\Users\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Users
 * @package App\Users\Model
 * @ORM\Entity(repositoryClass="App\Users\Repository\UsersRepository")
 */
class Users
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $usertoken;

    /**
     * User constructor.
     * @param $username
     * @param $password
     * @param $usertoken
     */
    public function __construct($username, $password, $usertoken)
    {
        $this->username = $username;
        $this->password = $password;
        $this->usertoken = $usertoken;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserName()
    {
        return $this->username;
    }

    /**
     * @param string $userName
     */
    public function setUserName($userName): void
    {
        $this->username = $userName;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsertoken(): string
    {
        return $this->usertoken;
    }

    /**
     * @param string $usertoken
     */
    public function setUsertoken(string $usertoken): void
    {
        $this->usertoken = $usertoken;
    }
}