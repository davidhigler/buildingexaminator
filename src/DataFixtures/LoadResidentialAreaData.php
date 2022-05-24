<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\ResidentialArea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadResidentialAreaData extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $residentialAreas = [
            [
                'code' => '1400',
                'name' => "Centrum"
            ],
            [
                'code' => '1401',
                'name' => "Oud-Zuid"
            ],
            [
                'code' => '1402',
                'name' => "Oud-West"
            ],
            [
                'code' => '1403',
                'name' => "Oud-Noord"
            ],
            [
                'code' => '1404',
                'name' => "Oosterparkwijk"
            ],
            [
                'code' => '1405',
                'name' => "Zuidoost"
            ],
            [
                'code' => '1406',
                'name' => "Helpman e.o."
            ],
            [
                'code' => '1407',
                'name' => "Zuidwest"
            ],
            [
                'code' => '1408',
                'name' => "Hoogkerk e.o."
            ],
            [
                'code' => '1409',
                'name' => "Nieuw-West"
            ],
            [
                'code' => '1410',
                'name' => "Noordwest"
            ],
            [
                'code' => '1411',
                'name' => "Noordoost"
            ],
            [
                'code' => '1412',
                'name' => "Noorddijk e.o."
            ],
            [
                'code' => '1413',
                'name' => "Meerdorpen"
            ],
            [
                'code' => '1414',
                'name' => "Meerstad e.o."
            ],
            [
                'code' => '1415',
                'name' => "Ten Boer e.o."
            ],
            [
                'code' => '1416',
                'name' => "Ten Post e.o."
            ],
            [
                'code' => '1417',
                'name' => "Haren-West e.o."
            ],
            [
                'code' => '1418',
                'name' => "Haren-Oost e.o."
            ],
            [
                'code' => '1419',
                'name' => "Glimmen-Onnen-Noordlaren"
            ],
            [
                'code' => '3401',
                'name' => "Wijk 01 Almere Haven"
            ],
            [
                'code' => '3402',
                'name' => "Wijk 02 Almere Stad"
            ],
            [
                'code' => '3403',
                'name' => "Wijk 03 Almere Buiten"
            ],
            [
                'code' => '3404',
                'name' => "Wijk 04 Almere Poort"
            ],
            [
                'code' => '3405',
                'name' => "Wijk 05 Almere Hout"
            ],
            [
                'code' => '3701',
                'name' => "Stadskanaal"
            ],
            [
                'code' => '3702',
                'name' => "Musselkanaal"
            ],
            [
                'code' => '3703',
                'name' => "Onstwedde"
            ],
            [
                'code' => '3704',
                'name' => "Mussel"
            ],
            [
                'code' => '3705',
                'name' => "Alteveer"
            ],
            [
                'code' => '4700',
                'name' => "Wijk 00 Veendam-kern"
            ],
            [
                'code' => '4701',
                'name' => "Wijk 01 Veendam-buitengebied"
            ],
            [
                'code' => '4702',
                'name' => "Wijk 02 Wildervank"
            ],
            [
                'code' => '5000',
                'name' => "Wijk 00"
            ],
            [
                'code' => '5900',
                'name' => "Wijk 00 Noord"
            ],
            [
                'code' => '5901',
                'name' => "Wijk 01 Centrum"
            ],
            [
                'code' => '5902',
                'name' => "Wijk 02 Zuid"
            ],
            [
                'code' => '6000',
                'name' => "Wijk 00"
            ],
            [
                'code' => '7200',
                'name' => "Wijk 00 Harlingen"
            ],
            [
                'code' => '7201',
                'name' => "Wijk 01 Midlum"
            ],
            [
                'code' => '7202',
                'name' => "Wijk 02 Wijnaldum"
            ],
            [
                'code' => '7401',
                'name' => "Wijk 01 Heerenveen"
            ],
            [
                'code' => '7402',
                'name' => "Wijk 02 Noord-Heerenveen"
            ],
            [
                'code' => '7403',
                'name' => "Wijk 03 Hoornsterzwaag"
            ],
            [
                'code' => '7404',
                'name' => "Wijk 04 Jubbega"
            ],
            [
                'code' => '7407',
                'name' => "Skarsterlân"
            ],
            [
                'code' => '7409',
                'name' => "Boarnsterhim"
            ],
            [
                'code' => '8010',
                'name' => "Binnenstad"
            ],
            [
                'code' => '8011',
                'name' => "Potmargezone"
            ],
            [
                'code' => '8020',
                'name' => "Oud-Oost"
            ],
            [
                'code' => '8030',
                'name' => "Sonnenborgh e.o."
            ],
            [
                'code' => '8031',
                'name' => "Westeinde e.o."
            ],
            [
                'code' => '8032',
                'name' => "Vossepark & Helicon"
            ],
            [
                'code' => '8040',
                'name' => "Huizum-West"
            ],
            [
                'code' => '8041',
                'name' => "Nijlân & De Zwette"
            ],
            [
                'code' => '8050',
                'name' => "Heechterp & Schieringen"
            ],
            [
                'code' => '8051',
                'name' => "Camminghaburen e.o."
            ],
            [
                'code' => '8060',
                'name' => "Bilgaard & Havankpark e.o."
            ],
            [
                'code' => '8061',
                'name' => "Vrijheidswijk"
            ],
            [
                'code' => '8062',
                'name' => "Dokkumer Ie e.o."
            ],
            [
                'code' => '8063',
                'name' => "Stiens e.o."
            ],
            [
                'code' => '8070',
                'name' => "Aldlân & De Hemrik"
            ],
            [
                'code' => '8072',
                'name' => "Hempens/Teerns & Zuiderburen"
            ],
            [
                'code' => '8073',
                'name' => "De Zuidlanden"
            ],
            [
                'code' => '8074',
                'name' => "Middelsee"
            ],
            [
                'code' => '8080',
                'name' => "Dorpen Zuid-Oost"
            ],
            [
                'code' => '8081',
                'name' => "Dorpen Zuid-West"
            ],
            [
                'code' => '8082',
                'name' => "Grou e.o."
            ],
            [
                'code' => '8501',
                'name' => "Appelscha"
            ],
            [
                'code' => '8502',
                'name' => "Donkerbroek"
            ],
            [
                'code' => '8503',
                'name' => "Elsloo"
            ],
            [
                'code' => '8504',
                'name' => "Fochteloo"
            ],
            [
                'code' => '8505',
                'name' => "Haule"
            ],
            [
                'code' => '8506',
                'name' => "Haulerwijk"
            ],
            [
                'code' => '8507',
                'name' => "Langedijke"
            ],
            [
                'code' => '8508',
                'name' => "Makkinga"
            ],
            [
                'code' => '8509',
                'name' => "Nijeberkoop"
            ],
            [
                'code' => '8510',
                'name' => "Oldeberkoop"
            ],
            [
                'code' => '8511',
                'name' => "Oosterwolde"
            ],
            [
                'code' => '8512',
                'name' => "Ravenswoud"
            ],
            [
                'code' => '8513',
                'name' => "Waskemeer"
            ],
            [
                'code' => '8601',
                'name' => "Bakkeveen"
            ],
            [
                'code' => '8602',
                'name' => "Beetsterzwaag"
            ],
            [
                'code' => '8604',
                'name' => "Frieschepalen"
            ],
            [
                'code' => '8605',
                'name' => "Gorredijk"
            ],
            [
                'code' => '8606',
                'name' => "Hemrik"
            ],
            [
                'code' => '8607',
                'name' => "Jonkerslân"
            ],
            [
                'code' => '8608',
                'name' => "Langezwaag"
            ],
            [
                'code' => '8609',
                'name' => "Lippenhuizen"
            ],
            [
                'code' => '8610',
                'name' => "Luxwoude"
            ],
            [
                'code' => '8611',
                'name' => "Nij Beets"
            ],
            [
                'code' => '8613',
                'name' => "Siegerswoude"
            ],
            [
                'code' => '8614',
                'name' => "Terwispel"
            ],
            [
                'code' => '8615',
                'name' => "Tijnje"
            ],
            [
                'code' => '8616',
                'name' => "Ureterp"
            ],
            [
                'code' => '8617',
                'name' => "Wijnjewoude"
            ],
            [
                'code' => '8800',
                'name' => "Wijk 00"
            ],
            [
                'code' => '9000',
                'name' => "Wijk 00 Drachten"
            ],
            [
                'code' => '9001',
                'name' => "Wijk 01 Overig Smallingerland"
            ],
            [
                'code' => '9300',
                'name' => "Wijk 00 West-Terschelling"
            ],
            [
                'code' => '9301',
                'name' => "Wijk 01 Midsland"
            ],
            [
                'code' => '9302',
                'name' => "Wijk 02 Formerum"
            ],
            [
                'code' => '9303',
                'name' => "Wijk 03 Lies"
            ],
            [
                'code' => '9304',
                'name' => "Wijk 04 Hoorn"
            ],
            [
                'code' => '9305',
                'name' => "Wijk 05 Oosterend"
            ],
            [
                'code' => '9600',
                'name' => "Wijk 00"
            ],
            [
                'code' => '9800',
                'name' => "Wolvega"
            ],
            [
                'code' => '9801',
                'name' => "De Wolden-Ter Idzard"
            ],
            [
                'code' => '9802',
                'name' => "De Lamers"
            ],
            [
                'code' => '9803',
                'name' => "Lange-Nije-Munk"
            ],
            [
                'code' => '9804',
                'name' => "Scherpenzeel-Spanga"
            ],
            [
                'code' => '9805',
                'name' => "Oldetrijne-Sonnega"
            ],
            [
                'code' => '9806',
                'name' => "Blesdijke"
            ],
            [
                'code' => '9807',
                'name' => "De Blesse-Peperga"
            ],
            [
                'code' => '9808',
                'name' => "Steggerda"
            ],
            [
                'code' => '9809',
                'name' => "De Hoeve-Vinkega"
            ],
            [
                'code' => '9810',
                'name' => "Noordwolde"
            ],
            [
                'code' => '9811',
                'name' => "Oosterstreek"
            ],
            [
                'code' => '9813',
                'name' => "Boijl"
            ],
            [
                'code' => '9814',
                'name' => "Nijeholtpade"
            ],
            [
                'code' => '9815',
                'name' => "Oldeholtpade"
            ],
            [
                'code' => '10600',
                'name' => "Wijk 00 Assen centrum"
            ],
            [
                'code' => '10601',
                'name' => "Wijk 01 Lariks"
            ],
            [
                'code' => '10602',
                'name' => "Wijk 02 Noorderpark"
            ],
            [
                'code' => '10603',
                'name' => "Wijk 03 Assen Oost"
            ],
            [
                'code' => '10604',
                'name' => "Wijk 04 Pittelo"
            ],
            [
                'code' => '10605',
                'name' => "Wijk 05 Assen West"
            ],
            [
                'code' => '10606',
                'name' => "Wijk 06 Peelo"
            ],
            [
                'code' => '10607',
                'name' => "Wijk 07 Marsdijk"
            ],
            [
                'code' => '10608',
                'name' => "Wijk 08 Kloosterveen"
            ],
            [
                'code' => '10699',
                'name' => "Wijk 99 Buitengebied"
            ],
            [
                'code' => '10910',
                'name' => "Wijk 10 Coevorden"
            ],
            [
                'code' => '10911',
                'name' => "Wijk 11 Steenwijksmoer"
            ],
            [
                'code' => '10912',
                'name' => "Wijk 12 Nieuwe Krim"
            ],
            [
                'code' => '10920',
                'name' => "Wijk 20 Dalen"
            ],
            [
                'code' => '10930',
                'name' => "Wijk 30 Oosterhesselen"
            ],
            [
                'code' => '10940',
                'name' => "Wijk 40 Sleen"
            ],
            [
                'code' => '10950',
                'name' => "Wijk 50 Zweeloo"
            ],
            [
                'code' => '11401',
                'name' => "Wijk 01 Nieuw-Weerdinge"
            ],
            [
                'code' => '11402',
                'name' => "Wijk 02 Roswinkel"
            ],
            [
                'code' => '11403',
                'name' => "Wijk 03 Emmer-Compascuum"
            ],
            [
                'code' => '11404',
                'name' => "Wijk 04 Barger-Compascuum"
            ],
            [
                'code' => '11405',
                'name' => "Wijk 05 Nieuw-Dordrecht"
            ],
            [
                'code' => '11406',
                'name' => "Wijk 06 Nieuw-Amsterdam"
            ],
            [
                'code' => '11407',
                'name' => "Wijk 07 Erica"
            ],
            [
                'code' => '11408',
                'name' => "Wijk 08 Klazienaveen"
            ],
            [
                'code' => '11409',
                'name' => "Wijk 09 Zwartemeer"
            ],
            [
                'code' => '11410',
                'name' => "Wijk 10 Schoonebeek"
            ],
            [
                'code' => '11413',
                'name' => "Wijk 13 Veenoord"
            ],
            [
                'code' => '11421',
                'name' => "Wijk 21 Nieuw-Schoonebeek"
            ],
            [
                'code' => '11432',
                'name' => "Wijk 32 Weiteveen"
            ],
            [
                'code' => '11441',
                'name' => "Wijk 41 Emmen-Centrum Oost"
            ],
            [
                'code' => '11451',
                'name' => "Wijk 51 Kern Emmen Noord"
            ],
            [
                'code' => '11452',
                'name' => "Wijk 52 Kern Emmen Zuid"
            ],
            [
                'code' => '11453',
                'name' => "Wijk 53 Kern Emmen Industrieterreinen"
            ],
            [
                'code' => '11850',
                'name' => "Wijk 50 Hoogeveen"
            ],
            [
                'code' => '11851',
                'name' => "Wijk 51 De Weide"
            ],
            [
                'code' => '11852',
                'name' => "Wijke 52 Fluitenberg"
            ],
            [
                'code' => '11853',
                'name' => "Wijk 53 Elim"
            ],
            [
                'code' => '11854',
                'name' => "Wijk 54 Hollandscheveld"
            ],
            [
                'code' => '11855',
                'name' => "Wijk 55 Noordscheschut"
            ],
            [
                'code' => '11856',
                'name' => "Wijk 56 Nieuwlande"
            ],
            [
                'code' => '11857',
                'name' => "Wijk 57 Nieuweroord"
            ],
            [
                'code' => '11858',
                'name' => "Wijk 58 Tiendeveen"
            ],
            [
                'code' => '11859',
                'name' => "Wijk 59 Stuifzand"
            ],
            [
                'code' => '11860',
                'name' => "Wijk 60 Pesse"
            ],
            [
                'code' => '11862',
                'name' => "Wijk 62 Industrie- en verspreide gebieden"
            ],
            [
                'code' => '11900',
                'name' => "Centrum"
            ],
            [
                'code' => '11901',
                'name' => "Watertoren"
            ],
            [
                'code' => '11902',
                'name' => "Haveltermade"
            ],
            [
                'code' => '11903',
                'name' => "Koedijkslanden"
            ],
            [
                'code' => '11904',
                'name' => "Berggierslanden"
            ],
            [
                'code' => '11905',
                'name' => "Ezinge"
            ],
            [
                'code' => '11906',
                'name' => "Oosterboer"
            ],
            [
                'code' => '11907',
                'name' => "Nieuwveenselanden"
            ],
            [
                'code' => '11909',
                'name' => "Industrieterrein Noord"
            ],
            [
                'code' => '11910',
                'name' => "Industrie Oevers"
            ],
            [
                'code' => '11911',
                'name' => "Verspreid gebied Meppel"
            ],
            [
                'code' => '11912',
                'name' => "Nijeveen"
            ],
            [
                'code' => '11913',
                'name' => "Rogat"
            ],
            [
                'code' => '14110',
                'name' => "Binnenstad"
            ],
            [
                'code' => '14111',
                'name' => "De Riet"
            ],
            [
                'code' => '14112',
                'name' => "Noorderkwartier"
            ],
            [
                'code' => '14113',
                'name' => "Sluitersveld"
            ],
            [
                'code' => '14114',
                'name' => "Wierdense Hoek"
            ],
            [
                'code' => '14115',
                'name' => "Nieuwstraat-Kwartier"
            ],
            [
                'code' => '14116',
                'name' => "Ossenkoppelerhoek"
            ],
            [
                'code' => '14117',
                'name' => "Hofkamp"
            ],
            [
                'code' => '14118',
                'name' => "Schelfhorst"
            ],
            [
                'code' => '14119',
                'name' => "Windmolenbroek"
            ],
            [
                'code' => '14120',
                'name' => "Aadorp"
            ],
            [
                'code' => '14121',
                'name' => "Bornerbroek"
            ],
            [
                'code' => '14700',
                'name' => "Wijk 00 Borne"
            ],
            [
                'code' => '14701',
                'name' => "Wijk 01 Buitengebied Borne"
            ],
            [
                'code' => '14801',
                'name' => "Dalfsen"
            ],
            [
                'code' => '14802',
                'name' => "Nieuwleusen"
            ],
            [
                'code' => '14803',
                'name' => "Lemelerveld"
            ],
            [
                'code' => '15001',
                'name' => "Wijk 1 Binnenstad"
            ],
            [
                'code' => '15003',
                'name' => "Wijk 3 Zandweerd"
            ],
            [
                'code' => '15004',
                'name' => "Wijk 4 Voorstad"
            ],
            [
                'code' => '15005',
                'name' => "Wijk 5 Borgele en Platvoet"
            ],
            [
                'code' => '15006',
                'name' => "Wijk 6 Keizerslanden"
            ],
            [
                'code' => '15007',
                'name' => "Wijk 7 Rivierenwijk en Bergweide"
            ],
            [
                'code' => '15008',
                'name' => "Wijk 8 Colmschate-Noord"
            ],
            [
                'code' => '15009',
                'name' => "Wijk 9 Colmschate-Vijfhoek"
            ],
            [
                'code' => '15010',
                'name' => "Wijk 10 Colmschate-Zuid"
            ],
            [
                'code' => '15011',
                'name' => "Wijk 11 Diepenveen"
            ],
            [
                'code' => '15012',
                'name' => "Wijk 12 Schalkhaar"
            ],
            [
                'code' => '15014',
                'name' => "Wijk 14 Lettele"
            ],
            [
                'code' => '15015',
                'name' => "Wijk 15 Bathmen"
            ],
            [
                'code' => '15300',
                'name' => "Wijk 00 Binnensingelgebied"
            ],
            [
                'code' => '15301',
                'name' => "Wijk 01 Hogeland - Velve"
            ],
            [
                'code' => '15302',
                'name' => "Wijk 02 Boswinkel - Stadsveld"
            ],
            [
                'code' => '15303',
                'name' => "Wijk 03 Twekkelerveld - T.H.T."
            ],
            [
                'code' => '15304',
                'name' => "Wijk 04 Enschede-Noord"
            ],
            [
                'code' => '15305',
                'name' => "Wijk 05 Ribbelt - Stokhorst"
            ],
            [
                'code' => '15306',
                'name' => "Wijk 06 Enschede-Zuid"
            ],
            [
                'code' => '15307',
                'name' => "Wijk 07 Bedrijfsterreinen Enschede-West"
            ],
            [
                'code' => '15308',
                'name' => "Wijk 08 Glanerbrug en omgeving"
            ],
            [
                'code' => '15309',
                'name' => "Wijk 09 Landelijk gebied en kernen"
            ],
            [
                'code' => '15800',
                'name' => "Wijk 00 Haaksbergen (dorp)"
            ],
            [
                'code' => '15801',
                'name' => "Wijk 01 Haaksbergen (buitengebied)"
            ],
            [
                'code' => '15802',
                'name' => "Wijk 02 Sint Isidorushoeve"
            ],
            [
                'code' => '15803',
                'name' => "Wijk 03 Buurse"
            ],
            [
                'code' => '16001',
                'name' => "Ane"
            ],
            [
                'code' => '16004',
                'name' => "Balkbrug"
            ],
            [
                'code' => '16005',
                'name' => "Bergentheim"
            ],
            [
                'code' => '16008',
                'name' => "De Krim"
            ],
            [
                'code' => '16009',
                'name' => "Dedemsvaart"
            ],
            [
                'code' => '16012',
                'name' => "Gramsbergen"
            ],
            [
                'code' => '16017',
                'name' => "Kloosterhaar"
            ],
            [
                'code' => '16019',
                'name' => "Lutten"
            ],
            [
                'code' => '16020',
                'name' => "Marienberg"
            ],
            [
                'code' => '16024',
                'name' => "Schuinesloot"
            ],
            [
                'code' => '16025',
                'name' => "Sibculo"
            ],
            [
                'code' => '16026',
                'name' => "Slagharen"
            ],
            [
                'code' => '16028',
                'name' => "Hardenberg"
            ],
            [
                'code' => '16029',
                'name' => "Bruchterveld"
            ],
            [
                'code' => '16301',
                'name' => "Wijk 01 Hellendoorn"
            ],
            [
                'code' => '16302',
                'name' => "Wijk 02 Nijverdal Noord"
            ],
            [
                'code' => '16303',
                'name' => "Wijk 03 Nijverdal West"
            ],
            [
                'code' => '16304',
                'name' => "Wijk 04 Nijverdal Oost"
            ],
            [
                'code' => '16305',
                'name' => "Wijk 05 Buitengebied"
            ],
            [
                'code' => '16306',
                'name' => "Wijk 06 Kruidenwijk"
            ],
            [
                'code' => '16400',
                'name' => "Wijk 00 Binnenstad"
            ],
            [
                'code' => '16401',
                'name' => "Wijk 01 Hengelose Es"
            ],
            [
                'code' => '16402',
                'name' => "Wijk 02 Noord"
            ],
            [
                'code' => '16403',
                'name' => "Wijk 03 Hasseler Es"
            ],
            [
                'code' => '16404',
                'name' => "Wijk 04 Groot Driene"
            ],
            [
                'code' => '16405',
                'name' => "Wijk 05 Berflo Es"
            ],
            [
                'code' => '16406',
                'name' => "Wijk 06 Wilderinkshoek"
            ],
            [
                'code' => '16407',
                'name' => "Wijk 07 Woolde"
            ],
            [
                'code' => '16408',
                'name' => "Wijk 08 Slangenbeek"
            ],
            [
                'code' => '16409',
                'name' => "Wijk 09 Buitengebied"
            ],
            [
                'code' => '16600',
                'name' => "Wijk 00 Kampen"
            ],
            [
                'code' => '16603',
                'name' => "Wijk 03 IJsselmuiden"
            ],
            [
                'code' => '16604',
                'name' => "Wijk 04 Zalk"
            ],
            [
                'code' => '16605',
                'name' => "Wijk 05 Wilsum"
            ],
            [
                'code' => '16800',
                'name' => "Wijk 00 Losser"
            ],
            [
                'code' => '16801',
                'name' => "Wijk 01 Glane"
            ],
            [
                'code' => '16802',
                'name' => "Wijk 02 Overdinkel"
            ],
            [
                'code' => '16803',
                'name' => "Wijk 03 De Lutte"
            ],
            [
                'code' => '16804',
                'name' => "Wijk 04 Beuningen"
            ],
            [
                'code' => '17101',
                'name' => "Wijk 01 Emmeloord"
            ],
            [
                'code' => '17102',
                'name' => "Wijk 02 Bant"
            ],
            [
                'code' => '17103',
                'name' => "Wijk 03 Luttelgeest"
            ],
            [
                'code' => '17104',
                'name' => "Wijk 04 Marknesse"
            ],
            [
                'code' => '17105',
                'name' => "Wijk 05 Kraggenburg"
            ],
            [
                'code' => '17106',
                'name' => "Wijk 06 Ens"
            ],
            [
                'code' => '17107',
                'name' => "Wijk 07 Nagele"
            ],
            [
                'code' => '17108',
                'name' => "Wijk 08 Tollebeek"
            ],
            [
                'code' => '17109',
                'name' => "Wijk 09 Espel"
            ],
            [
                'code' => '17110',
                'name' => "Wijk 10 Creil"
            ],
            [
                'code' => '17111',
                'name' => "Wijk 11 Rutten"
            ],
            [
                'code' => '17501',
                'name' => "Ommen"
            ],
            [
                'code' => '17502',
                'name' => "Arrien"
            ],
            [
                'code' => '17504',
                'name' => "Beerzerveld"
            ],
            [
                'code' => '17507',
                'name' => "Lemele"
            ],
            [
                'code' => '17508',
                'name' => "Stegeren"
            ],
            [
                'code' => '17509',
                'name' => "Vilsteren"
            ],
            [
                'code' => '17510',
                'name' => "Vinkenbuurt"
            ],
            [
                'code' => '17511',
                'name' => "Witharen"
            ],
            [
                'code' => '17701',
                'name' => "Raalte"
            ],
            [
                'code' => '17702',
                'name' => "Luttenberg"
            ],
            [
                'code' => '17703',
                'name' => "Mariënheem"
            ],
            [
                'code' => '17704',
                'name' => "Nieuw Heeten"
            ],
            [
                'code' => '17705',
                'name' => "Heeten"
            ],
            [
                'code' => '17706',
                'name' => "Broekland"
            ],
            [
                'code' => '17707',
                'name' => "Heino"
            ],
            [
                'code' => '17708',
                'name' => "Lierderholthuis"
            ],
            [
                'code' => '17709',
                'name' => "Laag Zuthem"
            ],
            [
                'code' => '18000',
                'name' => "Wijk 00 Staphorst (kern)"
            ],
            [
                'code' => '18001',
                'name' => "Wijk 01 Rouveen (kern)"
            ],
            [
                'code' => '18002',
                'name' => "Wijk 02 Rouveen (buitengebied)"
            ],
            [
                'code' => '18003',
                'name' => "Wijk 03 Staphorst (buitengebied)"
            ],
            [
                'code' => '18004',
                'name' => "Wijk 04 IJhorst"
            ],
            [
                'code' => '18300',
                'name' => "Wijk 00 Tubbergen"
            ],
            [
                'code' => '18301',
                'name' => "Wijk 01 Albergen"
            ],
            [
                'code' => '18302',
                'name' => "Wijk 02 Harbrinkhoek"
            ],
            [
                'code' => '18303',
                'name' => "Wijk 03 Geesteren"
            ],
            [
                'code' => '18304',
                'name' => "Wijk 04 Langeveen"
            ],
            [
                'code' => '18305',
                'name' => "Wijk 05 Vasse"
            ],
            [
                'code' => '18306',
                'name' => "Wijk 06 Reutum"
            ],
            [
                'code' => '18307',
                'name' => "Wijk 07 Fleringen"
            ],
            [
                'code' => '18400',
                'name' => "Wijk 00 Urk"
            ],
            [
                'code' => '18900',
                'name' => "Wijk 00 Wierden (kern)"
            ],
            [
                'code' => '18901',
                'name' => "Wijk 01 Landelijk gebied Wierden"
            ],
            [
                'code' => '18902',
                'name' => "Wijk 02 Hooge-Hexel"
            ],
            [
                'code' => '18903',
                'name' => "Wijk 03 Enter (kern)"
            ],
            [
                'code' => '18904',
                'name' => "Wijk 04 Landelijk gebied Enter"
            ],
            [
                'code' => '18905',
                'name' => "Wijk 05 Rectum - Notter - Zuna"
            ],
            [
                'code' => '19310',
                'name' => "Wijk 10 Binnenstad"
            ],
            [
                'code' => '19311',
                'name' => "Wijk 11 Diezerpoort"
            ],
            [
                'code' => '19312',
                'name' => "Wijk 12 Wipstrik"
            ],
            [
                'code' => '19313',
                'name' => "Wijk 13 Assendorp"
            ],
            [
                'code' => '19314',
                'name' => "Wijk 14 Kamperpoort-Veerallee"
            ],
            [
                'code' => '19320',
                'name' => "Wijk 20 Poort van Zwolle"
            ],
            [
                'code' => '19321',
                'name' => "Wijk 21 Westenholte"
            ],
            [
                'code' => '19322',
                'name' => "Wijk 22 Stadshagen"
            ],
            [
                'code' => '19330',
                'name' => "Wijk 30 Holtenbroek"
            ],
            [
                'code' => '19331',
                'name' => "Wijk 31 Aa-landen"
            ],
            [
                'code' => '19332',
                'name' => "Wijk 32 Vechtlanden"
            ],
            [
                'code' => '19340',
                'name' => "Wijk 40 Berkum"
            ],
            [
                'code' => '19341',
                'name' => "Wijk 41 Marsweteringlanden"
            ],
            [
                'code' => '19350',
                'name' => "Wijk 50 Schelle"
            ],
            [
                'code' => '19351',
                'name' => "Wijk 51 Ittersum"
            ],
            [
                'code' => '19352',
                'name' => "Wijk 52 Soestweteringlanden"
            ],
            [
                'code' => '19701',
                'name' => "Wijk 01 Buitengebied Aalten"
            ],
            [
                'code' => '19702',
                'name' => "Wijk 02 Bredevoort"
            ],
            [
                'code' => '19703',
                'name' => "Wijk 03 Aalten Kern"
            ],
            [
                'code' => '19704',
                'name' => "Wijk 04 Dinxperlo"
            ],
            [
                'code' => '20001',
                'name' => "Centrum"
            ],
            [
                'code' => '20002',
                'name' => "West"
            ],
            [
                'code' => '20003',
                'name' => "Zuidwest"
            ],
            [
                'code' => '20004',
                'name' => "Zuid"
            ],
            [
                'code' => '20005',
                'name' => "Zuidoost"
            ],
            [
                'code' => '20006',
                'name' => "Oost"
            ],
            [
                'code' => '20007',
                'name' => "Noordoost"
            ],
            [
                'code' => '20008',
                'name' => "Noord"
            ],
            [
                'code' => '20010',
                'name' => "Uddel en omgeving"
            ],
            [
                'code' => '20011',
                'name' => "Hoog Soeren en Radio Kootwijk"
            ],
            [
                'code' => '20012',
                'name' => "Hoenderloo en omgeving"
            ],
            [
                'code' => '20013',
                'name' => "Loenen en omgeving"
            ],
            [
                'code' => '20014',
                'name' => "Beekbergen en omgeving"
            ],
            [
                'code' => '20015',
                'name' => "Lieren en omgeving"
            ],
            [
                'code' => '20016',
                'name' => "Klarenbeek en omgeving"
            ],
            [
                'code' => '20017',
                'name' => "Wenum Wiesel Beemte"
            ],
            [
                'code' => '20201',
                'name' => "Centrum"
            ],
            [
                'code' => '20202',
                'name' => "Spijkerkwartier"
            ],
            [
                'code' => '20203',
                'name' => "Arnhemse Broek"
            ],
            [
                'code' => '20204',
                'name' => "Presikhaaf-West"
            ],
            [
                'code' => '20205',
                'name' => "Presikhaaf-Oost"
            ],
            [
                'code' => '20206',
                'name' => "St. Marten/Sonsbeek"
            ],
            [
                'code' => '20207',
                'name' => "Klarendal"
            ],
            [
                'code' => '20208',
                'name' => "Velperweg e.o."
            ],
            [
                'code' => '20209',
                'name' => "Alteveer/Cranevelt"
            ],
            [
                'code' => '20211',
                'name' => "Monnikenhuizen"
            ],
            [
                'code' => '20212',
                'name' => "Burgemeesterswijk/Hoogkamp"
            ],
            [
                'code' => '20213',
                'name' => "Schaarsbergen"
            ],
            [
                'code' => '20214',
                'name' => "Heijenoord/Lombok"
            ],
            [
                'code' => '20215',
                'name' => "Klingelbeek e.o."
            ],
            [
                'code' => '20216',
                'name' => "Malburgen-West"
            ],
            [
                'code' => '20217',
                'name' => "Malburgen-Oost (Noord)"
            ],
            [
                'code' => '20218',
                'name' => "Malburgen-Oost (Zuid)"
            ],
            [
                'code' => '20219',
                'name' => "Vredenburg/Kronenburg"
            ],
            [
                'code' => '20221',
                'name' => "Elderveld"
            ],
            [
                'code' => '20222',
                'name' => "De Laar"
            ],
            [
                'code' => '20223',
                'name' => "Rijkerswoerd"
            ],
            [
                'code' => '20224',
                'name' => "Schuytgraaf"
            ],
            [
                'code' => '20354',
                'name' => "Wijk 54 Barneveld"
            ],
            [
                'code' => '20355',
                'name' => "Wijk 55 Voorthuizen"
            ],
            [
                'code' => '20356',
                'name' => "Wijk 56 Kootwijkerbroek"
            ],
            [
                'code' => '20357',
                'name' => "Wijk 57 Garderen"
            ],
            [
                'code' => '20358',
                'name' => "Wijk 58 Terschuur"
            ],
            [
                'code' => '20359',
                'name' => "Wijk 59 Stroe"
            ],
            [
                'code' => '20360',
                'name' => "Wijk 60 Zwartebroek"
            ],
            [
                'code' => '20361',
                'name' => "Wijk 61 De Glind"
            ],
            [
                'code' => '20362',
                'name' => "Wijk 62 Kootwijk"
            ],
            [
                'code' => '20901',
                'name' => "Beuningen"
            ],
            [
                'code' => '20902',
                'name' => "Ewijk"
            ],
            [
                'code' => '20903',
                'name' => "Weurt"
            ],
            [
                'code' => '20904',
                'name' => "Winssen"
            ],
            [
                'code' => '21301',
                'name' => "Wijk 01 Empe"
            ],
            [
                'code' => '21303',
                'name' => "Wijk 03 Brummen"
            ],
            [
                'code' => '21304',
                'name' => "Wijk 04 Leuvenheim"
            ],
            [
                'code' => '21305',
                'name' => "Wijk 05 Hall"
            ],
            [
                'code' => '21306',
                'name' => "Wijk 06 Eerbeek"
            ],
            [
                'code' => '21400',
                'name' => "Wijk 00 Buren"
            ],
            [
                'code' => '21401',
                'name' => "Wijk 01 Beusichem"
            ],
            [
                'code' => '21402',
                'name' => "Wijk 02 Zoelen"
            ],
            [
                'code' => '21403',
                'name' => "Wijk 03 Lienden"
            ],
            [
                'code' => '21404',
                'name' => "Wijk 04 Ingen"
            ],
            [
                'code' => '21405',
                'name' => "Wijk 05 Maurik"
            ],
            [
                'code' => '21406',
                'name' => "Wijk 06 Ravenswaaij"
            ],
            [
                'code' => '21600',
                'name' => "Culemborg Oost"
            ],
            [
                'code' => '21601',
                'name' => "Culemborg West"
            ],
            [
                'code' => '22101',
                'name' => "Wijk 01"
            ],
            [
                'code' => '22201',
                'name' => "Wijk 01 Doetinchem Centrum"
            ],
            [
                'code' => '22202',
                'name' => "Wijk 02"
            ],
            [
                'code' => '22203',
                'name' => "Wijk 03"
            ],
            [
                'code' => '22204',
                'name' => "Wijk 04"
            ],
            [
                'code' => '22205',
                'name' => "Wijk 05"
            ],
            [
                'code' => '22206',
                'name' => "Wijk 06"
            ],
            [
                'code' => '22207',
                'name' => "Wijk 07"
            ],
            [
                'code' => '22208',
                'name' => "Wijk 08"
            ],
            [
                'code' => '22209',
                'name' => "Wijk 09"
            ],
            [
                'code' => '22211',
                'name' => "Wijk 11 Buitengebied Doetinchem"
            ],
            [
                'code' => '22231',
                'name' => "Wijk 31 Wehl"
            ],
            [
                'code' => '22500',
                'name' => "Druten"
            ],
            [
                'code' => '22501',
                'name' => "Puiflijk"
            ],
            [
                'code' => '22502',
                'name' => "Afferden"
            ],
            [
                'code' => '22503',
                'name' => "Deest"
            ],
            [
                'code' => '22504',
                'name' => "Horssen"
            ],
            [
                'code' => '22603',
                'name' => "Wijk 03 Duiven-Noord"
            ],
            [
                'code' => '22604',
                'name' => "Wijk 04 Duiven-Zuid"
            ],
            [
                'code' => '22801',
                'name' => "Ede-Oost"
            ],
            [
                'code' => '22802',
                'name' => "Ede-West"
            ],
            [
                'code' => '22803',
                'name' => "Ede-Veldhuizen"
            ],
            [
                'code' => '22804',
                'name' => "Kernhem"
            ],
            [
                'code' => '22810',
                'name' => "Ede-Zuid"
            ],
            [
                'code' => '22811',
                'name' => "Maandereng"
            ],
            [
                'code' => '22812',
                'name' => "Rietkampen"
            ],
            [
                'code' => '22813',
                'name' => "Bedrijventerrein"
            ],
            [
                'code' => '22820',
                'name' => "Buitengebied Ede-Stad"
            ],
            [
                'code' => '22830',
                'name' => "Bennekom"
            ],
            [
                'code' => '22840',
                'name' => "Lunteren"
            ],
            [
                'code' => '22850',
                'name' => "Ederveen"
            ],
            [
                'code' => '22860',
                'name' => "De Klomp"
            ],
            [
                'code' => '22870',
                'name' => "Harskamp"
            ],
            [
                'code' => '22880',
                'name' => "Wekerom"
            ],
            [
                'code' => '22890',
                'name' => "Otterlo"
            ],
            [
                'code' => '23001',
                'name' => "Wijk 01 Elburg"
            ],
            [
                'code' => '23002',
                'name' => "Wijk 02"
            ],
            [
                'code' => '23003',
                'name' => "Wijk 03 Doornspijk"
            ],
            [
                'code' => '23200',
                'name' => "Wijk 00 Epe"
            ],
            [
                'code' => '23201',
                'name' => "Wijk 01 Emst"
            ],
            [
                'code' => '23202',
                'name' => "Wijk 02 Vaassen"
            ],
            [
                'code' => '23203',
                'name' => "Wijk 03 Oene"
            ],
            [
                'code' => '23300',
                'name' => "Wijk 00 Ermelo"
            ],
            [
                'code' => '23301',
                'name' => "Wijk 01 Speuld"
            ],
            [
                'code' => '24301',
                'name' => "Wijk 01 Binnenstad"
            ],
            [
                'code' => '24302',
                'name' => "Wijk 02 Waterfront"
            ],
            [
                'code' => '24303',
                'name' => "Wijk 03 Zeebuurt"
            ],
            [
                'code' => '24304',
                'name' => "Wijk 04 Friesegracht"
            ],
            [
                'code' => '24305',
                'name' => "Wijk 05 Stadsdennen"
            ],
            [
                'code' => '24306',
                'name' => "Wijk 06 De Sypel"
            ],
            [
                'code' => '24307',
                'name' => "Wijk 07 Stationsomgeving"
            ],
            [
                'code' => '24308',
                'name' => "Wijk 08 Stadsweiden"
            ],
            [
                'code' => '24309',
                'name' => "Wijk 09 Slingerbos"
            ],
            [
                'code' => '24310',
                'name' => "Wijk 10 Tweelingstad"
            ],
            [
                'code' => '24311',
                'name' => "Wijk 11 Frankrijk"
            ],
            [
                'code' => '24312',
                'name' => "Wijk 12 Drielanden"
            ],
            [
                'code' => '24313',
                'name' => "Wijk 13 Industrieterrein Lorentz"
            ],
            [
                'code' => '24314',
                'name' => "Wijk 14 Buitengebied Harderwijk"
            ],
            [
                'code' => '24315',
                'name' => "Wijk 15 Hierden"
            ],
            [
                'code' => '24400',
                'name' => "Wijk 00 Hattem"
            ],
            [
                'code' => '24401',
                'name' => "Wijk 01 Polder Hattem en Molecaten"
            ],
            [
                'code' => '24600',
                'name' => "Wijk 00 Heerde"
            ],
            [
                'code' => '24601',
                'name' => "Wijk 01 Wapenveld"
            ],
            [
                'code' => '25200',
                'name' => "Wijk 00 Heumen"
            ],
            [
                'code' => '25201',
                'name' => "Wijk 01 Overasselt"
            ],
            [
                'code' => '26200',
                'name' => "Wijk 00 Lochem kern"
            ],
            [
                'code' => '26201',
                'name' => "Wijk 01 Lochem buitengebied"
            ],
            [
                'code' => '26202',
                'name' => "Wijk 02 Laren"
            ],
            [
                'code' => '26203',
                'name' => "Wijk 03 Barchem"
            ],
            [
                'code' => '26204',
                'name' => "Wijk 04 Gorssel"
            ],
            [
                'code' => '26205',
                'name' => "Wijk 01 Almen-Harfsen"
            ],
            [
                'code' => '26300',
                'name' => "Wijk 00 Kerkdriel"
            ],
            [
                'code' => '26301',
                'name' => "Wijk 01 Ammerzoden"
            ],
            [
                'code' => '26302',
                'name' => "Wijk 02 Hedel"
            ],
            [
                'code' => '26303',
                'name' => "Wijk 03 Heerewaarden"
            ],
            [
                'code' => '26304',
                'name' => "Wijk 04 Rossum"
            ],
            [
                'code' => '26701',
                'name' => "Nijkerk-stad"
            ],
            [
                'code' => '26702',
                'name' => "Appel, Driedorp, Kruishaar, Prinsenkamp en Slichtenhorst"
            ],
            [
                'code' => '26703',
                'name' => "Nijkerkerveen en Holkerveen"
            ],
            [
                'code' => '26704',
                'name' => "Arkemheen, Achterhoek, De Veenhuis"
            ],
            [
                'code' => '26705',
                'name' => "Hoevelaken"
            ],
            [
                'code' => '26801',
                'name' => "Wijk 01 Nijmegen-Centrum"
            ],
            [
                'code' => '26802',
                'name' => "Wijk 02 Nijmegen-Oost"
            ],
            [
                'code' => '26803',
                'name' => "Wijk 03 Nijmegen-Oud-West"
            ],
            [
                'code' => '26804',
                'name' => "Wijk 04 Nijmegen-Nieuw-West"
            ],
            [
                'code' => '26805',
                'name' => "Wijk 05 Nijmegen-Midden"
            ],
            [
                'code' => '26806',
                'name' => "Wijk 06 Nijmegen-Zuid"
            ],
            [
                'code' => '26807',
                'name' => "Wijk 07 Dukenburg"
            ],
            [
                'code' => '26808',
                'name' => "Wijk 08 Lindenholt"
            ],
            [
                'code' => '26809',
                'name' => "Wijk 09 Nijmegen-Noord"
            ],
            [
                'code' => '26900',
                'name' => "Wijk 00 Oldebroek"
            ],
            [
                'code' => '26901',
                'name' => "Wijk 01 Wezep"
            ],
            [
                'code' => '26902',
                'name' => "Wijk 02 Oosterwolde"
            ],
            [
                'code' => '27300',
                'name' => "Wijk 00 Putten"
            ],
            [
                'code' => '27301',
                'name' => "Wijk 01 Bosgebied en Krachtighuizen"
            ],
            [
                'code' => '27401',
                'name' => "Renkum Zuid"
            ],
            [
                'code' => '27402',
                'name' => "Renkum Noord"
            ],
            [
                'code' => '27403',
                'name' => "Heelsum ten westen van de rijksweg"
            ],
            [
                'code' => '27404',
                'name' => "Heelsum ten oosten van de rijksweg"
            ],
            [
                'code' => '27405',
                'name' => "Wolfheze ten zuiden van het spoor"
            ],
            [
                'code' => '27406',
                'name' => "Wolfheze ten noorden van het spoor"
            ],
            [
                'code' => '27407',
                'name' => "Buitengebied Doorwerth"
            ],
            [
                'code' => '27408',
                'name' => "Bebouwde kom Doorwerth"
            ],
            [
                'code' => '27409',
                'name' => "Heveadorp"
            ],
            [
                'code' => '27410',
                'name' => "Oosterbeek West"
            ],
            [
                'code' => '27411',
                'name' => "Oosterbeek Zuidoost"
            ],
            [
                'code' => '27412',
                'name' => "Oosterbeek Noordoost"
            ],
            [
                'code' => '27500',
                'name' => "Wijk 00 Dieren"
            ],
            [
                'code' => '27501',
                'name' => "Wijk 01 Rheden"
            ],
            [
                'code' => '27502',
                'name' => "Wijk 02 Velp"
            ],
            [
                'code' => '27700',
                'name' => "Wijk 00"
            ],
            [
                'code' => '27900',
                'name' => "Wijk 00"
            ],
            [
                'code' => '28100',
                'name' => "Tiel kern"
            ],
            [
                'code' => '28101',
                'name' => "Tiel-Noord"
            ],
            [
                'code' => '28102',
                'name' => "Wadenoijen en Kapel Avezaath"
            ],
            [
                'code' => '28103',
                'name' => "Tiel-Zuid"
            ],
            [
                'code' => '28500',
                'name' => "Wijk 00 Voorst"
            ],
            [
                'code' => '28501',
                'name' => "Wijk 01 Twello-Nijbroek"
            ],
            [
                'code' => '28502',
                'name' => "Wijk 02 Klarenbeek-Teuge"
            ],
            [
                'code' => '28503',
                'name' => "Wijk 03 Wilp"
            ],
            [
                'code' => '28901',
                'name' => "Noordwest"
            ],
            [
                'code' => '28902',
                'name' => "Wageningen Universiteit"
            ],
            [
                'code' => '28903',
                'name' => "De Weiden en Boomgaarden"
            ],
            [
                'code' => '28904',
                'name' => "De Horsten"
            ],
            [
                'code' => '28905',
                'name' => "Kortenoord"
            ],
            [
                'code' => '28906',
                'name' => "De Buurt"
            ],
            [
                'code' => '28907',
                'name' => "Boven- en Benedenbuurt"
            ],
            [
                'code' => '28908',
                'name' => "Nude"
            ],
            [
                'code' => '28909',
                'name' => "Centrum"
            ],
            [
                'code' => '28910',
                'name' => "Veluvia-Hamelakkers"
            ],
            [
                'code' => '28912',
                'name' => "Buitengebied"
            ],
            [
                'code' => '29300',
                'name' => "Wijk 00"
            ],
            [
                'code' => '29400',
                'name' => "Wijk 00 Stad"
            ],
            [
                'code' => '29401',
                'name' => "Wijk 01 Land"
            ],
            [
                'code' => '29600',
                'name' => "Wijk 00 Wijchen buitengebied"
            ],
            [
                'code' => '29601',
                'name' => "Wijk 01 Wijchen kern"
            ],
            [
                'code' => '29602',
                'name' => "Wijk 02 Balgoij"
            ],
            [
                'code' => '29603',
                'name' => "Wijk 03 Batenburg"
            ],
            [
                'code' => '29604',
                'name' => "Wijk 04 Bergharen"
            ],
            [
                'code' => '29605',
                'name' => "Wijk 05 Hernen"
            ],
            [
                'code' => '29606',
                'name' => "Wijk 06 Leur"
            ],
            [
                'code' => '29607',
                'name' => "Wijk 07 Niftrik"
            ],
            [
                'code' => '29608',
                'name' => "Wijk 08 Alverna"
            ],
            [
                'code' => '29700',
                'name' => "Wijk 00 Zaltbommel"
            ],
            [
                'code' => '29701',
                'name' => "Wijk 01 Brakel"
            ],
            [
                'code' => '29702',
                'name' => "Wijk 02 Kerkwijk"
            ],
            [
                'code' => '29703',
                'name' => "Wijk 03 Nederhemert"
            ],
            [
                'code' => '29900',
                'name' => "Zevenaar"
            ],
            [
                'code' => '29901',
                'name' => "Babberich"
            ],
            [
                'code' => '29902',
                'name' => "Angerlo"
            ],
            [
                'code' => '29903',
                'name' => "Giesbeek"
            ],
            [
                'code' => '29906',
                'name' => "Pannerden"
            ],
            [
                'code' => '29907',
                'name' => "Aerdt"
            ],
            [
                'code' => '29908',
                'name' => "Herwen"
            ],
            [
                'code' => '29910',
                'name' => "Tolkamer"
            ],
            [
                'code' => '29911',
                'name' => "Spijk"
            ],
            [
                'code' => '30100',
                'name' => "Wijk 00 Centrum - De Hoven"
            ],
            [
                'code' => '30101',
                'name' => "Wijk 01 Waterkwartier"
            ],
            [
                'code' => '30102',
                'name' => "Wijk 02 Noordveen"
            ],
            [
                'code' => '30103',
                'name' => "Wijk 03 Zuidwijken"
            ],
            [
                'code' => '30104',
                'name' => "Wijk 04 Leesten"
            ],
            [
                'code' => '30105',
                'name' => "Wijk 05 Warnsveld"
            ],
            [
                'code' => '30200',
                'name' => "Wijk 00 Nunspeet"
            ],
            [
                'code' => '30201',
                'name' => "Wijk 01 Elspeet-Vierhouten"
            ],
            [
                'code' => '30301',
                'name' => "Wijk 01 Dronten west"
            ],
            [
                'code' => '30302',
                'name' => "Wijk 02 Dronten Noord"
            ],
            [
                'code' => '30303',
                'name' => "Wijk 03 Dronten Midden"
            ],
            [
                'code' => '30304',
                'name' => "Wijk 04 Dronten Zuid"
            ],
            [
                'code' => '30305',
                'name' => "Wijk 05 Buitengebied Dronten"
            ],
            [
                'code' => '30306',
                'name' => "Wijk 06 Biddinghuizen"
            ],
            [
                'code' => '30307',
                'name' => "Wijk 07 Swifterbant"
            ],
            [
                'code' => '30701',
                'name' => "Stadskern"
            ],
            [
                'code' => '30702',
                'name' => "Nederberg"
            ],
            [
                'code' => '30703',
                'name' => "Soesterkwartier"
            ],
            [
                'code' => '30704',
                'name' => "Eemkwartier"
            ],
            [
                'code' => '30705',
                'name' => "Isselt"
            ],
            [
                'code' => '30706',
                'name' => "De Koppel"
            ],
            [
                'code' => '30707',
                'name' => "Kruiskamp"
            ],
            [
                'code' => '30708',
                'name' => "Schothorst-Zuid"
            ],
            [
                'code' => '30709',
                'name' => "Schothorst-Noord"
            ],
            [
                'code' => '30710',
                'name' => "Liendert"
            ],
            [
                'code' => '30711',
                'name' => "Rustenburg"
            ],
            [
                'code' => '30712',
                'name' => "Buitengebied-Oost"
            ],
            [
                'code' => '30713',
                'name' => "Schuilenburg"
            ],
            [
                'code' => '30714',
                'name' => "Randenbroek"
            ],
            [
                'code' => '30715',
                'name' => "Vermeerkwartier"
            ],
            [
                'code' => '30716',
                'name' => "Leusderkwartier"
            ],
            [
                'code' => '30717',
                'name' => "De Berg-Zuid"
            ],
            [
                'code' => '30718',
                'name' => "De Berg-Noord"
            ],
            [
                'code' => '30719',
                'name' => "Hoogland"
            ],
            [
                'code' => '30720',
                'name' => "Zielhorst"
            ],
            [
                'code' => '30721',
                'name' => "Kattenbroek"
            ],
            [
                'code' => '30724',
                'name' => "Nieuwland"
            ],
            [
                'code' => '30725',
                'name' => "De Hoef"
            ],
            [
                'code' => '30726',
                'name' => "Hooglanderveen"
            ],
            [
                'code' => '30727',
                'name' => "Hoogland-West"
            ],
            [
                'code' => '30728',
                'name' => "Vathorst-De Velden"
            ],
            [
                'code' => '30729',
                'name' => "Vathorst-Centrum"
            ],
            [
                'code' => '30730',
                'name' => "Vathorst-De Bron"
            ],
            [
                'code' => '30731',
                'name' => "Vathorst-De Laak"
            ],
            [
                'code' => '30733',
                'name' => "Bedrijventerrein Vathorst"
            ],
            [
                'code' => '30734',
                'name' => "Bosgebied"
            ],
            [
                'code' => '30800',
                'name' => "Wijk 00 Baarn"
            ],
            [
                'code' => '30801',
                'name' => "Wijk 01 Baarn-Noord, Eemdal en Eemland"
            ],
            [
                'code' => '30802',
                'name' => "Wijk 02 P.H.W.park"
            ],
            [
                'code' => '30804',
                'name' => "Wijk 04 Buitengebied"
            ],
            [
                'code' => '30805',
                'name' => "Wijk 05 Lage Vuursche"
            ],
            [
                'code' => '31001',
                'name' => "Westbroek"
            ],
            [
                'code' => '31002',
                'name' => "Hollandsche Rading"
            ],
            [
                'code' => '31003',
                'name' => "Maartensdijk"
            ],
            [
                'code' => '31004',
                'name' => "Groenekan"
            ],
            [
                'code' => '31006',
                'name' => "Bilthoven Noord"
            ],
            [
                'code' => '31007',
                'name' => "Bilthoven Zuid Oost"
            ],
            [
                'code' => '31008',
                'name' => "Bilthoven Zuid West"
            ],
            [
                'code' => '31009',
                'name' => "De Bilt West"
            ],
            [
                'code' => '31010',
                'name' => "De Bilt Oost"
            ],
            [
                'code' => '31200',
                'name' => "Wijk 00 Bunnik"
            ],
            [
                'code' => '31201',
                'name' => "Wijk 01 Odijk"
            ],
            [
                'code' => '31202',
                'name' => "Wijk 02 Werkhoven"
            ],
            [
                'code' => '31300',
                'name' => "Wijk 00"
            ],
            [
                'code' => '31702',
                'name' => "Eemnes"
            ],
            [
                'code' => '32110',
                'name' => "Houten Noord-West"
            ],
            [
                'code' => '32111',
                'name' => "Houten Noord-Oost"
            ],
            [
                'code' => '32112',
                'name' => "Houten Zuid-West"
            ],
            [
                'code' => '32113',
                'name' => "Houten Zuid-Oost"
            ],
            [
                'code' => '32120',
                'name' => "Houten Buitengebied"
            ],
            [
                'code' => '32130',
                'name' => "'t Goy"
            ],
            [
                'code' => '32140',
                'name' => "Tull en 't Waal"
            ],
            [
                'code' => '32150',
                'name' => "Schalkwijk"
            ],
            [
                'code' => '32151',
                'name' => "Schalkwijk Buitengebied"
            ],
            [
                'code' => '32700',
                'name' => "Wijk 00 Leusden-Centrum Oost"
            ],
            [
                'code' => '32701',
                'name' => "Wijk 01 Leusden-Centrum West"
            ],
            [
                'code' => '32702',
                'name' => "Wijk 02 Leusden-Zuid"
            ],
            [
                'code' => '32703',
                'name' => "Wijk 03 Achterveld"
            ],
            [
                'code' => '32705',
                'name' => "Wijk 05 't Ruige Veld"
            ],
            [
                'code' => '33100',
                'name' => "Wijk 00 Lopik, Benschop en Polsbroek"
            ],
            [
                'code' => '33500',
                'name' => "Wijk 00"
            ],
            [
                'code' => '33501',
                'name' => "Wijk 01 Linschoten"
            ],
            [
                'code' => '33502',
                'name' => "Wijk 02 Willeskop"
            ],
            [
                'code' => '33900',
                'name' => "Wijk 00"
            ],
            [
                'code' => '34001',
                'name' => "Wijk 01 Rhenen Oost"
            ],
            [
                'code' => '34002',
                'name' => "Wijk 02 Rhenen West"
            ],
            [
                'code' => '34003',
                'name' => "Wijk 03 Rhenen Noord"
            ],
            [
                'code' => '34005',
                'name' => "Wijk 05 Randzone"
            ],
            [
                'code' => '34007',
                'name' => "Wijk 07 Achterberg"
            ],
            [
                'code' => '34013',
                'name' => "Wijk 13 Elst"
            ],
            [
                'code' => '34201',
                'name' => "Wijk 01 't Hart-Soestdijk"
            ],
            [
                'code' => '34203',
                'name' => "Wijk 03 Boerenstreek"
            ],
            [
                'code' => '34204',
                'name' => "Wijk 04 de Eng-Soest-Midden"
            ],
            [
                'code' => '34206',
                'name' => "Wijk 06 Overhees"
            ],
            [
                'code' => '34207',
                'name' => "Wijk 07 Soest-Zuid"
            ],
            [
                'code' => '34208',
                'name' => "Wijk 08 Soesterberg"
            ],
            [
                'code' => '34401',
                'name' => "Wijk 01 West"
            ],
            [
                'code' => '34402',
                'name' => "Wijk 02 Noordwest"
            ],
            [
                'code' => '34403',
                'name' => "Wijk 03 Overvecht"
            ],
            [
                'code' => '34404',
                'name' => "Wijk 04 Noordoost"
            ],
            [
                'code' => '34405',
                'name' => "Wijk 05 Oost"
            ],
            [
                'code' => '34406',
                'name' => "Wijk 06 Binnenstad"
            ],
            [
                'code' => '34407',
                'name' => "Wijk 07 Zuid"
            ],
            [
                'code' => '34408',
                'name' => "Wijk 08 Zuidwest"
            ],
            [
                'code' => '34409',
                'name' => "Wijk 09 Leidsche Rijn"
            ],
            [
                'code' => '34410',
                'name' => "Wijk 10 Vleuten-De Meern"
            ],
            [
                'code' => '34500',
                'name' => "Centrum"
            ],
            [
                'code' => '34501',
                'name' => "Noordoost"
            ],
            [
                'code' => '34502',
                'name' => "Zuidoost"
            ],
            [
                'code' => '34503',
                'name' => "Zuidwest"
            ],
            [
                'code' => '34504',
                'name' => "Noordwest"
            ],
            [
                'code' => '34505',
                'name' => "West"
            ],
            [
                'code' => '35100',
                'name' => "Wijk 00 Woudenberg"
            ],
            [
                'code' => '35200',
                'name' => "Wijk 00 Wijk bij Duurstede"
            ],
            [
                'code' => '35201',
                'name' => "Wijk 01 Landelijk gebied"
            ],
            [
                'code' => '35202',
                'name' => "Wijk 02 Cothen"
            ],
            [
                'code' => '35203',
                'name' => "Wijk 03 Langbroek"
            ],
            [
                'code' => '35300',
                'name' => "Wijk 00 IJsselstein"
            ],
            [
                'code' => '35501',
                'name' => "Wijk 01 Centrum Zeist"
            ],
            [
                'code' => '35502',
                'name' => "Wijk 02 Zeist-Noord"
            ],
            [
                'code' => '35503',
                'name' => "Wijk 03 Zeist-West"
            ],
            [
                'code' => '35504',
                'name' => "Wijk 04 Zeist-Oost, Zeister Bos en omgeving"
            ],
            [
                'code' => '35505',
                'name' => "Wijk 05 Huis Ter Heide, Bosch en Duin"
            ],
            [
                'code' => '35601',
                'name' => "Jutphaas Wijkersloot"
            ],
            [
                'code' => '35602',
                'name' => "Zuilenstein"
            ],
            [
                'code' => '35603',
                'name' => "Batau Zuid"
            ],
            [
                'code' => '35604',
                'name' => "Batau Noord"
            ],
            [
                'code' => '35605',
                'name' => "Doorslag"
            ],
            [
                'code' => '35608',
                'name' => "Galecop"
            ],
            [
                'code' => '35610',
                'name' => "Fokkesteeg"
            ],
            [
                'code' => '35611',
                'name' => "Hoogzandveld"
            ],
            [
                'code' => '35613',
                'name' => "Vreeswijk"
            ],
            [
                'code' => '35620',
                'name' => "Laagraven"
            ],
            [
                'code' => '35800',
                'name' => "Wijk 00 Aalsmeer"
            ],
            [
                'code' => '35802',
                'name' => "Wijk 02 Oosteinde"
            ],
            [
                'code' => '36101',
                'name' => "Zuid"
            ],
            [
                'code' => '36102',
                'name' => "Oudorp"
            ],
            [
                'code' => '36103',
                'name' => "Overdie"
            ],
            [
                'code' => '36104',
                'name' => "West"
            ],
            [
                'code' => '36105',
                'name' => "Huiswaard"
            ],
            [
                'code' => '36106',
                'name' => "De Mare"
            ],
            [
                'code' => '36107',
                'name' => "Daalmeer/Koedijk"
            ],
            [
                'code' => '36108',
                'name' => "Centrum"
            ],
            [
                'code' => '36109',
                'name' => "Schermer"
            ],
            [
                'code' => '36110',
                'name' => "Graft-De Rijp"
            ],
            [
                'code' => '36111',
                'name' => "Vroonermeer"
            ],
            [
                'code' => '36201',
                'name' => "Randwijck"
            ],
            [
                'code' => '36202',
                'name' => "Patrimonium"
            ],
            [
                'code' => '36203',
                'name' => "Elsrijk"
            ],
            [
                'code' => '36205',
                'name' => "Uilenstede, Kronenburg"
            ],
            [
                'code' => '36206',
                'name' => "Bankras, Kostverloren"
            ],
            [
                'code' => '36207',
                'name' => "Buitengebied Noord"
            ],
            [
                'code' => '36208',
                'name' => "Keizer Karelpark"
            ],
            [
                'code' => '36209',
                'name' => "Groenelaan"
            ],
            [
                'code' => '36210',
                'name' => "Waardhuizen, Middenhoven"
            ],
            [
                'code' => '36211',
                'name' => "Bovenkerk - Westwijk Noord"
            ],
            [
                'code' => '36212',
                'name' => "Westwijk Zuid"
            ],
            [
                'code' => '36213',
                'name' => "Buitengebied Zuid"
            ],
            [
                'code' => '36214',
                'name' => "Amsterdamse Bos"
            ],
            [
                'code' => '36300',
                'name' => "Burgwallen-Oude Zijde"
            ],
            [
                'code' => '36301',
                'name' => "Burgwallen-Nieuwe Zijde"
            ],
            [
                'code' => '36302',
                'name' => "Grachtengordel-West"
            ],
            [
                'code' => '36303',
                'name' => "Grachtengordel-Zuid"
            ],
            [
                'code' => '36304',
                'name' => "Nieuwmarkt/Lastage"
            ],
            [
                'code' => '36305',
                'name' => "Haarlemmerbuurt"
            ],
            [
                'code' => '36306',
                'name' => "Jordaan"
            ],
            [
                'code' => '36307',
                'name' => "De Weteringschans"
            ],
            [
                'code' => '36308',
                'name' => "Weesperbuurt/Plantage"
            ],
            [
                'code' => '36309',
                'name' => "Oostelijke Eilanden/Kadijken"
            ],
            [
                'code' => '36310',
                'name' => "Westelijk Havengebied"
            ],
            [
                'code' => '36311',
                'name' => "Bedrijventerrein Sloterdijk"
            ],
            [
                'code' => '36312',
                'name' => "Houthavens"
            ],
            [
                'code' => '36313',
                'name' => "Spaarndammer- en Zeeheldenbuurt"
            ],
            [
                'code' => '36314',
                'name' => "Staatsliedenbuurt"
            ],
            [
                'code' => '36315',
                'name' => "Centrale Markt"
            ],
            [
                'code' => '36316',
                'name' => "Frederik Hendrikbuurt"
            ],
            [
                'code' => '36318',
                'name' => "Kinkerbuurt"
            ],
            [
                'code' => '36319',
                'name' => "Van Lennepbuurt"
            ],
            [
                'code' => '36320',
                'name' => "Helmersbuurt"
            ],
            [
                'code' => '36321',
                'name' => "Overtoomse Sluis"
            ],
            [
                'code' => '36322',
                'name' => "Vondelbuurt"
            ],
            [
                'code' => '36323',
                'name' => "Zuidas"
            ],
            [
                'code' => '36324',
                'name' => "Oude Pijp"
            ],
            [
                'code' => '36325',
                'name' => "Nieuwe Pijp"
            ],
            [
                'code' => '36326',
                'name' => "Zuid Pijp"
            ],
            [
                'code' => '36327',
                'name' => "Weesperzijde"
            ],
            [
                'code' => '36328',
                'name' => "Oosterparkbuurt"
            ],
            [
                'code' => '36329',
                'name' => "Dapperbuurt"
            ],
            [
                'code' => '36330',
                'name' => "Transvaalbuurt"
            ],
            [
                'code' => '36331',
                'name' => "Indische Buurt West"
            ],
            [
                'code' => '36332',
                'name' => "Indische Buurt Oost"
            ],
            [
                'code' => '36333',
                'name' => "Oostelijk Havengebied"
            ],
            [
                'code' => '36334',
                'name' => "Zeeburgereiland/Nieuwe Diep"
            ],
            [
                'code' => '36335',
                'name' => "IJburg West"
            ],
            [
                'code' => '36336',
                'name' => "Sloterdijk"
            ],
            [
                'code' => '36337',
                'name' => "Landlust"
            ],
            [
                'code' => '36338',
                'name' => "Erasmuspark"
            ],
            [
                'code' => '36339',
                'name' => "De Kolenkit"
            ],
            [
                'code' => '36340',
                'name' => "Geuzenbuurt"
            ],
            [
                'code' => '36341',
                'name' => "Van Galenbuurt"
            ],
            [
                'code' => '36342',
                'name' => "Hoofdweg e.o."
            ],
            [
                'code' => '36343',
                'name' => "Westindische Buurt"
            ],
            [
                'code' => '36344',
                'name' => "Hoofddorppleinbuurt"
            ],
            [
                'code' => '36345',
                'name' => "Schinkelbuurt"
            ],
            [
                'code' => '36346',
                'name' => "Willemspark"
            ],
            [
                'code' => '36347',
                'name' => "Museumkwartier"
            ],
            [
                'code' => '36348',
                'name' => "Stadionbuurt"
            ],
            [
                'code' => '36349',
                'name' => "Apollobuurt"
            ],
            [
                'code' => '36350',
                'name' => "IJburg Oost"
            ],
            [
                'code' => '36351',
                'name' => "IJburg Zuid"
            ],
            [
                'code' => '36352',
                'name' => "Scheldebuurt"
            ],
            [
                'code' => '36353',
                'name' => "IJselbuurt"
            ],
            [
                'code' => '36354',
                'name' => "Rijnbuurt"
            ],
            [
                'code' => '36355',
                'name' => "Frankendael"
            ],
            [
                'code' => '36356',
                'name' => "Middenmeer"
            ],
            [
                'code' => '36357',
                'name' => "Betondorp"
            ],
            [
                'code' => '36358',
                'name' => "Omval/Overamstel"
            ],
            [
                'code' => '36359',
                'name' => "Prinses Irenebuurt e.o."
            ],
            [
                'code' => '36360',
                'name' => "Volewijck"
            ],
            [
                'code' => '36361',
                'name' => "IJplein/Vogelbuurt"
            ],
            [
                'code' => '36362',
                'name' => "Tuindorp Nieuwendam"
            ],
            [
                'code' => '36364',
                'name' => "Nieuwendammerdijk/Buiksloterdijk"
            ],
            [
                'code' => '36365',
                'name' => "Tuindorp Oostzaan"
            ],
            [
                'code' => '36366',
                'name' => "Oostzanerwerf"
            ],
            [
                'code' => '36367',
                'name' => "Kadoelen"
            ],
            [
                'code' => '36368',
                'name' => "Waterlandpleinbuurt"
            ],
            [
                'code' => '36369',
                'name' => "Buikslotermeer"
            ],
            [
                'code' => '36370',
                'name' => "Banne Buiksloot"
            ],
            [
                'code' => '36371',
                'name' => "Noordelijke IJ-oevers West"
            ],
            [
                'code' => '36372',
                'name' => "Noordelijke IJ-oevers Oost"
            ],
            [
                'code' => '36373',
                'name' => "Waterland"
            ],
            [
                'code' => '36374',
                'name' => "Elzenhagen"
            ],
            [
                'code' => '36375',
                'name' => "Chassébuurt"
            ],
            [
                'code' => '36376',
                'name' => "Slotermeer-Noordoost"
            ],
            [
                'code' => '36377',
                'name' => "Slotermeer-Zuidwest"
            ],
            [
                'code' => '36378',
                'name' => "Geuzenveld"
            ],
            [
                'code' => '36379',
                'name' => "Eendracht"
            ],
            [
                'code' => '36380',
                'name' => "Lutkemeer/Ookmeer"
            ],
            [
                'code' => '36381',
                'name' => "Osdorp-Oost"
            ],
            [
                'code' => '36382',
                'name' => "Osdorp-Midden"
            ],
            [
                'code' => '36383',
                'name' => "De Punt"
            ],
            [
                'code' => '36384',
                'name' => "Middelveldsche Akerpolder"
            ],
            [
                'code' => '36385',
                'name' => "Slotervaart Noord"
            ],
            [
                'code' => '36386',
                'name' => "Overtoomse Veld"
            ],
            [
                'code' => '36387',
                'name' => "Westlandgracht"
            ],
            [
                'code' => '36388',
                'name' => "Sloter-/Riekerpolder"
            ],
            [
                'code' => '36389',
                'name' => "Slotervaart Zuid"
            ],
            [
                'code' => '36390',
                'name' => "Buitenveldert-West"
            ],
            [
                'code' => '36391',
                'name' => "Buitenveldert-Oost"
            ],
            [
                'code' => '36392',
                'name' => "Amstel III/Bullewijk"
            ],
            [
                'code' => '36393',
                'name' => "Bijlmer Centrum (D,F,H)"
            ],
            [
                'code' => '36394',
                'name' => "Bijlmer Oost (E,G,K)"
            ],
            [
                'code' => '36395',
                'name' => "Nellestein"
            ],
            [
                'code' => '36396',
                'name' => "Holendrecht/Reigersbos"
            ],
            [
                'code' => '36397',
                'name' => "Gein"
            ],
            [
                'code' => '36398',
                'name' => "Driemond"
            ],
            [
                'code' => '36399',
                'name' => "Groot water"
            ],
            [
                'code' => '37008',
                'name' => "Beemster"
            ],
            [
                'code' => '37301',
                'name' => "Wijk 01 Bergen Binnen"
            ],
            [
                'code' => '37304',
                'name' => "Wijk 04 Egmond aan Zee"
            ],
            [
                'code' => '37305',
                'name' => "Wijk 05 Egmond-Binnen"
            ],
            [
                'code' => '37306',
                'name' => "Wijk 06 Egmond aan den Hoef"
            ],
            [
                'code' => '37307',
                'name' => "Wijk 07 Schoorl"
            ],
            [
                'code' => '37500',
                'name' => "Centrum"
            ],
            [
                'code' => '37501',
                'name' => "Vondelkwartier"
            ],
            [
                'code' => '37502',
                'name' => "Oranjebuurt"
            ],
            [
                'code' => '37503',
                'name' => "Kuenenkwartier"
            ],
            [
                'code' => '37504',
                'name' => "Warande"
            ],
            [
                'code' => '37505',
                'name' => "Noordwestelijk tuinbouwgebied"
            ],
            [
                'code' => '37506',
                'name' => "Oosterwijk en Zwaansmeer"
            ],
            [
                'code' => '37507',
                'name' => "Meerestein"
            ],
            [
                'code' => '37508',
                'name' => "Wijk aan Zee"
            ],
            [
                'code' => '37509',
                'name' => "de Pijp en Wijkerbroek"
            ],
            [
                'code' => '37510',
                'name' => "Broekpolder"
            ],
            [
                'code' => '37601',
                'name' => "Blaricum"
            ],
            [
                'code' => '37700',
                'name' => "Wijk 00 Bloemendaal"
            ],
            [
                'code' => '37701',
                'name' => "Wijk 01 Overveen"
            ],
            [
                'code' => '37702',
                'name' => "Wijk 02 Aerdenhout"
            ],
            [
                'code' => '37703',
                'name' => "Wijk 03 Vogelenzang"
            ],
            [
                'code' => '37704',
                'name' => "Wijk 04 Bennebroek"
            ],
            [
                'code' => '38300',
                'name' => "Wijk 00 Centrum"
            ],
            [
                'code' => '38301',
                'name' => "Wijk 01 Castricum-Noord"
            ],
            [
                'code' => '38302',
                'name' => "Wijk 02 Castricum-Oost"
            ],
            [
                'code' => '38303',
                'name' => "Wijk 03 Castricum-Zuid"
            ],
            [
                'code' => '38304',
                'name' => "Wijk 04 Bakkum"
            ],
            [
                'code' => '38305',
                'name' => "Wijk 05 Akersloot"
            ],
            [
                'code' => '38307',
                'name' => "Wijk 07 Limmen"
            ],
            [
                'code' => '38401',
                'name' => "Diemen Noord"
            ],
            [
                'code' => '38402',
                'name' => "Diemen Centrum"
            ],
            [
                'code' => '38403',
                'name' => "Diemen Zuid"
            ],
            [
                'code' => '38405',
                'name' => "Holland Park"
            ],
            [
                'code' => '38406',
                'name' => "Bedrijventerreinen"
            ],
            [
                'code' => '38407',
                'name' => "Plantage de Sniep"
            ],
            [
                'code' => '38408',
                'name' => "Buitengebied"
            ],
            [
                'code' => '38500',
                'name' => "Wijk 00 Edam"
            ],
            [
                'code' => '38502',
                'name' => "Wijk 02 Volendam"
            ],
            [
                'code' => '38504',
                'name' => "Wijk 04 Oosthuizen"
            ],
            [
                'code' => '38800',
                'name' => "Centrum en Havens"
            ],
            [
                'code' => '38801',
                'name' => "Enkhuizen Noord"
            ],
            [
                'code' => '38803',
                'name' => "Enkhuizen Zuid"
            ],
            [
                'code' => '38810',
                'name' => "Buitengebied IJsselmeer en Markermeer"
            ],
            [
                'code' => '39201',
                'name' => "Oude Stad"
            ],
            [
                'code' => '39202',
                'name' => "Haarlemmerhoutkwartier"
            ],
            [
                'code' => '39203',
                'name' => "Zijlwegkwartier"
            ],
            [
                'code' => '39204',
                'name' => "Houtvaartkwartier"
            ],
            [
                'code' => '39205',
                'name' => "Duinwijk"
            ],
            [
                'code' => '39206',
                'name' => "Waarder- en Veerpolder"
            ],
            [
                'code' => '39207',
                'name' => "Amsterdamsewijk"
            ],
            [
                'code' => '39208',
                'name' => "Slachthuiswijk"
            ],
            [
                'code' => '39209',
                'name' => "Parkwijk"
            ],
            [
                'code' => '39210',
                'name' => "Transvaalwijk"
            ],
            [
                'code' => '39211',
                'name' => "Indischewijk"
            ],
            [
                'code' => '39212',
                'name' => "Ter Kleefkwartier"
            ],
            [
                'code' => '39213',
                'name' => "Te Zaanenkwartier"
            ],
            [
                'code' => '39214',
                'name' => "Vogelenwijk"
            ],
            [
                'code' => '39215',
                'name' => "Delftwijk"
            ],
            [
                'code' => '39216',
                'name' => "Vondelkwartier"
            ],
            [
                'code' => '39217',
                'name' => "Spaarndam"
            ],
            [
                'code' => '39218',
                'name' => "Europawijk"
            ],
            [
                'code' => '39219',
                'name' => "Boerhaavewijk"
            ],
            [
                'code' => '39220',
                'name' => "Molenwijk"
            ],
            [
                'code' => '39221',
                'name' => "Meerwijk"
            ],
            [
                'code' => '39401',
                'name' => "Hoofddorp"
            ],
            [
                'code' => '39402',
                'name' => "Nieuw-Vennep"
            ],
            [
                'code' => '39403',
                'name' => "Zwanenburg"
            ],
            [
                'code' => '39404',
                'name' => "Lijnden / Boesingheliede"
            ],
            [
                'code' => '39405',
                'name' => "Badhoevedorp"
            ],
            [
                'code' => '39406',
                'name' => "Aalsmeerderbrug/ Oude Meer/ Rozenburg / Schiphol Rijk"
            ],
            [
                'code' => '39407',
                'name' => "Rijsenhout"
            ],
            [
                'code' => '39408',
                'name' => "Burgerveen / Leimuiderbrug / Weteringbrug"
            ],
            [
                'code' => '39409',
                'name' => "Abbenes / Buitenkaag"
            ],
            [
                'code' => '39410',
                'name' => "Lisserbroek"
            ],
            [
                'code' => '39411',
                'name' => "Beinsdorp"
            ],
            [
                'code' => '39412',
                'name' => "Zwaanshoek"
            ],
            [
                'code' => '39413',
                'name' => "Cruquius"
            ],
            [
                'code' => '39415',
                'name' => "Vijfhuizen"
            ],
            [
                'code' => '39420',
                'name' => "Spaarndam"
            ],
            [
                'code' => '39421',
                'name' => "Haarlemmerliede"
            ],
            [
                'code' => '39422',
                'name' => "Halfweg"
            ],
            [
                'code' => '39601',
                'name' => "Wijk 01 Heemskerk-Dorp"
            ],
            [
                'code' => '39602',
                'name' => "Wijk 02 Commandeurs en Marquette"
            ],
            [
                'code' => '39603',
                'name' => "Wijk 03 Hofland, Oosterwijk en Zuidbroek"
            ],
            [
                'code' => '39604',
                'name' => "Wijk 04 Heemskerkerduin en Noorddorp"
            ],
            [
                'code' => '39605',
                'name' => "Wijk 05 Poelenburg en Oosterzij"
            ],
            [
                'code' => '39606',
                'name' => "Wijk 06 Noordbroek en De Trompet"
            ],
            [
                'code' => '39607',
                'name' => "Wijk 07 Kerkbeek"
            ],
            [
                'code' => '39608',
                'name' => "Wijk 08 Assumburg"
            ],
            [
                'code' => '39609',
                'name' => "Wijk 09 Hoogdorp en Waterakkers"
            ],
            [
                'code' => '39610',
                'name' => "Wijk 10 Broekpolder"
            ],
            [
                'code' => '39700',
                'name' => "Wijk 00 Heemstede-Centrum"
            ],
            [
                'code' => '39701',
                'name' => "Wijk 01 Heemstede-Zuid"
            ],
            [
                'code' => '39802',
                'name' => "Wijk 02 Schilderswijk"
            ],
            [
                'code' => '39806',
                'name' => "Wijk 06 Bomen- Recreatiewijk"
            ],
            [
                'code' => '39807',
                'name' => "Wijk 07 Heemradenwijk"
            ],
            [
                'code' => '39809',
                'name' => "Wijk 09 Stadshart"
            ],
            [
                'code' => '39812',
                'name' => "Wijk 12 Bedrijventerrein"
            ],
            [
                'code' => '39813',
                'name' => "Wijk 13 Butterhuizen"
            ],
            [
                'code' => '39815',
                'name' => "Wijk 15 Zuidwijk"
            ],
            [
                'code' => '39816',
                'name' => "Wijk16 Huygenhoek"
            ],
            [
                'code' => '39817',
                'name' => "Wijk 17 Stad van de Zon"
            ],
            [
                'code' => '39818',
                'name' => "Wijk 18 De Draai"
            ],
            [
                'code' => '39902',
                'name' => "Wijk 02 Heiloo Noord-West"
            ],
            [
                'code' => '39903',
                'name' => "Wijk 03 Heiloo-Midden"
            ],
            [
                'code' => '39904',
                'name' => "Wijk 04 Heiloo-West"
            ],
            [
                'code' => '39905',
                'name' => "Wijk 05 Stationsomgeving"
            ],
            [
                'code' => '39906',
                'name' => "Wijk 06 Ypestein"
            ],
            [
                'code' => '39908',
                'name' => "Wijk 08 Heiloo Zuid-West"
            ],
            [
                'code' => '40001',
                'name' => "Wijk 01 Stad binnen de Linie-Oost"
            ],
            [
                'code' => '40002',
                'name' => "Wijk 02 Stad binnen de Linie-West"
            ],
            [
                'code' => '40003',
                'name' => "Wijk 03 Nieuw Den Helder-West"
            ],
            [
                'code' => '40004',
                'name' => "Wijk 04 Nieuw Den Helder-Oost"
            ],
            [
                'code' => '40005',
                'name' => "Wijk 05 De Schooten"
            ],
            [
                'code' => '40006',
                'name' => "Wijk 06 Het Koegras"
            ],
            [
                'code' => '40007',
                'name' => "Wijk 07 Duinzoom"
            ],
            [
                'code' => '40008',
                'name' => "Wijk 08 Julianadorp"
            ],
            [
                'code' => '40201',
                'name' => "Centrum"
            ],
            [
                'code' => '40202',
                'name' => "Noordwest"
            ],
            [
                'code' => '40203',
                'name' => "Zuidwest"
            ],
            [
                'code' => '40204',
                'name' => "Zuid"
            ],
            [
                'code' => '40205',
                'name' => "Zuidoost"
            ],
            [
                'code' => '40206',
                'name' => "Oost"
            ],
            [
                'code' => '40207',
                'name' => "Noordoost"
            ],
            [
                'code' => '40209',
                'name' => "Landelijk Gebied"
            ],
            [
                'code' => '40510',
                'name' => "Wijk 10 Binnenstad"
            ],
            [
                'code' => '40511',
                'name' => "Wijk 11 Venenlaan-kwartier"
            ],
            [
                'code' => '40512',
                'name' => "Wijk 12 Hoorn-Noord"
            ],
            [
                'code' => '40513',
                'name' => "Wijk 13 Grote Waal"
            ],
            [
                'code' => '40520',
                'name' => "Wijk 20 Risdam-Zuid"
            ],
            [
                'code' => '40521',
                'name' => "Wijk 21 Risdam-Noord"
            ],
            [
                'code' => '40522',
                'name' => "Wijk 22 Nieuwe Steen"
            ],
            [
                'code' => '40530',
                'name' => "Wijk 30 Zwaag"
            ],
            [
                'code' => '40531',
                'name' => "Wijk 31 Blokker"
            ],
            [
                'code' => '40532',
                'name' => "Wijk 32 Kersenboogerd-Noord"
            ],
            [
                'code' => '40533',
                'name' => "Wijk 33 Kersenboogerd-Zuid"
            ],
            [
                'code' => '40534',
                'name' => "Wijk 34 Hoorn 80"
            ],
            [
                'code' => '40535',
                'name' => "Wijk 35 Bangert en Oosterpolder"
            ],
            [
                'code' => '40600',
                'name' => "Wijk 00 Oude Dorp"
            ],
            [
                'code' => '40602',
                'name' => "Wijk 02 Buitenwijken"
            ],
            [
                'code' => '40603',
                'name' => "Wijk 03 Erica en Tafelberg"
            ],
            [
                'code' => '40604',
                'name' => "Wijk 04 Staatslieden en Componistenbuurt"
            ],
            [
                'code' => '40605',
                'name' => "Wijk 05 Havengebied"
            ],
            [
                'code' => '40606',
                'name' => "Wijk 06 Zenderwijk en Bovenweg"
            ],
            [
                'code' => '40608',
                'name' => "Wijk 08 Huizermaat West en Zuid"
            ],
            [
                'code' => '40610',
                'name' => "Wijk 10 Bijvanck"
            ],
            [
                'code' => '40611',
                'name' => "Wijk 11 Bovenmaten"
            ],
            [
                'code' => '40612',
                'name' => "Wijk 12 Hogemaat"
            ],
            [
                'code' => '41500',
                'name' => "Wijk 00 Landsmeer"
            ],
            [
                'code' => '41501',
                'name' => "Wijk 01 Ilpendam"
            ],
            [
                'code' => '41600',
                'name' => "Wijk 00"
            ],
            [
                'code' => '41703',
                'name' => "Laren"
            ],
            [
                'code' => '42001',
                'name' => "Medemblik"
            ],
            [
                'code' => '42002',
                'name' => "Opperdoes"
            ],
            [
                'code' => '42003',
                'name' => "Twisk"
            ],
            [
                'code' => '42005',
                'name' => "Abbekerk"
            ],
            [
                'code' => '42006',
                'name' => "Sijbekarspel"
            ],
            [
                'code' => '42007',
                'name' => "Benningbroek"
            ],
            [
                'code' => '42008',
                'name' => "Wognum"
            ],
            [
                'code' => '42009',
                'name' => "Zwaagdijk-West"
            ],
            [
                'code' => '42010',
                'name' => "Nibbixwoud"
            ],
            [
                'code' => '42011',
                'name' => "Midwoud"
            ],
            [
                'code' => '42012',
                'name' => "Oostwoud"
            ],
            [
                'code' => '42014',
                'name' => "Zwaagdijk-Oost"
            ],
            [
                'code' => '42015',
                'name' => "Wervershoof"
            ],
            [
                'code' => '42016',
                'name' => "Andijk"
            ],
            [
                'code' => '43100',
                'name' => "Wijk 00"
            ],
            [
                'code' => '43200',
                'name' => "Wijk 00"
            ],
            [
                'code' => '43201',
                'name' => "Wijk 01"
            ],
            [
                'code' => '43700',
                'name' => "Wijk 00"
            ],
            [
                'code' => '43901',
                'name' => "Wijk 01 Centrum"
            ],
            [
                'code' => '43902',
                'name' => "Wijk 02 Overwhere"
            ],
            [
                'code' => '43903',
                'name' => "Wijk 03 Wheermolen"
            ],
            [
                'code' => '43904',
                'name' => "Wijk 04 Gors"
            ],
            [
                'code' => '43905',
                'name' => "Wijk 05 Purmer-Noord"
            ],
            [
                'code' => '43906',
                'name' => "Wijk 06 Purmer-Zuid"
            ],
            [
                'code' => '43907',
                'name' => "Wijk 07 Weidevenne"
            ],
            [
                'code' => '44101',
                'name' => "Schagerbrug"
            ],
            [
                'code' => '44103',
                'name' => "Burgerbrug"
            ],
            [
                'code' => '44104',
                'name' => "Sint Maarten"
            ],
            [
                'code' => '44105',
                'name' => "Warmenhuizen"
            ],
            [
                'code' => '44106',
                'name' => "Tuitjenhorn"
            ],
            [
                'code' => '44107',
                'name' => "Waarland"
            ],
            [
                'code' => '44108',
                'name' => "Dirkshorn"
            ],
            [
                'code' => '44109',
                'name' => "Oudesluis"
            ],
            [
                'code' => '44110',
                'name' => "Schagen (woonkern-Midden)"
            ],
            [
                'code' => '44111',
                'name' => "Petten"
            ],
            [
                'code' => '44112',
                'name' => "Sint Maartensbrug"
            ],
            [
                'code' => '44113',
                'name' => "'t Zand"
            ],
            [
                'code' => '44114',
                'name' => "Sint Maartensvlotbrug"
            ],
            [
                'code' => '44115',
                'name' => "Callantsoog"
            ],
            [
                'code' => '44116',
                'name' => "Schagen (woonkern-West en Buitengebied)"
            ],
            [
                'code' => '44117',
                'name' => "Schagen (woonkern-Oost en Buitengebied)"
            ],
            [
                'code' => '44800',
                'name' => "Wijk 00 Het Oude Land en duingebied"
            ],
            [
                'code' => '44801',
                'name' => "Wijk 01 Het Nieuwe Land"
            ],
            [
                'code' => '45000',
                'name' => "Wijk 00 Uitgeest"
            ],
            [
                'code' => '45300',
                'name' => "Wijk 00 Velsen-Zuid en Driehuis"
            ],
            [
                'code' => '45301',
                'name' => "Wijk 01 IJmuiden-Noord"
            ],
            [
                'code' => '45302',
                'name' => "Wijk 02 IJmuiden-Zuid"
            ],
            [
                'code' => '45303',
                'name' => "Wijk 03 IJmuiden-West"
            ],
            [
                'code' => '45304',
                'name' => "Wijk 04 Zee- en Duinwijk"
            ],
            [
                'code' => '45305',
                'name' => "Wijk 05 Velsen-Noord"
            ],
            [
                'code' => '45306',
                'name' => "Wijk 06 Santpoort-Noord"
            ],
            [
                'code' => '45307',
                'name' => "Wijk 07 Santpoort-Zuid"
            ],
            [
                'code' => '45308',
                'name' => "Wijk 08 Velserbroek"
            ],
            [
                'code' => '45309',
                'name' => "Wijk 09 Spaarndammerpolder"
            ],
            [
                'code' => '45700',
                'name' => "Binnenstad"
            ],
            [
                'code' => '45701',
                'name' => "Zuid"
            ],
            [
                'code' => '45702',
                'name' => "Noord"
            ],
            [
                'code' => '45703',
                'name' => "Hogewey"
            ],
            [
                'code' => '45704',
                'name' => "Aetsveld"
            ],
            [
                'code' => '45709',
                'name' => "Bloemendalerpolder"
            ],
            [
                'code' => '47301',
                'name' => "Zandvoort Noord"
            ],
            [
                'code' => '47302',
                'name' => "Zandvoort Zuid"
            ],
            [
                'code' => '47303',
                'name' => "Bentveld"
            ],
            [
                'code' => '47304',
                'name' => "Buitengebied"
            ],
            [
                'code' => '47911',
                'name' => "Wijk 11 Zaandam Zuid"
            ],
            [
                'code' => '47913',
                'name' => "Wijk 13 Pelders- en Hoornseveld"
            ],
            [
                'code' => '47915',
                'name' => "Wijk 15 Kogerveldwijk"
            ],
            [
                'code' => '47916',
                'name' => "Wijk 16 Zaandam Noord"
            ],
            [
                'code' => '47921',
                'name' => "Wijk 21 Oude Haven"
            ],
            [
                'code' => '47922',
                'name' => "Wijk 22 Zaandam West"
            ],
            [
                'code' => '47923',
                'name' => "Wijk 23 Nieuw West"
            ],
            [
                'code' => '47942',
                'name' => "Wijk 42 Rooswijk"
            ],
            [
                'code' => '47951',
                'name' => "Wijk 51 Wormerveer"
            ],
            [
                'code' => '47961',
                'name' => "Wijk 61 Krommenie Oost"
            ],
            [
                'code' => '47962',
                'name' => "Wijk 62 Krommenie West"
            ],
            [
                'code' => '47971',
                'name' => "Wijk 71 Assendelft-Zuid"
            ],
            [
                'code' => '47972',
                'name' => "Wijk 72 Assendelft-Noord"
            ],
            [
                'code' => '47981',
                'name' => "Wijk 81 Westzaan"
            ],
            [
                'code' => '48201',
                'name' => "Wijk 01 Centrum"
            ],
            [
                'code' => '48202',
                'name' => "Wijk 02 Kinderdijk"
            ],
            [
                'code' => '48203',
                'name' => "Wijk 03 Blokweer"
            ],
            [
                'code' => '48204',
                'name' => "Wijk 04 Souburgh"
            ],
            [
                'code' => '48205',
                'name' => "Wijk 05 Bedrijventerrein"
            ],
            [
                'code' => '48206',
                'name' => "Wijk 06 Landelijk gebied"
            ],
            [
                'code' => '48401',
                'name' => "Oudshoorn"
            ],
            [
                'code' => '48402',
                'name' => "Ridderveld"
            ],
            [
                'code' => '48403',
                'name' => "Zegersloot"
            ],
            [
                'code' => '48404',
                'name' => "Hoorn"
            ],
            [
                'code' => '48405',
                'name' => "Hoge Zijde"
            ],
            [
                'code' => '48406',
                'name' => "Lage Zijde"
            ],
            [
                'code' => '48407',
                'name' => "Steekterpolder"
            ],
            [
                'code' => '48408',
                'name' => "Kerk en Zanen"
            ],
            [
                'code' => '48431',
                'name' => "Benthuizen"
            ],
            [
                'code' => '48445',
                'name' => "Aarlanderveen"
            ],
            [
                'code' => '48470',
                'name' => "Boskoop"
            ],
            [
                'code' => '48471',
                'name' => "Zwammerdam"
            ],
            [
                'code' => '48491',
                'name' => "Hazerswoude-Dorp"
            ],
            [
                'code' => '48494',
                'name' => "Hazerswoude-Rijndijk"
            ],
            [
                'code' => '48496',
                'name' => "Koudekerk aan den Rijn"
            ],
            [
                'code' => '48901',
                'name' => "Wijk 01 Centrum"
            ],
            [
                'code' => '48902',
                'name' => "Wijk 02 Noord"
            ],
            [
                'code' => '48904',
                'name' => "Wijk 04 Oranjewijk"
            ],
            [
                'code' => '48905',
                'name' => "Wijk 05 Buitenoord"
            ],
            [
                'code' => '48908',
                'name' => "Wijk 08 Molenvliet"
            ],
            [
                'code' => '48909',
                'name' => "Wijk 09 Nieuweland"
            ],
            [
                'code' => '48912',
                'name' => "Wijk 12 Smitshoek"
            ],
            [
                'code' => '48914',
                'name' => "Wijk 14 Meerwede"
            ],
            [
                'code' => '48930',
                'name' => "Wijk 30 Buitengebied Noord"
            ],
            [
                'code' => '48931',
                'name' => "Wijk 31 Buitengebied Zuid"
            ],
            [
                'code' => '48950',
                'name' => "Wijk 50 Bedrijventerreinen"
            ],
            [
                'code' => '49800',
                'name' => "Hoogkarspel"
            ],
            [
                'code' => '49801',
                'name' => "Westwoud"
            ],
            [
                'code' => '49803',
                'name' => "Venhuizen"
            ],
            [
                'code' => '49804',
                'name' => "Wijdenes"
            ],
            [
                'code' => '49806',
                'name' => "Hem"
            ],
            [
                'code' => '50100',
                'name' => "Wijk 00 Brielle"
            ],
            [
                'code' => '50101',
                'name' => "Wijk 01 Vierpolders"
            ],
            [
                'code' => '50102',
                'name' => "Wijk 02 Zwartewaal"
            ],
            [
                'code' => '50201',
                'name' => "Capelle West en 's Gravenland"
            ],
            [
                'code' => '50202',
                'name' => "Middelwatering West"
            ],
            [
                'code' => '50203',
                'name' => "Middelwatering Oost"
            ],
            [
                'code' => '50204',
                'name' => "Oostgaarde Zuid"
            ],
            [
                'code' => '50205',
                'name' => "Oostgaarde Noord"
            ],
            [
                'code' => '50206',
                'name' => "Schenkel"
            ],
            [
                'code' => '50207',
                'name' => "Schollevaar Zuid"
            ],
            [
                'code' => '50208',
                'name' => "Schollevaar Noord"
            ],
            [
                'code' => '50209',
                'name' => "Rivium"
            ],
            [
                'code' => '50311',
                'name' => "Wijk 11 Binnenstad"
            ],
            [
                'code' => '50312',
                'name' => "Wijk 12 Vrijenban"
            ],
            [
                'code' => '50313',
                'name' => "Wijk 13 Hof van Delft"
            ],
            [
                'code' => '50314',
                'name' => "Wijk 14 Voordijkshoorn"
            ],
            [
                'code' => '50316',
                'name' => "Wijk 16 Delftse Hout"
            ],
            [
                'code' => '50322',
                'name' => "Wijk 22 Tanthof-West"
            ],
            [
                'code' => '50323',
                'name' => "Wijk 23 Tanthof-Oost"
            ],
            [
                'code' => '50324',
                'name' => "Wijk 24 Voorhof"
            ],
            [
                'code' => '50325',
                'name' => "Wijk 25 Buitenhof"
            ],
            [
                'code' => '50327',
                'name' => "Wijk 27 Schieweg"
            ],
            [
                'code' => '50328',
                'name' => "Wijk 28 Wippolder"
            ],
            [
                'code' => '50329',
                'name' => "Wijk 29 Ruiven"
            ],
            [
                'code' => '50501',
                'name' => "Wijk 01 Binnenstad"
            ],
            [
                'code' => '50502',
                'name' => "Wijk 02 Noordflank"
            ],
            [
                'code' => '50503',
                'name' => "Wijk 03 Oud Krispijn"
            ],
            [
                'code' => '50504',
                'name' => "Wijk 04 Nieuw-krispijn"
            ],
            [
                'code' => '50505',
                'name' => "Wijk 05 Het Reeland"
            ],
            [
                'code' => '50506',
                'name' => "Wijk 06 Staart"
            ],
            [
                'code' => '50507',
                'name' => "Wijk 07 Wielwijk"
            ],
            [
                'code' => '50508',
                'name' => "Wijk 08 Crabbehof/Zuidhoven"
            ],
            [
                'code' => '50509',
                'name' => "Wijk 09 Sterrenburg"
            ],
            [
                'code' => '50510',
                'name' => "Wijk 10 Dubbeldam"
            ],
            [
                'code' => '50511',
                'name' => "Wijk 11 Stadspolders"
            ],
            [
                'code' => '50519',
                'name' => "Wijk 19 Industriegebied West"
            ],
            [
                'code' => '50598',
                'name' => "Wijk 98 Verspreide bebouwing"
            ],
            [
                'code' => '51201',
                'name' => "Wijk 01 Gorinchem binnenstad"
            ],
            [
                'code' => '51204',
                'name' => "Wijk 04 haarwijk"
            ],
            [
                'code' => '51211',
                'name' => "Wijk 11 laag Dalem"
            ],
            [
                'code' => '51214',
                'name' => "Wijk 14 Bedrijventerrein Oost"
            ],
            [
                'code' => '51301',
                'name' => "Binnenstad"
            ],
            [
                'code' => '51302',
                'name' => "De Korte Akkeren"
            ],
            [
                'code' => '51303',
                'name' => "Bloemendaal"
            ],
            [
                'code' => '51304',
                'name' => "Plaswijck"
            ],
            [
                'code' => '51305',
                'name' => "Noord"
            ],
            [
                'code' => '51306',
                'name' => "Kort Haarlem"
            ],
            [
                'code' => '51307',
                'name' => "Goverwelle"
            ],
            [
                'code' => '51308',
                'name' => "Stolwijkersluis"
            ],
            [
                'code' => '51309',
                'name' => "Westergouwe"
            ],
            [
                'code' => '51803',
                'name' => "Wijk 03 Westbroekpark en Duttendel"
            ],
            [
                'code' => '51804',
                'name' => "Wijk 04 Benoordenhout"
            ],
            [
                'code' => '51807',
                'name' => "Wijk 07 Scheveningen"
            ],
            [
                'code' => '51809',
                'name' => "Wijk 09 Geuzen- en Statenkwartier"
            ],
            [
                'code' => '51811',
                'name' => "Wijk 11 Duinoord"
            ],
            [
                'code' => '51812',
                'name' => "Wijk 12 Bomen- en Bloemenbuurt"
            ],
            [
                'code' => '51814',
                'name' => "Wijk 14 Bohemen en Meer en Bos"
            ],
            [
                'code' => '51815',
                'name' => "Wijk 15 Kijkduin en Ockenburgh"
            ],
            [
                'code' => '51817',
                'name' => "Wijk 17 Loosduinen"
            ],
            [
                'code' => '51818',
                'name' => "Wijk 18 Waldeck"
            ],
            [
                'code' => '51819',
                'name' => "Wijk 19 Vruchtenbuurt"
            ],
            [
                'code' => '51820',
                'name' => "Wijk 20 Valkenboskwartier"
            ],
            [
                'code' => '51821',
                'name' => "Wijk 21 Regentessekwartier"
            ],
            [
                'code' => '51825',
                'name' => "Wijk 25 Mariahoeve en Marlot"
            ],
            [
                'code' => '51826',
                'name' => "Wijk 26 Bezuidenhout"
            ],
            [
                'code' => '51827',
                'name' => "Wijk 27 Stationsbuurt"
            ],
            [
                'code' => '51828',
                'name' => "Wijk 28 Centrum"
            ],
            [
                'code' => '51829',
                'name' => "Wijk 29 Schildersbuurt"
            ],
            [
                'code' => '51830',
                'name' => "Wijk 30 Transvaalkwartier"
            ],
            [
                'code' => '51831',
                'name' => "Wijk 31 Rustenburg en Oostbroek"
            ],
            [
                'code' => '51833',
                'name' => "Wijk 33 Bouwlust en Vrederust"
            ],
            [
                'code' => '51834',
                'name' => "Wijk 34 Morgenstond"
            ],
            [
                'code' => '51836',
                'name' => "Wijk 36 Moerwijk"
            ],
            [
                'code' => '51838',
                'name' => "Wijk 38 Laakkwartier en Spoorwijk"
            ],
            [
                'code' => '51840',
                'name' => "Wijk 40 Wateringse Veld"
            ],
            [
                'code' => '51841',
                'name' => "Wijk 41 Hoornwijk"
            ],
            [
                'code' => '51842',
                'name' => "Wijk 42 Ypenburg"
            ],
            [
                'code' => '51843',
                'name' => "Wijk 43 Forepark"
            ],
            [
                'code' => '51844',
                'name' => "Wijk 44 Leidschenveen"
            ],
            [
                'code' => '52301',
                'name' => "Neder Hardinxveld"
            ],
            [
                'code' => '52302',
                'name' => "De Peulen"
            ],
            [
                'code' => '52303',
                'name' => "Boven Hardinxveld"
            ],
            [
                'code' => '52304',
                'name' => "Giessendam"
            ],
            [
                'code' => '53000',
                'name' => "Wijk 00 Hellevoet"
            ],
            [
                'code' => '53001',
                'name' => "Wijk 01 Nieuw-Helvoet"
            ],
            [
                'code' => '53002',
                'name' => "Wijk 02 Nieuwenhoorn"
            ],
            [
                'code' => '53003',
                'name' => "Wijk 03 De Struyten"
            ],
            [
                'code' => '53004',
                'name' => "Wijk 04 De Kooistee"
            ],
            [
                'code' => '53005',
                'name' => "Wijk 05 Den Bonsen Hoek"
            ],
            [
                'code' => '53006',
                'name' => "Wijk 06 Ravense Hoek"
            ],
            [
                'code' => '53007',
                'name' => "Wijk 07 Centrumgebied"
            ],
            [
                'code' => '53009',
                'name' => "Wijk 09 Buitengebied"
            ],
            [
                'code' => '53010',
                'name' => "Oudenhoorn"
            ],
            [
                'code' => '53099',
                'name' => "Groot water"
            ],
            [
                'code' => '53101',
                'name' => "Wijk 01 Centrum"
            ],
            [
                'code' => '53102',
                'name' => "Wijk 02 Krommeweg"
            ],
            [
                'code' => '53103',
                'name' => "Wijk 03 De Volgerlanden"
            ],
            [
                'code' => '53105',
                'name' => "Wijk 05 De Oevers"
            ],
            [
                'code' => '53201',
                'name' => "Stede Broec Buitengebied"
            ],
            [
                'code' => '53202',
                'name' => "Stede Broec Noord"
            ],
            [
                'code' => '53203',
                'name' => "Stede Broec Zuid"
            ],
            [
                'code' => '53401',
                'name' => "Hillegom Midden"
            ],
            [
                'code' => '53402',
                'name' => "Hillegom Noord"
            ],
            [
                'code' => '53403',
                'name' => "Hillegom Zuid"
            ],
            [
                'code' => '53404',
                'name' => "Hillegom West"
            ],
            [
                'code' => '53405',
                'name' => "Buitengebied"
            ],
            [
                'code' => '53701',
                'name' => "Katwijk Noord"
            ],
            [
                'code' => '53702',
                'name' => "'t Heen"
            ],
            [
                'code' => '53703',
                'name' => "Katwijk aan den Rijn"
            ],
            [
                'code' => '53705',
                'name' => "Katwijk aan Zee"
            ],
            [
                'code' => '53706',
                'name' => "Landelijk gebied Katwijk"
            ],
            [
                'code' => '53707',
                'name' => "Rijnsburg"
            ],
            [
                'code' => '53708',
                'name' => "Valkenburg"
            ],
            [
                'code' => '54200',
                'name' => "Wijk 00 Krimpen aan den IJssel"
            ],
            [
                'code' => '54600',
                'name' => "Binnenstad-Zuid"
            ],
            [
                'code' => '54601',
                'name' => "Binnenstad-Noord"
            ],
            [
                'code' => '54603',
                'name' => "Leiden-Noord"
            ],
            [
                'code' => '54604',
                'name' => "Roodenburgerdistrict"
            ],
            [
                'code' => '54605',
                'name' => "Bos- en Gasthuisdistrict"
            ],
            [
                'code' => '54606',
                'name' => "Morsdistrict"
            ],
            [
                'code' => '54607',
                'name' => "Boerhaavedistrict"
            ],
            [
                'code' => '54608',
                'name' => "Merenwijkdistrict"
            ],
            [
                'code' => '54609',
                'name' => "Stevenshofdistrict"
            ],
            [
                'code' => '54700',
                'name' => "Wijk 00"
            ],
            [
                'code' => '54701',
                'name' => "Wijk 01"
            ],
            [
                'code' => '54702',
                'name' => "Wijk 02"
            ],
            [
                'code' => '55301',
                'name' => "Lisse Noord"
            ],
            [
                'code' => '55302',
                'name' => "Centrum"
            ],
            [
                'code' => '55303',
                'name' => "Lisse Zuid"
            ],
            [
                'code' => '55304',
                'name' => "Buitengebied"
            ],
            [
                'code' => '55602',
                'name' => "Wijk 02 Dijkpolder"
            ],
            [
                'code' => '55603',
                'name' => "Sluispolder"
            ],
            [
                'code' => '55604',
                'name' => "Wijk 04 Kapelpolder"
            ],
            [
                'code' => '55605',
                'name' => "Wijk 05 Burgemeesterswijk"
            ],
            [
                'code' => '55606',
                'name' => "Wijk 06 Steendijkpolder"
            ],
            [
                'code' => '55607',
                'name' => "Wijk 07 Aalkeetpolder"
            ],
            [
                'code' => '56900',
                'name' => "Wijk 00"
            ],
            [
                'code' => '56901',
                'name' => "Wijk 01 Nieuwveen"
            ],
            [
                'code' => '56902',
                'name' => "Wijk 02 Zevenhoven"
            ],
            [
                'code' => '56903',
                'name' => "Wijk 03 Ter Aar"
            ],
            [
                'code' => '57500',
                'name' => "Noordwijk Zee"
            ],
            [
                'code' => '57501',
                'name' => "Noordwijk Binnen"
            ],
            [
                'code' => '57502',
                'name' => "Noordwijk Buitengebied"
            ],
            [
                'code' => '57503',
                'name' => "Noordwijkerhout"
            ],
            [
                'code' => '57504',
                'name' => "Noordwijkerhout Buitengebied"
            ],
            [
                'code' => '57505',
                'name' => "De Zilk"
            ],
            [
                'code' => '57900',
                'name' => "Wijk 00 Oegstgeest"
            ],
            [
                'code' => '58901',
                'name' => "Hekendorp"
            ],
            [
                'code' => '58902',
                'name' => "Oudewater"
            ],
            [
                'code' => '58903',
                'name' => "Papekop"
            ],
            [
                'code' => '59000',
                'name' => "Wijk 00 Papendrecht"
            ],
            [
                'code' => '59901',
                'name' => "Rotterdam Centrum"
            ],
            [
                'code' => '59903',
                'name' => "Delfshaven"
            ],
            [
                'code' => '59904',
                'name' => "Overschie"
            ],
            [
                'code' => '59905',
                'name' => "Noord"
            ],
            [
                'code' => '59906',
                'name' => "Hillegersberg-Schiebroek"
            ],
            [
                'code' => '59908',
                'name' => "Kralingen-Crooswijk"
            ],
            [
                'code' => '59910',
                'name' => "Feijenoord"
            ],
            [
                'code' => '59912',
                'name' => "IJsselmonde"
            ],
            [
                'code' => '59914',
                'name' => "Prins Alexander"
            ],
            [
                'code' => '59915',
                'name' => "Charlois"
            ],
            [
                'code' => '59916',
                'name' => "Hoogvliet"
            ],
            [
                'code' => '59917',
                'name' => "Hoek van Holland"
            ],
            [
                'code' => '59921',
                'name' => "Waalhaven-Eemhaven"
            ],
            [
                'code' => '59923',
                'name' => "Botlek-Europoort-Maasvlakte"
            ],
            [
                'code' => '59927',
                'name' => "Rozenburg"
            ],
            [
                'code' => '60301',
                'name' => "Wijk 01"
            ],
            [
                'code' => '60302',
                'name' => "Wijk 02"
            ],
            [
                'code' => '60303',
                'name' => "Wijk 03"
            ],
            [
                'code' => '60304',
                'name' => "Wijk 04"
            ],
            [
                'code' => '60306',
                'name' => "Wijk 06"
            ],
            [
                'code' => '60307',
                'name' => "Wijk 07"
            ],
            [
                'code' => '60308',
                'name' => "Wijk 08"
            ],
            [
                'code' => '60309',
                'name' => "Wijk 09"
            ],
            [
                'code' => '60310',
                'name' => "Wijk 10"
            ],
            [
                'code' => '60311',
                'name' => "Wijk 11"
            ],
            [
                'code' => '60601',
                'name' => "Wijk 01 Oost"
            ],
            [
                'code' => '60602',
                'name' => "Wijk 02 Tussen Havens en Grachten"
            ],
            [
                'code' => '60603',
                'name' => "Wijk 03 West"
            ],
            [
                'code' => '60604',
                'name' => "Wijk 04 Zuid"
            ],
            [
                'code' => '60606',
                'name' => "Wijk 06 Nieuwland"
            ],
            [
                'code' => '60607',
                'name' => "Wijk 07 Groenoord en Kethel"
            ],
            [
                'code' => '60608',
                'name' => "Wijk 08 Industriegebied ten noorden van Rijksweg 20"
            ],
            [
                'code' => '60609',
                'name' => "Wijk 09 Woudhoek/Spaland /Sveaparken"
            ],
            [
                'code' => '61001',
                'name' => "Wijk 01 Sliedrecht-West"
            ],
            [
                'code' => '61002',
                'name' => "Wijk 02 Sliedrecht-Centrum"
            ],
            [
                'code' => '61003',
                'name' => "Wijk 03 Sliedrecht-Oost"
            ],
            [
                'code' => '61004',
                'name' => "Wijk 04 Sliedrecht-Noord"
            ],
            [
                'code' => '61301',
                'name' => "Wijk 01 Poortugaal-Noord"
            ],
            [
                'code' => '61302',
                'name' => "Wijk 02 Rhoon-Noord"
            ],
            [
                'code' => '61303',
                'name' => "Wijk 03 Poortugaal-Zuid"
            ],
            [
                'code' => '61304',
                'name' => "Wijk 04 Rhoon-Zuid"
            ],
            [
                'code' => '61305',
                'name' => "Wijk 05 Buitengebied Albrandswaard"
            ],
            [
                'code' => '61306',
                'name' => "Wijk 06 Portland"
            ],
            [
                'code' => '61400',
                'name' => "Wijk 00 Rockanje"
            ],
            [
                'code' => '61401',
                'name' => "Wijk 01 Oostvoorne"
            ],
            [
                'code' => '62201',
                'name' => "Centrum"
            ],
            [
                'code' => '62202',
                'name' => "Westwijk"
            ],
            [
                'code' => '62203',
                'name' => "Vettenoordse Polder"
            ],
            [
                'code' => '62204',
                'name' => "Oostwijk"
            ],
            [
                'code' => '62205',
                'name' => "Vlaardinger Ambacht"
            ],
            [
                'code' => '62206',
                'name' => "Holy Zuid"
            ],
            [
                'code' => '62207',
                'name' => "Holy Noord"
            ],
            [
                'code' => '62600',
                'name' => "Wijk 00"
            ],
            [
                'code' => '62701',
                'name' => "Wijk 01"
            ],
            [
                'code' => '62702',
                'name' => "Wijk 02"
            ],
            [
                'code' => '62703',
                'name' => "Wijk 03"
            ],
            [
                'code' => '62704',
                'name' => "Wijk 04"
            ],
            [
                'code' => '62900',
                'name' => "Wijk 00 Zuidwestelijk deel der gemeente"
            ],
            [
                'code' => '62901',
                'name' => "Wijk 01 Noordoostelijk deel der gemeente"
            ],
            [
                'code' => '63201',
                'name' => "Wijk 01 Woerden-Midden"
            ],
            [
                'code' => '63202',
                'name' => "Wijk 02 Woerden-West"
            ],
            [
                'code' => '63203',
                'name' => "Wijk 03 Woerden-Oost"
            ],
            [
                'code' => '63204',
                'name' => "Wijk 04 Buitengebied Woerden-West"
            ],
            [
                'code' => '63205',
                'name' => "Wijk 05 Buitengebied Woerden-Oost"
            ],
            [
                'code' => '63206',
                'name' => "Wijk 06 Harmelen"
            ],
            [
                'code' => '63207',
                'name' => "Wijk 07 Kamerik"
            ],
            [
                'code' => '63208',
                'name' => "Wijk 08 Zegveld"
            ],
            [
                'code' => '63700',
                'name' => "Centrum"
            ],
            [
                'code' => '63701',
                'name' => "Meerzicht"
            ],
            [
                'code' => '63702',
                'name' => "Buytenwegh de Leyens"
            ],
            [
                'code' => '63703',
                'name' => "Seghwaert"
            ],
            [
                'code' => '63704',
                'name' => "Noordhove"
            ],
            [
                'code' => '63705',
                'name' => "Rokkeveen"
            ],
            [
                'code' => '63706',
                'name' => "Oosterheem"
            ],
            [
                'code' => '63708',
                'name' => "Industriegebied"
            ],
            [
                'code' => '63709',
                'name' => "Buitengebied"
            ],
            [
                'code' => '63800',
                'name' => "Zoeterwoude-Dorp"
            ],
            [
                'code' => '63810',
                'name' => "Zoeterwoude-Rijndijk"
            ],
            [
                'code' => '64201',
                'name' => "Wijk 01 Walburg"
            ],
            [
                'code' => '64202',
                'name' => "Wijk 02 Centrum"
            ],
            [
                'code' => '64203',
                'name' => "Wijk 03 Noord"
            ],
            [
                'code' => '64204',
                'name' => "Wijk 04 Heer Oudelands Ambacht"
            ],
            [
                'code' => '64205',
                'name' => "Wijk 05 Kort Ambacht"
            ],
            [
                'code' => '64206',
                'name' => "Wijk 06 Nederhoven"
            ],
            [
                'code' => '64207',
                'name' => "Wijk 07 Verspreide bebouwing"
            ],
            [
                'code' => '64208',
                'name' => "Wijk 08 Bebouwde kom Heerjansdam"
            ],
            [
                'code' => '64209',
                'name' => "Wijk 09 Landelijk gebied Heerjansdam"
            ],
            [
                'code' => '65401',
                'name' => "Baarland"
            ],
            [
                'code' => '65402',
                'name' => "Borssele"
            ],
            [
                'code' => '65403',
                'name' => "Driewegen"
            ],
            [
                'code' => '65404',
                'name' => "Ellewoutsdijk"
            ],
            [
                'code' => '65405',
                'name' => "Heinkenszand"
            ],
            [
                'code' => '65406',
                'name' => "Hoedekenskerke"
            ],
            [
                'code' => '65407',
                'name' => "Kwadendamme"
            ],
            [
                'code' => '65408',
                'name' => "Lewedorp"
            ],
            [
                'code' => '65409',
                'name' => "Nieuwdorp"
            ],
            [
                'code' => '65410',
                'name' => "Nisse"
            ],
            [
                'code' => '65411',
                'name' => "Oudelande"
            ],
            [
                'code' => '65412',
                'name' => "Ovezande"
            ],
            [
                'code' => '65413',
                'name' => "'s-Gravenpolder"
            ],
            [
                'code' => '65414',
                'name' => "'s-Heer Abtskerke"
            ],
            [
                'code' => '65415',
                'name' => "'s-Heerenhoek"
            ],
            [
                'code' => '66401',
                'name' => "Wijk 01 Goes"
            ],
            [
                'code' => '66402',
                'name' => "Wijk 02 Wilhelminadorp"
            ],
            [
                'code' => '66403',
                'name' => "Wijk 03 Kloetinge"
            ],
            [
                'code' => '66404',
                'name' => "Wijk 04 Kattendijke"
            ],
            [
                'code' => '66405',
                'name' => "Wijk 05 's-Heer-Arendskerke"
            ],
            [
                'code' => '66407',
                'name' => "Wijk 07 's-Heer-Hendrikskinderen"
            ],
            [
                'code' => '66408',
                'name' => "Wijk 08 Wolphaartsdijk"
            ],
            [
                'code' => '66499',
                'name' => "Groot water"
            ],
            [
                'code' => '66801',
                'name' => "Wijk 01 Alphen"
            ],
            [
                'code' => '66802',
                'name' => "Wijk 02 Altforst"
            ],
            [
                'code' => '66803',
                'name' => "Wijk 03 Appeltern"
            ],
            [
                'code' => '66804',
                'name' => "Wijk 04 Beneden-Leeuwen"
            ],
            [
                'code' => '66805',
                'name' => "Wijk 05 Boven-Leeuwen"
            ],
            [
                'code' => '66806',
                'name' => "Wijk 06 Dreumel"
            ],
            [
                'code' => '66807',
                'name' => "Wijk 07 Maasbommel"
            ],
            [
                'code' => '66808',
                'name' => "Wijk 08 Wamel"
            ],
            [
                'code' => '67701',
                'name' => "Hulst"
            ],
            [
                'code' => '67702',
                'name' => "Sint Jansteen"
            ],
            [
                'code' => '67703',
                'name' => "Clinge"
            ],
            [
                'code' => '67704',
                'name' => "Graauw"
            ],
            [
                'code' => '67705',
                'name' => "Heikant"
            ],
            [
                'code' => '67706',
                'name' => "Nieuw Namen"
            ],
            [
                'code' => '67707',
                'name' => "Kapellebrug"
            ],
            [
                'code' => '67708',
                'name' => "Kloosterzande"
            ],
            [
                'code' => '67709',
                'name' => "Lamswaarde"
            ],
            [
                'code' => '67710',
                'name' => "Terhole"
            ],
            [
                'code' => '67711',
                'name' => "Vogelwaarde"
            ],
            [
                'code' => '67712',
                'name' => "Hengstdijk"
            ],
            [
                'code' => '67713',
                'name' => "Ossenisse"
            ],
            [
                'code' => '67714',
                'name' => "Kuitaart"
            ],
            [
                'code' => '67715',
                'name' => "Walsoorden"
            ],
            [
                'code' => '67800',
                'name' => "Wijk 00 Kapelle"
            ],
            [
                'code' => '67801',
                'name' => "Wijk 01 Wemeldinge"
            ],
            [
                'code' => '67802',
                'name' => "Wijk 02 Schore"
            ],
            [
                'code' => '68700',
                'name' => "Binnenstad"
            ],
            [
                'code' => '68710',
                'name' => "Griffioen"
            ],
            [
                'code' => '68711',
                'name' => "Klarenbeek"
            ],
            [
                'code' => '68713',
                'name' => "Brigdamme"
            ],
            [
                'code' => '68714',
                'name' => "Sint Laurens"
            ],
            [
                'code' => '68716',
                'name' => "Veersepoort"
            ],
            [
                'code' => '68717',
                'name' => "Verspreide huizen in het noorden"
            ],
            [
                'code' => '68718',
                'name' => "Verspreide huizen in het noordwesten"
            ],
            [
                'code' => '68719',
                'name' => "Verspreide huizen in het noordoosten"
            ],
            [
                'code' => '68720',
                'name' => "Stromenwijk/'t Zand"
            ],
            [
                'code' => '68729',
                'name' => "Verspreide huizen in het zuidwesten"
            ],
            [
                'code' => '68730',
                'name' => "Middelburg Zuid"
            ],
            [
                'code' => '68731',
                'name' => "Dauwendaele"
            ],
            [
                'code' => '68732',
                'name' => "Arnestein"
            ],
            [
                'code' => '68739',
                'name' => "Mortiere"
            ],
            [
                'code' => '68749',
                'name' => "Verspreide huizen Nieuw- en Sint Joosland"
            ],
            [
                'code' => '68750',
                'name' => "Arnemuiden"
            ],
            [
                'code' => '70300',
                'name' => "Wijk 00 Yerseke"
            ],
            [
                'code' => '70301',
                'name' => "Wijk 01 Kruiningen"
            ],
            [
                'code' => '70302',
                'name' => "Wijk 02 Krabbendijke"
            ],
            [
                'code' => '70303',
                'name' => "Wijk 03 Waarde"
            ],
            [
                'code' => '70304',
                'name' => "Wijk 04 Rilland-Bath"
            ],
            [
                'code' => '70305',
                'name' => "Wijk 05 Hansweert"
            ],
            [
                'code' => '70306',
                'name' => "Wijk 06 Oostdijk"
            ],
            [
                'code' => '71521',
                'name' => "Terneuzen Noord"
            ],
            [
                'code' => '71522',
                'name' => "Terneuzen West"
            ],
            [
                'code' => '71523',
                'name' => "Terneuzen Zuid"
            ],
            [
                'code' => '71600',
                'name' => "Tholen"
            ],
            [
                'code' => '71601',
                'name' => "Poortvliet"
            ],
            [
                'code' => '71602',
                'name' => "Scherpenisse"
            ],
            [
                'code' => '71603',
                'name' => "Sint-Maartensdijk"
            ],
            [
                'code' => '71604',
                'name' => "Stavenisse"
            ],
            [
                'code' => '71605',
                'name' => "Sint-Annaland"
            ],
            [
                'code' => '71606',
                'name' => "Oud-Vossemeer"
            ],
            [
                'code' => '71607',
                'name' => "Sint Philipsland"
            ],
            [
                'code' => '71699',
                'name' => "Groot water"
            ],
            [
                'code' => '71700',
                'name' => "Wijk 00 Veere"
            ],
            [
                'code' => '71701',
                'name' => "Wijk 01 Gapinge"
            ],
            [
                'code' => '71702',
                'name' => "Wijk 02 Vrouwenpolder"
            ],
            [
                'code' => '71703',
                'name' => "Wijk 03 Serooskerke"
            ],
            [
                'code' => '71704',
                'name' => "Wijk 04 Domburg"
            ],
            [
                'code' => '71705',
                'name' => "Wijk 05 Oostkapelle"
            ],
            [
                'code' => '71706',
                'name' => "Wijk 06 Aagtekerke"
            ],
            [
                'code' => '71707',
                'name' => "Wijk 07 Grijpskerke"
            ],
            [
                'code' => '71708',
                'name' => "Wijk 08 Meliskerke"
            ],
            [
                'code' => '71709',
                'name' => "Wijk 09 Koudekerke"
            ],
            [
                'code' => '71710',
                'name' => "Wijk 10 Biggekerke"
            ],
            [
                'code' => '71711',
                'name' => "Wijk 11 Zoutelande"
            ],
            [
                'code' => '71712',
                'name' => "Wijk 12 Westkapelle"
            ],
            [
                'code' => '71799',
                'name' => "Groot water"
            ],
            [
                'code' => '71801',
                'name' => "Binnenstad"
            ],
            [
                'code' => '71802',
                'name' => "Middengebied"
            ],
            [
                'code' => '71803',
                'name' => "Paauwenburg - Westduin"
            ],
            [
                'code' => '71804',
                'name' => "Lammerenburg"
            ],
            [
                'code' => '71805',
                'name' => "Oost-Souburg"
            ],
            [
                'code' => '71806',
                'name' => "Ritthem e.o."
            ],
            [
                'code' => '71807',
                'name' => "Binnen- en Buitenhavens"
            ],
            [
                'code' => '73601',
                'name' => "Mijdrecht"
            ],
            [
                'code' => '73602',
                'name' => "de Hoef"
            ],
            [
                'code' => '73604',
                'name' => "Vinkeveen"
            ],
            [
                'code' => '73605',
                'name' => "Waverveen"
            ],
            [
                'code' => '73606',
                'name' => "Wilnis"
            ],
            [
                'code' => '73607',
                'name' => "Abcoude"
            ],
            [
                'code' => '73608',
                'name' => "Baambrugge"
            ],
            [
                'code' => '73700',
                'name' => "Wijk 00 Burgum"
            ],
            [
                'code' => '73701',
                'name' => "Wijk 01 Aldtsjerk"
            ],
            [
                'code' => '73702',
                'name' => "Wijk 02 Mûnein"
            ],
            [
                'code' => '73703',
                'name' => "Wijk 03 Ryptsjerk"
            ],
            [
                'code' => '73704',
                'name' => "Wijk 04 Tytsjerk"
            ],
            [
                'code' => '73705',
                'name' => "Wijk 05 Earnewâld"
            ],
            [
                'code' => '73706',
                'name' => "Wijk 06 Sumar"
            ],
            [
                'code' => '73707',
                'name' => "Wijk 07 Eastermar"
            ],
            [
                'code' => '73708',
                'name' => "Wijk 08 Noordburgum"
            ],
            [
                'code' => '73709',
                'name' => "Wijk 09 Hurdegaryp"
            ],
            [
                'code' => '74301',
                'name' => "Asten industrie noord"
            ],
            [
                'code' => '74302',
                'name' => "Asten buitengebied oost"
            ],
            [
                'code' => '74303',
                'name' => "Asten noord"
            ],
            [
                'code' => '74304',
                'name' => "Asten oost"
            ],
            [
                'code' => '74305',
                'name' => "Asten zuid"
            ],
            [
                'code' => '74306',
                'name' => "Asten centrum / west"
            ],
            [
                'code' => '74307',
                'name' => "Asten buitengebied west"
            ],
            [
                'code' => '74308',
                'name' => "Heusden wonen"
            ],
            [
                'code' => '74310',
                'name' => "Ommel wonen"
            ],
            [
                'code' => '74401',
                'name' => "Baarle-Nassau"
            ],
            [
                'code' => '74402',
                'name' => "Ulicoten"
            ],
            [
                'code' => '74800',
                'name' => "Wijk 00 Bergen op Zoom-Oude stad en omgeving"
            ],
            [
                'code' => '74801',
                'name' => "Wijk 01 Bergen op Zoom-Noord"
            ],
            [
                'code' => '74802',
                'name' => "Wijk 02 Bergen op Zoom-Oost"
            ],
            [
                'code' => '74803',
                'name' => "Wijk 03 Bergen op Zoom-West"
            ],
            [
                'code' => '74804',
                'name' => "Wijk 04 Halsteren"
            ],
            [
                'code' => '74805',
                'name' => "Wijk 05 Lepelstraat"
            ],
            [
                'code' => '75300',
                'name' => "Wijk 00 Best"
            ],
            [
                'code' => '75500',
                'name' => "Wijk 00 Boekel"
            ],
            [
                'code' => '75501',
                'name' => "Wijk 01 Venhorst"
            ],
            [
                'code' => '75600',
                'name' => "Wijk 00 Boxmeer"
            ],
            [
                'code' => '75601',
                'name' => "Wijk 01 Sambeek"
            ],
            [
                'code' => '75602',
                'name' => "Wijk 02 Beugen"
            ],
            [
                'code' => '75603',
                'name' => "Wijk 03 Oeffelt"
            ],
            [
                'code' => '75604',
                'name' => "Wijk 04 Rijkevoort"
            ],
            [
                'code' => '75605',
                'name' => "Wijk 05 Vortum-Mullem"
            ],
            [
                'code' => '75606',
                'name' => "Wijk 06 Vierlingsbeek"
            ],
            [
                'code' => '75607',
                'name' => "Wijk 07 Overloon"
            ],
            [
                'code' => '75608',
                'name' => "Wijk 08 Maashees"
            ],
            [
                'code' => '75609',
                'name' => "Wijk 09 Holthees"
            ],
            [
                'code' => '75700',
                'name' => "Wijk 00 Boxtel"
            ],
            [
                'code' => '75701',
                'name' => "Wijk 01 Lennisheuvel"
            ],
            [
                'code' => '75702',
                'name' => "Wijk 02 Liempde"
            ],
            [
                'code' => '75800',
                'name' => "Breda centrum"
            ],
            [
                'code' => '75801',
                'name' => "Breda noord"
            ],
            [
                'code' => '75802',
                'name' => "Breda oost"
            ],
            [
                'code' => '75803',
                'name' => "Breda zuid-oost"
            ],
            [
                'code' => '75804',
                'name' => "Breda zuid"
            ],
            [
                'code' => '75805',
                'name' => "Breda west"
            ],
            [
                'code' => '75806',
                'name' => "Breda noord-west"
            ],
            [
                'code' => '75807',
                'name' => "Bavel"
            ],
            [
                'code' => '75808',
                'name' => "Ulvenhout"
            ],
            [
                'code' => '75809',
                'name' => "Prinsenbeek"
            ],
            [
                'code' => '75810',
                'name' => "Teteringen"
            ],
            [
                'code' => '76200',
                'name' => "Wijk 00 Deurne"
            ],
            [
                'code' => '76201',
                'name' => "Wijk 01 Vlierden"
            ],
            [
                'code' => '76202',
                'name' => "Wijk 02 Liessel"
            ],
            [
                'code' => '76203',
                'name' => "Wijk 03 Neerkant"
            ],
            [
                'code' => '76204',
                'name' => "Wijk 04 Helenaveen"
            ],
            [
                'code' => '76500',
                'name' => "Wijk 00"
            ],
            [
                'code' => '76501',
                'name' => "Wijk 01"
            ],
            [
                'code' => '76601',
                'name' => "Dongen"
            ],
            [
                'code' => '76602',
                'name' => "'s Gravenmoer"
            ],
            [
                'code' => '77000',
                'name' => "Eersel"
            ],
            [
                'code' => '77001',
                'name' => "Duizel"
            ],
            [
                'code' => '77002',
                'name' => "Steensel"
            ],
            [
                'code' => '77003',
                'name' => "Vessem"
            ],
            [
                'code' => '77004',
                'name' => "Wintelre"
            ],
            [
                'code' => '77005',
                'name' => "Knegsel"
            ],
            [
                'code' => '77211',
                'name' => "Centrum"
            ],
            [
                'code' => '77221',
                'name' => "Oud-Stratum"
            ],
            [
                'code' => '77222',
                'name' => "Kortonjo"
            ],
            [
                'code' => '77223',
                'name' => "Putten"
            ],
            [
                'code' => '77231',
                'name' => "De Laak"
            ],
            [
                'code' => '77232',
                'name' => "Doornakkers"
            ],
            [
                'code' => '77233',
                'name' => "Oud-Tongelre"
            ],
            [
                'code' => '77241',
                'name' => "Oud-Woensel"
            ],
            [
                'code' => '77242',
                'name' => "Erp"
            ],
            [
                'code' => '77243',
                'name' => "Begijnenbroek"
            ],
            [
                'code' => '77251',
                'name' => "Ontginning"
            ],
            [
                'code' => '77252',
                'name' => "Achtse Molen"
            ],
            [
                'code' => '77253',
                'name' => "Aanschot"
            ],
            [
                'code' => '77254',
                'name' => "Dommelbeemd"
            ],
            [
                'code' => '77261',
                'name' => "Oud-Strijp"
            ],
            [
                'code' => '77262',
                'name' => "Halve Maan"
            ],
            [
                'code' => '77263',
                'name' => "Meerhoven"
            ],
            [
                'code' => '77271',
                'name' => "Rozenknopje"
            ],
            [
                'code' => '77272',
                'name' => "Oud-Gestel"
            ],
            [
                'code' => '77273',
                'name' => "Gestelse Ontginning"
            ],
            [
                'code' => '77700',
                'name' => "Midden woongebied"
            ],
            [
                'code' => '77710',
                'name' => "Noord woongebied"
            ],
            [
                'code' => '77712',
                'name' => "Noord landelijk gebied"
            ],
            [
                'code' => '77720',
                'name' => "Zuid woongebied"
            ],
            [
                'code' => '77723',
                'name' => "Zuid landelijk gebied"
            ],
            [
                'code' => '77900',
                'name' => "Wijk 00 Raamsdonksveer"
            ],
            [
                'code' => '77901',
                'name' => "Wijk 01 Raamsdonk"
            ],
            [
                'code' => '77902',
                'name' => "Wijk 02 Geertruidenberg"
            ],
            [
                'code' => '78401',
                'name' => "Rijen"
            ],
            [
                'code' => '78402',
                'name' => "Gilze"
            ],
            [
                'code' => '78403',
                'name' => "Hulten"
            ],
            [
                'code' => '78404',
                'name' => "Molenschot"
            ],
            [
                'code' => '78503',
                'name' => "Wijk 03 De Groote Akkers"
            ],
            [
                'code' => '78504',
                'name' => "Wijk 04 De Hoge Wal"
            ],
            [
                'code' => '78507',
                'name' => "Wijk 07 't Ven"
            ],
            [
                'code' => '78508',
                'name' => "Wijk 08 De Boschkens"
            ],
            [
                'code' => '78509',
                'name' => "Wijk 09 De Hellen"
            ],
            [
                'code' => '78511',
                'name' => "Wijk 11 Hoogeind"
            ],
            [
                'code' => '78513',
                'name' => "Wijk 13 Bedrijventerrein Tijvoort"
            ],
            [
                'code' => '78520',
                'name' => "Wijk 20 Riel"
            ],
            [
                'code' => '78605',
                'name' => "Escharen"
            ],
            [
                'code' => '78607',
                'name' => "Velp"
            ],
            [
                'code' => '78608',
                'name' => "Gassel"
            ],
            [
                'code' => '78613',
                'name' => "Grave"
            ],
            [
                'code' => '79410',
                'name' => "Wijk 10 Binnenstad"
            ],
            [
                'code' => '79411',
                'name' => "Wijk 11 Helmond-Oost"
            ],
            [
                'code' => '79412',
                'name' => "Wijk 12 Helmond-Noord"
            ],
            [
                'code' => '79413',
                'name' => "Wijk 13 't Hout"
            ],
            [
                'code' => '79414',
                'name' => "Wijk 14 Brouwhuis"
            ],
            [
                'code' => '79415',
                'name' => "Wijk 15 Helmond-West"
            ],
            [
                'code' => '79416',
                'name' => "Wijk 16 Warande"
            ],
            [
                'code' => '79417',
                'name' => "Wijk 17 Stiphout"
            ],
            [
                'code' => '79418',
                'name' => "Wijk 18 Rijpelberg"
            ],
            [
                'code' => '79419',
                'name' => "Wijk 19 Dierdonk"
            ],
            [
                'code' => '79421',
                'name' => "Wijk 21 Brandevoort"
            ],
            [
                'code' => '79429',
                'name' => "Wijk 29 Industriegebied Zuid"
            ],
            [
                'code' => '79601',
                'name' => "Binnenstad"
            ],
            [
                'code' => '79602',
                'name' => "Zuidoost"
            ],
            [
                'code' => '79603',
                'name' => "Graafsepoort"
            ],
            [
                'code' => '79604',
                'name' => "Muntel / Vliert"
            ],
            [
                'code' => '79605',
                'name' => "Rosmalen-Zuid"
            ],
            [
                'code' => '79606',
                'name' => "Rosmalen-Noord"
            ],
            [
                'code' => '79607',
                'name' => "De Groote Wielen"
            ],
            [
                'code' => '79608',
                'name' => "Empel"
            ],
            [
                'code' => '79609',
                'name' => "Noord"
            ],
            [
                'code' => '79610',
                'name' => "Maaspoort"
            ],
            [
                'code' => '79611',
                'name' => "West"
            ],
            [
                'code' => '79612',
                'name' => "Engelen"
            ],
            [
                'code' => '79613',
                'name' => "Nuland"
            ],
            [
                'code' => '79614',
                'name' => "Vinkel"
            ],
            [
                'code' => '79701',
                'name' => "Wijk 01 Drunen"
            ],
            [
                'code' => '79705',
                'name' => "Wijk 05 Vlijmen"
            ],
            [
                'code' => '79800',
                'name' => "Wijk 00 Hilvarenbeek"
            ],
            [
                'code' => '79801',
                'name' => "Wijk 01 Esbeek"
            ],
            [
                'code' => '79802',
                'name' => "Wijk 02 Biest-Houtakker"
            ],
            [
                'code' => '79803',
                'name' => "Wijk 03 Diessen"
            ],
            [
                'code' => '79804',
                'name' => "Wijk 04 Haghorst"
            ],
            [
                'code' => '80910',
                'name' => "Wijk 10 Kaatsheuvel-West"
            ],
            [
                'code' => '80920',
                'name' => "Wijk 20 Kaatsheuvel-Oost"
            ],
            [
                'code' => '80930',
                'name' => "Wijk 30 Loon op Zand"
            ],
            [
                'code' => '81509',
                'name' => "Mill"
            ],
            [
                'code' => '81510',
                'name' => "Sint Hubert"
            ],
            [
                'code' => '81512',
                'name' => "Wilbertoord"
            ],
            [
                'code' => '81515',
                'name' => "Langenboom"
            ],
            [
                'code' => '82000',
                'name' => "Wijk 00 Nuenen"
            ],
            [
                'code' => '82001',
                'name' => "Wijk 01 Gerwen"
            ],
            [
                'code' => '82002',
                'name' => "Wijk 02 Nederwetten"
            ],
            [
                'code' => '82300',
                'name' => "Wijk 00 Oirschot"
            ],
            [
                'code' => '82301',
                'name' => "Wijk 01 Spoordonk"
            ],
            [
                'code' => '82302',
                'name' => "Wijk 02 Middelbeers en Westelbeers"
            ],
            [
                'code' => '82303',
                'name' => "Wijk 03 Oostelbeers"
            ],
            [
                'code' => '82402',
                'name' => "Pannenschuur"
            ],
            [
                'code' => '82404',
                'name' => "Buitengebied (Zuid)"
            ],
            [
                'code' => '82408',
                'name' => "'t Westend / 't Seuverick"
            ],
            [
                'code' => '82409',
                'name' => "Bunders / Levenskerk"
            ],
            [
                'code' => '82411',
                'name' => "Waterhoef / Klompven"
            ],
            [
                'code' => '82413',
                'name' => "Centrum Oisterwijk"
            ],
            [
                'code' => '82420',
                'name' => "Haaren"
            ],
            [
                'code' => '82601',
                'name' => "Wijk 01 Slotjes"
            ],
            [
                'code' => '82602',
                'name' => "Wijk 02 West"
            ],
            [
                'code' => '82603',
                'name' => "Wijk 03 Strijen"
            ],
            [
                'code' => '82604',
                'name' => "Wijk 04 Leijsenakkers"
            ],
            [
                'code' => '82605',
                'name' => "Wijk 05 Oosterheide"
            ],
            [
                'code' => '82606',
                'name' => "Wijk 06 Dommelbergen"
            ],
            [
                'code' => '82607',
                'name' => "Wijk 07 Vrachelen"
            ],
            [
                'code' => '82608',
                'name' => "Wijk 08 Industrieterrein Zuid"
            ],
            [
                'code' => '82609',
                'name' => "Wijk 09 Industrieterrein Noord"
            ],
            [
                'code' => '82610',
                'name' => "Wijk 10 Buitengebied Oosterhout"
            ],
            [
                'code' => '82611',
                'name' => "Wijk 11 Den Hout"
            ],
            [
                'code' => '82612',
                'name' => "Wijk 12 Oosteind"
            ],
            [
                'code' => '82613',
                'name' => "Wijk 13 Dorst"
            ],
            [
                'code' => '82800',
                'name' => "Centrum"
            ],
            [
                'code' => '82801',
                'name' => "Schadewijk"
            ],
            [
                'code' => '82802',
                'name' => "Industrieterreinen-Zuid"
            ],
            [
                'code' => '82803',
                'name' => "Oss-Zuid"
            ],
            [
                'code' => '82804',
                'name' => "Krinkelhoek"
            ],
            [
                'code' => '82805',
                'name' => "Industrieterreinen-Noord"
            ],
            [
                'code' => '82806',
                'name' => "Ruwaard"
            ],
            [
                'code' => '82807',
                'name' => "Ussen"
            ],
            [
                'code' => '82808',
                'name' => "Buitengebied-Noord"
            ],
            [
                'code' => '82809',
                'name' => "Buitengebied-Zuid"
            ],
            [
                'code' => '82810',
                'name' => "Berghem"
            ],
            [
                'code' => '82811',
                'name' => "Haren"
            ],
            [
                'code' => '82812',
                'name' => "Macharen"
            ],
            [
                'code' => '82813',
                'name' => "Megen"
            ],
            [
                'code' => '82814',
                'name' => "Ravenstein"
            ],
            [
                'code' => '82815',
                'name' => "Herpen"
            ],
            [
                'code' => '82816',
                'name' => "Overlangel"
            ],
            [
                'code' => '82817',
                'name' => "Deursen en Dennenburg"
            ],
            [
                'code' => '82818',
                'name' => "Lith"
            ],
            [
                'code' => '82819',
                'name' => "Lithoijen"
            ],
            [
                'code' => '82820',
                'name' => "Oijen"
            ],
            [
                'code' => '82821',
                'name' => "Maren-Kessel"
            ],
            [
                'code' => '82822',
                'name' => "Geffen"
            ],
            [
                'code' => '84000',
                'name' => "Wijk 00 Rucphen"
            ],
            [
                'code' => '84001',
                'name' => "Wijk 01 Sint Willebrord"
            ],
            [
                'code' => '84002',
                'name' => "Wijk 02 Sprundel"
            ],
            [
                'code' => '84003',
                'name' => "Wijk 03 Schijf"
            ],
            [
                'code' => '84004',
                'name' => "Wijk 04 Zegge"
            ],
            [
                'code' => '84500',
                'name' => "Wijk 00 Sint-Michielsgestel"
            ],
            [
                'code' => '84501',
                'name' => "Wijk 01 Gemonde"
            ],
            [
                'code' => '84502',
                'name' => "Wijk 02 Den Dungen"
            ],
            [
                'code' => '84503',
                'name' => "Wijk 03 Berlicum"
            ],
            [
                'code' => '84504',
                'name' => "Wijk 04 Middelrode"
            ],
            [
                'code' => '84700',
                'name' => "Wijk 00 Someren"
            ],
            [
                'code' => '84701',
                'name' => "Wijk 01 Lierop"
            ],
            [
                'code' => '84702',
                'name' => "Wijk 02 Someren-Eind"
            ],
            [
                'code' => '84703',
                'name' => "Wijk 03 Somerense Heide"
            ],
            [
                'code' => '84800',
                'name' => "Wijk 00 Son"
            ],
            [
                'code' => '84801',
                'name' => "Wijk 01 Breugel"
            ],
            [
                'code' => '85100',
                'name' => "Wijk 00 Steenbergen"
            ],
            [
                'code' => '85101',
                'name' => "Wijk 01 Kruisland"
            ],
            [
                'code' => '85102',
                'name' => "Wijk 02 De Heen"
            ],
            [
                'code' => '85103',
                'name' => "Wijk 03 Dinteloord"
            ],
            [
                'code' => '85104',
                'name' => "Wijk 04 Nieuw-Vossemeer"
            ],
            [
                'code' => '85200',
                'name' => "Wijk 00 Monnickendam"
            ],
            [
                'code' => '85202',
                'name' => "Wijk 02 Marken"
            ],
            [
                'code' => '85203',
                'name' => "Wijk 03 Broek in Waterland"
            ],
            [
                'code' => '85204',
                'name' => "Wijk 04 Ilpendam"
            ],
            [
                'code' => '85510',
                'name' => "Binnenstad"
            ],
            [
                'code' => '85511',
                'name' => "Hoogvenne"
            ],
            [
                'code' => '85512',
                'name' => "Armhoef"
            ],
            [
                'code' => '85513',
                'name' => "Jeruzalem"
            ],
            [
                'code' => '85514',
                'name' => "Fatima"
            ],
            [
                'code' => '85515',
                'name' => "Broekhoven"
            ],
            [
                'code' => '85516',
                'name' => "Oerle"
            ],
            [
                'code' => '85517',
                'name' => "Korvel"
            ],
            [
                'code' => '85518',
                'name' => "Trouwlaan - Uitvindersbuurt"
            ],
            [
                'code' => '85519',
                'name' => "Sint Anna"
            ],
            [
                'code' => '85520',
                'name' => "Noordhoek"
            ],
            [
                'code' => '85521',
                'name' => "Spoorzone Zuid"
            ],
            [
                'code' => '85522',
                'name' => "Bouwmeester"
            ],
            [
                'code' => '85523',
                'name' => "De Hasselt"
            ],
            [
                'code' => '85524',
                'name' => "Het Goirke"
            ],
            [
                'code' => '85525',
                'name' => "Groeseind-Hoefstraat"
            ],
            [
                'code' => '85526',
                'name' => "Loven-Besterd"
            ],
            [
                'code' => '85527',
                'name' => "Theresia"
            ],
            [
                'code' => '85528',
                'name' => "Spoorzone Noord"
            ],
            [
                'code' => '85529',
                'name' => "Kanaalzone"
            ],
            [
                'code' => '85531',
                'name' => "De Leij"
            ],
            [
                'code' => '85532',
                'name' => "Groenewoud"
            ],
            [
                'code' => '85533',
                'name' => "Stappegoor"
            ],
            [
                'code' => '85534',
                'name' => "Bedrijventerrein Het Laar"
            ],
            [
                'code' => '85535',
                'name' => "De Blaak"
            ],
            [
                'code' => '85536',
                'name' => "Zorgvlied"
            ],
            [
                'code' => '85537',
                'name' => "De Reit"
            ],
            [
                'code' => '85538',
                'name' => "Het Zand"
            ],
            [
                'code' => '85539',
                'name' => "Wandelbos Noord"
            ],
            [
                'code' => '85540',
                'name' => "Wandelbos Zuid"
            ],
            [
                'code' => '85542',
                'name' => "Stokhasselt"
            ],
            [
                'code' => '85543',
                'name' => "Heikant"
            ],
            [
                'code' => '85544',
                'name' => "Quirijnstok"
            ],
            [
                'code' => '85545',
                'name' => "Ind.terrein Loven"
            ],
            [
                'code' => '85547',
                'name' => "Gesworen Hoek"
            ],
            [
                'code' => '85548',
                'name' => "Huibeven"
            ],
            [
                'code' => '85549',
                'name' => "Campenhoef"
            ],
            [
                'code' => '85551',
                'name' => "Heerevelden"
            ],
            [
                'code' => '85552',
                'name' => "Dongewijk"
            ],
            [
                'code' => '85553',
                'name' => "Tuindorp De Kievit"
            ],
            [
                'code' => '85554',
                'name' => "Leeuwerik"
            ],
            [
                'code' => '85555',
                'name' => "Dalem Noord"
            ],
            [
                'code' => '85556',
                'name' => "Dalem Zuid"
            ],
            [
                'code' => '85557',
                'name' => "Koolhoven"
            ],
            [
                'code' => '85558',
                'name' => "Witbrant"
            ],
            [
                'code' => '85559',
                'name' => "Bedrijventerrein Kraaiven"
            ],
            [
                'code' => '85560',
                'name' => "Bedrijventerrein Vossenberg"
            ],
            [
                'code' => '85561',
                'name' => "De Katsbogten"
            ],
            [
                'code' => '85563',
                'name' => "Buitengebied Tilburg Zuid-West"
            ],
            [
                'code' => '85564',
                'name' => "Buitengebied Tilburg Noord-Oost"
            ],
            [
                'code' => '85566',
                'name' => "Berkel-Enschot"
            ],
            [
                'code' => '85567',
                'name' => "Udenhout"
            ],
            [
                'code' => '85568',
                'name' => "Biezenmortel"
            ],
            [
                'code' => '85601',
                'name' => "Wijk 01 Uden"
            ],
            [
                'code' => '85602',
                'name' => "Wijk 02 Volkel"
            ],
            [
                'code' => '85603',
                'name' => "Wijk 03 Odiliapeel"
            ],
            [
                'code' => '85800',
                'name' => "Wijk 00 Valkenswaard"
            ],
            [
                'code' => '85801',
                'name' => "Wijk 01 Kloosterakkers en Dommelen"
            ],
            [
                'code' => '85802',
                'name' => "Wijk 02 Borkel en Schaft"
            ],
            [
                'code' => '86100',
                'name' => "Wijk 00 Veldhoven"
            ],
            [
                'code' => '86101',
                'name' => "Wijk 01 Noordelijk Woongebied"
            ],
            [
                'code' => '86102',
                'name' => "Wijk 02 Oerle"
            ],
            [
                'code' => '86500',
                'name' => "Wijk 00 Vught"
            ],
            [
                'code' => '86501',
                'name' => "Wijk 01 Vught-Zuid"
            ],
            [
                'code' => '86502',
                'name' => "Wijk 02 Cromvoirt"
            ],
            [
                'code' => '86503',
                'name' => "Wijk 03 Helvoirt"
            ],
            [
                'code' => '86600',
                'name' => "Wijk 00 Waalre"
            ],
            [
                'code' => '86700',
                'name' => "Wijk 00 Waalwijk"
            ],
            [
                'code' => '86701',
                'name' => "Wijk 01 Sprang-Capelle"
            ],
            [
                'code' => '86702',
                'name' => "Wijk 02 Waspik"
            ],
            [
                'code' => '87300',
                'name' => "Wijk 00 Hoogerheide en Woensdrecht"
            ],
            [
                'code' => '87301',
                'name' => "Wijk 01 Huijbergen"
            ],
            [
                'code' => '87302',
                'name' => "Wijk 02 Ossendrecht"
            ],
            [
                'code' => '87303',
                'name' => "Wijk 03 Putte"
            ],
            [
                'code' => '87900',
                'name' => "Wijk 00 Zundert"
            ],
            [
                'code' => '87901',
                'name' => "Wijk 01 Klein - Zundert"
            ],
            [
                'code' => '87902',
                'name' => "Wijk 02 Wernhout"
            ],
            [
                'code' => '87903',
                'name' => "Wijk 03 Achtmaal"
            ],
            [
                'code' => '87904',
                'name' => "Wijk 04 Rijsbergen"
            ],
            [
                'code' => '88000',
                'name' => "Wijk 00 Wormer"
            ],
            [
                'code' => '88001',
                'name' => "Wijk 01 Wijdewormer"
            ],
            [
                'code' => '88002',
                'name' => "Wijk 02 Jisp"
            ],
            [
                'code' => '88200',
                'name' => "Wijk 00 Schaesberg"
            ],
            [
                'code' => '88201',
                'name' => "Wijk 01 Nieuwenhagen"
            ],
            [
                'code' => '88202',
                'name' => "Wijk 02 Ubach over Worms"
            ],
            [
                'code' => '88800',
                'name' => "Wijk 00 Beek - Spaubeek"
            ],
            [
                'code' => '88801',
                'name' => "Wijk 01 Beek-Zuid"
            ],
            [
                'code' => '88900',
                'name' => "Wijk 00 Reuver"
            ],
            [
                'code' => '88901',
                'name' => "Wijk 01 Beesel"
            ],
            [
                'code' => '89301',
                'name' => "Aijen"
            ],
            [
                'code' => '89302',
                'name' => "Oud-Bergen"
            ],
            [
                'code' => '89303',
                'name' => "Nieuw-Bergen"
            ],
            [
                'code' => '89304',
                'name' => "Afferden"
            ],
            [
                'code' => '89305',
                'name' => "Siebengewald"
            ],
            [
                'code' => '89306',
                'name' => "Well"
            ],
            [
                'code' => '89307',
                'name' => "Wellerlooi"
            ],
            [
                'code' => '89901',
                'name' => "Wijk 01 Brunssum-West"
            ],
            [
                'code' => '89902',
                'name' => "Wijk 02 Brunssum-Noord"
            ],
            [
                'code' => '89903',
                'name' => "Wijk 03 Brunssum-Oost"
            ],
            [
                'code' => '89904',
                'name' => "Wijk 04 Brunssum-Zuid"
            ],
            [
                'code' => '89905',
                'name' => "Wijk 05 Brunssum-Centrum"
            ],
            [
                'code' => '90700',
                'name' => "Wijk 00 Milsbeek"
            ],
            [
                'code' => '90701',
                'name' => "Wijk 01 Ottersum"
            ],
            [
                'code' => '90702',
                'name' => "Wijk 02 Ven-Zelderheide"
            ],
            [
                'code' => '90703',
                'name' => "Wijk 03 Gennep"
            ],
            [
                'code' => '90704',
                'name' => "Wijk 04 Heijen"
            ],
            [
                'code' => '91710',
                'name' => "Wijk 10 Maria Gewanden en Terschuren"
            ],
            [
                'code' => '91711',
                'name' => "Wijk 11 Mariarade"
            ],
            [
                'code' => '91712',
                'name' => "Wijk 12 Hoensbroek-De Dem"
            ],
            [
                'code' => '91713',
                'name' => "Wijk 13 Nieuw Lotbroek"
            ],
            [
                'code' => '91720',
                'name' => "Wijk 20 Vrieheide-De Stack"
            ],
            [
                'code' => '91721',
                'name' => "Wijk 21 Heerlerheide-Passart"
            ],
            [
                'code' => '91722',
                'name' => "Wijk 22 Heksenberg"
            ],
            [
                'code' => '91724',
                'name' => "Wijk 24 Rennemig-Beersdal"
            ],
            [
                'code' => '91730',
                'name' => "Wijk 30 Zeswegen-Nieuw Husken"
            ],
            [
                'code' => '91731',
                'name' => "Wijk 31 Schandelen-Grasbroek"
            ],
            [
                'code' => '91732',
                'name' => "Wijk 32 Meezenbroek-Schaesbergerveld"
            ],
            [
                'code' => '91733',
                'name' => "Wijk 33 Heerlen-Centrum"
            ],
            [
                'code' => '91736',
                'name' => "Wijk 36 Welten-Benzenrade"
            ],
            [
                'code' => '91737',
                'name' => "Wijk 37 Bekkerveld"
            ],
            [
                'code' => '91738',
                'name' => "Wijk 38 Caumerveld-Douve Weien"
            ],
            [
                'code' => '91739',
                'name' => "Wijk 39 Molenberg"
            ],
            [
                'code' => '91741',
                'name' => "Wijk 41 Heerlerbaan-Schil"
            ],
            [
                'code' => '92800',
                'name' => "Wijk 00 Kerkrade-West"
            ],
            [
                'code' => '92801',
                'name' => "Wijk 01 Kerkrade-Oost"
            ],
            [
                'code' => '92802',
                'name' => "Wijk 02 Kerkrade-Noord"
            ],
            [
                'code' => '93500',
                'name' => "Wijk 00 Centrum"
            ],
            [
                'code' => '93501',
                'name' => "Wijk 01 Buitenwijk Zuidwest"
            ],
            [
                'code' => '93502',
                'name' => "Wijk 02 Buitenwijk West"
            ],
            [
                'code' => '93503',
                'name' => "Wijk 03 Buitenwijk Noordwest"
            ],
            [
                'code' => '93504',
                'name' => "Wijk 04 Buitenwijk Oost"
            ],
            [
                'code' => '93505',
                'name' => "Wijk 05 Buitenwijk Noordoost"
            ],
            [
                'code' => '93506',
                'name' => "Wijk 06 Buitenwijk Zuidoost"
            ],
            [
                'code' => '93800',
                'name' => "Wijk 00 Meerssen"
            ],
            [
                'code' => '93801',
                'name' => "Wijk 01 Ulestraten"
            ],
            [
                'code' => '93802',
                'name' => "Wijk 02 Bunde - Geulle"
            ],
            [
                'code' => '94400',
                'name' => "Wijk 00 Mook"
            ],
            [
                'code' => '94401',
                'name' => "Wijk 01 Middelaar"
            ],
            [
                'code' => '94601',
                'name' => "Wijk 01 Nederweert"
            ],
            [
                'code' => '94602',
                'name' => "Wijk 02 Budschop"
            ],
            [
                'code' => '94603',
                'name' => "Wijk 03 Ospel"
            ],
            [
                'code' => '94604',
                'name' => "Wijk 04 Nederweert-Eind"
            ],
            [
                'code' => '94605',
                'name' => "Wijk 05 Leveroy"
            ],
            [
                'code' => '95700',
                'name' => "Wijk 00 Centrum"
            ],
            [
                'code' => '95701',
                'name' => "Wijk 01 Roermond-Oost"
            ],
            [
                'code' => '95702',
                'name' => "Wijk 02 Roermond-Zuid"
            ],
            [
                'code' => '95703',
                'name' => "Wijk 03 Maasniel"
            ],
            [
                'code' => '95704',
                'name' => "Wijk 04 Donderberg"
            ],
            [
                'code' => '95706',
                'name' => "Wijk 06 Asenray"
            ],
            [
                'code' => '95707',
                'name' => "Wijk 07 Herten"
            ],
            [
                'code' => '95708',
                'name' => "Wijk 08 Swalmen"
            ],
            [
                'code' => '96500',
                'name' => "Wijk 00 Simpelveld"
            ],
            [
                'code' => '96501',
                'name' => "Wijk 01 Bocholtz"
            ],
            [
                'code' => '97100',
                'name' => "Wijk 00 Stein"
            ],
            [
                'code' => '97101',
                'name' => "Wijk 01 Elsloo"
            ],
            [
                'code' => '97102',
                'name' => "Wijk 02 Urmond"
            ],
            [
                'code' => '98100',
                'name' => "Wijk 00 Vijlen-Lemiers"
            ],
            [
                'code' => '98311',
                'name' => "Wijk 11 Venlo-Centrum"
            ],
            [
                'code' => '98312',
                'name' => "Wijk 12 Venlo-Zuid"
            ],
            [
                'code' => '98313',
                'name' => "Wijk 13 Venlo-Oost-Noord"
            ],
            [
                'code' => '98314',
                'name' => "Wijk 14 Venlo-Noord"
            ],
            [
                'code' => '98315',
                'name' => "Wijk 15 Venlo-Oost-Zuid"
            ],
            [
                'code' => '98316',
                'name' => "Wijk 16 Het Ven"
            ],
            [
                'code' => '98321',
                'name' => "Wijk 21 Blerick-Midden"
            ],
            [
                'code' => '98322',
                'name' => "Wijk 22 Blerick-Noord"
            ],
            [
                'code' => '98323',
                'name' => "Wijk 23 Blerick-Zuid"
            ],
            [
                'code' => '98324',
                'name' => "Wijk 24 Vossener"
            ],
            [
                'code' => '98325',
                'name' => "Wijk 25 Klingerberg"
            ],
            [
                'code' => '98326',
                'name' => "Wijk 26 Hout-Blerick"
            ],
            [
                'code' => '98327',
                'name' => "Wijk 27 Boekend"
            ],
            [
                'code' => '98328',
                'name' => "Wijk 28 Trade-Port"
            ],
            [
                'code' => '98331',
                'name' => "Wijk 31 Tegelen-Centrum"
            ],
            [
                'code' => '98332',
                'name' => "Wijk 32 Op de Hei"
            ],
            [
                'code' => '98335',
                'name' => "Wijk 35 Steyl"
            ],
            [
                'code' => '98341',
                'name' => "Wijk 41 Velden"
            ],
            [
                'code' => '98343',
                'name' => "Wijk 43 Lomm"
            ],
            [
                'code' => '98344',
                'name' => "Wijk 44 Arcen"
            ],
            [
                'code' => '98351',
                'name' => "Wijk 51 Belfeld"
            ],
            [
                'code' => '98412',
                'name' => "Oost"
            ],
            [
                'code' => '98413',
                'name' => "West"
            ],
            [
                'code' => '98415',
                'name' => "Veltum"
            ],
            [
                'code' => '98416',
                'name' => "Brukske"
            ],
            [
                'code' => '98417',
                'name' => "Landweert"
            ],
            [
                'code' => '98601',
                'name' => "Wijk 01 Voerendaal"
            ],
            [
                'code' => '98602',
                'name' => "Wijk02 Kunrade"
            ],
            [
                'code' => '98603',
                'name' => "Wijk 03 Ubachsberg"
            ],
            [
                'code' => '98604',
                'name' => "Wijk 04 Klimmen"
            ],
            [
                'code' => '98801',
                'name' => "Wijk 01 Boshoven"
            ],
            [
                'code' => '98802',
                'name' => "Wijk 02 Laar en Hushoven"
            ],
            [
                'code' => '98803',
                'name' => "Wijk 03 Molenakker en Kampershoek"
            ],
            [
                'code' => '98811',
                'name' => "Wijk 11 Weert-Centrum"
            ],
            [
                'code' => '98813',
                'name' => "Wijk 13 Groenewoud"
            ],
            [
                'code' => '98814',
                'name' => "Wijk 14 Fatima"
            ],
            [
                'code' => '98821',
                'name' => "Wijk 21 Keent"
            ],
            [
                'code' => '98822',
                'name' => "Wijk 22 Moesel"
            ],
            [
                'code' => '98824',
                'name' => "Wijk 24 Leuken"
            ],
            [
                'code' => '98825',
                'name' => "Wijk 25 Kazernelaan"
            ],
            [
                'code' => '98831',
                'name' => "Wijk 31 Altweerterheide"
            ],
            [
                'code' => '98832',
                'name' => "Wijk 32 Tungelroy"
            ],
            [
                'code' => '98833',
                'name' => "Wijk 33 Swartbroek"
            ],
            [
                'code' => '98834',
                'name' => "Wijk 34 Stramproy"
            ],
            [
                'code' => '99400',
                'name' => "Wijk 00: Valkenburg"
            ],
            [
                'code' => '99401',
                'name' => "Wijk 01: Houthem - Sint Gerlach"
            ],
            [
                'code' => '99402',
                'name' => "Wijk 02: Schin op Geul - Oud-Valkenburg"
            ],
            [
                'code' => '99403',
                'name' => "Wijk 03: Sibbe - IJzeren"
            ],
            [
                'code' => '99404',
                'name' => "Wijk 04: Berg en Terblijt - Vilt"
            ],
            [
                'code' => '99501',
                'name' => "Zuiderzeewijk"
            ],
            [
                'code' => '99502',
                'name' => "Atolwijk"
            ],
            [
                'code' => '99503',
                'name' => "Boswijk"
            ],
            [
                'code' => '99504',
                'name' => "Waterwijk-Landerijen"
            ],
            [
                'code' => '99505',
                'name' => "Bolder"
            ],
            [
                'code' => '99506',
                'name' => "Kustwijk"
            ],
            [
                'code' => '99507',
                'name' => "Havendiep"
            ],
            [
                'code' => '99508',
                'name' => "Lelystad-Haven"
            ],
            [
                'code' => '99509',
                'name' => "Stadshart"
            ],
            [
                'code' => '99510',
                'name' => "Buitengebied"
            ],
            [
                'code' => '99511',
                'name' => "Warande"
            ],
            [
                'code' => '150700',
                'name' => "Wijk 00 Griendtsveen"
            ],
            [
                'code' => '150701',
                'name' => "Wijk 01 America"
            ],
            [
                'code' => '150702',
                'name' => "Wijk 02 Meterik"
            ],
            [
                'code' => '150703',
                'name' => "Wijk 03 Hegelsom"
            ],
            [
                'code' => '150704',
                'name' => "Wijk 04 Horst"
            ],
            [
                'code' => '150705',
                'name' => "Wijk 05 Melderslo"
            ],
            [
                'code' => '150706',
                'name' => "Wijk 06 Broekhuizen"
            ],
            [
                'code' => '150707',
                'name' => "Wijk 07 Lottum"
            ],
            [
                'code' => '150708',
                'name' => "Wijk 08 Grubbenvorst"
            ],
            [
                'code' => '150709',
                'name' => "Wijk 09 Broekhuizen"
            ],
            [
                'code' => '150710',
                'name' => "Wijk 10 Sevenum"
            ],
            [
                'code' => '150711',
                'name' => "Wijk 11 Kronenberg"
            ],
            [
                'code' => '150712',
                'name' => "Wijk 12 Evertsoord"
            ],
            [
                'code' => '150713',
                'name' => "Wijk 13 Meerlo"
            ],
            [
                'code' => '150714',
                'name' => "Wijk 14 Tienray"
            ],
            [
                'code' => '150715',
                'name' => "Wijk 15 Swolgen"
            ],
            [
                'code' => '150900',
                'name' => "Wijk 00 Ulft-Etten"
            ],
            [
                'code' => '150901',
                'name' => "Wijk 01 Overig Gendringen"
            ],
            [
                'code' => '150902',
                'name' => "Wijk 02 Silvolde-Terborg"
            ],
            [
                'code' => '150903',
                'name' => "Wijk 03 Varsseveld"
            ],
            [
                'code' => '152501',
                'name' => "Voorhout Oude Dorp"
            ],
            [
                'code' => '152502',
                'name' => "Voorhout Oosthout"
            ],
            [
                'code' => '152503',
                'name' => "Voorhout Hooghkamer"
            ],
            [
                'code' => '152504',
                'name' => "Voorhout Buiten"
            ],
            [
                'code' => '152511',
                'name' => "Sassenheim Midden"
            ],
            [
                'code' => '152512',
                'name' => "Sassenheim Oost"
            ],
            [
                'code' => '152513',
                'name' => "Sassenheim Zuid"
            ],
            [
                'code' => '152514',
                'name' => "Sassenheim West"
            ],
            [
                'code' => '152515',
                'name' => "Sassenheim buiten"
            ],
            [
                'code' => '152521',
                'name' => "Warmond"
            ],
            [
                'code' => '152522',
                'name' => "Warmond buiten"
            ],
            [
                'code' => '158100',
                'name' => "Doorn"
            ],
            [
                'code' => '158101',
                'name' => "Driebergen"
            ],
            [
                'code' => '158102',
                'name' => "Leersum"
            ],
            [
                'code' => '158103',
                'name' => "Amerongen"
            ],
            [
                'code' => '158104',
                'name' => "Maarn"
            ],
            [
                'code' => '158601',
                'name' => "Wijk 01 Lichtenvoorde"
            ],
            [
                'code' => '158602',
                'name' => "Wijk 02 Harreveld"
            ],
            [
                'code' => '158603',
                'name' => "Wijk 03 Zieuwewnt"
            ],
            [
                'code' => '158604',
                'name' => "Wijk 04 Lievelde"
            ],
            [
                'code' => '158605',
                'name' => "Wijk 05 Vragender"
            ],
            [
                'code' => '158606',
                'name' => "Wijk 06 Groenlo"
            ],
            [
                'code' => '158607',
                'name' => "Wijk 07 Marienvelde"
            ],
            [
                'code' => '159801',
                'name' => "Obdam"
            ],
            [
                'code' => '159802',
                'name' => "Hensbroek"
            ],
            [
                'code' => '159803',
                'name' => "Spierdijk"
            ],
            [
                'code' => '159804',
                'name' => "Zuidermeer"
            ],
            [
                'code' => '159805',
                'name' => "Berkhout"
            ],
            [
                'code' => '159806',
                'name' => "Ursem"
            ],
            [
                'code' => '159807',
                'name' => "De Goorn"
            ],
            [
                'code' => '159808',
                'name' => "Avenhorn"
            ],
            [
                'code' => '159809',
                'name' => "Scharwoude"
            ],
            [
                'code' => '159810',
                'name' => "Oudendijk"
            ],
            [
                'code' => '162111',
                'name' => "Wijk 11 Bergschenhoek"
            ],
            [
                'code' => '162112',
                'name' => "Wijk 12 De Ackers"
            ],
            [
                'code' => '162113',
                'name' => "Wijk 13 Boterdorp"
            ],
            [
                'code' => '162115',
                'name' => "Wijk 15 Oosteindsche Polder"
            ],
            [
                'code' => '162121',
                'name' => "Wijk 21 Berkel"
            ],
            [
                'code' => '162122',
                'name' => "Wijk 22 Noordpolder"
            ],
            [
                'code' => '162123',
                'name' => "Wijk 23 Meerpolder"
            ],
            [
                'code' => '162125',
                'name' => "Wijk 25 Zuidpolder"
            ],
            [
                'code' => '162126',
                'name' => "Wijk 26 De Wadden"
            ],
            [
                'code' => '162127',
                'name' => "Wijk 27 Westpolder"
            ],
            [
                'code' => '162128',
                'name' => "Wijk 28 Rodenrijs"
            ],
            [
                'code' => '162131',
                'name' => "Wijk 31 Bleiswijk"
            ],
            [
                'code' => '162132',
                'name' => "Wijk 32 Hoekeindse Zoom"
            ],
            [
                'code' => '162133',
                'name' => "Wijk 33 Bleiswijk Buiten"
            ],
            [
                'code' => '164000',
                'name' => "Heythuysen"
            ],
            [
                'code' => '164001',
                'name' => "Heibloem"
            ],
            [
                'code' => '164002',
                'name' => "Roggel"
            ],
            [
                'code' => '164003',
                'name' => "Neer"
            ],
            [
                'code' => '164004',
                'name' => "Nunhem"
            ],
            [
                'code' => '164005',
                'name' => "Haelen"
            ],
            [
                'code' => '164006',
                'name' => "Buggenum"
            ],
            [
                'code' => '164007',
                'name' => "Horn"
            ],
            [
                'code' => '164008',
                'name' => "Baexem"
            ],
            [
                'code' => '164009',
                'name' => "Kelpen-Oler"
            ],
            [
                'code' => '164010',
                'name' => "Grathem"
            ],
            [
                'code' => '164011',
                'name' => "Ell"
            ],
            [
                'code' => '164012',
                'name' => "Haler"
            ],
            [
                'code' => '164013',
                'name' => "Hunsel"
            ],
            [
                'code' => '164014',
                'name' => "Neeritter"
            ],
            [
                'code' => '164015',
                'name' => "Ittervoort"
            ],
            [
                'code' => '164100',
                'name' => "Wijk 00 Maasbracht"
            ],
            [
                'code' => '164101',
                'name' => "Wijk 01 Linne"
            ],
            [
                'code' => '164102',
                'name' => "Wijk 02 Stevensweert"
            ],
            [
                'code' => '164103',
                'name' => "Wijk 03 Ohé en Laak"
            ],
            [
                'code' => '164104',
                'name' => "Wijk 04 Thorn"
            ],
            [
                'code' => '164105',
                'name' => "Wijk 05 Heel"
            ],
            [
                'code' => '165200',
                'name' => "Wijk 00 Gemert"
            ],
            [
                'code' => '165201',
                'name' => "Wijk 01 Handel"
            ],
            [
                'code' => '165202',
                'name' => "Wijk 02 De Mortel"
            ],
            [
                'code' => '165203',
                'name' => "Wijk 03 Elsendorp"
            ],
            [
                'code' => '165204',
                'name' => "Wijk 04 Bakel"
            ],
            [
                'code' => '165205',
                'name' => "Wijk 05 Milheeze"
            ],
            [
                'code' => '165206',
                'name' => "Wijk 06 De Rips"
            ],
            [
                'code' => '165501',
                'name' => "Wijk 01 Oud Gastel"
            ],
            [
                'code' => '165502',
                'name' => "Wijk 02 Stampersgat"
            ],
            [
                'code' => '165503',
                'name' => "Wijk 03 Oudenbosch"
            ],
            [
                'code' => '165504',
                'name' => "Wijk 04 Hoeven"
            ],
            [
                'code' => '165505',
                'name' => "Wijk 05 Bosschenhoofd"
            ],
            [
                'code' => '165800',
                'name' => "Wijk 00 Heeze"
            ],
            [
                'code' => '165801',
                'name' => "Wijk 01 Leende"
            ],
            [
                'code' => '165802',
                'name' => "Wijk 02 Leenderstrijp"
            ],
            [
                'code' => '165803',
                'name' => "Wijk 03 Sterksel"
            ],
            [
                'code' => '165900',
                'name' => "Wijk 00 Beek en Donk"
            ],
            [
                'code' => '165901',
                'name' => "Wijk 01 Aarle-Rixtel"
            ],
            [
                'code' => '165902',
                'name' => "Wijk 02 Lieshout"
            ],
            [
                'code' => '165903',
                'name' => "Wijk 03 Mariahout"
            ],
            [
                'code' => '166700',
                'name' => "Wijk 00 Reusel"
            ],
            [
                'code' => '166701',
                'name' => "Wijk 01 Hooge Mierde"
            ],
            [
                'code' => '166702',
                'name' => "Wijk 02 Lage Mierde"
            ],
            [
                'code' => '166703',
                'name' => "Wijk 03 Hulsel"
            ],
            [
                'code' => '166901',
                'name' => "Montfort"
            ],
            [
                'code' => '166902',
                'name' => "Sint Odiliënberg"
            ],
            [
                'code' => '166903',
                'name' => "Melick"
            ],
            [
                'code' => '166904',
                'name' => "Posterholt"
            ],
            [
                'code' => '166905',
                'name' => "Herkenbosch"
            ],
            [
                'code' => '166906',
                'name' => "Vlodrop"
            ],
            [
                'code' => '167400',
                'name' => "Wijk 00 Centrum"
            ],
            [
                'code' => '167401',
                'name' => "Wijk 01 Oost"
            ],
            [
                'code' => '167402',
                'name' => "Wijk 02 Noord"
            ],
            [
                'code' => '167403',
                'name' => "Wijk 03 West"
            ],
            [
                'code' => '167404',
                'name' => "Wijk 04 Groot Kroeven"
            ],
            [
                'code' => '167405',
                'name' => "Wijk 05 Langdonk"
            ],
            [
                'code' => '167406',
                'name' => "Wijk 06 Kortendijk"
            ],
            [
                'code' => '167407',
                'name' => "Wijk 07 Tolberg"
            ],
            [
                'code' => '167408',
                'name' => "Wijk 08 Industriegebieden"
            ],
            [
                'code' => '167410',
                'name' => "Wijk 10 Nispen"
            ],
            [
                'code' => '167411',
                'name' => "Wijk 11 Wouw"
            ],
            [
                'code' => '167412',
                'name' => "Wijk 12 Heerle"
            ],
            [
                'code' => '167413',
                'name' => "Wijk 13 Moerstraten"
            ],
            [
                'code' => '167414',
                'name' => "Wijk 14 Wouwse Plantage"
            ],
            [
                'code' => '167600',
                'name' => "Wijk 00 Zierikzee"
            ],
            [
                'code' => '167601',
                'name' => "Wijk 01 Brouwershaven"
            ],
            [
                'code' => '167602',
                'name' => "Wijk 02 Zonnemaire"
            ],
            [
                'code' => '167603',
                'name' => "Wijk 03 Dreischor"
            ],
            [
                'code' => '167604',
                'name' => "Wijk 04 Noordgouwe"
            ],
            [
                'code' => '167605',
                'name' => "Wijk 05 Bruinisse"
            ],
            [
                'code' => '167606',
                'name' => "Wijk 06 Nieuwerkerk"
            ],
            [
                'code' => '167607',
                'name' => "Wijk 07 Oosterland"
            ],
            [
                'code' => '167608',
                'name' => "Wijk 08 Ouwerkerk"
            ],
            [
                'code' => '167609',
                'name' => "Wijk 09 Scharendijke"
            ],
            [
                'code' => '167610',
                'name' => "Wijk 10 Kerkwerve"
            ],
            [
                'code' => '167611',
                'name' => "Wijk 11 Ellemeet"
            ],
            [
                'code' => '167612',
                'name' => "Wijk 12 Haamstede"
            ],
            [
                'code' => '167613',
                'name' => "Wijk 13 Renesse"
            ],
            [
                'code' => '167614',
                'name' => "Wijk 14 Noordwelle"
            ],
            [
                'code' => '167615',
                'name' => "Wijk 15 Serooskerke"
            ],
            [
                'code' => '167699',
                'name' => "Groot water"
            ],
            [
                'code' => '168000',
                'name' => "Wijk 00 Annen"
            ],
            [
                'code' => '168001',
                'name' => "Wijk 01 Eext"
            ],
            [
                'code' => '168002',
                'name' => "Wijk 02 Anloo"
            ],
            [
                'code' => '168003',
                'name' => "Wijk 03 Gasteren"
            ],
            [
                'code' => '168004',
                'name' => "Wijk 04 Anderen"
            ],
            [
                'code' => '168005',
                'name' => "Wijk 05 Schipborg"
            ],
            [
                'code' => '168006',
                'name' => "Wijk 06 Eexterveen"
            ],
            [
                'code' => '168007',
                'name' => "Wijk 07 Spijkerboor"
            ],
            [
                'code' => '168008',
                'name' => "Wijk 08 Nieuw-Annerveen"
            ],
            [
                'code' => '168009',
                'name' => "Wijk 09 Oud-Annerveen"
            ],
            [
                'code' => '168011',
                'name' => "Wijk 11 Annerveenschekanaal"
            ],
            [
                'code' => '168012',
                'name' => "Wijk 12 Eexterveenschekanaal"
            ],
            [
                'code' => '168013',
                'name' => "Wijk 13 Eexterzandvoort"
            ],
            [
                'code' => '168014',
                'name' => "Wijk 14 Gasselte"
            ],
            [
                'code' => '168015',
                'name' => "Wijk 15 Gasselternijveen"
            ],
            [
                'code' => '168016',
                'name' => "Wijk 16 Gasselternijveenschemond"
            ],
            [
                'code' => '168017',
                'name' => "Wijk 17 Gieten"
            ],
            [
                'code' => '168018',
                'name' => "Wijk 18 Gieterveen"
            ],
            [
                'code' => '168019',
                'name' => "Wijk 19 Rolde"
            ],
            [
                'code' => '168020',
                'name' => "Wijk 20 Grolloo"
            ],
            [
                'code' => '168021',
                'name' => "Wijk 21 Ekehaar"
            ],
            [
                'code' => '168100',
                'name' => "Valthe"
            ],
            [
                'code' => '168101',
                'name' => "Valthermond"
            ],
            [
                'code' => '168179',
                'name' => "1e Exloërmond"
            ],
            [
                'code' => '168180',
                'name' => "2e Exloërmond"
            ],
            [
                'code' => '168182',
                'name' => "Borger"
            ],
            [
                'code' => '168185',
                'name' => "Buinen"
            ],
            [
                'code' => '168186',
                'name' => "Buinerveen"
            ],
            [
                'code' => '168187',
                'name' => "Drouwen"
            ],
            [
                'code' => '168188',
                'name' => "Drouwenermond"
            ],
            [
                'code' => '168190',
                'name' => "Ees"
            ],
            [
                'code' => '168195',
                'name' => "Exloo"
            ],
            [
                'code' => '168196',
                'name' => "Klijndijk"
            ],
            [
                'code' => '168197',
                'name' => "Nieuw-Buinen"
            ],
            [
                'code' => '168198',
                'name' => "Odoorn"
            ],
            [
                'code' => '168199',
                'name' => "Odoornerveen"
            ],
            [
                'code' => '168401',
                'name' => "Linden"
            ],
            [
                'code' => '168402',
                'name' => "Katwijk"
            ],
            [
                'code' => '168403',
                'name' => "Vianen"
            ],
            [
                'code' => '168404',
                'name' => "Beers"
            ],
            [
                'code' => '168406',
                'name' => "Cuijk"
            ],
            [
                'code' => '168411',
                'name' => "Haps"
            ],
            [
                'code' => '168414',
                'name' => "Sint Agatha"
            ],
            [
                'code' => '168500',
                'name' => "Wijk 00 Schaijk"
            ],
            [
                'code' => '168501',
                'name' => "Wijk 01 Reek"
            ],
            [
                'code' => '168502',
                'name' => "Wijk 02 Zeeland"
            ],
            [
                'code' => '169000',
                'name' => "Wijk 00 Zuidwolde"
            ],
            [
                'code' => '169001',
                'name' => "Wijk 01 Alteveer"
            ],
            [
                'code' => '169002',
                'name' => "Wijk 02 Kerkenveld"
            ],
            [
                'code' => '169003',
                'name' => "Wijk 03 Drogteropslagen"
            ],
            [
                'code' => '169004',
                'name' => "Wijk 04 Linde"
            ],
            [
                'code' => '169005',
                'name' => "Wijk 05 Fort"
            ],
            [
                'code' => '169006',
                'name' => "Wijk 06 Veeningen"
            ],
            [
                'code' => '169007',
                'name' => "Wijk 07 Echten"
            ],
            [
                'code' => '169008',
                'name' => "Wijk 08 Ruinen"
            ],
            [
                'code' => '169009',
                'name' => "Wijk 09 Eursinge"
            ],
            [
                'code' => '169010',
                'name' => "Wijk 10 Ansen"
            ],
            [
                'code' => '169011',
                'name' => "Wijk 11 Ruinerwold"
            ],
            [
                'code' => '169012',
                'name' => "Wijk 12 Koekange"
            ],
            [
                'code' => '169013',
                'name' => "Wijk 13 De Wijk"
            ],
            [
                'code' => '169500',
                'name' => "Wijk 00 Kortgene"
            ],
            [
                'code' => '169501',
                'name' => "Wijk 01 Colijnsplaat"
            ],
            [
                'code' => '169502',
                'name' => "Wijk 02 Kats"
            ],
            [
                'code' => '169503',
                'name' => "Wijk 03 Kamperland"
            ],
            [
                'code' => '169504',
                'name' => "Wijk 04 Wissenkerke"
            ],
            [
                'code' => '169505',
                'name' => "Wijk 05 Geersdijk"
            ],
            [
                'code' => '169599',
                'name' => "Groot water"
            ],
            [
                'code' => '169601',
                'name' => "Wijk 01 Kortenhoef"
            ],
            [
                'code' => '169602',
                'name' => "Wijk 02 Ankeveen"
            ],
            [
                'code' => '169604',
                'name' => "Wijk 04 Nieuw-Loosdrecht"
            ],
            [
                'code' => '169606',
                'name' => "Wijk 06 Nederhorst den Berg"
            ],
            [
                'code' => '169900',
                'name' => "Wijk 00 Roden"
            ],
            [
                'code' => '169901',
                'name' => "Wijk 01 Roden"
            ],
            [
                'code' => '169903',
                'name' => "Wijk 03 Norg"
            ],
            [
                'code' => '169904',
                'name' => "Wijk 04 Norg"
            ],
            [
                'code' => '169906',
                'name' => "Wijk 06 Peize"
            ],
            [
                'code' => '170001',
                'name' => "Vriezenveen (kern)"
            ],
            [
                'code' => '170002',
                'name' => "Westerhaar-Vriezenveensewijk"
            ],
            [
                'code' => '170003',
                'name' => "Den Ham"
            ],
            [
                'code' => '170004',
                'name' => "Vroomshoop"
            ],
            [
                'code' => '170005',
                'name' => "Buitengebied Vriezenveen Noord"
            ],
            [
                'code' => '170100',
                'name' => "Wijk 00 Diever"
            ],
            [
                'code' => '170101',
                'name' => "Wijk 01 Wapse"
            ],
            [
                'code' => '170102',
                'name' => "Wijk 02 Zorgvlied"
            ],
            [
                'code' => '170103',
                'name' => "Wijk 03 Dwingeloo"
            ],
            [
                'code' => '170104',
                'name' => "Wijk 04 Lhee"
            ],
            [
                'code' => '170105',
                'name' => "Wijk 05 Eemster"
            ],
            [
                'code' => '170106',
                'name' => "Wijk 06 Geeuwenbrug"
            ],
            [
                'code' => '170107',
                'name' => "Wijk 07 Dieverbrug"
            ],
            [
                'code' => '170108',
                'name' => "Wijk 08 Havelte"
            ],
            [
                'code' => '170109',
                'name' => "Wijk 09 Uffelte"
            ],
            [
                'code' => '170110',
                'name' => "Wijk 10 Wapserveen"
            ],
            [
                'code' => '170111',
                'name' => "Wijk 11 Vledder"
            ],
            [
                'code' => '170112',
                'name' => "Wijk 12 Frederiksoord"
            ],
            [
                'code' => '170113',
                'name' => "Wijk 13 Nijensleek"
            ],
            [
                'code' => '170114',
                'name' => "Wijk 14 Vledderveen"
            ],
            [
                'code' => '170115',
                'name' => "Wijk 15 Wilhelminaoord"
            ],
            [
                'code' => '170116',
                'name' => "Wijk 16 Doldersum"
            ],
            [
                'code' => '170200',
                'name' => "Wijk 00 Sint Anthonis"
            ],
            [
                'code' => '170201',
                'name' => "Wijk 01 Oploo"
            ],
            [
                'code' => '170202',
                'name' => "Wijk 02 Westerbeek"
            ],
            [
                'code' => '170203',
                'name' => "Wijk 03 Stevensbeek"
            ],
            [
                'code' => '170204',
                'name' => "Wijk 04 Wanroij"
            ],
            [
                'code' => '170205',
                'name' => "Wijk 05 Landhorst"
            ],
            [
                'code' => '170500',
                'name' => "Wijk 00 Bemmel"
            ],
            [
                'code' => '170501',
                'name' => "Wijk 01 Gendt"
            ],
            [
                'code' => '170502',
                'name' => "Wijk 02 Huissen"
            ],
            [
                'code' => '170600',
                'name' => "Wijk 00 Budel"
            ],
            [
                'code' => '170601',
                'name' => "Wijk 01 Schoot"
            ],
            [
                'code' => '170602',
                'name' => "Wijk 02 Dorplein"
            ],
            [
                'code' => '170603',
                'name' => "Wijk 03 Maarheeze"
            ],
            [
                'code' => '170604',
                'name' => "Wijk 04 Soerendonk"
            ],
            [
                'code' => '170605',
                'name' => "Wijk 05 Gastel"
            ],
            [
                'code' => '170800',
                'name' => "Steenwijk"
            ],
            [
                'code' => '170802',
                'name' => "Oldemarkt"
            ],
            [
                'code' => '170803',
                'name' => "Kalenberg"
            ],
            [
                'code' => '170804',
                'name' => "Kuinre"
            ],
            [
                'code' => '170805',
                'name' => "Blankenham"
            ],
            [
                'code' => '170806',
                'name' => "Scheerwolde"
            ],
            [
                'code' => '170807',
                'name' => "Vollenhove"
            ],
            [
                'code' => '170808',
                'name' => "Sint Jansklooster"
            ],
            [
                'code' => '170810',
                'name' => "Belt-Schutsloot"
            ],
            [
                'code' => '170811',
                'name' => "Wanneperveen"
            ],
            [
                'code' => '170816',
                'name' => "Blokzijl"
            ],
            [
                'code' => '170817',
                'name' => "Giethoorn"
            ],
            [
                'code' => '170818',
                'name' => "Zuidveen"
            ],
            [
                'code' => '170819',
                'name' => "Onna"
            ],
            [
                'code' => '170820',
                'name' => "Kallenkote"
            ],
            [
                'code' => '170821',
                'name' => "Eesveen"
            ],
            [
                'code' => '170824',
                'name' => "Witte Paarden"
            ],
            [
                'code' => '170826',
                'name' => "Willemsoord"
            ],
            [
                'code' => '170828',
                'name' => "Tuk"
            ],
            [
                'code' => '170829',
                'name' => "Steenwijkerwold"
            ],
            [
                'code' => '170830',
                'name' => "Basse"
            ],
            [
                'code' => '170833',
                'name' => "Ossenzijl"
            ],
            [
                'code' => '170834',
                'name' => "Wetering"
            ],
            [
                'code' => '170900',
                'name' => "Wijk 00 Zevenbergen"
            ],
            [
                'code' => '170901',
                'name' => "Wijk 01 Zevenbergschen Hoek"
            ],
            [
                'code' => '170902',
                'name' => "Wijk 02 Langeweg"
            ],
            [
                'code' => '170903',
                'name' => "Wijk 03 Klundert"
            ],
            [
                'code' => '170904',
                'name' => "Wijk 04 Moerdijk"
            ],
            [
                'code' => '170905',
                'name' => "Wijk 05 Noordhoek"
            ],
            [
                'code' => '170906',
                'name' => "Wijk 06 Standdaarbuiten"
            ],
            [
                'code' => '170907',
                'name' => "Wijk 07 Fijnaart"
            ],
            [
                'code' => '170908',
                'name' => "Wijk 08 Heijningen"
            ],
            [
                'code' => '170909',
                'name' => "Wijk 09 Willemstad"
            ],
            [
                'code' => '170910',
                'name' => "Wijk 10 Helwijk"
            ],
            [
                'code' => '171101',
                'name' => "Wijk 01 Susteren"
            ],
            [
                'code' => '171102',
                'name' => "Wijk 02 Dieteren"
            ],
            [
                'code' => '171103',
                'name' => "Wijk 03 Heide"
            ],
            [
                'code' => '171104',
                'name' => "Wijk 04 Roosteren"
            ],
            [
                'code' => '171105',
                'name' => "Wijk 05 Echt"
            ],
            [
                'code' => '171106',
                'name' => "Wijk 06 Maria Hoop"
            ],
            [
                'code' => '171107',
                'name' => "Wijk 07 Peij"
            ],
            [
                'code' => '171108',
                'name' => "Wijk 08 Slek"
            ],
            [
                'code' => '171109',
                'name' => "Wijk 09 Nieuwstadt"
            ],
            [
                'code' => '171110',
                'name' => "Wijk 10 Sint Joost"
            ],
            [
                'code' => '171111',
                'name' => "Wijk 11 Koningsbosch"
            ],
            [
                'code' => '171400',
                'name' => "Wijk 00 Sluis"
            ],
            [
                'code' => '171401',
                'name' => "Wijk 01 Retranchement"
            ],
            [
                'code' => '171402',
                'name' => "Wijk 02 Aardenburg"
            ],
            [
                'code' => '171403',
                'name' => "Wijk 03 Eede"
            ],
            [
                'code' => '171404',
                'name' => "Wijk 04 Sint Kruis"
            ],
            [
                'code' => '171405',
                'name' => "Wijk 05 Oostburg"
            ],
            [
                'code' => '171406',
                'name' => "Wijk 06 Zuidzande"
            ],
            [
                'code' => '171407',
                'name' => "Wijk 07 Cadzand"
            ],
            [
                'code' => '171408',
                'name' => "Wijk 08 Nieuwvliet"
            ],
            [
                'code' => '171409',
                'name' => "Wijk 09 Groede"
            ],
            [
                'code' => '171410',
                'name' => "Wijk 10 Breskens"
            ],
            [
                'code' => '171411',
                'name' => "Wijk 11 Hoofdplaat"
            ],
            [
                'code' => '171412',
                'name' => "Wijk 12 IJzendijke"
            ],
            [
                'code' => '171413',
                'name' => "Wijk 13 Schoondijke"
            ],
            [
                'code' => '171414',
                'name' => "Wijk 14 Waterlandkerkje"
            ],
            [
                'code' => '171901',
                'name' => "Drimmelen"
            ],
            [
                'code' => '171902',
                'name' => "Made"
            ],
            [
                'code' => '171903',
                'name' => "Terheijden"
            ],
            [
                'code' => '171904',
                'name' => "Wagenberg"
            ],
            [
                'code' => '171905',
                'name' => "Hooge Zwaluwe en Zevenbergschen Hoek"
            ],
            [
                'code' => '171906',
                'name' => "Lage Zwaluwe"
            ],
            [
                'code' => '172101',
                'name' => "Kern Heesch"
            ],
            [
                'code' => '172102',
                'name' => "Kern Heeswijk-Dinther"
            ],
            [
                'code' => '172103',
                'name' => "Kern Nistelrode"
            ],
            [
                'code' => '172104',
                'name' => "Buitengebied Heesch"
            ],
            [
                'code' => '172105',
                'name' => "Buitengebied Heeswijk-Dinther"
            ],
            [
                'code' => '172106',
                'name' => "Buitengebied Nistelrode"
            ],
            [
                'code' => '172301',
                'name' => "Alphen"
            ],
            [
                'code' => '172302',
                'name' => "Chaam"
            ],
            [
                'code' => '172304',
                'name' => "Galder"
            ],
            [
                'code' => '172400',
                'name' => "Wijk 00 Bergeijk 't Hof"
            ],
            [
                'code' => '172402',
                'name' => "Wijk 02 Luyksgestel"
            ],
            [
                'code' => '172403',
                'name' => "Wijk 03 Riethoven"
            ],
            [
                'code' => '172404',
                'name' => "Wijk 04 Westerhoven"
            ],
            [
                'code' => '172405',
                'name' => "Wijk 05 Bergeijk 't Loo"
            ],
            [
                'code' => '172406',
                'name' => "Wijk 06 Buitengebied"
            ],
            [
                'code' => '172800',
                'name' => "Wijk 00 Bladel"
            ],
            [
                'code' => '172801',
                'name' => "Wijk 01 Netersel"
            ],
            [
                'code' => '172802',
                'name' => "Wijk 02 Hapert"
            ],
            [
                'code' => '172803',
                'name' => "Wijk 03 Hoogeloon"
            ],
            [
                'code' => '172804',
                'name' => "Wijk 04 Casteren"
            ],
            [
                'code' => '172900',
                'name' => "Wijk 00 Gulpen"
            ],
            [
                'code' => '172901',
                'name' => "Wijk 01 Wijlre"
            ],
            [
                'code' => '172902',
                'name' => "Wijk 02 Eys"
            ],
            [
                'code' => '172903',
                'name' => "Wijk 03 Wittem"
            ],
            [
                'code' => '172904',
                'name' => "Wijk 04 Mechelen"
            ],
            [
                'code' => '172905',
                'name' => "Wijk 05 Epen"
            ],
            [
                'code' => '172906',
                'name' => "Wijk 06 Slenaken"
            ],
            [
                'code' => '173000',
                'name' => "Wijk 00 Zuidlaren"
            ],
            [
                'code' => '173001',
                'name' => "Wijk 01 De Groeve"
            ],
            [
                'code' => '173002',
                'name' => "Wijk 02 Zuidlaarderveen"
            ],
            [
                'code' => '173003',
                'name' => "Wijk 03 Midlaren"
            ],
            [
                'code' => '173004',
                'name' => "Wijk 04 Westlaren"
            ],
            [
                'code' => '173005',
                'name' => "Wijk 05 Schuilingsoord"
            ],
            [
                'code' => '173006',
                'name' => "Wijk 06 Paterswolde"
            ],
            [
                'code' => '173007',
                'name' => "Wijk 07 Eelde"
            ],
            [
                'code' => '173008',
                'name' => "Wijk 08 Eelderwolde"
            ],
            [
                'code' => '173009',
                'name' => "Wijk 09 Vries"
            ],
            [
                'code' => '173010',
                'name' => "Wijk 10 Donderen"
            ],
            [
                'code' => '173011',
                'name' => "Wijk 11 Bunne"
            ],
            [
                'code' => '173012',
                'name' => "Wijk 12 Yde"
            ],
            [
                'code' => '173013',
                'name' => "Wijk 13 Tynaarlo"
            ],
            [
                'code' => '173014',
                'name' => "Wijk 14 Zeegse"
            ],
            [
                'code' => '173015',
                'name' => "Wijk 15 Zeijen"
            ],
            [
                'code' => '173100',
                'name' => "Wijk 00 Beilen"
            ],
            [
                'code' => '173101',
                'name' => "Wijk 01 Hijken"
            ],
            [
                'code' => '173102',
                'name' => "Wijk 02 Hooghalen"
            ],
            [
                'code' => '173103',
                'name' => "Wijk 03 Wijster"
            ],
            [
                'code' => '173104',
                'name' => "Wijk 04 Spier"
            ],
            [
                'code' => '173105',
                'name' => "Wijk 05 Drijber"
            ],
            [
                'code' => '173106',
                'name' => "Wijk 06 Smilde"
            ],
            [
                'code' => '173107',
                'name' => "Wijk 07 Bovensmilde"
            ],
            [
                'code' => '173108',
                'name' => "Wijk 08 Hoogersmilde"
            ],
            [
                'code' => '173109',
                'name' => "Wijk 09 Westerbork"
            ],
            [
                'code' => '173110',
                'name' => "Wijk 10 Elp"
            ],
            [
                'code' => '173111',
                'name' => "Wijk 11 Witteveen"
            ],
            [
                'code' => '173112',
                'name' => "Wijk 12 Nieuw-Balinge"
            ],
            [
                'code' => '173114',
                'name' => "Wijk 14 Zwiggelte"
            ],
            [
                'code' => '173115',
                'name' => "Wijk 15 Orvelte"
            ],
            [
                'code' => '173116',
                'name' => "Wijk 16 De Broekstreek"
            ],
            [
                'code' => '173401',
                'name' => "Buitengebied Elst"
            ],
            [
                'code' => '173402',
                'name' => "Elst-Zuid"
            ],
            [
                'code' => '173403',
                'name' => "Elst-Noord"
            ],
            [
                'code' => '173404',
                'name' => "De Aam"
            ],
            [
                'code' => '173405',
                'name' => "Westeraam"
            ],
            [
                'code' => '173406',
                'name' => "Elst-Oost"
            ],
            [
                'code' => '173407',
                'name' => "Oosterhout"
            ],
            [
                'code' => '173408',
                'name' => "Slijk-Ewijk"
            ],
            [
                'code' => '173409',
                'name' => "Herveld"
            ],
            [
                'code' => '173410',
                'name' => "Andelst"
            ],
            [
                'code' => '173411',
                'name' => "Kern Zetten"
            ],
            [
                'code' => '173412',
                'name' => "Buitengebied Zetten"
            ],
            [
                'code' => '173413',
                'name' => "Hemmen"
            ],
            [
                'code' => '173414',
                'name' => "Randwijk"
            ],
            [
                'code' => '173415',
                'name' => "Kern Heteren"
            ],
            [
                'code' => '173416',
                'name' => "Buitengebied Heteren"
            ],
            [
                'code' => '173417',
                'name' => "Valburg"
            ],
            [
                'code' => '173418',
                'name' => "Driel"
            ],
            [
                'code' => '173500',
                'name' => "Wijk 00 Goor"
            ],
            [
                'code' => '173501',
                'name' => "Wijk 01 De Whee II"
            ],
            [
                'code' => '173502',
                'name' => "Wijk 02 Markelo"
            ],
            [
                'code' => '173504',
                'name' => "Wijk 04 Elsen"
            ],
            [
                'code' => '173505',
                'name' => "Wijk 05 Diepenheim"
            ],
            [
                'code' => '173506',
                'name' => "Wijk 06 Delden"
            ],
            [
                'code' => '173507',
                'name' => "Wijk 07 Overig Delden"
            ],
            [
                'code' => '173508',
                'name' => "Wijk 08 Hengevelde"
            ],
            [
                'code' => '173509',
                'name' => "Wijk 09 Bentelo"
            ],
            [
                'code' => '174000',
                'name' => "Wijk 00 Kesteren"
            ],
            [
                'code' => '174001',
                'name' => "Wijk 01 Echteld"
            ],
            [
                'code' => '174002',
                'name' => "Wijk 02 Dodewaard"
            ],
            [
                'code' => '174200',
                'name' => "Wijk 00 Stad Rijssen"
            ],
            [
                'code' => '174201',
                'name' => "Wijk 01 Stadsrand"
            ],
            [
                'code' => '174202',
                'name' => "Wijk 02 Buitengebied Rijssen"
            ],
            [
                'code' => '174203',
                'name' => "Wijk 03 Holten"
            ],
            [
                'code' => '174204',
                'name' => "Wijk 04 Bedrijventerrein Holten"
            ],
            [
                'code' => '174205',
                'name' => "Wijk 05 Buitengebied Holten"
            ],
            [
                'code' => '177100',
                'name' => "Wijk 00 Geldrop"
            ],
            [
                'code' => '177101',
                'name' => "Wijk 01 Mierlo"
            ],
            [
                'code' => '177301',
                'name' => "Wijk 01 Olst"
            ],
            [
                'code' => '177302',
                'name' => "Wijk 02 Wijhe"
            ],
            [
                'code' => '177303',
                'name' => "Wijk 03 Wesepe"
            ],
            [
                'code' => '177304',
                'name' => "Wijk 04 Boskamp"
            ],
            [
                'code' => '177305',
                'name' => "Wijk 05 Boerhaar"
            ],
            [
                'code' => '177307',
                'name' => "Wijk 07 Den Nul"
            ],
            [
                'code' => '177410',
                'name' => "Wijk 10 Denekamp"
            ],
            [
                'code' => '177411',
                'name' => "Wijk 11 Lattrop-Breklenkamp"
            ],
            [
                'code' => '177412',
                'name' => "Wijk 12 Tilligte"
            ],
            [
                'code' => '177413',
                'name' => "Wijk 13 Agelo"
            ],
            [
                'code' => '177414',
                'name' => "Wijk 14 Noord Deurningen"
            ],
            [
                'code' => '177415',
                'name' => "Wijk 15 Ootmarsum"
            ],
            [
                'code' => '177416',
                'name' => "Wijk 16 Weerselo"
            ],
            [
                'code' => '177417',
                'name' => "Wijk 17 Rossum"
            ],
            [
                'code' => '177418',
                'name' => "Wijk 18 Saasveld"
            ],
            [
                'code' => '177419',
                'name' => "Wijk 19 Deurningen"
            ],
            [
                'code' => '178301',
                'name' => "Wijk 01 Naaldwijk"
            ],
            [
                'code' => '178302',
                'name' => "Wijk 02 Honselersdijk"
            ],
            [
                'code' => '178303',
                'name' => "Wijk 03 Maasdijk"
            ],
            [
                'code' => '178304',
                'name' => "Wijk 04 's-Gravenzande"
            ],
            [
                'code' => '178305',
                'name' => "Wijk 05 Monster"
            ],
            [
                'code' => '178306',
                'name' => "Wijk 06 Wateringen"
            ],
            [
                'code' => '178307',
                'name' => "Wijk 07 De Lier"
            ],
            [
                'code' => '178308',
                'name' => "Wijk 08 Kwintsheul"
            ],
            [
                'code' => '178309',
                'name' => "Wijk 09 Poeldijk"
            ],
            [
                'code' => '184200',
                'name' => "Wijk 00 Schipluiden"
            ],
            [
                'code' => '184201',
                'name' => "Wijk 01 Maasland"
            ],
            [
                'code' => '185900',
                'name' => "Wijk 00 Borculo"
            ],
            [
                'code' => '185901',
                'name' => "Wijk 01 Eibergen"
            ],
            [
                'code' => '185902',
                'name' => "Wijk 02 Beltrum"
            ],
            [
                'code' => '185903',
                'name' => "Wijk 03 Neede"
            ],
            [
                'code' => '185904',
                'name' => "Wijk 04 Ruurlo"
            ],
            [
                'code' => '187600',
                'name' => "Wijk 00 Hengelo"
            ],
            [
                'code' => '187601',
                'name' => "Wijk 01 Zelhem"
            ],
            [
                'code' => '187602',
                'name' => "Wijk 02 Vorden"
            ],
            [
                'code' => '187603',
                'name' => "Wijk 03 Steenderen"
            ],
            [
                'code' => '187604',
                'name' => "Wijk 04 Hummelo en Keppel"
            ],
            [
                'code' => '188300',
                'name' => "Wijk 00 Limbrichterveld"
            ],
            [
                'code' => '188301',
                'name' => "Wijk 01 Sittard"
            ],
            [
                'code' => '188302',
                'name' => "Wijk 02 Overhoven"
            ],
            [
                'code' => '188303',
                'name' => "Wijk 03 Munstergeleen"
            ],
            [
                'code' => '188304',
                'name' => "Wijk 04 Guttecoven"
            ],
            [
                'code' => '188305',
                'name' => "Wijk 05 Geleen"
            ],
            [
                'code' => '188306',
                'name' => "Wijk 06 Holtum-Born"
            ],
            [
                'code' => '188307',
                'name' => "Wijk 07 Obbicht en Papenhoven"
            ],
            [
                'code' => '188400',
                'name' => "Wijk 00 Roelofarendsveen"
            ],
            [
                'code' => '188401',
                'name' => "Wijk 01 Overig Alkemade"
            ],
            [
                'code' => '188402',
                'name' => "Wijk 02 Woubrugge"
            ],
            [
                'code' => '188403',
                'name' => "Wijk 03 Rijnsaterwoude"
            ],
            [
                'code' => '188404',
                'name' => "Wijk 04 Leimuiden"
            ],
            [
                'code' => '189100',
                'name' => "Wijk 00 Centrum"
            ],
            [
                'code' => '189101',
                'name' => "Wijk 01 Oost"
            ],
            [
                'code' => '189102',
                'name' => "Wijk 02 Zuid"
            ],
            [
                'code' => '189103',
                'name' => "Wijk 03 West"
            ],
            [
                'code' => '189201',
                'name' => "Moerkapelle wijk 01"
            ],
            [
                'code' => '189202',
                'name' => "Zevenhuizen wijk 02"
            ],
            [
                'code' => '189203',
                'name' => "Moordrecht wijk 03"
            ],
            [
                'code' => '189204',
                'name' => "Nieuwerkerk aan den IJssel wijk 04"
            ],
            [
                'code' => '189400',
                'name' => "Wijk 00 Grashoek-Koningslust"
            ],
            [
                'code' => '189401',
                'name' => "Wijk 01 Panningen"
            ],
            [
                'code' => '189402',
                'name' => "Wijk 02 Kessel"
            ],
            [
                'code' => '189403',
                'name' => "Wijk 03 Maasbree"
            ],
            [
                'code' => '189404',
                'name' => "Wijk 04 Baarlo"
            ],
            [
                'code' => '189405',
                'name' => "Wijk 05 Meijel"
            ],
            [
                'code' => '189500',
                'name' => "Wijk 00 Winschoten"
            ],
            [
                'code' => '189501',
                'name' => "Wijk 01 Finsterwolde"
            ],
            [
                'code' => '189502',
                'name' => "Wijk 02 Drieborg"
            ],
            [
                'code' => '189503',
                'name' => "Wijk 03 Beerta"
            ],
            [
                'code' => '189505',
                'name' => "Wijk 05 Nieuweschans"
            ],
            [
                'code' => '189506',
                'name' => "Wijk 06 Scheemda-Heiligerlee"
            ],
            [
                'code' => '189507',
                'name' => "Wijk 01 Westerlee"
            ],
            [
                'code' => '189508',
                'name' => "Wijk 02 Noord"
            ],
            [
                'code' => '189509',
                'name' => "Wijk 03 Midwolda"
            ],
            [
                'code' => '189510',
                'name' => "Wijk 04 Nieuwolda"
            ],
            [
                'code' => '189600',
                'name' => "Wijk 00 Genemuiden"
            ],
            [
                'code' => '189601',
                'name' => "Wijk 01 Kamperzeedijk"
            ],
            [
                'code' => '189602',
                'name' => "Wijk 02 Hasselt"
            ],
            [
                'code' => '189603',
                'name' => "Wijk 03 Landelijk gebied Hasselt"
            ],
            [
                'code' => '189604',
                'name' => "Wijk 04 Zwartsluis"
            ],
            [
                'code' => '190000',
                'name' => "Wijk 00 Bolsward"
            ],
            [
                'code' => '190001',
                'name' => "Wijk 01 Sneek"
            ],
            [
                'code' => '190002',
                'name' => "Wijk 02 Nijefurd"
            ],
            [
                'code' => '190003',
                'name' => "Wijk 03 Koudum"
            ],
            [
                'code' => '190004',
                'name' => "Wijk 04 Hemelum"
            ],
            [
                'code' => '190005',
                'name' => "Wijk 05 IJlst"
            ],
            [
                'code' => '190006',
                'name' => "Wijk 06 Zuid IJlst"
            ],
            [
                'code' => '190007',
                'name' => "Wijk 07 Oost IJlst"
            ],
            [
                'code' => '190008',
                'name' => "Wijk 08 West IJlst"
            ],
            [
                'code' => '190009',
                'name' => "Wijk 09 Oosthem"
            ],
            [
                'code' => '190010',
                'name' => "Wijk 10 Noordwest IJlst"
            ],
            [
                'code' => '190011',
                'name' => "Wijk 11 Zuidoost IJlst"
            ],
            [
                'code' => '190012',
                'name' => "Wijk 12 Woudsend"
            ],
            [
                'code' => '190013',
                'name' => "Wijk 13 Bouwhoek"
            ],
            [
                'code' => '190014',
                'name' => "Wijk 14 Weidestreek Oost"
            ],
            [
                'code' => '190015',
                'name' => "Wijk 15 Weidestreek West"
            ],
            [
                'code' => '190016',
                'name' => "Wijk 16 Weidestreek Zuid"
            ],
            [
                'code' => '190017',
                'name' => "Wijk 17 Makkum"
            ],
            [
                'code' => '190018',
                'name' => "Wijk 18 Weidestreek Zuidwest"
            ],
            [
                'code' => '190019',
                'name' => "Wijk 19 Boarnsterhim"
            ],
            [
                'code' => '190020',
                'name' => "Wijk 20 Littenseradiel"
            ],
            [
                'code' => '190099',
                'name' => "Groot water"
            ],
            [
                'code' => '190101',
                'name' => "Bodegraven-Noord"
            ],
            [
                'code' => '190102',
                'name' => "Bodegraven-Zuid"
            ],
            [
                'code' => '190103',
                'name' => "Nieuwerbrug aan den Rijn"
            ],
            [
                'code' => '190104',
                'name' => "Reeuwijk-Dorp"
            ],
            [
                'code' => '190105',
                'name' => "Reeuwijk-Brug"
            ],
            [
                'code' => '190106',
                'name' => "Driebruggen"
            ],
            [
                'code' => '190107',
                'name' => "Waarder"
            ],
            [
                'code' => '190300',
                'name' => "Wijk 00 Eijsden"
            ],
            [
                'code' => '190301',
                'name' => "Wijk 01 Gronsveld"
            ],
            [
                'code' => '190302',
                'name' => "Wijk 02 Margraten"
            ],
            [
                'code' => '190303',
                'name' => "Wijk 03 Cadier en Keer"
            ],
            [
                'code' => '190304',
                'name' => "Wijk 04 Sint Geertruid"
            ],
            [
                'code' => '190305',
                'name' => "Wijk 05 Mheer - Noorbeek"
            ],
            [
                'code' => '190401',
                'name' => "Wijk 01 Maarssen"
            ],
            [
                'code' => '190402',
                'name' => "Wijk 02 Breukelen"
            ],
            [
                'code' => '190403',
                'name' => "Wijk 03 Loenen aan de Vecht"
            ],
            [
                'code' => '190404',
                'name' => "Wijk 04 Nieuwer Ter Aa"
            ],
            [
                'code' => '190405',
                'name' => "Wijk 05 Kockengen"
            ],
            [
                'code' => '190406',
                'name' => "Wijk 06 Vreeland"
            ],
            [
                'code' => '190407',
                'name' => "Wijk 07 Tienhoven"
            ],
            [
                'code' => '190408',
                'name' => "Wijk 08 Nigtevecht"
            ],
            [
                'code' => '190409',
                'name' => "Wijk 09 Nieuwersluis"
            ],
            [
                'code' => '190410',
                'name' => "Wijk 10 Loenersloot"
            ],
            [
                'code' => '190412',
                'name' => "Wijk 12 Maarssenbroek"
            ],
            [
                'code' => '191101',
                'name' => "Anna Paulowna"
            ],
            [
                'code' => '191102',
                'name' => "Breezand"
            ],
            [
                'code' => '191103',
                'name' => "Wieringerwaard"
            ],
            [
                'code' => '191104',
                'name' => "Westerland"
            ],
            [
                'code' => '191105',
                'name' => "Hippolytushoef"
            ],
            [
                'code' => '191106',
                'name' => "Den Oever"
            ],
            [
                'code' => '191107',
                'name' => "Wieringerwerf"
            ],
            [
                'code' => '191109',
                'name' => "Slootdorp"
            ],
            [
                'code' => '191110',
                'name' => "Middenmeer"
            ],
            [
                'code' => '191111',
                'name' => "Kolhorn"
            ],
            [
                'code' => '191112',
                'name' => "Barsingerhorn"
            ],
            [
                'code' => '191113',
                'name' => "Haringhuizen"
            ],
            [
                'code' => '191114',
                'name' => "Lutjewinkel"
            ],
            [
                'code' => '191115',
                'name' => "Winkel"
            ],
            [
                'code' => '191116',
                'name' => "Nieuwe Niedorp"
            ],
            [
                'code' => '191117',
                'name' => "'t Veld"
            ],
            [
                'code' => '191118',
                'name' => "Zijdewind"
            ],
            [
                'code' => '191119',
                'name' => "Oude Niedorp"
            ],
            [
                'code' => '191199',
                'name' => "Groot water"
            ],
            [
                'code' => '191601',
                'name' => "De Zijde / Duivenvoorde / Park Veursehout"
            ],
            [
                'code' => '191602',
                'name' => "Prinsenhof"
            ],
            [
                'code' => '191603',
                'name' => "'t Lien / De Rietvink"
            ],
            [
                'code' => '191604',
                'name' => "Stompwijk"
            ],
            [
                'code' => '191605',
                'name' => "Leidschendam - Zuid en omgeving"
            ],
            [
                'code' => '191606',
                'name' => "De Heuvel / Amstelwijk"
            ],
            [
                'code' => '191607',
                'name' => "Damsigt en omgeving"
            ],
            [
                'code' => '191608',
                'name' => "Essesteijn"
            ],
            [
                'code' => '191609',
                'name' => "Voorburg Midden"
            ],
            [
                'code' => '191610',
                'name' => "Bovenveen"
            ],
            [
                'code' => '191611',
                'name' => "Voorburg Noord"
            ],
            [
                'code' => '191612',
                'name' => "Voorburg West / Park Leeuwenbergh"
            ],
            [
                'code' => '191613',
                'name' => "Voorburg Oud"
            ],
            [
                'code' => '192400',
                'name' => "Goedereede"
            ],
            [
                'code' => '192401',
                'name' => "Ouddorp"
            ],
            [
                'code' => '192402',
                'name' => "Stellendam"
            ],
            [
                'code' => '192403',
                'name' => "Middelharnis"
            ],
            [
                'code' => '192404',
                'name' => "Ooltgensplaat"
            ],
            [
                'code' => '192405',
                'name' => "Den Bommel"
            ],
            [
                'code' => '192406',
                'name' => "Oude-Tonge"
            ],
            [
                'code' => '192407',
                'name' => "Dirksland"
            ],
            [
                'code' => '192408',
                'name' => "Melissant"
            ],
            [
                'code' => '192409',
                'name' => "Herkingen"
            ],
            [
                'code' => '192410',
                'name' => "Sommelsdijk"
            ],
            [
                'code' => '192411',
                'name' => "Nieuwe-Tonge"
            ],
            [
                'code' => '192412',
                'name' => "Stad aan 't Haringvliet"
            ],
            [
                'code' => '192413',
                'name' => "Achthuizen"
            ],
            [
                'code' => '192499',
                'name' => "Groot water"
            ],
            [
                'code' => '192601',
                'name' => "Pijnacker"
            ],
            [
                'code' => '192602',
                'name' => "Nootdorp"
            ],
            [
                'code' => '192603',
                'name' => "Delfgauw"
            ],
            [
                'code' => '193001',
                'name' => "Centrum"
            ],
            [
                'code' => '193002',
                'name' => "Schiekamp"
            ],
            [
                'code' => '193003',
                'name' => "Hoogwerf"
            ],
            [
                'code' => '193005',
                'name' => "De Hoek"
            ],
            [
                'code' => '193006',
                'name' => "Gildenwijk"
            ],
            [
                'code' => '193007',
                'name' => "Groenewoud"
            ],
            [
                'code' => '193008',
                'name' => "Sterrenkwartier"
            ],
            [
                'code' => '193009',
                'name' => "Schenkel"
            ],
            [
                'code' => '193010',
                'name' => "De Elementen"
            ],
            [
                'code' => '193011',
                'name' => "Vogelenzang"
            ],
            [
                'code' => '193012',
                'name' => "De Akkers"
            ],
            [
                'code' => '193014',
                'name' => "Waterland"
            ],
            [
                'code' => '193015',
                'name' => "Maaswijk"
            ],
            [
                'code' => '193017',
                'name' => "Buitengebied"
            ],
            [
                'code' => '193025',
                'name' => "Heenvliet"
            ],
            [
                'code' => '193027',
                'name' => "Geervliet"
            ],
            [
                'code' => '193029',
                'name' => "Abbenbroek"
            ],
            [
                'code' => '193031',
                'name' => "Zuidland"
            ],
            [
                'code' => '193033',
                'name' => "Simonshaven"
            ],
            [
                'code' => '193050',
                'name' => "Hekelingen"
            ],
            [
                'code' => '193100',
                'name' => "Wijk 00 Lekkerkerk"
            ],
            [
                'code' => '193101',
                'name' => "Wijk 01 Krimpen aan de Lek"
            ],
            [
                'code' => '193102',
                'name' => "Wijk 02 Ouderkerk aan den IJssel"
            ],
            [
                'code' => '193104',
                'name' => "Wijk 04 Bergambacht"
            ],
            [
                'code' => '193105',
                'name' => "Wijk 05 Bergstoep"
            ],
            [
                'code' => '193107',
                'name' => "Wijk 07 Berkenwoude"
            ],
            [
                'code' => '193108',
                'name' => "Wijk 08 Haastrecht"
            ],
            [
                'code' => '193110',
                'name' => "Wijk 10 Stolwijk"
            ],
            [
                'code' => '193111',
                'name' => "Wijk 11 Vlist"
            ],
            [
                'code' => '193112',
                'name' => "Wijk 12 Schoonhoven"
            ],
            [
                'code' => '194007',
                'name' => "Wijk 07 Delfstrahuizen"
            ],
            [
                'code' => '194011',
                'name' => "Wijk 11 Echtenerbrug"
            ],
            [
                'code' => '194019',
                'name' => "Wijk 19 Joure"
            ],
            [
                'code' => '194023',
                'name' => "Wijk 23 Lemmer"
            ],
            [
                'code' => '194028',
                'name' => "Wijk 28 Oosterzee"
            ],
            [
                'code' => '194200',
                'name' => "Bussum Centrum"
            ],
            [
                'code' => '194201',
                'name' => "Brediuskwartier"
            ],
            [
                'code' => '194202',
                'name' => "Eng"
            ],
            [
                'code' => '194203',
                'name' => "Spiegel"
            ],
            [
                'code' => '194204',
                'name' => "Muiden"
            ],
            [
                'code' => '194205',
                'name' => "Naarden"
            ],
            [
                'code' => '194500',
                'name' => "Beek"
            ],
            [
                'code' => '194501',
                'name' => "Berg en Dal"
            ],
            [
                'code' => '194502',
                'name' => "Breedeweg"
            ],
            [
                'code' => '194503',
                'name' => "De Horst"
            ],
            [
                'code' => '194505',
                'name' => "Groesbeek"
            ],
            [
                'code' => '194506',
                'name' => "Heilig Landstichting"
            ],
            [
                'code' => '194507',
                'name' => "Kekerdom"
            ],
            [
                'code' => '194508',
                'name' => "Leuth"
            ],
            [
                'code' => '194509',
                'name' => "Millingen aan de Rijn"
            ],
            [
                'code' => '194510',
                'name' => "Ooij"
            ],
            [
                'code' => '194801',
                'name' => "Erp"
            ],
            [
                'code' => '194802',
                'name' => "Schijndel"
            ],
            [
                'code' => '194803',
                'name' => "Sint-Oedenrode"
            ],
            [
                'code' => '194804',
                'name' => "Veghel"
            ],
            [
                'code' => '194915',
                'name' => "Achlum"
            ],
            [
                'code' => '194916',
                'name' => "St.-Annaparochie"
            ],
            [
                'code' => '194918',
                'name' => "Berltsum"
            ],
            [
                'code' => '194919',
                'name' => "Bitgum"
            ],
            [
                'code' => '194920',
                'name' => "Bitgummole"
            ],
            [
                'code' => '194923',
                'name' => "Boksum"
            ],
            [
                'code' => '194924',
                'name' => "Deinum"
            ],
            [
                'code' => '194925',
                'name' => "Dongjum"
            ],
            [
                'code' => '194926',
                'name' => "Dronryp"
            ],
            [
                'code' => '194928',
                'name' => "Franeker"
            ],
            [
                'code' => '194931',
                'name' => "Ingelum"
            ],
            [
                'code' => '194932',
                'name' => "St.-Jacobiparochie"
            ],
            [
                'code' => '194934',
                'name' => "Marsum"
            ],
            [
                'code' => '194935',
                'name' => "Menaam"
            ],
            [
                'code' => '194936',
                'name' => "Minnertsga"
            ],
            [
                'code' => '194938',
                'name' => "Oosterbierum"
            ],
            [
                'code' => '194939',
                'name' => "Oudebildtzijl"
            ],
            [
                'code' => '194942',
                'name' => "Ried"
            ],
            [
                'code' => '194944',
                'name' => "Sexbierum"
            ],
            [
                'code' => '194947',
                'name' => "Spannum"
            ],
            [
                'code' => '194948',
                'name' => "Tzum"
            ],
            [
                'code' => '194949',
                'name' => "Tzummarum"
            ],
            [
                'code' => '194950',
                'name' => "Vrouwenparochie"
            ],
            [
                'code' => '194953',
                'name' => "Winsum"
            ],
            [
                'code' => '194954',
                'name' => "Wjelsryp"
            ],
            [
                'code' => '195000',
                'name' => "Wijk 00 Bellingwolde"
            ],
            [
                'code' => '195001',
                'name' => "Wijk 01 Oost"
            ],
            [
                'code' => '195002',
                'name' => "Wijk 02 Blijham"
            ],
            [
                'code' => '195003',
                'name' => "Wijk 03 Sellingen"
            ],
            [
                'code' => '195004',
                'name' => "Wijk 04 Vlagtwedde"
            ],
            [
                'code' => '195005',
                'name' => "Wijk 05 Bourtange"
            ],
            [
                'code' => '195006',
                'name' => "Wijk 06 Sellingerbeetse"
            ],
            [
                'code' => '195007',
                'name' => "Wijk 07 Ter Apel"
            ],
            [
                'code' => '195008',
                'name' => "Wijk 08 Ter Wisch"
            ],
            [
                'code' => '195009',
                'name' => "Wijk 09 de Maten"
            ],
            [
                'code' => '195201',
                'name' => "Foxham en Hoogezand-Noord"
            ],
            [
                'code' => '195202',
                'name' => "Hoogezand-Zuid"
            ],
            [
                'code' => '195203',
                'name' => "Kalkwijk"
            ],
            [
                'code' => '195204',
                'name' => "Sappemeer"
            ],
            [
                'code' => '195205',
                'name' => "Kiel-Windeweer"
            ],
            [
                'code' => '195206',
                'name' => "Kropswolde"
            ],
            [
                'code' => '195207',
                'name' => "Foxhol"
            ],
            [
                'code' => '195208',
                'name' => "Westerbroek en Waterhuizen"
            ],
            [
                'code' => '195209',
                'name' => "Harkstede, Scharmer en Woudbloem"
            ],
            [
                'code' => '195210',
                'name' => "Kolham"
            ],
            [
                'code' => '195211',
                'name' => "Froombosch"
            ],
            [
                'code' => '195212',
                'name' => "Slochteren"
            ],
            [
                'code' => '195213',
                'name' => "Schildwolde"
            ],
            [
                'code' => '195214',
                'name' => "Hellum"
            ],
            [
                'code' => '195215',
                'name' => "Siddeburen"
            ],
            [
                'code' => '195216',
                'name' => "Eemskanaal-Zuid"
            ],
            [
                'code' => '195217',
                'name' => "Tjuchem en Steendam"
            ],
            [
                'code' => '195218',
                'name' => "Muntendam"
            ],
            [
                'code' => '195219',
                'name' => "Noordbroek"
            ],
            [
                'code' => '195220',
                'name' => "Zuidbroek"
            ],
            [
                'code' => '195221',
                'name' => "Meeden"
            ],
            [
                'code' => '195400',
                'name' => "Wijk 00 Onderbanken"
            ],
            [
                'code' => '195401',
                'name' => "Wijk 01 Nuth"
            ],
            [
                'code' => '195402',
                'name' => "Wijk 02 Wijnandsrade"
            ],
            [
                'code' => '195403',
                'name' => "Wijk 03 Hulsberg"
            ],
            [
                'code' => '195404',
                'name' => "Wijk 04 Schimmert"
            ],
            [
                'code' => '195405',
                'name' => "Wijk 05"
            ],
            [
                'code' => '195406',
                'name' => "Wijk 06 Amstenrade - Oirsbeek"
            ],
            [
                'code' => '195500',
                'name' => "Wijk 00 's-Heerenberg"
            ],
            [
                'code' => '195501',
                'name' => "Wijk 01 Brakel"
            ],
            [
                'code' => '195502',
                'name' => "Wijk 02 Didam"
            ],
            [
                'code' => '195901',
                'name' => "Werkendam"
            ],
            [
                'code' => '195902',
                'name' => "Sleeuwijk"
            ],
            [
                'code' => '195903',
                'name' => "Nieuwendijk"
            ],
            [
                'code' => '195904',
                'name' => "Hank"
            ],
            [
                'code' => '195905',
                'name' => "Dussen"
            ],
            [
                'code' => '195906',
                'name' => "Woudrichem"
            ],
            [
                'code' => '195907',
                'name' => "Rijswijk (NB)"
            ],
            [
                'code' => '195908',
                'name' => "Uitwijk"
            ],
            [
                'code' => '195909',
                'name' => "Waardhuizen"
            ],
            [
                'code' => '195910',
                'name' => "Giessen"
            ],
            [
                'code' => '195911',
                'name' => "Andel"
            ],
            [
                'code' => '195912',
                'name' => "Almkerk"
            ],
            [
                'code' => '195913',
                'name' => "Veen"
            ],
            [
                'code' => '195914',
                'name' => "Wijk en Aalburg"
            ],
            [
                'code' => '195915',
                'name' => "Babyloniënbroek"
            ],
            [
                'code' => '195916',
                'name' => "Meeuwen"
            ],
            [
                'code' => '195917',
                'name' => "Eethen"
            ],
            [
                'code' => '195918',
                'name' => "Drongelen"
            ],
            [
                'code' => '195919',
                'name' => "Genderen"
            ],
            [
                'code' => '196000',
                'name' => "Geldermalsen"
            ],
            [
                'code' => '196001',
                'name' => "Deil"
            ],
            [
                'code' => '196002',
                'name' => "Beesd"
            ],
            [
                'code' => '196003',
                'name' => "Buurmalsen"
            ],
            [
                'code' => '196004',
                'name' => "Meteren"
            ],
            [
                'code' => '196005',
                'name' => "Haaften"
            ],
            [
                'code' => '196006',
                'name' => "Waardenburg en Opijnen"
            ],
            [
                'code' => '196007',
                'name' => "Varik en Ophemert"
            ],
            [
                'code' => '196008',
                'name' => "Asperen"
            ],
            [
                'code' => '196009',
                'name' => "Heukelum"
            ],
            [
                'code' => '196010',
                'name' => "Vuren"
            ],
            [
                'code' => '196011',
                'name' => "Herwijnen"
            ],
            [
                'code' => '196102',
                'name' => "Tienhoven aan de Lek buitengebied"
            ],
            [
                'code' => '196103',
                'name' => "Ameide"
            ],
            [
                'code' => '196104',
                'name' => "Ameide buitengebied"
            ],
            [
                'code' => '196105',
                'name' => "Meerkerk"
            ],
            [
                'code' => '196106',
                'name' => "Meerkerk buitengebied"
            ],
            [
                'code' => '196108',
                'name' => "Lexmond buitengebied"
            ],
            [
                'code' => '196110',
                'name' => "Nieuwland buitengebied"
            ],
            [
                'code' => '196112',
                'name' => "Leerbroek buitengebied"
            ],
            [
                'code' => '196119',
                'name' => "Monnikenhof"
            ],
            [
                'code' => '196120',
                'name' => "Vianen bedrijventerrein"
            ],
            [
                'code' => '196121',
                'name' => "Vianen centrum"
            ],
            [
                'code' => '196122',
                'name' => "De Hagen"
            ],
            [
                'code' => '196123',
                'name' => "Vianen buitengebied"
            ],
            [
                'code' => '196124',
                'name' => "Leerdam-West"
            ],
            [
                'code' => '196125',
                'name' => "Leerdam-Noord"
            ],
            [
                'code' => '196126',
                'name' => "Leerdam centrum"
            ],
            [
                'code' => '196127',
                'name' => "Leerdam-Oost"
            ],
            [
                'code' => '196135',
                'name' => "Hagestein buitengebied"
            ],
            [
                'code' => '196136',
                'name' => "Hoef en Haag"
            ],
            [
                'code' => '196300',
                'name' => "Oud-Beijerland"
            ],
            [
                'code' => '196301',
                'name' => "Heinenoord"
            ],
            [
                'code' => '196302',
                'name' => "Mijnsheerenland"
            ],
            [
                'code' => '196303',
                'name' => "Westmaas"
            ],
            [
                'code' => '196304',
                'name' => "Puttershoek"
            ],
            [
                'code' => '196305',
                'name' => "Maasdam"
            ],
            [
                'code' => '196306',
                'name' => "'s-Gravendeel"
            ],
            [
                'code' => '196307',
                'name' => "Strijen"
            ],
            [
                'code' => '196308',
                'name' => "Klaaswaal"
            ],
            [
                'code' => '196309',
                'name' => "Numansdorp"
            ],
            [
                'code' => '196310',
                'name' => "Zuid-Beijerland"
            ],
            [
                'code' => '196311',
                'name' => "Goudswaard"
            ],
            [
                'code' => '196312',
                'name' => "Piershil"
            ],
            [
                'code' => '196313',
                'name' => "Nieuw-Beijerland"
            ],
            [
                'code' => '196600',
                'name' => "Wijk 00"
            ],
            [
                'code' => '196601',
                'name' => "Wijk 01"
            ],
            [
                'code' => '196602',
                'name' => "Wijk 02"
            ],
            [
                'code' => '196603',
                'name' => "Wijk 03"
            ],
            [
                'code' => '196604',
                'name' => "Wijk 04"
            ],
            [
                'code' => '196605',
                'name' => "Wijk 05"
            ],
            [
                'code' => '196606',
                'name' => "Wijk 06"
            ],
            [
                'code' => '196607',
                'name' => "Wijk 07"
            ],
            [
                'code' => '196608',
                'name' => "Wijk 08"
            ],
            [
                'code' => '196609',
                'name' => "Wijk 09"
            ],
            [
                'code' => '196610',
                'name' => "Wijk 10"
            ],
            [
                'code' => '196611',
                'name' => "Wijk 11"
            ],
            [
                'code' => '196612',
                'name' => "Wijk 12"
            ],
            [
                'code' => '196699',
                'name' => "Groot water"
            ],
            [
                'code' => '196900',
                'name' => "Wijk 00 Grootegast"
            ],
            [
                'code' => '196901',
                'name' => "Wijk 01 Lutjegast"
            ],
            [
                'code' => '196902',
                'name' => "Wijk 02 Opende"
            ],
            [
                'code' => '196903',
                'name' => "Wijk 03 Oldekerk"
            ],
            [
                'code' => '196904',
                'name' => "Wijk 04 Leek"
            ],
            [
                'code' => '196905',
                'name' => "Wijk 05 Zevenhuizen"
            ],
            [
                'code' => '196906',
                'name' => "Wijk 06 Tolbert"
            ],
            [
                'code' => '196907',
                'name' => "Wijk 07 Midwolde"
            ],
            [
                'code' => '196908',
                'name' => "Wijk 08 Lettelbert"
            ],
            [
                'code' => '196909',
                'name' => "Wijk 09 Oostwold"
            ],
            [
                'code' => '196910',
                'name' => "Wijk 10 Enumatil"
            ],
            [
                'code' => '196911',
                'name' => "Wijk 11 Marum"
            ],
            [
                'code' => '196912',
                'name' => "Wijk 12 De Wilp"
            ],
            [
                'code' => '196913',
                'name' => "Wijk 13"
            ],
            [
                'code' => '196914',
                'name' => "Wijk 14"
            ],
            [
                'code' => '196915',
                'name' => "Wijk 15"
            ],
            [
                'code' => '196916',
                'name' => "Wijk 16"
            ],
            [
                'code' => '196917',
                'name' => "Wijk 17"
            ],
            [
                'code' => '197000',
                'name' => "Dokkum"
            ],
            [
                'code' => '197001',
                'name' => "Metslawier"
            ],
            [
                'code' => '197002',
                'name' => "Ee - Zuidoost"
            ],
            [
                'code' => '197003',
                'name' => "Anjum - Noordoost"
            ],
            [
                'code' => '197004',
                'name' => "Oosternijkerk - Noordwest"
            ],
            [
                'code' => '197005',
                'name' => "Ternaard"
            ],
            [
                'code' => '197006',
                'name' => "Holwerd"
            ],
            [
                'code' => '197007',
                'name' => "Hantum"
            ],
            [
                'code' => '197008',
                'name' => "Wijk 08 Bouwstreek"
            ],
            [
                'code' => '197009',
                'name' => "Wijk 09 Zuidwest"
            ],
            [
                'code' => '197010',
                'name' => "Wijk 10"
            ],
            [
                'code' => '197011',
                'name' => "Wijk 11 Kollum"
            ],
            [
                'code' => '197012',
                'name' => "Wijk 12 Oost"
            ],
            [
                'code' => '197013',
                'name' => "Wijk 13 Noordwest"
            ],
            [
                'code' => '197014',
                'name' => "Wijk 14 Zuidwest"
            ],
            [
                'code' => '197099',
                'name' => "Groot water"
            ],
            [
                'code' => '197801',
                'name' => "Wijk01-Arkel"
            ],
            [
                'code' => '197802',
                'name' => "Wijk02-Bleskensgraaf ca"
            ],
            [
                'code' => '197803',
                'name' => "Wijk03-Brandwijk"
            ],
            [
                'code' => '197804',
                'name' => "Wijk04-Giessenburg"
            ],
            [
                'code' => '197805',
                'name' => "Wijk05-Goudriaan"
            ],
            [
                'code' => '197806',
                'name' => "Wijk06-Groot-Ammers"
            ],
            [
                'code' => '197807',
                'name' => "Wijk07-Hoogblokland"
            ],
            [
                'code' => '197808',
                'name' => "Wijk08-Hoornaar"
            ],
            [
                'code' => '197809',
                'name' => "Wijk09-Kinderdijk"
            ],
            [
                'code' => '197810',
                'name' => "Wijk10-Langerak"
            ],
            [
                'code' => '197811',
                'name' => "Wijk11-Molenaarsgraaf"
            ],
            [
                'code' => '197812',
                'name' => "Wijk12-Nieuw-Lekkerland"
            ],
            [
                'code' => '197813',
                'name' => "Wijk13-Nieuwpoort"
            ],
            [
                'code' => '197814',
                'name' => "Wijk14-Noordeloos"
            ],
            [
                'code' => '197815',
                'name' => "Wijk15-Ottoland"
            ],
            [
                'code' => '197816',
                'name' => "Wijk16-Oud-Alblas"
            ],
            [
                'code' => '197817',
                'name' => "Wijk17-Schelluinen"
            ],
            [
                'code' => '197818',
                'name' => "Wijk18-Streefkerk"
            ],
            [
                'code' => '197820',
                'name' => "Wijk20-Wijngaarden"
            ],
            [
                'code' => '197902',
                'name' => "West"
            ],
            [
                'code' => '197903',
                'name' => "Farmsum"
            ],
            [
                'code' => '197904',
                'name' => "Tuikwerd"
            ],
            [
                'code' => '197905',
                'name' => "Fivelzigt"
            ],
            [
                'code' => '197906',
                'name' => "Noord"
            ],
            [
                'code' => '197907',
                'name' => "Buitengebied Noord-Bierum"
            ],
            [
                'code' => '197908',
                'name' => "Oosterhorn"
            ],
            [
                'code' => '197909',
                'name' => "Buitengebied Zuid-Termunten"
            ],
            [
                'code' => '197910',
                'name' => "Tussengebied"
            ],
            [
                'code' => '197911',
                'name' => "Appingedam-Centrum"
            ],
            [
                'code' => '197912',
                'name' => "Appingedam-Oost"
            ],
            [
                'code' => '197913',
                'name' => "Appingedam-West"
            ],
            [
                'code' => '197914',
                'name' => "Buitengebied Noord-Appingedam"
            ],
            [
                'code' => '197915',
                'name' => "Buitengebied Zuid-Appingedam"
            ],
            [
                'code' => '197916',
                'name' => "Buitengebied Noord-Loppersum"
            ],
            [
                'code' => '197917',
                'name' => "Buitengebied Noord-Stedum"
            ],
            [
                'code' => '197918',
                'name' => "Buitengebied Noord-Middelstum"
            ],
            [
                'code' => '197919',
                'name' => "Buitengebied Noord-'t Zandt"
            ],
            [
                'code' => '3406',
                'name' => "Wijk 06 Almere Pampus"
            ],
            [
                'code' => '3499',
                'name' => "Groot water"
            ],
            [
                'code' => '5099',
                'name' => "Groot water"
            ],
            [
                'code' => '6099',
                'name' => "Groot water"
            ],
            [
                'code' => '7299',
                'name' => "Groot water"
            ],
            [
                'code' => '7406',
                'name' => "Wijk 06 Oranjewoud"
            ],
            [
                'code' => '8071',
                'name' => "Goutum"
            ],
            [
                'code' => '8899',
                'name' => "Groot water"
            ],
            [
                'code' => '9399',
                'name' => "Groot water"
            ],
            [
                'code' => '9699',
                'name' => "Groot water"
            ],
            [
                'code' => '9812',
                'name' => "Zandhuizen"
            ],
            [
                'code' => '10913',
                'name' => "Wijk 13 Weijerswold"
            ],
            [
                'code' => '10914',
                'name' => "Wijk 14 Vlieghuis en Padhuis"
            ],
            [
                'code' => '11440',
                'name' => "Wijk 40 Emmen-Centrum"
            ],
            [
                'code' => '11442',
                'name' => "Wijk 42 Emmermeer"
            ],
            [
                'code' => '11443',
                'name' => "Wijk 43 Angelslo"
            ],
            [
                'code' => '11444',
                'name' => "Wijk 44 Emmerhout"
            ],
            [
                'code' => '11445',
                'name' => "Wijk 45 Emmerschans"
            ],
            [
                'code' => '11446',
                'name' => "Wijk 46 Bargeres"
            ],
            [
                'code' => '11447',
                'name' => "Wijk 47 Rietlanden"
            ],
            [
                'code' => '11448',
                'name' => "Wijk 48 Parc Sandur"
            ],
            [
                'code' => '11449',
                'name' => "Wijk 49 Delftlanden"
            ],
            [
                'code' => '11450',
                'name' => "Wijk 50 Barger-Oosterveld"
            ],
            [
                'code' => '11861',
                'name' => "Wijk 61 Zuideropgaande Nieuw Moscou"
            ],
            [
                'code' => '11908',
                'name' => "Blankenstein"
            ],
            [
                'code' => '15002',
                'name' => "Wijk 2 De Hoven"
            ],
            [
                'code' => '15013',
                'name' => "Wijk 13 Okkenbroek"
            ],
            [
                'code' => '15804',
                'name' => "Wijk 04 Rietmolen"
            ],
            [
                'code' => '15805',
                'name' => "Wijk 05 Hengevelde"
            ],
            [
                'code' => '15806',
                'name' => "Wijk 06 Beckum"
            ],
            [
                'code' => '15809',
                'name' => "Wijk 09 Haaksbergen-kern"
            ],
            [
                'code' => '16002',
                'name' => "Anerveen"
            ],
            [
                'code' => '16003',
                'name' => "Anevelde"
            ],
            [
                'code' => '16006',
                'name' => "Brucht"
            ],
            [
                'code' => '16007',
                'name' => "Collendoorn"
            ],
            [
                'code' => '16010',
                'name' => "Den Velde"
            ],
            [
                'code' => '16011',
                'name' => "Diffelen"
            ],
            [
                'code' => '16013',
                'name' => "Heemserveen"
            ],
            [
                'code' => '16014',
                'name' => "Holtheme"
            ],
            [
                'code' => '16015',
                'name' => "Holthone"
            ],
            [
                'code' => '16016',
                'name' => "Hoogenweg"
            ],
            [
                'code' => '16018',
                'name' => "Loozen"
            ],
            [
                'code' => '16021',
                'name' => "Radewijk"
            ],
            [
                'code' => '16022',
                'name' => "Rheeze"
            ],
            [
                'code' => '16023',
                'name' => "Rheezerveen"
            ],
            [
                'code' => '16027',
                'name' => "Venebrugge"
            ],
            [
                'code' => '16307',
                'name' => "Wijk 07 Haarle"
            ],
            [
                'code' => '16308',
                'name' => "Wijk 08 Daarle"
            ],
            [
                'code' => '16309',
                'name' => "Wijk 09 Daarlerveen"
            ],
            [
                'code' => '16606',
                'name' => "Wijk 06 Grafhorst"
            ],
            [
                'code' => '16607',
                'name' => "Wijk 07 Kamperveen"
            ],
            [
                'code' => '16608',
                'name' => "Wijk 08 's-Heerenbroek"
            ],
            [
                'code' => '16609',
                'name' => "Wijk 09 Verspreide huizen"
            ],
            [
                'code' => '16699',
                'name' => "Groot water"
            ],
            [
                'code' => '17112',
                'name' => "Wijk 12 Schokland"
            ],
            [
                'code' => '17199',
                'name' => "Groot water"
            ],
            [
                'code' => '17301',
                'name' => "Wijk 01 Binnenstad"
            ],
            [
                'code' => '17302',
                'name' => "Wijk 02 Het Inslag-De Kleies"
            ],
            [
                'code' => '17303',
                'name' => "Wijk 03 Glinde-Hooiland"
            ],
            [
                'code' => '17304',
                'name' => "Wijk 04 De Meijbree"
            ],
            [
                'code' => '17305',
                'name' => "Wijk 05 Haerbroek-Scholtenhoek"
            ],
            [
                'code' => '17306',
                'name' => "Wijk 06 Zuid-Berghuizen"
            ],
            [
                'code' => '17307',
                'name' => "Wijk 07 Hanzepoort"
            ],
            [
                'code' => '17308',
                'name' => "Wijk 08 Eekte-Hazewinkel"
            ],
            [
                'code' => '17309',
                'name' => "Wijk 09 Jufferbeek"
            ],
            [
                'code' => '17310',
                'name' => "Wijk 10 Het Hulsbeek"
            ],
            [
                'code' => '17311',
                'name' => "Wijk 11 De Thij"
            ],
            [
                'code' => '17312',
                'name' => "Wijk 12 De Graven Es"
            ],
            [
                'code' => '17313',
                'name' => "Wijk 13 De Essen"
            ],
            [
                'code' => '17314',
                'name' => "Wijk 14 Bekspring"
            ],
            [
                'code' => '17503',
                'name' => "Beerze"
            ],
            [
                'code' => '17505',
                'name' => "Dalmsholte"
            ],
            [
                'code' => '17506',
                'name' => "Giethmen"
            ],
            [
                'code' => '18005',
                'name' => "Wijk 05 Punthorst"
            ],
            [
                'code' => '18006',
                'name' => "Wijk 06 Lankhorst"
            ],
            [
                'code' => '18007',
                'name' => "Wijk 07 Klooster"
            ],
            [
                'code' => '18499',
                'name' => "Groot water"
            ],
            [
                'code' => '20210',
                'name' => "Geitenkamp"
            ],
            [
                'code' => '20220',
                'name' => "Elden"
            ],
            [
                'code' => '20363',
                'name' => "Wijk 63 Achterveld"
            ],
            [
                'code' => '21302',
                'name' => "Wijk 02 Tonden"
            ],
            [
                'code' => '22601',
                'name' => "Wijk 01 Bedrijventerrein"
            ],
            [
                'code' => '22602',
                'name' => "Wijk 02 Buitengebied"
            ],
            [
                'code' => '22605',
                'name' => "Wijk 05 Groessen"
            ],
            [
                'code' => '22606',
                'name' => "Wijk 06 Loo"
            ],
            [
                'code' => '22805',
                'name' => "Veluwse Poort"
            ],
            [
                'code' => '23099',
                'name' => "Groot water"
            ],
            [
                'code' => '23399',
                'name' => "Groot water"
            ],
            [
                'code' => '24316',
                'name' => "Wijk 16 Wolderwijd"
            ],
            [
                'code' => '24399',
                'name' => "Groot water"
            ],
            [
                'code' => '26799',
                'name' => "Groot water"
            ],
            [
                'code' => '26999',
                'name' => "Groot water"
            ],
            [
                'code' => '27399',
                'name' => "Groot water"
            ],
            [
                'code' => '28911',
                'name' => "Wageningen-Hoog"
            ],
            [
                'code' => '29904',
                'name' => "Lathum"
            ],
            [
                'code' => '29905',
                'name' => "Rijnstrangen"
            ],
            [
                'code' => '29909',
                'name' => "Lobith"
            ],
            [
                'code' => '30299',
                'name' => "Groot water"
            ],
            [
                'code' => '30399',
                'name' => "Groot water"
            ],
            [
                'code' => '30722',
                'name' => "Calveen"
            ],
            [
                'code' => '30732',
                'name' => "Vathorst-Bovenduist"
            ],
            [
                'code' => '31005',
                'name' => "De Leijen"
            ],
            [
                'code' => '31399',
                'name' => "Groot water"
            ],
            [
                'code' => '31799',
                'name' => "Groot water"
            ],
            [
                'code' => '32131',
                'name' => "'t Goy Buitengebied"
            ],
            [
                'code' => '32141',
                'name' => "Tull en 't Waal Buitengebied"
            ],
            [
                'code' => '32704',
                'name' => "Wijk 04 Stoutenburg"
            ],
            [
                'code' => '34000',
                'name' => "Wijk 00 Rhenen"
            ],
            [
                'code' => '34004',
                'name' => "Wijk 04 Grebbeberg"
            ],
            [
                'code' => '34006',
                'name' => "Wijk 06 Binnenveld"
            ],
            [
                'code' => '34008',
                'name' => "Wijk 08 Uiterwaarden Rhenen"
            ],
            [
                'code' => '34009',
                'name' => "Wijk 09 Remmerden"
            ],
            [
                'code' => '34010',
                'name' => "Wijk 10 Heuvelrug Rhenen"
            ],
            [
                'code' => '34011',
                'name' => "Wijk 11 Heuvelrug Elst"
            ],
            [
                'code' => '34012',
                'name' => "Wijk 12 Uiterwaarden Elst"
            ],
            [
                'code' => '34202',
                'name' => "Wijk 02 Klaarwater"
            ],
            [
                'code' => '34205',
                'name' => "Wijk 05 Smitsveen"
            ],
            [
                'code' => '35606',
                'name' => "Huis de Geer"
            ],
            [
                'code' => '35607',
                'name' => "Blokhoeve"
            ],
            [
                'code' => '35612',
                'name' => "Lekboulevard"
            ],
            [
                'code' => '35614',
                'name' => "Merwestein"
            ],
            [
                'code' => '35615',
                'name' => "Park Oudegein"
            ],
            [
                'code' => '35616',
                'name' => "Zandveld"
            ],
            [
                'code' => '35618',
                'name' => "Het Klooster"
            ],
            [
                'code' => '35621',
                'name' => "Plettenburg"
            ],
            [
                'code' => '35622',
                'name' => "De Wiers"
            ],
            [
                'code' => '35623',
                'name' => "Hoge Landen"
            ],
            [
                'code' => '35624',
                'name' => "Stadscentrum"
            ],
            [
                'code' => '35625',
                'name' => "Rijnhuizen"
            ],
            [
                'code' => '35801',
                'name' => "Wijk 01 Kudelstraat en Kalslagen"
            ],
            [
                'code' => '36204',
                'name' => "Stadshart"
            ],
            [
                'code' => '36317',
                'name' => "Da Costabuurt"
            ],
            [
                'code' => '36363',
                'name' => "Tuindorp Buiksloot"
            ],
            [
                'code' => '37302',
                'name' => "Wijk 02 Bergen aan Zee"
            ],
            [
                'code' => '37303',
                'name' => "Wijk 03 Buitengebied Bergen"
            ],
            [
                'code' => '37399',
                'name' => "Groot water"
            ],
            [
                'code' => '37599',
                'name' => "Groot water"
            ],
            [
                'code' => '37699',
                'name' => "Groot water"
            ],
            [
                'code' => '37799',
                'name' => "Groot water"
            ],
            [
                'code' => '38306',
                'name' => "Wijk 06 De Woude"
            ],
            [
                'code' => '38399',
                'name' => "Groot water"
            ],
            [
                'code' => '38404',
                'name' => "Bergwijkpark"
            ],
            [
                'code' => '38499',
                'name' => "Groot water"
            ],
            [
                'code' => '38501',
                'name' => "Wijk 01 Purmer"
            ],
            [
                'code' => '38503',
                'name' => "Wijk 03 Beets"
            ],
            [
                'code' => '38505',
                'name' => "Wijk 05 Warder"
            ],
            [
                'code' => '38506',
                'name' => "Wijk 06 Middelie"
            ],
            [
                'code' => '38507',
                'name' => "Wijk 07 Kwadijk"
            ],
            [
                'code' => '38508',
                'name' => "Wijk 08 Schardam"
            ],
            [
                'code' => '38509',
                'name' => "Wijk 09 Hobrede"
            ],
            [
                'code' => '38599',
                'name' => "Groot water"
            ],
            [
                'code' => '38802',
                'name' => "Enkhuizen Buitengebied"
            ],
            [
                'code' => '38899',
                'name' => "Groot water"
            ],
            [
                'code' => '39416',
                'name' => "Schiphol"
            ],
            [
                'code' => '39611',
                'name' => "Wijk 11 Oostelijk Heemskerk"
            ],
            [
                'code' => '39699',
                'name' => "Groot water"
            ],
            [
                'code' => '39702',
                'name' => "Wijk 02 Heemstede west van de spoorbaan"
            ],
            [
                'code' => '39801',
                'name' => "Wijk 01 Schrijverswijk"
            ],
            [
                'code' => '39804',
                'name' => "Wijk 04 Planetenwijk"
            ],
            [
                'code' => '39808',
                'name' => "Wijk 08 Edelstenenwijk"
            ],
            [
                'code' => '39810',
                'name' => "Wijk 10 Molenwijk"
            ],
            [
                'code' => '39811',
                'name' => "Wijk 11 Rivierenwijk"
            ],
            [
                'code' => '39814',
                'name' => "Wijk 14 Oostertocht"
            ],
            [
                'code' => '39819',
                'name' => "Wijk 19 Broekhorn"
            ],
            [
                'code' => '39820',
                'name' => "Wijk 20 De Noord"
            ],
            [
                'code' => '39830',
                'name' => "Wijk 30 Buitengebied Noord"
            ],
            [
                'code' => '39840',
                'name' => "Wijk 40 't Kruis"
            ],
            [
                'code' => '39850',
                'name' => "Wijk 50 Buitengebied Zuid"
            ],
            [
                'code' => '39901',
                'name' => "Wijk 01 Blockhovepark"
            ],
            [
                'code' => '39907',
                'name' => "Wijk 07 Heiloo-Oost"
            ],
            [
                'code' => '40099',
                'name' => "Groot water"
            ],
            [
                'code' => '40208',
                'name' => "Hilversumse Meent"
            ],
            [
                'code' => '40536',
                'name' => "Wijk 36 Noord"
            ],
            [
                'code' => '40599',
                'name' => "Groot water"
            ],
            [
                'code' => '40601',
                'name' => "Wijk 01 Westereng"
            ],
            [
                'code' => '40607',
                'name' => "Wijk 07 Stad en Lande"
            ],
            [
                'code' => '40609',
                'name' => "Wijk 09 Huizermaat Noord"
            ],
            [
                'code' => '40699',
                'name' => "Groot water"
            ],
            [
                'code' => '42004',
                'name' => "Lambertschaag"
            ],
            [
                'code' => '42013',
                'name' => "Hauwert"
            ],
            [
                'code' => '42099',
                'name' => "Groot water"
            ],
            [
                'code' => '43202',
                'name' => "Wijk 02"
            ],
            [
                'code' => '44199',
                'name' => "Groot water"
            ],
            [
                'code' => '44899',
                'name' => "Groot water"
            ],
            [
                'code' => '45115',
                'name' => "Wijk 15 Dorpscentrum"
            ],
            [
                'code' => '45125',
                'name' => "Wijk 25 Thamerdal"
            ],
            [
                'code' => '45135',
                'name' => "Wijk 35 Zijdelwaard"
            ],
            [
                'code' => '45145',
                'name' => "Wijk 45 Legmeer"
            ],
            [
                'code' => '45150',
                'name' => "Wijk 50 Langs de Vuurlinie"
            ],
            [
                'code' => '45155',
                'name' => "Wijk 55 Veilinggebied"
            ],
            [
                'code' => '45165',
                'name' => "Wijk 65 Meerwijk"
            ],
            [
                'code' => '45175',
                'name' => "Wijk 75 Bedrijventerrein"
            ],
            [
                'code' => '45185',
                'name' => "Wijk 85 Meerwijk"
            ],
            [
                'code' => '45190',
                'name' => "Wijk 90 Glastuinbouwgebied"
            ],
            [
                'code' => '45195',
                'name' => "Wijk 95 Veenweidegebied"
            ],
            [
                'code' => '45399',
                'name' => "Groot water"
            ],
            [
                'code' => '45707',
                'name' => "Aetsveldsepolder"
            ],
            [
                'code' => '45708',
                'name' => "Oostelijke Vechtoever"
            ],
            [
                'code' => '47399',
                'name' => "Groot water"
            ],
            [
                'code' => '47912',
                'name' => "Wijk 12 Poelenburg"
            ],
            [
                'code' => '47914',
                'name' => "Wijk 14 Rosmolenwijk"
            ],
            [
                'code' => '47931',
                'name' => "Wijk 31 Oud Koog a/d Zaan"
            ],
            [
                'code' => '47932',
                'name' => "Wijk 32 Westerkoog"
            ],
            [
                'code' => '47941',
                'name' => "Wijk 41 Oud Zaandijk"
            ],
            [
                'code' => '48409',
                'name' => "Rietveld"
            ],
            [
                'code' => '48903',
                'name' => "Wijk 03 Binnenland"
            ],
            [
                'code' => '48906',
                'name' => "Wijk 06 Ter Leede"
            ],
            [
                'code' => '48907',
                'name' => "Wijk 07 Paddewei"
            ],
            [
                'code' => '48910',
                'name' => "Wijk 10 Dorpzicht"
            ],
            [
                'code' => '48911',
                'name' => "Wijk 11 Bijdorp"
            ],
            [
                'code' => '48913',
                'name' => "Wijk 13 Voordijk"
            ],
            [
                'code' => '48915',
                'name' => "Wijk 15 Waterkant"
            ],
            [
                'code' => '48916',
                'name' => "Wijk 16 Havenkwartier"
            ],
            [
                'code' => '48917',
                'name' => "Wijk 17 Gaatkensoog"
            ],
            [
                'code' => '48918',
                'name' => "Wijk 18 Riederhoek"
            ],
            [
                'code' => '48919',
                'name' => "Wijk 19 Vrijheidsakker"
            ],
            [
                'code' => '48920',
                'name' => "Wijk 20 Vrijenburg"
            ],
            [
                'code' => '49802',
                'name' => "Oosterblokker"
            ],
            [
                'code' => '49805',
                'name' => "Schellinkhout"
            ],
            [
                'code' => '49807',
                'name' => "Oosterleek"
            ],
            [
                'code' => '49899',
                'name' => "Groot water"
            ],
            [
                'code' => '50103',
                'name' => "Wijk 03 Recreatiestrook Brielse Maas"
            ],
            [
                'code' => '50326',
                'name' => "Wijk 26 Abtswoude"
            ],
            [
                'code' => '50599',
                'name' => "Groot water"
            ],
            [
                'code' => '51202',
                'name' => "Wijk 02 Wijdschild"
            ],
            [
                'code' => '51203',
                'name' => "Wijk 03 Lingewijk"
            ],
            [
                'code' => '51205',
                'name' => "Wijk 05 Stalkaarsen"
            ],
            [
                'code' => '51206',
                'name' => "Wijk 06 Gildenwijk"
            ],
            [
                'code' => '51207',
                'name' => "Wijk 07 Schelluinsestraat"
            ],
            [
                'code' => '51208',
                'name' => "Wijk 08 Avelingen Oost"
            ],
            [
                'code' => '51209',
                'name' => "Wijk 09 Avelingen West"
            ],
            [
                'code' => '51210',
                'name' => "Wijk 10 Molenvliet"
            ],
            [
                'code' => '51212',
                'name' => "Wijk 12 Dalem"
            ],
            [
                'code' => '51213',
                'name' => "Wijk 13 Hoog Dalem"
            ],
            [
                'code' => '51215',
                'name' => "Wijk 15 Papland"
            ],
            [
                'code' => '51216',
                'name' => "Wijk 16 schotdeuren"
            ],
            [
                'code' => '51217',
                'name' => "Wijk 17 Bedrijventerrein Noord"
            ],
            [
                'code' => '51218',
                'name' => "Wijk 18 Landelijk gebied West"
            ],
            [
                'code' => '51219',
                'name' => "Wijk 19 Landelijk gebied Noord"
            ],
            [
                'code' => '51220',
                'name' => "Wijk 20 Landelijk gebied Oost"
            ],
            [
                'code' => '51221',
                'name' => "Wijk 21 Landelijk gebied Zuid"
            ],
            [
                'code' => '51801',
                'name' => "Wijk 01 Oostduinen"
            ],
            [
                'code' => '51802',
                'name' => "Wijk 02 Belgisch Park"
            ],
            [
                'code' => '51805',
                'name' => "Wijk 05 Archipelbuurt"
            ],
            [
                'code' => '51806',
                'name' => "Wijk 06 Van Stolkpark en Scheveningse Bosjes"
            ],
            [
                'code' => '51808',
                'name' => "Wijk 08 Duindorp"
            ],
            [
                'code' => '51810',
                'name' => "Wijk 10 Zorgvliet"
            ],
            [
                'code' => '51813',
                'name' => "Wijk 13 Vogelwijk"
            ],
            [
                'code' => '51816',
                'name' => "Wijk 16 Kraayenstein en Vroondaal"
            ],
            [
                'code' => '51822',
                'name' => "Wijk 22 Zeeheldenkwartier"
            ],
            [
                'code' => '51823',
                'name' => "Wijk 23 Willemspark"
            ],
            [
                'code' => '51824',
                'name' => "Wijk 24 Haagse Bos"
            ],
            [
                'code' => '51832',
                'name' => "Wijk 32 Leyenburg"
            ],
            [
                'code' => '51835',
                'name' => "Wijk 35 Zuiderpark"
            ],
            [
                'code' => '51837',
                'name' => "Wijk 37 Groente- en Fruitmarkt"
            ],
            [
                'code' => '51839',
                'name' => "Wijk 39 Binckhorst"
            ],
            [
                'code' => '51899',
                'name' => "Groot water"
            ],
            [
                'code' => '53008',
                'name' => "Wijk 08 Kickers Bloem"
            ],
            [
                'code' => '53104',
                'name' => "Wijk 04 Sandelingen-Ambacht"
            ],
            [
                'code' => '53299',
                'name' => "Groot water"
            ],
            [
                'code' => '53799',
                'name' => "Groot water"
            ],
            [
                'code' => '54602',
                'name' => "Stationsdistrict"
            ],
            [
                'code' => '55601',
                'name' => "Wijk 01 Taanschuurpolder"
            ],
            [
                'code' => '55608',
                'name' => "Wijk 08 Wilgenrijk"
            ],
            [
                'code' => '57599',
                'name' => "Groot water"
            ],
            [
                'code' => '58904',
                'name' => "Snelrewaard"
            ],
            [
                'code' => '59701',
                'name' => "Centrum"
            ],
            [
                'code' => '59702',
                'name' => "West"
            ],
            [
                'code' => '59703',
                'name' => "Oost"
            ],
            [
                'code' => '59704',
                'name' => "Drievliet"
            ],
            [
                'code' => '59705',
                'name' => "Het Zand"
            ],
            [
                'code' => '59706',
                'name' => "Slikkerveer"
            ],
            [
                'code' => '59707',
                'name' => "Bolnes"
            ],
            [
                'code' => '59708',
                'name' => "Rijsoord"
            ],
            [
                'code' => '59709',
                'name' => "Oostendam"
            ],
            [
                'code' => '59710',
                'name' => "Donkersloot"
            ],
            [
                'code' => '59711',
                'name' => "Verenambacht"
            ],
            [
                'code' => '59712',
                'name' => "Cornelisland"
            ],
            [
                'code' => '59913',
                'name' => "Pernis"
            ],
            [
                'code' => '59918',
                'name' => "Spaanse Polder"
            ],
            [
                'code' => '59919',
                'name' => "Nieuw Mathenesse"
            ],
            [
                'code' => '59922',
                'name' => "Vondelingenplaat"
            ],
            [
                'code' => '59924',
                'name' => "Rotterdam-Noord-West"
            ],
            [
                'code' => '59925',
                'name' => "Rivium"
            ],
            [
                'code' => '59926',
                'name' => "Bedrijventerrein Schieveen"
            ],
            [
                'code' => '59999',
                'name' => "Groot water"
            ],
            [
                'code' => '60305',
                'name' => "Wijk 05"
            ],
            [
                'code' => '60600',
                'name' => "Wijk 00 Centrum"
            ],
            [
                'code' => '60605',
                'name' => "Wijk 05 Nieuw Mathenesse"
            ],
            [
                'code' => '61307',
                'name' => "Wijk 07 Rotterdam-Albrandswaard"
            ],
            [
                'code' => '61499',
                'name' => "Groot water"
            ],
            [
                'code' => '62208',
                'name' => "Broekpolder"
            ],
            [
                'code' => '62999',
                'name' => "Groot water"
            ],
            [
                'code' => '63801',
                'name' => "Westeinde"
            ],
            [
                'code' => '63802',
                'name' => "Zuidbuurt"
            ],
            [
                'code' => '63803',
                'name' => "Weipoort"
            ],
            [
                'code' => '63804',
                'name' => "Gelderswoude"
            ],
            [
                'code' => '63809',
                'name' => "Verspreide huizen"
            ],
            [
                'code' => '65499',
                'name' => "Groot water"
            ],
            [
                'code' => '66406',
                'name' => "Wijk 06 Eindewege"
            ],
            [
                'code' => '66409',
                'name' => "Wijk 09 Oud-Sabbinge"
            ],
            [
                'code' => '67799',
                'name' => "Groot water"
            ],
            [
                'code' => '67899',
                'name' => "Groot water"
            ],
            [
                'code' => '68712',
                'name' => "Nieuw Middelburg"
            ],
            [
                'code' => '68715',
                'name' => "Ramsburg"
            ],
            [
                'code' => '68740',
                'name' => "Nieuw- en Sint Joosland"
            ],
            [
                'code' => '68751',
                'name' => "Kleverskerke"
            ],
            [
                'code' => '68752',
                'name' => "Oranjeplaat"
            ],
            [
                'code' => '68753',
                'name' => "Veerse Meer"
            ],
            [
                'code' => '68759',
                'name' => "Verspreide huizen Arnemuiden"
            ],
            [
                'code' => '68799',
                'name' => "Groot water"
            ],
            [
                'code' => '70399',
                'name' => "Groot water"
            ],
            [
                'code' => '71501',
                'name' => "Kern Axel"
            ],
            [
                'code' => '71502',
                'name' => "Buitengebied Axel"
            ],
            [
                'code' => '71503',
                'name' => "Kern Biervliet"
            ],
            [
                'code' => '71504',
                'name' => "Buitengebied Biervliet"
            ],
            [
                'code' => '71505',
                'name' => "Kern Hoek"
            ],
            [
                'code' => '71506',
                'name' => "Buitengebied Hoek"
            ],
            [
                'code' => '71507',
                'name' => "Kern Koewacht"
            ],
            [
                'code' => '71508',
                'name' => "Buitengebied Koewacht"
            ],
            [
                'code' => '71509',
                'name' => "Kern Overslag"
            ],
            [
                'code' => '71510',
                'name' => "Buitengebied Overslag"
            ],
            [
                'code' => '71511',
                'name' => "Kern Philippine"
            ],
            [
                'code' => '71512',
                'name' => "Buitengebied Philippine"
            ],
            [
                'code' => '71513',
                'name' => "Kern Sas van Gent"
            ],
            [
                'code' => '71514',
                'name' => "Buitengebied Sas van Gent"
            ],
            [
                'code' => '71515',
                'name' => "Kern Sluiskil"
            ],
            [
                'code' => '71516',
                'name' => "Buitengebied Sluiskil"
            ],
            [
                'code' => '71517',
                'name' => "Kern Spui"
            ],
            [
                'code' => '71518',
                'name' => "Buitengebied Spui"
            ],
            [
                'code' => '71519',
                'name' => "Buitengebied Terneuzen"
            ],
            [
                'code' => '71520',
                'name' => "Terneuzen Centrum"
            ],
            [
                'code' => '71524',
                'name' => "Terneuzen Oost"
            ],
            [
                'code' => '71525',
                'name' => "Kern Westdorpe"
            ],
            [
                'code' => '71526',
                'name' => "Buitengebied Westdorpe"
            ],
            [
                'code' => '71527',
                'name' => "Kern Zaamslag"
            ],
            [
                'code' => '71528',
                'name' => "Buitengebied Zaamslag"
            ],
            [
                'code' => '71529',
                'name' => "Kern Zuiddorpe"
            ],
            [
                'code' => '71530',
                'name' => "Buitengebied Zuiddorpe"
            ],
            [
                'code' => '71599',
                'name' => "Groot water"
            ],
            [
                'code' => '71808',
                'name' => "Sloegebied"
            ],
            [
                'code' => '71899',
                'name' => "Groot water"
            ],
            [
                'code' => '73603',
                'name' => "Amstelhoek"
            ],
            [
                'code' => '74309',
                'name' => "Heusden recreatie"
            ],
            [
                'code' => '74311',
                'name' => "Ommel recreatie"
            ],
            [
                'code' => '74403',
                'name' => "Castelré"
            ],
            [
                'code' => '75730',
                'name' => "Esch"
            ],
            [
                'code' => '75731',
                'name' => "Verspr huizen Esch"
            ],
            [
                'code' => '77701',
                'name' => "Midden Bedrijventerrein"
            ],
            [
                'code' => '77702',
                'name' => "Midden landelijk gebied"
            ],
            [
                'code' => '77711',
                'name' => "Noord bedrijventerrein"
            ],
            [
                'code' => '77721',
                'name' => "Zuid bedrijventerrein West"
            ],
            [
                'code' => '77722',
                'name' => "Zuid bedrijventerrein Oost"
            ],
            [
                'code' => '78501',
                'name' => "Wijk 01 Goirle-Centrum"
            ],
            [
                'code' => '78502',
                'name' => "Wijk 02 Grobbendonck"
            ],
            [
                'code' => '78505',
                'name' => "Wijk 05 Abcoven"
            ],
            [
                'code' => '78506',
                'name' => "Wijk 06 Wildackers"
            ],
            [
                'code' => '78510',
                'name' => "Wijk 10 De Nieuwe Erven"
            ],
            [
                'code' => '78512',
                'name' => "Wijk 12 Sportpark Van den Wildenberg"
            ],
            [
                'code' => '78514',
                'name' => "Wijk 14 Verspreide huizen Goirle"
            ],
            [
                'code' => '78521',
                'name' => "Wijk 21 Bedrijventerrein Riel"
            ],
            [
                'code' => '78522',
                'name' => "Wijk 22 Sportpark De Krim"
            ],
            [
                'code' => '78523',
                'name' => "Wijk 23 Verspriede huizen Riel"
            ],
            [
                'code' => '79702',
                'name' => "Wijk 02 Elshout"
            ],
            [
                'code' => '79703',
                'name' => "Wijk 03 Haarsteeg"
            ],
            [
                'code' => '79704',
                'name' => "Wijk 04 Nieuwkuijk"
            ],
            [
                'code' => '79706',
                'name' => "Wijk 06 Doeveren"
            ],
            [
                'code' => '79707',
                'name' => "Wijk 07 Hedikthuizen"
            ],
            [
                'code' => '79708',
                'name' => "Wijk 08 Heesbeen"
            ],
            [
                'code' => '79709',
                'name' => "Wijk 09 Herpt"
            ],
            [
                'code' => '79710',
                'name' => "Wijk 10 Heusden"
            ],
            [
                'code' => '79711',
                'name' => "Wijk 11 Oudheusden"
            ],
            [
                'code' => '80940',
                'name' => "Wijk 40 De Moer"
            ],
            [
                'code' => '82401',
                'name' => "Verspr.h. westen en noorden Moerg."
            ],
            [
                'code' => '82403',
                'name' => "Heukelom"
            ],
            [
                'code' => '82405',
                'name' => "Omgeving Vinkenberg / Heuvelstraat"
            ],
            [
                'code' => '82406',
                'name' => "Omgeving George Perklaan"
            ],
            [
                'code' => '82407',
                'name' => "Centrum Moergestel"
            ],
            [
                'code' => '82410',
                'name' => "Buitengebied Kerkhoven"
            ],
            [
                'code' => '82412',
                'name' => "Omgeving Industrieterrein Kerckhoven Laarakkers"
            ],
            [
                'code' => '82414',
                'name' => "Verspr.h. oosten en zuiden Moerg."
            ],
            [
                'code' => '82415',
                'name' => "Omgeving Broekzijde"
            ],
            [
                'code' => '82416',
                'name' => "Buitengebied Pannenschuur"
            ],
            [
                'code' => '82417',
                'name' => "Buitengebied Laarakkers"
            ],
            [
                'code' => '82418',
                'name' => "KVL"
            ],
            [
                'code' => '82419',
                'name' => "Sportpark Den Donk e.o."
            ],
            [
                'code' => '82600',
                'name' => "Wijk 00 Oosterhout-Centrum"
            ],
            [
                'code' => '84709',
                'name' => "Wijk 09"
            ],
            [
                'code' => '85199',
                'name' => "Groot water"
            ],
            [
                'code' => '85201',
                'name' => "Wijk 01 Katwoude"
            ],
            [
                'code' => '85205',
                'name' => "Wijk 05 Watergang"
            ],
            [
                'code' => '85299',
                'name' => "Groot water"
            ],
            [
                'code' => '85530',
                'name' => "Moerenburg"
            ],
            [
                'code' => '85541',
                'name' => "De Oude Warande"
            ],
            [
                'code' => '85546',
                'name' => "Bosscheweg"
            ],
            [
                'code' => '85550',
                'name' => "Heyhoef"
            ],
            [
                'code' => '85562',
                'name' => "Buitengebied Tilburg Zuid-Oost"
            ],
            [
                'code' => '85565',
                'name' => "Buitengebied Tilburg Noord-West"
            ],
            [
                'code' => '91714',
                'name' => "Wijk 14 De Koumen"
            ],
            [
                'code' => '91723',
                'name' => "Wijk 23 De Hei"
            ],
            [
                'code' => '91734',
                'name' => "Wijk 34 Eikenderveld"
            ],
            [
                'code' => '91735',
                'name' => "Wijk 35 Woonboulevard-Ten Esschen"
            ],
            [
                'code' => '91740',
                'name' => "Wijk 40 Heerlerbaan-Centrum"
            ],
            [
                'code' => '91742',
                'name' => "Wijk 42 De Beitel"
            ],
            [
                'code' => '95705',
                'name' => "Wijk 05 Hoogvonderen"
            ],
            [
                'code' => '95709',
                'name' => "Wijk 09 Maasplassen"
            ],
            [
                'code' => '98101',
                'name' => "Wijk 01 Vaals"
            ],
            [
                'code' => '98401',
                'name' => "Heide"
            ],
            [
                'code' => '98402',
                'name' => "Ysselsteyn"
            ],
            [
                'code' => '98403',
                'name' => "Merselo"
            ],
            [
                'code' => '98404',
                'name' => "Vredepeel"
            ],
            [
                'code' => '98405',
                'name' => "Smakt"
            ],
            [
                'code' => '98406',
                'name' => "Oostrum"
            ],
            [
                'code' => '98407',
                'name' => "Oirlo"
            ],
            [
                'code' => '98408',
                'name' => "Castenray"
            ],
            [
                'code' => '98409',
                'name' => "Veulen"
            ],
            [
                'code' => '98410',
                'name' => "Leunen"
            ],
            [
                'code' => '98411',
                'name' => "Centrum"
            ],
            [
                'code' => '98414',
                'name' => "Vlakwater"
            ],
            [
                'code' => '98418',
                'name' => "Smakterheide"
            ],
            [
                'code' => '98419',
                'name' => "Brabander"
            ],
            [
                'code' => '98420',
                'name' => "St. Antoniusveld"
            ],
            [
                'code' => '98421',
                'name' => "Wanssum"
            ],
            [
                'code' => '98422',
                'name' => "Geijsteren"
            ],
            [
                'code' => '98423',
                'name' => "Blitterswijck"
            ],
            [
                'code' => '98605',
                'name' => "Wijk 05 Ransdaal"
            ],
            [
                'code' => '98609',
                'name' => "Wijk 09 Verspreide huizen Voerendaal"
            ],
            [
                'code' => '98812',
                'name' => "Wijk 12 Biest"
            ],
            [
                'code' => '98823',
                'name' => "Wijk 23 Graswinkel"
            ],
            [
                'code' => '99405',
                'name' => "Wijk 05: Walem"
            ],
            [
                'code' => '99599',
                'name' => "Groot water"
            ],
            [
                'code' => '99899',
                'name' => "Buitenland"
            ],
            [
                'code' => '159899',
                'name' => "Groot water"
            ],
            [
                'code' => '162114',
                'name' => "Wijk 14 Wilderszijde"
            ],
            [
                'code' => '162124',
                'name' => "Wijk 24 Noordeinde"
            ],
            [
                'code' => '164106',
                'name' => "Wijk 06 Beegden"
            ],
            [
                'code' => '164107',
                'name' => "Wijk 07 Wessem"
            ],
            [
                'code' => '168102',
                'name' => "Westdorp"
            ],
            [
                'code' => '168103',
                'name' => "Zandberg"
            ],
            [
                'code' => '168181',
                'name' => "2e Valthermond"
            ],
            [
                'code' => '168183',
                'name' => "Bronneger"
            ],
            [
                'code' => '168184',
                'name' => "Bronnegerveen"
            ],
            [
                'code' => '168189',
                'name' => "Drouwenerveen"
            ],
            [
                'code' => '168191',
                'name' => "Eesergroen"
            ],
            [
                'code' => '168192',
                'name' => "Eeserveen"
            ],
            [
                'code' => '168193',
                'name' => "Ellertshaar"
            ],
            [
                'code' => '168194',
                'name' => "Exloërveen"
            ],
            [
                'code' => '168509',
                'name' => "Wijk 09 Verspreide huizen Zeeland"
            ],
            [
                'code' => '169600',
                'name' => "Wijk 00 's-Graveland"
            ],
            [
                'code' => '169603',
                'name' => "Wijk 03 Loosdrecht"
            ],
            [
                'code' => '169605',
                'name' => "Wijk 05 Breukeleveen"
            ],
            [
                'code' => '170006',
                'name' => "Buitengebied Vriezenveen Zuid"
            ],
            [
                'code' => '170117',
                'name' => "Wijk 17 Boschoord"
            ],
            [
                'code' => '170822',
                'name' => "De Bult"
            ],
            [
                'code' => '170823',
                'name' => "Baars"
            ],
            [
                'code' => '170825',
                'name' => "De Pol"
            ],
            [
                'code' => '170827',
                'name' => "Marijenkampen"
            ],
            [
                'code' => '170831',
                'name' => "Paasloo"
            ],
            [
                'code' => '170832',
                'name' => "IJsselham"
            ],
            [
                'code' => '170835',
                'name' => "Nederland"
            ],
            [
                'code' => '170836',
                'name' => "Baarlo"
            ],
            [
                'code' => '170899',
                'name' => "Groot water"
            ],
            [
                'code' => '170999',
                'name' => "Groot water"
            ],
            [
                'code' => '171499',
                'name' => "Groot water"
            ],
            [
                'code' => '172303',
                'name' => "Strijbeek"
            ],
            [
                'code' => '172305',
                'name' => "Ulvenhout AC"
            ],
            [
                'code' => '172306',
                'name' => "Bavel AC"
            ],
            [
                'code' => '172401',
                'name' => "Wijk 01 Weebosch"
            ],
            [
                'code' => '173113',
                'name' => "Wijk 13 Nieuweroord"
            ],
            [
                'code' => '173503',
                'name' => "Wijk 03 Verspreide huizen Kerspel en omgeving"
            ],
            [
                'code' => '174207',
                'name' => "Wijk 07 Bedrijventerrein Rijssen"
            ],
            [
                'code' => '174208',
                'name' => "Wijk 08 Recreatiegebied De Borkeld"
            ],
            [
                'code' => '177306',
                'name' => "Wijk 06 Welsum"
            ],
            [
                'code' => '177308',
                'name' => "Wijk 08 Eikelhof"
            ],
            [
                'code' => '177309',
                'name' => "Wijk 09 Elshof"
            ],
            [
                'code' => '177310',
                'name' => "Wijk 10 Marle"
            ],
            [
                'code' => '177311',
                'name' => "Wijk 11 Middel"
            ],
            [
                'code' => '177312',
                'name' => "Wijk 12 Herxen"
            ],
            [
                'code' => '177420',
                'name' => "Wijk 20 Nutter"
            ],
            [
                'code' => '177421',
                'name' => "Wijk 21 Oud Ootmarsum"
            ],
            [
                'code' => '178310',
                'name' => "Wijk 10 Ter Heijde"
            ],
            [
                'code' => '178399',
                'name' => "Groot water"
            ],
            [
                'code' => '189504',
                'name' => "Wijk 04 Nieuw-Beerta"
            ],
            [
                'code' => '189599',
                'name' => "Groot water"
            ],
            [
                'code' => '189605',
                'name' => "Wijk 05 Mastenbroek"
            ],
            [
                'code' => '189699',
                'name' => "Groot water"
            ],
            [
                'code' => '190411',
                'name' => "Wijk 11 Oud Zuilen"
            ],
            [
                'code' => '191108',
                'name' => "Kreileroord"
            ],
            [
                'code' => '193004',
                'name' => "Vierambachten"
            ],
            [
                'code' => '193013',
                'name' => "Vriesland"
            ],
            [
                'code' => '193016',
                'name' => "Halfweg"
            ],
            [
                'code' => '193099',
                'name' => "Groot water"
            ],
            [
                'code' => '193103',
                'name' => "Wijk 03 Gouderak"
            ],
            [
                'code' => '193106',
                'name' => "Wijk 06 Ammerstol"
            ],
            [
                'code' => '194001',
                'name' => "Wijk 01 Akmarijp"
            ],
            [
                'code' => '194002',
                'name' => "Wijk 02 Bakhuizen"
            ],
            [
                'code' => '194003',
                'name' => "Wijk 03 Balk"
            ],
            [
                'code' => '194004',
                'name' => "Wijk 04 Bantega"
            ],
            [
                'code' => '194005',
                'name' => "Wijk 05 Boornzwaag"
            ],
            [
                'code' => '194006',
                'name' => "Wijk 06 Broek"
            ],
            [
                'code' => '194008',
                'name' => "Wijk 08 Dijken"
            ],
            [
                'code' => '194009',
                'name' => "Wijk 09 Doniaga"
            ],
            [
                'code' => '194010',
                'name' => "Wijk 10 Echten"
            ],
            [
                'code' => '194012',
                'name' => "Wijk 12 Eesterga"
            ],
            [
                'code' => '194013',
                'name' => "Wijk 13 Elahuizen"
            ],
            [
                'code' => '194014',
                'name' => "Wijk 14 Follega"
            ],
            [
                'code' => '194015',
                'name' => "Wijk 15 Goingarijp"
            ],
            [
                'code' => '194016',
                'name' => "Wijk 16 Harich"
            ],
            [
                'code' => '194017',
                'name' => "Wijk 17 Haskerhorne"
            ],
            [
                'code' => '194018',
                'name' => "Wijk 18 Idskenhuizen"
            ],
            [
                'code' => '194020',
                'name' => "Wijk 20 Kolderwolde"
            ],
            [
                'code' => '194021',
                'name' => "Wijk 21 Langweer"
            ],
            [
                'code' => '194022',
                'name' => "Wijk 22 Legemeer"
            ],
            [
                'code' => '194024',
                'name' => "Wijk 24 Mirns"
            ],
            [
                'code' => '194025',
                'name' => "Wijk 25 Nijehaske"
            ],
            [
                'code' => '194026',
                'name' => "Wijk 26 Nijemirdum"
            ],
            [
                'code' => '194027',
                'name' => "Wijk 27 Oldeouwer"
            ],
            [
                'code' => '194029',
                'name' => "Wijk 29 Oudega"
            ],
            [
                'code' => '194030',
                'name' => "Wijk 30 Oudehaske"
            ],
            [
                'code' => '194031',
                'name' => "Wijk 31 Oudemirdum"
            ],
            [
                'code' => '194032',
                'name' => "Wijk 32 Ouwsterhaule"
            ],
            [
                'code' => '194033',
                'name' => "Wijk 33 Ouwster-Nijega"
            ],
            [
                'code' => '194034',
                'name' => "Wijk 34 Rijs"
            ],
            [
                'code' => '194035',
                'name' => "Wijk 35 Rohel"
            ],
            [
                'code' => '194036',
                'name' => "Wijk 36 Rotstergaast"
            ],
            [
                'code' => '194037',
                'name' => "Wijk 37 Rotsterhaule"
            ],
            [
                'code' => '194038',
                'name' => "Wijk 38 Rottum"
            ],
            [
                'code' => '194039',
                'name' => "Wijk 39 Ruigahuizen"
            ],
            [
                'code' => '194040',
                'name' => "Wijk 40 Scharsterbrug"
            ],
            [
                'code' => '194041',
                'name' => "Wijk 41 Sint Nicolaasga"
            ],
            [
                'code' => '194042',
                'name' => "Wijk 42 Sinjohannesga"
            ],
            [
                'code' => '194043',
                'name' => "Wijk 43 Sloten"
            ],
            [
                'code' => '194044',
                'name' => "Wijk 44 Snikzwaag"
            ],
            [
                'code' => '194045',
                'name' => "Wijk 45 Sondel"
            ],
            [
                'code' => '194046',
                'name' => "Wijk 46 Terherne"
            ],
            [
                'code' => '194047',
                'name' => "Wijk 47 Terkaple"
            ],
            [
                'code' => '194048',
                'name' => "Wijk 48 Teroele"
            ],
            [
                'code' => '194049',
                'name' => "Wijk 49 Tjerkgaast"
            ],
            [
                'code' => '194050',
                'name' => "Wijk 50 Vegelinsoord"
            ],
            [
                'code' => '194051',
                'name' => "Wijk 51 Wijckel"
            ],
            [
                'code' => '194099',
                'name' => "Groot water"
            ],
            [
                'code' => '194299',
                'name' => "Groot water"
            ],
            [
                'code' => '194504',
                'name' => "Erlecom"
            ],
            [
                'code' => '194511',
                'name' => "Persingen"
            ],
            [
                'code' => '194512',
                'name' => "Ubbergen"
            ],
            [
                'code' => '194917',
                'name' => "Baaium"
            ],
            [
                'code' => '194921',
                'name' => "Blessum"
            ],
            [
                'code' => '194922',
                'name' => "Boer"
            ],
            [
                'code' => '194927',
                'name' => "Firdgum"
            ],
            [
                'code' => '194929',
                'name' => "Herbaijum"
            ],
            [
                'code' => '194930',
                'name' => "Hitzum"
            ],
            [
                'code' => '194933',
                'name' => "Klooster Lidlum"
            ],
            [
                'code' => '194937',
                'name' => "Nij Altoenae"
            ],
            [
                'code' => '194940',
                'name' => "Peins"
            ],
            [
                'code' => '194941',
                'name' => "Pietersbierum"
            ],
            [
                'code' => '194943',
                'name' => "Schalsum"
            ],
            [
                'code' => '194945',
                'name' => "Skingen"
            ],
            [
                'code' => '194946',
                'name' => "Slappeterp"
            ],
            [
                'code' => '194951',
                'name' => "Westhoek"
            ],
            [
                'code' => '194952',
                'name' => "Wier"
            ],
            [
                'code' => '194955',
                'name' => "Zweins"
            ],
            [
                'code' => '194999',
                'name' => "Groot water"
            ],
            [
                'code' => '196101',
                'name' => "Tienhoven aan de Lek"
            ],
            [
                'code' => '196107',
                'name' => "Lexmond"
            ],
            [
                'code' => '196109',
                'name' => "Nieuwland"
            ],
            [
                'code' => '196111',
                'name' => "Leerbroek"
            ],
            [
                'code' => '196113',
                'name' => "Kedichem"
            ],
            [
                'code' => '196114',
                'name' => "Kedichem buitengebied"
            ],
            [
                'code' => '196115',
                'name' => "Hei- en Boeicop"
            ],
            [
                'code' => '196116',
                'name' => "Hei- en Boeicop buitengebied"
            ],
            [
                'code' => '196117',
                'name' => "Oosterwijk"
            ],
            [
                'code' => '196118',
                'name' => "Amaliastein"
            ],
            [
                'code' => '196128',
                'name' => "Nieuw Schaik"
            ],
            [
                'code' => '196129',
                'name' => "Leerdam buitengebied"
            ],
            [
                'code' => '196130',
                'name' => "Schoonrewoerd"
            ],
            [
                'code' => '196131',
                'name' => "Schoonrewoerd buitengebied"
            ],
            [
                'code' => '196132',
                'name' => "Zijderveld"
            ],
            [
                'code' => '196133',
                'name' => "Zijderveld buitengebied"
            ],
            [
                'code' => '196134',
                'name' => "Hagestein"
            ],
            [
                'code' => '196137',
                'name' => "Everdingen"
            ],
            [
                'code' => '196138',
                'name' => "Everdingen buitengebied"
            ],
            [
                'code' => '196139',
                'name' => "Ossenwaard"
            ],
            [
                'code' => '196399',
                'name' => "Groot water"
            ],
            [
                'code' => '196999',
                'name' => "Groot water"
            ],
            [
                'code' => '197819',
                'name' => "Wijk19-Waal"
            ],
            [
                'code' => '197901',
                'name' => "Delfzijl-Centrum"
            ],
            [
                'code' => '197999',
                'name' => "Groot water"
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
}