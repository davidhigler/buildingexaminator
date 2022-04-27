<?php

namespace App\DataFixtures;

use App\Entity\Authorization\Owner;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\LivingType;
use App\Entity\Portfolio\ResidentialArea;
use App\Entity\Portfolio\Vtw;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * @author Reiny Griemink <rgriemink@gmail.com>
 */
class LoadTestHousingStockData extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $residentialArea1 = new ResidentialArea();
        $residentialArea1->setCode('019310');
        $residentialArea1->setName('Binnenstad');
        $residentialArea1->setDescription('De binnenstad van Zwolle is een autoluwe wijk met in het oude centrum van de stad. Het gebied wordt begrensd door de voormalige stadsmuren en grachten. Het is een wijk waar tegenwoordig met name winkelgebied is gelegen, zoals in de Sassenstraat, de Diezerstraat, de Oude Vismarkt, de Luttekestraat, de Melkmarkt, het Grote Kerkplein, het Rodetorenplein en de Grote Markt.');
        $residentialArea1->setCreationTime();
        $residentialArea1->setLastChangeTime();

        $residentialArea2 = new ResidentialArea();
        $residentialArea2->setCode('019311');
        $residentialArea2->setName('Diezerpoort');
        $residentialArea2->setDescription('Diezerpoort (ook: Dieze, Nijstad, Nieuwstad) is een woonwijk in de Overijsselse plaats Zwolle. De wijk bestaat uit een aantal buurten[2], te weten Dieze-Centrum, Dieze-West, Dieze-Oost en de Indische Buurt. De wijk wordt ook wel Dieze genoemd. De wijk is vernoemd naar de gelijknamige stadspoort.');
        $residentialArea2->setCreationTime();
        $residentialArea2->setLastChangeTime();

        $residentialArea3 = new ResidentialArea();
        $residentialArea3->setCode('019312');
        $residentialArea3->setName('Wipstrik');
        $residentialArea3->setDescription('Wipstrik is een woonwijk in de Overijsselse hoofdstad Zwolle. De wijk ligt dicht bij de binnenstad en is goed bereikbaar per auto, fiets en lopend. In de wijk wonen ongeveer 6.400 mensen.');
        $residentialArea3->setCreationTime();
        $residentialArea3->setLastChangeTime();

        $residentialArea4 = new ResidentialArea();
        $residentialArea4->setCode('019313');
        $residentialArea4->setName('Assendorp');
        $residentialArea4->setDescription("Assendorp (Nedersaksisch: Ass'ndörp) is een wijk in Zwolle, in de Nederlandse provincie Overijssel.");
        $residentialArea4->setCreationTime();
        $residentialArea4->setLastChangeTime();

        $residentialArea5 = new ResidentialArea();
        $residentialArea5->setCode('019314');
        $residentialArea5->setName('Kamperpoort-Veerallee');
        $residentialArea5->setDescription('Kamperpoort-Veerallee is een woonwijk van de gemeente Zwolle. Het omvat de buurten Kamperpoort en Veerallee.');
        $residentialArea5->setCreationTime();
        $residentialArea5->setLastChangeTime();

        $residentialArea6 = new ResidentialArea();
        $residentialArea6->setCode('019320');
        $residentialArea6->setName('Poort van Zwolle');
        $residentialArea6->setDescription('Poort van Zwolle is een woonwijk in de gemeente Zwolle. Het omvat de buurten Spoolde, het bedrijventerrein Voorst-B en het bedrijventerrein Voorst-A. Er staan anno 2013 156 woningen.');
        $residentialArea6->setCreationTime();
        $residentialArea6->setLastChangeTime();

        $residentialArea7 = new ResidentialArea();
        $residentialArea7->setCode('019321');
        $residentialArea7->setName('Westenholte');
        $residentialArea7->setDescription('Westenholte is een wijk in Zwolle en een voormalige buurtschap in de Nederlandse provincie Overijssel.');
        $residentialArea7->setCreationTime();
        $residentialArea7->setLastChangeTime();

        $residentialArea8 = new ResidentialArea();
        $residentialArea8->setCode('019322');
        $residentialArea8->setName('Stadshagen');
        $residentialArea8->setDescription('Stadshagen is een Vinex-locatie in Zwolle gelegen in de polder Mastenbroek. Het telt 26.605 inwoners op 1 januari 2020.');
        $residentialArea8->setCreationTime();
        $residentialArea8->setLastChangeTime();

        $residentialArea9 = new ResidentialArea();
        $residentialArea9->setCode('019330');
        $residentialArea9->setName('Holtenbroek');
        $residentialArea9->setDescription('Holtenbroek is een woonwijk in de Overijsselse hoofdstad Zwolle.');
        $residentialArea9->setCreationTime();
        $residentialArea9->setLastChangeTime();

        $residentialArea10 = new ResidentialArea();
        $residentialArea10->setCode('019331');
        $residentialArea10->setName('Aalanden');
        $residentialArea10->setDescription('Aa-landen (uitspraak: A-landen) is een woonwijk in de Overijsselse plaats Zwolle. De wijk kent de volgende buurten: Aalanden-Noord, Aalanden-Oost, Aalanden-Midden, Aalanden-Zuid');
        $residentialArea10->setCreationTime();
        $residentialArea10->setLastChangeTime();

        $residentialArea11 = new ResidentialArea();
        $residentialArea11->setCode('019332');
        $residentialArea11->setName('Vechtlanden');
        $residentialArea11->setDescription('Vechtlanden is een dunbevolkte wijk in het buitengebied ten noorden van de gemeente Zwolle.');
        $residentialArea11->setCreationTime();
        $residentialArea11->setLastChangeTime();

        $residentialArea12 = new ResidentialArea();
        $residentialArea12->setCode('019340');
        $residentialArea12->setName('Berkum');
        $residentialArea12->setDescription('Berkum (Nedersaksisch: Bärkum of Berkum) is een wijk en buurt van de stad Zwolle in de Nederlandse provincie Overijssel. Berkum bestaat uit Berkum, Veldhoek, Bedrijventerrein de Vrolijkheid en kantorenterrein Oosterenk.De wijk ligt ingeklemd tussen de Overijsselse Vecht, de Nieuwe Vecht en de A28. Een groot deel van de inwoners bestaat uit mensen van 65 jaar en ouder (1152). De laatste jaren komen er steeds meer jonge gezinnen bij. De voetbalvereniging VV Berkum heeft hier haar thuisbasis.');
        $residentialArea12->setCreationTime();
        $residentialArea12->setLastChangeTime();

        $residentialArea13 = new ResidentialArea();
        $residentialArea13->setCode('019341');
        $residentialArea13->setName('Marsweteringlanden');
        $residentialArea13->setDescription('Marsweteringlanden is een woonwijk in Zwolle die wordt gevormd door de buurtschappen Herfte en Wijthmen. In deze wijk is bedrijventerrein Marslanden-Zuid gesitueerd.');
        $residentialArea13->setCreationTime();
        $residentialArea13->setLastChangeTime();

        $residentialArea14 = new ResidentialArea();
        $residentialArea14->setCode('019350');
        $residentialArea14->setName('Schelle');
        $residentialArea14->setDescription('Schelle (Zwols: Skelle) is een wijk en buurtschap in de Overijsselse gemeente Zwolle in Nederland. Het ligt op een rivierduin dat is gevormd in het Preboreaal, een etage van het Holoceen. Inmiddels is de buurtschap opgenomen in de woonwijk Zwolle-Zuid en zijn er drie wijkgedeelten rondom naar de buurtschap vernoemd: Schellerhoek, Schellerbroek en Schellerlanden. De naam is ook terug te vinden in enkele straten in de omgeving zoals de Schellerweg, Schellerallee, Schellerbergweg en Schellerenkweg en een stuk dijk langs de IJssel, de Schellerdijk. Schelle bestaat uit de wijken Oud Schelle, Schelle-Zuid en Oldeneel, Schellerhoek, Schellerbroek, Schellerlanden, Oldenelerlanden-West, Oldenelerlanden-Oost, Oldenelerbroek en Katerveer-Engelse Werk.');
        $residentialArea14->setCreationTime();
        $residentialArea14->setLastChangeTime();

        $residentialArea15 = new ResidentialArea();
        $residentialArea15->setCode('019351');
        $residentialArea15->setName('Ittersum');
        $residentialArea15->setDescription('Ittersum is een voormalig gehucht dat behoorde tot de gemeente Zwollerkerspel, die in 1967 werd opgeheven. Ittersum is opgeslokt door Zwolle en is een wijk (CBS wijknummer 51) in Zwolle-Zuid met (anno 2011) 15.230 inwoners.[1] In deze wijk liggen de buurten Geren, Oud Ittersum, Gerenlanden, Gerenbroek, Ittersumerlanden en Ittersumerbroek. Van 1891 tot 1918 had Ittersum een eigen halte aan de spoorlijn Arnhem - Leeuwarden, de stopplaats Ittersum. Ittersum heeft ook een eigen voetbalclub, v.v. SVI (Sport Vereniging Ittersum), waar voormalig profvoetballer Harry Decheiver hoofdtrainer was.');
        $residentialArea15->setCreationTime();
        $residentialArea15->setLastChangeTime();

        $residentialArea16 = new ResidentialArea();
        $residentialArea16->setCode('019352');
        $residentialArea16->setName('Soestweteringlanden');
        $residentialArea16->setDescription('Soestweteringlanden is een wijk van de gemeente Zwolle in het stadsdeel Zwolle-Zuid. Het omvat de buurtschappen Harculo en Hoog-Zuthem en Windesheim.');
        $residentialArea16->setCreationTime();
        $residentialArea16->setLastChangeTime();


        $buildingType1 = new BuildingType();
        $buildingType1->setId(1);
        $buildingType1->setCode('BT1');
        $buildingType1->setName('Vrijstaande woning');
        $buildingType1->setDescription('');
        $buildingType1->setCreationTime();
        $buildingType1->setLastChangeTime();

        $buildingType2 = new BuildingType();
        $buildingType2->setId(2);
        $buildingType2->setCode('BT2');
        $buildingType2->setName('Rijwoning twee onder één kap');
        $buildingType2->setDescription('');
        $buildingType2->setCreationTime();
        $buildingType2->setLastChangeTime();

        $buildingType3 = new BuildingType();
        $buildingType3->setId(3);
        $buildingType3->setCode('BT3');
        $buildingType3->setName('Rijwoning ééngezins');
        $buildingType3->setDescription('');
        $buildingType3->setCreationTime();
        $buildingType3->setLastChangeTime();

        $buildingType4 = new BuildingType();
        $buildingType4->setId(4);
        $buildingType4->setCode('BT4');
        $buildingType4->setName('Rijwoning senioren');
        $buildingType4->setDescription('');
        $buildingType4->setCreationTime();
        $buildingType4->setLastChangeTime();

        $buildingType5 = new BuildingType();
        $buildingType5->setId(5);
        $buildingType5->setCode('BT5');
        $buildingType5->setName('Rijwoning duplex kleine gezinnen');
        $buildingType5->setDescription('woningen gesplitst is in twee deelwoningen');
        $buildingType5->setCreationTime();
        $buildingType5->setLastChangeTime();

        $buildingType6 = new BuildingType();
        $buildingType6->setId(6);
        $buildingType6->setCode('BT6');
        $buildingType6->setName('Etagewoning galerijflat');
        $buildingType6->setDescription('Woningen bereikbaar door lange galerij voor de woning');
        $buildingType6->setCreationTime();
        $buildingType6->setLastChangeTime();

        $buildingType7 = new BuildingType();
        $buildingType7->setId(7);
        $buildingType7->setCode('BT7');
        $buildingType7->setName('Etagewoning portiekflat');
        $buildingType7->setDescription('Elke stramien eigen trapopgang');
        $buildingType7->setCreationTime();
        $buildingType7->setLastChangeTime();

        $buildingType8 = new BuildingType();
        $buildingType8->setId(8);
        $buildingType8->setCode('BT8');
        $buildingType8->setName('Etagewoning maisonette');
        $buildingType8->setDescription('2 woonlagen');
        $buildingType8->setCreationTime();
        $buildingType8->setLastChangeTime();

        $buildingType9 = new BuildingType();
        $buildingType9->setId(9);
        $buildingType9->setCode('BT9');
        $buildingType9->setName('Etagewoning penthouse');
        $buildingType9->setDescription('Bovenste woning van een flat');
        $buildingType9->setCreationTime();
        $buildingType9->setLastChangeTime();

        $buildingType10 = new BuildingType();
        $buildingType10->setId(10);
        $buildingType10->setCode('BT10');
        $buildingType10->setName('Woonwagen');
        $buildingType10->setDescription('woning op wielen en campingplekken');
        $buildingType10->setCreationTime();
        $buildingType10->setLastChangeTime();

        $buildingType11 = new BuildingType();
        $buildingType11->setId(11);
        $buildingType11->setCode('BT11');
        $buildingType11->setName('Aanbouw');
        $buildingType11->setDescription('Later aangebouwde bebouwing aan de woning');
        $buildingType11->setCreationTime();
        $buildingType11->setLastChangeTime();

        $buildingType12 = new BuildingType();
        $buildingType12->setId(12);
        $buildingType12->setCode('BT12');
        $buildingType12->setName('Bedrijfsgebouw met woning(en)');
        $buildingType12->setDescription('kantoor en woning in 1');
        $buildingType12->setCreationTime();
        $buildingType12->setLastChangeTime();
        
        $buildingType13 = new BuildingType();
        $buildingType13->setId(13);
        $buildingType13->setCode('1010A');
        $buildingType13->setName('Rijwoning ééngezins');
        $buildingType13->setDescription('');
        $buildingType13->setCreationTime();
        $buildingType13->setLastChangeTime();

        $buildingType14 = new BuildingType();
        $buildingType14->setId(14);
        $buildingType14->setCode('1010B');
        $buildingType14->setName('Rijwoning senioren');
        $buildingType14->setDescription('');
        $buildingType14->setCreationTime();
        $buildingType14->setLastChangeTime();

        $livingType1 = new LivingType();
        $livingType1->setId(1);
        $livingType1->setCode('lt1');
        $livingType1->setName('Woonfunctie');
        $livingType1->setDescription('Woongebouwen');
        $livingType1->setCreationTime();
        $livingType1->setLastChangeTime();

        $livingType2 = new LivingType();
        $livingType2->setId(2);
        $livingType2->setCode('lt2');
        $livingType2->setName('Bijeenkomstfunctie');
        $livingType2->setDescription('Restaurants ontmoetingsgebouwen');
        $livingType2->setCreationTime();
        $livingType2->setLastChangeTime();

        $livingType3 = new LivingType();
        $livingType3->setId(3);
        $livingType3->setCode('lt3');
        $livingType3->setName('Celfunctie');
        $livingType3->setDescription('Gevangenissen kluizen');
        $livingType3->setCreationTime();
        $livingType3->setLastChangeTime();

        $livingType4 = new LivingType();
        $livingType4->setId(4);
        $livingType4->setCode('lt4');
        $livingType4->setName('Gezondheidszorgfunctie');
        $livingType4->setDescription('Ziekenhuizen en Medische Klinieken');
        $livingType4->setCreationTime();
        $livingType4->setLastChangeTime();

        $livingType5 = new LivingType();
        $livingType5->setId(5);
        $livingType5->setCode('lt5');
        $livingType5->setName('Industriefunctie');
        $livingType5->setDescription('Productie gebouwen');
        $livingType5->setCreationTime();
        $livingType5->setLastChangeTime();

        $livingType6 = new LivingType();
        $livingType6->setId(6);
        $livingType6->setCode('lt6');
        $livingType6->setName('Kantoorfunctie');
        $livingType6->setDescription('Bedrijfs werkplekken');
        $livingType6->setCreationTime();
        $livingType6->setLastChangeTime();

        $livingType7 = new LivingType();
        $livingType7->setId(7);
        $livingType7->setCode('lt7');
        $livingType7->setName('Logiesfunctie');
        $livingType7->setDescription('Hotels, Motel');
        $livingType7->setCreationTime();
        $livingType7->setLastChangeTime();

        $livingType8 = new LivingType();
        $livingType8->setId(8);
        $livingType8->setCode('lt8');
        $livingType8->setName('Onderwijsfunctie');
        $livingType8->setDescription('schoolgebouwen');
        $livingType8->setCreationTime();
        $livingType8->setLastChangeTime();

        $livingType9 = new LivingType();
        $livingType9->setId(9);
        $livingType9->setCode('lt9');
        $livingType9->setName('Sportfunctie');
        $livingType9->setDescription('Sporthallen');
        $livingType9->setCreationTime();
        $livingType9->setLastChangeTime();

        $livingType10 = new LivingType();
        $livingType10->setId(10);
        $livingType10->setCode('lt10');
        $livingType10->setName('Winkelfunctie');
        $livingType10->setDescription('Waar je spullen en materialen kunt halen');
        $livingType10->setCreationTime();
        $livingType10->setLastChangeTime();

        $livingType11 = new LivingType();
        $livingType11->setId(11);
        $livingType11->setCode('lt11');
        $livingType11->setName('Overige');
        $livingType11->setDescription('Alle gebouwen zonder duidelijkebestemming');
        $livingType11->setCreationTime();
        $livingType11->setLastChangeTime();

        $livingType12 = new LivingType();
        $livingType12->setId(12);
        $livingType12->setCode('lt12');
        $livingType12->setName('Geen gebouw');
        $livingType12->setDescription('Omschrijving van het gebouwtype binnen de voorraad');
        $livingType12->setCreationTime();
        $livingType12->setLastChangeTime();

        $livingType13 = new LivingType();
        $livingType13->setId(13);
        $livingType13->setCode('lt13');
        $livingType13->setName('Kelderfunctie');
        $livingType13->setDescription('Gebouw onder de grond');
        $livingType13->setCreationTime();
        $livingType13->setLastChangeTime();

        $livingType14 = new LivingType();
        $livingType14->setId(14);
        $livingType14->setCode('lt14');
        $livingType14->setName('Woonwagen');
        $livingType14->setDescription('Huis op wielen en camping plekken');
        $livingType14->setCreationTime();
        $livingType14->setLastChangeTime();

        $vtw1 = new Vtw();
        $vtw1->setCode('WT 1');
        $vtw1->setTypeDescription('eengezinswoning');
        $vtw1->setBuildingTypeDescription('1');
        $vtw1->setConstructionYearDescription('voor 1950');
        $vtw1->setRoofTypeDescription('hellend dak');

        $vtw2 = new Vtw();
        $vtw2->setCode('WT 1R');
        $vtw2->setTypeDescription('renovatie eengezinswoning');
        $vtw2->setBuildingTypeDescription('1R');
        $vtw2->setConstructionYearDescription('voor 1950');
        $vtw2->setRoofTypeDescription('hellend dak');

        $vtw3 = new Vtw();
        $vtw3->setCode('WT 2');
        $vtw3->setTypeDescription('eengezinswoning');
        $vtw3->setBuildingTypeDescription('2');
        $vtw3->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw3->setRoofTypeDescription('hellend dak');

        $vtw4 = new Vtw();
        $vtw4->setCode('WT 2R');
        $vtw4->setTypeDescription('renovatie eengezinswoning');
        $vtw4->setBuildingTypeDescription('2R');
        $vtw4->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw4->setRoofTypeDescription('hellend dak');

        $vtw5 = new Vtw();
        $vtw5->setCode('WT 3');
        $vtw5->setTypeDescription('eengezinswoning');
        $vtw5->setBuildingTypeDescription('3');
        $vtw5->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw5->setRoofTypeDescription('hellend dak');

        $vtw6 = new Vtw();
        $vtw6->setCode('WT 4');
        $vtw6->setTypeDescription('eengezinswoning/senioren-woning');
        $vtw6->setBuildingTypeDescription('4');
        $vtw6->setConstructionYearDescription('tussen 1990 en 2000');
        $vtw6->setRoofTypeDescription('hellend dak');

        $vtw7 = new Vtw();
        $vtw7->setCode('WT 5');
        $vtw7->setTypeDescription('eengezinswoning');
        $vtw7->setBuildingTypeDescription('5');
        $vtw7->setConstructionYearDescription('tussen 1990 en 2000');
        $vtw7->setRoofTypeDescription('hellend dak');

        $vtw8 = new Vtw();
        $vtw8->setCode('WT 6');
        $vtw8->setTypeDescription('eengezinswoning');
        $vtw8->setBuildingTypeDescription('6');
        $vtw8->setConstructionYearDescription('na 2000');
        $vtw8->setRoofTypeDescription('hellend dak');

        $vtw9 = new Vtw();
        $vtw9->setCode('WT 7R');
        $vtw9->setTypeDescription('renovatie eengezinswoning');
        $vtw9->setBuildingTypeDescription('7R');
        $vtw9->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw9->setRoofTypeDescription('hellend dak');

        $vtw10 = new Vtw();
        $vtw10->setCode('WT 8');
        $vtw10->setTypeDescription('eengezinswoning');
        $vtw10->setBuildingTypeDescription('8');
        $vtw10->setConstructionYearDescription('tussen 1970 en 1990');
        $vtw10->setRoofTypeDescription('hellend dak');

        $vtw11 = new Vtw();
        $vtw11->setCode('WT 9');
        $vtw11->setTypeDescription('eengezinswoning');
        $vtw11->setBuildingTypeDescription('9');
        $vtw11->setConstructionYearDescription('tussen 1990 en 2000');
        $vtw11->setRoofTypeDescription('hellend dak');

        $vtw12 = new Vtw();
        $vtw12->setCode('WT 10');
        $vtw12->setTypeDescription('eengezinswoning');
        $vtw12->setBuildingTypeDescription('10');
        $vtw12->setConstructionYearDescription('na 2000');
        $vtw12->setRoofTypeDescription('hellend dak');

        $vtw13 = new Vtw();
        $vtw13->setCode('WT 11');
        $vtw13->setTypeDescription('eengezinswoning');
        $vtw13->setBuildingTypeDescription('11');
        $vtw13->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw13->setRoofTypeDescription('vlak dak');

        $vtw14 = new Vtw();
        $vtw14->setCode('WT 11R');
        $vtw14->setTypeDescription('renovatie eengezinswoning');
        $vtw14->setBuildingTypeDescription('11R');
        $vtw14->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw14->setRoofTypeDescription('vlak dak');

        $vtw15 = new Vtw();
        $vtw15->setCode('WT 12');
        $vtw15->setTypeDescription('eengezinswoning');
        $vtw15->setBuildingTypeDescription('12');
        $vtw15->setConstructionYearDescription('tussen 1970 en 1990');
        $vtw15->setRoofTypeDescription('vlak dak');

        $vtw16 = new Vtw();
        $vtw16->setCode('WT 13');
        $vtw16->setTypeDescription('eengezinswoning');
        $vtw16->setBuildingTypeDescription('13');
        $vtw16->setConstructionYearDescription('na 1990');
        $vtw16->setRoofTypeDescription('vlak dak');

        $vtw17 = new Vtw();
        $vtw17->setCode('WT 14');
        $vtw17->setTypeDescription('open portiekwoning');
        $vtw17->setBuildingTypeDescription('14');
        $vtw17->setConstructionYearDescription('voor 1950');
        $vtw17->setRoofTypeDescription('hellend dak');

        $vtw18 = new Vtw();
        $vtw18->setCode('WT 14R');
        $vtw18->setTypeDescription('eengezinswoning');
        $vtw18->setBuildingTypeDescription('14R');
        $vtw18->setConstructionYearDescription('voor 1950');
        $vtw18->setRoofTypeDescription('hellend dak');

        $vtw19 = new Vtw();
        $vtw19->setCode('WT 15');
        $vtw19->setTypeDescription('open portiekwoning');
        $vtw19->setBuildingTypeDescription('15');
        $vtw19->setConstructionYearDescription('voor 1950');
        $vtw19->setRoofTypeDescription('vlak dak');

        $vtw20 = new Vtw();
        $vtw20->setCode('WT 15R');
        $vtw20->setTypeDescription('renovatie open portiekwoning');
        $vtw20->setBuildingTypeDescription('15R');
        $vtw20->setConstructionYearDescription('voor 1950');
        $vtw20->setRoofTypeDescription('vlak dak');

        $vtw21 = new Vtw();
        $vtw21->setCode('WT 16');
        $vtw21->setTypeDescription('etagewoning');
        $vtw21->setBuildingTypeDescription('16');
        $vtw21->setConstructionYearDescription('voor 1950');
        $vtw21->setRoofTypeDescription('hellend dak');

        $vtw22 = new Vtw();
        $vtw22->setCode('WT 16R');
        $vtw22->setTypeDescription('renovatie etagewoning');
        $vtw22->setBuildingTypeDescription('16R');
        $vtw22->setConstructionYearDescription('voor 1950');
        $vtw22->setRoofTypeDescription('hellend dak');

        $vtw23 = new Vtw();
        $vtw23->setCode('WT 17');
        $vtw23->setTypeDescription('etagewoning');
        $vtw23->setBuildingTypeDescription('17');
        $vtw23->setConstructionYearDescription('voor 1950');
        $vtw23->setRoofTypeDescription('vlak dak');

        $vtw24 = new Vtw();
        $vtw24->setCode('WT 17R');
        $vtw24->setTypeDescription('renovatie etagewoning');
        $vtw24->setBuildingTypeDescription('17R');
        $vtw24->setConstructionYearDescription('voor 1950');
        $vtw24->setRoofTypeDescription('vlak dak');

        $vtw25 = new Vtw();
        $vtw25->setCode('WT 18');
        $vtw25->setTypeDescription('trappenhuisflat Amsterdamse school');
        $vtw25->setBuildingTypeDescription('18');
        $vtw25->setConstructionYearDescription('voor 1950');
        $vtw25->setRoofTypeDescription('hellend dak');

        $vtw26 = new Vtw();
        $vtw26->setCode('WT 18R');
        $vtw26->setTypeDescription('renovatie trappenhuisflat Amsterdamse school');
        $vtw26->setBuildingTypeDescription('18R');
        $vtw26->setConstructionYearDescription('voor 1950');
        $vtw26->setRoofTypeDescription('hellend dak');

        $vtw27 = new Vtw();
        $vtw27->setCode('WT 19');
        $vtw27->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw27->setBuildingTypeDescription('19');
        $vtw27->setConstructionYearDescription('voor 1950');
        $vtw27->setRoofTypeDescription('hellend dak');

        $vtw28 = new Vtw();
        $vtw28->setCode('WT 19R');
        $vtw28->setTypeDescription('renovatie trappenhuisflat tot en met 4 lagen');
        $vtw28->setBuildingTypeDescription('19R');
        $vtw28->setConstructionYearDescription('voor 1950');
        $vtw28->setRoofTypeDescription('hellend dak');

        $vtw29 = new Vtw();
        $vtw29->setCode('WT 20');
        $vtw29->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw29->setBuildingTypeDescription('20');
        $vtw29->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw29->setRoofTypeDescription('hellend dak');

        $vtw30 = new Vtw();
        $vtw30->setCode('WT 20R');
        $vtw30->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw30->setBuildingTypeDescription('20R');
        $vtw30->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw30->setRoofTypeDescription('hellend dak');

        $vtw31 = new Vtw();
        $vtw31->setCode('WT 21');
        $vtw31->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw31->setBuildingTypeDescription('21');
        $vtw31->setConstructionYearDescription('voor 1950');
        $vtw31->setRoofTypeDescription('vlak dak');

        $vtw32 = new Vtw();
        $vtw32->setCode('WT 21R');
        $vtw32->setTypeDescription('renovatie trappenhuisflat tot en met 4 lagen');
        $vtw32->setBuildingTypeDescription('21R');
        $vtw32->setConstructionYearDescription('voor 1950');
        $vtw32->setRoofTypeDescription('vlak dak');

        $vtw33 = new Vtw();
        $vtw33->setCode('WT 22');
        $vtw33->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw33->setBuildingTypeDescription('22');
        $vtw33->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw33->setRoofTypeDescription('vlak dak');

        $vtw34 = new Vtw();
        $vtw34->setCode('WT 22R');
        $vtw34->setTypeDescription('renovatie trappenhuisflat tot en met 4 lagen');
        $vtw34->setBuildingTypeDescription('22R');
        $vtw34->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw34->setRoofTypeDescription('vlak dak');

        $vtw35 = new Vtw();
        $vtw35->setCode('WT 23');
        $vtw35->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw35->setBuildingTypeDescription('23');
        $vtw35->setConstructionYearDescription('tussen 1970 en 1990');
        $vtw35->setRoofTypeDescription('vlak dak');

        $vtw36 = new Vtw();
        $vtw36->setCode('WT 24');
        $vtw36->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw36->setBuildingTypeDescription('24');
        $vtw36->setConstructionYearDescription('na 1990');
        $vtw36->setRoofTypeDescription('vlak dak');

        $vtw37 = new Vtw();
        $vtw37->setCode('WT 25');
        $vtw37->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw37->setBuildingTypeDescription('25');
        $vtw37->setConstructionYearDescription('na 1990');
        $vtw37->setRoofTypeDescription('vlak dak');

        $vtw38 = new Vtw();
        $vtw38->setCode('WT 26');
        $vtw38->setTypeDescription('trappenhuisflat tot en met 4 lagen');
        $vtw38->setBuildingTypeDescription('26');
        $vtw38->setConstructionYearDescription('na 1990');
        $vtw38->setRoofTypeDescription('vlak dak');

        $vtw39 = new Vtw();
        $vtw39->setCode('WT 27');
        $vtw39->setTypeDescription('trappenhuis-/corridorflat zgn. Urban villa tot en met 4 lagen');
        $vtw39->setBuildingTypeDescription('27');
        $vtw39->setConstructionYearDescription('na 1990');
        $vtw39->setRoofTypeDescription('vlak en hellend dak');

        $vtw40 = new Vtw();
        $vtw40->setCode('WT 28');
        $vtw40->setTypeDescription('trappenhuis-/corridorflat meer dan 4 lagen');
        $vtw40->setBuildingTypeDescription('28');
        $vtw40->setConstructionYearDescription('1950 en 1970');
        $vtw40->setRoofTypeDescription('vlak dak');

        $vtw41 = new Vtw();
        $vtw41->setCode('WT 28R');
        $vtw41->setTypeDescription('renovatie-trappenhuis-/corridorflat meer dan 4 lagen');
        $vtw41->setBuildingTypeDescription('28R');
        $vtw41->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw41->setRoofTypeDescription('vlak dak');

        $vtw42 = new Vtw();
        $vtw42->setCode('WT 29');
        $vtw42->setTypeDescription('trappenhuis-/corridorflat meer dan 4 lagen');
        $vtw42->setBuildingTypeDescription('29');
        $vtw42->setConstructionYearDescription('tussen 1970 en 1990');
        $vtw42->setRoofTypeDescription('vlak dak');

        $vtw43 = new Vtw();
        $vtw43->setCode('WT 30');
        $vtw43->setTypeDescription('trappenhuis-/corridorflat meer dan 4 lagen');
        $vtw43->setBuildingTypeDescription('30');
        $vtw43->setConstructionYearDescription('na 1990');
        $vtw43->setRoofTypeDescription('vlak dak');

        $vtw44 = new Vtw();
        $vtw44->setCode('WT 31');
        $vtw44->setTypeDescription('galerijflat tot en met 2 lagen');
        $vtw44->setBuildingTypeDescription('31');
        $vtw44->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw44->setRoofTypeDescription('vlak dak');

        $vtw45 = new Vtw();
        $vtw45->setCode('WT 32');
        $vtw45->setTypeDescription('galerijflat tot en met 4 lagen');
        $vtw45->setBuildingTypeDescription('32');
        $vtw45->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw45->setRoofTypeDescription('vlak dak');

        $vtw46 = new Vtw();
        $vtw46->setCode('WT 32R');
        $vtw46->setTypeDescription('renovatie galerijflat tot en met 4 lagen');
        $vtw46->setBuildingTypeDescription('32R');
        $vtw46->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw46->setRoofTypeDescription('vlak dak');

        $vtw47 = new Vtw();
        $vtw47->setCode('WT 33');
        $vtw47->setTypeDescription('galerijflat tot en met 4 lagen');
        $vtw47->setBuildingTypeDescription('33');
        $vtw47->setConstructionYearDescription('tussen 1970 en 1990');
        $vtw47->setRoofTypeDescription('vlak dak');

        $vtw48 = new Vtw();
        $vtw48->setCode('WT 34');
        $vtw48->setTypeDescription('galerijflat tot en met 4 lagen');
        $vtw48->setBuildingTypeDescription('34');
        $vtw48->setConstructionYearDescription('na 1970');
        $vtw48->setRoofTypeDescription('vlak dak');

        $vtw49 = new Vtw();
        $vtw49->setCode('WT 35');
        $vtw49->setTypeDescription('galerijflat meer dan 4 lagen');
        $vtw49->setBuildingTypeDescription('35');
        $vtw49->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw49->setRoofTypeDescription('vlak dak');

        $vtw50 = new Vtw();
        $vtw50->setCode('WT 35R');
        $vtw50->setTypeDescription('renovatie galerijflat meer dan 4 lagen');
        $vtw50->setBuildingTypeDescription('35R');
        $vtw50->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw50->setRoofTypeDescription('vlak dak');

        $vtw51 = new Vtw();
        $vtw51->setCode('WT 36');
        $vtw51->setTypeDescription('galerijflat meer dan 4 lagen');
        $vtw51->setBuildingTypeDescription('36');
        $vtw51->setConstructionYearDescription('tussen 1970 en 1990');
        $vtw51->setRoofTypeDescription('vlak dak');

        $vtw52 = new Vtw();
        $vtw52->setCode('WT 37');
        $vtw52->setTypeDescription('galerijflat meer dan 4 lagen');
        $vtw52->setBuildingTypeDescription('37');
        $vtw52->setConstructionYearDescription('na 1990');
        $vtw52->setRoofTypeDescription('vlak dak');

        $vtw53 = new Vtw();
        $vtw53->setCode('WT 38R');
        $vtw53->setTypeDescription('renovatie galerijmaisonnette meer dan 4 lagen');
        $vtw53->setBuildingTypeDescription('38R');
        $vtw53->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw53->setRoofTypeDescription('vlak dak');

        $vtw54 = new Vtw();
        $vtw54->setCode('WT 39R');
        $vtw54->setTypeDescription('renovatie eengezinswoning');
        $vtw54->setBuildingTypeDescription('39R');
        $vtw54->setConstructionYearDescription('voor 1950');
        $vtw54->setRoofTypeDescription('hellend dak');

        $vtw55 = new Vtw();
        $vtw55->setCode('WT 40');
        $vtw55->setTypeDescription('luxe appartementencomplex meer dan 4 lagen');
        $vtw55->setBuildingTypeDescription('40');
        $vtw55->setConstructionYearDescription('na 2000');
        $vtw55->setRoofTypeDescription('vlak dak');

        $vtw56 = new Vtw();
        $vtw56->setCode('WT 41');
        $vtw56->setTypeDescription('bovenwoning');
        $vtw56->setBuildingTypeDescription('41');
        $vtw56->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw56->setRoofTypeDescription('vlak dak');

        $vtw57 = new Vtw();
        $vtw57->setCode('WT 42');
        $vtw57->setTypeDescription('vinexwoning');
        $vtw57->setBuildingTypeDescription('42');
        $vtw57->setConstructionYearDescription('na 1990');
        $vtw57->setRoofTypeDescription('vlak dak');

        $vtw58 = new Vtw();
        $vtw58->setCode('WT 43');
        $vtw58->setTypeDescription('galerijflat 2 lagen');
        $vtw58->setBuildingTypeDescription('43');
        $vtw58->setConstructionYearDescription('na 1990');
        $vtw58->setRoofTypeDescription('hellend dak');

        $vtw59 = new Vtw();
        $vtw59->setCode('WT 44');
        $vtw59->setTypeDescription('appartementen in grachtenpand');
        $vtw59->setBuildingTypeDescription('44');
        $vtw59->setConstructionYearDescription('voor 1900');
        $vtw59->setRoofTypeDescription('vlak en hellend dak');

        $vtw60 = new Vtw();
        $vtw60->setCode('WT 45');
        $vtw60->setTypeDescription('eengezinswoning');
        $vtw60->setBuildingTypeDescription('45');
        $vtw60->setConstructionYearDescription('na 2000');
        $vtw60->setRoofTypeDescription('vlak dak');

        $vtw61 = new Vtw();
        $vtw61->setCode('WT 46');
        $vtw61->setTypeDescription('eengezinswoning');
        $vtw61->setBuildingTypeDescription('46');
        $vtw61->setConstructionYearDescription('na 2000');
        $vtw61->setRoofTypeDescription('vlak dak');

        $vtw62 = new Vtw();
        $vtw62->setCode('WT 47');
        $vtw62->setTypeDescription('eengezinswoning');
        $vtw62->setBuildingTypeDescription('47');
        $vtw62->setConstructionYearDescription('na 2000');
        $vtw62->setRoofTypeDescription('hellend dak');

        $vtw63 = new Vtw();
        $vtw63->setCode('WT 48R');
        $vtw63->setTypeDescription('Renovatie eengezinswoning');
        $vtw63->setBuildingTypeDescription('48R');
        $vtw63->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw63->setRoofTypeDescription('hellend dak');

        $vtw64 = new Vtw();
        $vtw64->setCode('WT 49');
        $vtw64->setTypeDescription('duurzame eengezinswoning');
        $vtw64->setBuildingTypeDescription('49');
        $vtw64->setConstructionYearDescription('na 2015');
        $vtw64->setRoofTypeDescription('hellend dak');

        $vtw65 = new Vtw();
        $vtw65->setCode('WT 50');
        $vtw65->setTypeDescription('duurzame galerij appartementen');
        $vtw65->setBuildingTypeDescription('50');
        $vtw65->setConstructionYearDescription('na 2015');
        $vtw65->setRoofTypeDescription('vlak dak');

        $vtw66 = new Vtw();
        $vtw66->setCode('WT 51R');
        $vtw66->setTypeDescription('renovatie eengezinswoning nul op de meter');
        $vtw66->setBuildingTypeDescription('51R');
        $vtw66->setConstructionYearDescription('tussen 1970 en 1990');
        $vtw66->setRoofTypeDescription('hellend dak');

        $vtw67 = new Vtw();
        $vtw67->setCode('WT 52');
        $vtw67->setTypeDescription('energieneutrale eengezinswoning nul op de meter');
        $vtw67->setBuildingTypeDescription('52');
        $vtw67->setConstructionYearDescription('na 2016');
        $vtw67->setRoofTypeDescription('hellend dak');

        $vtw68 = new Vtw();
        $vtw68->setCode('WT 135');
        $vtw68->setTypeDescription('energieneutrale appartementencomplex nul op de meter');
        $vtw68->setBuildingTypeDescription('135');
        $vtw68->setConstructionYearDescription('na 2019');
        $vtw68->setRoofTypeDescription('vlak dak');

        $vtw80 = new Vtw();
        $vtw80->setCode('GT 1');
        $vtw80->setTypeDescription('aangebouwde garagebox');
        $vtw80->setBuildingTypeDescription('1');
        $vtw80->setConstructionYearDescription('nvt');
        $vtw80->setRoofTypeDescription('hellend dak');

        $vtw81 = new Vtw();
        $vtw81->setCode('GT 2');
        $vtw81->setTypeDescription('aangebouwde garagebox');
        $vtw81->setBuildingTypeDescription('2');
        $vtw81->setConstructionYearDescription('nvt');
        $vtw81->setRoofTypeDescription('vlak dak');

        $vtw82 = new Vtw();
        $vtw82->setCode('GT 3');
        $vtw82->setTypeDescription('vrijstaande garagebox');
        $vtw82->setBuildingTypeDescription('3');
        $vtw82->setConstructionYearDescription('nvt');
        $vtw82->setRoofTypeDescription('vlak dak');

        $vtw83 = new Vtw();
        $vtw83->setCode('GT 4');
        $vtw83->setTypeDescription('garagebox in rij');
        $vtw83->setBuildingTypeDescription('4');
        $vtw83->setConstructionYearDescription('nvt');
        $vtw83->setRoofTypeDescription('vlak dak');

        $vtw84 = new Vtw();
        $vtw84->setCode('GT 5');
        $vtw84->setTypeDescription('garagebox onder gebouw');
        $vtw84->setBuildingTypeDescription('5');
        $vtw84->setConstructionYearDescription('nvt');
        $vtw84->setRoofTypeDescription('nvt');

        $vtw85 = new Vtw();
        $vtw85->setCode('GT 6');
        $vtw85->setTypeDescription('garagebox ondergronds');
        $vtw85->setBuildingTypeDescription('6');
        $vtw85->setConstructionYearDescription('nvt');
        $vtw85->setRoofTypeDescription('nvt');

        $vtw86 = new Vtw();
        $vtw86->setCode('GT 7');
        $vtw86->setTypeDescription('garagebox bovengronds');
        $vtw86->setBuildingTypeDescription('7');
        $vtw86->setConstructionYearDescription('nvt');
        $vtw86->setRoofTypeDescription('nvt');

        $vtw90 = new Vtw();
        $vtw90->setCode('KT 1');
        $vtw90->setTypeDescription('grachtenpand gevel(s) in metselwerk');
        $vtw90->setBuildingTypeDescription('1');
        $vtw90->setConstructionYearDescription('nvt');
        $vtw90->setRoofTypeDescription('nvt');

        $vtw91 = new Vtw();
        $vtw91->setCode('KT 2');
        $vtw91->setTypeDescription('grachtenpand gevel(s) gestukadoord en geschilderd');
        $vtw91->setBuildingTypeDescription('2');
        $vtw91->setConstructionYearDescription('nvt');
        $vtw91->setRoofTypeDescription('nvt');

        $vtw92 = new Vtw();
        $vtw92->setCode('KT 3');
        $vtw92->setTypeDescription('klassieke (monumentale) kantoorvilla gevel(s) in metselwerk');
        $vtw92->setBuildingTypeDescription('3');
        $vtw92->setConstructionYearDescription('nvt');
        $vtw92->setRoofTypeDescription('nvt');

        $vtw93 = new Vtw();
        $vtw93->setCode('KT 4');
        $vtw93->setTypeDescription('klassieke (monumentale) kantoorvilla gevel(s) gestukadoord en geschilderd');
        $vtw93->setBuildingTypeDescription('4');
        $vtw93->setConstructionYearDescription('nvt');
        $vtw93->setRoofTypeDescription('nvt');

        $vtw94 = new Vtw();
        $vtw94->setCode('KT 5');
        $vtw94->setTypeDescription('middelhoog jaren zestig-zeventig bouw gevel(s) in metselwerk');
        $vtw94->setBuildingTypeDescription('5');
        $vtw94->setConstructionYearDescription('nvt');
        $vtw94->setRoofTypeDescription('nvt');

        $vtw95 = new Vtw();
        $vtw95->setCode('KT 6');
        $vtw95->setTypeDescription('middelhoog jaren zestig-zeventig bouw gevel(s) in beton');
        $vtw95->setBuildingTypeDescription('6');
        $vtw95->setConstructionYearDescription('nvt');
        $vtw95->setRoofTypeDescription('nvt');

        $vtw96 = new Vtw();
        $vtw96->setCode('KT 7');
        $vtw96->setTypeDescription('laag gevel(s) in metselwerk');
        $vtw96->setBuildingTypeDescription('7');
        $vtw96->setConstructionYearDescription('nvt');
        $vtw96->setRoofTypeDescription('nvt');

        $vtw97 = new Vtw();
        $vtw97->setCode('KT 8');
        $vtw97->setTypeDescription('laag vliesgevel(s)');
        $vtw97->setBuildingTypeDescription('8');
        $vtw97->setConstructionYearDescription('nvt');
        $vtw97->setRoofTypeDescription('nvt');

        $vtw98 = new Vtw();
        $vtw98->setCode('KT 9');
        $vtw98->setTypeDescription('laag gevel(s) in natuursteen');
        $vtw98->setBuildingTypeDescription('9');
        $vtw98->setConstructionYearDescription('nvt');
        $vtw98->setRoofTypeDescription('nvt');

        $vtw99 = new Vtw();
        $vtw99->setCode('KT 10');
        $vtw99->setTypeDescription('laag gevel(s) in beton');
        $vtw99->setBuildingTypeDescription('10');
        $vtw99->setConstructionYearDescription('nvt');
        $vtw99->setRoofTypeDescription('nvt');

        $vtw100 = new Vtw();
        $vtw100->setCode('KT 11');
        $vtw100->setTypeDescription('laag gevel(s) in metaal');
        $vtw100->setBuildingTypeDescription('11');
        $vtw100->setConstructionYearDescription('nvt');
        $vtw100->setRoofTypeDescription('nvt');

        $vtw101 = new Vtw();
        $vtw101->setCode('KT 12');
        $vtw101->setTypeDescription('middelhoog gevel(s) metselwerk');
        $vtw101->setBuildingTypeDescription('12');
        $vtw101->setConstructionYearDescription('nvt');
        $vtw101->setRoofTypeDescription('nvt');

        $vtw102 = new Vtw();
        $vtw102->setCode('KT 13');
        $vtw102->setTypeDescription('middelhoog vliesgevel(s)');
        $vtw102->setBuildingTypeDescription('13');
        $vtw102->setConstructionYearDescription('nvt');
        $vtw102->setRoofTypeDescription('nvt');

        $vtw103 = new Vtw();
        $vtw103->setCode('KT 14');
        $vtw103->setTypeDescription('middelhoog gevel(s) in natuursteen');
        $vtw103->setBuildingTypeDescription('14');
        $vtw103->setConstructionYearDescription('nvt');
        $vtw103->setRoofTypeDescription('nvt');

        $vtw104 = new Vtw();
        $vtw104->setCode('KT 15');
        $vtw104->setTypeDescription('middelhoog gevel(s) in beton');
        $vtw104->setBuildingTypeDescription('15');
        $vtw104->setConstructionYearDescription('nvt');
        $vtw104->setRoofTypeDescription('nvt');

        $vtw105 = new Vtw();
        $vtw105->setCode('KT 16');
        $vtw105->setTypeDescription('middelhoog gevel(s) in metaal');
        $vtw105->setBuildingTypeDescription('16');
        $vtw105->setConstructionYearDescription('nvt');
        $vtw105->setRoofTypeDescription('nvt');

        $vtw106 = new Vtw();
        $vtw106->setCode('KT 17');
        $vtw106->setTypeDescription('hoog vliesgevel(s)');
        $vtw106->setBuildingTypeDescription('17');
        $vtw106->setConstructionYearDescription('nvt');
        $vtw106->setRoofTypeDescription('nvt');

        $vtw107 = new Vtw();
        $vtw107->setCode('KT 18');
        $vtw107->setTypeDescription('hoog gevel(s) in natuursteen');
        $vtw107->setBuildingTypeDescription('18');
        $vtw107->setConstructionYearDescription('nvt');
        $vtw107->setRoofTypeDescription('nvt');

        $vtw108 = new Vtw();
        $vtw108->setCode('KT 19');
        $vtw108->setTypeDescription('hoog gevel(s) in beton');
        $vtw108->setBuildingTypeDescription('19');
        $vtw108->setConstructionYearDescription('nvt');
        $vtw108->setRoofTypeDescription('nvt');

        $vtw109 = new Vtw();
        $vtw109->setCode('KT 20');
        $vtw109->setTypeDescription('hoog gevel(s) in metaal');
        $vtw109->setBuildingTypeDescription('20');
        $vtw109->setConstructionYearDescription('nvt');
        $vtw109->setRoofTypeDescription('nvt');

        $vtw110 = new Vtw();
        $vtw110->setCode('KT 21');
        $vtw110->setTypeDescription('kleinschalige kantoorvilla eigentijds moderne architectuur gevel(s) in metselwerk');
        $vtw110->setBuildingTypeDescription('21');
        $vtw110->setConstructionYearDescription('nvt');
        $vtw110->setRoofTypeDescription('nvt');

        $vtw111 = new Vtw();
        $vtw111->setCode('KT 22');
        $vtw111->setTypeDescription('kleinschalige kantoorvilla eigentijds moderne architectuur gevel(s) in isolatiestukwerk');
        $vtw111->setBuildingTypeDescription('22');
        $vtw111->setConstructionYearDescription('nvt');
        $vtw111->setRoofTypeDescription('nvt');

        $vtw112 = new Vtw();
        $vtw112->setCode('KT 23');
        $vtw112->setTypeDescription('kleinschalige kantoorvilla eigentijds moderne architectuur in natuursteen');
        $vtw112->setBuildingTypeDescription('23');
        $vtw112->setConstructionYearDescription('nvt');
        $vtw112->setRoofTypeDescription('nvt');

        $vtw113 = new Vtw();
        $vtw113->setCode('KT 24');
        $vtw113->setTypeDescription('kleinschalige kantoorvilla eigentijds moderne architectuur in metaal ');
        $vtw113->setBuildingTypeDescription('24');
        $vtw113->setConstructionYearDescription('nvt');
        $vtw113->setRoofTypeDescription('nvt');

        $vtw114 = new Vtw();
        $vtw114->setCode('KT 25');
        $vtw114->setTypeDescription('kleinschalige kantoorvilla eigentijds moderne architectuur in beton');
        $vtw114->setBuildingTypeDescription('25');
        $vtw114->setConstructionYearDescription('nvt');
        $vtw114->setRoofTypeDescription('nvt');

        $vtw115 = new Vtw();
        $vtw115->setCode('KT 26');
        $vtw115->setTypeDescription('middelhoog eigetijds klassieke architectuur gevel(s) in metselwerk');
        $vtw115->setBuildingTypeDescription('26');
        $vtw115->setConstructionYearDescription('nvt');
        $vtw115->setRoofTypeDescription('nvt');

        $vtw116 = new Vtw();
        $vtw116->setCode('KT 27');
        $vtw116->setTypeDescription('laag gevel(s) in metselwerk inclusief parkeergarage');
        $vtw116->setBuildingTypeDescription('27');
        $vtw116->setConstructionYearDescription('nvt');
        $vtw116->setRoofTypeDescription('nvt');

        $vtw117 = new Vtw();
        $vtw117->setCode('KT 28R');
        $vtw117->setTypeDescription('Revitalisatie kantoorgebouw middelhoog gevels in sierbeton elementen');
        $vtw117->setBuildingTypeDescription('28R');
        $vtw117->setConstructionYearDescription('nvt');
        $vtw117->setRoofTypeDescription('nvt');

        $vtw118 = new Vtw();
        $vtw118->setCode('KT 40');
        $vtw118->setTypeDescription('energieneutraal kantoorgebouw nul op de meter duurzaam gebouw onder moderne architectuur');
        $vtw118->setBuildingTypeDescription('40');
        $vtw118->setConstructionYearDescription('nvt');
        $vtw118->setRoofTypeDescription('nvt');

        $vtw120 = new Vtw();
        $vtw120->setCode('BT 1');
        $vtw120->setTypeDescription('kleinschalig gevel(s) in metselwerk');
        $vtw120->setBuildingTypeDescription('1');
        $vtw120->setConstructionYearDescription('nvt');
        $vtw120->setRoofTypeDescription('nvt');

        $vtw121 = new Vtw();
        $vtw121->setCode('BT 2');
        $vtw121->setTypeDescription('kleinschalig gevel(s) in metaal');
        $vtw121->setBuildingTypeDescription('2');
        $vtw121->setConstructionYearDescription('nvt');
        $vtw121->setRoofTypeDescription('nvt');

        $vtw122 = new Vtw();
        $vtw122->setCode('BT 3');
        $vtw122->setTypeDescription('kleinschalig gevel(s) in metselwerk/metaal');
        $vtw122->setBuildingTypeDescription('3');
        $vtw122->setConstructionYearDescription('nvt');
        $vtw122->setRoofTypeDescription('nvt');

        $vtw123 = new Vtw();
        $vtw123->setCode('BT 4');
        $vtw123->setTypeDescription('middelschalig gevel(s) in metselwerk');
        $vtw123->setBuildingTypeDescription('4');
        $vtw123->setConstructionYearDescription('nvt');
        $vtw123->setRoofTypeDescription('nvt');

        $vtw124 = new Vtw();
        $vtw124->setCode('BT 5');
        $vtw124->setTypeDescription('middelschalig gevel(s) in metaal');
        $vtw124->setBuildingTypeDescription('5');
        $vtw124->setConstructionYearDescription('nvt');
        $vtw124->setRoofTypeDescription('nvt');

        $vtw125 = new Vtw();
        $vtw125->setCode('BT 6');
        $vtw125->setTypeDescription('middelschalig gevel(s) in metselwerk/metaal');
        $vtw125->setBuildingTypeDescription('6');
        $vtw125->setConstructionYearDescription('nvt');
        $vtw125->setRoofTypeDescription('nvt');

        $vtw126 = new Vtw();
        $vtw126->setCode('BT 7');
        $vtw126->setTypeDescription('grootschalig gevel(s) in metselwerk');
        $vtw126->setBuildingTypeDescription('7');
        $vtw126->setConstructionYearDescription('nvt');
        $vtw126->setRoofTypeDescription('nvt');

        $vtw127 = new Vtw();
        $vtw127->setCode('BT 8');
        $vtw127->setTypeDescription('grootschalig gevel(s) in metaal');
        $vtw127->setBuildingTypeDescription('8');
        $vtw127->setConstructionYearDescription('nvt');
        $vtw127->setRoofTypeDescription('nvt');

        $vtw128 = new Vtw();
        $vtw128->setCode('BT 9');
        $vtw128->setTypeDescription('grootschalig gevel(s) in metselwerk/metaal');
        $vtw128->setBuildingTypeDescription('9');
        $vtw128->setConstructionYearDescription('nvt');
        $vtw128->setRoofTypeDescription('nvt');

        $vtw129 = new Vtw();
        $vtw129->setCode('BT 10');
        $vtw129->setTypeDescription('klein- tot grootschailg gevel(s) en dak in metaal');
        $vtw129->setBuildingTypeDescription('10');
        $vtw129->setConstructionYearDescription('nvt');
        $vtw129->setRoofTypeDescription('nvt');

        $vtw130 = new Vtw();
        $vtw130->setCode('BT 11');
        $vtw130->setTypeDescription('combinatiegebouw met showroom/serviceruimte kantoor en bedrijfsruimte');
        $vtw130->setBuildingTypeDescription('11');
        $vtw130->setConstructionYearDescription('nvt');
        $vtw130->setRoofTypeDescription('nvt');

        $vtw131 = new Vtw();
        $vtw131->setCode('BT 12');
        $vtw131->setTypeDescription('bedrijfsverzamelgebouw');
        $vtw131->setBuildingTypeDescription('12');
        $vtw131->setConstructionYearDescription('nvt');
        $vtw131->setRoofTypeDescription('nvt');

        $vtw132 = new Vtw();
        $vtw132->setCode('BT 13');
        $vtw132->setTypeDescription('kleinschalig distrubutiecentrum');
        $vtw132->setBuildingTypeDescription('13');
        $vtw132->setConstructionYearDescription('nvt');
        $vtw132->setRoofTypeDescription('nvt');

        $vtw133 = new Vtw();
        $vtw133->setCode('BT 14');
        $vtw133->setTypeDescription('grootschalig distrubutiecentrum');
        $vtw133->setBuildingTypeDescription('14');
        $vtw133->setConstructionYearDescription('nvt');
        $vtw133->setRoofTypeDescription('nvt');

        $vtw134 = new Vtw();
        $vtw134->setCode('BT 15');
        $vtw134->setTypeDescription('garagebedrijf met showroom en kantoren');
        $vtw134->setBuildingTypeDescription('15');
        $vtw134->setConstructionYearDescription('nvt');
        $vtw134->setRoofTypeDescription('nvt');

        $vtw135 = new Vtw();
        $vtw135->setCode('BT 16');
        $vtw135->setTypeDescription('bedrijfsverzamelgebouw prefab betonbouw');
        $vtw135->setBuildingTypeDescription('16');
        $vtw135->setConstructionYearDescription('nvt');
        $vtw135->setRoofTypeDescription('nvt');

        $vtw140 = new Vtw();
        $vtw140->setCode('WINT 1');
        $vtw140->setTypeDescription('individuele winkel / winkel in winkelstraat ouder type');
        $vtw140->setBuildingTypeDescription('1');
        $vtw140->setConstructionYearDescription('nvt');
        $vtw140->setRoofTypeDescription('nvt');

        $vtw141 = new Vtw();
        $vtw141->setCode('WINT 2');
        $vtw141->setTypeDescription('individuele winkel / winkel in winkelstraat recenter type');
        $vtw141->setBuildingTypeDescription('2');
        $vtw141->setConstructionYearDescription('nvt');
        $vtw141->setRoofTypeDescription('nvt');

        $vtw142 = new Vtw();
        $vtw142->setCode('WINT 3');
        $vtw142->setTypeDescription('winkel in het centrum niet dekt ouder type');
        $vtw142->setBuildingTypeDescription('3');
        $vtw142->setConstructionYearDescription('nvt');
        $vtw142->setRoofTypeDescription('nvt');

        $vtw143 = new Vtw();
        $vtw143->setCode('WINT 4');
        $vtw143->setTypeDescription('winkel in het centrum niet dekt recenter type');
        $vtw143->setBuildingTypeDescription('4');
        $vtw143->setConstructionYearDescription('nvt');
        $vtw143->setRoofTypeDescription('nvt');

        $vtw144 = new Vtw();
        $vtw144->setCode('WINT 5');
        $vtw144->setTypeDescription('winkel in het centrum overdekt ouder type');
        $vtw144->setBuildingTypeDescription('5');
        $vtw144->setConstructionYearDescription('nvt');
        $vtw144->setRoofTypeDescription('nvt');

        $vtw145 = new Vtw();
        $vtw145->setCode('WINT 6');
        $vtw145->setTypeDescription('winkel in het centrum overdekt recenter type');
        $vtw145->setBuildingTypeDescription('6');
        $vtw145->setConstructionYearDescription('nvt');
        $vtw145->setRoofTypeDescription('nvt');

        $vtw146 = new Vtw();
        $vtw146->setCode('WINT 7');
        $vtw146->setTypeDescription('kiosk');
        $vtw146->setBuildingTypeDescription('7');
        $vtw146->setConstructionYearDescription('nvt');
        $vtw146->setRoofTypeDescription('nvt');

        $vtw147 = new Vtw();
        $vtw147->setCode('WINT 8');
        $vtw147->setTypeDescription('solitaire supermakrt');
        $vtw147->setBuildingTypeDescription('8');
        $vtw147->setConstructionYearDescription('nvt');
        $vtw147->setRoofTypeDescription('nvt');

        $vtw148 = new Vtw();
        $vtw148->setCode('WINT 9');
        $vtw148->setTypeDescription('grootschalige detailhandelsunit');
        $vtw148->setBuildingTypeDescription('9');
        $vtw148->setConstructionYearDescription('nvt');
        $vtw148->setRoofTypeDescription('nvt');

        $vtw149 = new Vtw();
        $vtw149->setCode('WINT 10');
        $vtw149->setTypeDescription('perifere grootschalige detailhandelsunit');
        $vtw149->setBuildingTypeDescription('10');
        $vtw149->setConstructionYearDescription('nvt');
        $vtw149->setRoofTypeDescription('nvt');

        $vtw150 = new Vtw();
        $vtw150->setCode('WINT 11');
        $vtw150->setTypeDescription('bouwmarkt');
        $vtw150->setBuildingTypeDescription('11');
        $vtw150->setConstructionYearDescription('nvt');
        $vtw150->setRoofTypeDescription('nvt');

        $vtw151 = new Vtw();
        $vtw151->setCode('WINT 23');
        $vtw151->setTypeDescription('energieneutraal solitaire supermarkt nul op de meter');
        $vtw151->setBuildingTypeDescription('23');
        $vtw151->setConstructionYearDescription('nvt');
        $vtw151->setRoofTypeDescription('nvt');

        $vtw160 = new Vtw();
        $vtw160->setCode('HT 1R');
        $vtw160->setTypeDescription('voormalig schoolgebouw');
        $vtw160->setBuildingTypeDescription('1R');
        $vtw160->setConstructionYearDescription('tussen 1900 en 1930');
        $vtw160->setRoofTypeDescription('nvt');

        $vtw161 = new Vtw();
        $vtw161->setCode('HT 2R');
        $vtw161->setTypeDescription('voormalig kantoorgebouw');
        $vtw161->setBuildingTypeDescription('2R');
        $vtw161->setConstructionYearDescription('tussen 1970 en 1990');
        $vtw161->setRoofTypeDescription('nvt');

        $vtw162 = new Vtw();
        $vtw162->setCode('HT 3R');
        $vtw162->setTypeDescription('voormalig fabrieksgebouw');
        $vtw162->setBuildingTypeDescription('3R');
        $vtw162->setConstructionYearDescription('tussen 1900 en 1930');
        $vtw162->setRoofTypeDescription('nvt');

        $vtw163 = new Vtw();
        $vtw163->setCode('HT 4R');
        $vtw163->setTypeDescription('voormalig jongerencentrum');
        $vtw163->setBuildingTypeDescription('4R');
        $vtw163->setConstructionYearDescription('tussen 1950 en 1970');
        $vtw163->setRoofTypeDescription('nvt');

        $vtw164 = new Vtw();
        $vtw164->setCode('HT 5R');
        $vtw164->setTypeDescription('voormalig kantoorgebouw');
        $vtw164->setBuildingTypeDescription('5R');
        $vtw164->setConstructionYearDescription('nvt');
        $vtw164->setRoofTypeDescription('nvt');

        $vtw170 = new Vtw();
        $vtw170->setCode('OT 1');
        $vtw170->setTypeDescription('café / restaurant');
        $vtw170->setBuildingTypeDescription('1');
        $vtw170->setConstructionYearDescription('nvt');
        $vtw170->setRoofTypeDescription('nvt');

        $vtw171 = new Vtw();
        $vtw171->setCode('OT 2');
        $vtw171->setTypeDescription('hotel kleinschalig');
        $vtw171->setBuildingTypeDescription('2');
        $vtw171->setConstructionYearDescription('nvt');
        $vtw171->setRoofTypeDescription('nvt');

        $vtw172 = new Vtw();
        $vtw172->setCode('OT 3');
        $vtw172->setTypeDescription('hotel grootschalig');
        $vtw172->setBuildingTypeDescription('3');
        $vtw172->setConstructionYearDescription('nvt');
        $vtw172->setRoofTypeDescription('nvt');

        $vtw173 = new Vtw();
        $vtw173->setCode('OT 4');
        $vtw173->setTypeDescription('bioscoop');
        $vtw173->setBuildingTypeDescription('4');
        $vtw173->setConstructionYearDescription('nvt');
        $vtw173->setRoofTypeDescription('nvt');

        $vtw174 = new Vtw();
        $vtw174->setCode('OT 5');
        $vtw174->setTypeDescription('discotheek');
        $vtw174->setBuildingTypeDescription('5');
        $vtw174->setConstructionYearDescription('nvt');
        $vtw174->setRoofTypeDescription('nvt');

        $vtw175 = new Vtw();
        $vtw175->setCode('OT 6');
        $vtw175->setTypeDescription('woon-/zorgcomplex');
        $vtw175->setBuildingTypeDescription('6');
        $vtw175->setConstructionYearDescription('nvt');
        $vtw175->setRoofTypeDescription('nvt');

        $vtw176 = new Vtw();
        $vtw176->setCode('OT 7');
        $vtw176->setTypeDescription('gemeentehuis');
        $vtw176->setBuildingTypeDescription('7');
        $vtw176->setConstructionYearDescription('nvt');
        $vtw176->setRoofTypeDescription('nvt');

        $vtw177 = new Vtw();
        $vtw177->setCode('OT 8');
        $vtw177->setTypeDescription('brandweerkazerne');
        $vtw177->setBuildingTypeDescription('8');
        $vtw177->setConstructionYearDescription('nvt');
        $vtw177->setRoofTypeDescription('nvt');

        $vtw178 = new Vtw();
        $vtw178->setCode('OT 9');
        $vtw178->setTypeDescription('theater middelgroot modern');
        $vtw178->setBuildingTypeDescription('9');
        $vtw178->setConstructionYearDescription('nvt');
        $vtw178->setRoofTypeDescription('nvt');

        $vtw179 = new Vtw();
        $vtw179->setCode('OT 10');
        $vtw179->setTypeDescription('theater kleinscahig');
        $vtw179->setBuildingTypeDescription('10');
        $vtw179->setConstructionYearDescription('nvt');
        $vtw179->setRoofTypeDescription('nvt');

        $vtw180 = new Vtw();
        $vtw180->setCode('OT 11');
        $vtw180->setTypeDescription('kleinschalig woon-/zorgcomplex');
        $vtw180->setBuildingTypeDescription('11');
        $vtw180->setConstructionYearDescription('nvt');
        $vtw180->setRoofTypeDescription('nvt');

        $vtw181 = new Vtw();
        $vtw181->setCode('OT 12');
        $vtw181->setTypeDescription('grootschalig woon-/zorgcomplex');
        $vtw181->setBuildingTypeDescription('12');
        $vtw181->setConstructionYearDescription('nvt');
        $vtw181->setRoofTypeDescription('nvt');

        $vtw190 = new Vtw();
        $vtw190->setCode('AT 1');
        $vtw190->setTypeDescription('woonboederij');
        $vtw190->setBuildingTypeDescription('1');
        $vtw190->setConstructionYearDescription('nvt');
        $vtw190->setRoofTypeDescription('nvt');

        $vtw191 = new Vtw();
        $vtw191->setCode('AT 2');
        $vtw191->setTypeDescription('woonboederij');
        $vtw191->setBuildingTypeDescription('2');
        $vtw191->setConstructionYearDescription('nvt');
        $vtw191->setRoofTypeDescription('nvt');

        $vtw192 = new Vtw();
        $vtw192->setCode('AT 3');
        $vtw192->setTypeDescription('vleesvarkensstal');
        $vtw192->setBuildingTypeDescription('3');
        $vtw192->setConstructionYearDescription('nvt');
        $vtw192->setRoofTypeDescription('nvt');

        $vtw193 = new Vtw();
        $vtw193->setCode('AT 4');
        $vtw193->setTypeDescription('loodsgebouw');
        $vtw193->setBuildingTypeDescription('4');
        $vtw193->setConstructionYearDescription('nvt');
        $vtw193->setRoofTypeDescription('nvt');

        $vtw194 = new Vtw();
        $vtw194->setCode('AT 5');
        $vtw194->setTypeDescription('pluimveestal');
        $vtw194->setBuildingTypeDescription('5');
        $vtw194->setConstructionYearDescription('nvt');
        $vtw194->setRoofTypeDescription('nvt');

        $vtw195 = new Vtw();
        $vtw195->setCode('AT 6');
        $vtw195->setTypeDescription('paardenhouderij');
        $vtw195->setBuildingTypeDescription('6');
        $vtw195->setConstructionYearDescription('nvt');
        $vtw195->setRoofTypeDescription('nvt');

        $vtw196 = new Vtw();
        $vtw196->setCode('AT 7');
        $vtw196->setTypeDescription('melkveestal');
        $vtw196->setBuildingTypeDescription('7');
        $vtw196->setConstructionYearDescription('nvt');
        $vtw196->setRoofTypeDescription('nvt');

        $buildingAddress0 = new BuildingAddress();
        $buildingAddress0->setConstructionYear(1944);
        $buildingAddress0->setRenovationYear(1986);
        $buildingAddress0->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress0->setHouseNumber(6);
        $buildingAddress0->setAddition('E');
        $buildingAddress0->setZipcode('1105BD');
        $buildingAddress0->setCity('Utrecht');
        $buildingAddress0->setRentalUnitNumber('VHE0000');
        $buildingAddress0->setDaeb(true);
        $buildingAddress0->setVtw($vtw1);
        $buildingAddress0->setResidentialArea($residentialArea4);
        $buildingAddress0->setBuildingType($buildingType2);
        $buildingAddress0->setLivingType($livingType6);
        $buildingAddress0->setCreationTime();
        $buildingAddress0->setLastChangeTime();

        $buildingAddress1 = new BuildingAddress();
        $buildingAddress1->setConstructionYear(1944);
        $buildingAddress1->setRenovationYear(1986);
        $buildingAddress1->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress1->setHouseNumber(8);
        $buildingAddress1->setAddition('E');
        $buildingAddress1->setZipcode('1105BC');
        $buildingAddress1->setCity('Utrecht');
        $buildingAddress1->setRentalUnitNumber('VHE0001');
        $buildingAddress1->setDaeb(true);
        $buildingAddress1->setVtw($vtw1);
        $buildingAddress1->setResidentialArea($residentialArea4);
        $buildingAddress1->setBuildingType($buildingType2);
        $buildingAddress1->setLivingType($livingType6);
        $buildingAddress1->setCreationTime();
        $buildingAddress1->setLastChangeTime();

        $buildingAddress2 = new BuildingAddress();
        $buildingAddress2->setConstructionYear(1944);
        $buildingAddress2->setRenovationYear(1986);
        $buildingAddress2->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress2->setHouseNumber(12);
        $buildingAddress2->setAddition('E');
        $buildingAddress2->setZipcode('1105BC');
        $buildingAddress2->setCity('Utrecht');
        $buildingAddress2->setRentalUnitNumber('VHE0002');
        $buildingAddress2->setDaeb(false);
        $buildingAddress2->setVtw($vtw1);
        $buildingAddress2->setResidentialArea($residentialArea4);
        $buildingAddress2->setBuildingType($buildingType2);
        $buildingAddress2->setLivingType($livingType6);
        $buildingAddress2->setCreationTime();
        $buildingAddress2->setLastChangeTime();

        $buildingAddress3 = new BuildingAddress();
        $buildingAddress3->setConstructionYear(1944);
        $buildingAddress3->setRenovationYear(1986);
        $buildingAddress3->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress3->setHouseNumber(6);
        $buildingAddress3->setAddition('D');
        $buildingAddress3->setZipcode('1105BC');
        $buildingAddress3->setCity('Utrecht');
        $buildingAddress3->setRentalUnitNumber('VHE0003');
        $buildingAddress3->setDaeb(true);
        $buildingAddress3->setVtw($vtw1);
        $buildingAddress3->setResidentialArea($residentialArea4);
        $buildingAddress3->setBuildingType($buildingType2);
        $buildingAddress3->setLivingType($livingType6);
        $buildingAddress3->setCreationTime();
        $buildingAddress3->setLastChangeTime();

        $buildingAddress4 = new BuildingAddress();
        $buildingAddress4->setConstructionYear(1944);
        $buildingAddress4->setRenovationYear(1986);
        $buildingAddress4->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress4->setHouseNumber(8);
        $buildingAddress4->setAddition('D');
        $buildingAddress4->setZipcode('1105BC');
        $buildingAddress4->setCity('Utrecht');
        $buildingAddress4->setRentalUnitNumber('VHE0004');
        $buildingAddress4->setDaeb(true);
        $buildingAddress4->setVtw($vtw1);
        $buildingAddress4->setResidentialArea($residentialArea4);
        $buildingAddress4->setBuildingType($buildingType2);
        $buildingAddress4->setLivingType($livingType6);
        $buildingAddress4->setCreationTime();
        $buildingAddress4->setLastChangeTime();

        $buildingAddress5 = new BuildingAddress();
        $buildingAddress5->setConstructionYear(1944);
        $buildingAddress5->setRenovationYear(1986);
        $buildingAddress5->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress5->setHouseNumber(10);
        $buildingAddress5->setAddition('D');
        $buildingAddress5->setZipcode('1105BC');
        $buildingAddress5->setCity('Utrecht');
        $buildingAddress5->setRentalUnitNumber('VHE0005');
        $buildingAddress5->setDaeb(true);
        $buildingAddress5->setVtw($vtw1);
        $buildingAddress5->setResidentialArea($residentialArea4);
        $buildingAddress5->setBuildingType($buildingType2);
        $buildingAddress5->setLivingType($livingType6);
        $buildingAddress5->setCreationTime();
        $buildingAddress5->setLastChangeTime();

        $buildingAddress6 = new BuildingAddress();
        $buildingAddress6->setConstructionYear(1944);
        $buildingAddress6->setRenovationYear(1986);
        $buildingAddress6->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress6->setHouseNumber(12);
        $buildingAddress6->setAddition('D');
        $buildingAddress6->setZipcode('1105BC');
        $buildingAddress6->setCity('Utrecht');
        $buildingAddress6->setRentalUnitNumber('VHE0006');
        $buildingAddress6->setDaeb(true);
        $buildingAddress6->setVtw($vtw1);
        $buildingAddress6->setResidentialArea($residentialArea4);
        $buildingAddress6->setBuildingType($buildingType2);
        $buildingAddress6->setLivingType($livingType6);
        $buildingAddress6->setCreationTime();
        $buildingAddress6->setLastChangeTime();

        $buildingAddress7 = new BuildingAddress();
        $buildingAddress7->setConstructionYear(1944);
        $buildingAddress7->setRenovationYear(1986);
        $buildingAddress7->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress7->setHouseNumber(12);
        $buildingAddress7->setAddition('X');
        $buildingAddress7->setZipcode('1105BB');
        $buildingAddress7->setCity('Utrecht');
        $buildingAddress7->setRentalUnitNumber('VHE0007');
        $buildingAddress7->setDaeb(true);
        $buildingAddress7->setVtw($vtw1);
        $buildingAddress7->setResidentialArea($residentialArea4);
        $buildingAddress7->setBuildingType($buildingType2);
        $buildingAddress7->setLivingType($livingType6);
        $buildingAddress7->setCreationTime();
        $buildingAddress7->setLastChangeTime();

        $buildingAddress8 = new BuildingAddress();
        $buildingAddress8->setConstructionYear(1944);
        $buildingAddress8->setRenovationYear(1986);
        $buildingAddress8->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress8->setHouseNumber(14);
        $buildingAddress8->setAddition('X');
        $buildingAddress8->setZipcode('1105BB');
        $buildingAddress8->setCity('Utrecht');
        $buildingAddress8->setRentalUnitNumber('VHE0008');
        $buildingAddress8->setDaeb(true);
        $buildingAddress8->setVtw($vtw1);
        $buildingAddress8->setResidentialArea($residentialArea4);
        $buildingAddress8->setBuildingType($buildingType2);
        $buildingAddress8->setLivingType($livingType6);
        $buildingAddress8->setCreationTime();
        $buildingAddress8->setLastChangeTime();

        $buildingAddress9 = new BuildingAddress();
        $buildingAddress9->setConstructionYear(1944);
        $buildingAddress9->setRenovationYear(1986);
        $buildingAddress9->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress9->setHouseNumber(16);
        $buildingAddress9->setAddition('X');
        $buildingAddress9->setZipcode('1105BB');
        $buildingAddress9->setCity('Utrecht');
        $buildingAddress9->setRentalUnitNumber('VHE0009');
        $buildingAddress9->setDaeb(true);
        $buildingAddress9->setVtw($vtw19);
        $buildingAddress9->setResidentialArea($residentialArea4);
        $buildingAddress9->setBuildingType($buildingType2);
        $buildingAddress9->setLivingType($livingType6);
        $buildingAddress9->setCreationTime();
        $buildingAddress9->setLastChangeTime();

        $buildingAddress10 = new BuildingAddress();
        $buildingAddress10->setConstructionYear(1944);
        $buildingAddress10->setRenovationYear(1986);
        $buildingAddress10->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress10->setHouseNumber(18);
        $buildingAddress10->setAddition('X');
        $buildingAddress10->setZipcode('1105BB');
        $buildingAddress10->setCity('Utrecht');
        $buildingAddress10->setRentalUnitNumber('VHE0010');
        $buildingAddress10->setDaeb(true);
        $buildingAddress10->setVtw($vtw1);
        $buildingAddress10->setResidentialArea($residentialArea4);
        $buildingAddress10->setBuildingType($buildingType2);
        $buildingAddress10->setLivingType($livingType6);
        $buildingAddress10->setCreationTime();
        $buildingAddress10->setLastChangeTime();

        $buildingAddress11 = new BuildingAddress();
        $buildingAddress11->setConstructionYear(1944);
        $buildingAddress11->setRenovationYear(1986);
        $buildingAddress11->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress11->setHouseNumber(20);
        $buildingAddress11->setAddition('X');
        $buildingAddress11->setZipcode('1105BB');
        $buildingAddress11->setCity('Utrecht');
        $buildingAddress11->setRentalUnitNumber('VHE0011');
        $buildingAddress11->setDaeb(true);
        $buildingAddress11->setVtw($vtw1);
        $buildingAddress11->setResidentialArea($residentialArea4);
        $buildingAddress11->setBuildingType($buildingType2);
        $buildingAddress11->setLivingType($livingType6);
        $buildingAddress11->setCreationTime();
        $buildingAddress11->setLastChangeTime();

        $buildingAddress12 = new BuildingAddress();
        $buildingAddress12->setConstructionYear(1944);
        $buildingAddress12->setRenovationYear(1986);
        $buildingAddress12->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress12->setHouseNumber(6);
        $buildingAddress12->setAddition('B');
        $buildingAddress12->setZipcode('1105BB');
        $buildingAddress12->setCity('Utrecht');
        $buildingAddress12->setRentalUnitNumber('VHE0012');
        $buildingAddress12->setDaeb(true);
        $buildingAddress12->setVtw($vtw1);
        $buildingAddress12->setResidentialArea($residentialArea4);
        $buildingAddress12->setBuildingType($buildingType2);
        $buildingAddress12->setLivingType($livingType6);
        $buildingAddress12->setCreationTime();
        $buildingAddress12->setLastChangeTime();

        $buildingAddress13 = new BuildingAddress();
        $buildingAddress13->setConstructionYear(1944);
        $buildingAddress13->setRenovationYear(1986);
        $buildingAddress13->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress13->setHouseNumber(8);
        $buildingAddress13->setAddition('B');
        $buildingAddress13->setZipcode('1105BB');
        $buildingAddress13->setCity('Utrecht');
        $buildingAddress13->setRentalUnitNumber('VHE0013');
        $buildingAddress13->setDaeb(false);
        $buildingAddress13->setVtw($vtw5);
        $buildingAddress13->setResidentialArea($residentialArea4);
        $buildingAddress13->setBuildingType($buildingType2);
        $buildingAddress13->setLivingType($livingType6);
        $buildingAddress13->setCreationTime();
        $buildingAddress13->setLastChangeTime();


        $buildingAddress14 = new BuildingAddress();
        $buildingAddress14->setConstructionYear(1944);
        $buildingAddress14->setRenovationYear(1986);
        $buildingAddress14->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress14->setHouseNumber(10);
        $buildingAddress14->setAddition('B');
        $buildingAddress14->setZipcode('1105BB');
        $buildingAddress14->setCity('Utrecht');
        $buildingAddress14->setRentalUnitNumber('VHE0014');
        $buildingAddress14->setDaeb(true);
        $buildingAddress14->setVtw($vtw1);
        $buildingAddress14->setResidentialArea($residentialArea4);
        $buildingAddress14->setBuildingType($buildingType2);
        $buildingAddress14->setLivingType($livingType6);
        $buildingAddress14->setCreationTime();
        $buildingAddress14->setLastChangeTime();

        $buildingAddress15 = new BuildingAddress();
        $buildingAddress15->setConstructionYear(1944);
        $buildingAddress15->setRenovationYear(1986);
        $buildingAddress15->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress15->setHouseNumber(12);
        $buildingAddress15->setAddition('B');
        $buildingAddress15->setZipcode('1105BB');
        $buildingAddress15->setCity('Utrecht');
        $buildingAddress15->setRentalUnitNumber('VHE0015');
        $buildingAddress15->setDaeb(true);
        $buildingAddress15->setVtw($vtw1);
        $buildingAddress15->setResidentialArea($residentialArea4);
        $buildingAddress15->setBuildingType($buildingType2);
        $buildingAddress15->setLivingType($livingType6);
        $buildingAddress15->setCreationTime();
        $buildingAddress15->setLastChangeTime();

        $buildingAddress16 = new BuildingAddress();
        $buildingAddress16->setConstructionYear(1944);
        $buildingAddress16->setRenovationYear(1986);
        $buildingAddress16->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress16->setHouseNumber(6);
        $buildingAddress16->setAddition('Bis');
        $buildingAddress16->setZipcode('1105BB');
        $buildingAddress16->setCity('Utrecht');
        $buildingAddress16->setRentalUnitNumber('VHE0016');
        $buildingAddress16->setDaeb(true);
        $buildingAddress16->setVtw($vtw1);
        $buildingAddress16->setResidentialArea($residentialArea4);
        $buildingAddress16->setBuildingType($buildingType2);
        $buildingAddress16->setLivingType($livingType6);
        $buildingAddress16->setCreationTime();
        $buildingAddress16->setLastChangeTime();

        $buildingAddress17 = new BuildingAddress();
        $buildingAddress17->setConstructionYear(1944);
        $buildingAddress17->setRenovationYear(1986);
        $buildingAddress17->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress17->setHouseNumber(8);
        $buildingAddress17->setAddition('Bis');
        $buildingAddress17->setZipcode('1105BV');
        $buildingAddress17->setCity('Utrecht');
        $buildingAddress17->setRentalUnitNumber('VHE0017');
        $buildingAddress17->setDaeb(true);
        $buildingAddress17->setVtw($vtw1);
        $buildingAddress17->setResidentialArea($residentialArea4);
        $buildingAddress17->setBuildingType($buildingType2);
        $buildingAddress17->setLivingType($livingType6);
        $buildingAddress17->setCreationTime();
        $buildingAddress17->setLastChangeTime();

        $buildingAddress18 = new BuildingAddress();
        $buildingAddress18->setConstructionYear(1944);
        $buildingAddress18->setRenovationYear(1986);
        $buildingAddress18->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress18->setHouseNumber(10);
        $buildingAddress18->setAddition('Bis');
        $buildingAddress18->setZipcode('1105BV');
        $buildingAddress18->setCity('Utrecht');
        $buildingAddress18->setRentalUnitNumber('VHE0018');
        $buildingAddress18->setDaeb(false);
        $buildingAddress18->setVtw($vtw1);
        $buildingAddress18->setResidentialArea($residentialArea4);
        $buildingAddress18->setBuildingType($buildingType2);
        $buildingAddress18->setLivingType($livingType6);
        $buildingAddress18->setCreationTime();
        $buildingAddress18->setLastChangeTime();

        $buildingAddress19 = new BuildingAddress();
        $buildingAddress19->setConstructionYear(1944);
        $buildingAddress19->setRenovationYear(1986);
        $buildingAddress19->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress19->setHouseNumber(12);
        $buildingAddress19->setAddition('Bis');
        $buildingAddress19->setZipcode('1105BV');
        $buildingAddress19->setCity('Utrecht');
        $buildingAddress19->setRentalUnitNumber('VHE0019');
        $buildingAddress19->setDaeb(true);
        $buildingAddress19->setVtw($vtw1);
        $buildingAddress19->setResidentialArea($residentialArea4);
        $buildingAddress19->setBuildingType($buildingType2);
        $buildingAddress19->setLivingType($livingType6);
        $buildingAddress19->setCreationTime();
        $buildingAddress19->setLastChangeTime();

        $buildingAddress20 = new BuildingAddress();
        $buildingAddress20->setConstructionYear(1944);
        $buildingAddress20->setRenovationYear(1986);
        $buildingAddress20->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress20->setHouseNumber(6);
        $buildingAddress20->setAddition('A');
        $buildingAddress20->setZipcode('1105BV');
        $buildingAddress20->setCity('Utrecht');
        $buildingAddress20->setRentalUnitNumber('VHE0020');
        $buildingAddress20->setDaeb(true);
        $buildingAddress20->setVtw($vtw1);
        $buildingAddress20->setResidentialArea($residentialArea4);
        $buildingAddress20->setBuildingType($buildingType2);
        $buildingAddress20->setLivingType($livingType6);
        $buildingAddress20->setCreationTime();
        $buildingAddress20->setLastChangeTime();

        $buildingAddress21 = new BuildingAddress();
        $buildingAddress21->setConstructionYear(1944);
        $buildingAddress21->setRenovationYear(1986);
        $buildingAddress21->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress21->setHouseNumber(8);
        $buildingAddress21->setAddition('A');
        $buildingAddress21->setZipcode('1105BV');
        $buildingAddress21->setCity('Utrecht');
        $buildingAddress21->setRentalUnitNumber('VHE0021');
        $buildingAddress21->setDaeb(true);
        $buildingAddress21->setVtw($vtw1);
        $buildingAddress21->setResidentialArea($residentialArea4);
        $buildingAddress21->setBuildingType($buildingType2);
        $buildingAddress21->setLivingType($livingType6);
        $buildingAddress21->setCreationTime();
        $buildingAddress21->setLastChangeTime();

        $buildingAddress22 = new BuildingAddress();
        $buildingAddress22->setConstructionYear(1944);
        $buildingAddress22->setRenovationYear(1986);
        $buildingAddress22->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress22->setHouseNumber(10);
        $buildingAddress22->setAddition('A');
        $buildingAddress22->setZipcode('1105BV');
        $buildingAddress22->setCity('Utrecht');
        $buildingAddress22->setRentalUnitNumber('VHE0022');
        $buildingAddress22->setDaeb(true);
        $buildingAddress22->setVtw($vtw1);
        $buildingAddress22->setResidentialArea($residentialArea4);
        $buildingAddress22->setBuildingType($buildingType2);
        $buildingAddress22->setLivingType($livingType6);
        $buildingAddress22->setCreationTime();
        $buildingAddress22->setLastChangeTime();

        $buildingAddress23 = new BuildingAddress();
        $buildingAddress23->setConstructionYear(1944);
        $buildingAddress23->setRenovationYear(1986);
        $buildingAddress23->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress23->setHouseNumber(6);
        $buildingAddress23->setZipcode('1105BV');
        $buildingAddress23->setCity('Utrecht');
        $buildingAddress23->setRentalUnitNumber('VHE0023');
        $buildingAddress23->setDaeb(true);
        $buildingAddress23->setVtw($vtw1);
        $buildingAddress23->setResidentialArea($residentialArea4);
        $buildingAddress23->setBuildingType($buildingType2);
        $buildingAddress23->setLivingType($livingType6);
        $buildingAddress23->setCreationTime();
        $buildingAddress23->setLastChangeTime();

        $buildingAddress24 = new BuildingAddress();
        $buildingAddress24->setConstructionYear(1944);
        $buildingAddress24->setRenovationYear(1986);
        $buildingAddress24->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress24->setHouseNumber(8);
        $buildingAddress24->setZipcode('1105BV');
        $buildingAddress24->setCity('Utrecht');
        $buildingAddress24->setRentalUnitNumber('VHE0024');
        $buildingAddress24->setDaeb(true);
        $buildingAddress24->setVtw($vtw1);
        $buildingAddress24->setResidentialArea($residentialArea4);
        $buildingAddress24->setBuildingType($buildingType2);
        $buildingAddress24->setLivingType($livingType6);
        $buildingAddress24->setCreationTime();
        $buildingAddress24->setLastChangeTime();

        $buildingAddress25 = new BuildingAddress();
        $buildingAddress25->setConstructionYear(1944);
        $buildingAddress25->setRenovationYear(1986);
        $buildingAddress25->setStreetName('Löeff Berchmakerstraat');
        $buildingAddress25->setHouseNumber(10);
        $buildingAddress25->setZipcode('1105BV');
        $buildingAddress25->setCity('Utrecht');
        $buildingAddress25->setRentalUnitNumber('VHE0025');
        $buildingAddress25->setDaeb(true);
        $buildingAddress25->setVtw($vtw1);
        $buildingAddress25->setResidentialArea($residentialArea4);
        $buildingAddress25->setBuildingType($buildingType2);
        $buildingAddress25->setLivingType($livingType6);
        $buildingAddress25->setCreationTime();
        $buildingAddress25->setLastChangeTime();

        $buildingAddress26 = new BuildingAddress();
        $buildingAddress26->setConstructionYear(1956);
        $buildingAddress26->setRenovationYear(2000);
        $buildingAddress26->setStreetName('Zomersestraatweg');
        $buildingAddress26->setHouseNumber(1);
        $buildingAddress26->setAddition('A');
        $buildingAddress26->setZipcode('3234AT');
        $buildingAddress26->setCity('Nooitgedacht');
        $buildingAddress26->setRentalUnitNumber('VHE0026');
        $buildingAddress26->setDaeb(true);
        $buildingAddress26->setVtw($vtw14);
        $buildingAddress26->setResidentialArea($residentialArea6);
        $buildingAddress26->setBuildingType($buildingType6);
        $buildingAddress26->setLivingType($livingType2);
        $buildingAddress26->setCreationTime();
        $buildingAddress26->setLastChangeTime();

        $buildingAddress27 = new BuildingAddress();
        $buildingAddress27->setConstructionYear(2006);
        $buildingAddress27->setRenovationYear(2006);
        $buildingAddress27->setStreetName('Zomersestraatweg');
        $buildingAddress27->setHouseNumber(3);
        $buildingAddress27->setAddition('A');
        $buildingAddress27->setZipcode('3234AT');
        $buildingAddress27->setCity('Nooitgedacht');
        $buildingAddress27->setRentalUnitNumber('VHE0027');
        $buildingAddress27->setDaeb(true);
        $buildingAddress27->setVtw($vtw4);
        $buildingAddress27->setResidentialArea($residentialArea7);
        $buildingAddress27->setBuildingType($buildingType7);
        $buildingAddress27->setLivingType($livingType2);
        $buildingAddress27->setCreationTime();
        $buildingAddress27->setLastChangeTime();

        $buildingAddress28 = new BuildingAddress();
        $buildingAddress28->setConstructionYear(2020);
        $buildingAddress28->setStreetName('Zomersestraatweg');
        $buildingAddress28->setHouseNumber(3);
        $buildingAddress28->setAddition('Bis');
        $buildingAddress28->setZipcode('3234AT');
        $buildingAddress28->setCity('Nooitgedacht');
        $buildingAddress28->setRentalUnitNumber('VHE0028');
        $buildingAddress28->setDaeb(true);
        $buildingAddress28->setVtw($vtw6);
        $buildingAddress28->setResidentialArea($residentialArea8);
        $buildingAddress28->setBuildingType($buildingType8);
        $buildingAddress28->setLivingType($livingType2);
        $buildingAddress28->setCreationTime();
        $buildingAddress28->setLastChangeTime();

        $buildingAddress29 = new BuildingAddress();
        $buildingAddress29->setConstructionYear(1976);
        $buildingAddress29->setRenovationYear(2001);
        $buildingAddress29->setStreetName('Zomersestraatweg');
        $buildingAddress29->setHouseNumber(3);
        $buildingAddress29->setAddition('I');
        $buildingAddress29->setZipcode('3234AT');
        $buildingAddress29->setCity('Nooitgedacht');
        $buildingAddress29->setRentalUnitNumber('VHE0029');
        $buildingAddress29->setDaeb(true);
        $buildingAddress29->setVtw($vtw1);
        $buildingAddress29->setResidentialArea($residentialArea9);
        $buildingAddress29->setBuildingType($buildingType9);
        $buildingAddress29->setLivingType($livingType2);
        $buildingAddress29->setCreationTime();
        $buildingAddress29->setLastChangeTime();

        $buildingAddress30 = new BuildingAddress();
        $buildingAddress30->setConstructionYear(1986);
        $buildingAddress30->setRenovationYear(2002);
        $buildingAddress30->setStreetName('Zomersestraatweg');
        $buildingAddress30->setHouseNumber(3);
        $buildingAddress30->setAddition('X');
        $buildingAddress30->setZipcode('3234AT');
        $buildingAddress30->setCity('Nooitgedacht');
        $buildingAddress30->setRentalUnitNumber('VHE0030');
        $buildingAddress30->setDaeb(true);
        $buildingAddress30->setVtw($vtw16);
        $buildingAddress30->setResidentialArea($residentialArea10);
        $buildingAddress30->setBuildingType($buildingType10);
        $buildingAddress30->setLivingType($livingType2);
        $buildingAddress30->setCreationTime();
        $buildingAddress30->setLastChangeTime();

        $buildingAddress31 = new BuildingAddress();
        $buildingAddress31->setConstructionYear(1954);
        $buildingAddress31->setRenovationYear(1986);
        $buildingAddress31->setStreetName('Zomersestraatweg');
        $buildingAddress31->setHouseNumber(5);
        $buildingAddress31->setAddition('A');
        $buildingAddress31->setZipcode('3234AT');
        $buildingAddress31->setCity('Nooitgedacht');
        $buildingAddress31->setRentalUnitNumber('VHE0031');
        $buildingAddress31->setDaeb(true);
        $buildingAddress31->setVtw($vtw19);
        $buildingAddress31->setResidentialArea($residentialArea1);
        $buildingAddress31->setBuildingType($buildingType1);
        $buildingAddress31->setLivingType($livingType2);
        $buildingAddress31->setCreationTime();
        $buildingAddress31->setLastChangeTime();

        $buildingAddress32 = new BuildingAddress();
        $buildingAddress32->setConstructionYear(1998);
        $buildingAddress32->setRenovationYear(2021);
        $buildingAddress32->setStreetName('Zomersestraatweg');
        $buildingAddress32->setHouseNumber(5);
        $buildingAddress32->setAddition('B');
        $buildingAddress32->setZipcode('3234AT');
        $buildingAddress32->setCity('Nooitgedacht');
        $buildingAddress32->setRentalUnitNumber('VHE0032');
        $buildingAddress32->setDaeb(true);
        $buildingAddress32->setVtw($vtw1);
        $buildingAddress32->setResidentialArea($residentialArea2);
        $buildingAddress32->setBuildingType($buildingType2);
        $buildingAddress32->setLivingType($livingType3);
        $buildingAddress32->setCreationTime();
        $buildingAddress32->setLastChangeTime();

        $buildingAddress33 = new BuildingAddress();
        $buildingAddress33->setConstructionYear(1984);
        $buildingAddress33->setRenovationYear(2000);
        $buildingAddress33->setStreetName('Zomersestraatweg');
        $buildingAddress33->setHouseNumber(5);
        $buildingAddress33->setAddition('Bis');
        $buildingAddress33->setZipcode('3234AT');
        $buildingAddress33->setCity('Nooitgedacht');
        $buildingAddress33->setRentalUnitNumber('VHE0033');
        $buildingAddress33->setDaeb(true);
        $buildingAddress33->setVtw($vtw1);
        $buildingAddress33->setResidentialArea($residentialArea3);
        $buildingAddress33->setBuildingType($buildingType3);
        $buildingAddress33->setLivingType($livingType3);
        $buildingAddress33->setCreationTime();
        $buildingAddress33->setLastChangeTime();

        $buildingAddress34 = new BuildingAddress();
        $buildingAddress34->setConstructionYear(2010);
        $buildingAddress34->setRenovationYear(2010);
        $buildingAddress34->setStreetName('Zomersestraatweg');
        $buildingAddress34->setHouseNumber(7);
        $buildingAddress34->setAddition('A');
        $buildingAddress34->setZipcode('3234AT');
        $buildingAddress34->setCity('Nooitgedacht');
        $buildingAddress34->setRentalUnitNumber('VHE0034');
        $buildingAddress34->setDaeb(true);
        $buildingAddress34->setVtw($vtw1);
        $buildingAddress34->setResidentialArea($residentialArea4);
        $buildingAddress34->setBuildingType($buildingType4);
        $buildingAddress34->setLivingType($livingType3);
        $buildingAddress34->setCreationTime();
        $buildingAddress34->setLastChangeTime();

        $buildingAddress35 = new BuildingAddress();
        $buildingAddress35->setConstructionYear(1888);
        $buildingAddress35->setRenovationYear(2005);
        $buildingAddress35->setStreetName('Zomersestraatweg');
        $buildingAddress35->setHouseNumber(7);
        $buildingAddress35->setAddition('B');
        $buildingAddress35->setZipcode('3234AT');
        $buildingAddress35->setCity('Nooitgedacht');
        $buildingAddress35->setRentalUnitNumber('VHE0035');
        $buildingAddress35->setDaeb(true);
        $buildingAddress35->setVtw($vtw1);
        $buildingAddress35->setResidentialArea($residentialArea5);
        $buildingAddress35->setBuildingType($buildingType5);
        $buildingAddress35->setLivingType($livingType3);
        $buildingAddress35->setCreationTime();
        $buildingAddress35->setLastChangeTime();

        $buildingAddress36 = new BuildingAddress();
        $buildingAddress36->setConstructionYear(1908);
        $buildingAddress36->setRenovationYear(2000);
        $buildingAddress36->setStreetName('Zomersestraatweg');
        $buildingAddress36->setHouseNumber(7);
        $buildingAddress36->setAddition('Bis');
        $buildingAddress36->setZipcode('3234AT');
        $buildingAddress36->setCity('Nooitgedacht');
        $buildingAddress36->setRentalUnitNumber('VHE0036');
        $buildingAddress36->setDaeb(true);
        $buildingAddress36->setVtw($vtw1);
        $buildingAddress36->setResidentialArea($residentialArea6);
        $buildingAddress36->setBuildingType($buildingType6);
        $buildingAddress36->setLivingType($livingType3);
        $buildingAddress36->setCreationTime();
        $buildingAddress36->setLastChangeTime();

        $buildingAddress37 = new BuildingAddress();
        $buildingAddress37->setConstructionYear(2006);
        $buildingAddress37->setRenovationYear(2006);
        $buildingAddress37->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress37->setHouseNumber(9);
        $buildingAddress37->setAddition('A');
        $buildingAddress37->setZipcode('3234AT');
        $buildingAddress37->setCity('Nooitgedacht');
        $buildingAddress37->setRentalUnitNumber('VHE0037');
        $buildingAddress37->setDaeb(true);
        $buildingAddress37->setVtw($vtw1);
        $buildingAddress37->setResidentialArea($residentialArea7);
        $buildingAddress37->setBuildingType($buildingType7);
        $buildingAddress37->setLivingType($livingType3);
        $buildingAddress37->setCreationTime();
        $buildingAddress37->setLastChangeTime();

        $buildingAddress38 = new BuildingAddress();
        $buildingAddress38->setConstructionYear(2026);
        $buildingAddress38->setRenovationYear(2081);
        $buildingAddress38->setStreetName('Zomersestraatweg');
        $buildingAddress38->setHouseNumber(9);
        $buildingAddress38->setAddition('Bis');
        $buildingAddress38->setZipcode('3234AT');
        $buildingAddress38->setCity('Nooitgedacht');
        $buildingAddress38->setRentalUnitNumber('VHE0038');
        $buildingAddress38->setDaeb(true);
        $buildingAddress38->setVtw($vtw1);
        $buildingAddress38->setResidentialArea($residentialArea8);
        $buildingAddress38->setBuildingType($buildingType8);
        $buildingAddress38->setLivingType($livingType3);
        $buildingAddress38->setCreationTime();
        $buildingAddress38->setLastChangeTime();

        $buildingAddress39 = new BuildingAddress();
        $buildingAddress39->setConstructionYear(1976);
        $buildingAddress39->setRenovationYear(2001);
        $buildingAddress39->setStreetName('Zomersestraatweg');
        $buildingAddress39->setHouseNumber(9);
        $buildingAddress39->setAddition('I');
        $buildingAddress39->setZipcode('3234AT');
        $buildingAddress39->setCity('Nooitgedacht');
        $buildingAddress39->setRentalUnitNumber('VHE0039');
        $buildingAddress39->setDaeb(true);
        $buildingAddress39->setVtw($vtw1);
        $buildingAddress39->setResidentialArea($residentialArea9);
        $buildingAddress39->setBuildingType($buildingType9);
        $buildingAddress39->setLivingType($livingType3);
        $buildingAddress39->setCreationTime();
        $buildingAddress39->setLastChangeTime();

        $buildingAddress40 = new BuildingAddress();
        $buildingAddress40->setConstructionYear(1986);
        $buildingAddress40->setRenovationYear(2002);
        $buildingAddress40->setStreetName('Zomersestraatweg');
        $buildingAddress40->setHouseNumber(9);
        $buildingAddress40->setAddition('X');
        $buildingAddress40->setZipcode('3234AT');
        $buildingAddress40->setCity('Nooitgedacht');
        $buildingAddress40->setRentalUnitNumber('VHE0040');
        $buildingAddress40->setDaeb(true);
        $buildingAddress40->setVtw($vtw1);
        $buildingAddress40->setResidentialArea($residentialArea10);
        $buildingAddress40->setBuildingType($buildingType10);
        $buildingAddress40->setLivingType($livingType3);
        $buildingAddress40->setCreationTime();
        $buildingAddress40->setLastChangeTime();

        $buildingAddress41 = new BuildingAddress();
        $buildingAddress41->setConstructionYear(1954);
        $buildingAddress41->setRenovationYear(1986);
        $buildingAddress41->setStreetName('Zomersestraatweg');
        $buildingAddress41->setHouseNumber(10);
        $buildingAddress41->setAddition('A');
        $buildingAddress41->setZipcode('3234AT');
        $buildingAddress41->setCity('Nooitgedacht');
        $buildingAddress41->setRentalUnitNumber('VHE0041');
        $buildingAddress41->setDaeb(true);
        $buildingAddress41->setVtw($vtw178);
        $buildingAddress41->setResidentialArea($residentialArea1);
        $buildingAddress41->setBuildingType($buildingType1);
        $buildingAddress41->setLivingType($livingType2);
        $buildingAddress41->setCreationTime();
        $buildingAddress41->setLastChangeTime();

        $buildingAddress42 = new BuildingAddress();
        $buildingAddress42->setConstructionYear(1998);
        $buildingAddress42->setRenovationYear(2021);
        $buildingAddress42->setStreetName('Straatnaam A');
        $buildingAddress42->setHouseNumber(10);
        $buildingAddress42->setAddition('B');
        $buildingAddress42->setZipcode('3234AT');
        $buildingAddress42->setCity('Nooitgedacht');
        $buildingAddress42->setRentalUnitNumber('VHE0042');
        $buildingAddress42->setDaeb(true);
        $buildingAddress42->setVtw($vtw2);
        $buildingAddress42->setResidentialArea($residentialArea2);
        $buildingAddress42->setBuildingType($buildingType2);
        $buildingAddress42->setLivingType($livingType3);
        $buildingAddress42->setCreationTime();
        $buildingAddress42->setLastChangeTime();

        $buildingAddress43 = new BuildingAddress();
        $buildingAddress43->setConstructionYear(1984);
        $buildingAddress43->setRenovationYear(2000);
        $buildingAddress43->setStreetName('Zomersestraatweg');
        $buildingAddress43->setHouseNumber(10);
        $buildingAddress43->setAddition('Bis');
        $buildingAddress43->setZipcode('3234AT');
        $buildingAddress43->setCity('Nooitgedacht');
        $buildingAddress43->setRentalUnitNumber('VHE0043');
        $buildingAddress43->setDaeb(true);
        $buildingAddress43->setVtw($vtw1);
        $buildingAddress43->setResidentialArea($residentialArea3);
        $buildingAddress43->setBuildingType($buildingType3);
        $buildingAddress43->setLivingType($livingType3);
        $buildingAddress43->setCreationTime();
        $buildingAddress43->setLastChangeTime();

        $buildingAddress44 = new BuildingAddress();
        $buildingAddress44->setConstructionYear(2010);
        $buildingAddress44->setRenovationYear(2015);
        $buildingAddress44->setStreetName('Zomersestraatweg');
        $buildingAddress44->setHouseNumber(10);
        $buildingAddress44->setAddition('X');
        $buildingAddress44->setZipcode('3234AT');
        $buildingAddress44->setCity('Nooitgedacht');
        $buildingAddress44->setRentalUnitNumber('VHE0044');
        $buildingAddress44->setDaeb(true);
        $buildingAddress44->setVtw($vtw1);
        $buildingAddress44->setResidentialArea($residentialArea4);
        $buildingAddress44->setBuildingType($buildingType4);
        $buildingAddress44->setLivingType($livingType3);
        $buildingAddress44->setCreationTime();
        $buildingAddress44->setLastChangeTime();

        $buildingAddress45 = new BuildingAddress();
        $buildingAddress45->setConstructionYear(1988);
        $buildingAddress45->setRenovationYear(2005);
        $buildingAddress45->setStreetName('Zomersestraatweg');
        $buildingAddress45->setHouseNumber(12);
        $buildingAddress45->setAddition('A');
        $buildingAddress45->setZipcode('3234AT');
        $buildingAddress45->setCity('Nooitgedacht');
        $buildingAddress45->setRentalUnitNumber('VHE0045');
        $buildingAddress45->setDaeb(true);
        $buildingAddress45->setVtw($vtw1);
        $buildingAddress45->setResidentialArea($residentialArea5);
        $buildingAddress45->setBuildingType($buildingType5);
        $buildingAddress45->setLivingType($livingType3);
        $buildingAddress45->setCreationTime();
        $buildingAddress45->setLastChangeTime();

        $buildingAddress46 = new BuildingAddress();
        $buildingAddress46->setConstructionYear(1958);
        $buildingAddress46->setRenovationYear(2000);
        $buildingAddress46->setStreetName('Straatnaam A');
        $buildingAddress46->setHouseNumber(12);
        $buildingAddress46->setAddition('B');
        $buildingAddress46->setZipcode('3234AT');
        $buildingAddress46->setCity('Nooitgedacht');
        $buildingAddress46->setRentalUnitNumber('VHE0046');
        $buildingAddress46->setDaeb(true);
        $buildingAddress46->setVtw($vtw1);
        $buildingAddress46->setResidentialArea($residentialArea6);
        $buildingAddress46->setBuildingType($buildingType6);
        $buildingAddress46->setLivingType($livingType3);
        $buildingAddress46->setCreationTime();
        $buildingAddress46->setLastChangeTime();

        $buildingAddress47 = new BuildingAddress();
        $buildingAddress47->setConstructionYear(2006);
        $buildingAddress47->setRenovationYear(2006);
        $buildingAddress47->setStreetName('Zomersestraatweg');
        $buildingAddress47->setHouseNumber(12);
        $buildingAddress47->setAddition('Bis');
        $buildingAddress47->setZipcode('3234AT');
        $buildingAddress47->setCity('Nooitgedacht');
        $buildingAddress47->setRentalUnitNumber('VHE0047');
        $buildingAddress47->setDaeb(true);
        $buildingAddress47->setVtw($vtw1);
        $buildingAddress47->setResidentialArea($residentialArea7);
        $buildingAddress47->setBuildingType($buildingType7);
        $buildingAddress47->setLivingType($livingType3);
        $buildingAddress47->setCreationTime();
        $buildingAddress47->setLastChangeTime();

        $buildingAddress48 = new BuildingAddress();
        $buildingAddress48->setConstructionYear(2026);
        $buildingAddress48->setRenovationYear(2081);
        $buildingAddress48->setStreetName('Zomersestraatweg');
        $buildingAddress48->setHouseNumber(12);
        $buildingAddress48->setAddition('X');
        $buildingAddress48->setZipcode('3234AT');
        $buildingAddress48->setCity('Nooitgedacht');
        $buildingAddress48->setRentalUnitNumber('VHE0048');
        $buildingAddress48->setDaeb(true);
        $buildingAddress48->setVtw($vtw1);
        $buildingAddress48->setResidentialArea($residentialArea8);
        $buildingAddress48->setBuildingType($buildingType8);
        $buildingAddress48->setLivingType($livingType3);
        $buildingAddress48->setCreationTime();
        $buildingAddress48->setLastChangeTime();

        $buildingAddress49 = new BuildingAddress();
        $buildingAddress49->setConstructionYear(1976);
        $buildingAddress49->setRenovationYear(2001);
        $buildingAddress49->setStreetName('Zomersestraatweg');
        $buildingAddress49->setHouseNumber(14);
        $buildingAddress49->setAddition('I');
        $buildingAddress49->setZipcode('3234AT');
        $buildingAddress49->setCity('Nooitgedacht');
        $buildingAddress49->setRentalUnitNumber('VHE0049');
        $buildingAddress49->setDaeb(true);
        $buildingAddress49->setVtw($vtw1);
        $buildingAddress49->setResidentialArea($residentialArea9);
        $buildingAddress49->setBuildingType($buildingType9);
        $buildingAddress49->setLivingType($livingType3);
        $buildingAddress49->setCreationTime();
        $buildingAddress49->setLastChangeTime();

        $buildingAddress50 = new BuildingAddress();
        $buildingAddress50->setConstructionYear(1986);
        $buildingAddress50->setRenovationYear(2002);
        $buildingAddress50->setStreetName('Zomersestraatweg');
        $buildingAddress50->setHouseNumber(14);
        $buildingAddress50->setAddition('X');
        $buildingAddress50->setZipcode('3234AT');
        $buildingAddress50->setCity('Nooitgedacht');
        $buildingAddress50->setRentalUnitNumber('VHE0050');
        $buildingAddress50->setDaeb(true);
        $buildingAddress50->setVtw($vtw1);
        $buildingAddress50->setResidentialArea($residentialArea10);
        $buildingAddress50->setBuildingType($buildingType10);
        $buildingAddress50->setLivingType($livingType3);
        $buildingAddress50->setCreationTime();
        $buildingAddress50->setLastChangeTime();

        $buildingAddress51 = new BuildingAddress();
        $buildingAddress51->setConstructionYear(1954);
        $buildingAddress51->setRenovationYear(1986);
        $buildingAddress51->setStreetName('Straatnaam A');
        $buildingAddress51->setHouseNumber(10);
        $buildingAddress51->setAddition('A');
        $buildingAddress51->setZipcode('1234AA');
        $buildingAddress51->setCity('Woonplaats A');
        $buildingAddress51->setRentalUnitNumber('TECH0001');
        $buildingAddress51->setDaeb(true);
        $buildingAddress51->setVtw($vtw18);
        $buildingAddress51->setResidentialArea($residentialArea1);
        $buildingAddress51->setBuildingType($buildingType1);
        $buildingAddress51->setLivingType($livingType3);
        $buildingAddress51->setCreationTime();
        $buildingAddress51->setLastChangeTime();

        $buildingAddress52 = new BuildingAddress();
        $buildingAddress52->setConstructionYear(1998);
        $buildingAddress52->setRenovationYear(2021);
        $buildingAddress52->setStreetName('Straatnaam A');
        $buildingAddress52->setHouseNumber(10);
        $buildingAddress52->setAddition('A');
        $buildingAddress52->setZipcode('1234AA');
        $buildingAddress52->setCity('Woonplaats A');
        $buildingAddress52->setRentalUnitNumber('TECH0002');
        $buildingAddress52->setDaeb(true);
        $buildingAddress52->setVtw($vtw2);
        $buildingAddress52->setResidentialArea($residentialArea2);
        $buildingAddress52->setBuildingType($buildingType2);
        $buildingAddress52->setLivingType($livingType3);
        $buildingAddress52->setCreationTime();
        $buildingAddress52->setLastChangeTime();

        $buildingAddress53 = new BuildingAddress();
        $buildingAddress53->setConstructionYear(1984);
        $buildingAddress53->setRenovationYear(2000);
        $buildingAddress53->setStreetName('Straatnaam A');
        $buildingAddress53->setHouseNumber(10);
        $buildingAddress53->setAddition('A');
        $buildingAddress53->setZipcode('1234AA');
        $buildingAddress53->setCity('Woonplaats A');
        $buildingAddress53->setRentalUnitNumber('TECH0003');
        $buildingAddress53->setDaeb(true);
        $buildingAddress53->setVtw($vtw1);
        $buildingAddress53->setResidentialArea($residentialArea3);
        $buildingAddress53->setBuildingType($buildingType3);
        $buildingAddress53->setLivingType($livingType3);
        $buildingAddress53->setCreationTime();
        $buildingAddress53->setLastChangeTime();

        $buildingAddress54 = new BuildingAddress();
        $buildingAddress54->setConstructionYear(2010);
        $buildingAddress54->setRenovationYear(2015);
        $buildingAddress54->setStreetName('Straatnaam A');
        $buildingAddress54->setHouseNumber(102);
        $buildingAddress54->setAddition('');
        $buildingAddress54->setZipcode('1234AA');
        $buildingAddress54->setCity('Woonplaats A');
        $buildingAddress54->setRentalUnitNumber('TECH0004');
        $buildingAddress54->setDaeb(true);
        $buildingAddress54->setVtw($vtw1);
        $buildingAddress54->setResidentialArea($residentialArea4);
        $buildingAddress54->setBuildingType($buildingType4);
        $buildingAddress54->setLivingType($livingType3);
        $buildingAddress54->setCreationTime();
        $buildingAddress54->setLastChangeTime();

        $buildingAddress55 = new BuildingAddress();
        $buildingAddress55->setConstructionYear(1888);
        $buildingAddress55->setRenovationYear(2005);
        $buildingAddress55->setStreetName('Straatnaam A');
        $buildingAddress55->setHouseNumber(10);
        $buildingAddress55->setAddition('A');
        $buildingAddress55->setZipcode('1234AA');
        $buildingAddress55->setCity('Woonplaats A');
        $buildingAddress55->setRentalUnitNumber('TECH0005');
        $buildingAddress55->setDaeb(true);
        $buildingAddress55->setVtw($vtw1);
        $buildingAddress55->setResidentialArea($residentialArea5);
        $buildingAddress55->setBuildingType($buildingType5);
        $buildingAddress55->setLivingType($livingType3);
        $buildingAddress55->setCreationTime();
        $buildingAddress55->setLastChangeTime();

        $buildingAddress56 = new BuildingAddress();
        $buildingAddress56->setConstructionYear(1958);
        $buildingAddress56->setRenovationYear(2000);
        $buildingAddress56->setStreetName('Straatnaam A');
        $buildingAddress56->setHouseNumber(10);
        $buildingAddress56->setAddition('A');
        $buildingAddress56->setZipcode('1234AA');
        $buildingAddress56->setCity('Woonplaats A');
        $buildingAddress56->setRentalUnitNumber('TECH0006');
        $buildingAddress56->setDaeb(true);
        $buildingAddress56->setVtw($vtw1);
        $buildingAddress56->setResidentialArea($residentialArea6);
        $buildingAddress56->setBuildingType($buildingType6);
        $buildingAddress56->setLivingType($livingType3);
        $buildingAddress56->setCreationTime();
        $buildingAddress56->setLastChangeTime();

        $buildingAddress57 = new BuildingAddress();
        $buildingAddress57->setConstructionYear(2006);
        $buildingAddress57->setRenovationYear(2016);
        $buildingAddress57->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress57->setHouseNumber(10);
        $buildingAddress57->setAddition('A');
        $buildingAddress57->setZipcode('1234AA');
        $buildingAddress57->setCity('Woonplaats A');
        $buildingAddress57->setRentalUnitNumber('TECH0007');
        $buildingAddress57->setDaeb(true);
        $buildingAddress57->setVtw($vtw1);
        $buildingAddress57->setResidentialArea($residentialArea7);
        $buildingAddress57->setBuildingType($buildingType7);
        $buildingAddress57->setLivingType($livingType3);
        $buildingAddress57->setCreationTime();
        $buildingAddress57->setLastChangeTime();

        $buildingAddress58 = new BuildingAddress();
        $buildingAddress58->setConstructionYear(2020);
        $buildingAddress58->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress58->setHouseNumber(10);
        $buildingAddress58->setAddition('Bis');
        $buildingAddress58->setZipcode('1234AA');
        $buildingAddress58->setCity('Woonplaats A');
        $buildingAddress58->setRentalUnitNumber('TECH0008');
        $buildingAddress58->setDaeb(false);
        $buildingAddress58->setVtw($vtw1);
        $buildingAddress58->setResidentialArea($residentialArea8);
        $buildingAddress58->setBuildingType($buildingType8);
        $buildingAddress58->setLivingType($livingType3);
        $buildingAddress58->setCreationTime();
        $buildingAddress58->setLastChangeTime();

        $buildingAddress59 = new BuildingAddress();
        $buildingAddress59->setConstructionYear(1976);
        $buildingAddress59->setRenovationYear(2001);
        $buildingAddress59->setStreetName('Straatnaam A');
        $buildingAddress59->setHouseNumber(10);
        $buildingAddress59->setAddition('I');
        $buildingAddress59->setZipcode('1234AA');
        $buildingAddress59->setCity('Woonplaats A');
        $buildingAddress59->setRentalUnitNumber('TECH0009');
        $buildingAddress59->setDaeb(true);
        $buildingAddress59->setVtw($vtw1);
        $buildingAddress59->setResidentialArea($residentialArea9);
        $buildingAddress59->setBuildingType($buildingType9);
        $buildingAddress59->setLivingType($livingType3);
        $buildingAddress59->setCreationTime();
        $buildingAddress59->setLastChangeTime();

        $buildingAddress60 = new BuildingAddress();
        $buildingAddress60->setConstructionYear(1986);
        $buildingAddress60->setRenovationYear(2002);
        $buildingAddress60->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress60->setHouseNumber(10);
        $buildingAddress60->setAddition('X');
        $buildingAddress60->setZipcode('1234AA');
        $buildingAddress60->setCity('Woonplaats A');
        $buildingAddress60->setRentalUnitNumber('TECH0010');
        $buildingAddress60->setDaeb(true);
        $buildingAddress60->setVtw($vtw1);
        $buildingAddress60->setResidentialArea($residentialArea10);
        $buildingAddress60->setBuildingType($buildingType10);
        $buildingAddress60->setLivingType($livingType3);
        $buildingAddress60->setCreationTime();
        $buildingAddress60->setLastChangeTime();

        $buildingAddress61 = new BuildingAddress();
        $buildingAddress61->setConstructionYear(1954);
        $buildingAddress61->setRenovationYear(1986);
        $buildingAddress61->setStreetName('Straatnaam A');
        $buildingAddress61->setHouseNumber(10);
        $buildingAddress61->setAddition('A');
        $buildingAddress61->setZipcode('1234AA');
        $buildingAddress61->setCity('Woonplaats A');
        $buildingAddress61->setRentalUnitNumber('TECH0011');
        $buildingAddress61->setDaeb(true);
        $buildingAddress61->setVtw($vtw121);
        $buildingAddress61->setResidentialArea($residentialArea1);
        $buildingAddress61->setBuildingType($buildingType1);
        $buildingAddress61->setLivingType($livingType3);
        $buildingAddress61->setCreationTime();
        $buildingAddress61->setLastChangeTime();

        $buildingAddress62 = new BuildingAddress();
        $buildingAddress62->setConstructionYear(1998);
        $buildingAddress62->setRenovationYear(2021);
        $buildingAddress62->setStreetName('Straatnaam A');
        $buildingAddress62->setHouseNumber(10);
        $buildingAddress62->setAddition('A');
        $buildingAddress62->setZipcode('1234AA');
        $buildingAddress62->setCity('Woonplaats A');
        $buildingAddress62->setRentalUnitNumber('TECH0012');
        $buildingAddress62->setDaeb(true);
        $buildingAddress62->setVtw($vtw1);
        $buildingAddress62->setResidentialArea($residentialArea2);
        $buildingAddress62->setBuildingType($buildingType2);
        $buildingAddress62->setLivingType($livingType3);
        $buildingAddress62->setCreationTime();
        $buildingAddress62->setLastChangeTime();

        $buildingAddress63 = new BuildingAddress();
        $buildingAddress63->setConstructionYear(1984);
        $buildingAddress63->setRenovationYear(2000);
        $buildingAddress63->setStreetName('Straatnaam A');
        $buildingAddress63->setHouseNumber(10);
        $buildingAddress63->setAddition('A');
        $buildingAddress63->setZipcode('1234AA');
        $buildingAddress63->setCity('Woonplaats A');
        $buildingAddress63->setRentalUnitNumber('TECH0013');
        $buildingAddress63->setDaeb(true);
        $buildingAddress63->setVtw($vtw1);
        $buildingAddress63->setResidentialArea($residentialArea3);
        $buildingAddress63->setBuildingType($buildingType3);
        $buildingAddress63->setLivingType($livingType3);
        $buildingAddress63->setCreationTime();
        $buildingAddress63->setLastChangeTime();

        $buildingAddress64 = new BuildingAddress();
        $buildingAddress64->setConstructionYear(2010);
        $buildingAddress64->setRenovationYear(2019);
        $buildingAddress64->setStreetName('Straatnaam A');
        $buildingAddress64->setHouseNumber(102);
        $buildingAddress64->setAddition('');
        $buildingAddress64->setZipcode('1234AA');
        $buildingAddress64->setCity('Woonplaats A');
        $buildingAddress64->setRentalUnitNumber('TECH0014');
        $buildingAddress64->setDaeb(true);
        $buildingAddress64->setVtw($vtw1);
        $buildingAddress64->setResidentialArea($residentialArea4);
        $buildingAddress64->setBuildingType($buildingType4);
        $buildingAddress64->setLivingType($livingType3);
        $buildingAddress64->setCreationTime();
        $buildingAddress64->setLastChangeTime();

        $buildingAddress65 = new BuildingAddress();
        $buildingAddress65->setConstructionYear(1888);
        $buildingAddress65->setRenovationYear(2005);
        $buildingAddress65->setStreetName('Straatnaam A');
        $buildingAddress65->setHouseNumber(10);
        $buildingAddress65->setAddition('A');
        $buildingAddress65->setZipcode('1234AA');
        $buildingAddress65->setCity('Woonplaats A');
        $buildingAddress65->setRentalUnitNumber('TECH0015');
        $buildingAddress65->setDaeb(true);
        $buildingAddress65->setVtw($vtw1);
        $buildingAddress65->setResidentialArea($residentialArea5);
        $buildingAddress65->setBuildingType($buildingType5);
        $buildingAddress65->setLivingType($livingType3);
        $buildingAddress65->setCreationTime();
        $buildingAddress65->setLastChangeTime();

        $buildingAddress66 = new BuildingAddress();
        $buildingAddress66->setConstructionYear(1958);
        $buildingAddress66->setRenovationYear(2000);
        $buildingAddress66->setStreetName('Straatnaam A');
        $buildingAddress66->setHouseNumber(10);
        $buildingAddress66->setAddition('A');
        $buildingAddress66->setZipcode('1234AA');
        $buildingAddress66->setCity('Woonplaats A');
        $buildingAddress66->setRentalUnitNumber('TECH0016');
        $buildingAddress66->setDaeb(true);
        $buildingAddress66->setVtw($vtw1);
        $buildingAddress66->setResidentialArea($residentialArea6);
        $buildingAddress66->setBuildingType($buildingType6);
        $buildingAddress66->setLivingType($livingType3);
        $buildingAddress66->setCreationTime();
        $buildingAddress66->setLastChangeTime();

        $buildingAddress67 = new BuildingAddress();
        $buildingAddress67->setConstructionYear(2006);
        $buildingAddress67->setRenovationYear(2016);
        $buildingAddress67->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress67->setHouseNumber(10);
        $buildingAddress67->setAddition('A');
        $buildingAddress67->setZipcode('1234AA');
        $buildingAddress67->setCity('Woonplaats A');
        $buildingAddress67->setRentalUnitNumber('TECH0017');
        $buildingAddress67->setDaeb(true);
        $buildingAddress67->setVtw($vtw1);
        $buildingAddress67->setResidentialArea($residentialArea7);
        $buildingAddress67->setBuildingType($buildingType7);
        $buildingAddress67->setLivingType($livingType3);
        $buildingAddress67->setCreationTime();
        $buildingAddress67->setLastChangeTime();

        $buildingAddress68 = new BuildingAddress();
        $buildingAddress68->setConstructionYear(2000);
        $buildingAddress68->setRenovationYear(2011);
        $buildingAddress68->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress68->setHouseNumber(10);
        $buildingAddress68->setAddition('Bis');
        $buildingAddress68->setZipcode('1234AB');
        $buildingAddress68->setCity('Woonplaats A');
        $buildingAddress68->setRentalUnitNumber('TECH0018');
        $buildingAddress68->setDaeb(false);
        $buildingAddress68->setVtw($vtw1);
        $buildingAddress68->setResidentialArea($residentialArea8);
        $buildingAddress68->setBuildingType($buildingType8);
        $buildingAddress68->setLivingType($livingType3);
        $buildingAddress68->setCreationTime();
        $buildingAddress68->setLastChangeTime();

        $buildingAddress69 = new BuildingAddress();
        $buildingAddress69->setConstructionYear(1976);
        $buildingAddress69->setRenovationYear(2001);
        $buildingAddress69->setStreetName('Straatnaam A');
        $buildingAddress69->setHouseNumber(10);
        $buildingAddress69->setAddition('I');
        $buildingAddress69->setZipcode('1233AA');
        $buildingAddress69->setCity('Woonplaats A');
        $buildingAddress69->setRentalUnitNumber('TECH0019');
        $buildingAddress69->setDaeb(true);
        $buildingAddress69->setVtw($vtw1);
        $buildingAddress69->setResidentialArea($residentialArea9);
        $buildingAddress69->setBuildingType($buildingType9);
        $buildingAddress69->setLivingType($livingType3);
        $buildingAddress69->setCreationTime();
        $buildingAddress69->setLastChangeTime();

        $buildingAddress70 = new BuildingAddress();
        $buildingAddress70->setConstructionYear(1986);
        $buildingAddress70->setRenovationYear(2002);
        $buildingAddress70->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress70->setHouseNumber(10);
        $buildingAddress70->setAddition('X');
        $buildingAddress70->setZipcode('1234AA');
        $buildingAddress70->setCity('Woonplaats A');
        $buildingAddress70->setRentalUnitNumber('TECH0020');
        $buildingAddress70->setDaeb(true);
        $buildingAddress70->setVtw($vtw1);
        $buildingAddress70->setResidentialArea($residentialArea10);
        $buildingAddress70->setBuildingType($buildingType10);
        $buildingAddress70->setLivingType($livingType3);
        $buildingAddress70->setCreationTime();
        $buildingAddress70->setLastChangeTime();

        $buildingAddress71 = new BuildingAddress();
        $buildingAddress71->setConstructionYear(1954);
        $buildingAddress71->setRenovationYear(1986);
        $buildingAddress71->setStreetName('Straatnaam A');
        $buildingAddress71->setHouseNumber(10);
        $buildingAddress71->setAddition('A');
        $buildingAddress71->setZipcode('1234AA');
        $buildingAddress71->setCity('Woonplaats A');
        $buildingAddress71->setRentalUnitNumber('TECH0021');
        $buildingAddress71->setDaeb(true);
        $buildingAddress71->setVtw($vtw23);
        $buildingAddress71->setResidentialArea($residentialArea1);
        $buildingAddress71->setBuildingType($buildingType1);
        $buildingAddress71->setLivingType($livingType3);
        $buildingAddress71->setCreationTime();
        $buildingAddress71->setLastChangeTime();

        $buildingAddress72 = new BuildingAddress();
        $buildingAddress72->setConstructionYear(1998);
        $buildingAddress72->setRenovationYear(2021);
        $buildingAddress72->setStreetName('Straatnaam A');
        $buildingAddress72->setHouseNumber(10);
        $buildingAddress72->setAddition('A');
        $buildingAddress72->setZipcode('1234AA');
        $buildingAddress72->setCity('Woonplaats A');
        $buildingAddress72->setRentalUnitNumber('TECH0022');
        $buildingAddress72->setDaeb(true);
        $buildingAddress72->setVtw($vtw2);
        $buildingAddress72->setResidentialArea($residentialArea2);
        $buildingAddress72->setBuildingType($buildingType2);
        $buildingAddress72->setLivingType($livingType3);
        $buildingAddress72->setCreationTime();
        $buildingAddress72->setLastChangeTime();

        $buildingAddress73 = new BuildingAddress();
        $buildingAddress73->setConstructionYear(1984);
        $buildingAddress73->setRenovationYear(2000);
        $buildingAddress73->setStreetName('Straatnaam A');
        $buildingAddress73->setHouseNumber(10);
        $buildingAddress73->setAddition('A');
        $buildingAddress73->setZipcode('1234AA');
        $buildingAddress73->setCity('Woonplaats A');
        $buildingAddress73->setRentalUnitNumber('TECH0023');
        $buildingAddress73->setDaeb(true);
        $buildingAddress73->setVtw($vtw1);
        $buildingAddress73->setResidentialArea($residentialArea3);
        $buildingAddress73->setBuildingType($buildingType3);
        $buildingAddress73->setLivingType($livingType3);
        $buildingAddress73->setCreationTime();
        $buildingAddress73->setLastChangeTime();

        $buildingAddress74 = new BuildingAddress();
        $buildingAddress74->setConstructionYear(2010);
        $buildingAddress74->setRenovationYear(2019);
        $buildingAddress74->setStreetName('Straatnaam A');
        $buildingAddress74->setHouseNumber(102);
        $buildingAddress74->setAddition('');
        $buildingAddress74->setZipcode('1234AA');
        $buildingAddress74->setCity('Woonplaats A');
        $buildingAddress74->setRentalUnitNumber('TECH0024');
        $buildingAddress74->setDaeb(false);
        $buildingAddress74->setVtw($vtw1);
        $buildingAddress74->setResidentialArea($residentialArea4);
        $buildingAddress74->setBuildingType($buildingType4);
        $buildingAddress74->setLivingType($livingType3);
        $buildingAddress74->setCreationTime();
        $buildingAddress74->setLastChangeTime();

        $buildingAddress75 = new BuildingAddress();
        $buildingAddress75->setConstructionYear(1888);
        $buildingAddress75->setRenovationYear(2005);
        $buildingAddress75->setStreetName('Straatnaam A');
        $buildingAddress75->setHouseNumber(10);
        $buildingAddress75->setAddition('A');
        $buildingAddress75->setZipcode('1234AA');
        $buildingAddress75->setCity('Woonplaats A');
        $buildingAddress75->setRentalUnitNumber('TECH0025');
        $buildingAddress75->setDaeb(true);
        $buildingAddress75->setVtw($vtw1);
        $buildingAddress75->setResidentialArea($residentialArea5);
        $buildingAddress75->setBuildingType($buildingType5);
        $buildingAddress75->setLivingType($livingType3);
        $buildingAddress75->setCreationTime();
        $buildingAddress75->setLastChangeTime();

        $buildingAddress76 = new BuildingAddress();
        $buildingAddress76->setConstructionYear(1958);
        $buildingAddress76->setRenovationYear(2008);
        $buildingAddress76->setStreetName('Straatnaam A');
        $buildingAddress76->setHouseNumber(10);
        $buildingAddress76->setAddition('A');
        $buildingAddress76->setZipcode('1234AA');
        $buildingAddress76->setCity('Woonplaats A');
        $buildingAddress76->setRentalUnitNumber('TECH0026');
        $buildingAddress76->setDaeb(true);
        $buildingAddress76->setVtw($vtw1);
        $buildingAddress76->setResidentialArea($residentialArea6);
        $buildingAddress76->setBuildingType($buildingType6);
        $buildingAddress76->setLivingType($livingType3);
        $buildingAddress76->setCreationTime();
        $buildingAddress76->setLastChangeTime();

        $buildingAddress77 = new BuildingAddress();
        $buildingAddress77->setConstructionYear(2006);
        $buildingAddress77->setRenovationYear(2016);
        $buildingAddress77->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress77->setHouseNumber(10);
        $buildingAddress77->setAddition('A');
        $buildingAddress77->setZipcode('1234AA');
        $buildingAddress77->setCity('Woonplaats A');
        $buildingAddress77->setRentalUnitNumber('TECH0027');
        $buildingAddress77->setDaeb(true);
        $buildingAddress77->setVtw($vtw1);
        $buildingAddress77->setResidentialArea($residentialArea7);
        $buildingAddress77->setBuildingType($buildingType7);
        $buildingAddress77->setLivingType($livingType3);
        $buildingAddress77->setCreationTime();
        $buildingAddress77->setLastChangeTime();

        $buildingAddress78 = new BuildingAddress();
        $buildingAddress78->setConstructionYear(2000);
        $buildingAddress78->setRenovationYear(2021);
        $buildingAddress78->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress78->setHouseNumber(10);
        $buildingAddress78->setAddition('Bis');
        $buildingAddress78->setZipcode('1234AB');
        $buildingAddress78->setCity('Woonplaats A');
        $buildingAddress78->setRentalUnitNumber('TECH0028');
        $buildingAddress78->setDaeb(true);
        $buildingAddress78->setVtw($vtw1);
        $buildingAddress78->setResidentialArea($residentialArea8);
        $buildingAddress78->setBuildingType($buildingType8);
        $buildingAddress78->setLivingType($livingType3);
        $buildingAddress78->setCreationTime();
        $buildingAddress78->setLastChangeTime();

        $buildingAddress79 = new BuildingAddress();
        $buildingAddress79->setConstructionYear(1976);
        $buildingAddress79->setRenovationYear(2001);
        $buildingAddress79->setStreetName('Straatnaam A');
        $buildingAddress79->setHouseNumber(10);
        $buildingAddress79->setAddition('I');
        $buildingAddress79->setZipcode('1234AA');
        $buildingAddress79->setCity('Woonplaats A');
        $buildingAddress79->setRentalUnitNumber('TECH0029');
        $buildingAddress79->setDaeb(true);
        $buildingAddress79->setVtw($vtw1);
        $buildingAddress79->setResidentialArea($residentialArea9);
        $buildingAddress79->setBuildingType($buildingType9);
        $buildingAddress79->setLivingType($livingType3);
        $buildingAddress79->setCreationTime();
        $buildingAddress79->setLastChangeTime();

        $buildingAddress80 = new BuildingAddress();
        $buildingAddress80->setConstructionYear(1986);
        $buildingAddress80->setRenovationYear(2002);
        $buildingAddress80->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress80->setHouseNumber(10);
        $buildingAddress80->setAddition('X');
        $buildingAddress80->setZipcode('1234AA');
        $buildingAddress80->setCity('Woonplaats A');
        $buildingAddress80->setRentalUnitNumber('TECH0030');
        $buildingAddress80->setDaeb(true);
        $buildingAddress80->setVtw($vtw1);
        $buildingAddress80->setResidentialArea($residentialArea10);
        $buildingAddress80->setBuildingType($buildingType10);
        $buildingAddress80->setLivingType($livingType3);
        $buildingAddress80->setCreationTime();
        $buildingAddress80->setLastChangeTime();

        $buildingAddress81 = new BuildingAddress();
        $buildingAddress81->setConstructionYear(1954);
        $buildingAddress81->setRenovationYear(1986);
        $buildingAddress81->setStreetName('Straatnaam A');
        $buildingAddress81->setHouseNumber(10);
        $buildingAddress81->setAddition('A');
        $buildingAddress81->setZipcode('1234AA');
        $buildingAddress81->setCity('Woonplaats A');
        $buildingAddress81->setRentalUnitNumber('TECH0031');
        $buildingAddress81->setDaeb(true);
        $buildingAddress81->setVtw($vtw27);
        $buildingAddress81->setResidentialArea($residentialArea1);
        $buildingAddress81->setBuildingType($buildingType1);
        $buildingAddress81->setLivingType($livingType3);
        $buildingAddress81->setCreationTime();
        $buildingAddress81->setLastChangeTime();

        $buildingAddress82 = new BuildingAddress();
        $buildingAddress82->setConstructionYear(1998);
        $buildingAddress82->setRenovationYear(2021);
        $buildingAddress82->setStreetName('Straatnaam A');
        $buildingAddress82->setHouseNumber(10);
        $buildingAddress82->setAddition('A');
        $buildingAddress82->setZipcode('1234AA');
        $buildingAddress82->setCity('Woonplaats A');
        $buildingAddress82->setRentalUnitNumber('TECH0032');
        $buildingAddress82->setDaeb(true);
        $buildingAddress82->setVtw($vtw1);
        $buildingAddress82->setResidentialArea($residentialArea2);
        $buildingAddress82->setBuildingType($buildingType2);
        $buildingAddress82->setLivingType($livingType3);
        $buildingAddress82->setCreationTime();
        $buildingAddress82->setLastChangeTime();

        $buildingAddress83 = new BuildingAddress();
        $buildingAddress83->setConstructionYear(1984);
        $buildingAddress83->setRenovationYear(2000);
        $buildingAddress83->setStreetName('Straatnaam A');
        $buildingAddress83->setHouseNumber(10);
        $buildingAddress83->setAddition('A');
        $buildingAddress83->setZipcode('1234AA');
        $buildingAddress83->setCity('Woonplaats A');
        $buildingAddress83->setRentalUnitNumber('TECH0033');
        $buildingAddress83->setDaeb(true);
        $buildingAddress83->setVtw($vtw1);
        $buildingAddress83->setResidentialArea($residentialArea3);
        $buildingAddress83->setBuildingType($buildingType3);
        $buildingAddress83->setLivingType($livingType3);
        $buildingAddress83->setCreationTime();
        $buildingAddress83->setLastChangeTime();

        $buildingAddress84 = new BuildingAddress();
        $buildingAddress84->setConstructionYear(2010);
        $buildingAddress84->setRenovationYear(2019);
        $buildingAddress84->setStreetName('Straatnaam A');
        $buildingAddress84->setHouseNumber(102);
        $buildingAddress84->setAddition('');
        $buildingAddress84->setZipcode('1234AA');
        $buildingAddress84->setCity('Woonplaats A');
        $buildingAddress84->setRentalUnitNumber('TECH0034');
        $buildingAddress84->setDaeb(false);
        $buildingAddress84->setVtw($vtw1);
        $buildingAddress84->setResidentialArea($residentialArea4);
        $buildingAddress84->setBuildingType($buildingType4);
        $buildingAddress84->setLivingType($livingType3);
        $buildingAddress84->setCreationTime();
        $buildingAddress84->setLastChangeTime();

        $buildingAddress85 = new BuildingAddress();
        $buildingAddress85->setConstructionYear(1988);
        $buildingAddress85->setRenovationYear(2005);
        $buildingAddress85->setStreetName('Straatnaam A');
        $buildingAddress85->setHouseNumber(10);
        $buildingAddress85->setAddition('A');
        $buildingAddress85->setZipcode('1234AA');
        $buildingAddress85->setCity('Woonplaats A');
        $buildingAddress85->setRentalUnitNumber('TECH0035');
        $buildingAddress85->setDaeb(true);
        $buildingAddress85->setVtw($vtw1);
        $buildingAddress85->setResidentialArea($residentialArea5);
        $buildingAddress85->setBuildingType($buildingType5);
        $buildingAddress85->setLivingType($livingType3);
        $buildingAddress85->setCreationTime();
        $buildingAddress85->setLastChangeTime();

        $buildingAddress86 = new BuildingAddress();
        $buildingAddress86->setConstructionYear(1958);
        $buildingAddress86->setRenovationYear(2000);
        $buildingAddress86->setStreetName('Straatnaam A');
        $buildingAddress86->setHouseNumber(10);
        $buildingAddress86->setAddition('A');
        $buildingAddress86->setZipcode('1234AA');
        $buildingAddress86->setCity('Woonplaats A');
        $buildingAddress86->setRentalUnitNumber('TECH0036');
        $buildingAddress86->setDaeb(true);
        $buildingAddress86->setVtw($vtw1);
        $buildingAddress86->setResidentialArea($residentialArea6);
        $buildingAddress86->setBuildingType($buildingType6);
        $buildingAddress86->setLivingType($livingType3);
        $buildingAddress86->setCreationTime();
        $buildingAddress86->setLastChangeTime();

        $buildingAddress87 = new BuildingAddress();
        $buildingAddress87->setConstructionYear(2006);
        $buildingAddress87->setRenovationYear(2016);
        $buildingAddress87->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress87->setHouseNumber(10);
        $buildingAddress87->setAddition('A');
        $buildingAddress87->setZipcode('1234AA');
        $buildingAddress87->setCity('Woonplaats A');
        $buildingAddress87->setRentalUnitNumber('TECH0037');
        $buildingAddress87->setDaeb(true);
        $buildingAddress87->setVtw($vtw1);
        $buildingAddress87->setResidentialArea($residentialArea7);
        $buildingAddress87->setBuildingType($buildingType7);
        $buildingAddress87->setLivingType($livingType3);
        $buildingAddress87->setCreationTime();
        $buildingAddress87->setLastChangeTime();

        $buildingAddress88 = new BuildingAddress();
        $buildingAddress88->setConstructionYear(2000);
        $buildingAddress88->setRenovationYear(2013);
        $buildingAddress88->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress88->setHouseNumber(10);
        $buildingAddress88->setAddition('Bis');
        $buildingAddress88->setZipcode('1234AA');
        $buildingAddress88->setCity('Woonplaats A');
        $buildingAddress88->setRentalUnitNumber('TECH0038');
        $buildingAddress88->setDaeb(false);
        $buildingAddress88->setVtw($vtw1);
        $buildingAddress88->setResidentialArea($residentialArea8);
        $buildingAddress88->setBuildingType($buildingType8);
        $buildingAddress88->setLivingType($livingType3);
        $buildingAddress88->setCreationTime();
        $buildingAddress88->setLastChangeTime();

        $buildingAddress89 = new BuildingAddress();
        $buildingAddress89->setConstructionYear(1976);
        $buildingAddress89->setRenovationYear(2001);
        $buildingAddress89->setStreetName('Straatnaam A');
        $buildingAddress89->setHouseNumber(10);
        $buildingAddress89->setAddition('I');
        $buildingAddress89->setZipcode('1234AA');
        $buildingAddress89->setCity('Woonplaats A');
        $buildingAddress89->setRentalUnitNumber('TECH0039');
        $buildingAddress89->setDaeb(true);
        $buildingAddress89->setVtw($vtw1);
        $buildingAddress89->setResidentialArea($residentialArea9);
        $buildingAddress89->setBuildingType($buildingType9);
        $buildingAddress89->setLivingType($livingType3);
        $buildingAddress89->setCreationTime();
        $buildingAddress89->setLastChangeTime();

        $buildingAddress90 = new BuildingAddress();
        $buildingAddress90->setConstructionYear(1986);
        $buildingAddress90->setRenovationYear(2002);
        $buildingAddress90->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress90->setHouseNumber(10);
        $buildingAddress90->setAddition('X');
        $buildingAddress90->setZipcode('1234AA');
        $buildingAddress90->setCity('Woonplaats A');
        $buildingAddress90->setRentalUnitNumber('TECH0040');
        $buildingAddress90->setDaeb(true);
        $buildingAddress90->setVtw($vtw1);
        $buildingAddress90->setResidentialArea($residentialArea10);
        $buildingAddress90->setBuildingType($buildingType10);
        $buildingAddress90->setLivingType($livingType3);
        $buildingAddress90->setCreationTime();
        $buildingAddress90->setLastChangeTime();

        $buildingAddress91 = new BuildingAddress();
        $buildingAddress91->setConstructionYear(1954);
        $buildingAddress91->setRenovationYear(1986);
        $buildingAddress91->setStreetName('Straatnaam A');
        $buildingAddress91->setHouseNumber(10);
        $buildingAddress91->setAddition('A');
        $buildingAddress91->setZipcode('1234AA');
        $buildingAddress91->setCity('Woonplaats A');
        $buildingAddress91->setRentalUnitNumber('TECH0041');
        $buildingAddress91->setDaeb(true);
        $buildingAddress91->setVtw($vtw42);
        $buildingAddress91->setResidentialArea($residentialArea1);
        $buildingAddress91->setBuildingType($buildingType1);
        $buildingAddress91->setLivingType($livingType3);
        $buildingAddress91->setCreationTime();
        $buildingAddress91->setLastChangeTime();

        $buildingAddress92 = new BuildingAddress();
        $buildingAddress92->setConstructionYear(1998);
        $buildingAddress92->setRenovationYear(2021);
        $buildingAddress92->setStreetName('Straatnaam A');
        $buildingAddress92->setHouseNumber(10);
        $buildingAddress92->setAddition('A');
        $buildingAddress92->setZipcode('1234AA');
        $buildingAddress92->setCity('Woonplaats A');
        $buildingAddress92->setRentalUnitNumber('TECH0042');
        $buildingAddress92->setDaeb(true);
        $buildingAddress92->setVtw($vtw1);
        $buildingAddress92->setResidentialArea($residentialArea2);
        $buildingAddress92->setBuildingType($buildingType2);
        $buildingAddress92->setLivingType($livingType3);
        $buildingAddress92->setCreationTime();
        $buildingAddress92->setLastChangeTime();

        $buildingAddress93 = new BuildingAddress();
        $buildingAddress93->setConstructionYear(1984);
        $buildingAddress93->setRenovationYear(2000);
        $buildingAddress93->setStreetName('Straatnaam A');
        $buildingAddress93->setHouseNumber(10);
        $buildingAddress93->setAddition('A');
        $buildingAddress93->setZipcode('1234AA');
        $buildingAddress93->setCity('Woonplaats A');
        $buildingAddress93->setRentalUnitNumber('TECH0043');
        $buildingAddress93->setDaeb(true);
        $buildingAddress93->setVtw($vtw1);
        $buildingAddress93->setResidentialArea($residentialArea3);
        $buildingAddress93->setBuildingType($buildingType3);
        $buildingAddress93->setLivingType($livingType3);
        $buildingAddress93->setCreationTime();
        $buildingAddress93->setLastChangeTime();

        $buildingAddress94 = new BuildingAddress();
        $buildingAddress94->setConstructionYear(2010);
        $buildingAddress94->setRenovationYear(2019);
        $buildingAddress94->setStreetName('Straatnaam A');
        $buildingAddress94->setHouseNumber(102);
        $buildingAddress94->setAddition('');
        $buildingAddress94->setZipcode('1234AA');
        $buildingAddress94->setCity('Woonplaats A');
        $buildingAddress94->setRentalUnitNumber('TECH0044');
        $buildingAddress94->setDaeb(true);
        $buildingAddress94->setVtw($vtw1);
        $buildingAddress94->setResidentialArea($residentialArea4);
        $buildingAddress94->setBuildingType($buildingType4);
        $buildingAddress94->setLivingType($livingType3);
        $buildingAddress94->setCreationTime();
        $buildingAddress94->setLastChangeTime();

        $buildingAddress95 = new BuildingAddress();
        $buildingAddress95->setConstructionYear(1988);
        $buildingAddress95->setRenovationYear(2005);
        $buildingAddress95->setStreetName('Straatnaam A');
        $buildingAddress95->setHouseNumber(10);
        $buildingAddress95->setAddition('A');
        $buildingAddress95->setZipcode('1234AA');
        $buildingAddress95->setCity('Woonplaats A');
        $buildingAddress95->setRentalUnitNumber('TECH0045');
        $buildingAddress95->setDaeb(true);
        $buildingAddress95->setVtw($vtw1);
        $buildingAddress95->setResidentialArea($residentialArea5);
        $buildingAddress95->setBuildingType($buildingType5);
        $buildingAddress95->setLivingType($livingType3);
        $buildingAddress95->setCreationTime();
        $buildingAddress95->setLastChangeTime();

        $buildingAddress96 = new BuildingAddress();
        $buildingAddress96->setConstructionYear(1958);
        $buildingAddress96->setRenovationYear(2000);
        $buildingAddress96->setStreetName('Straatnaam A');
        $buildingAddress96->setHouseNumber(10);
        $buildingAddress96->setAddition('A');
        $buildingAddress96->setZipcode('1234AA');
        $buildingAddress96->setCity('Woonplaats A');
        $buildingAddress96->setRentalUnitNumber('TECH0046');
        $buildingAddress96->setDaeb(true);
        $buildingAddress96->setVtw($vtw1);
        $buildingAddress96->setResidentialArea($residentialArea6);
        $buildingAddress96->setBuildingType($buildingType6);
        $buildingAddress96->setLivingType($livingType3);
        $buildingAddress96->setCreationTime();
        $buildingAddress96->setLastChangeTime();

        $buildingAddress97 = new BuildingAddress();
        $buildingAddress97->setConstructionYear(2006);
        $buildingAddress97->setRenovationYear(2016);
        $buildingAddress97->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress97->setHouseNumber(10);
        $buildingAddress97->setAddition('A');
        $buildingAddress97->setZipcode('1234AA');
        $buildingAddress97->setCity('Woonplaats A');
        $buildingAddress97->setRentalUnitNumber('TECH0047');
        $buildingAddress97->setDaeb(false);
        $buildingAddress97->setVtw($vtw1);
        $buildingAddress97->setResidentialArea($residentialArea7);
        $buildingAddress97->setBuildingType($buildingType7);
        $buildingAddress97->setLivingType($livingType3);
        $buildingAddress97->setCreationTime();
        $buildingAddress97->setLastChangeTime();

        $buildingAddress98 = new BuildingAddress();
        $buildingAddress98->setConstructionYear(2000);
        $buildingAddress98->setRenovationYear(2021);
        $buildingAddress98->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress98->setHouseNumber(10);
        $buildingAddress98->setAddition('Bis');
        $buildingAddress98->setZipcode('1234AB');
        $buildingAddress98->setCity('Woonplaats A');
        $buildingAddress98->setRentalUnitNumber('TECH0048');
        $buildingAddress98->setDaeb(true);
        $buildingAddress98->setVtw($vtw1);
        $buildingAddress98->setResidentialArea($residentialArea8);
        $buildingAddress98->setBuildingType($buildingType8);
        $buildingAddress98->setLivingType($livingType3);
        $buildingAddress98->setCreationTime();
        $buildingAddress98->setLastChangeTime();

        $buildingAddress99 = new BuildingAddress();
        $buildingAddress99->setConstructionYear(1976);
        $buildingAddress99->setRenovationYear(2001);
        $buildingAddress99->setStreetName('Straatnaam A');
        $buildingAddress99->setHouseNumber(10);
        $buildingAddress99->setAddition('I');
        $buildingAddress99->setZipcode('1234AA');
        $buildingAddress99->setCity('Woonplaats A');
        $buildingAddress99->setRentalUnitNumber('TECH0049');
        $buildingAddress99->setDaeb(true);
        $buildingAddress99->setVtw($vtw1);
        $buildingAddress99->setResidentialArea($residentialArea9);
        $buildingAddress99->setBuildingType($buildingType9);
        $buildingAddress99->setLivingType($livingType3);
        $buildingAddress99->setCreationTime();
        $buildingAddress99->setLastChangeTime();

        $buildingAddress100 = new BuildingAddress();
        $buildingAddress100->setConstructionYear(1986);
        $buildingAddress100->setRenovationYear(2002);
        $buildingAddress100->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress100->setHouseNumber(10);
        $buildingAddress100->setAddition('X');
        $buildingAddress100->setZipcode('1234AA');
        $buildingAddress100->setCity('Woonplaats A');
        $buildingAddress100->setRentalUnitNumber('TECH0050');
        $buildingAddress100->setDaeb(true);
        $buildingAddress100->setVtw($vtw1);
        $buildingAddress100->setResidentialArea($residentialArea10);
        $buildingAddress100->setBuildingType($buildingType10);
        $buildingAddress100->setLivingType($livingType3);
        $buildingAddress100->setCreationTime();
        $buildingAddress100->setLastChangeTime();

        $buildingAddress101 = new BuildingAddress();
        $buildingAddress101->setConstructionYear(1954);
        $buildingAddress101->setRenovationYear(1986);
        $buildingAddress101->setStreetName('Straatnaam A');
        $buildingAddress101->setHouseNumber(10);
        $buildingAddress101->setAddition('A');
        $buildingAddress101->setZipcode('1234AA');
        $buildingAddress101->setCity('Woonplaats A');
        $buildingAddress101->setRentalUnitNumber('ALG0001');
        $buildingAddress101->setDaeb(true);
        $buildingAddress101->setVtw($vtw45);
        $buildingAddress101->setResidentialArea($residentialArea1);
        $buildingAddress101->setBuildingType($buildingType1);
        $buildingAddress101->setLivingType($livingType3);
        $buildingAddress101->setCreationTime();
        $buildingAddress101->setLastChangeTime();

        $buildingAddress102 = new BuildingAddress();
        $buildingAddress102->setConstructionYear(1998);
        $buildingAddress102->setRenovationYear(2021);
        $buildingAddress102->setStreetName('Straatnaam A');
        $buildingAddress102->setHouseNumber(10);
        $buildingAddress102->setAddition('A');
        $buildingAddress102->setZipcode('1234AA');
        $buildingAddress102->setCity('Woonplaats A');
        $buildingAddress102->setRentalUnitNumber('ALG0002');
        $buildingAddress102->setDaeb(true);
        $buildingAddress102->setVtw($vtw1);
        $buildingAddress102->setResidentialArea($residentialArea2);
        $buildingAddress102->setBuildingType($buildingType2);
        $buildingAddress102->setLivingType($livingType3);
        $buildingAddress102->setCreationTime();
        $buildingAddress102->setLastChangeTime();

        $buildingAddress103 = new BuildingAddress();
        $buildingAddress103->setConstructionYear(1984);
        $buildingAddress103->setRenovationYear(2000);
        $buildingAddress103->setStreetName('Straatnaam A');
        $buildingAddress103->setHouseNumber(10);
        $buildingAddress103->setAddition('A');
        $buildingAddress103->setZipcode('1234AA');
        $buildingAddress103->setCity('Woonplaats A');
        $buildingAddress103->setRentalUnitNumber('ALG0003');
        $buildingAddress103->setDaeb(true);
        $buildingAddress103->setVtw($vtw1);
        $buildingAddress103->setResidentialArea($residentialArea3);
        $buildingAddress103->setBuildingType($buildingType3);
        $buildingAddress103->setLivingType($livingType3);
        $buildingAddress103->setCreationTime();
        $buildingAddress103->setLastChangeTime();

        $buildingAddress104 = new BuildingAddress();
        $buildingAddress104->setConstructionYear(2010);
        $buildingAddress104->setRenovationYear(2019);
        $buildingAddress104->setStreetName('Straatnaam A');
        $buildingAddress104->setHouseNumber(102);
        $buildingAddress104->setAddition('');
        $buildingAddress104->setZipcode('1234AA');
        $buildingAddress104->setCity('Woonplaats A');
        $buildingAddress104->setRentalUnitNumber('ALG0004');
        $buildingAddress104->setDaeb(true);
        $buildingAddress104->setVtw($vtw1);
        $buildingAddress104->setResidentialArea($residentialArea4);
        $buildingAddress104->setBuildingType($buildingType4);
        $buildingAddress104->setLivingType($livingType3);
        $buildingAddress104->setCreationTime();
        $buildingAddress104->setLastChangeTime();

        $buildingAddress105 = new BuildingAddress();
        $buildingAddress105->setConstructionYear(1988);
        $buildingAddress105->setRenovationYear(2005);
        $buildingAddress105->setStreetName('Straatnaam A');
        $buildingAddress105->setHouseNumber(10);
        $buildingAddress105->setAddition('A');
        $buildingAddress105->setZipcode('1234AA');
        $buildingAddress105->setCity('Woonplaats A');
        $buildingAddress105->setRentalUnitNumber('ALG0005');
        $buildingAddress105->setDaeb(false);
        $buildingAddress105->setVtw($vtw1);
        $buildingAddress105->setResidentialArea($residentialArea5);
        $buildingAddress105->setBuildingType($buildingType5);
        $buildingAddress105->setLivingType($livingType3);
        $buildingAddress105->setCreationTime();
        $buildingAddress105->setLastChangeTime();

        $buildingAddress106 = new BuildingAddress();
        $buildingAddress106->setConstructionYear(1958);
        $buildingAddress106->setRenovationYear(2000);
        $buildingAddress106->setStreetName('Straatnaam A');
        $buildingAddress106->setHouseNumber(10);
        $buildingAddress106->setAddition('A');
        $buildingAddress106->setZipcode('1234AA');
        $buildingAddress106->setCity('Woonplaats A');
        $buildingAddress106->setRentalUnitNumber('ALG0006');
        $buildingAddress106->setDaeb(true);
        $buildingAddress106->setVtw($vtw1);
        $buildingAddress106->setResidentialArea($residentialArea6);
        $buildingAddress106->setBuildingType($buildingType6);
        $buildingAddress106->setLivingType($livingType3);
        $buildingAddress106->setCreationTime();
        $buildingAddress106->setLastChangeTime();

        $buildingAddress107 = new BuildingAddress();
        $buildingAddress107->setConstructionYear(2006);
        $buildingAddress107->setRenovationYear(2016);
        $buildingAddress107->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress107->setHouseNumber(10);
        $buildingAddress107->setAddition('A');
        $buildingAddress107->setZipcode('1234AA');
        $buildingAddress107->setCity('Woonplaats A');
        $buildingAddress107->setRentalUnitNumber('ALG0007');
        $buildingAddress107->setDaeb(true);
        $buildingAddress107->setVtw($vtw1);
        $buildingAddress107->setResidentialArea($residentialArea7);
        $buildingAddress107->setBuildingType($buildingType7);
        $buildingAddress107->setLivingType($livingType3);
        $buildingAddress107->setCreationTime();
        $buildingAddress107->setLastChangeTime();

        $buildingAddress108 = new BuildingAddress();
        $buildingAddress108->setConstructionYear(2000);
        $buildingAddress108->setRenovationYear(2021);
        $buildingAddress108->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress108->setHouseNumber(10);
        $buildingAddress108->setAddition('Bis');
        $buildingAddress108->setZipcode('1234AA');
        $buildingAddress108->setCity('Woonplaats A');
        $buildingAddress108->setRentalUnitNumber('ALG0008');
        $buildingAddress108->setDaeb(true);
        $buildingAddress108->setVtw($vtw1);
        $buildingAddress108->setResidentialArea($residentialArea8);
        $buildingAddress108->setBuildingType($buildingType8);
        $buildingAddress108->setLivingType($livingType3);
        $buildingAddress108->setCreationTime();
        $buildingAddress108->setLastChangeTime();

        $buildingAddress109 = new BuildingAddress();
        $buildingAddress109->setConstructionYear(1976);
        $buildingAddress109->setRenovationYear(2001);
        $buildingAddress109->setStreetName('Straatnaam A');
        $buildingAddress109->setHouseNumber(10);
        $buildingAddress109->setAddition('I');
        $buildingAddress109->setZipcode('1234AA');
        $buildingAddress109->setCity('Woonplaats A');
        $buildingAddress109->setRentalUnitNumber('ALG0009');
        $buildingAddress109->setDaeb(true);
        $buildingAddress109->setVtw($vtw1);
        $buildingAddress109->setResidentialArea($residentialArea9);
        $buildingAddress109->setBuildingType($buildingType9);
        $buildingAddress109->setLivingType($livingType3);
        $buildingAddress109->setCreationTime();
        $buildingAddress109->setLastChangeTime();

        $buildingAddress110 = new BuildingAddress();
        $buildingAddress110->setConstructionYear(1986);
        $buildingAddress110->setRenovationYear(2002);
        $buildingAddress110->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress110->setHouseNumber(10);
        $buildingAddress110->setAddition('X');
        $buildingAddress110->setZipcode('1234AA');
        $buildingAddress110->setCity('Woonplaats A');
        $buildingAddress110->setRentalUnitNumber('ALG0010');
        $buildingAddress110->setDaeb(true);
        $buildingAddress110->setVtw($vtw1);
        $buildingAddress110->setResidentialArea($residentialArea10);
        $buildingAddress110->setBuildingType($buildingType10);
        $buildingAddress110->setLivingType($livingType3);
        $buildingAddress110->setCreationTime();
        $buildingAddress110->setLastChangeTime();

        $buildingAddress111 = new BuildingAddress();
        $buildingAddress111->setConstructionYear(1954);
        $buildingAddress111->setRenovationYear(1986);
        $buildingAddress111->setStreetName('Straatnaam A');
        $buildingAddress111->setHouseNumber(10);
        $buildingAddress111->setAddition('A');
        $buildingAddress111->setZipcode('1234AA');
        $buildingAddress111->setCity('Woonplaats A');
        $buildingAddress111->setRentalUnitNumber('ALG0011');
        $buildingAddress111->setDaeb(true);
        $buildingAddress111->setVtw($vtw67);
        $buildingAddress111->setResidentialArea($residentialArea1);
        $buildingAddress111->setBuildingType($buildingType1);
        $buildingAddress111->setLivingType($livingType3);
        $buildingAddress111->setCreationTime();
        $buildingAddress111->setLastChangeTime();

        $buildingAddress112 = new BuildingAddress();
        $buildingAddress112->setConstructionYear(1998);
        $buildingAddress112->setRenovationYear(2021);
        $buildingAddress112->setStreetName('Straatnaam A');
        $buildingAddress112->setHouseNumber(10);
        $buildingAddress112->setAddition('A');
        $buildingAddress112->setZipcode('1234AA');
        $buildingAddress112->setCity('Woonplaats A');
        $buildingAddress112->setRentalUnitNumber('ALG0012');
        $buildingAddress112->setDaeb(true);
        $buildingAddress112->setVtw($vtw1);
        $buildingAddress112->setResidentialArea($residentialArea2);
        $buildingAddress112->setBuildingType($buildingType2);
        $buildingAddress112->setLivingType($livingType3);
        $buildingAddress112->setCreationTime();
        $buildingAddress112->setLastChangeTime();

        $buildingAddress113 = new BuildingAddress();
        $buildingAddress113->setConstructionYear(1984);
        $buildingAddress113->setRenovationYear(2000);
        $buildingAddress113->setStreetName('Straatnaam A');
        $buildingAddress113->setHouseNumber(10);
        $buildingAddress113->setAddition('A');
        $buildingAddress113->setZipcode('1234AA');
        $buildingAddress113->setCity('Woonplaats A');
        $buildingAddress113->setRentalUnitNumber('ALG0013');
        $buildingAddress113->setDaeb(true);
        $buildingAddress113->setVtw($vtw1);
        $buildingAddress113->setResidentialArea($residentialArea3);
        $buildingAddress113->setBuildingType($buildingType3);
        $buildingAddress113->setLivingType($livingType3);
        $buildingAddress113->setCreationTime();
        $buildingAddress113->setLastChangeTime();

        $buildingAddress114 = new BuildingAddress();
        $buildingAddress114->setConstructionYear(2010);
        $buildingAddress114->setRenovationYear(2019);
        $buildingAddress114->setStreetName('Straatnaam A');
        $buildingAddress114->setHouseNumber(102);
        $buildingAddress114->setAddition('');
        $buildingAddress114->setZipcode('1234AA');
        $buildingAddress114->setCity('Woonplaats A');
        $buildingAddress114->setRentalUnitNumber('ALG0014');
        $buildingAddress114->setDaeb(true);
        $buildingAddress114->setVtw($vtw1);
        $buildingAddress114->setResidentialArea($residentialArea4);
        $buildingAddress114->setBuildingType($buildingType4);
        $buildingAddress114->setLivingType($livingType3);
        $buildingAddress114->setCreationTime();
        $buildingAddress114->setLastChangeTime();

        $buildingAddress115 = new BuildingAddress();
        $buildingAddress115->setConstructionYear(1988);
        $buildingAddress115->setRenovationYear(2005);
        $buildingAddress115->setStreetName('Straatnaam A');
        $buildingAddress115->setHouseNumber(10);
        $buildingAddress115->setAddition('A');
        $buildingAddress115->setZipcode('1234AA');
        $buildingAddress115->setCity('Woonplaats A');
        $buildingAddress115->setRentalUnitNumber('ALG0015');
        $buildingAddress115->setDaeb(true);
        $buildingAddress115->setVtw($vtw1);
        $buildingAddress115->setResidentialArea($residentialArea5);
        $buildingAddress115->setBuildingType($buildingType5);
        $buildingAddress115->setLivingType($livingType3);
        $buildingAddress115->setCreationTime();
        $buildingAddress115->setLastChangeTime();

        $buildingAddress116 = new BuildingAddress();
        $buildingAddress116->setConstructionYear(1958);
        $buildingAddress116->setRenovationYear(2000);
        $buildingAddress116->setStreetName('Straatnaam A');
        $buildingAddress116->setHouseNumber(10);
        $buildingAddress116->setAddition('A');
        $buildingAddress116->setZipcode('1234AA');
        $buildingAddress116->setCity('Woonplaats A');
        $buildingAddress116->setRentalUnitNumber('ALG0016');
        $buildingAddress116->setDaeb(true);
        $buildingAddress116->setVtw($vtw1);
        $buildingAddress116->setResidentialArea($residentialArea6);
        $buildingAddress116->setBuildingType($buildingType6);
        $buildingAddress116->setLivingType($livingType3);
        $buildingAddress116->setCreationTime();
        $buildingAddress116->setLastChangeTime();

        $buildingAddress117 = new BuildingAddress();
        $buildingAddress117->setConstructionYear(2006);
        $buildingAddress117->setRenovationYear(2016);
        $buildingAddress117->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress117->setHouseNumber(10);
        $buildingAddress117->setAddition('A');
        $buildingAddress117->setZipcode('1234AA');
        $buildingAddress117->setCity('Woonplaats A');
        $buildingAddress117->setRentalUnitNumber('ALG0017');
        $buildingAddress117->setDaeb(true);
        $buildingAddress117->setVtw($vtw1);
        $buildingAddress117->setResidentialArea($residentialArea7);
        $buildingAddress117->setBuildingType($buildingType7);
        $buildingAddress117->setLivingType($livingType3);
        $buildingAddress117->setCreationTime();
        $buildingAddress117->setLastChangeTime();

        $buildingAddress118 = new BuildingAddress();
        $buildingAddress118->setConstructionYear(2000);
        $buildingAddress118->setRenovationYear(2021);
        $buildingAddress118->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress118->setHouseNumber(10);
        $buildingAddress118->setAddition('Bis');
        $buildingAddress118->setZipcode('1234AB');
        $buildingAddress118->setCity('Woonplaats A');
        $buildingAddress118->setRentalUnitNumber('ALG0018');
        $buildingAddress118->setDaeb(true);
        $buildingAddress118->setVtw($vtw1);
        $buildingAddress118->setResidentialArea($residentialArea8);
        $buildingAddress118->setBuildingType($buildingType8);
        $buildingAddress118->setLivingType($livingType3);
        $buildingAddress118->setCreationTime();
        $buildingAddress118->setLastChangeTime();

        $buildingAddress119 = new BuildingAddress();
        $buildingAddress119->setConstructionYear(1976);
        $buildingAddress119->setRenovationYear(2001);
        $buildingAddress119->setStreetName('Straatnaam A');
        $buildingAddress119->setHouseNumber(10);
        $buildingAddress119->setAddition('I');
        $buildingAddress119->setZipcode('1234AA');
        $buildingAddress119->setCity('Woonplaats A');
        $buildingAddress119->setRentalUnitNumber('ALG0019');
        $buildingAddress119->setDaeb(true);
        $buildingAddress119->setVtw($vtw1);
        $buildingAddress119->setResidentialArea($residentialArea9);
        $buildingAddress119->setBuildingType($buildingType9);
        $buildingAddress119->setLivingType($livingType3);
        $buildingAddress119->setCreationTime();
        $buildingAddress119->setLastChangeTime();

        $buildingAddress120 = new BuildingAddress();
        $buildingAddress120->setConstructionYear(1986);
        $buildingAddress120->setRenovationYear(2002);
        $buildingAddress120->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress120->setHouseNumber(10);
        $buildingAddress120->setAddition('X');
        $buildingAddress120->setZipcode('1234AA');
        $buildingAddress120->setCity('Woonplaats A');
        $buildingAddress120->setRentalUnitNumber('ALG0020');
        $buildingAddress120->setDaeb(true);
        $buildingAddress120->setVtw($vtw1);
        $buildingAddress120->setResidentialArea($residentialArea10);
        $buildingAddress120->setBuildingType($buildingType10);
        $buildingAddress120->setLivingType($livingType3);
        $buildingAddress120->setCreationTime();
        $buildingAddress120->setLastChangeTime();

        $buildingAddress121 = new BuildingAddress();
        $buildingAddress121->setConstructionYear(1954);
        $buildingAddress121->setRenovationYear(1986);
        $buildingAddress121->setStreetName('Straatnaam A');
        $buildingAddress121->setHouseNumber(10);
        $buildingAddress121->setAddition('A');
        $buildingAddress121->setZipcode('1234AA');
        $buildingAddress121->setCity('Woonplaats A');
        $buildingAddress121->setRentalUnitNumber('ALG0021');
        $buildingAddress121->setDaeb(true);
        $buildingAddress121->setVtw($vtw58);
        $buildingAddress121->setResidentialArea($residentialArea1);
        $buildingAddress121->setBuildingType($buildingType1);
        $buildingAddress121->setLivingType($livingType3);
        $buildingAddress121->setCreationTime();
        $buildingAddress121->setLastChangeTime();

        $buildingAddress122 = new BuildingAddress();
        $buildingAddress122->setConstructionYear(1998);
        $buildingAddress122->setRenovationYear(2021);
        $buildingAddress122->setStreetName('Straatnaam A');
        $buildingAddress122->setHouseNumber(10);
        $buildingAddress122->setAddition('A');
        $buildingAddress122->setZipcode('1234AA');
        $buildingAddress122->setCity('Woonplaats A');
        $buildingAddress122->setRentalUnitNumber('ALG0022');
        $buildingAddress122->setDaeb(true);
        $buildingAddress122->setVtw($vtw1);
        $buildingAddress122->setResidentialArea($residentialArea2);
        $buildingAddress122->setBuildingType($buildingType2);
        $buildingAddress122->setLivingType($livingType3);
        $buildingAddress122->setCreationTime();
        $buildingAddress122->setLastChangeTime();

        $buildingAddress123 = new BuildingAddress();
        $buildingAddress123->setConstructionYear(1984);
        $buildingAddress123->setRenovationYear(2000);
        $buildingAddress123->setStreetName('Straatnaam A');
        $buildingAddress123->setHouseNumber(10);
        $buildingAddress123->setAddition('A');
        $buildingAddress123->setZipcode('1234AA');
        $buildingAddress123->setCity('Woonplaats A');
        $buildingAddress123->setRentalUnitNumber('ALG0023');
        $buildingAddress123->setDaeb(true);
        $buildingAddress123->setVtw($vtw1);
        $buildingAddress123->setResidentialArea($residentialArea3);
        $buildingAddress123->setBuildingType($buildingType3);
        $buildingAddress123->setLivingType($livingType3);
        $buildingAddress123->setCreationTime();
        $buildingAddress123->setLastChangeTime();

        $buildingAddress124 = new BuildingAddress();
        $buildingAddress124->setConstructionYear(2010);
        $buildingAddress124->setRenovationYear(2019);
        $buildingAddress124->setStreetName('Straatnaam A');
        $buildingAddress124->setHouseNumber(102);
        $buildingAddress124->setAddition('');
        $buildingAddress124->setZipcode('1234AA');
        $buildingAddress124->setCity('Woonplaats A');
        $buildingAddress124->setRentalUnitNumber('ALG0024');
        $buildingAddress124->setDaeb(true);
        $buildingAddress124->setVtw($vtw1);
        $buildingAddress124->setResidentialArea($residentialArea4);
        $buildingAddress124->setBuildingType($buildingType4);
        $buildingAddress124->setLivingType($livingType3);
        $buildingAddress124->setCreationTime();
        $buildingAddress124->setLastChangeTime();

        $buildingAddress125 = new BuildingAddress();
        $buildingAddress125->setConstructionYear(1988);
        $buildingAddress125->setRenovationYear(2005);
        $buildingAddress125->setStreetName('Straatnaam A');
        $buildingAddress125->setHouseNumber(10);
        $buildingAddress125->setAddition('A');
        $buildingAddress125->setZipcode('1234AA');
        $buildingAddress125->setCity('Woonplaats A');
        $buildingAddress125->setRentalUnitNumber('ALG0025');
        $buildingAddress125->setDaeb(true);
        $buildingAddress125->setVtw($vtw1);
        $buildingAddress125->setResidentialArea($residentialArea5);
        $buildingAddress125->setBuildingType($buildingType5);
        $buildingAddress125->setLivingType($livingType3);
        $buildingAddress125->setCreationTime();
        $buildingAddress125->setLastChangeTime();

        $buildingAddress126 = new BuildingAddress();
        $buildingAddress126->setConstructionYear(1958);
        $buildingAddress126->setRenovationYear(2000);
        $buildingAddress126->setStreetName('Straatnaam A');
        $buildingAddress126->setHouseNumber(10);
        $buildingAddress126->setAddition('A');
        $buildingAddress126->setZipcode('1234AA');
        $buildingAddress126->setCity('Woonplaats A');
        $buildingAddress126->setRentalUnitNumber('ALG0026');
        $buildingAddress126->setDaeb(true);
        $buildingAddress126->setVtw($vtw1);
        $buildingAddress126->setResidentialArea($residentialArea6);
        $buildingAddress126->setBuildingType($buildingType6);
        $buildingAddress126->setLivingType($livingType3);
        $buildingAddress126->setCreationTime();
        $buildingAddress126->setLastChangeTime();

        $buildingAddress127 = new BuildingAddress();
        $buildingAddress127->setConstructionYear(2006);
        $buildingAddress127->setRenovationYear(2016);
        $buildingAddress127->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress127->setHouseNumber(10);
        $buildingAddress127->setAddition('A');
        $buildingAddress127->setZipcode('1234AA');
        $buildingAddress127->setCity('Woonplaats A');
        $buildingAddress127->setRentalUnitNumber('ALG0027');
        $buildingAddress127->setDaeb(true);
        $buildingAddress127->setVtw($vtw1);
        $buildingAddress127->setResidentialArea($residentialArea7);
        $buildingAddress127->setBuildingType($buildingType7);
        $buildingAddress127->setLivingType($livingType3);
        $buildingAddress127->setCreationTime();
        $buildingAddress127->setLastChangeTime();
 
        $buildingAddress128 = new BuildingAddress();
        $buildingAddress128->setConstructionYear(2000);
        $buildingAddress128->setRenovationYear(2021);
        $buildingAddress128->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress128->setHouseNumber(10);
        $buildingAddress128->setAddition('Bis');
        $buildingAddress128->setZipcode('1234AB');
        $buildingAddress128->setCity('Woonplaats A');
        $buildingAddress128->setRentalUnitNumber('ALG0028');
        $buildingAddress128->setDaeb(true);
        $buildingAddress128->setVtw($vtw1);
        $buildingAddress128->setResidentialArea($residentialArea8);
        $buildingAddress128->setBuildingType($buildingType8);
        $buildingAddress128->setLivingType($livingType3);
        $buildingAddress128->setCreationTime();
        $buildingAddress128->setLastChangeTime();

        $buildingAddress129 = new BuildingAddress();
        $buildingAddress129->setConstructionYear(1976);
        $buildingAddress129->setRenovationYear(2001);
        $buildingAddress129->setStreetName('Straatnaam A');
        $buildingAddress129->setHouseNumber(10);
        $buildingAddress129->setAddition('I');
        $buildingAddress129->setZipcode('1234AA');
        $buildingAddress129->setCity('Woonplaats A');
        $buildingAddress129->setRentalUnitNumber('ALG0029');
        $buildingAddress129->setDaeb(true);
        $buildingAddress129->setVtw($vtw1);
        $buildingAddress129->setResidentialArea($residentialArea9);
        $buildingAddress129->setBuildingType($buildingType9);
        $buildingAddress129->setLivingType($livingType3);
        $buildingAddress129->setCreationTime();
        $buildingAddress129->setLastChangeTime();

        $buildingAddress130 = new BuildingAddress();
        $buildingAddress130->setConstructionYear(1986);
        $buildingAddress130->setRenovationYear(2002);
        $buildingAddress130->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress130->setHouseNumber(10);
        $buildingAddress130->setAddition('X');
        $buildingAddress130->setZipcode('1234AA');
        $buildingAddress130->setCity('Woonplaats A');
        $buildingAddress130->setRentalUnitNumber('ALG0030');
        $buildingAddress130->setDaeb(true);
        $buildingAddress130->setVtw($vtw1);
        $buildingAddress130->setResidentialArea($residentialArea10);
        $buildingAddress130->setBuildingType($buildingType10);
        $buildingAddress130->setLivingType($livingType3);
        $buildingAddress130->setCreationTime();
        $buildingAddress130->setLastChangeTime();

        $buildingAddress131 = new BuildingAddress();
        $buildingAddress131->setConstructionYear(1986);
        $buildingAddress131->setRenovationYear(2002);
        $buildingAddress131->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress131->setHouseNumber(10);
        $buildingAddress131->setAddition('X');
        $buildingAddress131->setZipcode('1234AA');
        $buildingAddress131->setCity('Woonplaats A');
        $buildingAddress131->setRentalUnitNumber('ALG0031');
        $buildingAddress131->setDaeb(true);
        $buildingAddress131->setVtw($vtw1);
        $buildingAddress131->setResidentialArea($residentialArea10);
        $buildingAddress131->setBuildingType($buildingType10);
        $buildingAddress131->setLivingType($livingType3);
        $buildingAddress131->setCreationTime();
        $buildingAddress131->setLastChangeTime();

        $buildingAddress132 = new BuildingAddress();
        $buildingAddress132->setConstructionYear(1986);
        $buildingAddress132->setRenovationYear(2002);
        $buildingAddress132->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress132->setHouseNumber(10);
        $buildingAddress132->setAddition('X');
        $buildingAddress132->setZipcode('1234AA');
        $buildingAddress132->setCity('Woonplaats A');
        $buildingAddress132->setRentalUnitNumber('ALG0032');
        $buildingAddress132->setDaeb(true);
        $buildingAddress132->setVtw($vtw1);
        $buildingAddress132->setResidentialArea($residentialArea10);
        $buildingAddress132->setBuildingType($buildingType10);
        $buildingAddress132->setLivingType($livingType3);
        $buildingAddress132->setCreationTime();
        $buildingAddress132->setLastChangeTime();

        $buildingAddress133 = new BuildingAddress();
        $buildingAddress133->setConstructionYear(1986);
        $buildingAddress133->setRenovationYear(2002);
        $buildingAddress133->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress133->setHouseNumber(10);
        $buildingAddress133->setAddition('X');
        $buildingAddress133->setZipcode('1234AA');
        $buildingAddress133->setCity('Woonplaats A');
        $buildingAddress133->setRentalUnitNumber('ALG0033');
        $buildingAddress133->setDaeb(true);
        $buildingAddress133->setVtw($vtw1);
        $buildingAddress133->setResidentialArea($residentialArea10);
        $buildingAddress133->setBuildingType($buildingType10);
        $buildingAddress133->setLivingType($livingType3);
        $buildingAddress133->setCreationTime();
        $buildingAddress133->setLastChangeTime();

        $buildingAddress134 = new BuildingAddress();
        $buildingAddress134->setConstructionYear(1986);
        $buildingAddress134->setRenovationYear(2002);
        $buildingAddress134->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress134->setHouseNumber(10);
        $buildingAddress134->setAddition('X');
        $buildingAddress134->setZipcode('1234AA');
        $buildingAddress134->setCity('Woonplaats A');
        $buildingAddress134->setRentalUnitNumber('ALG0034');
        $buildingAddress134->setDaeb(true);
        $buildingAddress134->setVtw($vtw1);
        $buildingAddress134->setResidentialArea($residentialArea10);
        $buildingAddress134->setBuildingType($buildingType10);
        $buildingAddress134->setLivingType($livingType3);
        $buildingAddress134->setCreationTime();
        $buildingAddress134->setLastChangeTime();

        $buildingAddress135 = new BuildingAddress();
        $buildingAddress135->setConstructionYear(1986);
        $buildingAddress135->setRenovationYear(2002);
        $buildingAddress135->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress135->setHouseNumber(10);
        $buildingAddress135->setAddition('X');
        $buildingAddress135->setZipcode('1234AA');
        $buildingAddress135->setCity('Woonplaats A');
        $buildingAddress135->setRentalUnitNumber('ALG0035');
        $buildingAddress135->setDaeb(true);
        $buildingAddress135->setVtw($vtw1);
        $buildingAddress135->setResidentialArea($residentialArea10);
        $buildingAddress135->setBuildingType($buildingType10);
        $buildingAddress135->setLivingType($livingType3);
        $buildingAddress135->setCreationTime();
        $buildingAddress135->setLastChangeTime();

        $buildingAddress136 = new BuildingAddress();
        $buildingAddress136->setConstructionYear(1986);
        $buildingAddress136->setRenovationYear(2002);
        $buildingAddress136->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress136->setHouseNumber(10);
        $buildingAddress136->setAddition('X');
        $buildingAddress136->setZipcode('1234AA');
        $buildingAddress136->setCity('Woonplaats A');
        $buildingAddress136->setRentalUnitNumber('ALG0036');
        $buildingAddress136->setDaeb(true);
        $buildingAddress136->setVtw($vtw1);
        $buildingAddress136->setResidentialArea($residentialArea10);
        $buildingAddress136->setBuildingType($buildingType10);
        $buildingAddress136->setLivingType($livingType3);
        $buildingAddress136->setCreationTime();
        $buildingAddress136->setLastChangeTime();

        $buildingAddress137 = new BuildingAddress();
        $buildingAddress137->setConstructionYear(1986);
        $buildingAddress137->setRenovationYear(2002);
        $buildingAddress137->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress137->setHouseNumber(10);
        $buildingAddress137->setAddition('X');
        $buildingAddress137->setZipcode('1234AA');
        $buildingAddress137->setCity('Woonplaats A');
        $buildingAddress137->setRentalUnitNumber('ALG0037');
        $buildingAddress137->setDaeb(true);
        $buildingAddress137->setVtw($vtw1);
        $buildingAddress137->setResidentialArea($residentialArea10);
        $buildingAddress137->setBuildingType($buildingType10);
        $buildingAddress137->setLivingType($livingType3);
        $buildingAddress137->setCreationTime();
        $buildingAddress137->setLastChangeTime();

        $buildingAddress138 = new BuildingAddress();
        $buildingAddress138->setConstructionYear(1986);
        $buildingAddress138->setRenovationYear(2002);
        $buildingAddress138->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress138->setHouseNumber(10);
        $buildingAddress138->setAddition('X');
        $buildingAddress138->setZipcode('1234AA');
        $buildingAddress138->setCity('Woonplaats A');
        $buildingAddress138->setRentalUnitNumber('ALG0038');
        $buildingAddress138->setDaeb(true);
        $buildingAddress138->setVtw($vtw1);
        $buildingAddress138->setResidentialArea($residentialArea10);
        $buildingAddress138->setBuildingType($buildingType10);
        $buildingAddress138->setLivingType($livingType3);
        $buildingAddress138->setCreationTime();
        $buildingAddress138->setLastChangeTime();

        $buildingAddress139 = new BuildingAddress();
        $buildingAddress139->setConstructionYear(1986);
        $buildingAddress139->setRenovationYear(2002);
        $buildingAddress139->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress139->setHouseNumber(10);
        $buildingAddress139->setAddition('X');
        $buildingAddress139->setZipcode('1234AA');
        $buildingAddress139->setCity('Woonplaats A');
        $buildingAddress139->setRentalUnitNumber('ALG0039');
        $buildingAddress139->setDaeb(true);
        $buildingAddress139->setVtw($vtw1);
        $buildingAddress139->setResidentialArea($residentialArea10);
        $buildingAddress139->setBuildingType($buildingType10);
        $buildingAddress139->setLivingType($livingType3);
        $buildingAddress139->setCreationTime();
        $buildingAddress139->setLastChangeTime();

        $buildingAddress140 = new BuildingAddress();
        $buildingAddress140->setConstructionYear(2010);
        $buildingAddress140->setRenovationYear(2019);
        $buildingAddress140->setStreetName('Straatnaam A');
        $buildingAddress140->setHouseNumber(102);
        $buildingAddress140->setAddition('');
        $buildingAddress140->setZipcode('1234AA');
        $buildingAddress140->setCity('Woonplaats A');
        $buildingAddress140->setRentalUnitNumber('ALG0040');
        $buildingAddress140->setDaeb(true);
        $buildingAddress140->setVtw($vtw1);
        $buildingAddress140->setResidentialArea($residentialArea4);
        $buildingAddress140->setBuildingType($buildingType4);
        $buildingAddress140->setLivingType($livingType1);
        $buildingAddress140->setCreationTime();
        $buildingAddress140->setLastChangeTime();

        $buildingAddress141 = new BuildingAddress();
        $buildingAddress141->setConstructionYear(2010);
        $buildingAddress141->setRenovationYear(2019);
        $buildingAddress141->setStreetName('Straatnaam A');
        $buildingAddress141->setHouseNumber(102);
        $buildingAddress141->setAddition('');
        $buildingAddress141->setZipcode('1234AA');
        $buildingAddress141->setCity('Woonplaats A');
        $buildingAddress141->setRentalUnitNumber('ALG0041');
        $buildingAddress141->setDaeb(true);
        $buildingAddress141->setVtw($vtw1);
        $buildingAddress141->setResidentialArea($residentialArea4);
        $buildingAddress141->setBuildingType($buildingType4);
        $buildingAddress141->setLivingType($livingType1);
        $buildingAddress141->setCreationTime();
        $buildingAddress141->setLastChangeTime();

        $buildingAddress142 = new BuildingAddress();
        $buildingAddress142->setConstructionYear(2010);
        $buildingAddress142->setRenovationYear(2019);
        $buildingAddress142->setStreetName('Straatnaam A');
        $buildingAddress142->setHouseNumber(102);
        $buildingAddress142->setAddition('');
        $buildingAddress142->setZipcode('1234AA');
        $buildingAddress142->setCity('Woonplaats A');
        $buildingAddress142->setRentalUnitNumber('ALG0042');
        $buildingAddress142->setDaeb(true);
        $buildingAddress142->setVtw($vtw1);
        $buildingAddress142->setResidentialArea($residentialArea4);
        $buildingAddress142->setBuildingType($buildingType4);
        $buildingAddress142->setLivingType($livingType1);
        $buildingAddress142->setCreationTime();
        $buildingAddress142->setLastChangeTime();

        $buildingAddress143 = new BuildingAddress();
        $buildingAddress143->setConstructionYear(2010);
        $buildingAddress143->setRenovationYear(2019);
        $buildingAddress143->setStreetName('Straatnaam A');
        $buildingAddress143->setHouseNumber(102);
        $buildingAddress143->setAddition('');
        $buildingAddress143->setZipcode('1234AA');
        $buildingAddress143->setCity('Woonplaats A');
        $buildingAddress143->setRentalUnitNumber('ALG0043');
        $buildingAddress143->setDaeb(true);
        $buildingAddress143->setVtw($vtw1);
        $buildingAddress143->setResidentialArea($residentialArea4);
        $buildingAddress143->setBuildingType($buildingType4);
        $buildingAddress143->setLivingType($livingType1);
        $buildingAddress143->setCreationTime();
        $buildingAddress143->setLastChangeTime();

        $buildingAddress144 = new BuildingAddress();
        $buildingAddress144->setConstructionYear(2010);
        $buildingAddress144->setRenovationYear(2019);
        $buildingAddress144->setStreetName('Straatnaam A');
        $buildingAddress144->setHouseNumber(102);
        $buildingAddress144->setAddition('');
        $buildingAddress144->setZipcode('1234AA');
        $buildingAddress144->setCity('Woonplaats A');
        $buildingAddress144->setRentalUnitNumber('ALG0044');
        $buildingAddress144->setDaeb(true);
        $buildingAddress144->setVtw($vtw1);
        $buildingAddress144->setResidentialArea($residentialArea4);
        $buildingAddress144->setBuildingType($buildingType4);
        $buildingAddress144->setLivingType($livingType1);
        $buildingAddress144->setCreationTime();
        $buildingAddress144->setLastChangeTime();

        $buildingAddress145 = new BuildingAddress();
        $buildingAddress145->setConstructionYear(2010);
        $buildingAddress145->setRenovationYear(2019);
        $buildingAddress145->setStreetName('Straatnaam A');
        $buildingAddress145->setHouseNumber(102);
        $buildingAddress145->setAddition('');
        $buildingAddress145->setZipcode('1234AA');
        $buildingAddress145->setCity('Woonplaats A');
        $buildingAddress145->setRentalUnitNumber('ALG0045');
        $buildingAddress145->setDaeb(true);
        $buildingAddress145->setVtw($vtw1);
        $buildingAddress145->setResidentialArea($residentialArea4);
        $buildingAddress145->setBuildingType($buildingType4);
        $buildingAddress145->setLivingType($livingType1);
        $buildingAddress145->setCreationTime();
        $buildingAddress145->setLastChangeTime();

        $buildingAddress146 = new BuildingAddress();
        $buildingAddress146->setConstructionYear(2010);
        $buildingAddress146->setRenovationYear(2019);
        $buildingAddress146->setStreetName('Straatnaam A');
        $buildingAddress146->setHouseNumber(102);
        $buildingAddress146->setAddition('');
        $buildingAddress146->setZipcode('1234AA');
        $buildingAddress146->setCity('Woonplaats A');
        $buildingAddress146->setRentalUnitNumber('ALG0046');
        $buildingAddress146->setDaeb(true);
        $buildingAddress146->setVtw($vtw1);
        $buildingAddress146->setResidentialArea($residentialArea4);
        $buildingAddress146->setBuildingType($buildingType4);
        $buildingAddress146->setLivingType($livingType1);
        $buildingAddress146->setCreationTime();
        $buildingAddress146->setLastChangeTime();

        $buildingAddress147 = new BuildingAddress();
        $buildingAddress147->setConstructionYear(2010);
        $buildingAddress147->setRenovationYear(2019);
        $buildingAddress147->setStreetName('Straatnaam A');
        $buildingAddress147->setHouseNumber(102);
        $buildingAddress147->setAddition('');
        $buildingAddress147->setZipcode('1234AA');
        $buildingAddress147->setCity('Woonplaats A');
        $buildingAddress147->setRentalUnitNumber('ALG0047');
        $buildingAddress147->setDaeb(true);
        $buildingAddress147->setVtw($vtw1);
        $buildingAddress147->setResidentialArea($residentialArea4);
        $buildingAddress147->setBuildingType($buildingType4);
        $buildingAddress147->setLivingType($livingType1);
        $buildingAddress147->setCreationTime();
        $buildingAddress147->setLastChangeTime();

        $buildingAddress148 = new BuildingAddress();
        $buildingAddress148->setConstructionYear(2010);
        $buildingAddress148->setRenovationYear(2019);
        $buildingAddress148->setStreetName('Straatnaam A');
        $buildingAddress148->setHouseNumber(102);
        $buildingAddress148->setAddition('');
        $buildingAddress148->setZipcode('1234AA');
        $buildingAddress148->setCity('Woonplaats A');
        $buildingAddress148->setRentalUnitNumber('ALG0048');
        $buildingAddress148->setDaeb(true);
        $buildingAddress148->setVtw($vtw1);
        $buildingAddress148->setResidentialArea($residentialArea4);
        $buildingAddress148->setBuildingType($buildingType4);
        $buildingAddress148->setLivingType($livingType1);
        $buildingAddress148->setCreationTime();
        $buildingAddress148->setLastChangeTime();

        $buildingAddress149 = new BuildingAddress();
        $buildingAddress149->setConstructionYear(2010);
        $buildingAddress149->setRenovationYear(2019);
        $buildingAddress149->setStreetName('Straatnaam A');
        $buildingAddress149->setHouseNumber(102);
        $buildingAddress149->setAddition('');
        $buildingAddress149->setZipcode('1234AA');
        $buildingAddress149->setCity('Woonplaats A');
        $buildingAddress149->setRentalUnitNumber('ALG0049');
        $buildingAddress149->setDaeb(true);
        $buildingAddress149->setVtw($vtw1);
        $buildingAddress149->setResidentialArea($residentialArea4);
        $buildingAddress149->setBuildingType($buildingType4);
        $buildingAddress149->setLivingType($livingType1);
        $buildingAddress149->setCreationTime();
        $buildingAddress149->setLastChangeTime();

        $buildingAddress150 = new BuildingAddress();
        $buildingAddress150->setConstructionYear(1988);
        $buildingAddress150->setRenovationYear(2005);
        $buildingAddress150->setStreetName('Kerkstraat');
        $buildingAddress150->setHouseNumber(1);
        $buildingAddress150->setAddition('');
        $buildingAddress150->setZipcode('9021KL');
        $buildingAddress150->setCity('Bedum');
        $buildingAddress150->setRentalUnitNumber('ALG0050');
        $buildingAddress150->setDaeb(true);
        $buildingAddress150->setVtw($vtw164);
        $buildingAddress150->setResidentialArea($residentialArea5);
        $buildingAddress150->setBuildingType($buildingType5);
        $buildingAddress150->setLivingType($livingType2);
        $buildingAddress150->setCreationTime();
        $buildingAddress150->setLastChangeTime();

        $buildingAddress151 = new BuildingAddress();
        $buildingAddress151->setConstructionYear(1988);
        $buildingAddress151->setRenovationYear(2005);
        $buildingAddress151->setStreetName('Kerkstraat');
        $buildingAddress151->setHouseNumber(3);
        $buildingAddress151->setAddition('');
        $buildingAddress151->setZipcode('9021KL');
        $buildingAddress151->setCity('Bedum');
        $buildingAddress151->setRentalUnitNumber('E-0001');
        $buildingAddress151->setDaeb(true);
        $buildingAddress151->setVtw($vtw164);
        $buildingAddress151->setResidentialArea($residentialArea5);
        $buildingAddress151->setBuildingType($buildingType5);
        $buildingAddress151->setLivingType($livingType2);
        $buildingAddress151->setCreationTime();
        $buildingAddress151->setLastChangeTime();

        $buildingAddress152 = new BuildingAddress();
        $buildingAddress152->setConstructionYear(1988);
        $buildingAddress152->setRenovationYear(2005);
        $buildingAddress152->setStreetName('Kerkstraat');
        $buildingAddress152->setHouseNumber(5);
        $buildingAddress152->setAddition('');
        $buildingAddress152->setZipcode('9021KL');
        $buildingAddress152->setCity('Bedum');
        $buildingAddress152->setRentalUnitNumber('E-0002');
        $buildingAddress152->setDaeb(true);
        $buildingAddress152->setVtw($vtw164);
        $buildingAddress152->setResidentialArea($residentialArea5);
        $buildingAddress152->setBuildingType($buildingType5);
        $buildingAddress152->setLivingType($livingType2);
        $buildingAddress152->setCreationTime();
        $buildingAddress152->setLastChangeTime();

        $buildingAddress153 = new BuildingAddress();
        $buildingAddress153->setConstructionYear(1988);
        $buildingAddress153->setRenovationYear(2005);
        $buildingAddress153->setStreetName('Kerkstraat');
        $buildingAddress153->setHouseNumber(7);
        $buildingAddress153->setAddition('');
        $buildingAddress153->setZipcode('9021KL');
        $buildingAddress153->setCity('Bedum');
        $buildingAddress153->setRentalUnitNumber('E-0003');
        $buildingAddress153->setDaeb(true);
        $buildingAddress153->setVtw($vtw164);
        $buildingAddress153->setResidentialArea($residentialArea5);
        $buildingAddress153->setBuildingType($buildingType5);
        $buildingAddress153->setLivingType($livingType2);
        $buildingAddress153->setCreationTime();
        $buildingAddress153->setLastChangeTime();

        $buildingAddress154 = new BuildingAddress();
        $buildingAddress154->setConstructionYear(1988);
        $buildingAddress154->setRenovationYear(2005);
        $buildingAddress154->setStreetName('Kerkstraat');
        $buildingAddress154->setHouseNumber(9);
        $buildingAddress154->setAddition('');
        $buildingAddress154->setZipcode('9021KL');
        $buildingAddress154->setCity('Bedum');
        $buildingAddress154->setRentalUnitNumber('E-0004');
        $buildingAddress154->setDaeb(true);
        $buildingAddress154->setVtw($vtw164);
        $buildingAddress154->setResidentialArea($residentialArea5);
        $buildingAddress154->setBuildingType($buildingType5);
        $buildingAddress154->setLivingType($livingType2);
        $buildingAddress154->setCreationTime();
        $buildingAddress154->setLastChangeTime();

        $buildingAddress155 = new BuildingAddress();
        $buildingAddress155->setConstructionYear(1988);
        $buildingAddress155->setRenovationYear(2005);
        $buildingAddress155->setStreetName('Kerkstraat');
        $buildingAddress155->setHouseNumber(9);
        $buildingAddress155->setAddition('A');
        $buildingAddress155->setZipcode('9021KL');
        $buildingAddress155->setCity('Bedum');
        $buildingAddress155->setRentalUnitNumber('E-0005');
        $buildingAddress155->setDaeb(true);
        $buildingAddress155->setVtw($vtw164);
        $buildingAddress155->setResidentialArea($residentialArea5);
        $buildingAddress155->setBuildingType($buildingType5);
        $buildingAddress155->setLivingType($livingType2);
        $buildingAddress155->setCreationTime();
        $buildingAddress155->setLastChangeTime();

        $buildingAddress156 = new BuildingAddress();
        $buildingAddress156->setConstructionYear(1988);
        $buildingAddress156->setRenovationYear(2005);
        $buildingAddress156->setStreetName('Bergweg');
        $buildingAddress156->setHouseNumber(2);
        $buildingAddress156->setAddition('');
        $buildingAddress156->setZipcode('9451GV');
        $buildingAddress156->setCity('Bedum');
        $buildingAddress156->setRentalUnitNumber('E-0006');
        $buildingAddress156->setDaeb(true);
        $buildingAddress156->setVtw($vtw54);
        $buildingAddress156->setResidentialArea($residentialArea5);
        $buildingAddress156->setBuildingType($buildingType5);
        $buildingAddress156->setLivingType($livingType2);
        $buildingAddress156->setCreationTime();
        $buildingAddress156->setLastChangeTime();

        $buildingAddress157 = new BuildingAddress();
        $buildingAddress157->setConstructionYear(1988);
        $buildingAddress157->setStreetName('Bergweg');
        $buildingAddress157->setHouseNumber(4);
        $buildingAddress157->setAddition('');
        $buildingAddress157->setZipcode('9451GV');
        $buildingAddress157->setCity('Bedum');
        $buildingAddress157->setRentalUnitNumber('E-0007');
        $buildingAddress157->setDaeb(true);
        $buildingAddress157->setVtw($vtw54);
        $buildingAddress157->setResidentialArea($residentialArea5);
        $buildingAddress157->setBuildingType($buildingType5);
        $buildingAddress157->setLivingType($livingType2);
        $buildingAddress157->setCreationTime();
        $buildingAddress157->setLastChangeTime();

        $buildingAddress158 = new BuildingAddress();
        $buildingAddress158->setConstructionYear(1988);
        $buildingAddress158->setRenovationYear(2005);
        $buildingAddress158->setStreetName('Bergweg');
        $buildingAddress158->setHouseNumber(6);
        $buildingAddress158->setAddition('');
        $buildingAddress158->setZipcode('9451GV');
        $buildingAddress158->setCity('Bedum');
        $buildingAddress158->setRentalUnitNumber('E-0008');
        $buildingAddress158->setDaeb(true);
        $buildingAddress158->setVtw($vtw54);
        $buildingAddress158->setResidentialArea($residentialArea5);
        $buildingAddress158->setBuildingType($buildingType5);
        $buildingAddress158->setLivingType($livingType2);
        $buildingAddress158->setCreationTime();
        $buildingAddress158->setLastChangeTime();

        $buildingAddress159 = new BuildingAddress();
        $buildingAddress159->setConstructionYear(1988);
        $buildingAddress159->setRenovationYear(2005);
        $buildingAddress159->setStreetName('Bergweg');
        $buildingAddress159->setHouseNumber(8);
        $buildingAddress159->setAddition('');
        $buildingAddress159->setZipcode('9451GV');
        $buildingAddress159->setCity('Bedum');
        $buildingAddress159->setRentalUnitNumber('E-0009');
        $buildingAddress159->setDaeb(true);
        $buildingAddress159->setVtw($vtw54);
        $buildingAddress159->setResidentialArea($residentialArea5);
        $buildingAddress159->setBuildingType($buildingType5);
        $buildingAddress159->setLivingType($livingType2);
        $buildingAddress159->setCreationTime();
        $buildingAddress159->setLastChangeTime();

        $buildingAddress160 = new BuildingAddress();
        $buildingAddress160->setConstructionYear(1958);
        $buildingAddress160->setRenovationYear(2000);
        $buildingAddress160->setStreetName('Bergweg');
        $buildingAddress160->setHouseNumber(10);
        $buildingAddress160->setAddition('');
        $buildingAddress160->setZipcode('9451GV');
        $buildingAddress160->setCity('Bedum');
        $buildingAddress160->setRentalUnitNumber('E-0010');
        $buildingAddress160->setDaeb(true);
        $buildingAddress160->setVtw($vtw54);
        $buildingAddress160->setResidentialArea($residentialArea6);
        $buildingAddress160->setBuildingType($buildingType6);
        $buildingAddress160->setLivingType($livingType2);
        $buildingAddress160->setCreationTime();
        $buildingAddress160->setLastChangeTime();

        $buildingAddress161 = new BuildingAddress();
        $buildingAddress161->setConstructionYear(1978);
        $buildingAddress161->setRenovationYear(2000);
        $buildingAddress161->setStreetName('Strümwegh');
        $buildingAddress161->setHouseNumber(97);
        $buildingAddress161->setAddition('A');
        $buildingAddress161->setZipcode('4234GA');
        $buildingAddress161->setCity('Bedum');
        $buildingAddress161->setRentalUnitNumber('E-0011');
        $buildingAddress161->setDaeb(true);
        $buildingAddress161->setVtw($vtw54);
        $buildingAddress161->setResidentialArea($residentialArea6);
        $buildingAddress161->setBuildingType($buildingType6);
        $buildingAddress161->setLivingType($livingType2);
        $buildingAddress161->setCreationTime();
        $buildingAddress161->setLastChangeTime();

        $buildingAddress162 = new BuildingAddress();
        $buildingAddress162->setConstructionYear(1978);
        $buildingAddress162->setRenovationYear(2000);
        $buildingAddress162->setStreetName('Strümwegh');
        $buildingAddress162->setHouseNumber(99);
        $buildingAddress162->setAddition('A');
        $buildingAddress162->setZipcode('4234GA');
        $buildingAddress162->setCity('Bedum');
        $buildingAddress162->setRentalUnitNumber('E-0012');
        $buildingAddress162->setDaeb(true);
        $buildingAddress162->setVtw($vtw1);
        $buildingAddress162->setResidentialArea($residentialArea6);
        $buildingAddress162->setBuildingType($buildingType6);
        $buildingAddress162->setLivingType($livingType2);
        $buildingAddress162->setCreationTime();
        $buildingAddress162->setLastChangeTime();

        $buildingAddress163 = new BuildingAddress();
        $buildingAddress163->setConstructionYear(1958);
        $buildingAddress163->setRenovationYear(2000);
        $buildingAddress163->setStreetName('Strümwegh');
        $buildingAddress163->setHouseNumber(101);
        $buildingAddress163->setAddition('A');
        $buildingAddress163->setZipcode('4234GA');
        $buildingAddress163->setCity('Bedum');
        $buildingAddress163->setRentalUnitNumber('E-0013');
        $buildingAddress163->setDaeb(true);
        $buildingAddress163->setVtw($vtw1);
        $buildingAddress163->setResidentialArea($residentialArea6);
        $buildingAddress163->setBuildingType($buildingType6);
        $buildingAddress163->setLivingType($livingType2);
        $buildingAddress163->setCreationTime();
        $buildingAddress163->setLastChangeTime();

        $buildingAddress164 = new BuildingAddress();
        $buildingAddress164->setConstructionYear(1978);
        $buildingAddress164->setRenovationYear(2000);
        $buildingAddress164->setStreetName('Strümwegh');
        $buildingAddress164->setHouseNumber(103);
        $buildingAddress164->setAddition('A');
        $buildingAddress164->setZipcode('4234GA');
        $buildingAddress164->setCity('Bedum');
        $buildingAddress164->setRentalUnitNumber('E-0014');
        $buildingAddress164->setDaeb(true);
        $buildingAddress164->setVtw($vtw1);
        $buildingAddress164->setResidentialArea($residentialArea6);
        $buildingAddress164->setBuildingType($buildingType6);
        $buildingAddress164->setLivingType($livingType2);
        $buildingAddress164->setCreationTime();
        $buildingAddress164->setLastChangeTime();

        $buildingAddress165 = new BuildingAddress();
        $buildingAddress165->setConstructionYear(1978);
        $buildingAddress165->setRenovationYear(2000);
        $buildingAddress165->setStreetName('Strümwegh');
        $buildingAddress165->setHouseNumber(105);
        $buildingAddress165->setAddition('');
        $buildingAddress165->setZipcode('4234GA');
        $buildingAddress165->setCity('Bedum');
        $buildingAddress165->setRentalUnitNumber('E-0015');
        $buildingAddress165->setDaeb(true);
        $buildingAddress165->setVtw($vtw1);
        $buildingAddress165->setResidentialArea($residentialArea6);
        $buildingAddress165->setBuildingType($buildingType6);
        $buildingAddress165->setLivingType($livingType2);
        $buildingAddress165->setCreationTime();
        $buildingAddress165->setLastChangeTime();

        $buildingAddress166 = new BuildingAddress();
        $buildingAddress166->setConstructionYear(1978);
        $buildingAddress166->setRenovationYear(2000);
        $buildingAddress166->setStreetName('Strümwegh');
        $buildingAddress166->setHouseNumber(107);
        $buildingAddress166->setAddition('');
        $buildingAddress166->setZipcode('4234GA');
        $buildingAddress166->setCity('Bedum');
        $buildingAddress166->setRentalUnitNumber('E-0016');
        $buildingAddress166->setDaeb(true);
        $buildingAddress166->setVtw($vtw1);
        $buildingAddress166->setResidentialArea($residentialArea6);
        $buildingAddress166->setBuildingType($buildingType6);
        $buildingAddress166->setLivingType($livingType2);
        $buildingAddress166->setCreationTime();
        $buildingAddress166->setLastChangeTime();

        $buildingAddress167 = new BuildingAddress();
        $buildingAddress167->setConstructionYear(1978);
        $buildingAddress167->setRenovationYear(2000);
        $buildingAddress167->setStreetName('Strümwegh');
        $buildingAddress167->setHouseNumber(109);
        $buildingAddress167->setAddition('');
        $buildingAddress167->setZipcode('4234GA');
        $buildingAddress167->setCity('Bedum');
        $buildingAddress167->setRentalUnitNumber('E-0017');
        $buildingAddress167->setDaeb(true);
        $buildingAddress167->setVtw($vtw1);
        $buildingAddress167->setResidentialArea($residentialArea6);
        $buildingAddress167->setBuildingType($buildingType6);
        $buildingAddress167->setLivingType($livingType2);
        $buildingAddress167->setCreationTime();
        $buildingAddress167->setLastChangeTime();

        $buildingAddress168 = new BuildingAddress();
        $buildingAddress168->setConstructionYear(1978);
        $buildingAddress168->setRenovationYear(2000);
        $buildingAddress168->setStreetName('Strümwegh');
        $buildingAddress168->setHouseNumber(111);
        $buildingAddress168->setAddition('');
        $buildingAddress168->setZipcode('4234GA');
        $buildingAddress168->setCity('Bedum');
        $buildingAddress168->setRentalUnitNumber('E-0018');
        $buildingAddress168->setDaeb(true);
        $buildingAddress168->setVtw($vtw1);
        $buildingAddress168->setResidentialArea($residentialArea6);
        $buildingAddress168->setBuildingType($buildingType6);
        $buildingAddress168->setLivingType($livingType2);
        $buildingAddress168->setCreationTime();
        $buildingAddress168->setLastChangeTime();

        $buildingAddress169 = new BuildingAddress();
        $buildingAddress169->setConstructionYear(1978);
        $buildingAddress169->setRenovationYear(2000);
        $buildingAddress169->setStreetName('Strümwegh');
        $buildingAddress169->setHouseNumber(2);
        $buildingAddress169->setAddition('A');
        $buildingAddress169->setZipcode('4234GA');
        $buildingAddress169->setCity('Bedum');
        $buildingAddress169->setRentalUnitNumber('E-0019');
        $buildingAddress169->setDaeb(true);
        $buildingAddress169->setVtw($vtw1);
        $buildingAddress169->setResidentialArea($residentialArea7);
        $buildingAddress169->setBuildingType($buildingType7);
        $buildingAddress169->setLivingType($livingType2);
        $buildingAddress169->setCreationTime();
        $buildingAddress169->setLastChangeTime();

        $buildingAddress170 = new BuildingAddress();
        $buildingAddress170->setConstructionYear(1978);
        $buildingAddress170->setRenovationYear(2000);
        $buildingAddress170->setStreetName('Strümwegh');
        $buildingAddress170->setHouseNumber(4);
        $buildingAddress170->setAddition('A');
        $buildingAddress170->setZipcode('4234GA');
        $buildingAddress170->setCity('Bedum');
        $buildingAddress170->setRentalUnitNumber('E-0020');
        $buildingAddress170->setDaeb(true);
        $buildingAddress170->setVtw($vtw1);
        $buildingAddress170->setResidentialArea($residentialArea7);
        $buildingAddress170->setBuildingType($buildingType7);
        $buildingAddress170->setLivingType($livingType2);
        $buildingAddress170->setCreationTime();
        $buildingAddress170->setLastChangeTime();

        $buildingAddress171 = new BuildingAddress();
        $buildingAddress171->setConstructionYear(1978);
        $buildingAddress171->setRenovationYear(2000);
        $buildingAddress171->setStreetName('Grote Strümwegh');
        $buildingAddress171->setHouseNumber(6);
        $buildingAddress171->setAddition('A');
        $buildingAddress171->setZipcode('9234FA');
        $buildingAddress171->setCity('Groningen');
        $buildingAddress171->setRentalUnitNumber('E-0021');
        $buildingAddress171->setDaeb(true);
        $buildingAddress171->setVtw($vtw1);
        $buildingAddress171->setResidentialArea($residentialArea7);
        $buildingAddress171->setBuildingType($buildingType7);
        $buildingAddress171->setLivingType($livingType2);
        $buildingAddress171->setCreationTime();
        $buildingAddress171->setLastChangeTime();

        $buildingAddress172 = new BuildingAddress();
        $buildingAddress172->setConstructionYear(1978);
        $buildingAddress172->setRenovationYear(2000);
        $buildingAddress172->setStreetName('Grote Strümwegh');
        $buildingAddress172->setHouseNumber(8);
        $buildingAddress172->setAddition('A');
        $buildingAddress172->setZipcode('9034GH');
        $buildingAddress172->setCity('Groningen');
        $buildingAddress172->setRentalUnitNumber('E-0022');
        $buildingAddress172->setDaeb(true);
        $buildingAddress172->setVtw($vtw1);
        $buildingAddress172->setResidentialArea($residentialArea7);
        $buildingAddress172->setBuildingType($buildingType7);
        $buildingAddress172->setLivingType($livingType2);
        $buildingAddress172->setCreationTime();
        $buildingAddress172->setLastChangeTime();

        $buildingAddress173 = new BuildingAddress();
        $buildingAddress173->setConstructionYear(1978);
        $buildingAddress173->setRenovationYear(2000);
        $buildingAddress173->setStreetName('Grote Strümwegh');
        $buildingAddress173->setHouseNumber(10);
        $buildingAddress173->setAddition('A');
        $buildingAddress173->setZipcode('9034GH');
        $buildingAddress173->setCity('Groningen');
        $buildingAddress173->setRentalUnitNumber('E-0023');
        $buildingAddress173->setDaeb(true);
        $buildingAddress173->setVtw($vtw1);
        $buildingAddress173->setResidentialArea($residentialArea7);
        $buildingAddress173->setBuildingType($buildingType7);
        $buildingAddress173->setLivingType($livingType2);
        $buildingAddress173->setCreationTime();
        $buildingAddress173->setLastChangeTime();

        $buildingAddress174 = new BuildingAddress();
        $buildingAddress174->setConstructionYear(1978);
        $buildingAddress174->setRenovationYear(2000);
        $buildingAddress174->setStreetName('Grote Strümwegh');
        $buildingAddress174->setHouseNumber(12);
        $buildingAddress174->setAddition('A');
        $buildingAddress174->setZipcode('9034GH');
        $buildingAddress174->setCity('Groningen');
        $buildingAddress174->setRentalUnitNumber('E-0024');
        $buildingAddress174->setDaeb(true);
        $buildingAddress174->setVtw($vtw1);
        $buildingAddress174->setResidentialArea($residentialArea7);
        $buildingAddress174->setBuildingType($buildingType7);
        $buildingAddress174->setLivingType($livingType2);
        $buildingAddress174->setCreationTime();
        $buildingAddress174->setLastChangeTime();

        $buildingAddress175 = new BuildingAddress();
        $buildingAddress175->setConstructionYear(1978);
        $buildingAddress175->setRenovationYear(2000);
        $buildingAddress175->setStreetName('Grote Strümwegh');
        $buildingAddress175->setHouseNumber(14);
        $buildingAddress175->setAddition('A');
        $buildingAddress175->setZipcode('9034GH');
        $buildingAddress175->setCity('Groningen');
        $buildingAddress175->setRentalUnitNumber('E-0025');
        $buildingAddress175->setDaeb(true);
        $buildingAddress175->setVtw($vtw20);
        $buildingAddress175->setResidentialArea($residentialArea7);
        $buildingAddress175->setBuildingType($buildingType7);
        $buildingAddress175->setLivingType($livingType2);
        $buildingAddress175->setCreationTime();
        $buildingAddress175->setLastChangeTime();

        $buildingAddress176 = new BuildingAddress();
        $buildingAddress176->setConstructionYear(1978);
        $buildingAddress176->setRenovationYear(2000);
        $buildingAddress176->setStreetName('Grote Strümwegh');
        $buildingAddress176->setHouseNumber(16);
        $buildingAddress176->setAddition('A');
        $buildingAddress176->setZipcode('9034GH');
        $buildingAddress176->setCity('Groningen');
        $buildingAddress176->setRentalUnitNumber('E-0026');
        $buildingAddress176->setDaeb(true);
        $buildingAddress176->setVtw($vtw20);
        $buildingAddress176->setResidentialArea($residentialArea7);
        $buildingAddress176->setBuildingType($buildingType7);
        $buildingAddress176->setLivingType($livingType4);
        $buildingAddress176->setCreationTime();
        $buildingAddress176->setLastChangeTime();

        $buildingAddress177 = new BuildingAddress();
        $buildingAddress177->setConstructionYear(2006);
        $buildingAddress177->setRenovationYear(2022);
        $buildingAddress177->setStreetName('æŒRǿndestraat');
        $buildingAddress177->setHouseNumber(18);
        $buildingAddress177->setAddition('A');
        $buildingAddress177->setZipcode('9034GH');
        $buildingAddress177->setCity('Groningen');
        $buildingAddress177->setRentalUnitNumber('E-0027');
        $buildingAddress177->setDaeb(true);
        $buildingAddress177->setVtw($vtw20);
        $buildingAddress177->setResidentialArea($residentialArea7);
        $buildingAddress177->setBuildingType($buildingType7);
        $buildingAddress177->setLivingType($livingType4);
        $buildingAddress177->setCreationTime();
        $buildingAddress177->setLastChangeTime();

        $buildingAddress178 = new BuildingAddress();
        $buildingAddress178->setConstructionYear(2006);
        $buildingAddress178->setRenovationYear(2022);
        $buildingAddress178->setStreetName('æŒRǿndestraat');
        $buildingAddress178->setHouseNumber(20);
        $buildingAddress178->setAddition('A');
        $buildingAddress178->setZipcode('9034GH');
        $buildingAddress178->setCity('Groningen');
        $buildingAddress178->setRentalUnitNumber('E-0028');
        $buildingAddress178->setDaeb(true);
        $buildingAddress178->setVtw($vtw20);
        $buildingAddress178->setResidentialArea($residentialArea7);
        $buildingAddress178->setBuildingType($buildingType7);
        $buildingAddress178->setLivingType($livingType4);
        $buildingAddress178->setCreationTime();
        $buildingAddress178->setLastChangeTime();

        $buildingAddress179 = new BuildingAddress();
        $buildingAddress179->setConstructionYear(2006);
        $buildingAddress179->setRenovationYear(2022);
        $buildingAddress179->setStreetName('æŒRǿndestraat');
        $buildingAddress179->setHouseNumber(22);
        $buildingAddress179->setAddition('Bis');
        $buildingAddress179->setZipcode('9034GH');
        $buildingAddress179->setCity('Groningen');
        $buildingAddress179->setRentalUnitNumber('E-0029');
        $buildingAddress179->setDaeb(true);
        $buildingAddress179->setVtw($vtw1);
        $buildingAddress179->setResidentialArea($residentialArea8);
        $buildingAddress179->setBuildingType($buildingType8);
        $buildingAddress179->setLivingType($livingType2);
        $buildingAddress179->setCreationTime();
        $buildingAddress179->setLastChangeTime();

        $buildingAddress180 = new BuildingAddress();
        $buildingAddress180->setConstructionYear(2006);
        $buildingAddress180->setRenovationYear(2022);
        $buildingAddress180->setStreetName('æŒRǿndestraat');
        $buildingAddress180->setHouseNumber(4);
        $buildingAddress180->setAddition('Bis');
        $buildingAddress180->setZipcode('9034GR');
        $buildingAddress180->setCity('Groningen');
        $buildingAddress180->setRentalUnitNumber('E-0030');
        $buildingAddress180->setDaeb(false);
        $buildingAddress180->setVtw($vtw1);
        $buildingAddress180->setResidentialArea($residentialArea8);
        $buildingAddress180->setBuildingType($buildingType8);
        $buildingAddress180->setLivingType($livingType2);
        $buildingAddress180->setCreationTime();
        $buildingAddress180->setLastChangeTime();

        $buildingAddress181 = new BuildingAddress();
        $buildingAddress181->setConstructionYear(2006);
        $buildingAddress181->setRenovationYear(2022);
        $buildingAddress181->setStreetName('æŒRǿndestraat');
        $buildingAddress181->setHouseNumber(6);
        $buildingAddress181->setAddition('Bis');
        $buildingAddress181->setZipcode('9034GR');
        $buildingAddress181->setCity('Groningen');
        $buildingAddress181->setRentalUnitNumber('E-0031');
        $buildingAddress181->setDaeb(false);
        $buildingAddress181->setVtw($vtw2);
        $buildingAddress181->setResidentialArea($residentialArea8);
        $buildingAddress181->setBuildingType($buildingType8);
        $buildingAddress181->setLivingType($livingType2);
        $buildingAddress181->setCreationTime();
        $buildingAddress181->setLastChangeTime();

        $buildingAddress182 = new BuildingAddress();
        $buildingAddress182->setConstructionYear(2006);
        $buildingAddress182->setRenovationYear(2022);
        $buildingAddress182->setStreetName('æŒRǿndestraat');
        $buildingAddress182->setHouseNumber(8);
        $buildingAddress182->setAddition('Bis');
        $buildingAddress182->setZipcode('9034GR');
        $buildingAddress182->setCity('Groningen');
        $buildingAddress182->setRentalUnitNumber('E-0032');
        $buildingAddress182->setDaeb(false);
        $buildingAddress182->setVtw($vtw3);
        $buildingAddress182->setResidentialArea($residentialArea8);
        $buildingAddress182->setBuildingType($buildingType8);
        $buildingAddress182->setLivingType($livingType2);
        $buildingAddress182->setCreationTime();
        $buildingAddress182->setLastChangeTime();

        $buildingAddress183 = new BuildingAddress();
        $buildingAddress183->setConstructionYear(2006);
        $buildingAddress183->setRenovationYear(2022);
        $buildingAddress183->setStreetName('æŒRǿndestraat');
        $buildingAddress183->setHouseNumber(10);
        $buildingAddress183->setAddition('Bis');
        $buildingAddress183->setZipcode('9034GR');
        $buildingAddress183->setCity('Groningen');
        $buildingAddress183->setRentalUnitNumber('E-0033');
        $buildingAddress183->setDaeb(false);
        $buildingAddress183->setVtw($vtw4);
        $buildingAddress183->setResidentialArea($residentialArea8);
        $buildingAddress183->setBuildingType($buildingType8);
        $buildingAddress183->setLivingType($livingType2);
        $buildingAddress183->setCreationTime();
        $buildingAddress183->setLastChangeTime();

        $buildingAddress184 = new BuildingAddress();
        $buildingAddress184->setConstructionYear(2006);
        $buildingAddress184->setRenovationYear(2022);
        $buildingAddress184->setStreetName('æŒRǿndestraat');
        $buildingAddress184->setHouseNumber(12);
        $buildingAddress184->setAddition('Bis');
        $buildingAddress184->setZipcode('9034GR');
        $buildingAddress184->setCity('Groningen');
        $buildingAddress184->setRentalUnitNumber('E-0034');
        $buildingAddress184->setDaeb(false);
        $buildingAddress184->setVtw($vtw5);
        $buildingAddress184->setResidentialArea($residentialArea8);
        $buildingAddress184->setBuildingType($buildingType8);
        $buildingAddress184->setLivingType($livingType2);
        $buildingAddress184->setCreationTime();
        $buildingAddress184->setLastChangeTime();

        $buildingAddress185 = new BuildingAddress();
        $buildingAddress185->setConstructionYear(2006);
        $buildingAddress185->setRenovationYear(2022);
        $buildingAddress185->setStreetName('æŒRǿndestraat');
        $buildingAddress185->setHouseNumber(14);
        $buildingAddress185->setAddition('Bis');
        $buildingAddress185->setZipcode('9034GR');
        $buildingAddress185->setCity('Groningen');
        $buildingAddress185->setRentalUnitNumber('E-0035');
        $buildingAddress185->setDaeb(false);
        $buildingAddress185->setVtw($vtw6);
        $buildingAddress185->setResidentialArea($residentialArea8);
        $buildingAddress185->setBuildingType($buildingType8);
        $buildingAddress185->setLivingType($livingType2);
        $buildingAddress185->setCreationTime();
        $buildingAddress185->setLastChangeTime();

        $buildingAddress186 = new BuildingAddress();
        $buildingAddress186->setConstructionYear(2006);
        $buildingAddress186->setRenovationYear(2022);
        $buildingAddress186->setStreetName('æŒRǿndestraat');
        $buildingAddress186->setHouseNumber(16);
        $buildingAddress186->setAddition('Bis');
        $buildingAddress186->setZipcode('9034GR');
        $buildingAddress186->setCity('Groningen');
        $buildingAddress186->setRentalUnitNumber('E-0036');
        $buildingAddress186->setDaeb(false);
        $buildingAddress186->setVtw($vtw7);
        $buildingAddress186->setResidentialArea($residentialArea8);
        $buildingAddress186->setBuildingType($buildingType8);
        $buildingAddress186->setLivingType($livingType2);
        $buildingAddress186->setCreationTime();
        $buildingAddress186->setLastChangeTime();

        $buildingAddress187 = new BuildingAddress();
        $buildingAddress187->setConstructionYear(2006);
        $buildingAddress187->setRenovationYear(2022);
        $buildingAddress187->setStreetName('æŒRǿndestraat');
        $buildingAddress187->setHouseNumber(18);
        $buildingAddress187->setAddition('Bis');
        $buildingAddress187->setZipcode('9034GR');
        $buildingAddress187->setCity('Groningen');
        $buildingAddress187->setRentalUnitNumber('E-0037');
        $buildingAddress187->setDaeb(false);
        $buildingAddress187->setVtw($vtw8);
        $buildingAddress187->setResidentialArea($residentialArea8);
        $buildingAddress187->setBuildingType($buildingType8);
        $buildingAddress187->setLivingType($livingType2);
        $buildingAddress187->setCreationTime();
        $buildingAddress187->setLastChangeTime();

        $buildingAddress188 = new BuildingAddress();
        $buildingAddress188->setConstructionYear(2006);
        $buildingAddress188->setRenovationYear(2022);
        $buildingAddress188->setStreetName('æŒRǿndestraat');
        $buildingAddress188->setHouseNumber(20);
        $buildingAddress188->setAddition('Bis');
        $buildingAddress188->setZipcode('9034GR');
        $buildingAddress188->setCity('Groningen');
        $buildingAddress188->setRentalUnitNumber('E-0038');
        $buildingAddress188->setDaeb(false);
        $buildingAddress188->setVtw($vtw9);
        $buildingAddress188->setResidentialArea($residentialArea8);
        $buildingAddress188->setBuildingType($buildingType8);
        $buildingAddress188->setLivingType($livingType2);
        $buildingAddress188->setCreationTime();
        $buildingAddress188->setLastChangeTime();

        $buildingAddress189 = new BuildingAddress();
        $buildingAddress189->setConstructionYear(1976);
        $buildingAddress189->setRenovationYear(2001);
        $buildingAddress189->setStreetName('æŒRǿndestraat');
        $buildingAddress189->setHouseNumber(22);
        $buildingAddress189->setAddition('Bis');
        $buildingAddress189->setZipcode('9034GR');
        $buildingAddress189->setCity('Groningen');
        $buildingAddress189->setRentalUnitNumber('E-0039');
        $buildingAddress189->setDaeb(true);
        $buildingAddress189->setVtw($vtw10);
        $buildingAddress189->setResidentialArea($residentialArea8);
        $buildingAddress189->setBuildingType($buildingType8);
        $buildingAddress189->setLivingType($livingType2);
        $buildingAddress189->setCreationTime();
        $buildingAddress189->setLastChangeTime();

        $buildingAddress190 = new BuildingAddress();
        $buildingAddress190->setConstructionYear(1976);
        $buildingAddress190->setRenovationYear(2001);
        $buildingAddress190->setStreetName('æŒRǿndestraat');
        $buildingAddress190->setHouseNumber(22);
        $buildingAddress190->setAddition('I');
        $buildingAddress190->setZipcode('9034GR');
        $buildingAddress190->setCity('Groningen');
        $buildingAddress190->setRentalUnitNumber('E-0040');
        $buildingAddress190->setDaeb(true);
        $buildingAddress190->setVtw($vtw10);
        $buildingAddress190->setResidentialArea($residentialArea9);
        $buildingAddress190->setBuildingType($buildingType9);
        $buildingAddress190->setLivingType($livingType2);
        $buildingAddress190->setCreationTime();
        $buildingAddress190->setLastChangeTime();

        $buildingAddress191 = new BuildingAddress();
        $buildingAddress191->setConstructionYear(1976);
        $buildingAddress191->setRenovationYear(2001);
        $buildingAddress191->setStreetName('æŒRǿndestraat');
        $buildingAddress191->setHouseNumber(20);
        $buildingAddress191->setAddition('I');
        $buildingAddress191->setZipcode('9034FR');
        $buildingAddress191->setCity('Groningen');
        $buildingAddress191->setRentalUnitNumber('E-0041');
        $buildingAddress191->setDaeb(true);
        $buildingAddress191->setVtw($vtw2);
        $buildingAddress191->setResidentialArea($residentialArea9);
        $buildingAddress191->setBuildingType($buildingType9);
        $buildingAddress191->setLivingType($livingType2);
        $buildingAddress191->setCreationTime();
        $buildingAddress191->setLastChangeTime();

        $buildingAddress192 = new BuildingAddress();
        $buildingAddress192->setConstructionYear(1976);
        $buildingAddress192->setRenovationYear(2001);
        $buildingAddress192->setStreetName('æŒRǿndestraat');
        $buildingAddress192->setHouseNumber(2);
        $buildingAddress192->setAddition('I');
        $buildingAddress192->setZipcode('9034FR');
        $buildingAddress192->setCity('Groningen');
        $buildingAddress192->setRentalUnitNumber('E-0042');
        $buildingAddress192->setDaeb(true);
        $buildingAddress192->setVtw($vtw3);
        $buildingAddress192->setResidentialArea($residentialArea9);
        $buildingAddress192->setBuildingType($buildingType9);
        $buildingAddress192->setLivingType($livingType2);
        $buildingAddress192->setCreationTime();
        $buildingAddress192->setLastChangeTime();

        $buildingAddress193 = new BuildingAddress();
        $buildingAddress193->setConstructionYear(1976);
        $buildingAddress193->setRenovationYear(2001);
        $buildingAddress193->setStreetName('æŒRǿndestraat');
        $buildingAddress193->setHouseNumber(4);
        $buildingAddress193->setAddition('I');
        $buildingAddress193->setZipcode('9034FR');
        $buildingAddress193->setCity('Groningen');
        $buildingAddress193->setRentalUnitNumber('E-0043');
        $buildingAddress193->setDaeb(true);
        $buildingAddress193->setVtw($vtw4);
        $buildingAddress193->setResidentialArea($residentialArea9);
        $buildingAddress193->setBuildingType($buildingType9);
        $buildingAddress193->setLivingType($livingType2);
        $buildingAddress193->setCreationTime();
        $buildingAddress193->setLastChangeTime();

        $buildingAddress194 = new BuildingAddress();
        $buildingAddress194->setConstructionYear(1976);
        $buildingAddress194->setRenovationYear(2001);
        $buildingAddress194->setStreetName('æŒRǿndestraat');
        $buildingAddress194->setHouseNumber(6);
        $buildingAddress194->setAddition('I');
        $buildingAddress194->setZipcode('9034FR');
        $buildingAddress194->setCity('Groningen');
        $buildingAddress194->setRentalUnitNumber('E-0044');
        $buildingAddress194->setDaeb(true);
        $buildingAddress194->setVtw($vtw5);
        $buildingAddress194->setResidentialArea($residentialArea9);
        $buildingAddress194->setBuildingType($buildingType9);
        $buildingAddress194->setLivingType($livingType2);
        $buildingAddress194->setCreationTime();
        $buildingAddress194->setLastChangeTime();

        $buildingAddress195 = new BuildingAddress();
        $buildingAddress195->setConstructionYear(1976);
        $buildingAddress195->setRenovationYear(2001);
        $buildingAddress195->setStreetName('æŒRǿndestraat');
        $buildingAddress195->setHouseNumber(8);
        $buildingAddress195->setAddition('I');
        $buildingAddress195->setZipcode('9034FR');
        $buildingAddress195->setCity('Groningen');
        $buildingAddress195->setRentalUnitNumber('E-0045');
        $buildingAddress195->setDaeb(true);
        $buildingAddress195->setVtw($vtw6);
        $buildingAddress195->setResidentialArea($residentialArea9);
        $buildingAddress195->setBuildingType($buildingType9);
        $buildingAddress195->setLivingType($livingType2);
        $buildingAddress195->setCreationTime();
        $buildingAddress195->setLastChangeTime();

        $buildingAddress196 = new BuildingAddress();
        $buildingAddress196->setConstructionYear(1976);
        $buildingAddress196->setRenovationYear(2001);
        $buildingAddress196->setStreetName('æŒRǿndestraat');
        $buildingAddress196->setHouseNumber(10);
        $buildingAddress196->setAddition('I');
        $buildingAddress196->setZipcode('9034FR');
        $buildingAddress196->setCity('Groningen');
        $buildingAddress196->setRentalUnitNumber('E-0046');
        $buildingAddress196->setDaeb(true);
        $buildingAddress196->setVtw($vtw7);
        $buildingAddress196->setResidentialArea($residentialArea9);
        $buildingAddress196->setBuildingType($buildingType9);
        $buildingAddress196->setLivingType($livingType2);
        $buildingAddress196->setCreationTime();
        $buildingAddress196->setLastChangeTime();

        $buildingAddress197 = new BuildingAddress();
        $buildingAddress197->setConstructionYear(1976);
        $buildingAddress197->setRenovationYear(2001);
        $buildingAddress197->setStreetName('æŒRǿndestraat');
        $buildingAddress197->setHouseNumber(12);
        $buildingAddress197->setAddition('I');
        $buildingAddress197->setZipcode('9034FR');
        $buildingAddress197->setCity('Groningen');
        $buildingAddress197->setRentalUnitNumber('E-0047');
        $buildingAddress197->setDaeb(true);
        $buildingAddress197->setVtw($vtw8);
        $buildingAddress197->setResidentialArea($residentialArea9);
        $buildingAddress197->setBuildingType($buildingType9);
        $buildingAddress197->setLivingType($livingType2);
        $buildingAddress197->setCreationTime();
        $buildingAddress197->setLastChangeTime();

        $buildingAddress198 = new BuildingAddress();
        $buildingAddress198->setConstructionYear(1976);
        $buildingAddress198->setRenovationYear(2001);
        $buildingAddress198->setStreetName('æŒRǿndestraat');
        $buildingAddress198->setHouseNumber(14);
        $buildingAddress198->setAddition('I');
        $buildingAddress198->setZipcode('9034FR');
        $buildingAddress198->setCity('Groningen');
        $buildingAddress198->setRentalUnitNumber('E-0048');
        $buildingAddress198->setDaeb(true);
        $buildingAddress198->setVtw($vtw9);
        $buildingAddress198->setResidentialArea($residentialArea9);
        $buildingAddress198->setBuildingType($buildingType9);
        $buildingAddress198->setLivingType($livingType2);
        $buildingAddress198->setCreationTime();
        $buildingAddress198->setLastChangeTime();

        $buildingAddress199 = new BuildingAddress();
        $buildingAddress199->setConstructionYear(1976);
        $buildingAddress199->setRenovationYear(2001);
        $buildingAddress199->setStreetName('æŒRǿndestraat');
        $buildingAddress199->setHouseNumber(16);
        $buildingAddress199->setAddition('I');
        $buildingAddress199->setZipcode('9034FR');
        $buildingAddress199->setCity('Groningen');
        $buildingAddress199->setRentalUnitNumber('E-0049');
        $buildingAddress199->setDaeb(true);
        $buildingAddress199->setVtw($vtw10);
        $buildingAddress199->setResidentialArea($residentialArea9);
        $buildingAddress199->setBuildingType($buildingType9);
        $buildingAddress199->setLivingType($livingType2);
        $buildingAddress199->setCreationTime();
        $buildingAddress199->setLastChangeTime();

        $buildingAddress200 = new BuildingAddress();
        $buildingAddress200->setConstructionYear(1976);
        $buildingAddress200->setRenovationYear(2001);
        $buildingAddress200->setStreetName('æŒRǿndestraat');
        $buildingAddress200->setHouseNumber(18);
        $buildingAddress200->setAddition('I');
        $buildingAddress200->setZipcode('9034FR');
        $buildingAddress200->setCity('Groningen');
        $buildingAddress200->setRentalUnitNumber('E-0050');
        $buildingAddress200->setDaeb(true);
        $buildingAddress200->setVtw($vtw10);
        $buildingAddress200->setResidentialArea($residentialArea9);
        $buildingAddress200->setBuildingType($buildingType9);
        $buildingAddress200->setLivingType($livingType2);
        $buildingAddress200->setCreationTime();
        $buildingAddress200->setLastChangeTime();
        
        $buildingAddress201 = new BuildingAddress();
        $buildingAddress201->setConstructionYear(1950)
        $buildingAddress201->setStreetName('Ferdinand Bolstraat');
        $buildingAddress201->setHouseNumber(1);
        $buildingAddress201->setAddition('');
        $buildingAddress201->setZipcode('8021ES');
        $buildingAddress201->setCity('Zwolle');
        $buildingAddress201->setBagId('0193200000008586');
        $buildingAddress201->setRentalUnitNumber('ALG1010');
        $buildingAddress201->setDaeb(true);
        $buildingAddress201->setVtw($vtw2R);
        $buildingAddress201->setResidentialArea($residentialArea2);
        $buildingAddress201->setBuildingType($buildingType14);
        $buildingAddress201->setLivingType($livingType1);
        $buildingAddress201->setCreationTime();
        $buildingAddress201->setLastChangeTime();

        $buildingAddress202 = new BuildingAddress();
        $buildingAddress202->setConstructionYear(1950);
        $buildingAddress202->setStreetName('Ferdinand Bolstraat');
        $buildingAddress202->setHouseNumber(7);
        $buildingAddress202->setAddition('');
        $buildingAddress202->setZipcode('8021ES');
        $buildingAddress202->setCity('Zwolle');
        $buildingAddress202->setBagId('0193200000031259');
        $buildingAddress202->setRentalUnitNumber('ALG1010');
        $buildingAddress202->setDaeb(true);
        $buildingAddress202->setVtw($vtw2R);
        $buildingAddress202->setResidentialArea($residentialArea2);
        $buildingAddress202->setBuildingType($buildingType13);
        $buildingAddress202->setLivingType($livingType1);
        $buildingAddress202->setCreationTime();
        $buildingAddress202->setLastChangeTime();

        $buildingAddress203 = new BuildingAddress();
        $buildingAddress203->setConstructionYear(1950);
        $buildingAddress203->setStreetName('Ferdinand Bolstraat');
        $buildingAddress203->setHouseNumber(13);
        $buildingAddress203->setAddition('');
        $buildingAddress203->setZipcode('8021ES');
        $buildingAddress203->setCity('Zwolle');
        $buildingAddress203->setBagId('0193200000042469');
        $buildingAddress203->setRentalUnitNumber('ALG1010');
        $buildingAddress203->setDaeb(true);
        $buildingAddress203->setVtw($vtw2R);
        $buildingAddress203->setResidentialArea($residentialArea2);
        $buildingAddress203->setBuildingType($buildingType14);
        $buildingAddress203->setLivingType($livingType1);
        $buildingAddress203->setCreationTime();
        $buildingAddress203->setLastChangeTime();

        $buildingAddress204 = new BuildingAddress();
        $buildingAddress204->setConstructionYear(1950);
        $buildingAddress204->setStreetName('Ferdinand Bolstraat');
        $buildingAddress204->setHouseNumber(15);
        $buildingAddress204->setAddition('');
        $buildingAddress204->setZipcode('8021ES');
        $buildingAddress204->setCity('Zwolle');
        $buildingAddress204->setBagId('0193200000008587');
        $buildingAddress204->setRentalUnitNumber('ALG1010');
        $buildingAddress204->setDaeb(true);
        $buildingAddress204->setVtw($vtw2R);
        $buildingAddress204->setResidentialArea($residentialArea2);
        $buildingAddress204->setBuildingType($buildingType14);
        $buildingAddress204->setLivingType($livingType1);
        $buildingAddress204->setCreationTime();
        $buildingAddress204->setLastChangeTime();

        $buildingAddress205 = new BuildingAddress();
        $buildingAddress205->setConstructionYear(1950);
        $buildingAddress205->setStreetName('Ferdinand Bolstraat');
        $buildingAddress205->setHouseNumber(17);
        $buildingAddress205->setAddition('');
        $buildingAddress205->setZipcode('8021ES');
        $buildingAddress205->setCity('Zwolle');
        $buildingAddress205->setBagId('0193200000042470');
        $buildingAddress205->setRentalUnitNumber('ALG1010');
        $buildingAddress205->setDaeb(true);
        $buildingAddress205->setVtw($vtw2R);
        $buildingAddress205->setResidentialArea($residentialArea2);
        $buildingAddress205->setBuildingType($buildingType14);
        $buildingAddress205->setLivingType($livingType1);
        $buildingAddress205->setCreationTime();
        $buildingAddress205->setLastChangeTime();

        $buildingAddress206 = new BuildingAddress();
        $buildingAddress206->setConstructionYear(1950);
        $buildingAddress206->setStreetName('Ferdinand Bolstraat');
        $buildingAddress206->setHouseNumber(21);
        $buildingAddress206->setAddition('');
        $buildingAddress206->setZipcode('8021ES');
        $buildingAddress206->setCity('Zwolle');
        $buildingAddress206->setBagId('0193200000019892');
        $buildingAddress206->setRentalUnitNumber('ALG1010');
        $buildingAddress206->setDaeb(true);
        $buildingAddress206->setVtw($vtw2R);
        $buildingAddress206->setResidentialArea($residentialArea2);
        $buildingAddress206->setBuildingType($buildingType14);
        $buildingAddress206->setLivingType($livingType1);
        $buildingAddress206->setCreationTime();
        $buildingAddress206->setLastChangeTime();

        $buildingAddress207 = new BuildingAddress();
        $buildingAddress207->setConstructionYear(1950);
        $buildingAddress207->setStreetName('Govert Flinckstraat');
        $buildingAddress207->setHouseNumber(8);
        $buildingAddress207->setAddition('');
        $buildingAddress207->setZipcode('8021ET');
        $buildingAddress207->setCity('Zwolle');
        $buildingAddress207->setBagId('0193200000008721');
        $buildingAddress207->setRentalUnitNumber('ALG1010');
        $buildingAddress207->setDaeb(true);
        $buildingAddress207->setVtw($vtw2R);
        $buildingAddress207->setResidentialArea($residentialArea2);
        $buildingAddress207->setBuildingType($buildingType13);
        $buildingAddress207->setLivingType($livingType1);
        $buildingAddress207->setCreationTime();
        $buildingAddress207->setLastChangeTime();


        $buildingAddress208 = new BuildingAddress();
        $buildingAddress208->setConstructionYear(1950);
        $buildingAddress208->setStreetName('Van Miereveltstraat');
        $buildingAddress208->setHouseNumber(4);
        $buildingAddress208->setAddition('');
        $buildingAddress208->setZipcode('8021ER');
        $buildingAddress208->setCity('Zwolle');
        $buildingAddress208->setBagId('0193200000007151');
        $buildingAddress208->setRentalUnitNumber('ALG1010');
        $buildingAddress208->setDaeb(true);
        $buildingAddress208->setVtw($vtw2R);
        $buildingAddress208->setResidentialArea($residentialArea2);
        $buildingAddress208->setBuildingType($buildingType14);
        $buildingAddress208->setLivingType($livingType1);
        $buildingAddress208->setCreationTime();
        $buildingAddress208->setLastChangeTime();

        $buildingAddress209 = new BuildingAddress();
        $buildingAddress209->setConstructionYear(1950);
        $buildingAddress209->setStreetName('Van Miereveltstraat');
        $buildingAddress209->setHouseNumber(10);
        $buildingAddress209->setAddition('');
        $buildingAddress209->setZipcode('8021ER');
        $buildingAddress209->setCity('Zwolle');
        $buildingAddress209->setBagId('0193200000014782');
        $buildingAddress209->setRentalUnitNumber('ALG1010');
        $buildingAddress209->setDaeb(true);
        $buildingAddress209->setVtw($vtw2R);
        $buildingAddress209->setResidentialArea($residentialArea2);
        $buildingAddress209->setBuildingType($buildingType14);
        $buildingAddress209->setLivingType($livingType1);
        $buildingAddress209->setCreationTime();
        $buildingAddress209->setLastChangeTime();

        $buildingAddress210 = new BuildingAddress();
        $buildingAddress210->setConstructionYear(1950);
        $buildingAddress210->setStreetName('Van Miereveltstraat');
        $buildingAddress210->setHouseNumber(16);
        $buildingAddress210->setAddition('');
        $buildingAddress210->setZipcode('8021ER');
        $buildingAddress210->setCity('Zwolle');
        $buildingAddress210->setBagId('0193200000037358');
        $buildingAddress210->setRentalUnitNumber('ALG1010');
        $buildingAddress210->setDaeb(true);
        $buildingAddress210->setVtw($vtw2R);
        $buildingAddress210->setResidentialArea($residentialArea2);
        $buildingAddress210->setBuildingType($buildingType14);
        $buildingAddress210->setLivingType($livingType1);
        $buildingAddress210->setCreationTime();
        $buildingAddress210->setLastChangeTime();

        $buildingAddress211 = new BuildingAddress();
        $buildingAddress211->setConstructionYear(1950);
        $buildingAddress211->setStreetName('Van Miereveltstraat');
        $buildingAddress211->setHouseNumber(18);
        $buildingAddress211->setAddition('');
        $buildingAddress211->setZipcode('8021ER');
        $buildingAddress211->setCity('Zwolle');
        $buildingAddress211->setBagId('0193200000014785');
        $buildingAddress211->setRentalUnitNumber('ALG1010');
        $buildingAddress211->setDaeb(true);
        $buildingAddress211->setVtw($vtw2R);
        $buildingAddress211->setResidentialArea($residentialArea2);
        $buildingAddress211->setBuildingType($buildingType14);
        $buildingAddress211->setLivingType($livingType1);
        $buildingAddress211->setCreationTime();
        $buildingAddress211->setLastChangeTime();

        $buildingAddress212 = new BuildingAddress();
        $buildingAddress212->setConstructionYear(1950);
        $buildingAddress212->setStreetName('Van Miereveltstraat');
        $buildingAddress212->setHouseNumber(20);
        $buildingAddress212->setAddition('');
        $buildingAddress212->setZipcode('8021ER');
        $buildingAddress212->setCity('Zwolle');
        $buildingAddress212->setBagId('0193200000033623');
        $buildingAddress212->setRentalUnitNumber('ALG1010');
        $buildingAddress212->setDaeb(true);
        $buildingAddress212->setVtw($vtw2R);
        $buildingAddress212->setResidentialArea($residentialArea2);
        $buildingAddress212->setBuildingType($buildingType14);
        $buildingAddress212->setLivingType($livingType1);
        $buildingAddress212->setCreationTime();
        $buildingAddress212->setLastChangeTime();

        $buildingAddress213 = new BuildingAddress();
        $buildingAddress213->setConstructionYear(1950);
        $buildingAddress213->setStreetName('Van Miereveltstraat');
        $buildingAddress213->setHouseNumber(24);
        $buildingAddress213->setAddition('');
        $buildingAddress213->setZipcode('8021ER');
        $buildingAddress213->setCity('Zwolle');
        $buildingAddress213->setBagId('0193200000052584');
        $buildingAddress213->setRentalUnitNumber('ALG1010');
        $buildingAddress213->setDaeb(true);
        $buildingAddress213->setVtw($vtw2R);
        $buildingAddress213->setResidentialArea($residentialArea2);
        $buildingAddress213->setBuildingType($buildingType14);
        $buildingAddress213->setLivingType($livingType1);
        $buildingAddress213->setCreationTime();
        $buildingAddress213->setLastChangeTime();


        
        $block1 = new Block();
        $block1->setCode('NAP A1');
        $block1->setName('Napoleoncomplex');
        $block1->setFinancialNumber('1111');
        $block1->setDescription('Frans');
        $block1->addBuildingAddress($buildingAddress3);
        $block1->addBuildingAddress($buildingAddress10);
        $block1->addBuildingAddress($buildingAddress11);
        $block1->addBuildingAddress($buildingAddress12);
        $block1->addBuildingAddress($buildingAddress13);
        $block1->addBuildingAddress($buildingAddress14);
        $block1->addBuildingAddress($buildingAddress20);
        $block1->addBuildingAddress($buildingAddress21);
        $block1->addBuildingAddress($buildingAddress22);
        $block1->addBuildingAddress($buildingAddress23);
        $block1->addBuildingAddress($buildingAddress24);
        $block1->addBuildingAddress($buildingAddress30);
        $block1->addBuildingAddress($buildingAddress31);
        $block1->addBuildingAddress($buildingAddress32);
        $block1->addBuildingAddress($buildingAddress33);
        $block1->addBuildingAddress($buildingAddress34);
        $block1->addBuildingAddress($buildingAddress41);
        $block1->addBuildingAddress($buildingAddress42);
        $block1->addBuildingAddress($buildingAddress43);
        $block1->addBuildingAddress($buildingAddress51);
        $block1->addBuildingAddress($buildingAddress52);
        $block1->addBuildingAddress($buildingAddress53);
        $block1->addBuildingAddress($buildingAddress61);
        $block1->addBuildingAddress($buildingAddress62);
        $block1->addBuildingAddress($buildingAddress63);
        $block1->addBuildingAddress($buildingAddress71);
        $block1->addBuildingAddress($buildingAddress72);
        $block1->addBuildingAddress($buildingAddress73);
        $block1->addBuildingAddress($buildingAddress81);
        $block1->addBuildingAddress($buildingAddress82);
        $block1->addBuildingAddress($buildingAddress83);
        $block1->addBuildingAddress($buildingAddress91);
        $block1->addBuildingAddress($buildingAddress92);
        $block1->addBuildingAddress($buildingAddress93);
        $block1->setCreationTime();
        $block1->setLastChangeTime();

        $block2 = new Block();
        $block2->setCode('Æ æ Œ œ ');
        $block2->setName('Ą ą Ę ę ');
        $block2->setFinancialNumber('2222');
        $block2->setDescription('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ ');
        $block2->addBuildingAddress($buildingAddress1);
        $block2->addBuildingAddress($buildingAddress2);
        $block2->addBuildingAddress($buildingAddress10);
        $block2->addBuildingAddress($buildingAddress12);
        $block2->addBuildingAddress($buildingAddress22);
        $block2->setCreationTime();
        $block2->setLastChangeTime();

        $block3 = new Block();
        $block3->setCode('C001');
        $block3->setName('Complex 20.66-078');
        $block3->setFinancialNumber('3333');
        $block3->setDescription('mobilisatiecomplex');
        $block3->addBuildingAddress($buildingAddress11);
        $block3->setCreationTime();
        $block3->setLastChangeTime();

        $block4 = new Block();
        $block4->setCode('mobilisatiecomplex');
        $block4->setName('Complex 20028123');
        $block4->setFinancialNumber('4444');
        $block4->setDescription('Laptop 3');
        $block4->addBuildingAddress($buildingAddress90);
        $block4->addBuildingAddress($buildingAddress91);
        $block4->addBuildingAddress($buildingAddress92);
        $block4->addBuildingAddress($buildingAddress93);
        $block4->addBuildingAddress($buildingAddress94);
        $block4->addBuildingAddress($buildingAddress95);
        $block4->addBuildingAddress($buildingAddress97);
        $block4->addBuildingAddress($buildingAddress98);
        $block4->addBuildingAddress($buildingAddress99);
        $block4->addBuildingAddress($buildingAddress100);
        $block4->addBuildingAddress($buildingAddress102);
        $block4->addBuildingAddress($buildingAddress104);
        $block4->addBuildingAddress($buildingAddress105);
        $block4->addBuildingAddress($buildingAddress107);
        $block4->addBuildingAddress($buildingAddress108);
        $block4->addBuildingAddress($buildingAddress109);
        $block4->setCreationTime();
        $block4->setLastChangeTime();

        $block5 = new Block();
        $block5->setCode('4567894645');
        $block5->setName('áé200');
        $block5->setFinancialNumber('5555');
        $block5->setDescription('Wijk 12');
        $block5->addBuildingAddress($buildingAddress71);
        $block5->addBuildingAddress($buildingAddress72);
        $block5->addBuildingAddress($buildingAddress73);
        $block5->addBuildingAddress($buildingAddress74);
        $block5->addBuildingAddress($buildingAddress75);
        $block5->addBuildingAddress($buildingAddress76);
        $block5->addBuildingAddress($buildingAddress77);
        $block5->addBuildingAddress($buildingAddress78);
        $block5->addBuildingAddress($buildingAddress79);
        $block5->addBuildingAddress($buildingAddress70);
        $block5->addBuildingAddress($buildingAddress92);
        $block5->setCreationTime();
        $block5->setLastChangeTime();

        $block6 = new Block();
        $block6->setCode('C-20');
        $block6->setName('Z-2076A');
        $block6->setFinancialNumber('6666');
        $block6->setDescription('Zuiderbroek');
        $block6->addBuildingAddress($buildingAddress101);
        $block6->addBuildingAddress($buildingAddress103);
        $block6->setCreationTime();
        $block6->setLastChangeTime();

        $block7 = new Block();
        $block7->setCode('ɨʉɯɪʏʊøɘɵɤəɛœɜɞʌɔæɐɶɑɒɚ');
        $block7->setName('ɨ ʉ ɯ ɪ ʏ ʊ ø ɘ ɵ ɤ ə ɛ œ ɜ ɞ ʌ ɔ æ ɐ ɶ ɑ ɒ ɚ');
        $block7->setFinancialNumber('7777');
        $block7->setDescription('ɨ ʉ ɯ ɪ ʏ ʊ ø ɘ ɵ ɤ ə ɛ œ ɜ ɞ ʌ ɔ æ ɐ ɶ ɑ ɒ ɚ');
        $block7->addBuildingAddress($buildingAddress17);
        $block7->addBuildingAddress($buildingAddress28);
        $block7->addBuildingAddress($buildingAddress39);
        $block7->addBuildingAddress($buildingAddress50);
        $block7->setCreationTime();
        $block7->setLastChangeTime();

        $block8 = new Block();
        $block8->setCode('ʈɖɟɢʔɱɳɲŋɴʙʀɽɸβθðʃʒʂʐ');
        $block8->setName('ʈ ɖ ɟ ɢ ʔ ɱ ɳ ɲ ŋ ɴ ʙ ʀ ɽ ɸ β θɭ ʎ ʟ ʍ ɥ ʜ ʢ ʡ ɕ ʑ ɺ ɧ ɡ ʲ ʷ');
        $block8->setFinancialNumber('8888');
        $block8->setDescription('ʈ ɖ ɟ ɢ ʔ ɱ ɳ ɲ ŋ ɴ ʙ ʀ ɽ ɸ β θ ð ʃ ʒ ʂ ʐ ʝ ɣ χ ʁ ħ ʕ ɦ ɬ ɮ ʋ ɹ ɻ ɰ ɭ ʎ ʟ ʍ ɥ ʜ ʢ ʡ ɕ ʑ ɺ ɧ ɡ ʲ ʷ');
        $block8->addBuildingAddress($buildingAddress21);
        $block8->addBuildingAddress($buildingAddress22);
        $block8->addBuildingAddress($buildingAddress23);
        $block8->addBuildingAddress($buildingAddress24);
        $block8->addBuildingAddress($buildingAddress25);
        $block8->addBuildingAddress($buildingAddress26);
        $block8->addBuildingAddress($buildingAddress27);
        $block8->addBuildingAddress($buildingAddress29);
        $block8->addBuildingAddress($buildingAddress20);
        $block8->addBuildingAddress($buildingAddress31);
        $block8->addBuildingAddress($buildingAddress32);
        $block8->addBuildingAddress($buildingAddress33);
        $block8->addBuildingAddress($buildingAddress34);
        $block8->addBuildingAddress($buildingAddress35);
        $block8->addBuildingAddress($buildingAddress36);
        $block8->addBuildingAddress($buildingAddress37);
        $block8->addBuildingAddress($buildingAddress38);
        $block8->addBuildingAddress($buildingAddress30);
        $block8->addBuildingAddress($buildingAddress41);
        $block8->addBuildingAddress($buildingAddress42);
        $block8->addBuildingAddress($buildingAddress43);
        $block8->addBuildingAddress($buildingAddress44);
        $block8->addBuildingAddress($buildingAddress45);
        $block8->addBuildingAddress($buildingAddress46);
        $block8->addBuildingAddress($buildingAddress47);
        $block8->addBuildingAddress($buildingAddress48);
        $block8->addBuildingAddress($buildingAddress49);
        $block8->addBuildingAddress($buildingAddress40);
        $block8->addBuildingAddress($buildingAddress51);
        $block8->addBuildingAddress($buildingAddress52);
        $block8->addBuildingAddress($buildingAddress53);
        $block8->addBuildingAddress($buildingAddress54);
        $block8->addBuildingAddress($buildingAddress55);
        $block8->addBuildingAddress($buildingAddress56);
        $block8->addBuildingAddress($buildingAddress57);
        $block8->addBuildingAddress($buildingAddress58);
        $block8->addBuildingAddress($buildingAddress59);
        $block8->addBuildingAddress($buildingAddress61);
        $block8->addBuildingAddress($buildingAddress62);
        $block8->addBuildingAddress($buildingAddress63);
        $block8->addBuildingAddress($buildingAddress64);
        $block8->addBuildingAddress($buildingAddress65);
        $block8->addBuildingAddress($buildingAddress66);
        $block8->addBuildingAddress($buildingAddress67);
        $block8->addBuildingAddress($buildingAddress68);
        $block8->addBuildingAddress($buildingAddress69);
        $block8->addBuildingAddress($buildingAddress60);
        $block8->addBuildingAddress($buildingAddress100);
        $block8->addBuildingAddress($buildingAddress111);
        $block8->addBuildingAddress($buildingAddress112);
        $block8->addBuildingAddress($buildingAddress113);
        $block8->addBuildingAddress($buildingAddress114);
        $block8->addBuildingAddress($buildingAddress115);
        $block8->addBuildingAddress($buildingAddress116);
        $block8->addBuildingAddress($buildingAddress117);
        $block8->addBuildingAddress($buildingAddress118);
        $block8->addBuildingAddress($buildingAddress119);
        $block8->addBuildingAddress($buildingAddress110);
        $block8->addBuildingAddress($buildingAddress121);
        $block8->addBuildingAddress($buildingAddress122);
        $block8->addBuildingAddress($buildingAddress123);
        $block8->addBuildingAddress($buildingAddress124);
        $block8->addBuildingAddress($buildingAddress125);
        $block8->addBuildingAddress($buildingAddress126);
        $block8->addBuildingAddress($buildingAddress127);
        $block8->addBuildingAddress($buildingAddress128);
        $block8->addBuildingAddress($buildingAddress129);
        $block8->addBuildingAddress($buildingAddress120);
        $block8->setCreationTime();
        $block8->setLastChangeTime();

        $block9 = new Block();
        $block9->setCode('ID 899');
        $block9->setName('Complex 899');
        $block9->setFinancialNumber('9999');
        $block9->setDescription('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ À à È è Ì ì Ò ò Ù ù Â â Ê ê Ĝ ĝ Ĥ ĥ Î î Ĵ ĵ Ô ô Û û Ä ä Ë ë Ï ï Ö ö Ü ü ÿ Ã ã Ñ ñ Õ õ Ũ ũ Å å Ç ç Ş ş Č č Ď ď Ğ ğ Ř ř Š š Ť ť Ŭ ŭ Ł ł  Ő ő Ű ű Ø ø Ā ā Ē ē Ī ī Ō ō Ū ū ß Æ æ Œ œ Ð ð Þ þ Ą ą Ę ę Ż ż  ı ˁ ḥ ẖ ḫ ḳ ś ṯ ḏ Ꜣ ỉ ');
        $block9->addBuildingAddress($buildingAddress1);
        $block9->addBuildingAddress($buildingAddress2);
        $block9->addBuildingAddress($buildingAddress4);
        $block9->addBuildingAddress($buildingAddress5);
        $block9->addBuildingAddress($buildingAddress6);
        $block9->addBuildingAddress($buildingAddress7);
        $block9->addBuildingAddress($buildingAddress8);
        $block9->addBuildingAddress($buildingAddress9);
        $block9->addBuildingAddress($buildingAddress130);
        $block9->setCreationTime();
        $block9->setLastChangeTime();

        $owner1 = new Owner();
        $owner1->setName('Dobro BV');
        $owner1->setWebsite('https://www.buildingexaminator.nl');

        //$owner2 = new Owner();
        //$owner2->setName('');

        $owner3 = new Owner();
        $owner3->setName('Stichting Woningbedrijf Warnsveld');
        $owner3->setLnumber('L2104');

        $owner4 = new Owner();
        $owner4->setName('Woonstichting De Key');
        $owner4->setLnumber('L2103');

        $owner5 = new Owner();
        $owner5->setName('Stichting Goed Wonen Liempde');
        $owner5->setLnumber('L2101');

        $owner6 = new Owner();
        $owner6->setName('Noordwijkse Woningstichting');
        $owner6->setLnumber('L2092');

        $owner7 = new Owner();
        $owner7->setName('Woonstichtibng De zes Kernen');
        $owner7->setLnumber('L2090');

        $owner8 = new Owner();
        $owner8->setName('Stichting Woonplus Schiedam');
        $owner8->setLnumber('L2085');

        $owner9 = new Owner();
        $owner9->setName('Stichting Woondiensten Aarwoude');
        $owner9->setLnumber('L2084');

        $owner10 = new Owner();
        $owner10->setName('Woningstichting Nieuwkoop');
        $owner10->setLnumber('L2083');

        $owner11 = new Owner();
        $owner11->setName('Woningstichting Barneveld');
        $owner11->setLnumber('L2082');

        $owner12 = new Owner();
        $owner12->setName('Stichting Woningbedrijf Velsen');
        $owner12->setLnumber('L2073');

        $owner13 = new Owner();
        $owner13->setName('Waterweg wonen');
        $owner13->setLnumber('L2072');

        $owner14 = new Owner();
        $owner14->setName('Stichting Ymere');
        $owner14->setLnumber('L2070');

        $owner15 = new Owner();
        $owner15->setName('Rhenense Woningstichting');
        $owner15->setLnumber('L2068');

        $owner16 = new Owner();
        $owner16->setName('Wooncentrum Ouderen St. Zuidrandflat Gouda');
        $owner16->setLnumber('L2067');

        $owner17 = new Owner();
        $owner17->setName('Stichting Laurens Wonen ');
        $owner17->setLnumber('L2066');

        $owner18 = new Owner();
        $owner18->setName('Stichting Mitros');
        $owner18->setLnumber('L2058');

        $owner19 = new Owner();
        $owner19->setName('Ressort Wonen');
        $owner19->setLnumber('L2056');

        $owner20 = new Owner();
        $owner20->setName('Woonpartners Midden-Holland');
        $owner20->setKvk('29045958');
        $owner20->setBtw('NL804644433B01');
        $owner20->setLnumber('L2114');
        $owner20->setWebsite('https://www.woonpartners-mh.nl');

        $owner21 = new Owner();
        $owner21->setName('ZorgGoedBrabant');
        $owner21->setLnumber('L2053');

        $owner22 = new Owner();
        $owner22->setName('Woonstichting Etten-Leur');
        $owner22->setLnumber('L2052');

        $owner23 = new Owner();
        $owner23->setName('Stichting Woonstede');
        $owner23->setLnumber('L2051');

        $owner24 = new Owner();
        $owner24->setName('Veron');
        $owner24->setLnumber('L2047');

        $owner25 = new Owner();
        $owner25->setName('Stichting Wonen Wierden Enter');
        $owner25->setLnumber('L2044');

        $owner26 = new Owner();
        $owner26->setName('Stichting Woonpalet Zeewolde');
        $owner26->setLnumber('L2014');

        $owner27 = new Owner();
        $owner27->setName('Stichting DUWO');
        $owner27->setLnumber('L2004');

        $owner28 = new Owner();
        $owner28->setName('SHBO');
        $owner28->setLnumber('L1986');

        $owner29 = new Owner();
        $owner29->setName('Harmonisch Wonen');
        $owner29->setLnumber('L1985');

        $owner30 = new Owner();
        $owner30->setName('SIB Woonservice');
        $owner30->setLnumber('L1969');

        $owner31 = new Owner();
        $owner31->setName('Stichting Verzorgd Wonen SHBB');
        $owner31->setLnumber('L1966');

        $owner32 = new Owner();
        $owner32->setName('Stichting Jongeren Huisvesting Twente');
        $owner32->setLnumber('L1964');

        $owner33 = new Owner();
        $owner33->setName('SSHN');
        $owner33->setLnumber('L1944');

        $owner34 = new Owner();
        $owner34->setName('Stichting Huisvesting Vredewold');
        $owner34->setLnumber('L1933');

        $owner35 = new Owner();
        $owner35->setName('WoonCompas');
        $owner35->setKvk('24108743');
        $owner35->setBtw('NL002776911B01');
        $owner35->setLnumber('L2110');
        $owner35->setWebsite('https://www.wooncompas.nl');

        $owner36 = new Owner();
        $owner36->setName('Stichting Ouderenhuisvesting Rotterdam');
        $owner36->setLnumber('L1926');

        $owner37 = new Owner();
        $owner37->setName('Stichting Vestia Groep');
        $owner37->setLnumber('L1924');

        $owner38 = new Owner();
        $owner38->setName('Woonkracht10');
        $owner38->setLnumber('L1921');

        $owner39 = new Owner();
        $owner39->setName('Tiwos, Tilburgse Woonstichting');
        $owner39->setLnumber('L1913');

        $owner40 = new Owner();
        $owner40->setName('Stichting de Alliantie');
        $owner40->setLnumber('L1912');

        $owner41 = new Owner();
        $owner41->setName('Stichting WonenBreburg');
        $owner41->setLnumber('L1911');

        $owner42 = new Owner();
        $owner42->setName('WBO Wonen');
        $owner42->setLnumber('L1910');

        $owner43 = new Owner();
        $owner43->setName('Stichting Studenten Huisvesting');
        $owner43->setLnumber('L1909');

        $owner44 = new Owner();
        $owner44->setName('Brabantse Waard');
        $owner44->setLnumber('L1906');

        $owner45 = new Owner();
        $owner45->setName('Woningbouwvereniging Amerongen');
        $owner45->setLnumber('L1903');

        $owner46 = new Owner();
        $owner46->setName('Regionale Woningbouwvereniging Samenwerking ');
        $owner46->setLnumber('L1901');

        $owner47 = new Owner();
        $owner47->setName('Woningstichting De Volmacht');
        $owner47->setLnumber('L1899');

        $owner48 = new Owner();
        $owner48->setName('Woningstichting De Leeuw van Putten');
        $owner48->setLnumber('L1896');

        $owner49 = new Owner();
        $owner49->setName('Woonstichting Valburg');
        $owner49->setLnumber('L1893');

        $owner50 = new Owner();
        $owner50->setName('Woningbouwvereniging Oudewater');
        $owner50->setLnumber('L1892');

        $owner51 = new Owner();
        $owner51->setName('Woningstichting Goede Stede ');
        $owner51->setLnumber('L1891');

        $owner52 = new Owner();
        $owner52->setName('Woonstichting Centrada');
        $owner52->setLnumber('L1888');

        $owner53 = new Owner();
        $owner53->setName('Stichting Woningbeheer Betuwe');
        $owner53->setLnumber('L1881');

        $owner54 = new Owner();
        $owner54->setName('Woningstichting Leusden');
        $owner54->setLnumber('L1878');

        $owner55 = new Owner();
        $owner55->setName('Stichting Woonservice Drenthe');
        $owner55->setLnumber('L1877');

        $owner56 = new Owner();
        $owner56->setName('Stichting Maasdelta Groep');
        $owner56->setLnumber('L1876');

        $owner57 = new Owner();
        $owner57->setName('Stichting Woningcorporaties Het Gooi en Omstreken');
        $owner57->setLnumber('L1875');

        $owner58 = new Owner();
        $owner58->setName('Woningbouwvereniging "Lopik"');
        $owner58->setLnumber('L1866');

        $owner59 = new Owner();
        $owner59->setName('Woningstichting Putten');
        $owner59->setLnumber('L1865');

        $owner60 = new Owner();
        $owner60->setName('Wonen Vierlingsbeek');
        $owner60->setLnumber('L1864');

        $owner61 = new Owner();
        $owner61->setName('Oost Flevoland Woondiensten');
        $owner61->setLnumber('L1861');

        $owner62 = new Owner();
        $owner62->setName('Wovesto');
        $owner62->setLnumber('L1857');

        $owner63 = new Owner();
        $owner63->setName('Woonstichting Gendt');
        $owner63->setLnumber('L1855');

        $owner64 = new Owner();
        $owner64->setName('Woningstichting Kleine Meierij');
        $owner64->setLnumber('L1852');

        $owner65 = new Owner();
        $owner65->setName('Woningstichting Woensdrecht');
        $owner65->setLnumber('L1850');

        $owner66 = new Owner();
        $owner66->setName('Woningbouwvereniging Compaen');
        $owner66->setLnumber('L1847');

        $owner67 = new Owner();
        $owner67->setName('Woningstichting De Woonplaats');
        $owner67->setLnumber('L1842');

        $owner68 = new Owner();
        $owner68->setName('st. WoonGoed 2-Duizend');
        $owner68->setLnumber('L1839');

        $owner69 = new Owner();
        $owner69->setName('Woningvereniging Nederweert');
        $owner69->setLnumber('L1837');

        $owner70 = new Owner();
        $owner70->setName('Heuvelrug Wonen');
        $owner70->setLnumber('L1836');

        $owner71 = new Owner();
        $owner71->setName('Woningstichting Maasdriel');
        $owner71->setLnumber('L1835');

        $owner72 = new Owner();
        $owner72->setName('Woonstichting De Kernen');
        $owner72->setLnumber('L1825');

        $owner73 = new Owner();
        $owner73->setName('Laris Wonen en diensten');
        $owner73->setLnumber('L1821');

        $owner74 = new Owner();
        $owner74->setName('Stichting Mooiland');
        $owner74->setLnumber('L1817');

        $owner75 = new Owner();
        $owner75->setName('Stichting PeelrandWonen');
        $owner75->setLnumber('L1811');

        $owner76 = new Owner();
        $owner76->setName('Woningstichting Volksbelang');
        $owner76->setLnumber('L1807');

        $owner77 = new Owner();
        $owner77->setName('Mercatus');
        $owner77->setLnumber('L1804');

        $owner78 = new Owner();
        $owner78->setName('Woningstichting de Zaligheden');
        $owner78->setLnumber('L1794');

        $owner79 = new Owner();
        $owner79->setName('Stichting Acantus Groep');
        $owner79->setLnumber('L1793');

        $owner80 = new Owner();
        $owner80->setName('Stichting Thus wonen');
        $owner80->setLnumber('L1792');

        $owner81 = new Owner();
        $owner81->setName('Woonstichting Leystromen');
        $owner81->setLnumber('L1788');

        $owner82 = new Owner();
        $owner82->setName('Stichting WSG');
        $owner82->setLnumber('L1787');

        $owner83 = new Owner();
        $owner83->setName('Stichting Stadlander');
        $owner83->setLnumber('L1785');

        $owner84 = new Owner();
        $owner84->setName('Stichting Thuisvester');
        $owner84->setLnumber('L1781');

        $owner85 = new Owner();
        $owner85->setName('Staedion');
        $owner85->setLnumber('L1768');

        $owner86 = new Owner();
        $owner86->setName('Stichting woCom');
        $owner86->setLnumber('L1766');

        $owner87 = new Owner();
        $owner87->setName('Stichting Woonveste');
        $owner87->setLnumber('L1763');

        $owner88 = new Owner();
        $owner88->setName('Vieya');
        $owner88->setLnumber('L1762');

        $owner89 = new Owner();
        $owner89->setName('Bernardus wonen');
        $owner89->setLnumber('L1761');

        $owner90 = new Owner();
        $owner90->setName('Wbv. Reeuwijk');
        $owner90->setLnumber('L1760');

        $owner91 = new Owner();
        $owner91->setName('Wetland Wonen Groep');
        $owner91->setLnumber('L1753');

        $owner92 = new Owner();
        $owner92->setName('Stichting Woningcorporatie WoonGenoot');
        $owner92->setLnumber('L1748');

        $owner93 = new Owner();
        $owner93->setName('Goed Wonen');
        $owner93->setLnumber('L1745');

        $owner94 = new Owner();
        $owner94->setName('Stichting Woonservice Urbanus');
        $owner94->setLnumber('L1723');

        $owner95 = new Owner();
        $owner95->setName('Woningstichting Goed Wonen');
        $owner95->setLnumber('L1718');

        $owner96 = new Owner();
        $owner96->setName('Stichting Viveste');
        $owner96->setLnumber('L1716');

        $owner97 = new Owner();
        $owner97->setName('Wbv de Kombinatie');
        $owner97->setLnumber('L1713');

        $owner98 = new Owner();
        $owner98->setName('Chr. Woonstichting Patrimonium');
        $owner98->setLnumber('L1712');

        $owner99 = new Owner();
        $owner99->setName('Christelijke Woningstichting De Goede Woning');
        $owner99->setLnumber('L1709');

        $owner100 = new Owner();
        $owner100->setName('Woonstichting Land van Altena');
        $owner100->setLnumber('L1704');

        $owner101 = new Owner();
        $owner101->setName('wbv Beter Wonen');
        $owner101->setLnumber('L1700');

        $owner102 = new Owner();
        $owner102->setName('Wonen Limburg');
        $owner102->setLnumber('L1697');

        $owner103 = new Owner();
        $owner103->setName('Woningstichting Nijkerk');
        $owner103->setLnumber('L1693');

        $owner104 = new Owner();
        $owner104->setName('Ons Huis Woningstichting');
        $owner104->setLnumber('L1691');

        $owner105 = new Owner();
        $owner105->setName('Woningstichting St. Joseph');
        $owner105->setLnumber('L1689');

        $owner106 = new Owner();
        $owner106->setName('de Woonmensen/SJA');
        $owner106->setLnumber('L1680');

        $owner107 = new Owner();
        $owner107->setName('Woningstichting Tubbergen');
        $owner107->setLnumber('L1678');

        $owner108 = new Owner();
        $owner108->setName('Steelande wonen');
        $owner108->setLnumber('L1675');

        $owner109 = new Owner();
        $owner109->setName('Chr. stichting BCM wonen');
        $owner109->setLnumber('L1674');

        $owner110 = new Owner();
        $owner110->setName('Oosterpoort Wooncombinatie');
        $owner110->setLnumber('L1670');

        $owner111 = new Owner();
        $owner111->setName('Stichting Woonfriesland');
        $owner111->setLnumber('L1663');

        $owner112 = new Owner();
        $owner112->setName('Stichting Woonpartners');
        $owner112->setLnumber('L1647');

        $owner113 = new Owner();
        $owner113->setName('Stichting Woonzorg Nederland');
        $owner113->setLnumber('L1646');

        $owner114 = new Owner();
        $owner114->setName('Woningbouwvereniging Hoek van Holand');
        $owner114->setLnumber('L1640');

        $owner115 = new Owner();
        $owner115->setName('Stichting Accolade');
        $owner115->setLnumber('L1638');

        $owner116 = new Owner();
        $owner116->setName('Stichting Wonen Wittem');
        $owner116->setLnumber('L1622');

        $owner117 = new Owner();
        $owner117->setName('Kennemerhave');
        $owner117->setLnumber('L1612');

        $owner118 = new Owner();
        $owner118->setName('Stichting Woonburg');
        $owner118->setLnumber('L1606');

        $owner119 = new Owner();
        $owner119->setName('Woningstichting Gouderak');
        $owner119->setLnumber('L1598');

        $owner120 = new Owner();
        $owner120->setName('Woningbouwstichting Lek en Waard Wonen');
        $owner120->setLnumber('L1597');

        $owner121 = new Owner();
        $owner121->setName('Woningbouwstichting Cothen');
        $owner121->setLnumber('L1588');

        $owner122 = new Owner();
        $owner122->setName('Woningbouwvereniging Nieuw-Lekkerland');
        $owner122->setLnumber('L1586');

        $owner123 = new Owner();
        $owner123->setName('Woningbouwvereniging Vecht en Omstreken ');
        $owner123->setLnumber('L1585');

        $owner124 = new Owner();
        $owner124->setName('Bouwvereniging Ambt Delden');
        $owner124->setLnumber('L1584');

        $owner125 = new Owner();
        $owner125->setName('Zeeuwland');
        $owner125->setLnumber('L1581');

        $owner126 = new Owner();
        $owner126->setName('Woningstichting Wuta');
        $owner126->setLnumber('L1579');

        $owner127 = new Owner();
        $owner127->setName('Groen Wonen Vlist');
        $owner127->setLnumber('L1573');

        $owner128 = new Owner();
        $owner128->setName('Woongoed ZVL');
        $owner128->setLnumber('L1569');

        $owner129 = new Owner();
        $owner129->setName('Stichting Woontij');
        $owner129->setLnumber('L1560');

        $owner130 = new Owner();
        $owner130->setName('wbv Beter Wonen');
        $owner130->setLnumber('L1559');

        $owner131 = new Owner();
        $owner131->setName('Woningbouwvereniging "Goed Wonen"');
        $owner131->setLnumber('L1550');

        $owner132 = new Owner();
        $owner132->setName('Poort6');
        $owner132->setLnumber('L1549');

        $owner133 = new Owner();
        $owner133->setName('Woongoed GO');
        $owner133->setLnumber('L1544');

        $owner134 = new Owner();
        $owner134->setName('Vallei Wonen ');
        $owner134->setLnumber('L1543');

        $owner135 = new Owner();
        $owner135->setName('Stichting Lefier');
        $owner135->setLnumber('L1542');

        $owner136 = new Owner();
        $owner136->setName('Stichting WOONopMAAT');
        $owner136->setLnumber('L1533');

        $owner137 = new Owner();
        $owner137->setName('wbs Samenwerking');
        $owner137->setLnumber('L1532');

        $owner138 = new Owner();
        $owner138->setName('Stichting Woningbeheer De Vooruitgang');
        $owner138->setLnumber('L1525');

        $owner139 = new Owner();
        $owner139->setName('Rijnhart Wonen');
        $owner139->setLnumber('L1524');

        $owner140 = new Owner();
        $owner140->setName('Stichting Wooninc.');
        $owner140->setLnumber('L1519');

        $owner141 = new Owner();
        $owner141->setName('Woningstichting SallandWonen');
        $owner141->setLnumber('L1506');

        $owner142 = new Owner();
        $owner142->setName('Woningstichting Kamerik');
        $owner142->setLnumber('L1498');

        $owner143 = new Owner();
        $owner143->setName('Woningstichting Kessel');
        $owner143->setLnumber('L1491');

        $owner144 = new Owner();
        $owner144->setName('Talis');
        $owner144->setLnumber('L1479');

        $owner145 = new Owner();
        $owner145->setName('Woonwijze');
        $owner145->setLnumber('L1471');

        $owner146 = new Owner();
        $owner146->setName('Stichting Woningbeheer Born-Grevenbicht');
        $owner146->setLnumber('L1468');

        $owner147 = new Owner();
        $owner147->setName('Stichting Woonbedrijf SWS.Hhvl');
        $owner147->setLnumber('L1464');

        $owner148 = new Owner();
        $owner148->setName('R.K. Woningbouwstichting De Goede Woning');
        $owner148->setLnumber('L1459');

        $owner149 = new Owner();
        $owner149->setName('Dunavie');
        $owner149->setLnumber('L1436');

        $owner150 = new Owner();
        $owner150->setName('Woningcorporatie Domijn');
        $owner150->setLnumber('L1426');

        $owner151 = new Owner();
        $owner151->setName('Stichting Woonbedrijf ieder1');
        $owner151->setLnumber('L1418');

        $owner152 = new Owner();
        $owner152->setName('Woningstichting Buitenlust');
        $owner152->setLnumber('L1415');

        $owner153 = new Owner();
        $owner153->setName('Woningstichting Hellendoorn');
        $owner153->setLnumber('L1413');

        $owner154 = new Owner();
        $owner154->setName('Stichting Woonservice IJsselland');
        $owner154->setLnumber('L1409');

        $owner155 = new Owner();
        $owner155->setName('Woningstichting Den Helder');
        $owner155->setLnumber('L1399');

        $owner156 = new Owner();
        $owner156->setName('Winingbouwvereniging Maarn');
        $owner156->setLnumber('L1395');

        $owner157 = new Owner();
        $owner157->setName('Woningbouwstichting de Gemeenschap');
        $owner157->setLnumber('L1357');

        $owner158 = new Owner();
        $owner158->setName('Woningstichting Eendracht');
        $owner158->setLnumber('L1306');

        $owner159 = new Owner();
        $owner159->setName('Woningstichting Obbicht & Papenhoven');
        $owner159->setLnumber('L1247');

        $owner160 = new Owner();
        $owner160->setName('IJsseldal Wonen');
        $owner160->setLnumber('L1239');

        $owner161 = new Owner();
        $owner161->setName('Woonstichting St. Joseph');
        $owner161->setLnumber('L1236');

        $owner162 = new Owner();
        $owner162->setName('Woonbeheer Borne');
        $owner162->setLnumber('L1235');

        $owner163 = new Owner();
        $owner163->setName('Woningbouwvereniging Bergopwaarts');
        $owner163->setLnumber('L1226');

        $owner164 = new Owner();
        $owner164->setName('Stichting VitaalWonen');
        $owner164->setLnumber('L1217');

        $owner165 = new Owner();
        $owner165->setName('Stichting 3B Wonen');
        $owner165->setLnumber('L1215');

        $owner166 = new Owner();
        $owner166->setName('Woningstichting Urmond');
        $owner166->setLnumber('L1207');

        $owner167 = new Owner();
        $owner167->setName('Stichting Woonwaard Noord-Kennemerland');
        $owner167->setLnumber('L1182');

        $owner168 = new Owner();
        $owner168->setName('WBV ST WILLIBRORDUS');
        $owner168->setLnumber('L1164');

        $owner169 = new Owner();
        $owner169->setName('Baston Wonen');
        $owner169->setLnumber('L1128');

        $owner170 = new Owner();
        $owner170->setName('Stichting Rijswijk Wonen');
        $owner170->setLnumber('L1122');

        $owner171 = new Owner();
        $owner171->setName('Stichting Nijestee');
        $owner171->setLnumber('L1109');

        $owner172 = new Owner();
        $owner172->setName('Wonen Midden-Delfland');
        $owner172->setLnumber('L1100');

        $owner173 = new Owner();
        $owner173->setName('Stichting Vidomes');
        $owner173->setLnumber('L1093');

        $owner174 = new Owner();
        $owner174->setName('Woningstichting Laarbeek');
        $owner174->setLnumber('L1082');

        $owner175 = new Owner();
        $owner175->setName('Stichting Welbions');
        $owner175->setLnumber('L1064');

        $owner176 = new Owner();
        $owner176->setName('Stichting Goed Wonen Zederik');
        $owner176->setLnumber('L1040');

        $owner177 = new Owner();
        $owner177->setName('Woningstichting Maasvallei Maastricht');
        $owner177->setLnumber('L1038');

        $owner178 = new Owner();
        $owner178->setName('Wbv De Goede Woning - Driemond');
        $owner178->setLnumber('L1034');

        $owner179 = new Owner();
        $owner179->setName('Sité Woondiensten');
        $owner179->setLnumber('L1017');

        $owner180 = new Owner();
        $owner180->setName('Laurentius');
        $owner180->setLnumber('L1005');

        $owner181 = new Owner();
        $owner181->setName('Woningbouwvereniging Helpt Elkander ');
        $owner181->setLnumber('L0992');

        $owner182 = new Owner();
        $owner182->setName('Maaskant Wonen');
        $owner182->setLnumber('L0986');

        $owner183 = new Owner();
        $owner183->setName('de Woningstichting');
        $owner183->setLnumber('L0979');

        $owner184 = new Owner();
        $owner184->setName('Omnia Wonen');
        $owner184->setLnumber('L0968');

        $owner185 = new Owner();
        $owner185->setName('Casade Woonstichting');
        $owner185->setLnumber('L0944');

        $owner186 = new Owner();
        $owner186->setName('Woongoed Middelburg');
        $owner186->setLnumber('L0943');

        $owner187 = new Owner();
        $owner187->setName('Stichting Christelijke Woningcorporatie');
        $owner187->setLnumber('L0939');

        $owner188 = new Owner();
        $owner188->setName('Eemland Wonen');
        $owner188->setLnumber('L0936');

        $owner189 = new Owner();
        $owner189->setName('Woonstichting \'t Heem');
        $owner189->setLnumber('L0928');

        $owner190 = new Owner();
        $owner190->setName('Trifolium Woondiensten Boskoop');
        $owner190->setLnumber('L0927');

        $owner191 = new Owner();
        $owner191->setName('Bouwvereniging Woningbelang');
        $owner191->setLnumber('L0923');

        $owner192 = new Owner();
        $owner192->setName('Woningstichting St. Joseph Almelo');
        $owner192->setLnumber('L0921');

        $owner193 = new Owner();
        $owner193->setName('Stichting Wonion');
        $owner193->setLnumber('L0898');

        $owner194 = new Owner();
        $owner194->setName('Stichting Area');
        $owner194->setLnumber('L0886');

        $owner195 = new Owner();
        $owner195->setName('Stichting De Woningbouw');
        $owner195->setLnumber('L0885');

        $owner196 = new Owner();
        $owner196->setName('Woningstichting Het Grootslag');
        $owner196->setLnumber('L0883');

        $owner197 = new Owner();
        $owner197->setName('Stichting De Woonschakel Westfriesland');
        $owner197->setLnumber('L0876');

        $owner198 = new Owner();
        $owner198->setName('Stichting Tablis Wonen (Sliedrecht)');
        $owner198->setLnumber('L0867');

        $owner199 = new Owner();
        $owner199->setName('Stichting Slagenland Wonen');
        $owner199->setLnumber('L0861');

        $owner200 = new Owner();
        $owner200->setName('Stichting Beter Wonen IJsselmuiden');
        $owner200->setLnumber('L0858');

        $owner201 = new Owner();
        $owner201->setName('Woonstichting Jutphaas');
        $owner201->setLnumber('L0837');

        $owner202 = new Owner();
        $owner202->setName('Stichting ProWonen');
        $owner202->setLnumber('L0835');

        $owner203 = new Owner();
        $owner203->setName('Woningbouwvereniging Heerjansdam');
        $owner203->setLnumber('L0817');

        $owner204 = new Owner();
        $owner204->setName('Woningstichting Brummen');
        $owner204->setLnumber('L0782');

        $owner205 = new Owner();
        $owner205->setName('Stichting GroenWest');
        $owner205->setLnumber('L0766');

        $owner206 = new Owner();
        $owner206->setName('Stichting Wonen Delden');
        $owner206->setLnumber('L0765');

        $owner207 = new Owner();
        $owner207->setName('Woningbouwvereniging Habeko Wonen');
        $owner207->setLnumber('L0764');

        $owner208 = new Owner();
        $owner208->setName('Woningstichting Beter Wonen Vechtdal');
        $owner208->setLnumber('L0762');

        $owner209 = new Owner();
        $owner209->setName('Woningstichting Kockengen');
        $owner209->setLnumber('L0758');

        $owner210 = new Owner();
        $owner210->setName('Woonstichting Groninger Huis');
        $owner210->setLnumber('L0740');

        $owner211 = new Owner();
        $owner211->setName('Patrimonium woonstichting');
        $owner211->setLnumber('L0734');

        $owner212 = new Owner();
        $owner212->setName('HW Wonen');
        $owner212->setLnumber('L0732');

        $owner213 = new Owner();
        $owner213->setName('Veenendaalse Woningstichting');
        $owner213->setLnumber('L0705');

        $owner214 = new Owner();
        $owner214->setName('Rentree');
        $owner214->setLnumber('L0694');

        $owner215 = new Owner();
        $owner215->setName('Woonvisie');
        $owner215->setLnumber('L0689');

        $owner216 = new Owner();
        $owner216->setName('Stichting Uithuizer Woningbouw');
        $owner216->setLnumber('L0688');

        $owner217 = new Owner();
        $owner217->setName('Stichting de Delthe');
        $owner217->setLnumber('L0686');

        $owner218 = new Owner();
        $owner218->setName('Woningstichting Ons Doel');
        $owner218->setLnumber('L0682');

        $owner219 = new Owner();
        $owner219->setName('Woningstichting Sint Antonius van Padua');
        $owner219->setLnumber('L0678');

        $owner220 = new Owner();
        $owner220->setName('Wonen Zuidwest Friesland');
        $owner220->setLnumber('L0676');

        $owner221 = new Owner();
        $owner221->setName('WoonInvest');
        $owner221->setLnumber('L0673');

        $owner222 = new Owner();
        $owner222->setName('Woningstichting Volksbelang');
        $owner222->setLnumber('L0672');

        $owner223 = new Owner();
        $owner223->setName('Woningstichting Domus');
        $owner223->setLnumber('L0669');

        $owner224 = new Owner();
        $owner224->setName('Wbv Van Erfgooiers');
        $owner224->setLnumber('L0667');

        $owner225 = new Owner();
        $owner225->setName('Woonborg');
        $owner225->setLnumber('L0666');

        $owner226 = new Owner();
        $owner226->setName('Woonbron');
        $owner226->setLnumber('L0665');

        $owner227 = new Owner();
        $owner227->setName('Woonstichting Vechthorst');
        $owner227->setLnumber('L0661');

        $owner228 = new Owner();
        $owner228->setName('Stichting Vivare');
        $owner228->setLnumber('L0658');

        $owner229 = new Owner();
        $owner229->setName('Woningstichting Dinteloord');
        $owner229->setLnumber('L0653');

        $owner230 = new Owner();
        $owner230->setName('Bouwvereniging Huis & Erf');
        $owner230->setLnumber('L0643');

        $owner231 = new Owner();
        $owner231->setName('Stichting Destion');
        $owner231->setLnumber('L0642');

        $owner232 = new Owner();
        $owner232->setName('Pré Wonen');
        $owner232->setLnumber('L0640');

        $owner233 = new Owner();
        $owner233->setName('Stichting De Sesyter Veste');
        $owner233->setLnumber('L0637');

        $owner234 = new Owner();
        $owner234->setName('Wonen Meerssen');
        $owner234->setLnumber('L0636');

        $owner235 = new Owner();
        $owner235->setName('Stichting Woningbouw Slochteren');
        $owner235->setLnumber('L0632');

        $owner236 = new Owner();
        $owner236->setName('Brederode Wonen');
        $owner236->setLnumber('L0630');

        $owner237 = new Owner();
        $owner237->setName('WBV Poortugaal ');
        $owner237->setLnumber('L0629');

        $owner238 = new Owner();
        $owner238->setName('Woningstichting Warmunda');
        $owner238->setLnumber('L0623');

        $owner239 = new Owner();
        $owner239->setName('Woonstichting SSW');
        $owner239->setLnumber('L0602');

        $owner240 = new Owner();
        $owner240->setName('Rondom Wonen');
        $owner240->setLnumber('L0590');

        $owner241 = new Owner();
        $owner241->setName('Woningstichting Kennemer Wonen');
        $owner241->setLnumber('L0583');

        $owner242 = new Owner();
        $owner242->setName('Omnivera');
        $owner242->setLnumber('L0582');

        $owner243 = new Owner();
        $owner243->setName('Woonstichting Hulst');
        $owner243->setLnumber('L0579');

        $owner244 = new Owner();
        $owner244->setName('Actium');
        $owner244->setLnumber('L0574');

        $owner245 = new Owner();
        $owner245->setName('Sprengenland Wonen');
        $owner245->setLnumber('L0573');

        $owner246 = new Owner();
        $owner246->setName('Woonpunt');
        $owner246->setLnumber('L0571');

        $owner247 = new Owner();
        $owner247->setName('Stichting Eelder Woningbouw');
        $owner247->setLnumber('L0568');

        $owner248 = new Owner();
        $owner248->setName('Stichting WonenCentraal');
        $owner248->setLnumber('L0565');

        $owner249 = new Owner();
        $owner249->setName('Stichting Elkien');
        $owner249->setLnumber('L0553');

        $owner250 = new Owner();
        $owner250->setName('Stichting R&B Wonen');
        $owner250->setLnumber('L0543');

        $owner251 = new Owner();
        $owner251->setName('Stichting QuaWonen');
        $owner251->setLnumber('L0540');

        $owner252 = new Owner();
        $owner252->setName('Woningbouwvereniging Laren');
        $owner252->setLnumber('L0533');

        $owner253 = new Owner();
        $owner253->setName('Woningstichting Simpelveld');
        $owner253->setLnumber('L0528');

        $owner254 = new Owner();
        $owner254->setName('Trudo');
        $owner254->setLnumber('L0527');

        $owner255 = new Owner();
        $owner255->setName('Stichting AWV Eigen Haard');
        $owner255->setLnumber('L0510');

        $owner256 = new Owner();
        $owner256->setName('FidesWonen');
        $owner256->setLnumber('L0506');

        $owner257 = new Owner();
        $owner257->setName('Stichting TBV');
        $owner257->setLnumber('L0497');

        $owner258 = new Owner();
        $owner258->setName('Stichting Allee Wonen');
        $owner258->setLnumber('L0495');

        $owner259 = new Owner();
        $owner259->setName('Wooncompagnie');
        $owner259->setLnumber('L0478');

        $owner260 = new Owner();
        $owner260->setName('Stichting Chr.Woongroep Marenland');
        $owner260->setLnumber('L0449');

        $owner261 = new Owner();
        $owner261->setName('Wooncorporatie De Goede Woning');
        $owner261->setLnumber('L0446');

        $owner262 = new Owner();
        $owner262->setName('Stichting Rhiant');
        $owner262->setLnumber('L0439');

        $owner263 = new Owner();
        $owner263->setName('Woningstichting Haag Wonen');
        $owner263->setLnumber('L0425');

        $owner264 = new Owner();
        $owner264->setName('Stichting Clavis');
        $owner264->setLnumber('L0418');

        $owner265 = new Owner();
        $owner265->setName('Stichting Arcade mensen en wonen');
        $owner265->setLnumber('L0410');

        $owner266 = new Owner();
        $owner266->setName('Havensteder');
        $owner266->setLnumber('L0392');

        $owner267 = new Owner();
        $owner267->setName('Woningstichting Naarden');
        $owner267->setLnumber('L0386');

        $owner268 = new Owner();
        $owner268->setName('Stichting De Huismeesters');
        $owner268->setLnumber('L0385');

        $owner269 = new Owner();
        $owner269->setName('Dudok Wonen');
        $owner269->setLnumber('L0383');

        $owner270 = new Owner();
        $owner270->setName('Christelijke Woningstichting Patrimonium');
        $owner270->setLnumber('L0380');

        $owner271 = new Owner();
        $owner271->setName('WBV Arnemuiden');
        $owner271->setLnumber('L0379');

        $owner272 = new Owner();
        $owner272->setName('Wst Samenwerking Vlaardingen');
        $owner272->setLnumber('L0371');

        $owner273 = new Owner();
        $owner273->setName('Stichting UWOON');
        $owner273->setLnumber('L0369');

        $owner274 = new Owner();
        $owner274->setName('Woningstichting Wierden en Borgen');
        $owner274->setLnumber('L0366');

        $owner275 = new Owner();
        $owner275->setName('Stichting Woonconcept');
        $owner275->setLnumber('L0363');

        $owner276 = new Owner();
        $owner276->setName('AWS Beter Wonen');
        $owner276->setLnumber('L0358');

        $owner277 = new Owner();
        $owner277->setName('Wonen Wateringen');
        $owner277->setLnumber('L0354');

        $owner278 = new Owner();
        $owner278->setName('Viverion');
        $owner278->setLnumber('L0347');

        $owner279 = new Owner();
        $owner279->setName('Stichting KleurrijkWonen');
        $owner279->setLnumber('L0343');

        $owner280 = new Owner();
        $owner280->setName('Woonstichting Vooruitgang');
        $owner280->setLnumber('L0333');

        $owner281 = new Owner();
        $owner281->setName('Woonstichting Vryleve');
        $owner281->setLnumber('L0331');

        $owner282 = new Owner();
        $owner282->setName('Provides');
        $owner282->setLnumber('L0317');

        $owner283 = new Owner();
        $owner283->setName('SVTwonen Tiel');
        $owner283->setLnumber('L0315');

        $owner284 = new Owner();
        $owner284->setName('Woonstichting Triada');
        $owner284->setLnumber('L0309');

        $owner285 = new Owner();
        $owner285->setName('Woningstichting Alkemade');
        $owner285->setLnumber('L0308');

        $owner286 = new Owner();
        $owner286->setName('Woningbouwvereniging langedijk');
        $owner286->setLnumber('L0305');

        $owner287 = new Owner();
        $owner287->setName('de Sleutels');
        $owner287->setLnumber('L0295');

        $owner288 = new Owner();
        $owner288->setName('Stichting Zaandamse Volkshuisvesting');
        $owner288->setLnumber('L0278');

        $owner289 = new Owner();
        $owner289->setName('Woningstichting Woonwenz');
        $owner289->setLnumber('L0274');

        $owner290 = new Owner();
        $owner290->setName('Wassenaarsche Bouwstichting');
        $owner290->setLnumber('L0272');

        $owner291 = new Owner();
        $owner291->setName('Woonservice Meander');
        $owner291->setLnumber('L0271');

        $owner292 = new Owner();
        $owner292->setName('Stichting ZO Wonen');
        $owner292->setLnumber('L0269');

        $owner293 = new Owner();
        $owner293->setName('Stichting Trivire');
        $owner293->setLnumber('L0267');

        $owner294 = new Owner();
        $owner294->setName('Woningstichting Heteren');
        $owner294->setLnumber('L0254');

        $owner295 = new Owner();
        $owner295->setName('Patrimonium Barendrecht');
        $owner295->setLnumber('L0248');

        $owner296 = new Owner();
        $owner296->setId(1296);
        $owner296->setName('Stichting Antares Woonservice');
        $owner296->setLnumber('L0241');

        $owner297 = new Owner();
        $owner297->setName('Woningstichting Voerendaal');
        $owner297->setLnumber('L0238');

        $owner298 = new Owner();
        $owner298->setName('Standvast Wonen');
        $owner298->setLnumber('L0237');

        $owner299 = new Owner();
        $owner299->setName('Stichting Mozaïek Wonen');
        $owner299->setLnumber('L0232');

        $owner300 = new Owner();
        $owner300->setName('Stichting Elan Wonen');
        $owner300->setLnumber('L0231');

        $owner301 = new Owner();
        $owner301->setName('Woningstichting HEEMwonen');
        $owner301->setLnumber('L0228');

        $owner302 = new Owner();
        $owner302->setName('Stichting Weller Wonen');
        $owner302->setLnumber('L0225');

        $owner303 = new Owner();
        $owner303->setName('Waardwonen');
        $owner303->setLnumber('L0221');

        $owner304 = new Owner();
        $owner304->setName('Stichting WormerWonen');
        $owner304->setLnumber('L0202');

        $owner305 = new Owner();
        $owner305->setName('Mijande Wonen');
        $owner305->setLnumber('L0178');

        $owner306 = new Owner();
        $owner306->setName('Stichting BrabantWonen');
        $owner306->setLnumber('L0176');

        $owner307 = new Owner();
        $owner307->setName('Ons Huis');
        $owner307->setLnumber('L0173');

        $owner308 = new Owner();
        $owner308->setName('Woningstichting Weststellingwerf');
        $owner308->setLnumber('L0165');

        $owner309 = new Owner();
        $owner309->setName('Woningstichting Dinxperlo (WSD)');
        $owner309->setLnumber('L0160');

        $owner310 = new Owner();
        $owner310->setName('Woonstichting Stek');
        $owner310->setLnumber('L0157');

        $owner311 = new Owner();
        $owner311->setName('Woonstichting ’thuis');
        $owner311->setLnumber('L0151');

        $owner312 = new Owner();
        $owner312->setName('R.K. Woningbouwvereniging Zeist');
        $owner312->setLnumber('L0147');

        $owner313 = new Owner();
        $owner313->setName('Stichting Volksbelang Vianen');
        $owner313->setLnumber('L0144');

        $owner314 = new Owner();
        $owner314->setName('Stichting Stadgenoot');
        $owner314->setLnumber('L0124');

        $owner315 = new Owner();
        $owner315->setName('stichting Portaal');
        $owner315->setLnumber('L0117');

        $owner316 = new Owner();
        $owner316->setName('Woningstichting Eigen Haard');
        $owner316->setLnumber('L0108');

        $owner317 = new Owner();
        $owner317->setName('Woningstichting SWZ');
        $owner317->setLnumber('L0093');

        $owner318 = new Owner();
        $owner318->setName('l\'escaut woonservice');
        $owner318->setLnumber('L0089');

        $owner319 = new Owner();
        $owner319->setName('Woningstichtingf Vaals');
        $owner319->setLnumber('L0082');

        $owner320 = new Owner();
        $owner320->setName('Stichting Wonen Zuid');
        $owner320->setLnumber('L0081');

        $owner321 = new Owner();
        $owner321->setName('Stichting Woonstad Rotterdam');
        $owner321->setLnumber('L0079');

        $owner322 = new Owner();
        $owner322->setName('Stichting Wold & Waard');
        $owner322->setLnumber('L0077');

        $owner323 = new Owner();
        $owner323->setName('Woningstichting Bergh');
        $owner323->setLnumber('L0068');

        $owner324 = new Owner();
        $owner324->setName('Stichting Volkshuisvesting Arnhem');
        $owner324->setLnumber('L0065');

        $owner325 = new Owner();
        $owner325->setName('Van Alckmaer voor Wonen');
        $owner325->setLnumber('L0063');

        $owner326 = new Owner();
        $owner326->setName('Stichting Parteon');
        $owner326->setLnumber('L0059');

        $owner327 = new Owner();
        $owner327->setName('Domesta');
        $owner327->setLnumber('L0045');

        $owner328 = new Owner();
        $owner328->setName('Stichting Bo-Ex \'91');
        $owner328->setLnumber('L0041');

        $owner329 = new Owner();
        $owner329->setName('Stichting Lyaemer Wonen');
        $owner329->setLnumber('L0036');

        $owner330 = new Owner();
        $owner330->setName('Stichting v/h De Bouwvereniging');
        $owner330->setLnumber('L0033');

        $owner331 = new Owner();
        $owner331->setName('deltaWonen');
        $owner331->setLnumber('L0029');

        $owner332 = new Owner();
        $owner332->setName('Intermaris');
        $owner332->setLnumber('L0019');

        $owner333 = new Owner();
        $owner333->setName('Woningstichting Rochdale');
        $owner333->setLnumber('L0017');

        $owner334 = new Owner();
        $owner334->setName('Stichting Zayaz');
        $owner334->setLnumber('L0013');

        $owner335 = new Owner();
        $owner335->setName('Wstg Openbaar Belang');
        $owner335->setLnumber('L0008');

        $owner336 = new Owner();
        $owner336->setName('Woningstichting Servatius');
        $owner336->setLnumber('L0005');

        $owner337 = new Owner();
        $owner337->setName('Wonen Noordwest Friesland');
        $owner337->setLnumber('L0003');

        $owner338 = new Owner();
        $owner338->setName('Stichting Eigen Bouw');
        $owner338->setLnumber('L0001');

        $housingStock1 = new HousingStock();
        $housingStock1->setCode('Dobro-BE-01');
        $housingStock1->setName('Dobro Building Examinator Test 01');
        $housingStock1->setDescription('This is the standard test environment of Dobro Building Examinator 1');
        $housingStock1->setCreationTime();
        $housingStock1->setLastChangeTime();
        $housingStock1->setOwner($owner1);

        $housingStock2 = new HousingStock();
        $housingStock2->setCode('Dobro-BE-02');
        $housingStock2->setName('Dobro Building Examinator Test 02');
        $housingStock2->setDescription('This is the standard test environment of Dobro Building Examinator 2');
        $housingStock2->setCreationTime();
        $housingStock2->setLastChangeTime();
        $housingStock2->setOwner($owner1);

        $housingStock3 = new HousingStock();
        $housingStock3->setCode('Dobro-BE-03');
        $housingStock3->setName('Dobro Building Examinator Test 03');
        $housingStock3->setDescription('This is the standard test environment of Dobro Building Examinator 3');
        $housingStock3->setCreationTime();
        $housingStock3->setLastChangeTime();
        $housingStock3->setOwner($owner1);

        $housingStock4 = new HousingStock();
        $housingStock4->setCode('ALG1010');
        $housingStock4->setName('Verkoop complex');
        $housingStock4->setDescription('Testcomplex');
        $housingStock4->setCreationTime();
        $housingStock4->setLastChangeTime();
        $housingStock4->setOwner($owner158);

        $housingStock5 = new HousingStock();
        $housingStock5->setCode('HS-ACT-02');
        $housingStock5->setName('Subset 01 houses of Actium');
        $housingStock5->setDescription('This is the subset 01 set of houses of the company Actium');
        $housingStock5->setCreationTime();
        $housingStock5->setLastChangeTime();
        $housingStock5->setOwner($owner244);

        $housingStock6 = new HousingStock();
        $housingStock6->setCode('HS-ACT-03');
        $housingStock6->setName('Subset 02 houses of Actium');
        $housingStock6->setDescription('This is the subset 02 set of houses of the company Actium');
        $housingStock6->setCreationTime();
        $housingStock6->setLastChangeTime();
        $housingStock6->setOwner($owner244);

        $housingStock6 = new HousingStock();
        $housingStock6->setCode('HS-AWS-01');
        $housingStock6->setName('Houses of AWS Beter Wonen');
        $housingStock6->setDescription('This is the main set of houses of the company AWS Beter Wonen');
        $housingStock6->setCreationTime();
        $housingStock6->setLastChangeTime();
        $housingStock6->setOwner($owner276);

        $housingStock7 = new HousingStock();
        $housingStock7->setCode('BW-1');
        $housingStock7->setName('All houses Baston Wonen');
        $housingStock7->setDescription('All the houses of the company Baston Wonen');
        $housingStock7->setCreationTime();
        $housingStock7->setLastChangeTime();
        $housingStock7->setOwner($owner169);

        $housingStock8 = new HousingStock();
        $housingStock8->setCode('BW-2');
        $housingStock8->setName('Second set of houses Baston Wonen');
        $housingStock8->setDescription('The second set of houses of the company Baston Wonen');
        $housingStock8->setCreationTime();
        $housingStock8->setLastChangeTime();
        $housingStock8->setOwner($owner169);

        $housingStock9 = new HousingStock();
        $housingStock9->setCode('BW-3');
        $housingStock9->setName('Third set of houses Baston Wonen');
        $housingStock9->setDescription('The third set of houses of the company Baston Wonen');
        $housingStock9->setCreationTime();
        $housingStock9->setLastChangeTime();
        $housingStock9->setOwner($owner169);

        $housingStock10 = new HousingStock();
        $housingStock10->setCode('BW-4');
        $housingStock10->setName('Fourth set of houses Baston Wonen');
        $housingStock10->setDescription('The fourth set of houses of the company Baston Wonen');
        $housingStock10->setCreationTime();
        $housingStock10->setLastChangeTime();
        $housingStock10->setOwner($owner169);

        $housingStock11 = new HousingStock();
        $housingStock11->setCode('BW-5');
        $housingStock11->setName('Fifth set of houses Baston Wonen');
        $housingStock11->setDescription('The fifth set of houses of the company Baston Wonen');
        $housingStock11->setCreationTime();
        $housingStock11->setLastChangeTime();
        $housingStock11->setOwner($owner169);

        $housingStock12 = new HousingStock();
        $housingStock12->setCode('BW-6');
        $housingStock12->setName('Sixth set of houses Baston Wonen');
        $housingStock12->setDescription('The sixth set of houses of the company Baston Wonen');
        $housingStock12->setCreationTime();
        $housingStock12->setLastChangeTime();
        $housingStock12->setOwner($owner169);

        $buildingAddress1->setHousingStock($housingStock1);
        $buildingAddress2->setHousingStock($housingStock1);
        $buildingAddress3->setHousingStock($housingStock1);
        $buildingAddress4->setHousingStock($housingStock1);
        $buildingAddress5->setHousingStock($housingStock1);
        $buildingAddress6->setHousingStock($housingStock1);
        $buildingAddress7->setHousingStock($housingStock1);
        $buildingAddress8->setHousingStock($housingStock1);
        $buildingAddress9->setHousingStock($housingStock1);
        $buildingAddress10->setHousingStock($housingStock1);
        $buildingAddress11->setHousingStock($housingStock1);
        $buildingAddress12->setHousingStock($housingStock1);
        $buildingAddress13->setHousingStock($housingStock1);
        $buildingAddress14->setHousingStock($housingStock1);
        $buildingAddress15->setHousingStock($housingStock1);
        $buildingAddress16->setHousingStock($housingStock1);
        $buildingAddress17->setHousingStock($housingStock1);
        $buildingAddress18->setHousingStock($housingStock1);
        $buildingAddress19->setHousingStock($housingStock1);
        $buildingAddress20->setHousingStock($housingStock1);
        $buildingAddress21->setHousingStock($housingStock1);
        $buildingAddress22->setHousingStock($housingStock1);
        $buildingAddress23->setHousingStock($housingStock1);
        $buildingAddress24->setHousingStock($housingStock1);
        $buildingAddress25->setHousingStock($housingStock1);
        $buildingAddress26->setHousingStock($housingStock1);
        $buildingAddress27->setHousingStock($housingStock1);
        $buildingAddress28->setHousingStock($housingStock1);
        $buildingAddress29->setHousingStock($housingStock1);
        $buildingAddress30->setHousingStock($housingStock1);
        $buildingAddress31->setHousingStock($housingStock1);
        $buildingAddress32->setHousingStock($housingStock1);
        $buildingAddress33->setHousingStock($housingStock1);
        $buildingAddress34->setHousingStock($housingStock1);
        $buildingAddress35->setHousingStock($housingStock1);
        $buildingAddress36->setHousingStock($housingStock1);
        $buildingAddress37->setHousingStock($housingStock1);
        $buildingAddress38->setHousingStock($housingStock1);
        $buildingAddress39->setHousingStock($housingStock1);
        $buildingAddress40->setHousingStock($housingStock1);
        $buildingAddress41->setHousingStock($housingStock1);
        $buildingAddress42->setHousingStock($housingStock1);
        $buildingAddress43->setHousingStock($housingStock1);
        $buildingAddress44->setHousingStock($housingStock1);
        $buildingAddress45->setHousingStock($housingStock1);
        $buildingAddress46->setHousingStock($housingStock1);
        $buildingAddress47->setHousingStock($housingStock1);
        $buildingAddress48->setHousingStock($housingStock1);
        $buildingAddress49->setHousingStock($housingStock1);
        $buildingAddress50->setHousingStock($housingStock1);
        $buildingAddress51->setHousingStock($housingStock1);
        $buildingAddress52->setHousingStock($housingStock1);
        $buildingAddress53->setHousingStock($housingStock1);
        $buildingAddress54->setHousingStock($housingStock1);
        $buildingAddress55->setHousingStock($housingStock1);
        $buildingAddress56->setHousingStock($housingStock1);
        $buildingAddress57->setHousingStock($housingStock1);
        $buildingAddress58->setHousingStock($housingStock1);
        $buildingAddress59->setHousingStock($housingStock1);
        $buildingAddress60->setHousingStock($housingStock1);
        $buildingAddress61->setHousingStock($housingStock1);
        $buildingAddress62->setHousingStock($housingStock1);
        $buildingAddress63->setHousingStock($housingStock1);
        $buildingAddress64->setHousingStock($housingStock1);
        $buildingAddress65->setHousingStock($housingStock1);
        $buildingAddress66->setHousingStock($housingStock1);
        $buildingAddress67->setHousingStock($housingStock1);
        $buildingAddress68->setHousingStock($housingStock1);
        $buildingAddress69->setHousingStock($housingStock1);
        $buildingAddress70->setHousingStock($housingStock1);
        $buildingAddress71->setHousingStock($housingStock1);
        $buildingAddress72->setHousingStock($housingStock1);
        $buildingAddress73->setHousingStock($housingStock1);
        $buildingAddress74->setHousingStock($housingStock1);
        $buildingAddress75->setHousingStock($housingStock1);
        $buildingAddress76->setHousingStock($housingStock1);
        $buildingAddress77->setHousingStock($housingStock1);
        $buildingAddress78->setHousingStock($housingStock1);
        $buildingAddress79->setHousingStock($housingStock1);
        $buildingAddress80->setHousingStock($housingStock1);
        $buildingAddress81->setHousingStock($housingStock1);
        $buildingAddress82->setHousingStock($housingStock1);
        $buildingAddress83->setHousingStock($housingStock1);
        $buildingAddress84->setHousingStock($housingStock1);
        $buildingAddress85->setHousingStock($housingStock1);
        $buildingAddress86->setHousingStock($housingStock1);
        $buildingAddress87->setHousingStock($housingStock1);
        $buildingAddress88->setHousingStock($housingStock1);
        $buildingAddress89->setHousingStock($housingStock1);
        $buildingAddress90->setHousingStock($housingStock1);
        $buildingAddress91->setHousingStock($housingStock1);
        $buildingAddress92->setHousingStock($housingStock1);
        $buildingAddress93->setHousingStock($housingStock1);
        $buildingAddress94->setHousingStock($housingStock1);
        $buildingAddress95->setHousingStock($housingStock1);
        $buildingAddress96->setHousingStock($housingStock1);
        $buildingAddress97->setHousingStock($housingStock1);
        $buildingAddress98->setHousingStock($housingStock1);
        $buildingAddress99->setHousingStock($housingStock1);
        $buildingAddress100->setHousingStock($housingStock1);
        $buildingAddress101->setHousingStock($housingStock1);
        $buildingAddress102->setHousingStock($housingStock1);
        $buildingAddress103->setHousingStock($housingStock1);
        $buildingAddress104->setHousingStock($housingStock1);
        $buildingAddress105->setHousingStock($housingStock1);
        $buildingAddress106->setHousingStock($housingStock1);
        $buildingAddress107->setHousingStock($housingStock1);
        $buildingAddress108->setHousingStock($housingStock1);
        $buildingAddress109->setHousingStock($housingStock1);
        $buildingAddress110->setHousingStock($housingStock1);
        $buildingAddress111->setHousingStock($housingStock1);
        $buildingAddress112->setHousingStock($housingStock1);
        $buildingAddress113->setHousingStock($housingStock1);
        $buildingAddress114->setHousingStock($housingStock1);
        $buildingAddress115->setHousingStock($housingStock1);
        $buildingAddress116->setHousingStock($housingStock1);
        $buildingAddress117->setHousingStock($housingStock1);
        $buildingAddress118->setHousingStock($housingStock1);
        $buildingAddress119->setHousingStock($housingStock1);
        $buildingAddress120->setHousingStock($housingStock1);
        $buildingAddress121->setHousingStock($housingStock1);
        $buildingAddress122->setHousingStock($housingStock1);
        $buildingAddress123->setHousingStock($housingStock1);
        $buildingAddress124->setHousingStock($housingStock1);
        $buildingAddress125->setHousingStock($housingStock1);
        $buildingAddress126->setHousingStock($housingStock1);
        $buildingAddress127->setHousingStock($housingStock1);
        $buildingAddress128->setHousingStock($housingStock1);
        $buildingAddress129->setHousingStock($housingStock1);
        $buildingAddress130->setHousingStock($housingStock1);

        $buildingAddress131->setHousingStock($housingStock2);
        $buildingAddress132->setHousingStock($housingStock2);
        $buildingAddress133->setHousingStock($housingStock2);
        $buildingAddress134->setHousingStock($housingStock2);
        $buildingAddress135->setHousingStock($housingStock2);
        $buildingAddress136->setHousingStock($housingStock2);
        $buildingAddress137->setHousingStock($housingStock2);
        $buildingAddress138->setHousingStock($housingStock2);
        $buildingAddress139->setHousingStock($housingStock2);
        $buildingAddress140->setHousingStock($housingStock2);
        $buildingAddress141->setHousingStock($housingStock2);
        $buildingAddress142->setHousingStock($housingStock2);
        $buildingAddress143->setHousingStock($housingStock2);
        $buildingAddress144->setHousingStock($housingStock2);
        $buildingAddress145->setHousingStock($housingStock2);
        $buildingAddress146->setHousingStock($housingStock2);
        $buildingAddress147->setHousingStock($housingStock2);
        $buildingAddress148->setHousingStock($housingStock2);
        $buildingAddress149->setHousingStock($housingStock2);
        $buildingAddress150->setHousingStock($housingStock2);
        $buildingAddress151->setHousingStock($housingStock2);
        $buildingAddress152->setHousingStock($housingStock2);
        $buildingAddress153->setHousingStock($housingStock2);
        $buildingAddress154->setHousingStock($housingStock2);
        $buildingAddress155->setHousingStock($housingStock2);
        $buildingAddress156->setHousingStock($housingStock2);
        $buildingAddress157->setHousingStock($housingStock2);
        $buildingAddress158->setHousingStock($housingStock2);
        $buildingAddress159->setHousingStock($housingStock2);
        $buildingAddress160->setHousingStock($housingStock2);
        $buildingAddress161->setHousingStock($housingStock2);
        $buildingAddress162->setHousingStock($housingStock2);
        $buildingAddress163->setHousingStock($housingStock2);
        $buildingAddress164->setHousingStock($housingStock2);
        $buildingAddress165->setHousingStock($housingStock2);
        $buildingAddress166->setHousingStock($housingStock2);
        $buildingAddress167->setHousingStock($housingStock2);
        $buildingAddress168->setHousingStock($housingStock2);
        $buildingAddress169->setHousingStock($housingStock2);
        $buildingAddress170->setHousingStock($housingStock2);
        $buildingAddress171->setHousingStock($housingStock2);
        $buildingAddress172->setHousingStock($housingStock2);
        $buildingAddress173->setHousingStock($housingStock2);
        $buildingAddress174->setHousingStock($housingStock2);
        $buildingAddress175->setHousingStock($housingStock2);
        $buildingAddress176->setHousingStock($housingStock2);
        $buildingAddress177->setHousingStock($housingStock2);
        $buildingAddress178->setHousingStock($housingStock2);
        $buildingAddress179->setHousingStock($housingStock2);
        $buildingAddress180->setHousingStock($housingStock3);

        $buildingAddress181->setHousingStock($housingStock3);
        $buildingAddress182->setHousingStock($housingStock3);
        $buildingAddress183->setHousingStock($housingStock3);
        $buildingAddress184->setHousingStock($housingStock3);
        $buildingAddress185->setHousingStock($housingStock3);
        $buildingAddress186->setHousingStock($housingStock3);
        $buildingAddress187->setHousingStock($housingStock3);
        $buildingAddress188->setHousingStock($housingStock3);
        $buildingAddress189->setHousingStock($housingStock3);
        $buildingAddress190->setHousingStock($housingStock3);
        $buildingAddress191->setHousingStock($housingStock3);
        $buildingAddress192->setHousingStock($housingStock3);
        $buildingAddress193->setHousingStock($housingStock3);
        $buildingAddress194->setHousingStock($housingStock3);
        $buildingAddress195->setHousingStock($housingStock3);
        $buildingAddress196->setHousingStock($housingStock3);
        $buildingAddress197->setHousingStock($housingStock3);
        $buildingAddress198->setHousingStock($housingStock3);
        $buildingAddress199->setHousingStock($housingStock3);
        
        $buildingAddress201->setHousingStock($housingStock4);
        $buildingAddress202->setHousingStock($housingStock4);
        $buildingAddress203->setHousingStock($housingStock4);
        $buildingAddress204->setHousingStock($housingStock4);
        $buildingAddress205->setHousingStock($housingStock4);
        $buildingAddress206->setHousingStock($housingStock4);
        $buildingAddress207->setHousingStock($housingStock4);
        $buildingAddress208->setHousingStock($housingStock4);
        $buildingAddress209->setHousingStock($housingStock4);
        $buildingAddress210->setHousingStock($housingStock4);
        $buildingAddress211->setHousingStock($housingStock4);
        $buildingAddress212->setHousingStock($housingStock4);
        $buildingAddress213->setHousingStock($housingStock4);
        
        
        $buildingAddress1->setBlock($block1);
        $buildingAddress2->setBlock($block1);
        $buildingAddress3->setBlock($block1);
        $buildingAddress4->setBlock($block1);
        $buildingAddress5->setBlock($block1);
        $buildingAddress6->setBlock($block1);
        $buildingAddress7->setBlock($block1);
        $buildingAddress8->setBlock($block1);
        $buildingAddress9->setBlock($block1);
        $buildingAddress10->setBlock($block1);
        $buildingAddress11->setBlock($block1);
        $buildingAddress12->setBlock($block1);
        $buildingAddress13->setBlock($block1);
        $buildingAddress14->setBlock($block1);
        $buildingAddress15->setBlock($block1);
        $buildingAddress16->setBlock($block1);
        $buildingAddress17->setBlock($block1);
        $buildingAddress18->setBlock($block1);
        $buildingAddress19->setBlock($block1);
        $buildingAddress20->setBlock($block1);
        $buildingAddress21->setBlock($block1);
        $buildingAddress22->setBlock($block1);
        $buildingAddress23->setBlock($block1);
        $buildingAddress24->setBlock($block1);
        $buildingAddress25->setBlock($block2);
        $buildingAddress26->setBlock($block2);
        $buildingAddress27->setBlock($block2);
        $buildingAddress28->setBlock($block2);
        $buildingAddress29->setBlock($block2);
        $buildingAddress30->setBlock($block2);
        $buildingAddress31->setBlock($block2);
        $buildingAddress32->setBlock($block2);
        $buildingAddress33->setBlock($block2);
        $buildingAddress34->setBlock($block2);
        $buildingAddress35->setBlock($block2);
        $buildingAddress36->setBlock($block2);
        $buildingAddress37->setBlock($block2);
        $buildingAddress38->setBlock($block2);
        $buildingAddress39->setBlock($block2);
        $buildingAddress40->setBlock($block2);
        $buildingAddress41->setBlock($block2);
        $buildingAddress42->setBlock($block2);
        $buildingAddress43->setBlock($block2);
        $buildingAddress44->setBlock($block2);
        $buildingAddress45->setBlock($block2);
        $buildingAddress46->setBlock($block2);
        $buildingAddress47->setBlock($block2);
        $buildingAddress48->setBlock($block2);
        $buildingAddress49->setBlock($block2);
        $buildingAddress50->setBlock($block2);
        $buildingAddress51->setBlock($block2);
        $buildingAddress52->setBlock($block2);
        $buildingAddress53->setBlock($block2);
        $buildingAddress54->setBlock($block2);
        $buildingAddress55->setBlock($block2);
        $buildingAddress56->setBlock($block2);
        $buildingAddress57->setBlock($block2);
        $buildingAddress58->setBlock($block2);
        $buildingAddress59->setBlock($block2);
        $buildingAddress60->setBlock($block2);
        $buildingAddress61->setBlock($block3);
        $buildingAddress62->setBlock($block3);
        $buildingAddress63->setBlock($block3);
        $buildingAddress64->setBlock($block3);
        $buildingAddress65->setBlock($block3);
        $buildingAddress66->setBlock($block3);
        $buildingAddress67->setBlock($block3);
        $buildingAddress68->setBlock($block3);
        $buildingAddress69->setBlock($block3);
        $buildingAddress70->setBlock($block3);
        $buildingAddress71->setBlock($block3);
        $buildingAddress72->setBlock($block3);
        $buildingAddress73->setBlock($block3);
        $buildingAddress74->setBlock($block3);
        $buildingAddress75->setBlock($block3);
        $buildingAddress76->setBlock($block3);
        $buildingAddress77->setBlock($block3);
        $buildingAddress78->setBlock($block3);
        $buildingAddress79->setBlock($block3);
        $buildingAddress80->setBlock($block3);
        $buildingAddress81->setBlock($block3);
        $buildingAddress82->setBlock($block3);
        $buildingAddress83->setBlock($block3);
        $buildingAddress84->setBlock($block3);
        $buildingAddress85->setBlock($block3);
        $buildingAddress86->setBlock($block3);
        $buildingAddress87->setBlock($block3);
        $buildingAddress88->setBlock($block3);
        $buildingAddress89->setBlock($block3);
        $buildingAddress90->setBlock($block3);
        $buildingAddress91->setBlock($block3);
        $buildingAddress92->setBlock($block3);
        $buildingAddress93->setBlock($block3);
        $buildingAddress94->setBlock($block3);
        $buildingAddress95->setBlock($block3);
        $buildingAddress96->setBlock($block3);
        $buildingAddress97->setBlock($block4);
        $buildingAddress98->setBlock($block4);
        $buildingAddress99->setBlock($block4);
        $buildingAddress100->setBlock($block4);
        $buildingAddress101->setBlock($block4);
        $buildingAddress102->setBlock($block4);
        $buildingAddress103->setBlock($block4);
        $buildingAddress104->setBlock($block4);
        $buildingAddress105->setBlock($block4);
        $buildingAddress106->setBlock($block4);
        $buildingAddress107->setBlock($block4);
        $buildingAddress108->setBlock($block4);
        $buildingAddress109->setBlock($block4);
        $buildingAddress110->setBlock($block4);
        $buildingAddress111->setBlock($block4);
        $buildingAddress112->setBlock($block4);
        $buildingAddress113->setBlock($block4);
        $buildingAddress114->setBlock($block4);
        $buildingAddress115->setBlock($block4);
        $buildingAddress116->setBlock($block4);
        $buildingAddress117->setBlock($block4);
        $buildingAddress118->setBlock($block4);
        $buildingAddress119->setBlock($block4);
        $buildingAddress120->setBlock($block4);
        $buildingAddress121->setBlock($block4);
        $buildingAddress122->setBlock($block4);
        $buildingAddress123->setBlock($block4);
        $buildingAddress124->setBlock($block4);
        $buildingAddress125->setBlock($block4);
        $buildingAddress126->setBlock($block4);
        $buildingAddress127->setBlock($block4);
        $buildingAddress128->setBlock($block4);
        $buildingAddress129->setBlock($block4);
        $buildingAddress130->setBlock($block4);
        $buildingAddress131->setBlock($block5);
        $buildingAddress132->setBlock($block5);
        $buildingAddress133->setBlock($block5);
        $buildingAddress134->setBlock($block5);
        $buildingAddress135->setBlock($block5);
        $buildingAddress136->setBlock($block6);
        $buildingAddress137->setBlock($block6);
        $buildingAddress138->setBlock($block6);
        $buildingAddress139->setBlock($block6);
        $buildingAddress140->setBlock($block6);
        $buildingAddress141->setBlock($block7);
        $buildingAddress142->setBlock($block7);
        $buildingAddress143->setBlock($block7);
        $buildingAddress144->setBlock($block7);
        $buildingAddress145->setBlock($block7);
        $buildingAddress146->setBlock($block7);
        $buildingAddress147->setBlock($block7);
        $buildingAddress148->setBlock($block7);
        $buildingAddress149->setBlock($block8);
        $buildingAddress150->setBlock($block8);
        $buildingAddress151->setBlock($block8);
        $buildingAddress152->setBlock($block8);
        $buildingAddress153->setBlock($block8);
        $buildingAddress154->setBlock($block8);
        $buildingAddress155->setBlock($block8);
        $buildingAddress156->setBlock($block8);
        $buildingAddress157->setBlock($block8);
        $buildingAddress158->setBlock($block8);
        $buildingAddress159->setBlock($block8);
        $buildingAddress160->setBlock($block8);
        $buildingAddress161->setBlock($block8);
        $buildingAddress162->setBlock($block8);
        $buildingAddress163->setBlock($block9);
        $buildingAddress164->setBlock($block9);
        $buildingAddress165->setBlock($block9);
        $buildingAddress166->setBlock($block9);
        $buildingAddress167->setBlock($block9);
        $buildingAddress168->setBlock($block9);
        $buildingAddress169->setBlock($block9);
        $buildingAddress170->setBlock($block9);
           
        $buildingAddress201->setBlock($block1010);
        $buildingAddress202->setBlock($block1010);
        $buildingAddress203->setBlock($block1010);
        $buildingAddress204->setBlock($block1010);
        $buildingAddress205->setBlock($block1010);
        $buildingAddress206->setBlock($block1010);
        $buildingAddress207->setBlock($block1010);
        $buildingAddress208->setBlock($block1010);
        $buildingAddress209->setBlock($block1010);
        $buildingAddress210->setBlock($block1010);
        $buildingAddress211->setBlock($block1010);
        $buildingAddress212->setBlock($block1010);
        $buildingAddress213->setBlock($block1010);
        
        $buildingType1->setHousingStock($housingStock1);
        $buildingType2->setHousingStock($housingStock1);
        $buildingType3->setHousingStock($housingStock1);
        $buildingType4->setHousingStock($housingStock1);
        $buildingType5->setHousingStock($housingStock1);
        $buildingType6->setHousingStock($housingStock1);
        $buildingType7->setHousingStock($housingStock1);
        $buildingType8->setHousingStock($housingStock2);
        $buildingType9->setHousingStock($housingStock2);
        $buildingType10->setHousingStock($housingStock2);
        $buildingType11->setHousingStock($housingStock2);
        $buildingType12->setHousingStock($housingStock3);
       
        $livingType1->setHousingStock($housingStock1);
        $livingType2->setHousingStock($housingStock1);
        $livingType3->setHousingStock($housingStock1);
        $livingType4->setHousingStock($housingStock1);
        $livingType5->setHousingStock($housingStock1);
        $livingType6->setHousingStock($housingStock2);
        $livingType7->setHousingStock($housingStock2);
        $livingType8->setHousingStock($housingStock2);
        $livingType9->setHousingStock($housingStock3);
        $livingType10->setHousingStock($housingStock3);
        $livingType11->setHousingStock($housingStock3);
        $livingType12->setHousingStock($housingStock3);

        $block1->setHousingStock($housingStock1);
        $block2->setHousingStock($housingStock1);
        $block3->setHousingStock($housingStock1);
        $block4->setHousingStock($housingStock1);
        $block5->setHousingStock($housingStock2);
        $block6->setHousingStock($housingStock2);
        $block7->setHousingStock($housingStock2);
        $block8->setHousingStock($housingStock3);
        $block9->setHousingStock($housingStock3);

        $residentialArea1->setHousingStock($housingStock1);
        $residentialArea2->setHousingStock($housingStock1);
        $residentialArea3->setHousingStock($housingStock1);
        $residentialArea4->setHousingStock($housingStock1);
        $residentialArea5->setHousingStock($housingStock2);
        $residentialArea6->setHousingStock($housingStock2);
        $residentialArea7->setHousingStock($housingStock2);
        $residentialArea8->setHousingStock($housingStock2);
        $residentialArea9->setHousingStock($housingStock3);
        $residentialArea10->setHousingStock($housingStock3);

        for ($i = 1; $i <= 1000; $i++) {
            if (isset(${'residentialArea' . $i})) {
                $manager->persist(${'residentialArea' . $i});
            }
        }

        for ($i = 1; $i <= 1000; $i++) {
            if (isset(${'buildingType' . $i})) {
                $manager->persist(${'buildingType' . $i});
            }
        }

        for ($i = 1; $i <= 1000; $i++) {
            if (isset(${'livingType' . $i})) {
                $manager->persist(${'livingType' . $i});
            }
        }

        for ($i = 1; $i <= 1000; $i++) {
            if (isset(${'vtw' . $i})) {
                $manager->persist(${'vtw' . $i});
            }
        }

        for ($i = 1; $i <= 1000; $i++) {
            if (isset(${'buildingAddress' . $i})) {
                $manager->persist(${'buildingAddress' . $i});
            }
        }

        for ($i = 1; $i <= 1000; $i++) {
            if (isset(${'block' . $i})) {
                $manager->persist(${'block' . $i});
            }
        }

        for ($i = 1; $i <= 1000; $i++) {
            if (isset(${'owner' . $i})) {
                $manager->persist(${'owner' . $i});
            }
        }

        for ($i = 1; $i <= 1000; $i++) {
            if (isset(${'housingStock' . $i})) {
                $manager->persist(${'housingStock' . $i});
            }
        }

        $manager->flush();
    }

}
