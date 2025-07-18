<?php

namespace App\DataFixtures;

use App\Entity\Authorization\Owner;
use App\Entity\Authorization\OwnerGroup;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;
use RuntimeException;

class LoadOwnerGroupData extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ownerGroups = [
            [
                'owner' => 'owner_L9999',
                'name' => 'Group A',
            ],
            [
                'owner' => 'owner_L9999',
                'name' => 'Group B',
            ],
            [
                'owner' => 'owner_L9999',
                'name' => 'Group C',
            ],
        ];

        foreach ($ownerGroups as $ownerGroup) {
            $ownerGroupObject = new OwnerGroup();

            if (!empty($ownerGroup['owner']) ) {
                $owner = $this->getReference($ownerGroup['owner'], Owner::class);
                $ownerGroupObject->setOwner($owner);
            }

            if (!empty($ownerGroup['name'])) {
                $ownerGroupObject->setName($ownerGroup['name']);
            }

            $validator = Validation::createValidator();
            $errors = $validator->validate($ownerGroupObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($ownerGroupObject);
            $this->addReference('ownerGroup_' . $ownerGroup['name'], $ownerGroupObject);
        }

        $manager->flush();
    }
}