<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\City;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadCityData extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cities = [
            ['name' => 'Zwolle','object_id' => '253','identification' => '1182'],
            ['name' => 'Kampen','object_id' => '2664','identification' => '2894'],
            ['name' => 'Wezep','object_id' => '2885','identification' => '3073'],
            ['name' => 'Hattemerbroek','object_id' => '2881','identification' => '3069']
        ];

        foreach ($cities as $city) {
            $cityObject = new City();

            if (empty($city['object_id'])) {
                throw new RuntimeException("object_id may not be empty, it's used as a variable reference in the data fixtures.");
            } else {
                $cityObject->setObjectId($city['object_id']);
            }

            if (isset($city['name']) && ($city['name'] !== '' && $city['name'] !== '0')) {
                $cityObject->setName($city['name']);
            }

            if (isset($city['identification']) && ($city['identification'] !== '' && $city['identification'] !== '0')) {
                $cityObject->setIdentification($city['identification']);
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
            $this->addReference('city_' . $city['object_id'], $cityObject);
        }

        $manager->flush();
    }
}