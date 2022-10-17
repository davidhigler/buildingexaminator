<?php

namespace App\DataFixtures;

use App\Entity\Authorization\Owner;
use App\Entity\Portfolio\HousingStock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

/**
 * @author Reiny Griemink <rgriemink@gmail.com>
 */
class LoadHousingStocksData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $housingStocks = [
            [
                'code' => 'DobroTest01',
                'name' => 'Test 01',
                'description' => 'This is the standard housing stock on the test environment of Dobro Building Examinator',
                'owner' => 'L9999'
            ],
            [
                'code' => 'DobroTest02',
                'name' => 'Test 02',
                'description' => 'This is the second housing stock on the test environment of Dobro Building Examinator',
                'owner' => 'L9998'
            ],
            [
                'code' => 'DobroTest03',
                'name' => 'Test 03',
                'description' => 'This is the third housing stock on the test environment of Dobro Building Examinator',
                'owner' => 'L9997'
            ],
        ];

        foreach ($housingStocks as $housingStock) {
            $housingStockObject = new HousingStock();

            if (empty($housingStock['code'])) {
                throw new RuntimeException('code may not be empty, it\'s used as a variable reference in the data fixtures.');
            } else {
                $housingStockObject->setCode($housingStock['code']);
            }

            if (!empty($housingStock['name'])) {
                $housingStockObject->setName($housingStock['name']);
            }

            if (!empty($housingStock['description'])) {
                $housingStockObject->setDescription($housingStock['description']);
            }

            if (!empty($housingStock['owner'])) {
                /** @var Owner $owner */
                $owner = $this->getReference('owner_' . $housingStock['owner']);
                $housingStockObject->setOwner($owner);
            }

            $housingStockObject->setCreationTime();
            $housingStockObject->setLastChangeTime();

            $validator = Validation::createValidator();
            $errors = $validator->validate($housingStockObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($housingStockObject);
            $this->addReference('housingstock_' . $housingStock['code'], $housingStockObject);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LoadOwnerData::class,
        ];
    }
}