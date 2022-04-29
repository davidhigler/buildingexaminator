<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\ResidentialArea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadResidentialAreasData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $residentialAreas = [
            [
                'code' => '019310',
                'name' => 'Binnenstad',
                'description' => 'De binnenstad van Zwolle is een autoluwe wijk met in het oude centrum van de stad. Het gebied wordt begrensd door de voormalige stadsmuren en grachten. Het is een wijk waar tegenwoordig met name winkelgebied is gelegen, zoals in de Sassenstraat, de Diezerstraat, de Oude Vismarkt, de Luttekestraat, de Melkmarkt, het Grote Kerkplein, het Rodetorenplein en de Grote Markt.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019311',
                'name' => 'Diezerpoort',
                'description' => 'Diezerpoort (ook: Dieze, Nijstad, Nieuwstad) is een woonwijk in de Overijsselse plaats Zwolle. De wijk bestaat uit een aantal buurten[2], te weten Dieze-Centrum, Dieze-West, Dieze-Oost en de Indische Buurt. De wijk wordt ook wel Dieze genoemd. De wijk is vernoemd naar de gelijknamige stadspoort.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019312',
                'name' => 'Wipstrik',
                'description' => 'Wipstrik is een woonwijk in de Overijsselse hoofdstad Zwolle. De wijk ligt dicht bij de binnenstad en is goed bereikbaar per auto, fiets en lopend. In de wijk wonen ongeveer 6.400 mensen.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019313',
                'name' => 'Assendorp',
                'description' => "Assendorp (Nedersaksisch: Ass'ndörp) is een wijk in Zwolle, in de Nederlandse provincie Overijssel.",
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019314',
                'name' => 'Kamperpoort-Veerallee',
                'description' => 'Kamperpoort-Veerallee is een woonwijk van de gemeente Zwolle. Het omvat de buurten Kamperpoort en Veerallee.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019320',
                'name' => 'Poort van Zwolle',
                'description' => 'Poort van Zwolle is een woonwijk in de gemeente Zwolle. Het omvat de buurten Spoolde, het bedrijventerrein Voorst-B en het bedrijventerrein Voorst-A. Er staan anno 2013 156 woningen.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019321',
                'name' => 'Westenholte',
                'description' => 'Westenholte is een wijk in Zwolle en een voormalige buurtschap in de Nederlandse provincie Overijssel.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019322',
                'name' => 'Stadshagen',
                'description' => 'Stadshagen is een Vinex-locatie in Zwolle gelegen in de polder Mastenbroek. Het telt 26.605 inwoners op 1 januari 2020.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019330',
                'name' => 'Holtenbroek',
                'description' => 'Holtenbroek is een woonwijk in de Overijsselse hoofdstad Zwolle.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019331',
                'name' => 'Aalanden',
                'description' => 'Aa-landen (uitspraak: A-landen) is een woonwijk in de Overijsselse plaats Zwolle. De wijk kent de volgende buurten: Aalanden-Noord, Aalanden-Oost, Aalanden-Midden, Aalanden-Zuid',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019332',
                'name' => 'Vechtlanden',
                'description' => 'Vechtlanden is een dunbevolkte wijk in het buitengebied ten noorden van de gemeente Zwolle.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019340',
                'name' => 'Berkum',
                'description' => 'Berkum (Nedersaksisch: Bärkum of Berkum) is een wijk en buurt van de stad Zwolle in de Nederlandse provincie Overijssel. Berkum bestaat uit Berkum, Veldhoek, Bedrijventerrein de Vrolijkheid en kantorenterrein Oosterenk.De wijk ligt ingeklemd tussen de Overijsselse Vecht, de Nieuwe Vecht en de A28. Een groot deel van de inwoners bestaat uit mensen van 65 jaar en ouder (1152). De laatste jaren komen er steeds meer jonge gezinnen bij. De voetbalvereniging VV Berkum heeft hier haar thuisbasis.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019341',
                'name' => 'Marsweteringlanden',
                'description' => 'Marsweteringlanden is een woonwijk in Zwolle die wordt gevormd door de buurtschappen Herfte en Wijthmen. In deze wijk is bedrijventerrein Marslanden-Zuid gesitueerd.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019350',
                'name' => 'Schelle',
                'description' => 'Schelle (Zwols: Skelle) is een wijk en buurtschap in de Overijsselse gemeente Zwolle in Nederland. Het ligt op een rivierduin dat is gevormd in het Preboreaal, een etage van het Holoceen. Inmiddels is de buurtschap opgenomen in de woonwijk Zwolle-Zuid en zijn er drie wijkgedeelten rondom naar de buurtschap vernoemd: Schellerhoek, Schellerbroek en Schellerlanden. De naam is ook terug te vinden in enkele straten in de omgeving zoals de Schellerweg, Schellerallee, Schellerbergweg en Schellerenkweg en een stuk dijk langs de IJssel, de Schellerdijk. Schelle bestaat uit de wijken Oud Schelle, Schelle-Zuid en Oldeneel, Schellerhoek, Schellerbroek, Schellerlanden, Oldenelerlanden-West, Oldenelerlanden-Oost, Oldenelerbroek en Katerveer-Engelse Werk.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019351',
                'name' => 'Ittersum',
                'description' => 'Ittersum is een voormalig gehucht dat behoorde tot de gemeente Zwollerkerspel, die in 1967 werd opgeheven. Ittersum is opgeslokt door Zwolle en is een wijk (CBS wijknummer 51) in Zwolle-Zuid met (anno 2011) 15.230 inwoners.[1] In deze wijk liggen de buurten Geren, Oud Ittersum, Gerenlanden, Gerenbroek, Ittersumerlanden en Ittersumerbroek. Van 1891 tot 1918 had Ittersum een eigen halte aan de spoorlijn Arnhem - Leeuwarden, de stopplaats Ittersum. Ittersum heeft ook een eigen voetbalclub, v.v. SVI (Sport Vereniging Ittersum), waar voormalig profvoetballer Harry Decheiver hoofdtrainer was.',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '019352',
                'name' => 'Soestweteringlanden',
                'description' => 'Soestweteringlanden is een wijk van de gemeente Zwolle in het stadsdeel Zwolle-Zuid. Het omvat de buurtschappen Harculo en Hoog-Zuthem en Windesheim.',
                'housingstock' => 'DobroTest01'
            ]
        ];

        foreach ($residentialAreas as $residentialArea) {
            $residentialAreaObject = new ResidentialArea();

            if (empty($residentialArea['code'])) {
                throw new RuntimeException('code may not be empty, it\'s used as a variable reference in the data fixtures.');
            } else {
                $residentialAreaObject->setCode($residentialArea['code']);
            }

            if (!empty($residentialArea['name'])) {
                $residentialAreaObject->setName($residentialArea['name']);
            }

            if (!empty($residentialArea['description'])) {
                $residentialAreaObject->setDescription($residentialArea['description']);
            }

            if (!empty($residentialArea['housingstock'])) {
                /** @var HousingStock $housingStock */
                $housingStock = $this->getReference($residentialArea['housingstock']);
                $residentialAreaObject->setHousingStock($housingStock);
            }

            $residentialAreaObject->setCreationTime();
            $residentialAreaObject->setLastChangeTime();

            $validator = Validation::createValidator();
            $errors = $validator->validate($residentialAreaObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($residentialAreaObject);
            $this->addReference($residentialArea['code'], $residentialAreaObject);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LoadHousingStocksData::class,
        ];
    }
}