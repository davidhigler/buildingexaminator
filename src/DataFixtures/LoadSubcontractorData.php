<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Authorization\Subcontractor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadSubcontractorData extends Fixture
{
    public function load(ObjectManager $objectManager): void
    {
        $subcontractors = [
            ['code' => 'S1', 'name' => 'Subcontractor 1'],
            ['code' => 'S2', 'name' => 'Subcontractor 2'],
        ];

        foreach ($subcontractors as $subcontractorData) {
            $subcontractor = new Subcontractor();
            $subcontractor->setCode($subcontractorData['code']);
            $subcontractor->setName($subcontractorData['name']);

            $objectManager->persist($subcontractor);
            $this->addReference('subcontractor_' . $subcontractorData['code'], $subcontractor);
        }

        $objectManager->flush();
    }
}
