<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\HousingStock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadBuildingTypeData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $buildingTypes = [
            [
                'code' => 'BT1',
                'name' => 'Vrijstaande woning',
                'description' => '',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT2',
                'name' => 'Rijwoning twee onder één kap',
                'description' => '',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT3',
                'name' => 'Rijwoning ééngezins',
                'description' => '',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT4',
                'name' => 'Rijwoning senioren',
                'description' => '',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT5',
                'name' => 'Rijwoning duplex kleine gezinnen',
                'description' => 'woningen gesplitst is in twee deelwoningen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT6',
                'name' => 'Etagewoning galerijflat',
                'description' => 'Woningen bereikbaar door lange galerij voor de woning',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT7',
                'name' => 'Etagewoning portiekflat',
                'description' => 'Elke stramien eigen trapopgang',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT8',
                'name' => 'Etagewoning maisonette',
                'description' => '2 woonlagen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT9',
                'name' => 'Etagewoning penthouse',
                'description' => 'Bovenste woning van een flat',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT10',
                'name' => 'Woonwagen',
                'description' => 'woning op wielen en campingplekken',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT11',
                'name' => 'Aanbouw',
                'description' => 'Later aangebouwde bebouwing aan de woning',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'BT12',
                'name' => 'Bedrijfsgebouw met woning(en)',
                'description' => 'kantoor en woning in 1',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '1010A',
                'name' => 'Rijwoning ééngezins',
                'description' => '',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '1010B',
                'name' => 'Rijwoning senioren',
                'description' => '',
                'housingstock' => 'DobroTest01'
            ]
        ];

        foreach ($buildingTypes as $buildingType) {
            $buildingTypeObject = new BuildingType();

            if (empty($buildingType['code'])) {
                throw new RuntimeException('code may not be empty, it\'s used as a variable reference in the data fixtures.');
            } else {
                $buildingTypeObject->setCode($buildingType['code']);
            }

            if (!empty($buildingType['name'])) {
                $buildingTypeObject->setName($buildingType['name']);
            }

            if (!empty($buildingType['description'])) {
                $buildingTypeObject->setDescription($buildingType['description']);
            }

            if (!empty($buildingType['housingstock'])) {
                /** @var HousingStock $housingStock */
                $housingStock = $this->getReference($buildingType['housingstock']);
                $buildingTypeObject->setHousingStock($housingStock);
            }

            $buildingTypeObject->setCreationTime();
            $buildingTypeObject->setLastChangeTime();

            $validator = Validation::createValidator();
            $errors = $validator->validate($buildingTypeObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($buildingTypeObject);
            $this->addReference($buildingType['code'], $buildingTypeObject);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LoadHousingStocksData::class,
        ];
    }
}