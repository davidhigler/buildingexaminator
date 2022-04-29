<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\LivingType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadLivingTypesData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $livingTypes = [
            [
                'code' => 'lt1',
                'name' => 'Woonfunctie',
                'description' => 'Woongebouwen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt2',
                'name' => 'Bijeenkomstfunctie',
                'description' => 'Restaurants ontmoetingsgebouwen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt3',
                'name' => 'Celfunctie',
                'description' => 'Gevangenissen kluizen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt4',
                'name' => 'Gezondheidszorgfunctie',
                'description' => 'Ziekenhuizen en Medische Klinieken',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt5',
                'name' => 'Industriefunctie',
                'description' => 'Productie gebouwen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt6',
                'name' => 'Kantoorfunctie',
                'description' => 'Bedrijfs werkplekken',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt7',
                'name' => 'Logiesfunctie',
                'description' => 'Hotels, Motel',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt8',
                'name' => 'Onderwijsfunctie',
                'description' => 'schoolgebouwen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt9',
                'name' => 'Sportfunctie',
                'description' => 'Sporthallen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt10',
                'name' => 'Winkelfunctie',
                'description' => 'Waar je spullen en materialen kunt halen',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt11',
                'name' => 'Overige',
                'description' => 'Alle gebouwen zonder duidelijkebestemming',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt12',
                'name' => 'Geen gebouw',
                'description' => 'Omschrijving van het gebouwtype binnen de voorraad',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt13',
                'name' => 'Kelderfunctie',
                'description' => 'Gebouw onder de grond',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'lt14',
                'name' => 'Woonwagen',
                'description' => 'Huis op wielen en camping plekken',
                'housingstock' => 'DobroTest01'
            ]
        ];

        foreach ($livingTypes as $livingType) {
            $livingTypeObject = new LivingType();

            if (empty($livingType['code'])) {
                throw new RuntimeException('code may not be empty, it\'s used as a variable reference in the data fixtures.');
            } else {
                $livingTypeObject->setCode($livingType['code']);
            }

            if (!empty($livingType['name'])) {
                $livingTypeObject->setName($livingType['name']);
            }

            if (!empty($livingType['description'])) {
                $livingTypeObject->setDescription($livingType['description']);
            }

            if (!empty($livingType['housingstock'])) {
                /** @var HousingStock $housingStock */
                $housingStock = $this->getReference($livingType['housingstock']);
                $livingTypeObject->setHousingStock($housingStock);
            }

            $livingTypeObject->setCreationTime();
            $livingTypeObject->setLastChangeTime();

            $validator = Validation::createValidator();
            $errors = $validator->validate($livingTypeObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($livingTypeObject);
            $this->addReference($livingType['code'], $livingTypeObject);
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