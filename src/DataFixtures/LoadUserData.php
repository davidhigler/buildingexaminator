<?php

namespace App\DataFixtures;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
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
        /** Dobro users */

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

        /** Owner users */

        $ownerUser01 = new OwnerUser();
        $ownerUser01->setEmail('owner.user.01@dobrobv.nl');
        $ownerUser01->setPassword($this->hasher->hashPassword($ownerUser01, 'admin'));
        $ownerUser01->setRoles([]);
        $manager->persist($ownerUser01);
        $manager->flush();

        $ownerUser02 = new OwnerUser();
        $ownerUser02->setEmail('owner.user.02@dobrobv.nl');
        $ownerUser02->setPassword($this->hasher->hashPassword($ownerUser02, 'admin'));
        $ownerUser02->setRoles([]);
        $manager->persist($ownerUser02);
        $manager->flush();

        /** Contractor users */

        $contractorUser01 = new ContractorUser();
        $contractorUser01->setEmail('contractor.user.01@dobrobv.nl');
        $contractorUser01->setPassword($this->hasher->hashPassword($contractorUser01, 'admin'));
        $contractorUser01->setRoles([]);
        $manager->persist($contractorUser01);
        $manager->flush();

        $contractorUser02 = new ContractorUser();
        $contractorUser02->setEmail('contractor.user.02@dobrobv.nl');
        $contractorUser02->setPassword($this->hasher->hashPassword($contractorUser02, 'admin'));
        $contractorUser02->setRoles([]);
        $manager->persist($contractorUser02);
        $manager->flush();

        /** Subcontractor users */

        $subcontractorUser01 = new SubcontractorUser();
        $subcontractorUser01->setEmail('subcontractor.user.01@dobrobv.nl');
        $subcontractorUser01->setPassword($this->hasher->hashPassword($subcontractorUser01, 'admin'));
        $subcontractorUser01->setRoles([]);
        $manager->persist($subcontractorUser01);
        $manager->flush();

        $subcontractorUser02 = new SubcontractorUser();
        $subcontractorUser02->setEmail('subcontractor.user.02@dobrobv.nl');
        $subcontractorUser02->setPassword($this->hasher->hashPassword($subcontractorUser02, 'admin'));
        $subcontractorUser02->setRoles([]);
        $manager->persist($subcontractorUser02);
        $manager->flush();
    }
}