<?php

namespace App\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\ArrayShape;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ImportFromCsvBasicAddressesCommand extends Command
{
    protected static $defaultName = 'app:import:csv:address-basic';
    protected static $defaultDescription = "Import data from a CSV file. With data being a simple address.";
    private Client $client;

    protected function configure(): void
    {
        $this->setHelp('This command takes the zipcode, housenumber and houseletter from a CSV file and finds the BagId through the ');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $this->client = new Client();

        $csvLines = array_map('str_getcsv', file(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'downloads' . DIRECTORY_SEPARATOR . 'DobroTest02_small.csv'));

        $addresses = [];
        foreach ($csvLines as $csvLine) {
            //$vhe = $csvLine[0];
            $zipcode = strtoupper($csvLine[1]);
            //$streetname = $csvLine[2];
            $housenumber = (int) $csvLine[3];
            $addition = strtoupper($csvLine[4]);
            //$block = $csvLine[5];

            if (empty($zipcode) || preg_match("/[1-9][0-9]{3}[A-Z]{2}/i", $zipcode) === 0) {
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
                $address['address'] = $this->getAddress($zipcode, $housenumber, $addition);
                $address['residence'] = $this->getResidence($address['address']['objectid']);
                $address['publicspace'] = $this->getPublicSpace($address['address']['objectid']);
                $address['building'] = $this->getBuilding($address['address']['objectid']);
                $address['city'] = $this->getCity($address['address']['objectid']);
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

    /**
     * @throws GuzzleException
     */
    #[ArrayShape(['objectid' => "mixed", 'identification' => "mixed", 'housenumber' => "mixed", 'addition' => "mixed", 'zipcode' => "mixed"])]
    private function getAddress(string $zipcode, int $housenumber, ?string $houseletter): array
    {
        $huisletterWhere = ' and huisletter';
        if (empty($houseletter)) {
            $huisletterWhere .= ' IS NULL';
        } else {
            $huisletterWhere .= "='" . $houseletter . "'";
        }

        $response = $this->client->request(
            'POST',
            'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/query',
            [
                'form_params' => [
                    'where' => "postcode='" . $zipcode . "' and huisnummer=" . $housenumber . $huisletterWhere,
                    'outFields' => 'objectid,identificatie,huisnummer,huisletter,postcode',
                    'f' => 'pjson'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic PEJhc2ljIEF1dGggVXNlcm5hbWU+OjxCYXNpYyBBdXRoIFBhc3N3b3JkPg==',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]
        );

        $data = json_decode($response->getBody(), true);

        return [
            'objectid' => $data['features'][0]['attributes']['objectid'],
            'identification' => $data['features'][0]['attributes']['identificatie'],
            'housenumber' => $data['features'][0]['attributes']['huisnummer'],
            'addition' => $data['features'][0]['attributes']['huisletter'],
            'zipcode' => $data['features'][0]['attributes']['postcode'],
        ];
    }

    /**
     * @throws GuzzleException
     */
    #[ArrayShape(['objectid' => "mixed", 'identificatie' => "mixed", 'surfacearea' => "mixed", 'status' => "mixed", 'intendeduse' => "mixed", 'intendedusebasic' => "mixed"])]
    private function getResidence(string $addressobjectid): array
    {
        $response = $this->client->request(
            'POST',
            'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/queryRelatedRecords',
            [
                'form_params' => [
                    'objectIds' => $addressobjectid,
                    'relationshipId' => 5,
                    'outFields' => 'objectid,identificatie,oppervlakte,status,gebruiksdoel,gebruiksdoel1',
                    'f' => 'pjson'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic PEJhc2ljIEF1dGggVXNlcm5hbWU+OjxCYXNpYyBBdXRoIFBhc3N3b3JkPg==',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]
        );

        $data = json_decode($response->getBody(), true);

        //var_dump($data);

        return [
            'objectid' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'],
            'identificatie' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['identificatie'],
            'surfacearea' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['oppervlakte'],
            'status' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['status'],
            'intendeduse' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['gebruiksdoel'],
            'intendedusebasic' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['gebruiksdoel1'],
        ];
    }

    /**
     * @throws GuzzleException
     */
    #[ArrayShape(['objectid' => "mixed", 'identificatie' => "mixed", 'name' => "mixed", 'type' => "mixed"])]
    private function getPublicSpace(string $addressobjectid): array
    {
        $response = $this->client->request(
            'POST',
            'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/queryRelatedRecords',
            [
                'form_params' => [
                    'objectIds' => $addressobjectid,
                    'relationshipId' => 2,
                    'outFields' => 'objectid,identificatie,voorkomenidentificatie,naam,type',
                    'f' => 'pjson'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic PEJhc2ljIEF1dGggVXNlcm5hbWU+OjxCYXNpYyBBdXRoIFBhc3N3b3JkPg==',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]
        );

        $data = json_decode($response->getBody(), true);

        return [
            'objectid' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'],
            'identificatie' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['identificatie'],
            'name' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['naam'],
            'type' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['type'],
        ];
    }

    /**
     * @throws GuzzleException
     */
    #[ArrayShape(['objectid' => "mixed", 'identificatie' => "mixed", 'constructionyear' => "mixed", 'status' => "mixed", 'residencecount' => "mixed", 'surfacearea' => "mixed"])]
    private function getBuilding(string $addressobjectid): array
    {
        $response = $this->client->request(
            'POST',
            'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/queryRelatedRecords',
            [
                'form_params' => [
                    'objectIds' => $addressobjectid,
                    'relationshipId' => 0,
                    'outFields' => 'objectid,identificatie,bouwjaar,status,aantal_verblijfsobjecten,oppervlakte',
                    'f' => 'pjson'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic PEJhc2ljIEF1dGggVXNlcm5hbWU+OjxCYXNpYyBBdXRoIFBhc3N3b3JkPg==',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]
        );

        $data = json_decode($response->getBody(), true);

        return [
            'objectid' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'],
            'identificatie' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['identificatie'],
            'constructionyear' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['bouwjaar'],
            'status' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['status'],
            'residencecount' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['aantal_verblijfsobjecten'],
            'surfacearea' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['oppervlakte'],
        ];
    }

    /**
     * @throws GuzzleException
     */
    #[ArrayShape(['objectid' => "mixed", 'identificatie' => "mixed", 'name' => "mixed"])]
    private function getCity(string $addressobjectid): array
    {
        $response = $this->client->request(
            'POST',
            'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/queryRelatedRecords',
            [
                'form_params' => [
                    'objectIds' => $addressobjectid,
                    'relationshipId' => 7,
                    'outFields' => 'objectid,identificatie,naam',
                    'f' => 'pjson'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic PEJhc2ljIEF1dGggVXNlcm5hbWU+OjxCYXNpYyBBdXRoIFBhc3N3b3JkPg==',
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]
        );

        $data = json_decode($response->getBody(), true);

        return [
            'objectid' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'],
            'identificatie' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['identificatie'],
            'name' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['naam'],
        ];
    }
}