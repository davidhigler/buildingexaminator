<?php

namespace App\DataFixtures;

use App\Entity\Authentication\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoadUserData extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setEmail('developers@dobrobv.nl');
        $userAdmin->setPassword($this->hasher->hashPassword($userAdmin, 'admin'));
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($userAdmin);
        $manager->flush();

        $userDavid = new User();
        $userDavid->setEmail('david.higler@dobrobv.nl');
        $userDavid->setPassword($this->hasher->hashPassword($userDavid, 'admin'));
        $userDavid->setRoles(['ROLE_ADMIN']);
        $manager->persist($userDavid);
        $manager->flush();

        $userReiny = new User();
        $userReiny->setEmail('reiny.griemink@dobrobv.nl');
        $userReiny->setPassword($this->hasher->hashPassword($userReiny, 'admin'));
        $userReiny->setRoles(['ROLE_ADMIN']);
        $manager->persist($userReiny);
        $manager->flush();
    }
}