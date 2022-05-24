<?php

namespace App\DataFixtures;

use App\Bag\Infrastructure\Arcgis\Repository;
use App\Entity\Portfolio\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadCityData extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     * @throws GuzzleException
     */
    public function load(ObjectManager $manager): void
    {
        $cities = [
            ['name' => 'Zwolle'],
            ['name' => 'Utrecht'],
            ['name' => 'Amersfoort'],
            ['name' => 'Bedum'],
            ['name' => 'Groningen'],
        ];

        foreach ($cities as $city) {
            $cityObject = new City();

            $this->repository = new Repository();
            $cityArcgis = $this->repository->getCityByName($city['name']);

            if (empty($cityArcgis['objectid'])) {
                throw new RuntimeException('code may not be empty, it\'s used as a variable reference in the data fixtures.');
            } else {
                $cityObject->setObjectId($cityArcgis['objectid']);
            }

            if (!empty($cityArcgis['identification'])) {
                $cityObject->setIdentification($cityArcgis['identification']);
            }

            if (!empty($cityArcgis['name'])) {
                $cityObject->setName($cityArcgis['name']);
            }

            $validator = Validation::createValidator();
            $errors = $validator->validate($cityObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($cityObject);
            $this->addReference($cityArcgis['name'], $cityObject);
        }

        $manager->flush();
    }
}