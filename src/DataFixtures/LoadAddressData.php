<?php

namespace App\DataFixtures;

use App\Bag\Application\Arcgis\ArcgisException;
use App\Bag\Infrastructure\SQLite\Repository as cbsRepository;
use App\Bag\Infrastructure\Arcgis\Repository as arcgisRepository;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\Address;
use App\Entity\Portfolio\Building;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\City;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\Municipality;
use App\Entity\Portfolio\Neighbourhood;
use App\Entity\Portfolio\PublicSpace;
use App\Entity\Portfolio\Residence;
use App\Entity\Portfolio\ResidentialArea;
use App\Entity\Portfolio\Vtw;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use OutOfBoundsException;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

/**
 * @author Reiny Griemink <rgriemink@gmail.com>
 */
class LoadAddressData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $buildingAddresses = require_once
            __DIR__ . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            '..' . DIRECTORY_SEPARATOR .
            'data' . DIRECTORY_SEPARATOR .
            'addresses' . DIRECTORY_SEPARATOR .
            'AddressData.php';

        $cbsRepository = new cbsRepository();
        $arcgisRepository = new arcgisRepository();

        foreach ($buildingAddresses as $buildingAddress) {

            $buildingAddressObject = new Address();

            try {
                /** @var HousingStock $housingStock */
                $housingStock = $this->getReference($buildingAddress['housingstock']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                echo $this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage() . "\n";
                continue;
            }
            $buildingAddressObject->setHousingStock($housingStock);

            $buildingAddressObject->setZipcode($buildingAddress['zipcode']);

            $buildingAddressObject->setHouseNumber($buildingAddress['housenumber']);

            $cbsResults = $cbsRepository->getNeighbourhoodResidentialareaMunicipalityByZipcodeHousenumber($buildingAddress['zipcode'] . $buildingAddress['housenumber']);

            try {
                /** @var Municipality $municipality */
                $municipality = $this->getReference($cbsResults['municipality']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                echo $this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage() . "\n";
                continue;
            }
            $buildingAddressObject->setMunicipality($municipality);

            try {
                /** @var ResidentialArea $residentialarea */
                $residentialarea = $this->getReference($cbsResults['residentialarea']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                echo $this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage() . "\n";
                continue;
            }
            $buildingAddressObject->setResidentialArea($residentialarea);

            try {
                /** @var Neighbourhood $neighbourhood */
                $neighbourhood = $this->getReference($cbsResults['neighbourhood']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                echo $this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage() . "\n";
                continue;
            }
            $buildingAddressObject->setNeighbourhood($neighbourhood);

            try {
                /** @var Block $block */
                $block = $this->getReference($buildingAddress['block']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                echo $this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage() . "\n";
                continue;
            }
            $buildingAddressObject->setBlock($block);

            try {
                /** @var BuildingType $buildingtype */
                $buildingtype = $this->getReference($buildingAddress['buildingtype']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                echo $this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage() . "\n";
                continue;
            }
            $buildingAddressObject->setBuildingType($buildingtype);

            $buildingAddressObject->setRentalUnitNumber($buildingAddress['rentalunitnumber']);

            if (!empty($buildingAddress['addition'])) {
                $buildingAddressObject->setAddition($buildingAddress['addition']);
            }

            try {
                $arcgisResults = $arcgisRepository->getAddressByZipcodeAndHousenumber($buildingAddress['zipcode'], $buildingAddress['housenumber'], $buildingAddress['addition']);
            } catch (ArcgisException $arcgisException) {
                echo $this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $arcgisException;
                continue;
            }

            $buildingAddressObject->setObjectId($arcgisResults['objectid']);
            $buildingAddressObject->setIdentification($arcgisResults['identification']);

            $buildingRepository = $manager->getRepository(Building::class);
            $building = $buildingRepository->findOneBy(['objectId' => $arcgisResults['building']['objectid']]);
            if (empty($building)) {
                $building = new Building();
                $building->setObjectId($arcgisResults['building']['objectid']);
                $building->setIdentification($arcgisResults['building']['identification']);
                $building->setConstructionYear($arcgisResults['building']['constructionyear']);
                $building->setStatus($arcgisResults['building']['status']);
                $building->setResidenceCount($arcgisResults['building']['residencecount']);
                $building->setSurfaceArea($arcgisResults['building']['surfacearea']);
                $manager->persist($building);
            }
            $buildingAddressObject->setBuilding($building);

            $residenceRepository = $manager->getRepository(Residence::class);
            $residence = $residenceRepository->findOneBy(['objectId' => $arcgisResults['residence']['objectid']]);
            if (empty($residence)) {
                $residence = new Residence();
                $residence->setObjectId($arcgisResults['residence']['objectid']);
                $residence->setIdentification($arcgisResults['residence']['identification']);
                $residence->setSurfaceArea($arcgisResults['residence']['surfacearea']);
                $residence->setStatus($arcgisResults['residence']['status']);
                $residence->setIntendedUse($arcgisResults['residence']['intendeduse']);
                $residence->setIntendedUseBasic($arcgisResults['residence']['intendedusebasic']);
                $manager->persist($residence);
            }
            $buildingAddressObject->setResidence($residence);

            $publicSpaceRepository = $manager->getRepository(PublicSpace::class);
            $publicSpace = $publicSpaceRepository->findOneBy(['objectId' => $arcgisResults['publicspace']['objectid']]);
            if (empty($publicSpace)) {
                $publicSpace = new PublicSpace();
                $publicSpace->setObjectId($arcgisResults['publicspace']['objectid']);
                $publicSpace->setIdentification($arcgisResults['publicspace']['identification']);
                $publicSpace->setName($arcgisResults['publicspace']['name']);
                $publicSpace->setType($arcgisResults['publicspace']['type']);
                $manager->persist($publicSpace);
            }
            $buildingAddressObject->setPublicSpace($publicSpace);

            $cityRepository = $manager->getRepository(City::class);
            $city = $cityRepository->findOneBy(['objectId' => $arcgisResults['city']['objectid']]);
            if (empty($city)) {
                $city = new City();
                $city->setObjectId($arcgisResults['city']['objectid']);
                $city->setIdentification($arcgisResults['city']['identification']);
                $city->setName($arcgisResults['city']['name']);
                $manager->persist($city);
            }
            $buildingAddressObject->setCity($city);

            $buildingAddressObject->setOrientation($buildingAddress['orientation']);

            $buildingAddressObject->setDaeb($buildingAddress['daeb']);

            try {
                /** @var Vtw $vtw */
                $vtw = $this->getReference($buildingAddress['vtw']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                echo $this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage() . "\n";
                continue;
            }
            $buildingAddressObject->setVtw($vtw);

            $buildingAddressObject->setCreationTime();
            $buildingAddressObject->setLastChangeTime();

            $validator = Validation::createValidator();
            $errors = $validator->validate($buildingAddressObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($buildingAddressObject);
        }

        $manager->flush();
    }

    private function getBeginErrorMessageFromBuildingAddress($buildingAddress): string
    {
        return $buildingAddress['zipcode'] . ' ' . $buildingAddress['housenumber'] . (empty($buildingAddress['addition']) ? '' : ' ' . $buildingAddress['addition']) . ": ";
    }

    public function getDependencies(): array
    {
        return [
            LoadHousingStocksData::class,
            LoadMunicipalityData::class,
            LoadResidentialAreaData::class,
            LoadNeighbourhoodData::class,
            LoadBlockData::class,
            LoadVtwData::class,
            LoadBuildingTypeData::class
        ];
    }
}
