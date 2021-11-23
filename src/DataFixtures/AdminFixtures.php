<?php


namespace App\DataFixtures;


use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $encoder;

    /**
     * AdminFixtures constructor.
     * @param $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager){
        $admin = new Admin();
        $admin->setEmail("admin@admin.com");
        $admin->setPassword($this->encoder->encodePassword($admin, "Hello"));
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);
        $manager->flush();
    }
}