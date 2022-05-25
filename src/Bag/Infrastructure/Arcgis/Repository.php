<?php

namespace App\Bag\Infrastructure\Arcgis;

use App\Bag\Application\Arcgis\ArcgisException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\ArrayShape;

class Repository
{
    private Client $client;

    public function __construct() {
        $this->client = new Client();
    }

    /**
     * @throws ArcgisException
     */
    #[ArrayShape([
        'objectid' => "int",
        'identification' => "string",
        'housenumber' => "int",
        'addition' => "string",
        'zipcode' => "string",
        'residence' => [
            'objectid' => "int",
            'identification' => "string",
            'surfacearea' => "int",
            'status' => "string",
            'intendeduse' => "string",
            'intendedusebasic' => "string"
        ],
        'publicspace' => [
            'objectid' => "int",
            'identification' => "string",
            'name' => "string",
            'type' => "string"
        ],
        'building' => [
            'objectid' => "int",
            'identification' => "string",
            'constructionyear' => "int",
            'status' => "string",
            'residencecount' => "int",
            'surfacearea' => "int"
        ],
        'city' => [
            'objectid' => "int",
            'identification' => "string",
            'name' => "string"
        ]
    ])]
    public function getAddressByZipcodeAndHousenumber(string $zipcode, int $housenumber, ?string $houseletter): array
    {
        $huisletterWhere = ' and huisletter';
        if (empty($houseletter)) {
            $huisletterWhere .= ' IS NULL';
        } else {
            $huisletterWhere .= "='" . $houseletter . "'";
        }

        $url = 'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/query';

        try {
            $response = $this->client->request(
                'POST',
                $url,
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
        } catch (GuzzleException $exception) {
            throw new ArcgisException('post request to ' . $url . ' throwed a guzzle exception', 0, $exception);
        }

        $data = json_decode($response->getBody(), true);

        if (empty($data['features'][0]['attributes']['objectid'])) {
            throw new ArcgisException('response from arcgis does not have the expected response', 0);
        }

        if (count($data['features']) > 1) {
            throw new ArcgisException('response from arcgis have more than one result', 0);
        }

        return [
            'objectid' => (int)$data['features'][0]['attributes']['objectid'],
            'identification' => $data['features'][0]['attributes']['identificatie'],
            'housenumber' => (int)$data['features'][0]['attributes']['huisnummer'],
            'addition' => $data['features'][0]['attributes']['huisletter'],
            'zipcode' => $data['features'][0]['attributes']['postcode'],
            'residence' => $this->getResidenceByAddressObjectId($data['features'][0]['attributes']['objectid']),
            'publicspace' => $this->getPublicSpaceByAddressObjectId($data['features'][0]['attributes']['objectid']),
            'building' => $this->getBuildingByAddressObjectId($data['features'][0]['attributes']['objectid']),
            'city' => $this->getCityByAddressObjectId($data['features'][0]['attributes']['objectid'])
        ];
    }

    /**
     * @throws ArcgisException
     */
    #[ArrayShape([
        'objectid' => "int",
        'identification' => "string",
        'surfacearea' => "int",
        'status' => "string",
        'intendeduse' => "string",
        'intendedusebasic' => "string"
    ])]
    private function getResidenceByAddressObjectId(string $addressobjectid): array
    {
        $url = 'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/queryRelatedRecords';

        try {
            $response = $this->client->request(
                'POST',
                $url,
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
        } catch (GuzzleException $exception) {
            throw new ArcgisException('Call to ' . $url . ' throwed an guzzle exception', 0, $exception);
        }

        $data = json_decode($response->getBody(), true);

        if (empty($data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'])) {
            throw new ArcgisException('response from arcgis does not have the expected response', 0);
        }

        if (count($data['relatedRecordGroups'][0]['relatedRecords']) > 1) {
            throw new ArcgisException('response from arcgis have more than one result', 0);
        }

        return [
            'objectid' => (int)$data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'],
            'identification' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['identificatie'],
            'surfacearea' => (int)$data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['oppervlakte'],
            'status' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['status'],
            'intendeduse' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['gebruiksdoel'],
            'intendedusebasic' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['gebruiksdoel1'],
        ];
    }

    /**
     * @throws ArcgisException
     */
    #[ArrayShape([
        'objectid' => "int",
        'identification' => "string",
        'name' => "string",
        'type' => "string"
    ])]
    private function getPublicSpaceByAddressObjectId(string $addressobjectid): array
    {
        $url = 'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/queryRelatedRecords';

        try {
            $response = $this->client->request(
                'POST',
                $url,
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
        } catch (GuzzleException $exception) {
            throw new ArcgisException('Call to ' . $url . ' throwed an guzzle exception', 0, $exception);
        }

        $data = json_decode($response->getBody(), true);

        if (empty($data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'])) {
            throw new ArcgisException('response from arcgis does not have the expected response', 0);
        }

        if (count($data['relatedRecordGroups'][0]['relatedRecords']) > 1) {
            throw new ArcgisException('response from arcgis have more than one result', 0);
        }

        return [
            'objectid' => (int)$data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'],
            'identification' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['identificatie'],
            'name' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['naam'],
            'type' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['type'],
        ];
    }

    /**
     * @throws ArcgisException
     */
    #[ArrayShape([
        'objectid' => "int",
        'identification' => "string",
        'constructionyear' => "int",
        'status' => "string",
        'residencecount' => "int",
        'surfacearea' => "int"
    ])]
    private function getBuildingByAddressObjectId(string $addressobjectid): array
    {
        $url = 'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/queryRelatedRecords';

        try {
            $response = $this->client->request(
                'POST',
                $url,
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
        } catch (GuzzleException $exception) {
            throw new ArcgisException('Call to ' . $url . ' throwed an guzzle exception', 0, $exception);
        }

        $data = json_decode($response->getBody(), true);

        if (empty($data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'])) {
            throw new ArcgisException('response from arcgis does not have the expected response', 0);
        }

        if (count($data['relatedRecordGroups'][0]['relatedRecords']) > 1) {
            throw new ArcgisException('response from arcgis have more than one result', 0);
        }

        return [
            'objectid' => (int)$data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'],
            'identification' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['identificatie'],
            'constructionyear' => (int)$data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['bouwjaar'],
            'status' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['status'],
            'residencecount' => (int)$data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['aantal_verblijfsobjecten'],
            'surfacearea' => (int)$data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['oppervlakte'],
        ];
    }

    /**
     * @throws ArcgisException
     */
    #[ArrayShape([
        'objectid' => "int",
        'identification' => "string",
        'name' => "string"
    ])]
    private function getCityByAddressObjectId(string $addressobjectid): array
    {
        $url = 'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/0/queryRelatedRecords';

        try {
            $response = $this->client->request(
                'POST',
                $url,
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
        } catch (GuzzleException $exception) {
            throw new ArcgisException('Call to ' . $url . ' throwed an guzzle exception', 0, $exception);
        }

        $data = json_decode($response->getBody(), true);

        if (empty($data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'])) {
            throw new ArcgisException('response from arcgis does not have the expected response', 0);
        }

        if (count($data['relatedRecordGroups'][0]['relatedRecords']) > 1) {
            throw new ArcgisException('response from arcgis have more than one result', 0);
        }

        return [
            'objectid' => (int)$data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['objectid'],
            'identification' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['identificatie'],
            'name' => $data['relatedRecordGroups'][0]['relatedRecords'][0]['attributes']['naam'],
        ];
    }

    /**
     * @throws ArcgisException
     */
    #[ArrayShape([
        'objectid' => "int",
        'identification' => "string",
        'name' => "string"
    ])]
    public function getCityByName(string $name): array
    {
        $url = 'https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/MapServer/5/query';

        try {
            $response = $this->client->request(
                'POST',
                $url,
                [
                    'form_params' => [
                        'where' => "naam='" . $name . "'",
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
        } catch (GuzzleException $exception) {
            throw new ArcgisException('Call to ' . $url . ' throwed an guzzle exception', 0, $exception);
        }

        $data = json_decode($response->getBody(), true);

        if (empty($data['features'][0]['attributes']['objectid'])) {
            throw new ArcgisException('response from arcgis does not have the expected response', 0);
        }

        if (count($data['features']) > 1) {
            throw new ArcgisException('response from arcgis have more than one result', 0);
        }

        return [
            'objectid' => (int)$data['features'][0]['attributes']['objectid'],
            'identification' => $data['features'][0]['attributes']['identificatie'],
            'name' => $data['features'][0]['attributes']['naam'],
        ];
    }
}