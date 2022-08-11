<?php

namespace App\DataFixtures;

use App\Entity\Authentication\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData extends Fixture
{
    private ContainerInterface $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $hasher = $this->container->get('security.password_hasher');

        $userAdmin = new User();
        $userAdmin->setEmail('developers@dobrobv.nl');
        $userAdmin->setPassword($hasher->encodePassword($userAdmin, 'admin'));
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $manager->persist($userAdmin);
        $manager->flush();

        $userDavid = new User();
        $userDavid->setEmail('david.higler@dobrobv.nl');
        $userDavid->setPassword($hasher->encodePassword($userDavid, 'admin'));
        $userDavid->setRoles(['ROLE_ADMIN']);
        $manager->persist($userDavid);
        $manager->flush();

        $userReiny = new User();
        $userReiny->setEmail('reiny.griemink@dobrobv.nl');
        $userReiny->setPassword($hasher->encodePassword($userReiny, 'admin'));
        $userReiny->setRoles(['ROLE_ADMIN']);
        $manager->persist($userReiny);
        $manager->flush();
    }
}