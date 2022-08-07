<?php

namespace App\DataFixtures;

use App\Bag\Application\Arcgis\ArcgisException;
use App\Bag\Application\SQLite\CbsException;
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
        $addresses = require_once
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

        $progressBar = new ProgressBar($this->output, count($addresses));
        $progressBar->setFormat('debug');
        $progressBar->setBarWidth(100);

        $this->output->writeln('');
        $this->output->writeln('Count: ' . count($addresses));
        $this->output->writeln('');

        $progressBar->start();

        foreach ($addresses as $address) {

            $progressBar->advance();

            $addressObject = new Address();

            try {
                /** @var HousingStock $housingStock */
                $housingStock = $this->getReference($address['housingstock']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug(
                    $outOfBoundsException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        [
                            'subject' => 'reference to a housingstock',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }
            $addressObject->setHousingStock($housingStock);

            $addressObject->setZipcode($address['zipcode']);

            $addressObject->setHouseNumber($address['housenumber']);

            try {
                $cbsResults = $cbsRepository->getNeighbourhoodResidentialareaMunicipalityByZipcodeHousenumber($address['zipcode'] . $address['housenumber']);
            } catch (CbsException $cbsException) {
                $this->logger->debug(
                    $cbsException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        $cbsException->getContext(),
                        [
                            'subject' => 'missing data from sqlite cbs database',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }

            try {
                /** @var Municipality $municipality */
                $municipality = $this->getReference($cbsResults['municipality']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug(
                    $outOfBoundsException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        [
                            'subject' => 'reference to a municipality',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }
            $addressObject->setMunicipality($municipality);

            try {
                /** @var ResidentialArea $residentialarea */
                $residentialarea = $this->getReference($cbsResults['residentialarea']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug(
                    $outOfBoundsException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        [
                            'subject' => 'reference to a residentialarea',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }
            $addressObject->setResidentialArea($residentialarea);

            try {
                /** @var Neighbourhood $neighbourhood */
                $neighbourhood = $this->getReference($cbsResults['neighbourhood']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug(
                    $outOfBoundsException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        [
                            'subject' => 'reference to a neighbourhood',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }
            $addressObject->setNeighbourhood($neighbourhood);

            try {
                /** @var Block $block */
                $block = $this->getReference($address['block']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug(
                    $outOfBoundsException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        [
                            'subject' => 'reference to a block',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }
            $addressObject->setBlock($block);

            try {
                /** @var BuildingType $buildingtype */
                $buildingtype = $this->getReference($address['buildingtype']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug(
                    $outOfBoundsException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        [
                            'subject' => 'reference to a buildingtype',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }
            $addressObject->setBuildingType($buildingtype);

            $addressObject->setRentalUnitNumber($address['rentalunitnumber']);

            if (!empty($address['addition'])) {
                $addressObject->setAddition($address['addition']);
            }

            try {
                $arcgisResults = $arcgisRepository->getAddressByZipcodeAndHousenumber($address['zipcode'], $address['housenumber'], $address['addition']);
            } catch (ArcgisException $arcgisException) {
                $this->logger->debug(
                    $arcgisException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        $arcgisException->getContext(),
                        [
                            'subject' => 'error with request to arcgis api',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }

            $addressObject->setObjectId($arcgisResults['objectid']);
            $addressObject->setIdentification($arcgisResults['identification']);

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
            $addressObject->setBuilding($buildings[$arcgisResults['building']['objectid']]);

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
            $addressObject->setResidence($residences[$arcgisResults['residence']['objectid']]);

            if (!array_key_exists($arcgisResults['publicspace']['objectid'], $publicspaces)) {
                $publicSpace = new PublicSpace();
                $publicSpace->setObjectId($arcgisResults['publicspace']['objectid']);
                $publicSpace->setIdentification($arcgisResults['publicspace']['identification']);
                $publicSpace->setName($arcgisResults['publicspace']['name']);
                $publicSpace->setType($arcgisResults['publicspace']['type']);
                $manager->persist($publicSpace);
                $publicspaces[$arcgisResults['publicspace']['objectid']] = $publicSpace;
            }
            $addressObject->setPublicSpace($publicspaces[$arcgisResults['publicspace']['objectid']]);

            if (!array_key_exists($arcgisResults['city']['objectid'], $citys)) {
                $city = new City();
                $city->setObjectId($arcgisResults['city']['objectid']);
                $city->setIdentification($arcgisResults['city']['identification']);
                $city->setName($arcgisResults['city']['name']);
                $manager->persist($city);
                $citys[$arcgisResults['city']['objectid']] = $city;
            }
            $addressObject->setCity($citys[$arcgisResults['city']['objectid']]);

            $addressObject->setOrientation($address['orientation']);

            $addressObject->setDaeb($address['daeb']);

            try {
                /** @var Vtw $vtw */
                $vtw = $this->getReference($address['vtw']);
            } catch (OutOfBoundsException $outOfBoundsException) {
                $this->logger->debug(
                    $outOfBoundsException->getMessage(),
                    array_merge(
                        $this->getLoggingContext($address),
                        [
                            'subject' => 'reference to a vtw',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }
            $addressObject->setVtw($vtw);

            $addressObject->setCreationTime();
            $addressObject->setLastChangeTime();

            $validator = Validation::createValidator();
            $errors = $validator->validate($addressObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                $this->logger->error(
                    implode(', ', $messages),
                    array_merge(
                        $this->getLoggingContext($address),
                        [
                            'subject' => 'constraint violation',
                            'class' => __CLASS__,
                            'function' => __FUNCTION__,
                            'line' => __LINE__,
                        ]
                    )
                );
                continue;
            }

            $manager->persist($addressObject);
        }

        $progressBar->finish();

        $this->output->writeln('');

        $manager->flush();
    }

    #[ArrayShape(['address' => "array", 'housingstock' => "string"])]
    private function getLoggingContext($address): array
    {
        return [
            'housingstock' => $address['housingstock'],
            'address' => [
                'zipcode' => $address['zipcode'],
                'housenumber' => $address['housenumber'],
                'addition' => $address['addition'],
            ],
        ];
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
