<?php

namespace App\Command;

use App\Bag\Infrastructure\Arcgis\Repository;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[\Symfony\Component\Console\Attribute\AsCommand(name: 'app:import:csv:address-basic', description: 'Import data from a CSV file. With data being a simple address.')]
class ImportFromCsvBasicAddressesCommand extends Command
{
    protected function configure(): void
    {
        $this->setHelp('This command takes the zipcode, housenumber and houseletter from a CSV file and finds the BagId through the Bag API');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $repository = new Repository();

        $csvLines = array_map(
            'str_getcsv',
            file(
                __DIR__ . DIRECTORY_SEPARATOR .
                '..' . DIRECTORY_SEPARATOR .
                '..' . DIRECTORY_SEPARATOR .
                'downloads' . DIRECTORY_SEPARATOR .
                'DobroTest01_small.csv'
            )
        );

        $addresses = [];
        foreach ($csvLines as $csvLine) {
            //$vhe = $csvLine[0];
            $zipcode = strtoupper((string) $csvLine[1]);
            //$streetname = $csvLine[2];
            $housenumber = (int) $csvLine[3];
            $addition = strtoupper((string) $csvLine[4]);
            //$block = $csvLine[5];

            if (empty($zipcode) || preg_match("/[1-9]\d{3}[A-Z]{2}/i", $zipcode) === 0) {
                throw new RuntimeException('Zipcode is empty or is not in the form of 4 numbers and 2 uppercase letters without a space in bewtween');
            }

            if (!($housenumber > 0)) {
                throw new RuntimeException('Housenumber is not a number or is not as positive integer');
            }

            if (empty($addition)) {
                $addition = null;
            }

            $address = [];

            try {
                $address['address'] = $repository->getAddressByZipcodeAndHousenumber($zipcode, $housenumber, $addition);
            } catch (GuzzleException $exception) {
                $io->error($exception->getMessage());
                continue;
            }

            $addresses[] = $address;
        }

        foreach ($addresses as $address) {
            $io->title($address['address']['zipcode'] . ' ' . $address['address']['housenumber'] . $address['address']['addition']);
            foreach ($address as $category => $data) {
                $io->writeln('<fg=blue>' . $category . '</>');
                foreach ($data as $key => $value) {
                    $io->writeln("\t" . $key . ': ' . $value);
                }
            }
            $io->writeln('');
        }

        return Command::SUCCESS;
    }
}