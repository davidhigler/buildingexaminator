<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Portfolio\ResidentialArea;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use App\Entity\Portfolio\Municipality;
use \ZipArchive;

#[AsCommand(
    name: 'app:import:cbs',
    description: 'Import Cbs data.'
)]
class ImportCbsData extends Command
{
    public function __construct(
        #[Autowire('%kernel.project_dir%' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'cbs')] private readonly string $dataCbsDir,
        private readonly LoggerInterface $logger,
        private readonly ManagerRegistry $managerRegistry,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp(
            'This command takes the zip from Cbs from https://www.cbs.nl/nl-nl/zoeken?q=%22voor+postcode+huisnummer%22 ' .
            'and imports the data into the database and cbs.db file. ' .
            'Municipalities, residential areas, neighbourhoods and zipcode + house number in relation to the first three.'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $symfonyStyle = new SymfonyStyle($input, $output);

        $symfonyStyle->title('Importing Cbs data');

        // ############################################################################################################

        $symfonyStyle->info('Get latest Cbs zip file from ' . $this->dataCbsDir);

        $cbsZipFiles = glob($this->dataCbsDir . DIRECTORY_SEPARATOR . '*.zip');
        if (empty($cbsZipFiles)) {
            $symfonyStyle->error(
                sprintf(
                    'No Cbs zip files were found in directory %s',
                    $this->dataCbsDir
                )
            );
            $this->logger->error(
                'No Cbs zip files were found',
                [
                    'directory' => $this->dataCbsDir,
                ]
            );
            return Command::FAILURE;
        }
        $latestCbsZipFile = array_pop($cbsZipFiles);

        // ############################################################################################################

        $symfonyStyle->info('Extract latest Cbs zip file ' . $latestCbsZipFile);

        $extractionDir = $this->dataCbsDir . DIRECTORY_SEPARATOR . pathinfo($latestCbsZipFile, PATHINFO_FILENAME);
        $zip = new ZipArchive();
        if ($zip->open($latestCbsZipFile) !== true) {
            $symfonyStyle->error(
                sprintf(
                    'Error opening Cbs zip file %s',
                    $latestCbsZipFile
                )
            );
            $this->logger->error(
                'Error opening Cbs zip file',
                [
                    'file' => $latestCbsZipFile,
                ]
            );
            return Command::FAILURE;
        }
        if (is_dir($extractionDir) === false) {
            if (mkdir($extractionDir, 0777, true) === false && is_dir($extractionDir) === false) {
                $symfonyStyle->error(
                    sprintf(
                        'Error creating extraction dir %s',
                        $extractionDir
                    )
                );
                $this->logger->error(
                    'Error creating extraction dir',
                    [
                        'directory' => $extractionDir,
                    ]
                );
                $zip->close();
                return Command::FAILURE;
            }
        }
        if ($zip->extractTo($extractionDir) === false) {
            $symfonyStyle->error(
                sprintf(
                    'Error extracting Cbs zip file %s',
                    $latestCbsZipFile
                )
            );
            $this->logger->error(
                'Error extracting Cbs zip file',
                [
                    'file' => $latestCbsZipFile,
                ]
            );
            $zip->close();
            return Command::FAILURE;
        }
        $zip->close();

        // ############################################################################################################

        $zipcodeHouseNumberCsvFile = array_first(glob($extractionDir . DIRECTORY_SEPARATOR . 'pc*gwb.csv'));

        if (empty($zipcodeHouseNumberCsvFile)) {
            $symfonyStyle->error(
                sprintf(
                    'There is no pc*gwb.csv file in extraction directory %s',
                    $extractionDir
                )
            );
            $this->logger->error(
                'There is no pc*gwb.csv file in extraction directory',
                [
                    'directory' => $extractionDir,
                ]
            );
            return Command::FAILURE;
        }

//        $symfonyStyle->info('Import and process main CSV file ' . $zipcodeHouseNumberCsvFile);
//
//        $zipcodeHouseNumberCsvFileHandler = fopen($zipcodeHouseNumberCsvFile, 'r');
//        if ($zipcodeHouseNumberCsvFileHandler === false) {
//            $symfonyStyle->error(
//                sprintf(
//                    'Could not open zipcode and house number csv file %s',
//                    $zipcodeHouseNumberCsvFile
//                )
//            );
//            $this->logger->error(
//                'Could not open zipcode and house number csv file',
//                [
//                    'file' => $zipcodeHouseNumberCsvFile,
//                ]
//            );
//            return Command::FAILURE;
//        }
//        $zipcodeHouseNumberCsvFileLineCount = 0;
//        while(!feof($zipcodeHouseNumberCsvFileHandler)){
//            fgets($zipcodeHouseNumberCsvFileHandler);
//            $zipcodeHouseNumberCsvFileLineCount++;
//        }
//        fclose($zipcodeHouseNumberCsvFileHandler);
//
//        $zipcodeHouseNumberCsvFileHandler = fopen($zipcodeHouseNumberCsvFile, 'r');
//        $municipalityManager = $this->managerRegistry->getManagerForClass(Municipality::class);
//        $municipalityRepository = $this->managerRegistry->getRepository(Municipality::class);
//        $symfonyStyle->progressStart($zipcodeHouseNumberCsvFileLineCount);
//
//        $first = true;
//        while (($row = fgetcsv($zipcodeHouseNumberCsvFileHandler, 0, ';')) !== false) {
//            if ($first) {
//                $first = false;
//                continue;
//            }
//
//            $municipalityCode = ltrim(trim($row[0]), '0');
//            $municipalityName = trim($row[1]);
//
//            $result = $municipalityRepository->findBy(['code' => $municipalityCode]);
//
//            if (empty($result)) {
//                $newMunicipality = new Municipality();
//                $newMunicipality->setCode($municipalityCode);
//                $newMunicipality->setName($municipalityName);
//
//                $municipalityManager->persist($newMunicipality);
//                $municipalityManager->flush();
//            }
//
//            $symfonyStyle->progressAdvance();
//        }
//        $symfonyStyle->progressFinish();
//        fclose($zipcodeHouseNumberCsvFileHandler);

//        $municipalitiesCsvFile = array_first(glob($extractionDir . DIRECTORY_SEPARATOR . 'gem*.csv'));
//
//        if (empty($municipalitiesCsvFile)) {
//            $symfonyStyle->error(
//                sprintf(
//                    'There is no gem*.csv file in extraction directory %s',
//                    $extractionDir
//                )
//            );
//            $this->logger->error(
//                'There is no gem*.csv file in extraction directory',
//                [
//                    'directory' => $extractionDir,
//                ]
//            );
//            return Command::FAILURE;
//        }
//
//        $symfonyStyle->info('Import municipalities CSV file ' . $municipalitiesCsvFile);
//
//        $municipalitiesCsvFileHandler = fopen($municipalitiesCsvFile, 'r');
//        if ($municipalitiesCsvFileHandler === false) {
//            $symfonyStyle->error(
//                sprintf(
//                    'Could not open municipalities csv file %s',
//                    $municipalitiesCsvFile
//                )
//            );
//            $this->logger->error(
//                'Could not open municipalities csv file',
//                [
//                    'file' => $municipalitiesCsvFile,
//                ]
//            );
//            return Command::FAILURE;
//        }
//        $municipalitiesCsvFileLineCount = 0;
//        while(!feof($municipalitiesCsvFileHandler)){
//            fgets($municipalitiesCsvFileHandler);
//            $municipalitiesCsvFileLineCount++;
//        }
//        fclose($municipalitiesCsvFileHandler);
//
//        $municipalitiesCsvFileHandler = fopen($municipalitiesCsvFile, 'r');
//        $municipalityManager = $this->managerRegistry->getManagerForClass(Municipality::class);
//        $municipalityRepository = $this->managerRegistry->getRepository(Municipality::class);
//        $symfonyStyle->progressStart($municipalitiesCsvFileLineCount);
//
//        $first = true;
//        while (($row = fgetcsv($municipalitiesCsvFileHandler, 0, ';')) !== false) {
//            if ($first) {
//                $first = false;
//                continue;
//            }
//
//            $municipalityCode = ltrim(trim($row[0]), '0');
//            $municipalityName = trim($row[1]);
//
//            $result = $municipalityRepository->findBy(['code' => $municipalityCode]);
//
//            if (empty($result)) {
//                $newMunicipality = new Municipality();
//                $newMunicipality->setCode($municipalityCode);
//                $newMunicipality->setName($municipalityName);
//
//                $municipalityManager->persist($newMunicipality);
//                $municipalityManager->flush();
//            }
//
//            $symfonyStyle->progressAdvance();
//        }
//        $symfonyStyle->progressFinish();
//        fclose($municipalitiesCsvFileHandler);
//
        // ############################################################################################################
//
//        $residentialAreasCsvFile = array_first(glob($extractionDir . DIRECTORY_SEPARATOR . 'wijk*.csv'));
//
//        if (empty($residentialAreasCsvFile)) {
//            $symfonyStyle->error(
//                sprintf(
//                    'There is no wijk*.csv file in extraction directory %s',
//                    $extractionDir
//                )
//            );
//            $this->logger->error(
//                'There is no wijk*.csv file in extraction directory',
//                [
//                    'directory' => $extractionDir,
//                ]
//            );
//            return Command::FAILURE;
//        }
//
//        $symfonyStyle->info('Import residential areas CSV file ' . $residentialAreasCsvFile);
//
//        $residentialAreasCsvFileHandler = fopen($residentialAreasCsvFile, 'r');
//        if ($residentialAreasCsvFileHandler === false) {
//            $symfonyStyle->error(
//                sprintf(
//                    'Could not open residential areas csv file %s',
//                    $residentialAreasCsvFile
//                )
//            );
//            $this->logger->error(
//                'Could not open residential areas csv file',
//                [
//                    'file' => $residentialAreasCsvFile,
//                ]
//            );
//            return Command::FAILURE;
//        }
//        $residentialAreasCsvFileLineCount = 0;
//        while(!feof($residentialAreasCsvFileHandler)){
//            fgets($residentialAreasCsvFileHandler);
//            $residentialAreasCsvFileLineCount++;
//        }
//        fclose($residentialAreasCsvFileHandler);
//
//        $residentialAreasCsvFileHandler = fopen($residentialAreasCsvFile, 'r');
//        $residentialAreaManager = $this->managerRegistry->getManagerForClass(ResidentialArea::class);
//        $residentialAreaRepository = $this->managerRegistry->getRepository(ResidentialArea::class);
//        $symfonyStyle->progressStart($residentialAreasCsvFileLineCount);
//
//        $first = true;
//        while (($row = fgetcsv($residentialAreasCsvFileHandler, 0, ';')) !== false) {
//            if ($first) {
//                $first = false;
//                continue;
//            }
//
//            $residentialAreaCode = ltrim(trim($row[0]), '0');
//            $residentialAreaName = trim($row[1]);
//
//            $result = $residentialAreaRepository->findBy(['code' => $residentialAreaCode]);
//
//            if (empty($result)) {
//                $residentialArea = new ResidentialArea();
//                $residentialArea->setCode($residentialAreaCode);
//                $residentialArea->setName($residentialAreaName);
//
//                $residentialAreaManager->persist($residentialArea);
//                $residentialAreaManager->flush();
//            }
//
        // ############################################################################################################

        $symfonyStyle->success('Import of Cbs data successful');

        return Command::SUCCESS;
    }
}