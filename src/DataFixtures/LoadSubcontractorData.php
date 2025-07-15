<?php

namespace App\DataFixtures;

use App\Entity\Authorization\Subcontractor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LoadSubcontractorData extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $subcontractors = [
            ['code' => 'S1', 'name' => 'Subcontractor 1'],
            ['code' => 'S2', 'name' => 'Subcontractor 2'],
        ];

        foreach ($subcontractors as $subcontractorData) {
            $subcontractor = new Subcontractor();
            $subcontractor->setCode($subcontractorData['code']);
            $subcontractor->setName($subcontractorData['name']);

            $manager->persist($subcontractor);
            $this->addReference('subcontractor_' . $subcontractorData['code'], $subcontractor);
        }

        $manager->flush();
    }
}