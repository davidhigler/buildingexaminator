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
use JetBrains\PhpStorm\ArrayShape;
use OutOfBoundsException;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

/**
 * @author Reiny Griemink <rgriemink@gmail.com>
 */
class LoadAddressData extends Fixture implements DependentFixtureInterface, EventSubscriberInterface, LoggerAwareInterface
{
    private OutputInterface $output;
    private LoggerInterface $logger;

    #[ArrayShape([ConsoleEvents::COMMAND => "string"])]
    public static function getSubscribedEvents(): array
    {
        return [
            ConsoleEvents::COMMAND => 'init',
        ];
    }

    public function init(ConsoleCommandEvent $event): void
    {
        $this->output = $event->getOutput();
    }

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

        $buildings = [];
        $residences = [];
        $publicspaces = [];
        $citys = [];

        $progressBar = new ProgressBar($this->output, count($buildingAddresses));
        $progressBar->setFormat('debug');
        $progressBar->setBarWidth(100);
        $progressBar->start();

        foreach ($buildingAddresses as $buildingAddress) {

            $progressBar->advance();

            $buildingAddressObject = new Address();

            try {
                /** @var HousingStock $housingStock */
                $housingStock = $this->getReference($buildingAddress['housingstock']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage());
                continue;
            }
            $buildingAddressObject->setHousingStock($housingStock);

            $buildingAddressObject->setZipcode($buildingAddress['zipcode']);

            $buildingAddressObject->setHouseNumber($buildingAddress['housenumber']);

            $cbsResults = $cbsRepository->getNeighbourhoodResidentialareaMunicipalityByZipcodeHousenumber($buildingAddress['zipcode'] . $buildingAddress['housenumber']);

            if (
                !array_key_exists('municipality', $cbsResults)
                || !array_key_exists('residentialarea', $cbsResults)
                || !array_key_exists('neighbourhood', $cbsResults)
            ) {
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . "Missing data in the cbs SQLite database");
                continue;
            }

            try {
                /** @var Municipality $municipality */
                $municipality = $this->getReference($cbsResults['municipality']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage());
                continue;
            }
            $buildingAddressObject->setMunicipality($municipality);

            try {
                /** @var ResidentialArea $residentialarea */
                $residentialarea = $this->getReference($cbsResults['residentialarea']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage());
                continue;
            }
            $buildingAddressObject->setResidentialArea($residentialarea);

            try {
                /** @var Neighbourhood $neighbourhood */
                $neighbourhood = $this->getReference($cbsResults['neighbourhood']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage());
                continue;
            }
            $buildingAddressObject->setNeighbourhood($neighbourhood);

            try {
                /** @var Block $block */
                $block = $this->getReference($buildingAddress['block']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage());
                continue;
            }
            $buildingAddressObject->setBlock($block);

            try {
                /** @var BuildingType $buildingtype */
                $buildingtype = $this->getReference($buildingAddress['buildingtype']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage());
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
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $arcgisException);
                continue;
            }

            $buildingAddressObject->setObjectId($arcgisResults['objectid']);
            $buildingAddressObject->setIdentification($arcgisResults['identification']);

            if (!array_key_exists($arcgisResults['building']['objectid'], $buildings)) {
                $building = new Building();
                $building->setObjectId($arcgisResults['building']['objectid']);
                $building->setIdentification($arcgisResults['building']['identification']);
                $building->setConstructionYear($arcgisResults['building']['constructionyear']);
                $building->setStatus($arcgisResults['building']['status']);
                $building->setResidenceCount($arcgisResults['building']['residencecount']);
                $building->setSurfaceArea($arcgisResults['building']['surfacearea']);
                $manager->persist($building);
                $buildings[$arcgisResults['building']['objectid']] = $building;
            }
            $buildingAddressObject->setBuilding($buildings[$arcgisResults['building']['objectid']]);

            if (!array_key_exists($arcgisResults['residence']['objectid'], $residences)) {
                $residence = new Residence();
                $residence->setObjectId($arcgisResults['residence']['objectid']);
                $residence->setIdentification($arcgisResults['residence']['identification']);
                $residence->setSurfaceArea($arcgisResults['residence']['surfacearea']);
                $residence->setStatus($arcgisResults['residence']['status']);
                $residence->setIntendedUse($arcgisResults['residence']['intendeduse']);
                $residence->setIntendedUseBasic($arcgisResults['residence']['intendedusebasic']);
                $manager->persist($residence);
                $residences[$arcgisResults['residence']['objectid']] = $residence;
            }
            $buildingAddressObject->setResidence($residences[$arcgisResults['residence']['objectid']]);

            if (!array_key_exists($arcgisResults['publicspace']['objectid'], $publicspaces)) {
                $publicSpace = new PublicSpace();
                $publicSpace->setObjectId($arcgisResults['publicspace']['objectid']);
                $publicSpace->setIdentification($arcgisResults['publicspace']['identification']);
                $publicSpace->setName($arcgisResults['publicspace']['name']);
                $publicSpace->setType($arcgisResults['publicspace']['type']);
                $manager->persist($publicSpace);
                $publicspaces[$arcgisResults['publicspace']['objectid']] = $publicSpace;
            }
            $buildingAddressObject->setPublicSpace($publicspaces[$arcgisResults['publicspace']['objectid']]);

            if (!array_key_exists($arcgisResults['city']['objectid'], $citys)) {
                $city = new City();
                $city->setObjectId($arcgisResults['city']['objectid']);
                $city->setIdentification($arcgisResults['city']['identification']);
                $city->setName($arcgisResults['city']['name']);
                $manager->persist($city);
                $citys[$arcgisResults['city']['objectid']] = $city;
            }
            $buildingAddressObject->setCity($citys[$arcgisResults['city']['objectid']]);

            $buildingAddressObject->setOrientation($buildingAddress['orientation']);

            $buildingAddressObject->setDaeb($buildingAddress['daeb']);

            try {
                /** @var Vtw $vtw */
                $vtw = $this->getReference($buildingAddress['vtw']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug($this->getBeginErrorMessageFromBuildingAddress($buildingAddress) . $outOfBoundsException->getMessage());
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
                $this->logger->error(implode(', ', $messages));
                continue;
            }

            $manager->persist($buildingAddressObject);
        }

        $progressBar->finish();

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

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}
