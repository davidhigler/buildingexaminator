<?php

namespace App\DataFixtures;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use App\Entity\Authorization\Contractor;
use App\Entity\Authorization\Owner;
use App\Entity\Authorization\Subcontractor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoadUserData extends Fixture implements DependentFixtureInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $objectManager): void
    {
        $users = [
            ['email' => 'developers@dobrobv.nl', 'password' => 'admin', 'roles' => ['ROLE_ADMIN'], 'type' => 'dobro'],
            ['email' => 'david.higler@dobrobv.nl', 'password' => 'admin', 'roles' => ['ROLE_ADMIN'], 'type' => 'dobro'],
            ['email' => 'reiny.griemink@dobrobv.nl', 'password' => 'admin', 'roles' => ['ROLE_ADMIN'], 'type' => 'dobro'],
            ['email' => 'owner.user.01@dobrobv.nl', 'password' => 'admin', 'roles' => [], 'type' => 'owner', 'owner' => 'L9999'],
            ['email' => 'owner.user.02@dobrobv.nl', 'password' => 'admin', 'roles' => [], 'type' => 'owner', 'owner' => 'L9999'],
            ['email' => 'contractor.user.01@dobrobv.nl', 'password' => 'admin', 'roles' => [], 'type' => 'contractor', 'contractor' => 'C1'],
            ['email' => 'contractor.user.02@dobrobv.nl', 'password' => 'admin', 'roles' => [], 'type' => 'contractor', 'contractor' => 'C1'],
            ['email' => 'subcontractor.user.01@dobrobv.nl', 'password' => 'admin', 'roles' => [], 'type' => 'subcontractor', 'subcontractor' => 'S1'],
            ['email' => 'subcontractor.user.02@dobrobv.nl', 'password' => 'admin', 'roles' => [], 'type' => 'subcontractor', 'subcontractor' => 'S1'],
        ];

        foreach ($users as $user) {
            $newUser = match ($user['type']) {
                'dobro' => new User(),
                'owner' => new OwnerUser(),
                'contractor' => new ContractorUser(),
                'subcontractor' => new SubcontractorUser(),
            };

            $newUser->setEmail($user['email']);
            $newUser->setPassword($this->userPasswordHasher->hashPassword($newUser, $user['password']));
            $newUser->setRoles($user['roles']);

            switch ($user['type']) {
                case 'owner':
                    /** @var Owner $owner */
                    $owner = $this->getReference('owner_' . $user['owner'], Owner::class);
                    $newUser->setOwner($owner);
                    break;
                case 'contractor':
                    /** @var Contractor $contractor */
                    $contractor = $this->getReference('contractor_' . $user['contractor'], Contractor::class);
                    $newUser->setContractor($contractor);
                    break;
                case 'subcontractor':
                    /** @var Subcontractor $subcontractor */
                    $subcontractor = $this->getReference('subcontractor_' . $user['subcontractor'], Subcontractor::class);
                    $newUser->setSubcontractor($subcontractor);
                    break;
            }

            $objectManager->persist($newUser);
        }

        $objectManager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LoadOwnerData::class,
            LoadContractorData::class,
            LoadSubcontractorData::class,
        ];
    }
}