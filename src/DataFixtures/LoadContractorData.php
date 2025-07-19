<?php

namespace App\DataFixtures;

use App\Entity\Authorization\Contractor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadContractorData extends Fixture
{
    public function load(ObjectManager $objectManager): void
    {
        $contractors = [
            ['code' => 'C1', 'name' => 'Contractor 1'],
            ['code' => 'C2', 'name' => 'Contractor 2'],
        ];

        foreach ($contractors as $contractorData) {
            $contractor = new Contractor();
            $contractor->setCode($contractorData['code']);
            $contractor->setName($contractorData['name']);

            $objectManager->persist($contractor);
            $this->addReference('contractor_' . $contractorData['code'], $contractor);
        }

        $objectManager->flush();
    }
}