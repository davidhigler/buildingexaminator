<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\LivingType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Portfolio\ResidentialArea;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\BuildingTypeSelection;
use App\Entity\Portfolio\BuildingPlanningSelection;
use App\Entity\Portfolio\HousingStockOptionSet;

/**
 * @author Reiny Griemink <rgriemink@gmail.com>
 */
class LoadTestHousingStockData extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        $residentialArea1 = new ResidentialArea();
        $residentialArea1->setId(1);
        $residentialArea1->setCode('*wedlônd◘');
        $residentialArea1->setName('ðorlogsplein 1945');
        $residentialArea1->setDescription('Patat Rât LN \'12');
        $residentialArea1->setCreationTime();
        $residentialArea1->setLastChangeTime();

        $residentialArea2 = new ResidentialArea();
        $residentialArea2->setId(2);
        $residentialArea2->setCode('Ðoenderstraat');
        $residentialArea2->setName('Bænstreetÿ');
        $residentialArea2->setDescription('\'s-Gravenland');
        $residentialArea2->setCreationTime();
        $residentialArea2->setLastChangeTime();

        $residentialArea3 = new ResidentialArea();
        $residentialArea3->setId(3);
        $residentialArea3->setCode('Wµ 3');
        $residentialArea3->setName('stroußenlaan');
        $residentialArea3->setDescription('Llanfairpwllgwyngyllgogerychwyrndrobwllllantysiliogogogoch');
        $residentialArea3->setCreationTime();
        $residentialArea3->setLastChangeTime();

        $residentialArea4 = new ResidentialArea();
        $residentialArea4->setId(4);
        $residentialArea4->setCode('♥♦♣♠ ¾');
        $residentialArea4->setName('çoop §');
        $residentialArea4->setDescription('W@@lspröngé');
        $residentialArea4->setCreationTime();
        $residentialArea4->setLastChangeTime();

        $residentialArea5 = new ResidentialArea();
        $residentialArea5->setId(5);
        $residentialArea5->setCode('Dj`s');
        $residentialArea5->setName('"Ædrie Nus"');
        $residentialArea5->setDescription('å€©®¥¾');
        $residentialArea5->setCreationTime();
        $residentialArea5->setLastChangeTime();

        $residentialArea6 = new ResidentialArea();
        $residentialArea6->setId(6);
        $residentialArea6->setCode('Mw. Verdwaald- Onderwater');
        $residentialArea6->setName('Wil-Jannie Mostert-Uit de fles');
        $residentialArea6->setDescription('Etten-Leur-Noord');
        $residentialArea6->setCreationTime();
        $residentialArea6->setLastChangeTime();

        $residentialArea7 = new ResidentialArea();
        $residentialArea7->setId(7);
        $residentialArea7->setCode('Bangkokstrâët');
        $residentialArea7->setName('Krung Thep Mahanakhon Amon Rattanakosin Mahinthara Ayuthaya Mahadilok Phop Noppharat Ratchathani Burirom Udomratchaniwet Mahasathan Amon Piman Awatan Sathit Sakkathattiya Witsanukam Prasit');
        $residentialArea7->setDescription('Broekpolder samen met Beverwijk Ouverture Bàngert-Oosterpolder Höögh Teijïngen');
        $residentialArea7->setCreationTime();
        $residentialArea7->setLastChangeTime();

        $residentialArea8 = new ResidentialArea();
        $residentialArea8->setId(8);
        $residentialArea8->setCode('IC – Notting (oogarts)');
        $residentialArea8->setName('mw Plu→ in ’t Hol');
        $residentialArea8->setDescription('Zuidbroek (wijk in aanbouw)');
        $residentialArea8->setCreationTime();
        $residentialArea8->setLastChangeTime();

        $residentialArea9 = new ResidentialArea();
        $residentialArea9->setId(9);
        $residentialArea9->setCode('53° 13′ NB, 4° 12′ WL');
        $residentialArea9->setName('4#');
        $residentialArea9->setDescription('Zevenhuizen');
        $residentialArea9->setCreationTime();
        $residentialArea9->setLastChangeTime();

        $residentialArea10 = new ResidentialArea();
        $residentialArea10->setId(10);
        $residentialArea10->setCode('Prof Nl \'34');
        $residentialArea10->setName('A@ Prof. van Kinsbergen 1934');
        $residentialArea10->setDescription('Centrüm ïn de st&d');
        $residentialArea10->setCreationTime();
        $residentialArea10->setLastChangeTime();

        $buildingType1 = new BuildingType();
        $buildingType1->setId(1);
        $buildingType1->setCode('Rijwoning twee onder éénkap');
        $buildingType1->setName('5.Industriefunctie');
        $buildingType1->setDescription('Rijwoning twee onder éénkap');
        $buildingType1->setCreationTime();
        $buildingType1->setLastChangeTime();

        $buildingType2 = new BuildingType();
        $buildingType2->setId(2);
        $buildingType2->setCode('Transport Å2');
        $buildingType2->setName('4.Gezondheidszorgfunctie');
        $buildingType2->setDescription('van Hövell tot Westervlier en Wezeveld');
        $buildingType2->setCreationTime();
        $buildingType2->setLastChangeTime();

        $buildingType3 = new BuildingType();
        $buildingType3->setId(3);
        $buildingType3->setCode('SPORT & tentoonstelling');
        $buildingType3->setName('commerciële-gebouwen');
        $buildingType3->setDescription('gebouwtype 00000000000000000000000000000000000000001');
        $buildingType3->setCreationTime();
        $buildingType3->setLastChangeTime();

        $buildingType4 = new BuildingType();
        $buildingType4->setId(4);
        $buildingType4->setCode('Ziekenhuis');
        $buildingType4->setName('7.Logiesfunctie');
        $buildingType4->setDescription('Hoette zich noemende en schrijvende Hötte');
        $buildingType4->setCreationTime();
        $buildingType4->setLastChangeTime();

        $buildingType5 = new BuildingType();
        $buildingType5->setId(5);
        $buildingType5->setCode('GT0080');
        $buildingType5->setName('6.Kantoorfunctie');
        $buildingType5->setDescription('van den Heuvel tot Beichlingen, gezegd Bartolotti Rijnders');
        $buildingType5->setCreationTime();
        $buildingType5->setLastChangeTime();

        $buildingType6 = new BuildingType();
        $buildingType6->setId(6);
        $buildingType6->setCode('aaaaaaaaaaaaaaaaaaaaAAAAAAAAAAAAAAAAA000000000000000000000000000000000000000000000000000006');
        $buildingType6->setName('9.Sportfunctie');
        $buildingType6->setDescription('l\'arquitecte');
        $buildingType6->setCreationTime();
        $buildingType6->setLastChangeTime();

        $buildingType7 = new BuildingType();
        $buildingType7->setId(7);
        $buildingType7->setCode('m@²Ö');
        $buildingType7->setName('3.Celfunctie');
        $buildingType7->setDescription('Grevink');
        $buildingType7->setCreationTime();
        $buildingType7->setLastChangeTime();

        $buildingType8 = new BuildingType();
        $buildingType8->setId(8);
        $buildingType8->setCode('GTA ¡²³¤');
        $buildingType8->setName('8.Onderwijsfunctie');
        $buildingType8->setDescription('Griemink');
        $buildingType8->setCreationTime();
        $buildingType8->setLastChangeTime();

        $buildingType9 = new BuildingType();
        $buildingType9->setId(9);
        $buildingType9->setCode('5.Rijwoning duplex kleine gezinnen');
        $buildingType9->setName('2.Bijeenkomstfunctie');
        $buildingType9->setDescription('Sagrada Família');
        $buildingType9->setCreationTime();
        $buildingType9->setLastChangeTime();

        $buildingType10 = new BuildingType();
        $buildingType10->setId(10);
        $buildingType10->setCode('2.Rijwoning twee onder éénkap');
        $buildingType10->setName('12.Geen gebouw 11.Overige');
        $buildingType10->setDescription('Om \'t Hoekje');
        $buildingType10->setCreationTime();
        $buildingType10->setLastChangeTime();

        $buildingType11 = new BuildingType();
        $buildingType11->setId(11);
        $buildingType11->setCode('D@vïd Hïllêning');
        $buildingType11->setName('11.Overige');
        $buildingType11->setDescription('Hotel');
        $buildingType11->setCreationTime();
        $buildingType11->setLastChangeTime();

        $buildingType12 = new BuildingType();
        $buildingType12->setId(12);
        $buildingType12->setCode('Wôrdéè');
        $buildingType12->setName('13.kelderfunctie');
        $buildingType12->setDescription('omschrijving van het gebouwtype binnen de voorraad');
        $buildingType12->setCreationTime();
        $buildingType12->setLastChangeTime();

        $buildingType13 = new BuildingType();
        $buildingType13->setId(13);
        $buildingType13->setCode('Legenda');
        $buildingType13->setName('Woonwagen');
        $buildingType13->setDescription('vhosihg hvuh dho ä ueabvuiabio haeehvoiaejb iodhvujabiobhaeiohviaeh ihasdkjhgioedhbv');
        $buildingType13->setCreationTime();
        $buildingType13->setLastChangeTime();
        
        $livingType1 = new LivingType();
        $livingType1->setId(1);
        $livingType1->setCode('lt1');
        $livingType1->setName('Living type 1');
        $livingType1->setCreationTime();
        $livingType1->setLastChangeTime();

        $livingType2 = new LivingType();
        $livingType2->setId(2);
        $livingType2->setCode('lt2');
        $livingType2->setName('Living type 2');
        $livingType2->setCreationTime();
        $livingType2->setLastChangeTime();

        $livingType3 = new LivingType();
        $livingType3->setId(3);
        $livingType3->setCode('lt3');
        $livingType3->setName('Living type 3');
        $livingType3->setCreationTime();
        $livingType3->setLastChangeTime();

        $vtw1 = new vtw();
        $vtw1->setId(1);
        $vtw1->setCode('WT 1');
        $vtw1->setType('eengezinswoning')
        $vtw1->setBuildingType('1')
        $vtw1->setBouwjaar('voor 1950')
        $vtw1->setRooftype('hellend dak')

        $vtw2 = new vtw();
        $vtw2->setId(2);
        $vtw2->setCode('WT 1R');
        $vtw2->setType('renovatie eengezinswoning')
        $vtw2->setBuildingType('1R')
        $vtw2->setBouwjaar('voor 1950')
        $vtw2->setRooftype('hellend dak')
            
        $vtw3 = new vtw();
        $vtw3->setId(3);
        $vtw3->setCode('WT 2');
        $vtw3->setType('eengezinswoning')
        $vtw3->setBuildingType('2')
        $vtw3->setBouwjaar('tussen 1950 en 1970')
        $vtw3->setRooftype('hellend dak')

        $vtw4 = new vtw();
        $vtw4->setId(4);
        $vtw4->setCode('WT 2R');
        $vtw4->setType('renovatie eengezinswoning')
        $vtw4->setBuildingType('2R')
        $vtw4->setBouwjaar('tussen 1950 en 1970')
        $vtw4->setRooftype('hellend dak')
            
        $vtw5 = new vtw();
        $vtw5->setId(5);
        $vtw5->setCode('WT 3');
        $vtw5->setType('eengezinswoning')
        $vtw5->setBuildingType('3')
        $vtw5->setBouwjaar('tussen 1950 en 1970')
        $vtw5->setRooftype('hellend dak')

        $vtw6 = new vtw();
        $vtw6->setId(6);
        $vtw6->setCode('WT 4');
        $vtw6->setType('eengezinswoning/senioren-woning')
        $vtw6->setBuildingType('4')
        $vtw6->setBouwjaar('tussen 1990 en 2000')
        $vtw6->setRooftype('hellend dak')
            
        $vtw7 = new vtw();
        $vtw7->setId(7);
        $vtw7->setCode('WT 5');
        $vtw7->setType('eengezinswoning')
        $vtw7->setBuildingType('5')
        $vtw7->setBouwjaar('tussen 1990 en 2000')
        $vtw7->setRooftype('hellend dak')

        $vtw8 = new vtw();
        $vtw8->setId(8);
        $vtw8->setCode('WT 6');
        $vtw8->setType('eengezinswoning')
        $vtw8->setBuildingType('6')
        $vtw8->setBouwjaar('na 2000')
        $vtw8->setRooftype('hellend dak')
        
        $vtw9 = new vtw();
        $vtw9->setId(9);
        $vtw9->setCode('WT 7R');
        $vtw9->setType('renovatie eengezinswoning')
        $vtw9->setBuildingType('7R')
        $vtw9->setBouwjaar('tussen 1950 en 1970')
        $vtw9->setRooftype('hellend dak')
            
        $vtw10 = new vtw();
        $vtw10->setId(10);
        $vtw10->setCode('WT 8');
        $vtw10->setType('eengezinswoning')
        $vtw10->setBuildingType('8')
        $vtw10->setBouwjaar('tussen 1970 en 1990')
        $vtw10->setRooftype('hellend dak')
        
        $vtw11 = new vtw();
        $vtw11->setId(11);
        $vtw11->setCode('WT 9');
        $vtw11->setType('eengezinswoning')
        $vtw11->setBuildingType('9')
        $vtw11->setBouwjaar('tussen 1990 en 2000')
        $vtw11->setRooftype('hellend dak')

        $vtw12 = new vtw();
        $vtw12->setId(12);
        $vtw12->setCode('WT 10');
        $vtw12->setType('eengezinswoning')
        $vtw12->setBuildingType('10')
        $vtw12->setBouwjaar('na 2000')
        $vtw12->setRooftype('hellend dak')
            
        $vtw13 = new vtw();
        $vtw13->setId(13);
        $vtw13->setCode('WT 11');
        $vtw13->setType('eengezinswoning')
        $vtw13->setBuildingType('11')
        $vtw13->setBouwjaar('tussen 1950 en 1970')
        $vtw13->setRooftype('vlak dak')

        $vtw14 = new vtw();
        $vtw14->setId(14);
        $vtw14->setCode('WT 11R');
        $vtw14->setType('renovatie eengezinswoning')
        $vtw14->setBuildingType('11R')
        $vtw14->setBouwjaar('tussen 1950 en 1970')
        $vtw14->setRooftype('vlak dak')
            
        $vtw15 = new vtw();
        $vtw15->setId(15);
        $vtw15->setCode('WT 12');
        $vtw15->setType('eengezinswoning')
        $vtw15->setBuildingType('12')
        $vtw15->setBouwjaar('tussen 1970 en 1990')
        $vtw15->setRooftype('vlak dak')

        $vtw16 = new vtw();
        $vtw16->setId(16);
        $vtw16->setCode('WT 13');
        $vtw16->setType('eengezinswoning')
        $vtw16->setBuildingType('13')
        $vtw16->setBouwjaar('na 1990')
        $vtw16->setRooftype('vlak dak')
            
        $vtw17 = new vtw();
        $vtw17->setId(17);
        $vtw17->setCode('WT 14');
        $vtw17->setType('open portiekwoning')
        $vtw17->setBuildingType('14')
        $vtw17->setBouwjaar('voor 1950')
        $vtw17->setRooftype('hellend dak')

        $vtw18 = new vtw();
        $vtw18->setId(18);
        $vtw18->setCode('WT 14R');
        $vtw18->setType('eengezinswoning')
        $vtw18->setBuildingType('14R')
        $vtw18->setBouwjaar('voor 1950')
        $vtw18->setRooftype('hellend dak')
        
        $vtw19 = new vtw();
        $vtw19->setId(19);
        $vtw19->setCode('WT 15');
        $vtw19->setType('open portiekwoning')
        $vtw19->setBuildingType('15')
        $vtw19->setBouwjaar('voor 1950')
        $vtw19->setRooftype('vlak dak')
            
        $vtw20 = new vtw();
        $vtw20->setId(20);
        $vtw20->setCode('WT 15R');
        $vtw20->setType('renovatie open portiekwoning')
        $vtw20->setBuildingType('15R')
        $vtw20->setBouwjaar('voor 1950')
        $vtw20->setRooftype('vlak dak')
            
        $vtw21 = new vtw();
        $vtw21->setId(21);
        $vtw21->setCode('WT 16');
        $vtw21->setType('etagewoning')
        $vtw21->setBuildingType('16')
        $vtw21->setBouwjaar('voor 1950')
        $vtw21->setRooftype('hellend dak')

        $vtw22 = new vtw();
        $vtw22->setId(22);
        $vtw22->setCode('WT 16R');
        $vtw22->setType('renovatie etagewoning')
        $vtw22->setBuildingType('16R')
        $vtw22->setBouwjaar('voor 1950')
        $vtw22->setRooftype('hellend dak')
            
        $vtw23 = new vtw();
        $vtw23->setId(23);
        $vtw23->setCode('WT 17');
        $vtw23->setType('etagewoning')
        $vtw23->setBuildingType('17')
        $vtw23->setBouwjaar('voor 1950')
        $vtw23->setRooftype('vlak dak')

        $vtw24 = new vtw();
        $vtw24->setId(24);
        $vtw24->setCode('WT 17R');
        $vtw24->setType('renovatie etagewoning')
        $vtw24->setBuildingType('17R')
        $vtw24->setBouwjaar('voor 1950')
        $vtw24->setRooftype('vlak dak')
            
        $vtw25 = new vtw();
        $vtw25->setId(25);
        $vtw25->setCode('WT 18');
        $vtw25->setType('trappenhuisflat Amsterdamse school')
        $vtw25->setBuildingType('18')
        $vtw25->setBouwjaar('voor 1950')
        $vtw25->setRooftype('hellend dak')

        $vtw26 = new vtw();
        $vtw26->setId(26);
        $vtw26->setCode('WT 18R');
        $vtw26->setType('renovatie trappenhuisflat Amsterdamse school')
        $vtw26->setBuildingType('18R')
        $vtw26->setBouwjaar('voor 1950')
        $vtw26->setRooftype('hellend dak')
            
        $vtw27 = new vtw();
        $vtw27->setId(27);
        $vtw27->setCode('WT 19');
        $vtw27->setType('trappenhuisflat tot en met 4 lagen')
        $vtw27->setBuildingType('19')
        $vtw27->setBouwjaar('voor 1950')
        $vtw27->setRooftype('hellend dak')

        $vtw28 = new vtw();
        $vtw28->setId(28);
        $vtw28->setCode('WT 19R');
        $vtw28->setType('renovatie trappenhuisflat tot en met 4 lagen')
        $vtw28->setBuildingType('19R')
        $vtw28->setBouwjaar('voor 1950')
        $vtw28->setRooftype('hellend dak')
        
        $vtw29 = new vtw();
        $vtw29->setId(29);
        $vtw29->setCode('WT 20');
        $vtw29->setType('trappenhuisflat tot en met 4 lagen')
        $vtw29->setBuildingType('20')
        $vtw29->setBouwjaar('tussen 1950 en 1970')
        $vtw29->setRooftype('hellend dak')
            
        $vtw30 = new vtw();
        $vtw30->setId(30);
        $vtw30->setCode('WT 20R');
        $vtw30->setType('trappenhuisflat tot en met 4 lagen')
        $vtw30->setBuildingType('20R')
        $vtw30->setBouwjaar('tussen 1950 en 1970')
        $vtw30->setRooftype('hellend dak')
        
        $vtw31 = new vtw();
        $vtw31->setId(31);
        $vtw31->setCode('WT 21');
        $vtw31->setType('trappenhuisflat tot en met 4 lagen')
        $vtw31->setBuildingType('21')
        $vtw31->setBouwjaar('voor 1950')
        $vtw31->setRooftype('vlak dak')

        $vtw32 = new vtw();
        $vtw32->setId(32);
        $vtw32->setCode('WT 21R');
        $vtw32->setType('renovatie trappenhuisflat tot en met 4 lagen')
        $vtw32->setBuildingType('21R')
        $vtw32->setBouwjaar('voor 1950')
        $vtw32->setRooftype('vlak dak')
            
        $vtw33 = new vtw();
        $vtw33->setId(33);
        $vtw33->setCode('WT 22');
        $vtw33->setType('trappenhuisflat tot en met 4 lagen')
        $vtw33->setBuildingType('22')
        $vtw33->setBouwjaar('tussen 1950 en 1970')
        $vtw33->setRooftype('vlak dak')

        $vtw34 = new vtw();
        $vtw34->setId(34);
        $vtw34->setCode('WT 22R');
        $vtw34->setType('renovatie trappenhuisflat tot en met 4 lagen')
        $vtw34->setBuildingType('22R')
        $vtw34->setBouwjaar('tussen 1950 en 1970')
        $vtw34->setRooftype('vlak dak')
            
        $vtw35 = new vtw();
        $vtw35->setId(35);
        $vtw35->setCode('WT 23');
        $vtw35->setType('trappenhuisflat tot en met 4 lagen')
        $vtw35->setBuildingType('23')
        $vtw35->setBouwjaar('tussen 1970 en 1990')
        $vtw35->setRooftype('vlak dak')

        $vtw36 = new vtw();
        $vtw36->setId(36);
        $vtw36->setCode('WT 24');
        $vtw36->setType('trappenhuisflat tot en met 4 lagen')
        $vtw36->setBuildingType('24')
        $vtw36->setBouwjaar('na 1990')
        $vtw36->setRooftype('vlak dak')
            
        $vtw37 = new vtw();
        $vtw37->setId(37);
        $vtw37->setCode('WT 25');
        $vtw37->setType('trappenhuisflat tot en met 4 lagen')
        $vtw37->setBuildingType('25')
        $vtw37->setBouwjaar('na 1990')
        $vtw37->setRooftype('vlak dak')

        $vtw38 = new vtw();
        $vtw38->setId(38);
        $vtw38->setCode('WT 26');
        $vtw38->setType('trappenhuisflat tot en met 4 lagen')
        $vtw38->setBuildingType('26')
        $vtw38->setBouwjaar('na 1990')
        $vtw38->setRooftype('vlak dak')
        
        $vtw39 = new vtw();
        $vtw39->setId(39);
        $vtw39->setCode('WT 27');
        $vtw39->setType('trappenhuis-/corridorflat zgn. Urban villa tot en met 4 lagen')
        $vtw39->setBuildingType('27')
        $vtw39->setBouwjaar('na 1990')
        $vtw39->setRooftype('vlak en hellend dak')
            
        $vtw40 = new vtw();
        $vtw40->setId(40);
        $vtw40->setCode('WT 28');
        $vtw40->setType('trappenhuis-/corridorflat meer dan 4 lagen')
        $vtw40->setBuildingType('28')
        $vtw40->setBouwjaar('1950 en 1970')
        $vtw40->setRooftype('vlak dak') 
            
        $vtw41 = new vtw();
        $vtw41->setId(41);
        $vtw41->setCode('WT 28R');
        $vtw41->setType('renovatie-trappenhuis-/corridorflat meer dan 4 lagen')
        $vtw41->setBuildingType('28R')
        $vtw41->setBouwjaar('tussen 1950 en 1970')
        $vtw41->setRooftype('vlak dak')

        $vtw42 = new vtw();
        $vtw42->setId(42);
        $vtw42->setCode('WT 29');
        $vtw42->setType('trappenhuis-/corridorflat meer dan 4 lagen')
        $vtw42->setBuildingType('29')
        $vtw42->setBouwjaar('tussen 1970 en 1990')
        $vtw42->setRooftype('vlak dak')
            
        $vtw43 = new vtw();
        $vtw43->setId(43);
        $vtw43->setCode('WT 30');
        $vtw43->setType('trappenhuis-/corridorflat meer dan 4 lagen')
        $vtw43->setBuildingType('30')
        $vtw43->setBouwjaar('na 1990')
        $vtw43->setRooftype('vlak dak')

        $vtw44 = new vtw();
        $vtw44->setId(44);
        $vtw44->setCode('WT 31');
        $vtw44->setType('galerijflat tot en met 2 lagen')
        $vtw44->setBuildingType('31')
        $vtw44->setBouwjaar('tussen 1950 en 1970')
        $vtw44->setRooftype('vlak dak')
            
        $vtw45 = new vtw();
        $vtw45->setId(45);
        $vtw45->setCode('WT 32');
        $vtw45->setType('galerijflat tot en met 4 lagen')
        $vtw45->setBuildingType('32')
        $vtw45->setBouwjaar('tussen 1950 en 1970')
        $vtw45->setRooftype('vlak dak')

        $vtw46 = new vtw();
        $vtw46->setId(46);
        $vtw46->setCode('WT 32R');
        $vtw46->setType('renovatie galerijflat tot en met 4 lagen')
        $vtw46->setBuildingType('32R')
        $vtw46->setBouwjaar('tussen 1950 en 1970')
        $vtw46->setRooftype('vlak dak')
            
        $vtw47 = new vtw();
        $vtw47->setId(47);
        $vtw47->setCode('WT 33');
        $vtw47->setType('galerijflat tot en met 4 lagen')
        $vtw47->setBuildingType('33')
        $vtw47->setBouwjaar('tussen 1970 en 1990')
        $vtw47->setRooftype('vlak dak')

        $vtw48 = new vtw();
        $vtw48->setId(48);
        $vtw48->setCode('WT 34');
        $vtw48->setType('galerijflat tot en met 4 lagen')
        $vtw48->setBuildingType('34')
        $vtw48->setBouwjaar('na 1970')
        $vtw48->setRooftype('vlak dak')
        
        $vtw49 = new vtw();
        $vtw49->setId(49);
        $vtw49->setCode('WT 35');
        $vtw49->setType('galerijflat meer dan 4 lagen')
        $vtw49->setBuildingType('35')
        $vtw49->setBouwjaar('tussen 1950 en 1970')
        $vtw49->setRooftype('vlak dak')
            
        $vtw50 = new vtw();
        $vtw50->setId(50);
        $vtw50->setCode('WT 35R');
        $vtw50->setType('renovatie galerijflat meer dan 4 lagen')
        $vtw50->setBuildingType('35R')
        $vtw50->setBouwjaar('tussen 1950 en 1970')
        $vtw50->setRooftype('vlak dak') 
       
        $vtw51 = new vtw();
        $vtw51->setId(51);
        $vtw51->setCode('WT 36');
        $vtw51->setType('galerijflat meer dan 4 lagen')
        $vtw51->setBuildingType('36')
        $vtw51->setBouwjaar('tussen 1970 en 1990')
        $vtw51->setRooftype('vlak dak')

        $vtw52 = new vtw();
        $vtw52->setId(52);
        $vtw52->setCode('WT 37');
        $vtw52->setType('galerijflat meer dan 4 lagen')
        $vtw52->setBuildingType('37')
        $vtw52->setBouwjaar('na 1990')
        $vtw52->setRooftype('vlak dak')
            
        $vtw53 = new vtw();
        $vtw53->setId(53);
        $vtw53->setCode('WT 38R');
        $vtw53->setType('renovatie galerijmaisonnette meer dan 4 lagen')
        $vtw53->setBuildingType('38R')
        $vtw53->setBouwjaar('tussen 1950 en 1970')
        $vtw53->setRooftype('vlak dak')

        $vtw54 = new vtw();
        $vtw54->setId(54);
        $vtw54->setCode('WT 39R');
        $vtw54->setType('renovatie eengezinswoning')
        $vtw54->setBuildingType('39R')
        $vtw54->setBouwjaar('voor 1950')
        $vtw54->setRooftype('hellend dak')
            
        $vtw55 = new vtw();
        $vtw55->setId(55);
        $vtw55->setCode('WT 40');
        $vtw55->setType('luxe appartementencomplex meer dan 4 lagen')
        $vtw55->setBuildingType('40')
        $vtw55->setBouwjaar('na 2000')
        $vtw55->setRooftype('vlak dak')

        $vtw56 = new vtw();
        $vtw56->setId(56);
        $vtw56->setCode('WT 41');
        $vtw56->setType('bovenwoning')
        $vtw56->setBuildingType('41')
        $vtw56->setBouwjaar('tussen 1950 en 1970')
        $vtw56->setRooftype('vlak dak')
            
        $vtw57 = new vtw();
        $vtw57->setId(57);
        $vtw57->setCode('WT 42');
        $vtw57->setType('vinexwoning')
        $vtw57->setBuildingType('42')
        $vtw57->setBouwjaar('na 1990')
        $vtw57->setRooftype('vlak dak')

        $vtw58 = new vtw();
        $vtw58->setId(58);
        $vtw58->setCode('WT 43');
        $vtw58->setType('galerijflat 2 lagen')
        $vtw58->setBuildingType('43')
        $vtw58->setBouwjaar('na 1990')
        $vtw58->setRooftype('hellend dak')
        
        $vtw59 = new vtw();
        $vtw59->setId(59);
        $vtw59->setCode('WT 44');
        $vtw59->setType('appartementen in grachtenpand')
        $vtw59->setBuildingType('44')
        $vtw59->setBouwjaar('voor 1900')
        $vtw59->setRooftype('vlak en hellend dak')
            
        $vtw60 = new vtw();
        $vtw60->setId(60);
        $vtw60->setCode('WT 45');
        $vtw60->setType('eengezinswoning')
        $vtw60->setBuildingType('45')
        $vtw60->setBouwjaar('na 2000')
        $vtw60->setRooftype('vlak dak') 
        
        $vtw1 = new vtw();
        $vtw61->setId(61);
        $vtw61->setCode('WT 46');
        $vtw61->setType('eengezinswoning')
        $vtw61->setBuildingType('46')
        $vtw61->setBouwjaar('na 2000')
        $vtw61->setRooftype('vlak dak')

        $vtw62 = new vtw();
        $vtw62->setId(62);
        $vtw62->setCode('WT 47');
        $vtw62->setType('eengezinswoning')
        $vtw62->setBuildingType('47')
        $vtw62->setBouwjaar('na 2000')
        $vtw62->setRooftype('hellend dak')
            
        $vtw63 = new vtw();
        $vtw63->setId(63);
        $vtw63->setCode('WT 48R');
        $vtw63->setType('Renovatie eengezinswoning')
        $vtw63->setBuildingType('48R')
        $vtw63->setBouwjaar('tussen 1950 en 1970')
        $vtw63->setRooftype('hellend dak')

        $vtw64 = new vtw();
        $vtw64->setId(64);
        $vtw64->setCode('WT 49');
        $vtw64->setType('duurzame eengezinswoning')
        $vtw64->setBuildingType('49')
        $vtw64->setBouwjaar('na 2015')
        $vtw64->setRooftype('hellend dak')
            
        $vtw65 = new vtw();
        $vtw65->setId(65);
        $vtw65->setCode('WT 50');
        $vtw65->setType('duurzame galerij appartementen')
        $vtw65->setBuildingType('50')
        $vtw65->setBouwjaar('na 2015')
        $vtw65->setRooftype('vlak dak')

        $vtw66 = new vtw();
        $vtw66->setId(66);
        $vtw66->setCode('WT 51R');
        $vtw66->setType('renovatie eengezinswoning nul op de meter')
        $vtw66->setBuildingType('51R')
        $vtw66->setBouwjaar('tussen 1970 en 1990')
        $vtw66->setRooftype('hellend dak')
            
        $vtw67 = new vtw();
        $vtw67->setId(67);
        $vtw67->setCode('WT 52');
        $vtw67->setType('energieneutrale eengezinswoning nul op de meter')
        $vtw67->setBuildingType('52')
        $vtw67->setBouwjaar('na 2016')
        $vtw67->setRooftype('hellend dak')

        $vtw68 = new vtw();
        $vtw68->setId(68);
        $vtw68->setCode('WT 135');
        $vtw68->setType('energieneutrale appartementencomplex nul op de meter')
        $vtw68->setBuildingType('135')
        $vtw68->setBouwjaar('na 2019')
        $vtw68->setRooftype('vlak dak')
            
        $vtw80 = new vtw();
        $vtw80->setId(80);
        $vtw80->setCode('GT 1');
        $vtw80->setType('aangebouwde garagebox')
        $vtw80->setBuildingType('1')
        $vtw80->setBouwjaar('nvt')
        $vtw80->setRooftype('hellend dak')
            
        $vtw81 = new vtw();
        $vtw81->setId(81);
        $vtw81->setCode('GT 2');
        $vtw81->setType('aangebouwde garagebox')
        $vtw81->setBuildingType('2')
        $vtw81->setBouwjaar('nvt')
        $vtw81->setRooftype('vlak dak')
            
        $vtw82 = new vtw();
        $vtw82->setId(82);
        $vtw82->setCode('GT 3');
        $vtw82->setType('vrijstaande garagebox')
        $vtw82->setBuildingType('3')
        $vtw82->setBouwjaar('nvt')
        $vtw82->setRooftype('vlak dak')
            
        $vtw83 = new vtw();
        $vtw83->setId(83);
        $vtw83->setCode('GT 4');
        $vtw83->setType('garagebox in rij')
        $vtw83->setBuildingType('4')
        $vtw83->setBouwjaar('nvt')
        $vtw83->setRooftype('vlak dak')
            
        $vtw84 = new vtw();
        $vtw84->setId(84);
        $vtw84->setCode('GT 5');
        $vtw84->setType('garagebox onder gebouw')
        $vtw84->setBuildingType('5')
        $vtw84->setBouwjaar('nvt')
        $vtw84->setRooftype('nvt')
         
        $vtw85 = new vtw();
        $vtw85->setId(85);
        $vtw85->setCode('GT 6');
        $vtw85->setType('garagebox ondergronds')
        $vtw85->setBuildingType('6')
        $vtw85->setBouwjaar('nvt')
        $vtw85->setRooftype('nvt')
            
        $vtw86 = new vtw();
        $vtw86->setId(86);
        $vtw86->setCode('GT 7');
        $vtw86->setType('garagebox bovengronds')
        $vtw86->setBuildingType('7')
        $vtw86->setBouwjaar('nvt')
        $vtw86->setRooftype('nvt')
            
        $vtw90 = new vtw();
        $vtw90->setId(90);
        $vtw90->setCode('KT 1');
        $vtw90->setType('grachtenpand gevel(s) in metselwerk')
        $vtw90->setBuildingType('1')
        $vtw90->setBouwjaar('nvt')
        $vtw90->setRooftype('nvt')
            
        $vtw91 = new vtw();
        $vtw91->setId(91);
        $vtw91->setCode('KT 2');
        $vtw91->setType('grachtenpand gevel(s) gestukadoord en geschilderd')
        $vtw91->setBuildingType('2')
        $vtw91->setBouwjaar('nvt')
        $vtw91->setRooftype('nvt')
            
        $vtw92 = new vtw();
        $vtw92->setId(92);
        $vtw92->setCode('KT 3');
        $vtw92->setType('klassieke (monumentale) kantoorvilla gevel(s) in metselwerk')
        $vtw92->setBuildingType('3')
        $vtw92->setBouwjaar('nvt')
        $vtw92->setRooftype('nvt')
            
        $vtw93 = new vtw();
        $vtw93->setId(93);
        $vtw93->setCode('KT 4');
        $vtw93->setType('klassieke (monumentale) kantoorvilla gevel(s) gestukadoord en geschilderd')
        $vtw93->setBuildingType('4')
        $vtw93->setBouwjaar('nvt')
        $vtw93->setRooftype('nvt')
            
        $vtw94 = new vtw();
        $vtw94->setId(94);
        $vtw94->setCode('KT 5');
        $vtw94->setType('middelhoog jaren zestig-zeventig bouw gevel(s) in metselwerk')
        $vtw94->setBuildingType('5')
        $vtw94->setBouwjaar('nvt')
        $vtw94->setRooftype('nvt')
            
        $vtw95 = new vtw();
        $vtw95->setId(95);
        $vtw95->setCode('KT 6');
        $vtw95->setType('middelhoog jaren zestig-zeventig bouw gevel(s) in beton')
        $vtw95->setBuildingType('6')
        $vtw95->setBouwjaar('nvt')
        $vtw95->setRooftype('nvt')
           
        $vtw96 = new vtw();
        $vtw96->setId(96);
        $vtw96->setCode('KT 7');
        $vtw96->setType('laag gevel(s) in metselwerk')
        $vtw96->setBuildingType('7')
        $vtw96->setBouwjaar('nvt')
        $vtw96->setRooftype('nvt')
         
        $vtw97 = new vtw();
        $vtw97->setId(97);
        $vtw97->setCode('KT 8');
        $vtw97->setType('laag vliesgevel(s)')
        $vtw97->setBuildingType('8')
        $vtw97->setBouwjaar('nvt')
        $vtw97->setRooftype('nvt')
            
        $vtw98 = new vtw();
        $vtw98->setId(98);
        $vtw98->setCode('KT 9');
        $vtw98->setType('laag gevel(s) in natuursteen')
        $vtw98->setBuildingType('9')
        $vtw98->setBouwjaar('nvt')
        $vtw98->setRooftype('nvt')
        
        $vtw99 = new vtw();
        $vtw99->setId(99);
        $vtw99->setCode('KT 10');
        $vtw99->setType('laag gevel(s) in beton')
        $vtw99->setBuildingType('10')
        $vtw99->setBouwjaar('nvt')
        $vtw99->setRooftype('nvt')
            
        $vtw100 = new vtw();
        $vtw100->setId(100);
        $vtw100->setCode('KT 11');
        $vtw100->setType('laag gevel(s) in metaal')
        $vtw100->setBuildingType('11')
        $vtw100->setBouwjaar('nvt')
        $vtw100->setRooftype('nvt')
            
        $vtw101 = new vtw();
        $vtw101->setId(101);
        $vtw101->setCode('KT 12');
        $vtw101->setType('middelhoog gevel(s) metselwerk')
        $vtw101->setBuildingType('12')
        $vtw101->setBouwjaar('nvt')
        $vtw101->setRooftype('nvt')
            
        $vtw102 = new vtw();
        $vtw102->setId(102);
        $vtw102->setCode('KT 13');
        $vtw102->setType('middelhoog vliesgevel(s)')
        $vtw102->setBuildingType('13')
        $vtw102->setBouwjaar('nvt')
        $vtw102->setRooftype('nvt')
            
        $vtw103 = new vtw();
        $vtw103->setId(103);
        $vtw103->setCode('KT 14');
        $vtw103->setType('middelhoog gevel(s) in natuursteen')
        $vtw103->setBuildingType('14')
        $vtw103->setBouwjaar('nvt')
        $vtw103->setRooftype('nvt')
            
        $vtw104 = new vtw();
        $vtw104->setId(104);
        $vtw104->setCode('KT 15');
        $vtw104->setType('middelhoog gevel(s) in beton')
        $vtw104->setBuildingType('15')
        $vtw104->setBouwjaar('nvt')
        $vtw104->setRooftype('nvt')
            
        $vtw105 = new vtw();
        $vtw105->setId(105);
        $vtw105->setCode('KT 16');
        $vtw105->setType('middelhoog gevel(s) in metaal')
        $vtw105->setBuildingType('16')
        $vtw105->setBouwjaar('nvt')
        $vtw105->setRooftype('nvt')
            
        $vtw106 = new vtw();
        $vtw106->setId(106);
        $vtw106->setCode('KT 17');
        $vtw106->setType('hoog vliesgevel(s)')
        $vtw106->setBuildingType('17')
        $vtw106->setBouwjaar('nvt')
        $vtw106->setRooftype('nvt')
           
        $vtw107 = new vtw();
        $vtw107->setId(107);
        $vtw107->setCode('KT 18');
        $vtw107->setType('hoog gevel(s) in natuursteen')
        $vtw107->setBuildingType('18')
        $vtw107->setBouwjaar('nvt')
        $vtw107->setRooftype('nvt')
         
        $vtw108 = new vtw();
        $vtw108->setId(108);
        $vtw108->setCode('KT 19');
        $vtw108->setType('hoog gevel(s) in beton')
        $vtw108->setBuildingType('19')
        $vtw108->setBouwjaar('nvt')
        $vtw108->setRooftype('nvt')
            
        $vtw109 = new vtw();
        $vtw109->setId(109);
        $vtw109->setCode('KT 20');
        $vtw109->setType('hoog gevel(s) in metaal')
        $vtw109->setBuildingType('20')
        $vtw109->setBouwjaar('nvt')
        $vtw109->setRooftype('nvt')
        
        $vtw110 = new vtw();
        $vtw110->setId(110);
        $vtw110->setCode('KT 21');
        $vtw110->setType('kleinschalige kantoorvilla eigentijds moderne architectuur gevel(s) in metselwerk')
        $vtw110->setBuildingType('21')
        $vtw110->setBouwjaar('nvt')
        $vtw110->setRooftype('nvt')
            
        $vtw111 = new vtw();
        $vtw111->setId(111);
        $vtw111->setCode('KT 22');
        $vtw111->setType('kleinschalige kantoorvilla eigentijds moderne architectuur gevel(s) in isolatiestukwerk')
        $vtw111->setBuildingType('22')
        $vtw111->setBouwjaar('nvt')
        $vtw111->setRooftype('nvt')
           
        $vtw112 = new vtw();
        $vtw112->setId(112);
        $vtw112->setCode('KT 23');
        $vtw112->setType('kleinschalige kantoorvilla eigentijds moderne architectuur in natuursteen')
        $vtw112->setBuildingType('23')
        $vtw112->setBouwjaar('nvt')
        $vtw112->setRooftype('nvt')
            
        $vtw113 = new vtw();
        $vtw113->setId(113);
        $vtw113->setCode('KT 24');
        $vtw113->setType('kleinschalige kantoorvilla eigentijds moderne architectuur in metaal ')
        $vtw113->setBuildingType('24')
        $vtw113->setBouwjaar('nvt')
        $vtw113->setRooftype('nvt')
            
        $vtw114 = new vtw();
        $vtw114->setId(114);
        $vtw114->setCode('KT 25');
        $vtw114->setType('kleinschalige kantoorvilla eigentijds moderne architectuur in beton')
        $vtw114->setBuildingType('25')
        $vtw114->setBouwjaar('nvt')
        $vtw114->setRooftype('nvt')
            
        $vtw115 = new vtw();
        $vtw115->setId(115);
        $vtw115->setCode('KT 26');
        $vtw115->setType('middelhoog eigetijds klassieke architectuur gevel(s) in metselwerk')
        $vtw115->setBuildingType('26')
        $vtw115->setBouwjaar('nvt')
        $vtw115->setRooftype('nvt')
            
        $vtw116 = new vtw();
        $vtw116->setId(116);
        $vtw116->setCode('KT 27');
        $vtw116->setType('laag gevel(s) in metselwerk inclusief parkeergarage')
        $vtw116->setBuildingType('27')
        $vtw116->setBouwjaar('nvt')
        $vtw116->setRooftype('nvt')
           
        $vtw117 = new vtw();
        $vtw117->setId(117);
        $vtw117->setCode('KT 28R');
        $vtw117->setType('Revitalisatie kantoorgebouw middelhoog gevels in sierbeton elementen')
        $vtw117->setBuildingType('28R')
        $vtw117->setBouwjaar('nvt')
        $vtw117->setRooftype('nvt')
         
        $vtw118 = new vtw();
        $vtw118->setId(118);
        $vtw118->setCode('KT 40');
        $vtw118->setType('energieneutraal kantoorgebouw nul op de meter duurzaam gebouw onder moderne architectuur')
        $vtw118->setBuildingType('40')
        $vtw118->setBouwjaar('nvt')
        $vtw118->setRooftype('nvt')
                     
        $vtw120 = new vtw();
        $vtw120->setId(120);
        $vtw120->setCode('BT 1');
        $vtw120->setType('kleinschalig gevel(s) in metselwerk')
        $vtw120->setBuildingType('1')
        $vtw120->setBouwjaar('nvt')
        $vtw120->setRooftype('nvt')
            
        $vtw121 = new vtw();
        $vtw121->setId(121);
        $vtw121->setCode('BT 2');
        $vtw121->setType('kleinschalig gevel(s) in metaal')
        $vtw121->setBuildingType('2')
        $vtw121->setBouwjaar('nvt')
        $vtw121->setRooftype('nvt')
            
        $vtw122 = new vtw();
        $vtw122->setId(122);
        $vtw122->setCode('BT 3');
        $vtw122->setType('kleinschalig gevel(s) in metselwerk/metaal')
        $vtw122->setBuildingType('3')
        $vtw122->setBouwjaar('nvt')
        $vtw122->setRooftype('nvt')
            
        $vtw123 = new vtw();
        $vtw123->setId(123);
        $vtw123->setCode('BT 4');
        $vtw123->setType('middelschalig gevel(s) in metselwerk')
        $vtw123->setBuildingType('4')
        $vtw123->setBouwjaar('nvt')
        $vtw123->setRooftype('nvt')
            
        $vtw124 = new vtw();
        $vtw124->setId(124);
        $vtw124->setCode('BT 5');
        $vtw124->setType('middelschalig gevel(s) in metaal')
        $vtw124->setBuildingType('5')
        $vtw124->setBouwjaar('nvt')
        $vtw124->setRooftype('nvt')
            
        $vtw125 = new vtw();
        $vtw125->setId(125);
        $vtw125->setCode('BT 6');
        $vtw125->setType('middelschalig gevel(s) in metselwerk/metaal')
        $vtw125->setBuildingType('6')
        $vtw125->setBouwjaar('nvt')
        $vtw125->setRooftype('nvt')
            
        $vtw126 = new vtw();
        $vtw126->setId(126);
        $vtw126->setCode('BT 7');
        $vtw126->setType('grootschalig gevel(s) in metselwerk')
        $vtw126->setBuildingType('7')
        $vtw126->setBouwjaar('nvt')
        $vtw126->setRooftype('nvt')
           
        $vtw127 = new vtw();
        $vtw127->setId(127);
        $vtw127->setCode('BT 8');
        $vtw127->setType('grootschalig gevel(s) in metaal')
        $vtw127->setBuildingType('8')
        $vtw127->setBouwjaar('nvt')
        $vtw127->setRooftype('nvt')
        
        $vtw128 = new vtw();
        $vtw128->setId(128);
        $vtw128->setCode('BT 9');
        $vtw128->setType('grootschalig gevel(s) in metselwerk/metaal')
        $vtw128->setBuildingType('9')
        $vtw128->setBouwjaar('nvt')
        $vtw128->setRooftype('nvt')
            
        $vtw129 = new vtw();
        $vtw129->setId(129);
        $vtw129->setCode('BT 10');
        $vtw129->setType('klein- tot grootschailg gevel(s) en dak in metaal')
        $vtw129->setBuildingType('10')
        $vtw129->setBouwjaar('nvt')
        $vtw129->setRooftype('nvt')
       
        $vtw130 = new vtw();
        $vtw130->setId(130);
        $vtw130->setCode('BT 11');
        $vtw130->setType('combinatiegebouw met showroom/serviceruimte kantoor en bedrijfsruimte')
        $vtw130->setBuildingType('11')
        $vtw130->setBouwjaar('nvt')
        $vtw130->setRooftype('nvt')
            
        $vtw131 = new vtw();
        $vtw131->setId(131);
        $vtw131->setCode('BT 12');
        $vtw131->setType('bedrijfsverzamelgebouw')
        $vtw131->setBuildingType('12')
        $vtw131->setBouwjaar('nvt')
        $vtw131->setRooftype('nvt')
            
        $vtw132 = new vtw();
        $vtw132->setId(132);
        $vtw132->setCode('BT 13');
        $vtw132->setType('kleinschalig distrubutiecentrum')
        $vtw132->setBuildingType('13')
        $vtw132->setBouwjaar('nvt')
        $vtw132->setRooftype('nvt')
           
        $vtw133 = new vtw();
        $vtw133->setId(133);
        $vtw133->setCode('BT 14');
        $vtw133->setType('grootschalig distrubutiecentrum')
        $vtw133->setBuildingType('14')
        $vtw133->setBouwjaar('nvt')
        $vtw133->setRooftype('nvt')
            
        $vtw134 = new vtw();
        $vtw134->setId(134);
        $vtw134->setCode('BT 15');
        $vtw134->setType('garagebedrijf met showroom en kantoren')
        $vtw134->setBuildingType('15')
        $vtw134->setBouwjaar('nvt')
        $vtw134->setRooftype('nvt')
            
        $vtw135 = new vtw();
        $vtw135->setId(135);
        $vtw135->setCode('BT 16');
        $vtw135->setType('bedrijfsverzamelgebouw prefab betonbouw')
        $vtw135->setBuildingType('16')
        $vtw135->setBouwjaar('nvt')
        $vtw135->setRooftype('nvt')
            
        $vtw140 = new vtw();
        $vtw140->setId(140);
        $vtw140->setCode('WINT 1');
        $vtw140->setType('individuele winkel / winkel in winkelstraat ouder type')
        $vtw140->setBuildingType('1')
        $vtw140->setBouwjaar('nvt')
        $vtw140->setRooftype('nvt')
            
        $vtw141 = new vtw();
        $vtw141->setId(141);
        $vtw141->setCode('WINT 2');
        $vtw141->setType('individuele winkel / winkel in winkelstraat recenter type')
        $vtw141->setBuildingType('2')
        $vtw141->setBouwjaar('nvt')
        $vtw141->setRooftype('nvt')
            
        $vtw142 = new vtw();
        $vtw142->setId(142);
        $vtw142->setCode('WINT 3');
        $vtw142->setType('winkel in het centrum niet dekt ouder type')
        $vtw142->setBuildingType('3')
        $vtw142->setBouwjaar('nvt')
        $vtw142->setRooftype('nvt')
            
        $vtw143 = new vtw();
        $vtw143->setId(143);
        $vtw143->setCode('WINT 4');
        $vtw143->setType('winkel in het centrum niet dekt recenter type')
        $vtw143->setBuildingType('4')
        $vtw143->setBouwjaar('nvt')
        $vtw143->setRooftype('nvt')
            
        $vtw144 = new vtw();
        $vtw144->setId(144);
        $vtw144->setCode('WINT 5');
        $vtw144->setType('winkel in het centrum overdekt ouder type')
        $vtw144->setBuildingType('5')
        $vtw144->setBouwjaar('nvt')
        $vtw144->setRooftype('nvt')
            
        $vtw145 = new vtw();
        $vtw145->setId(145);
        $vtw145->setCode('WINT 6');
        $vtw145->setType('winkel in het centrum overdekt recenter type')
        $vtw145->setBuildingType('6')
        $vtw145->setBouwjaar('nvt')
        $vtw145->setRooftype('nvt')
            
        $vtw146 = new vtw();
        $vtw146->setId(146);
        $vtw146->setCode('WINT 7');
        $vtw146->setType('kiosk')
        $vtw146->setBuildingType('7')
        $vtw146->setBouwjaar('nvt')
        $vtw146->setRooftype('nvt')
           
        $vtw147 = new vtw();
        $vtw147->setId(147);
        $vtw147->setCode('WINT 8');
        $vtw147->setType('solitaire supermakrt')
        $vtw147->setBuildingType('8')
        $vtw147->setBouwjaar('nvt')
        $vtw147->setRooftype('nvt')
       
        $vtw148 = new vtw();
        $vtw148->setId(148);
        $vtw148->setCode('WINT 9');
        $vtw148->setType('grootschalige detailhandelsunit')
        $vtw148->setBuildingType('9')
        $vtw148->setBouwjaar('nvt')
        $vtw148->setRooftype('nvt')
            
        $vtw149 = new vtw();
        $vtw149->setId(149);
        $vtw149->setCode('WINT 10');
        $vtw149->setType('perifere grootschalige detailhandelsunit')
        $vtw149->setBuildingType('10')
        $vtw149->setBouwjaar('nvt')
        $vtw149->setRooftype('nvt')
       
        $vtw150 = new vtw();
        $vtw150->setId(150);
        $vtw150->setCode('WINT 11');
        $vtw150->setType('bouwmarkt')
        $vtw150->setBuildingType('11')
        $vtw150->setBouwjaar('nvt')
        $vtw150->setRooftype('nvt')
            
        $vtw151 = new vtw();
        $vtw151->setId(151);
        $vtw151->setCode('WINT 23');
        $vtw151->setType('energieneutraal solitaire supermarkt nul op de meter')
        $vtw151->setBuildingType('23')
        $vtw151->setBouwjaar('nvt')
        $vtw151->setRooftype('nvt')
          
        $vtw160 = new vtw();
        $vtw160->setId(160);
        $vtw160->setCode('HT 1R');
        $vtw160->setType('voormalig schoolgebouw')
        $vtw160->setBuildingType('1R')
        $vtw160->setBouwjaar('tussen 1900 en 1930')
        $vtw160->setRooftype('nvt')
            
        $vtw161 = new vtw();
        $vtw161->setId(161);
        $vtw161->setCode('HT 2R');
        $vtw161->setType('voormalig kantoorgebouw')
        $vtw161->setBuildingType('2R')
        $vtw161->setBouwjaar('tussen 1970 en 1990')
        $vtw161->setRooftype('nvt')
            
        $vtw162 = new vtw();
        $vtw162->setId(162);
        $vtw162->setCode('HT 3R');
        $vtw162->setType('voormalig fabrieksgebouw')
        $vtw162->setBuildingType('3R')
        $vtw162->setBouwjaar('tussen 1900 en 1930')
        $vtw162->setRooftype('nvt')
           
        $vtw163 = new vtw();
        $vtw163->setId(163);
        $vtw163->setCode('HT 4R');
        $vtw163->setType('voormalig jongerencentrum')
        $vtw163->setBuildingType('4R')
        $vtw163->setBouwjaar('tussen 1950 en 1970')
        $vtw163->setRooftype('nvt')
            
        $vtw164 = new vtw();
        $vtw164->setId(164);
        $vtw164->setCode('HT 5R');
        $vtw164->setType('voormalig kantoorgebouw')
        $vtw164->setBuildingType('5R')
        $vtw164->setBouwjaar('nvt')
        $vtw164->setRooftype('nvt')   
            
        $vtw170 = new vtw();
        $vtw170->setId(170);
        $vtw170->setCode('OT 1');
        $vtw170->setType('café / restaurant')
        $vtw170->setBuildingType('1')
        $vtw170->setBouwjaar('nvt')
        $vtw170->setRooftype('nvt')
            
        $vtw171 = new vtw();
        $vtw171->setId(171);
        $vtw171->setCode('OT 2');
        $vtw171->setType('hotel kleinschalig')
        $vtw171->setBuildingType('2')
        $vtw171->setBouwjaar('nvt')
        $vtw171->setRooftype('nvt')
            
        $vtw172 = new vtw();
        $vtw172->setId(172);
        $vtw172->setCode('OT 3');
        $vtw172->setType('hotel grootschalig')
        $vtw172->setBuildingType('3')
        $vtw172->setBouwjaar('nvt')
        $vtw172->setRooftype('nvt')
            
        $vtw173 = new vtw();
        $vtw173->setId(173);
        $vtw173->setCode('OT 4');
        $vtw173->setType('bioscoop')
        $vtw173->setBuildingType('4')
        $vtw173->setBouwjaar('nvt')
        $vtw173->setRooftype('nvt')
            
        $vtw174 = new vtw();
        $vtw174->setId(174);
        $vtw174->setCode('OT 5');
        $vtw174->setType('discotheek')
        $vtw174->setBuildingType('5')
        $vtw174->setBouwjaar('nvt')
        $vtw174->setRooftype('nvt')
           
        $vtw175 = new vtw();
        $vtw175->setId(175);
        $vtw175->setCode('OT 6');
        $vtw175->setType('woon-/zorgcomplex')
        $vtw175->setBuildingType('6')
        $vtw175->setBouwjaar('nvt')
        $vtw175->setRooftype('nvt')
            
        $vtw176 = new vtw();
        $vtw176->setId(176);
        $vtw176->setCode('OT 7');
        $vtw176->setType('gemeentehuis')
        $vtw176->setBuildingType('7')
        $vtw176->setBouwjaar('nvt')
        $vtw176->setRooftype('nvt')
           
        $vtw177 = new vtw();
        $vtw177->setId(177);
        $vtw177->setCode('OT 8');
        $vtw177->setType('brandweerkazerne')
        $vtw177->setBuildingType('8')
        $vtw177->setBouwjaar('nvt')
        $vtw177->setRooftype('nvt')
       
        $vtw178 = new vtw();
        $vtw178->setId(178);
        $vtw178->setCode('OT 9');
        $vtw178->setType('theater middelgroot modern')
        $vtw178->setBuildingType('9')
        $vtw178->setBouwjaar('nvt')
        $vtw178->setRooftype('nvt')
            
        $vtw179 = new vtw();
        $vtw179->setId(179);
        $vtw179->setCode('OT 10');
        $vtw179->setType('theater kleinscahig')
        $vtw179->setBuildingType('10')
        $vtw179->setBouwjaar('nvt')
        $vtw179->setRooftype('nvt')
       
        $vtw180 = new vtw();
        $vtw180->setId(180);
        $vtw180->setCode('OT 11');
        $vtw180->setType('kleinschalig woon-/zorgcomplex')
        $vtw180->setBuildingType('11')
        $vtw180->setBouwjaar('nvt')
        $vtw180->setRooftype('nvt')
            
        $vtw181 = new vtw();
        $vtw181->setId(181);
        $vtw181->setCode('OT 12');
        $vtw181->setType('grootschalig woon-/zorgcomplex')
        $vtw181->setBuildingType('12')
        $vtw181->setBouwjaar('nvt')
        $vtw181->setRooftype('nvt')
            
        $vtw190 = new vtw();
        $vtw190->setId(190);
        $vtw190->setCode('AT 1');
        $vtw190->setType('woonboederij')
        $vtw190->setBuildingType('1')
        $vtw190->setBouwjaar('nvt')
        $vtw190->setRooftype('nvt')
            
        $vtw191 = new vtw();
        $vtw191->setId(191);
        $vtw191->setCode('AT 2');
        $vtw191->setType('woonboederij')
        $vtw191->setBuildingType('2')
        $vtw191->setBouwjaar('nvt')
        $vtw191->setRooftype('nvt')
            
        $vtw192 = new vtw();
        $vtw192->setId(192);
        $vtw192->setCode('AT 3');
        $vtw192->setType('vleesvarkensstal')
        $vtw192->setBuildingType('3')
        $vtw192->setBouwjaar('nvt')
        $vtw192->setRooftype('nvt')
            
        $vtw193 = new vtw();
        $vtw193->setId(193);
        $vtw193->setCode('AT 4');
        $vtw193->setType('loodsgebouw')
        $vtw193->setBuildingType('4')
        $vtw193->setBouwjaar('nvt')
        $vtw193->setRooftype('nvt')
            
        $vtw194 = new vtw();
        $vtw194->setId(194);
        $vtw194->setCode('AT 5');
        $vtw194->setType('pluimveestal')
        $vtw194->setBuildingType('5')
        $vtw194->setBouwjaar('nvt')
        $vtw194->setRooftype('nvt')
           
        $vtw195 = new vtw();
        $vtw195->setId(195);
        $vtw195->setCode('AT 6');
        $vtw195->setType('paardenhouderij')
        $vtw195->setBuildingType('6')
        $vtw195->setBouwjaar('nvt')
        $vtw195->setRooftype('nvt')
            
        $vtw196 = new vtw();
        $vtw196->setId(196);
        $vtw196->setCode('AT 7');
        $vtw196->setType('melkveestal')
        $vtw196->setBuildingType('7')
        $vtw196->setBouwjaar('nvt')
        $vtw196->setRooftype('nvt')
            
        $buildingAddress0 = new BuildingAddress();
        $buildingAddress0->setId(0);
        $buildingAddress0->setConstructionYear(1986);
        $buildingAddress0->setRenovationYear(2002);
        $buildingAddress0->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress0->setHouseNumber(10);
        $buildingAddress0->setAddition('X');
        $buildingAddress0->setZipcode('1234AA');
        $buildingAddress0->setCity('Woonplaats A');
        $buildingAddress0->setRentalUnitNumber('VHE0000');
        $buildingAddress0->setDaeb(true);
        $buildingAddress0->setVtw($vtw1);
        $buildingAddress0->setResidentialArea($residentialArea10);
        $buildingAddress0->setBuildingType($buildingType10);
        $buildingAddress0->setLivingType($livingType1);
        $buildingAddress0->setCreationTime();
        $buildingAddress0->setLastChangeTime();

        $buildingAddress1 = new BuildingAddress();
        $buildingAddress1->setId(1);
        $buildingAddress1->setConstructionYear(1954);
        $buildingAddress1->setRenovationYear(1986);
        $buildingAddress1->setStreetName('Straatnaam A');
        $buildingAddress1->setHouseNumber(10);
        $buildingAddress1->setAddition('A');
        $buildingAddress1->setZipcode('1234AA');
        $buildingAddress1->setCity('Woonplaats A');
        $buildingAddress1->setRentalUnitNumber('VHE0000');
        $buildingAddress1->setDaeb(true);
        $buildingAddress1->setVtw($vtw1);
        $buildingAddress1->setResidentialArea($residentialArea1);
        $buildingAddress1->setBuildingType($buildingType1);
        $buildingAddress1->setLivingType($livingType1);
        $buildingAddress1->setCreationTime();
        $buildingAddress1->setLastChangeTime();

        $buildingAddress2 = new BuildingAddress();
        $buildingAddress2->setId(2);
        $buildingAddress2->setConstructionYear(1998);
        $buildingAddress2->setRenovationYear(2021);
        $buildingAddress2->setStreetName('Straatnaam A');
        $buildingAddress2->setHouseNumber(10);
        $buildingAddress2->setAddition('A');
        $buildingAddress2->setZipcode('1234AA');
        $buildingAddress2->setCity('Woonplaats A');
        $buildingAddress2->setRentalUnitNumber('VHE0000');
        $buildingAddress2->setDaeb(false);
        $buildingAddress2->setVtw($vtw1);
        $buildingAddress2->setResidentialArea($residentialArea2);
        $buildingAddress2->setBuildingType($buildingType2);
        $buildingAddress2->setLivingType($livingType1);
        $buildingAddress2->setCreationTime();
        $buildingAddress2->setLastChangeTime();

        $buildingAddress3 = new BuildingAddress();
        $buildingAddress3->setId(3);
        $buildingAddress3->setConstructionYear(1984);
        $buildingAddress3->setRenovationYear(2000);
        $buildingAddress3->setStreetName('Straatnaam A');
        $buildingAddress3->setHouseNumber(10);
        $buildingAddress3->setAddition('A');
        $buildingAddress3->setZipcode('1234AA');
        $buildingAddress3->setCity('Woonplaats A');
        $buildingAddress3->setRentalUnitNumber('VHE0000');
        $buildingAddress3->setDaeb(true);
        $buildingAddress3->setVtw($vtw1);
        $buildingAddress3->setResidentialArea($residentialArea3);
        $buildingAddress3->setBuildingType($buildingType3);
        $buildingAddress3->setLivingType($livingType1);
        $buildingAddress3->setCreationTime();
        $buildingAddress3->setLastChangeTime();

        $buildingAddress4 = new BuildingAddress();
        $buildingAddress4->setId(4);
        $buildingAddress4->setConstructionYear(2010);
        $buildingAddress4->setRenovationYear(2010);
        $buildingAddress4->setStreetName('Straatnaam A');
        $buildingAddress4->setHouseNumber(102);
        $buildingAddress4->setAddition('');
        $buildingAddress4->setZipcode('1234AA');
        $buildingAddress4->setCity('Woonplaats A');
        $buildingAddress4->setRentalUnitNumber('VHE0000');
        $buildingAddress4->setDaeb(true);
        $buildingAddress4->setVtw($vtw1);
        $buildingAddress4->setResidentialArea($residentialArea4);
        $buildingAddress4->setBuildingType($buildingType4);
        $buildingAddress4->setLivingType($livingType1);
        $buildingAddress4->setCreationTime();
        $buildingAddress4->setLastChangeTime();

        $buildingAddress5 = new BuildingAddress();
        $buildingAddress5->setId(5);
        $buildingAddress5->setConstructionYear(1888);
        $buildingAddress5->setRenovationYear(2005);
        $buildingAddress5->setStreetName('Straatnaam A');
        $buildingAddress5->setHouseNumber(10);
        $buildingAddress5->setAddition('A');
        $buildingAddress5->setZipcode('1234AA');
        $buildingAddress5->setCity('Woonplaats A');
        $buildingAddress5->setRentalUnitNumber('VHE0000');
        $buildingAddress5->setDaeb(true);
        $buildingAddress5->setVtw($vtw1);
        $buildingAddress5->setResidentialArea($residentialArea5);
        $buildingAddress5->setBuildingType($buildingType5);
        $buildingAddress5->setLivingType($livingType1);
        $buildingAddress5->setCreationTime();
        $buildingAddress5->setLastChangeTime();

        $buildingAddress6 = new BuildingAddress();
        $buildingAddress6->setId(6);
        $buildingAddress6->setConstructionYear(1908);
        $buildingAddress6->setRenovationYear(200);
        $buildingAddress6->setStreetName('Straatnaam A');
        $buildingAddress6->setHouseNumber(10);
        $buildingAddress6->setAddition('A');
        $buildingAddress6->setZipcode('1234AA');
        $buildingAddress6->setCity('Woonplaats A');
        $buildingAddress6->setRentalUnitNumber('VHE0000');
        $buildingAddress6->setDaeb(true);
        $buildingAddress6->setVtw($vtw1);
        $buildingAddress6->setResidentialArea($residentialArea6);
        $buildingAddress6->setBuildingType($buildingType6);
        $buildingAddress6->setLivingType($livingType1);
        $buildingAddress6->setCreationTime();
        $buildingAddress6->setLastChangeTime();

        $buildingAddress7 = new BuildingAddress();
        $buildingAddress7->setId(7);
        $buildingAddress7->setConstructionYear(2006);
        $buildingAddress7->setRenovationYear(2006);
        $buildingAddress7->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress7->setHouseNumber(10);
        $buildingAddress7->setAddition('A');
        $buildingAddress7->setZipcode('1234AA');
        $buildingAddress7->setCity('Woonplaats A');
        $buildingAddress7->setRentalUnitNumber('VHE0000');
        $buildingAddress7->setDaeb(true);
        $buildingAddress7->setVtw($vtw1);
        $buildingAddress7->setResidentialArea($residentialArea7);
        $buildingAddress7->setBuildingType($buildingType7);
        $buildingAddress7->setLivingType($livingType1);
        $buildingAddress7->setCreationTime();
        $buildingAddress7->setLastChangeTime();

        $buildingAddress8 = new BuildingAddress();
        $buildingAddress8->setId(8);
        $buildingAddress8->setConstructionYear(2026);
        $buildingAddress8->setRenovationYear(2081);
        $buildingAddress8->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress8->setHouseNumber(10);
        $buildingAddress8->setAddition('Bis');
        $buildingAddress8->setZipcode('1234AAB');
        $buildingAddress8->setCity('Woonplaats A');
        $buildingAddress8->setRentalUnitNumber('VHE0000');
        $buildingAddress8->setDaeb(true);
        $buildingAddress8->setVtw($vtw1);
        $buildingAddress8->setResidentialArea($residentialArea8);
        $buildingAddress8->setBuildingType($buildingType8);
        $buildingAddress8->setLivingType($livingType1);
        $buildingAddress8->setCreationTime();
        $buildingAddress8->setLastChangeTime();

        $buildingAddress9 = new BuildingAddress();
        $buildingAddress9->setId(9);
        $buildingAddress9->setConstructionYear(1976);
        $buildingAddress9->setRenovationYear(2001);
        $buildingAddress9->setStreetName('Straatnaam A');
        $buildingAddress9->setHouseNumber(10);
        $buildingAddress9->setAddition('I');
        $buildingAddress9->setZipcode('12334AA');
        $buildingAddress9->setCity('Woonplaats A');
        $buildingAddress9->setRentalUnitNumber('VHE0000');
        $buildingAddress9->setDaeb(true);
        $buildingAddress9->setVtw($vtw1);
        $buildingAddress9->setResidentialArea($residentialArea9);
        $buildingAddress9->setBuildingType($buildingType9);
        $buildingAddress9->setLivingType($livingType1);
        $buildingAddress9->setCreationTime();
        $buildingAddress9->setLastChangeTime();

        $buildingAddress10 = new BuildingAddress();
        $buildingAddress10->setId(10);
        $buildingAddress10->setConstructionYear(1986);
        $buildingAddress10->setRenovationYear(2002);
        $buildingAddress10->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress10->setHouseNumber(10);
        $buildingAddress10->setAddition('X');
        $buildingAddress10->setZipcode('1234AA');
        $buildingAddress10->setCity('Woonplaats A');
        $buildingAddress10->setRentalUnitNumber('VHE0000');
        $buildingAddress10->setDaeb(true);
        $buildingAddress10->setVtw($vtw1);
        $buildingAddress10->setResidentialArea($residentialArea10);
        $buildingAddress10->setBuildingType($buildingType10);
        $buildingAddress10->setLivingType($livingType1);
        $buildingAddress10->setCreationTime();
        $buildingAddress10->setLastChangeTime();

        $buildingAddress11 = new BuildingAddress();
        $buildingAddress11->setId(11);
        $buildingAddress11->setConstructionYear(1954);
        $buildingAddress11->setRenovationYear(1986);
        $buildingAddress11->setStreetName('Straatnaam A');
        $buildingAddress11->setHouseNumber(10);
        $buildingAddress11->setAddition('A');
        $buildingAddress11->setZipcode('1234AA');
        $buildingAddress11->setCity('Woonplaats A');
        $buildingAddress11->setRentalUnitNumber('VHE0000');
        $buildingAddress11->setDaeb(true);
        $buildingAddress11->setVtw($vtw1);
        $buildingAddress11->setResidentialArea($residentialArea1);
        $buildingAddress11->setBuildingType($buildingType1);
        $buildingAddress11->setLivingType($livingType1);
        $buildingAddress11->setCreationTime();
        $buildingAddress11->setLastChangeTime();

        $buildingAddress12 = new BuildingAddress();
        $buildingAddress12->setId(12);
        $buildingAddress12->setConstructionYear(1998);
        $buildingAddress12->setRenovationYear(2021);
        $buildingAddress12->setStreetName('Straatnaam A');
        $buildingAddress12->setHouseNumber(10);
        $buildingAddress12->setAddition('A');
        $buildingAddress12->setZipcode('1234AA');
        $buildingAddress12->setCity('Woonplaats A');
        $buildingAddress12->setRentalUnitNumber('VHE0000');
        $buildingAddress12->setDaeb(true);
        $buildingAddress12->setVtw($vtw1);
        $buildingAddress12->setResidentialArea($residentialArea2);
        $buildingAddress12->setBuildingType($buildingType2);
        $buildingAddress12->setLivingType($livingType1);
        $buildingAddress12->setCreationTime();
        $buildingAddress12->setLastChangeTime();

        $buildingAddress13 = new BuildingAddress();
        $buildingAddress13->setId(13);
        $buildingAddress13->setConstructionYear(1984);
        $buildingAddress13->setRenovationYear(2000);
        $buildingAddress13->setStreetName('Straatnaam A');
        $buildingAddress13->setHouseNumber(10);
        $buildingAddress13->setAddition('A');
        $buildingAddress13->setZipcode('1234AA');
        $buildingAddress13->setCity('Woonplaats A');
        $buildingAddress13->setRentalUnitNumber('VHE0000');
        $buildingAddress13->setDaeb(false);
        $buildingAddress13->setVtw($vtw1);
        $buildingAddress13->setResidentialArea($residentialArea3);
        $buildingAddress13->setBuildingType($buildingType3);
        $buildingAddress13->setLivingType($livingType1);
        $buildingAddress13->setCreationTime();
        $buildingAddress13->setLastChangeTime();


        $buildingAddress14 = new BuildingAddress();
        $buildingAddress14->setId(14);
        $buildingAddress14->setConstructionYear(2010);
        $buildingAddress14->setRenovationYear(2010);
        $buildingAddress14->setStreetName('Straatnaam A');
        $buildingAddress14->setHouseNumber(102);
        $buildingAddress14->setAddition('');
        $buildingAddress14->setZipcode('1234AA');
        $buildingAddress14->setCity('Woonplaats A');
        $buildingAddress14->setRentalUnitNumber('VHE0000');
        $buildingAddress14->setDaeb(true);
        $buildingAddress14->setVtw($vtw1);
        $buildingAddress14->setResidentialArea($residentialArea4);
        $buildingAddress14->setBuildingType($buildingType4);
        $buildingAddress14->setLivingType($livingType1);
        $buildingAddress14->setCreationTime();
        $buildingAddress14->setLastChangeTime();

        $buildingAddress15 = new BuildingAddress();
        $buildingAddress15->setId(15);
        $buildingAddress15->setConstructionYear(1888);
        $buildingAddress15->setRenovationYear(2005);
        $buildingAddress15->setStreetName('Straatnaam A');
        $buildingAddress15->setHouseNumber(10);
        $buildingAddress15->setAddition('A');
        $buildingAddress15->setZipcode('1234AA');
        $buildingAddress15->setCity('Woonplaats A');
        $buildingAddress15->setRentalUnitNumber('VHE0000');
        $buildingAddress15->setDaeb(true);
        $buildingAddress15->setVtw($vtw1);
        $buildingAddress15->setResidentialArea($residentialArea5);
        $buildingAddress15->setBuildingType($buildingType5);
        $buildingAddress15->setLivingType($livingType2);
        $buildingAddress15->setCreationTime();
        $buildingAddress15->setLastChangeTime();

        $buildingAddress16 = new BuildingAddress();
        $buildingAddress16->setId(16);
        $buildingAddress16->setConstructionYear(1908);
        $buildingAddress16->setRenovationYear(200);
        $buildingAddress16->setStreetName('Straatnaam A');
        $buildingAddress16->setHouseNumber(10);
        $buildingAddress16->setAddition('A');
        $buildingAddress16->setZipcode('1234AA');
        $buildingAddress16->setCity('Woonplaats A');
        $buildingAddress16->setRentalUnitNumber('VHE0000');
        $buildingAddress16->setDaeb(true);
        $buildingAddress16->setVtw($vtw1);
        $buildingAddress16->setResidentialArea($residentialArea6);
        $buildingAddress16->setBuildingType($buildingType6);
        $buildingAddress16->setLivingType($livingType2);
        $buildingAddress16->setCreationTime();
        $buildingAddress16->setLastChangeTime();

        $buildingAddress17 = new BuildingAddress();
        $buildingAddress17->setId(17);
        $buildingAddress17->setConstructionYear(2006);
        $buildingAddress17->setRenovationYear(2006);
        $buildingAddress17->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress17->setHouseNumber(10);
        $buildingAddress17->setAddition('A');
        $buildingAddress17->setZipcode('1234AA');
        $buildingAddress17->setCity('Woonplaats A');
        $buildingAddress17->setRentalUnitNumber('VHE0000');
        $buildingAddress17->setDaeb(true);
        $buildingAddress17->setVtw($vtw1);
        $buildingAddress17->setResidentialArea($residentialArea7);
        $buildingAddress17->setBuildingType($buildingType7);
        $buildingAddress17->setLivingType($livingType2);
        $buildingAddress17->setCreationTime();
        $buildingAddress17->setLastChangeTime();

        $buildingAddress18 = new BuildingAddress();
        $buildingAddress18->setId(18);
        $buildingAddress18->setConstructionYear(2026);
        $buildingAddress18->setRenovationYear(2081);
        $buildingAddress18->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress18->setHouseNumber(10);
        $buildingAddress18->setAddition('Bis');
        $buildingAddress18->setZipcode('1234AAB');
        $buildingAddress18->setCity('Woonplaats A');
        $buildingAddress18->setRentalUnitNumber('VHE0000');
        $buildingAddress18->setDaeb(false);
        $buildingAddress18->setVtw($vtw1);
        $buildingAddress18->setResidentialArea($residentialArea8);
        $buildingAddress18->setBuildingType($buildingType8);
        $buildingAddress18->setLivingType($livingType2);
        $buildingAddress18->setCreationTime();
        $buildingAddress18->setLastChangeTime();

        $buildingAddress19 = new BuildingAddress();
        $buildingAddress19->setId(19);
        $buildingAddress19->setConstructionYear(1976);
        $buildingAddress19->setRenovationYear(2001);
        $buildingAddress19->setStreetName('Straatnaam A');
        $buildingAddress19->setHouseNumber(10);
        $buildingAddress19->setAddition('I');
        $buildingAddress19->setZipcode('12334AA');
        $buildingAddress19->setCity('Woonplaats A');
        $buildingAddress19->setRentalUnitNumber('VHE0000');
        $buildingAddress19->setDaeb(true);
        $buildingAddress19->setVtw($vtw1);
        $buildingAddress19->setResidentialArea($residentialArea9);
        $buildingAddress19->setBuildingType($buildingType9);
        $buildingAddress19->setLivingType($livingType2);
        $buildingAddress19->setCreationTime();
        $buildingAddress19->setLastChangeTime();

        $buildingAddress20 = new BuildingAddress();
        $buildingAddress20->setId(20);
        $buildingAddress20->setConstructionYear(1986);
        $buildingAddress20->setRenovationYear(2002);
        $buildingAddress20->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress20->setHouseNumber(10);
        $buildingAddress20->setAddition('X');
        $buildingAddress20->setZipcode('1234AA');
        $buildingAddress20->setCity('Woonplaats A');
        $buildingAddress20->setRentalUnitNumber('VHE0000');
        $buildingAddress20->setDaeb(true);
        $buildingAddress20->setVtw($vtw1);
        $buildingAddress20->setResidentialArea($residentialArea10);
        $buildingAddress20->setBuildingType($buildingType10);
        $buildingAddress20->setLivingType($livingType2);
        $buildingAddress20->setCreationTime();
        $buildingAddress20->setLastChangeTime();

        $buildingAddress21 = new BuildingAddress();
        $buildingAddress21->setId(21);
        $buildingAddress21->setConstructionYear(1954);
        $buildingAddress21->setRenovationYear(1986);
        $buildingAddress21->setStreetName('Straatnaam A');
        $buildingAddress21->setHouseNumber(10);
        $buildingAddress21->setAddition('A');
        $buildingAddress21->setZipcode('1234AA');
        $buildingAddress21->setCity('Woonplaats A');
        $buildingAddress21->setRentalUnitNumber('VHE0000');
        $buildingAddress21->setDaeb(true);
        $buildingAddress21->setVtw($vtw1);
        $buildingAddress21->setResidentialArea($residentialArea1);
        $buildingAddress21->setBuildingType($buildingType1);
        $buildingAddress21->setLivingType($livingType2);
        $buildingAddress21->setCreationTime();
        $buildingAddress21->setLastChangeTime();

        $buildingAddress22 = new BuildingAddress();
        $buildingAddress22->setId(22);
        $buildingAddress22->setConstructionYear(1998);
        $buildingAddress22->setRenovationYear(2021);
        $buildingAddress22->setStreetName('Straatnaam A');
        $buildingAddress22->setHouseNumber(10);
        $buildingAddress22->setAddition('A');
        $buildingAddress22->setZipcode('1234AA');
        $buildingAddress22->setCity('Woonplaats A');
        $buildingAddress22->setRentalUnitNumber('VHE0000');
        $buildingAddress22->setDaeb(true);
        $buildingAddress22->setVtw($vtw1);
        $buildingAddress22->setResidentialArea($residentialArea2);
        $buildingAddress22->setBuildingType($buildingType2);
        $buildingAddress22->setLivingType($livingType2);
        $buildingAddress22->setCreationTime();
        $buildingAddress22->setLastChangeTime();

        $buildingAddress23 = new BuildingAddress();
        $buildingAddress23->setId(23);
        $buildingAddress23->setConstructionYear(1984);
        $buildingAddress23->setRenovationYear(2000);
        $buildingAddress23->setStreetName('Straatnaam A');
        $buildingAddress23->setHouseNumber(10);
        $buildingAddress23->setAddition('A');
        $buildingAddress23->setZipcode('1234AA');
        $buildingAddress23->setCity('Woonplaats A');
        $buildingAddress23->setRentalUnitNumber('VHE0000');
        $buildingAddress23->setDaeb(true);
        $buildingAddress23->setVtw($vtw1);
        $buildingAddress23->setResidentialArea($residentialArea3);
        $buildingAddress23->setBuildingType($buildingType3);
        $buildingAddress23->setLivingType($livingType2);
        $buildingAddress23->setCreationTime();
        $buildingAddress23->setLastChangeTime();

        $buildingAddress24 = new BuildingAddress();
        $buildingAddress24->setId(24);
        $buildingAddress24->setConstructionYear(2010);
        $buildingAddress24->setRenovationYear(2010);
        $buildingAddress24->setStreetName('Straatnaam A');
        $buildingAddress24->setHouseNumber(102);
        $buildingAddress24->setAddition('');
        $buildingAddress24->setZipcode('1234AA');
        $buildingAddress24->setCity('Woonplaats A');
        $buildingAddress24->setRentalUnitNumber('VHE0000');
        $buildingAddress24->setDaeb(true);
        $buildingAddress24->setVtw($vtw1);
        $buildingAddress24->setResidentialArea($residentialArea4);
        $buildingAddress24->setBuildingType($buildingType4);
        $buildingAddress24->setLivingType($livingType2);
        $buildingAddress24->setCreationTime();
        $buildingAddress24->setLastChangeTime();

        $buildingAddress25 = new BuildingAddress();
        $buildingAddress25->setId(25);
        $buildingAddress25->setConstructionYear(1888);
        $buildingAddress25->setRenovationYear(2005);
        $buildingAddress25->setStreetName('Straatnaam A');
        $buildingAddress25->setHouseNumber(10);
        $buildingAddress25->setAddition('A');
        $buildingAddress25->setZipcode('1234AA');
        $buildingAddress25->setCity('Woonplaats A');
        $buildingAddress25->setRentalUnitNumber('VHE0000');
        $buildingAddress25->setDaeb(true);
        $buildingAddress25->setVtw($vtw1);
        $buildingAddress25->setResidentialArea($residentialArea5);
        $buildingAddress25->setBuildingType($buildingType5);
        $buildingAddress25->setLivingType($livingType2);
        $buildingAddress25->setCreationTime();
        $buildingAddress25->setLastChangeTime();

        $buildingAddress26 = new BuildingAddress();
        $buildingAddress26->setId(26);
        $buildingAddress26->setConstructionYear(1908);
        $buildingAddress26->setRenovationYear(200);
        $buildingAddress26->setStreetName('Straatnaam A');
        $buildingAddress26->setHouseNumber(10);
        $buildingAddress26->setAddition('A');
        $buildingAddress26->setZipcode('1234AA');
        $buildingAddress26->setCity('Woonplaats A');
        $buildingAddress26->setRentalUnitNumber('VHE0000');
        $buildingAddress26->setDaeb(true);
        $buildingAddress26->setVtw($vtw1);
        $buildingAddress26->setResidentialArea($residentialArea6);
        $buildingAddress26->setBuildingType($buildingType6);
        $buildingAddress26->setLivingType($livingType2);
        $buildingAddress26->setCreationTime();
        $buildingAddress26->setLastChangeTime();

        $buildingAddress27 = new BuildingAddress();
        $buildingAddress27->setId(27);
        $buildingAddress27->setConstructionYear(2006);
        $buildingAddress27->setRenovationYear(2006);
        $buildingAddress27->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress27->setHouseNumber(10);
        $buildingAddress27->setAddition('A');
        $buildingAddress27->setZipcode('1234AA');
        $buildingAddress27->setCity('Woonplaats A');
        $buildingAddress27->setRentalUnitNumber('VHE0000');
        $buildingAddress27->setDaeb(true);
        $buildingAddress27->setVtw($vtw1);
        $buildingAddress27->setResidentialArea($residentialArea7);
        $buildingAddress27->setBuildingType($buildingType7);
        $buildingAddress27->setLivingType($livingType2);
        $buildingAddress27->setCreationTime();
        $buildingAddress27->setLastChangeTime();

        $buildingAddress28 = new BuildingAddress();
        $buildingAddress28->setId(28);
        $buildingAddress28->setConstructionYear(2026);
        $buildingAddress28->setRenovationYear(2081);
        $buildingAddress28->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress28->setHouseNumber(10);
        $buildingAddress28->setAddition('Bis');
        $buildingAddress28->setZipcode('1234AAB');
        $buildingAddress28->setCity('Woonplaats A');
        $buildingAddress28->setRentalUnitNumber('VHE0000');
        $buildingAddress28->setDaeb(true);
        $buildingAddress28->setVtw($vtw1);
        $buildingAddress28->setResidentialArea($residentialArea8);
        $buildingAddress28->setBuildingType($buildingType8);
        $buildingAddress28->setLivingType($livingType2);
        $buildingAddress28->setCreationTime();
        $buildingAddress28->setLastChangeTime();

        $buildingAddress29 = new BuildingAddress();
        $buildingAddress29->setId(29);
        $buildingAddress29->setConstructionYear(1976);
        $buildingAddress29->setRenovationYear(2001);
        $buildingAddress29->setStreetName('Straatnaam A');
        $buildingAddress29->setHouseNumber(10);
        $buildingAddress29->setAddition('I');
        $buildingAddress29->setZipcode('12334AA');
        $buildingAddress29->setCity('Woonplaats A');
        $buildingAddress29->setRentalUnitNumber('VHE0000');
        $buildingAddress29->setDaeb(true);
        $buildingAddress29->setVtw($vtw1);
        $buildingAddress29->setResidentialArea($residentialArea9);
        $buildingAddress29->setBuildingType($buildingType9);
        $buildingAddress29->setLivingType($livingType2);
        $buildingAddress29->setCreationTime();
        $buildingAddress29->setLastChangeTime();

        $buildingAddress30 = new BuildingAddress();
        $buildingAddress30->setId(1);
        $buildingAddress30->setConstructionYear(1986);
        $buildingAddress30->setRenovationYear(2002);
        $buildingAddress30->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress30->setHouseNumber(10);
        $buildingAddress30->setAddition('X');
        $buildingAddress30->setZipcode('1234AA');
        $buildingAddress30->setCity('Woonplaats A');
        $buildingAddress30->setRentalUnitNumber('VHE0000');
        $buildingAddress30->setDaeb(true);
        $buildingAddress30->setVtw($vtw1);
        $buildingAddress30->setResidentialArea($residentialArea10);
        $buildingAddress30->setBuildingType($buildingType10);
        $buildingAddress30->setLivingType($livingType2);
        $buildingAddress30->setCreationTime();
        $buildingAddress30->setLastChangeTime();

        $buildingAddress31 = new BuildingAddress();
        $buildingAddress31->setId(31);
        $buildingAddress31->setConstructionYear(1954);
        $buildingAddress31->setRenovationYear(1986);
        $buildingAddress31->setStreetName('Straatnaam A');
        $buildingAddress31->setHouseNumber(10);
        $buildingAddress31->setAddition('A');
        $buildingAddress31->setZipcode('1234AA');
        $buildingAddress31->setCity('Woonplaats A');
        $buildingAddress31->setRentalUnitNumber('VHE0000');
        $buildingAddress31->setDaeb(true);
        $buildingAddress31->setVtw($vtw1);
        $buildingAddress31->setResidentialArea($residentialArea1);
        $buildingAddress31->setBuildingType($buildingType1);
        $buildingAddress31->setLivingType($livingType2);
        $buildingAddress31->setCreationTime();
        $buildingAddress31->setLastChangeTime();

        $buildingAddress41 = new BuildingAddress();
        $buildingAddress41->setId(41);
        $buildingAddress41->setConstructionYear(1954);
        $buildingAddress41->setRenovationYear(1986);
        $buildingAddress41->setStreetName('Straatnaam A');
        $buildingAddress41->setHouseNumber(10);
        $buildingAddress41->setAddition('A');
        $buildingAddress41->setZipcode('1234AA');
        $buildingAddress41->setCity('Woonplaats A');
        $buildingAddress41->setRentalUnitNumber('VHE0000');
        $buildingAddress41->setDaeb(true);
        $buildingAddress41->setVtw($vtw1);
        $buildingAddress41->setResidentialArea($residentialArea1);
        $buildingAddress41->setBuildingType($buildingType1);
        $buildingAddress41->setLivingType($livingType2);
        $buildingAddress41->setCreationTime();
        $buildingAddress41->setLastChangeTime();

        $buildingAddress51 = new BuildingAddress();
        $buildingAddress51->setId(51);
        $buildingAddress51->setConstructionYear(1954);
        $buildingAddress51->setRenovationYear(1986);
        $buildingAddress51->setStreetName('Straatnaam A');
        $buildingAddress51->setHouseNumber(10);
        $buildingAddress51->setAddition('A');
        $buildingAddress51->setZipcode('1234AA');
        $buildingAddress51->setCity('Woonplaats A');
        $buildingAddress51->setRentalUnitNumber('VHE0000');
        $buildingAddress51->setDaeb(true);
        $buildingAddress51->setVtw($vtw1);
        $buildingAddress51->setResidentialArea($residentialArea1);
        $buildingAddress51->setBuildingType($buildingType1);
        $buildingAddress51->setLivingType($livingType3);
        $buildingAddress51->setCreationTime();
        $buildingAddress51->setLastChangeTime();

        $buildingAddress61 = new BuildingAddress();
        $buildingAddress61->setId(61);
        $buildingAddress61->setConstructionYear(1954);
        $buildingAddress61->setRenovationYear(1986);
        $buildingAddress61->setStreetName('Straatnaam A');
        $buildingAddress61->setHouseNumber(10);
        $buildingAddress61->setAddition('A');
        $buildingAddress61->setZipcode('1234AA');
        $buildingAddress61->setCity('Woonplaats A');
        $buildingAddress61->setRentalUnitNumber('VHE0000');
        $buildingAddress61->setDaeb(true);
        $buildingAddress61->setVtw($vtw1);
        $buildingAddress61->setResidentialArea($residentialArea1);
        $buildingAddress61->setBuildingType($buildingType1);
        $buildingAddress61->setLivingType($livingType3);
        $buildingAddress61->setCreationTime();
        $buildingAddress61->setLastChangeTime();

        $buildingAddress71 = new BuildingAddress();
        $buildingAddress71->setId(71);
        $buildingAddress71->setConstructionYear(1954);
        $buildingAddress71->setRenovationYear(1986);
        $buildingAddress71->setStreetName('Straatnaam A');
        $buildingAddress71->setHouseNumber(10);
        $buildingAddress71->setAddition('A');
        $buildingAddress71->setZipcode('1234AA');
        $buildingAddress71->setCity('Woonplaats A');
        $buildingAddress71->setRentalUnitNumber('VHE0000');
        $buildingAddress71->setDaeb(true);
        $buildingAddress71->setVtw($vtw1);
        $buildingAddress71->setResidentialArea($residentialArea1);
        $buildingAddress71->setBuildingType($buildingType1);
        $buildingAddress71->setLivingType($livingType3);
        $buildingAddress71->setCreationTime();
        $buildingAddress71->setLastChangeTime();

        $buildingAddress81 = new BuildingAddress();
        $buildingAddress81->setId(81);
        $buildingAddress81->setConstructionYear(1954);
        $buildingAddress81->setRenovationYear(1986);
        $buildingAddress81->setStreetName('Straatnaam A');
        $buildingAddress81->setHouseNumber(10);
        $buildingAddress81->setAddition('A');
        $buildingAddress81->setZipcode('1234AA');
        $buildingAddress81->setCity('Woonplaats A');
        $buildingAddress81->setRentalUnitNumber('VHE0000');
        $buildingAddress81->setDaeb(true);
        $buildingAddress81->setVtw($vtw1);
        $buildingAddress81->setResidentialArea($residentialArea1);
        $buildingAddress81->setBuildingType($buildingType1);
        $buildingAddress81->setLivingType($livingType3);
        $buildingAddress81->setCreationTime();
        $buildingAddress81->setLastChangeTime();

        $buildingAddress91 = new BuildingAddress();
        $buildingAddress91->setId(91);
        $buildingAddress91->setConstructionYear(1954);
        $buildingAddress91->setRenovationYear(1986);
        $buildingAddress91->setStreetName('Straatnaam A');
        $buildingAddress91->setHouseNumber(10);
        $buildingAddress91->setAddition('A');
        $buildingAddress91->setZipcode('1234AA');
        $buildingAddress91->setCity('Woonplaats A');
        $buildingAddress91->setRentalUnitNumber('VHE0000');
        $buildingAddress91->setDaeb(true);
        $buildingAddress91->setVtw($vtw1);
        $buildingAddress91->setResidentialArea($residentialArea1);
        $buildingAddress91->setBuildingType($buildingType1);
        $buildingAddress91->setLivingType($livingType3);
        $buildingAddress91->setCreationTime();
        $buildingAddress91->setLastChangeTime();

        $buildingAddress101 = new BuildingAddress();
        $buildingAddress101->setId(101);
        $buildingAddress101->setConstructionYear(1954);
        $buildingAddress101->setRenovationYear(1986);
        $buildingAddress101->setStreetName('Straatnaam A');
        $buildingAddress101->setHouseNumber(10);
        $buildingAddress101->setAddition('A');
        $buildingAddress101->setZipcode('1234AA');
        $buildingAddress101->setCity('Woonplaats A');
        $buildingAddress101->setRentalUnitNumber('VHE0000');
        $buildingAddress101->setDaeb(true);
        $buildingAddress101->setVtw($vtw1);
        $buildingAddress101->setResidentialArea($residentialArea1);
        $buildingAddress101->setBuildingType($buildingType1);
        $buildingAddress101->setLivingType($livingType3);
        $buildingAddress101->setCreationTime();
        $buildingAddress101->setLastChangeTime();

        $buildingAddress111 = new BuildingAddress();
        $buildingAddress111->setId(111);
        $buildingAddress111->setConstructionYear(1954);
        $buildingAddress111->setRenovationYear(1986);
        $buildingAddress111->setStreetName('Straatnaam A');
        $buildingAddress111->setHouseNumber(10);
        $buildingAddress111->setAddition('A');
        $buildingAddress111->setZipcode('1234AA');
        $buildingAddress111->setCity('Woonplaats A');
        $buildingAddress111->setRentalUnitNumber('VHE0000');
        $buildingAddress111->setDaeb(true);
        $buildingAddress111->setVtw($vtw1);
        $buildingAddress111->setResidentialArea($residentialArea1);
        $buildingAddress111->setBuildingType($buildingType1);
        $buildingAddress111->setLivingType($livingType3);
        $buildingAddress111->setCreationTime();
        $buildingAddress111->setLastChangeTime();

        $buildingAddress121 = new BuildingAddress();
        $buildingAddress121->setId(121);
        $buildingAddress121->setConstructionYear(1954);
        $buildingAddress121->setRenovationYear(1986);
        $buildingAddress121->setStreetName('Straatnaam A');
        $buildingAddress121->setHouseNumber(10);
        $buildingAddress121->setAddition('A');
        $buildingAddress121->setZipcode('1234AA');
        $buildingAddress121->setCity('Woonplaats A');
        $buildingAddress121->setRentalUnitNumber('VHE0000');
        $buildingAddress121->setDaeb(true);
        $buildingAddress121->setVtw($vtw1);
        $buildingAddress121->setResidentialArea($residentialArea1);
        $buildingAddress121->setBuildingType($buildingType1);
        $buildingAddress121->setLivingType($livingType3);
        $buildingAddress121->setCreationTime();
        $buildingAddress121->setLastChangeTime();

        $buildingAddress32 = new BuildingAddress();
        $buildingAddress32->setId(32);
        $buildingAddress32->setConstructionYear(1998);
        $buildingAddress32->setRenovationYear(2021);
        $buildingAddress32->setStreetName('Straatnaam A');
        $buildingAddress32->setHouseNumber(10);
        $buildingAddress32->setAddition('A');
        $buildingAddress32->setZipcode('1234AA');
        $buildingAddress32->setCity('Woonplaats A');
        $buildingAddress32->setRentalUnitNumber('VHE0000');
        $buildingAddress32->setDaeb(true);
        $buildingAddress32->setVtw($vtw1);
        $buildingAddress32->setResidentialArea($residentialArea2);
        $buildingAddress32->setBuildingType($buildingType2);
        $buildingAddress32->setLivingType($livingType3);
        $buildingAddress32->setCreationTime();
        $buildingAddress32->setLastChangeTime();

        $buildingAddress42 = new BuildingAddress();
        $buildingAddress42->setId(42);
        $buildingAddress42->setConstructionYear(1998);
        $buildingAddress42->setRenovationYear(2021);
        $buildingAddress42->setStreetName('Straatnaam A');
        $buildingAddress42->setHouseNumber(10);
        $buildingAddress42->setAddition('A');
        $buildingAddress42->setZipcode('1234AA');
        $buildingAddress42->setCity('Woonplaats A');
        $buildingAddress42->setRentalUnitNumber('VHE0000');
        $buildingAddress42->setDaeb(true);
        $buildingAddress42->setVtw($vtw1);
        $buildingAddress42->setResidentialArea($residentialArea2);
        $buildingAddress42->setBuildingType($buildingType2);
        $buildingAddress42->setLivingType($livingType3);
        $buildingAddress42->setCreationTime();
        $buildingAddress42->setLastChangeTime();

        $buildingAddress52 = new BuildingAddress();
        $buildingAddress52->setId(52);
        $buildingAddress52->setConstructionYear(1998);
        $buildingAddress52->setRenovationYear(2021);
        $buildingAddress52->setStreetName('Straatnaam A');
        $buildingAddress52->setHouseNumber(10);
        $buildingAddress52->setAddition('A');
        $buildingAddress52->setZipcode('1234AA');
        $buildingAddress52->setCity('Woonplaats A');
        $buildingAddress52->setRentalUnitNumber('VHE0000');
        $buildingAddress52->setDaeb(true);
        $buildingAddress52->setVtw($vtw1);
        $buildingAddress52->setResidentialArea($residentialArea2);
        $buildingAddress52->setBuildingType($buildingType2);
        $buildingAddress52->setLivingType($livingType3);
        $buildingAddress52->setCreationTime();
        $buildingAddress52->setLastChangeTime();

        $buildingAddress62 = new BuildingAddress();
        $buildingAddress62->setId(62);
        $buildingAddress62->setConstructionYear(1998);
        $buildingAddress62->setRenovationYear(2021);
        $buildingAddress62->setStreetName('Straatnaam A');
        $buildingAddress62->setHouseNumber(10);
        $buildingAddress62->setAddition('A');
        $buildingAddress62->setZipcode('1234AA');
        $buildingAddress62->setCity('Woonplaats A');
        $buildingAddress62->setRentalUnitNumber('VHE0000');
        $buildingAddress62->setDaeb(true);
        $buildingAddress62->setVtw($vtw1);
        $buildingAddress62->setResidentialArea($residentialArea2);
        $buildingAddress62->setBuildingType($buildingType2);
        $buildingAddress62->setLivingType($livingType3);
        $buildingAddress62->setCreationTime();
        $buildingAddress62->setLastChangeTime();

        $buildingAddress72 = new BuildingAddress();
        $buildingAddress72->setId(72);
        $buildingAddress72->setConstructionYear(1998);
        $buildingAddress72->setRenovationYear(2021);
        $buildingAddress72->setStreetName('Straatnaam A');
        $buildingAddress72->setHouseNumber(10);
        $buildingAddress72->setAddition('A');
        $buildingAddress72->setZipcode('1234AA');
        $buildingAddress72->setCity('Woonplaats A');
        $buildingAddress72->setRentalUnitNumber('VHE0000');
        $buildingAddress72->setDaeb(true);
        $buildingAddress72->setVtw($vtw1);
        $buildingAddress72->setResidentialArea($residentialArea2);
        $buildingAddress72->setBuildingType($buildingType2);
        $buildingAddress72->setLivingType($livingType3);
        $buildingAddress72->setCreationTime();
        $buildingAddress72->setLastChangeTime();

        $buildingAddress82 = new BuildingAddress();
        $buildingAddress82->setId(82);
        $buildingAddress82->setConstructionYear(1998);
        $buildingAddress82->setRenovationYear(2021);
        $buildingAddress82->setStreetName('Straatnaam A');
        $buildingAddress82->setHouseNumber(10);
        $buildingAddress82->setAddition('A');
        $buildingAddress82->setZipcode('1234AA');
        $buildingAddress82->setCity('Woonplaats A');
        $buildingAddress82->setRentalUnitNumber('VHE0000');
        $buildingAddress82->setDaeb(true);
        $buildingAddress82->setVtw($vtw1);
        $buildingAddress82->setResidentialArea($residentialArea2);
        $buildingAddress82->setBuildingType($buildingType2);
        $buildingAddress82->setLivingType($livingType3);
        $buildingAddress82->setCreationTime();
        $buildingAddress82->setLastChangeTime();

        $buildingAddress92 = new BuildingAddress();
        $buildingAddress92->setId(92);
        $buildingAddress92->setConstructionYear(1998);
        $buildingAddress92->setRenovationYear(2021);
        $buildingAddress92->setStreetName('Straatnaam A');
        $buildingAddress92->setHouseNumber(10);
        $buildingAddress92->setAddition('A');
        $buildingAddress92->setZipcode('1234AA');
        $buildingAddress92->setCity('Woonplaats A');
        $buildingAddress92->setRentalUnitNumber('VHE0000');
        $buildingAddress92->setDaeb(true);
        $buildingAddress92->setVtw($vtw1);
        $buildingAddress92->setResidentialArea($residentialArea2);
        $buildingAddress92->setBuildingType($buildingType2);
        $buildingAddress92->setLivingType($livingType3);
        $buildingAddress92->setCreationTime();
        $buildingAddress92->setLastChangeTime();

        $buildingAddress102 = new BuildingAddress();
        $buildingAddress102->setId(102);
        $buildingAddress102->setConstructionYear(1998);
        $buildingAddress102->setRenovationYear(2021);
        $buildingAddress102->setStreetName('Straatnaam A');
        $buildingAddress102->setHouseNumber(10);
        $buildingAddress102->setAddition('A');
        $buildingAddress102->setZipcode('1234AA');
        $buildingAddress102->setCity('Woonplaats A');
        $buildingAddress102->setRentalUnitNumber('VHE0000');
        $buildingAddress102->setDaeb(true);
        $buildingAddress102->setVtw($vtw1);
        $buildingAddress102->setResidentialArea($residentialArea2);
        $buildingAddress102->setBuildingType($buildingType2);
        $buildingAddress102->setLivingType($livingType3);
        $buildingAddress102->setCreationTime();
        $buildingAddress102->setLastChangeTime();

        $buildingAddress112 = new BuildingAddress();
        $buildingAddress112->setId(112);
        $buildingAddress112->setConstructionYear(1998);
        $buildingAddress112->setRenovationYear(2021);
        $buildingAddress112->setStreetName('Straatnaam A');
        $buildingAddress112->setHouseNumber(10);
        $buildingAddress112->setAddition('A');
        $buildingAddress112->setZipcode('1234AA');
        $buildingAddress112->setCity('Woonplaats A');
        $buildingAddress112->setRentalUnitNumber('VHE0000');
        $buildingAddress112->setDaeb(true);
        $buildingAddress112->setVtw($vtw1);
        $buildingAddress112->setResidentialArea($residentialArea2);
        $buildingAddress112->setBuildingType($buildingType2);
        $buildingAddress112->setLivingType($livingType3);
        $buildingAddress112->setCreationTime();
        $buildingAddress112->setLastChangeTime();

        $buildingAddress122 = new BuildingAddress();
        $buildingAddress122->setId(122);
        $buildingAddress122->setConstructionYear(1998);
        $buildingAddress122->setRenovationYear(2021);
        $buildingAddress122->setStreetName('Straatnaam A');
        $buildingAddress122->setHouseNumber(10);
        $buildingAddress122->setAddition('A');
        $buildingAddress122->setZipcode('1234AA');
        $buildingAddress122->setCity('Woonplaats A');
        $buildingAddress122->setRentalUnitNumber('VHE0000');
        $buildingAddress122->setDaeb(true);
        $buildingAddress122->setVtw($vtw1);
        $buildingAddress122->setResidentialArea($residentialArea2);
        $buildingAddress122->setBuildingType($buildingType2);
        $buildingAddress122->setLivingType($livingType3);
        $buildingAddress122->setCreationTime();
        $buildingAddress122->setLastChangeTime();

        $buildingAddress33 = new BuildingAddress();
        $buildingAddress33->setId(33);
        $buildingAddress33->setConstructionYear(1984);
        $buildingAddress33->setRenovationYear(2000);
        $buildingAddress33->setStreetName('Straatnaam A');
        $buildingAddress33->setHouseNumber(10);
        $buildingAddress33->setAddition('A');
        $buildingAddress33->setZipcode('1234AA');
        $buildingAddress33->setCity('Woonplaats A');
        $buildingAddress33->setRentalUnitNumber('VHE0000');
        $buildingAddress33->setDaeb(true);
        $buildingAddress33->setVtw($vtw1);
        $buildingAddress33->setResidentialArea($residentialArea3);
        $buildingAddress33->setBuildingType($buildingType3);
        $buildingAddress33->setLivingType($livingType3);
        $buildingAddress33->setCreationTime();
        $buildingAddress33->setLastChangeTime();

        $buildingAddress43 = new BuildingAddress();
        $buildingAddress43->setId(43);
        $buildingAddress43->setConstructionYear(1984);
        $buildingAddress43->setRenovationYear(2000);
        $buildingAddress43->setStreetName('Straatnaam A');
        $buildingAddress43->setHouseNumber(10);
        $buildingAddress43->setAddition('A');
        $buildingAddress43->setZipcode('1234AA');
        $buildingAddress43->setCity('Woonplaats A');
        $buildingAddress43->setRentalUnitNumber('VHE0000');
        $buildingAddress43->setDaeb(true);
        $buildingAddress43->setVtw($vtw1);
        $buildingAddress43->setResidentialArea($residentialArea3);
        $buildingAddress43->setBuildingType($buildingType3);
        $buildingAddress43->setLivingType($livingType3);
        $buildingAddress43->setCreationTime();
        $buildingAddress43->setLastChangeTime();

        $buildingAddress53 = new BuildingAddress();
        $buildingAddress53->setId(53);
        $buildingAddress53->setConstructionYear(1984);
        $buildingAddress53->setRenovationYear(2000);
        $buildingAddress53->setStreetName('Straatnaam A');
        $buildingAddress53->setHouseNumber(10);
        $buildingAddress53->setAddition('A');
        $buildingAddress53->setZipcode('1234AA');
        $buildingAddress53->setCity('Woonplaats A');
        $buildingAddress53->setRentalUnitNumber('VHE0000');
        $buildingAddress53->setDaeb(true);
        $buildingAddress53->setVtw($vtw1);
        $buildingAddress53->setResidentialArea($residentialArea3);
        $buildingAddress53->setBuildingType($buildingType3);
        $buildingAddress53->setLivingType($livingType3);
        $buildingAddress53->setCreationTime();
        $buildingAddress53->setLastChangeTime();

        $buildingAddress63 = new BuildingAddress();
        $buildingAddress63->setId(63);
        $buildingAddress63->setConstructionYear(1984);
        $buildingAddress63->setRenovationYear(2000);
        $buildingAddress63->setStreetName('Straatnaam A');
        $buildingAddress63->setHouseNumber(10);
        $buildingAddress63->setAddition('A');
        $buildingAddress63->setZipcode('1234AA');
        $buildingAddress63->setCity('Woonplaats A');
        $buildingAddress63->setRentalUnitNumber('VHE0000');
        $buildingAddress63->setDaeb(true);
        $buildingAddress63->setVtw($vtw1);
        $buildingAddress63->setResidentialArea($residentialArea3);
        $buildingAddress63->setBuildingType($buildingType3);
        $buildingAddress63->setLivingType($livingType3);
        $buildingAddress63->setCreationTime();
        $buildingAddress63->setLastChangeTime();

        $buildingAddress73 = new BuildingAddress();
        $buildingAddress73->setId(73);
        $buildingAddress73->setConstructionYear(1984);
        $buildingAddress73->setRenovationYear(2000);
        $buildingAddress73->setStreetName('Straatnaam A');
        $buildingAddress73->setHouseNumber(10);
        $buildingAddress73->setAddition('A');
        $buildingAddress73->setZipcode('1234AA');
        $buildingAddress73->setCity('Woonplaats A');
        $buildingAddress73->setRentalUnitNumber('VHE0000');
        $buildingAddress73->setDaeb(true);
        $buildingAddress73->setVtw($vtw1);
        $buildingAddress73->setResidentialArea($residentialArea3);
        $buildingAddress73->setBuildingType($buildingType3);
        $buildingAddress73->setLivingType($livingType3);
        $buildingAddress73->setCreationTime();
        $buildingAddress73->setLastChangeTime();

        $buildingAddress83 = new BuildingAddress();
        $buildingAddress83->setId(83);
        $buildingAddress83->setConstructionYear(1984);
        $buildingAddress83->setRenovationYear(2000);
        $buildingAddress83->setStreetName('Straatnaam A');
        $buildingAddress83->setHouseNumber(10);
        $buildingAddress83->setAddition('A');
        $buildingAddress83->setZipcode('1234AA');
        $buildingAddress83->setCity('Woonplaats A');
        $buildingAddress83->setRentalUnitNumber('VHE0000');
        $buildingAddress83->setDaeb(true);
        $buildingAddress83->setVtw($vtw1);
        $buildingAddress83->setResidentialArea($residentialArea3);
        $buildingAddress83->setBuildingType($buildingType3);
        $buildingAddress83->setLivingType($livingType3);
        $buildingAddress83->setCreationTime();
        $buildingAddress83->setLastChangeTime();

        $buildingAddress93 = new BuildingAddress();
        $buildingAddress93->setId(93);
        $buildingAddress93->setConstructionYear(1984);
        $buildingAddress93->setRenovationYear(2000);
        $buildingAddress93->setStreetName('Straatnaam A');
        $buildingAddress93->setHouseNumber(10);
        $buildingAddress93->setAddition('A');
        $buildingAddress93->setZipcode('1234AA');
        $buildingAddress93->setCity('Woonplaats A');
        $buildingAddress93->setRentalUnitNumber('VHE0000');
        $buildingAddress93->setDaeb(true);
        $buildingAddress93->setVtw($vtw1);
        $buildingAddress93->setResidentialArea($residentialArea3);
        $buildingAddress93->setBuildingType($buildingType3);
        $buildingAddress93->setLivingType($livingType3);
        $buildingAddress93->setCreationTime();
        $buildingAddress93->setLastChangeTime();

        $buildingAddress103 = new BuildingAddress();
        $buildingAddress103->setId(103);
        $buildingAddress103->setConstructionYear(1984);
        $buildingAddress103->setRenovationYear(2000);
        $buildingAddress103->setStreetName('Straatnaam A');
        $buildingAddress103->setHouseNumber(10);
        $buildingAddress103->setAddition('A');
        $buildingAddress103->setZipcode('1234AA');
        $buildingAddress103->setCity('Woonplaats A');
        $buildingAddress103->setRentalUnitNumber('VHE0000');
        $buildingAddress103->setDaeb(true);
        $buildingAddress103->setVtw($vtw1);
        $buildingAddress103->setResidentialArea($residentialArea3);
        $buildingAddress103->setBuildingType($buildingType3);
        $buildingAddress103->setLivingType($livingType3);
        $buildingAddress103->setCreationTime();
        $buildingAddress103->setLastChangeTime();

        $buildingAddress113 = new BuildingAddress();
        $buildingAddress113->setId(113);
        $buildingAddress113->setConstructionYear(1984);
        $buildingAddress113->setRenovationYear(2000);
        $buildingAddress113->setStreetName('Straatnaam A');
        $buildingAddress113->setHouseNumber(10);
        $buildingAddress113->setAddition('A');
        $buildingAddress113->setZipcode('1234AA');
        $buildingAddress113->setCity('Woonplaats A');
        $buildingAddress113->setRentalUnitNumber('VHE0000');
        $buildingAddress113->setDaeb(true);
        $buildingAddress113->setVtw($vtw1);
        $buildingAddress113->setResidentialArea($residentialArea3);
        $buildingAddress113->setBuildingType($buildingType3);
        $buildingAddress113->setLivingType($livingType3);
        $buildingAddress113->setCreationTime();
        $buildingAddress113->setLastChangeTime();

        $buildingAddress123 = new BuildingAddress();
        $buildingAddress123->setId(123);
        $buildingAddress123->setConstructionYear(1984);
        $buildingAddress123->setRenovationYear(2000);
        $buildingAddress123->setStreetName('Straatnaam A');
        $buildingAddress123->setHouseNumber(10);
        $buildingAddress123->setAddition('A');
        $buildingAddress123->setZipcode('1234AA');
        $buildingAddress123->setCity('Woonplaats A');
        $buildingAddress123->setRentalUnitNumber('VHE0000');
        $buildingAddress123->setDaeb(true);
        $buildingAddress123->setVtw($vtw1);
        $buildingAddress123->setResidentialArea($residentialArea3);
        $buildingAddress123->setBuildingType($buildingType3);
        $buildingAddress123->setLivingType($livingType3);
        $buildingAddress123->setCreationTime();
        $buildingAddress123->setLastChangeTime();

        $buildingAddress34 = new BuildingAddress();
        $buildingAddress34->setId(34);
        $buildingAddress34->setConstructionYear(2010);
        $buildingAddress34->setRenovationYear(2010);
        $buildingAddress34->setStreetName('Straatnaam A');
        $buildingAddress34->setHouseNumber(102);
        $buildingAddress34->setAddition('');
        $buildingAddress34->setZipcode('1234AA');
        $buildingAddress34->setCity('Woonplaats A');
        $buildingAddress34->setRentalUnitNumber('VHE0000');
        $buildingAddress34->setDaeb(true);
        $buildingAddress34->setVtw($vtw1);
        $buildingAddress34->setResidentialArea($residentialArea4);
        $buildingAddress34->setBuildingType($buildingType4);
        $buildingAddress34->setLivingType($livingType3);
        $buildingAddress34->setCreationTime();
        $buildingAddress34->setLastChangeTime();

        $buildingAddress44 = new BuildingAddress();
        $buildingAddress44->setId(44);
        $buildingAddress44->setConstructionYear(2010);
        $buildingAddress44->setRenovationYear(2010);
        $buildingAddress44->setStreetName('Straatnaam A');
        $buildingAddress44->setHouseNumber(102);
        $buildingAddress44->setAddition('');
        $buildingAddress44->setZipcode('1234AA');
        $buildingAddress44->setCity('Woonplaats A');
        $buildingAddress44->setRentalUnitNumber('VHE0000');
        $buildingAddress44->setDaeb(true);
        $buildingAddress44->setVtw($vtw1);
        $buildingAddress44->setResidentialArea($residentialArea4);
        $buildingAddress44->setBuildingType($buildingType4);
        $buildingAddress44->setLivingType($livingType3);
        $buildingAddress44->setCreationTime();
        $buildingAddress44->setLastChangeTime();

        $buildingAddress54 = new BuildingAddress();
        $buildingAddress54->setId(54);
        $buildingAddress54->setConstructionYear(2010);
        $buildingAddress54->setRenovationYear(2010);
        $buildingAddress54->setStreetName('Straatnaam A');
        $buildingAddress54->setHouseNumber(102);
        $buildingAddress54->setAddition('');
        $buildingAddress54->setZipcode('1234AA');
        $buildingAddress54->setCity('Woonplaats A');
        $buildingAddress54->setRentalUnitNumber('VHE0000');
        $buildingAddress54->setDaeb(true);
        $buildingAddress54->setVtw($vtw1);
        $buildingAddress54->setResidentialArea($residentialArea4);
        $buildingAddress54->setBuildingType($buildingType4);
        $buildingAddress54->setLivingType($livingType3);
        $buildingAddress54->setCreationTime();
        $buildingAddress54->setLastChangeTime();

        $buildingAddress64 = new BuildingAddress();
        $buildingAddress64->setId(64);
        $buildingAddress64->setConstructionYear(2010);
        $buildingAddress64->setRenovationYear(2010);
        $buildingAddress64->setStreetName('Straatnaam A');
        $buildingAddress64->setHouseNumber(102);
        $buildingAddress64->setAddition('');
        $buildingAddress64->setZipcode('1234AA');
        $buildingAddress64->setCity('Woonplaats A');
        $buildingAddress64->setRentalUnitNumber('VHE0000');
        $buildingAddress64->setDaeb(true);
        $buildingAddress64->setVtw($vtw1);
        $buildingAddress64->setResidentialArea($residentialArea4);
        $buildingAddress64->setBuildingType($buildingType4);
        $buildingAddress64->setLivingType($livingType3);
        $buildingAddress64->setCreationTime();
        $buildingAddress64->setLastChangeTime();

        $buildingAddress74 = new BuildingAddress();
        $buildingAddress74->setId(74);
        $buildingAddress74->setConstructionYear(2010);
        $buildingAddress74->setRenovationYear(2010);
        $buildingAddress74->setStreetName('Straatnaam A');
        $buildingAddress74->setHouseNumber(102);
        $buildingAddress74->setAddition('');
        $buildingAddress74->setZipcode('1234AA');
        $buildingAddress74->setCity('Woonplaats A');
        $buildingAddress74->setRentalUnitNumber('VHE0000');
        $buildingAddress74->setDaeb(false);
        $buildingAddress74->setVtw($vtw1);
        $buildingAddress74->setResidentialArea($residentialArea4);
        $buildingAddress74->setBuildingType($buildingType4);
        $buildingAddress74->setLivingType($livingType3);
        $buildingAddress74->setCreationTime();
        $buildingAddress74->setLastChangeTime();

        $buildingAddress84 = new BuildingAddress();
        $buildingAddress84->setId(84);
        $buildingAddress84->setConstructionYear(2010);
        $buildingAddress84->setRenovationYear(2010);
        $buildingAddress84->setStreetName('Straatnaam A');
        $buildingAddress84->setHouseNumber(102);
        $buildingAddress84->setAddition('');
        $buildingAddress84->setZipcode('1234AA');
        $buildingAddress84->setCity('Woonplaats A');
        $buildingAddress84->setRentalUnitNumber('VHE0000');
        $buildingAddress84->setDaeb(false);
        $buildingAddress84->setVtw($vtw1);
        $buildingAddress84->setResidentialArea($residentialArea4);
        $buildingAddress84->setBuildingType($buildingType4);
        $buildingAddress84->setLivingType($livingType3);
        $buildingAddress84->setCreationTime();
        $buildingAddress84->setLastChangeTime();

        $buildingAddress94 = new BuildingAddress();
        $buildingAddress94->setId(94);
        $buildingAddress94->setConstructionYear(2010);
        $buildingAddress94->setRenovationYear(2010);
        $buildingAddress94->setStreetName('Straatnaam A');
        $buildingAddress94->setHouseNumber(102);
        $buildingAddress94->setAddition('');
        $buildingAddress94->setZipcode('1234AA');
        $buildingAddress94->setCity('Woonplaats A');
        $buildingAddress94->setRentalUnitNumber('VHE0000');
        $buildingAddress94->setDaeb(true);
        $buildingAddress94->setVtw($vtw1);
        $buildingAddress94->setResidentialArea($residentialArea4);
        $buildingAddress94->setBuildingType($buildingType4);
        $buildingAddress94->setLivingType($livingType3);
        $buildingAddress94->setCreationTime();
        $buildingAddress94->setLastChangeTime();

        $buildingAddress104 = new BuildingAddress();
        $buildingAddress104->setId(104);
        $buildingAddress104->setConstructionYear(2010);
        $buildingAddress104->setRenovationYear(2010);
        $buildingAddress104->setStreetName('Straatnaam A');
        $buildingAddress104->setHouseNumber(102);
        $buildingAddress104->setAddition('');
        $buildingAddress104->setZipcode('1234AA');
        $buildingAddress104->setCity('Woonplaats A');
        $buildingAddress104->setRentalUnitNumber('VHE0000');
        $buildingAddress104->setDaeb(true);
        $buildingAddress104->setVtw($vtw1);
        $buildingAddress104->setResidentialArea($residentialArea4);
        $buildingAddress104->setBuildingType($buildingType4);
        $buildingAddress104->setLivingType($livingType3);
        $buildingAddress104->setCreationTime();
        $buildingAddress104->setLastChangeTime();

        $buildingAddress114 = new BuildingAddress();
        $buildingAddress114->setId(114);
        $buildingAddress114->setConstructionYear(2010);
        $buildingAddress114->setRenovationYear(2010);
        $buildingAddress114->setStreetName('Straatnaam A');
        $buildingAddress114->setHouseNumber(102);
        $buildingAddress114->setAddition('');
        $buildingAddress114->setZipcode('1234AA');
        $buildingAddress114->setCity('Woonplaats A');
        $buildingAddress114->setRentalUnitNumber('VHE0000');
        $buildingAddress114->setDaeb(true);
        $buildingAddress114->setVtw($vtw1);
        $buildingAddress114->setResidentialArea($residentialArea4);
        $buildingAddress114->setBuildingType($buildingType4);
        $buildingAddress114->setLivingType($livingType3);
        $buildingAddress114->setCreationTime();
        $buildingAddress114->setLastChangeTime();

        $buildingAddress124 = new BuildingAddress();
        $buildingAddress124->setId(124);
        $buildingAddress124->setConstructionYear(2010);
        $buildingAddress124->setRenovationYear(2010);
        $buildingAddress124->setStreetName('Straatnaam A');
        $buildingAddress124->setHouseNumber(102);
        $buildingAddress124->setAddition('');
        $buildingAddress124->setZipcode('1234AA');
        $buildingAddress124->setCity('Woonplaats A');
        $buildingAddress124->setRentalUnitNumber('VHE0000');
        $buildingAddress124->setDaeb(true);
        $buildingAddress124->setVtw($vtw1);
        $buildingAddress124->setResidentialArea($residentialArea4);
        $buildingAddress124->setBuildingType($buildingType4);
        $buildingAddress124->setLivingType($livingType3);
        $buildingAddress124->setCreationTime();
        $buildingAddress124->setLastChangeTime();

        $buildingAddress35 = new BuildingAddress();
        $buildingAddress35->setId(35);
        $buildingAddress35->setConstructionYear(1888);
        $buildingAddress35->setRenovationYear(2005);
        $buildingAddress35->setStreetName('Straatnaam A');
        $buildingAddress35->setHouseNumber(10);
        $buildingAddress35->setAddition('A');
        $buildingAddress35->setZipcode('1234AA');
        $buildingAddress35->setCity('Woonplaats A');
        $buildingAddress35->setRentalUnitNumber('VHE0000');
        $buildingAddress35->setDaeb(true);
        $buildingAddress35->setVtw($vtw1);
        $buildingAddress35->setResidentialArea($residentialArea5);
        $buildingAddress35->setBuildingType($buildingType5);
        $buildingAddress35->setLivingType($livingType3);
        $buildingAddress35->setCreationTime();
        $buildingAddress35->setLastChangeTime();

        $buildingAddress45 = new BuildingAddress();
        $buildingAddress45->setId(45);
        $buildingAddress45->setConstructionYear(1888);
        $buildingAddress45->setRenovationYear(2005);
        $buildingAddress45->setStreetName('Straatnaam A');
        $buildingAddress45->setHouseNumber(10);
        $buildingAddress45->setAddition('A');
        $buildingAddress45->setZipcode('1234AA');
        $buildingAddress45->setCity('Woonplaats A');
        $buildingAddress45->setRentalUnitNumber('VHE0000');
        $buildingAddress45->setDaeb(true);
        $buildingAddress45->setVtw($vtw1);
        $buildingAddress45->setResidentialArea($residentialArea5);
        $buildingAddress45->setBuildingType($buildingType5);
        $buildingAddress45->setLivingType($livingType3);
        $buildingAddress45->setCreationTime();
        $buildingAddress45->setLastChangeTime();

        $buildingAddress55 = new BuildingAddress();
        $buildingAddress55->setId(55);
        $buildingAddress55->setConstructionYear(1888);
        $buildingAddress55->setRenovationYear(2005);
        $buildingAddress55->setStreetName('Straatnaam A');
        $buildingAddress55->setHouseNumber(10);
        $buildingAddress55->setAddition('A');
        $buildingAddress55->setZipcode('1234AA');
        $buildingAddress55->setCity('Woonplaats A');
        $buildingAddress55->setRentalUnitNumber('VHE0000');
        $buildingAddress55->setDaeb(true);
        $buildingAddress55->setVtw($vtw1);
        $buildingAddress55->setResidentialArea($residentialArea5);
        $buildingAddress55->setBuildingType($buildingType5);
        $buildingAddress55->setLivingType($livingType3);
        $buildingAddress55->setCreationTime();
        $buildingAddress55->setLastChangeTime();

        $buildingAddress65 = new BuildingAddress();
        $buildingAddress65->setId(65);
        $buildingAddress65->setConstructionYear(1888);
        $buildingAddress65->setRenovationYear(2005);
        $buildingAddress65->setStreetName('Straatnaam A');
        $buildingAddress65->setHouseNumber(10);
        $buildingAddress65->setAddition('A');
        $buildingAddress65->setZipcode('1234AA');
        $buildingAddress65->setCity('Woonplaats A');
        $buildingAddress65->setRentalUnitNumber('VHE0000');
        $buildingAddress65->setDaeb(true);
        $buildingAddress65->setVtw($vtw1);
        $buildingAddress65->setResidentialArea($residentialArea5);
        $buildingAddress65->setBuildingType($buildingType5);
        $buildingAddress65->setLivingType($livingType3);
        $buildingAddress65->setCreationTime();
        $buildingAddress65->setLastChangeTime();

        $buildingAddress75 = new BuildingAddress();
        $buildingAddress75->setId(75);
        $buildingAddress75->setConstructionYear(1888);
        $buildingAddress75->setRenovationYear(2005);
        $buildingAddress75->setStreetName('Straatnaam A');
        $buildingAddress75->setHouseNumber(10);
        $buildingAddress75->setAddition('A');
        $buildingAddress75->setZipcode('1234AA');
        $buildingAddress75->setCity('Woonplaats A');
        $buildingAddress75->setRentalUnitNumber('VHE0000');
        $buildingAddress75->setDaeb(true);
        $buildingAddress75->setVtw($vtw1);
        $buildingAddress75->setResidentialArea($residentialArea5);
        $buildingAddress75->setBuildingType($buildingType5);
        $buildingAddress75->setLivingType($livingType3);
        $buildingAddress75->setCreationTime();
        $buildingAddress75->setLastChangeTime();

        $buildingAddress85 = new BuildingAddress();
        $buildingAddress85->setId(85);
        $buildingAddress85->setConstructionYear(1888);
        $buildingAddress85->setRenovationYear(2005);
        $buildingAddress85->setStreetName('Straatnaam A');
        $buildingAddress85->setHouseNumber(10);
        $buildingAddress85->setAddition('A');
        $buildingAddress85->setZipcode('1234AA');
        $buildingAddress85->setCity('Woonplaats A');
        $buildingAddress85->setRentalUnitNumber('VHE0000');
        $buildingAddress85->setDaeb(true);
        $buildingAddress85->setVtw($vtw1);
        $buildingAddress85->setResidentialArea($residentialArea5);
        $buildingAddress85->setBuildingType($buildingType5);
        $buildingAddress85->setLivingType($livingType3);
        $buildingAddress85->setCreationTime();
        $buildingAddress85->setLastChangeTime();

        $buildingAddress95 = new BuildingAddress();
        $buildingAddress95->setId(95);
        $buildingAddress95->setConstructionYear(1888);
        $buildingAddress95->setRenovationYear(2005);
        $buildingAddress95->setStreetName('Straatnaam A');
        $buildingAddress95->setHouseNumber(10);
        $buildingAddress95->setAddition('A');
        $buildingAddress95->setZipcode('1234AA');
        $buildingAddress95->setCity('Woonplaats A');
        $buildingAddress95->setRentalUnitNumber('VHE0000');
        $buildingAddress95->setDaeb(true);
        $buildingAddress95->setVtw($vtw1);
        $buildingAddress95->setResidentialArea($residentialArea5);
        $buildingAddress95->setBuildingType($buildingType5);
        $buildingAddress95->setLivingType($livingType3);
        $buildingAddress95->setCreationTime();
        $buildingAddress95->setLastChangeTime();

        $buildingAddress105 = new BuildingAddress();
        $buildingAddress105->setId(105);
        $buildingAddress105->setConstructionYear(1888);
        $buildingAddress105->setRenovationYear(2005);
        $buildingAddress105->setStreetName('Straatnaam A');
        $buildingAddress105->setHouseNumber(10);
        $buildingAddress105->setAddition('A');
        $buildingAddress105->setZipcode('1234AA');
        $buildingAddress105->setCity('Woonplaats A');
        $buildingAddress105->setRentalUnitNumber('VHE0000');
        $buildingAddress105->setDaeb(false);
        $buildingAddress105->setVtw($vtw1);
        $buildingAddress105->setResidentialArea($residentialArea5);
        $buildingAddress105->setBuildingType($buildingType5);
        $buildingAddress105->setLivingType($livingType3);
        $buildingAddress105->setCreationTime();
        $buildingAddress105->setLastChangeTime();

        $buildingAddress115 = new BuildingAddress();
        $buildingAddress115->setId(115);
        $buildingAddress115->setConstructionYear(1888);
        $buildingAddress115->setRenovationYear(2005);
        $buildingAddress115->setStreetName('Straatnaam A');
        $buildingAddress115->setHouseNumber(10);
        $buildingAddress115->setAddition('A');
        $buildingAddress115->setZipcode('1234AA');
        $buildingAddress115->setCity('Woonplaats A');
        $buildingAddress115->setRentalUnitNumber('VHE0000');
        $buildingAddress115->setDaeb(true);
        $buildingAddress115->setVtw($vtw1);
        $buildingAddress115->setResidentialArea($residentialArea5);
        $buildingAddress115->setBuildingType($buildingType5);
        $buildingAddress115->setLivingType($livingType3);
        $buildingAddress115->setCreationTime();
        $buildingAddress115->setLastChangeTime();

        $buildingAddress125 = new BuildingAddress();
        $buildingAddress125->setId(125);
        $buildingAddress125->setConstructionYear(1888);
        $buildingAddress125->setRenovationYear(2005);
        $buildingAddress125->setStreetName('Straatnaam A');
        $buildingAddress125->setHouseNumber(10);
        $buildingAddress125->setAddition('A');
        $buildingAddress125->setZipcode('1234AA');
        $buildingAddress125->setCity('Woonplaats A');
        $buildingAddress125->setRentalUnitNumber('VHE0000');
        $buildingAddress125->setDaeb(true);
        $buildingAddress125->setVtw($vtw1);
        $buildingAddress125->setResidentialArea($residentialArea5);
        $buildingAddress125->setBuildingType($buildingType5);
        $buildingAddress125->setLivingType($livingType3);
        $buildingAddress125->setCreationTime();
        $buildingAddress125->setLastChangeTime();

        $buildingAddress36 = new BuildingAddress();
        $buildingAddress36->setId(36);
        $buildingAddress36->setConstructionYear(1908);
        $buildingAddress36->setRenovationYear(200);
        $buildingAddress36->setStreetName('Straatnaam A');
        $buildingAddress36->setHouseNumber(10);
        $buildingAddress36->setAddition('A');
        $buildingAddress36->setZipcode('1234AA');
        $buildingAddress36->setCity('Woonplaats A');
        $buildingAddress36->setRentalUnitNumber('VHE0000');
        $buildingAddress36->setDaeb(true);
        $buildingAddress36->setVtw($vtw1);
        $buildingAddress36->setResidentialArea($residentialArea6);
        $buildingAddress36->setBuildingType($buildingType6);
        $buildingAddress36->setLivingType($livingType3);
        $buildingAddress36->setCreationTime();
        $buildingAddress36->setLastChangeTime();

        $buildingAddress46 = new BuildingAddress();
        $buildingAddress46->setId(46);
        $buildingAddress46->setConstructionYear(1908);
        $buildingAddress46->setRenovationYear(200);
        $buildingAddress46->setStreetName('Straatnaam A');
        $buildingAddress46->setHouseNumber(10);
        $buildingAddress46->setAddition('A');
        $buildingAddress46->setZipcode('1234AA');
        $buildingAddress46->setCity('Woonplaats A');
        $buildingAddress46->setRentalUnitNumber('VHE0000');
        $buildingAddress46->setDaeb(true);
        $buildingAddress46->setVtw($vtw1);
        $buildingAddress46->setResidentialArea($residentialArea6);
        $buildingAddress46->setBuildingType($buildingType6);
        $buildingAddress46->setLivingType($livingType3);
        $buildingAddress46->setCreationTime();
        $buildingAddress46->setLastChangeTime();

        $buildingAddress56 = new BuildingAddress();
        $buildingAddress56->setId(56);
        $buildingAddress56->setConstructionYear(1908);
        $buildingAddress56->setRenovationYear(200);
        $buildingAddress56->setStreetName('Straatnaam A');
        $buildingAddress56->setHouseNumber(10);
        $buildingAddress56->setAddition('A');
        $buildingAddress56->setZipcode('1234AA');
        $buildingAddress56->setCity('Woonplaats A');
        $buildingAddress56->setRentalUnitNumber('VHE0000');
        $buildingAddress56->setDaeb(true);
        $buildingAddress56->setVtw($vtw1);
        $buildingAddress56->setResidentialArea($residentialArea6);
        $buildingAddress56->setBuildingType($buildingType6);
        $buildingAddress56->setLivingType($livingType3);
        $buildingAddress56->setCreationTime();
        $buildingAddress56->setLastChangeTime();

        $buildingAddress66 = new BuildingAddress();
        $buildingAddress66->setId(66);
        $buildingAddress66->setConstructionYear(1908);
        $buildingAddress66->setRenovationYear(200);
        $buildingAddress66->setStreetName('Straatnaam A');
        $buildingAddress66->setHouseNumber(10);
        $buildingAddress66->setAddition('A');
        $buildingAddress66->setZipcode('1234AA');
        $buildingAddress66->setCity('Woonplaats A');
        $buildingAddress66->setRentalUnitNumber('VHE0000');
        $buildingAddress66->setDaeb(true);
        $buildingAddress66->setVtw($vtw1);
        $buildingAddress66->setResidentialArea($residentialArea6);
        $buildingAddress66->setBuildingType($buildingType6);
        $buildingAddress66->setLivingType($livingType3);
        $buildingAddress66->setCreationTime();
        $buildingAddress66->setLastChangeTime();

        $buildingAddress76 = new BuildingAddress();
        $buildingAddress76->setId(76);
        $buildingAddress76->setConstructionYear(1908);
        $buildingAddress76->setRenovationYear(200);
        $buildingAddress76->setStreetName('Straatnaam A');
        $buildingAddress76->setHouseNumber(10);
        $buildingAddress76->setAddition('A');
        $buildingAddress76->setZipcode('1234AA');
        $buildingAddress76->setCity('Woonplaats A');
        $buildingAddress76->setRentalUnitNumber('VHE0000');
        $buildingAddress76->setDaeb(true);
        $buildingAddress76->setVtw($vtw1);
        $buildingAddress76->setResidentialArea($residentialArea6);
        $buildingAddress76->setBuildingType($buildingType6);
        $buildingAddress76->setLivingType($livingType3);
        $buildingAddress76->setCreationTime();
        $buildingAddress76->setLastChangeTime();

        $buildingAddress86 = new BuildingAddress();
        $buildingAddress86->setId(86);
        $buildingAddress86->setConstructionYear(1908);
        $buildingAddress86->setRenovationYear(200);
        $buildingAddress86->setStreetName('Straatnaam A');
        $buildingAddress86->setHouseNumber(10);
        $buildingAddress86->setAddition('A');
        $buildingAddress86->setZipcode('1234AA');
        $buildingAddress86->setCity('Woonplaats A');
        $buildingAddress86->setRentalUnitNumber('VHE0000');
        $buildingAddress86->setDaeb(true);
        $buildingAddress86->setVtw($vtw1);
        $buildingAddress86->setResidentialArea($residentialArea6);
        $buildingAddress86->setBuildingType($buildingType6);
        $buildingAddress86->setLivingType($livingType3);
        $buildingAddress86->setCreationTime();
        $buildingAddress86->setLastChangeTime();

        $buildingAddress96 = new BuildingAddress();
        $buildingAddress96->setId(96);
        $buildingAddress96->setConstructionYear(1908);
        $buildingAddress96->setRenovationYear(200);
        $buildingAddress96->setStreetName('Straatnaam A');
        $buildingAddress96->setHouseNumber(10);
        $buildingAddress96->setAddition('A');
        $buildingAddress96->setZipcode('1234AA');
        $buildingAddress96->setCity('Woonplaats A');
        $buildingAddress96->setRentalUnitNumber('VHE0000');
        $buildingAddress96->setDaeb(true);
        $buildingAddress96->setVtw($vtw1);
        $buildingAddress96->setResidentialArea($residentialArea6);
        $buildingAddress96->setBuildingType($buildingType6);
        $buildingAddress96->setLivingType($livingType3);
        $buildingAddress96->setCreationTime();
        $buildingAddress96->setLastChangeTime();

        $buildingAddress106 = new BuildingAddress();
        $buildingAddress106->setId(106);
        $buildingAddress106->setConstructionYear(1908);
        $buildingAddress106->setRenovationYear(200);
        $buildingAddress106->setStreetName('Straatnaam A');
        $buildingAddress106->setHouseNumber(10);
        $buildingAddress106->setAddition('A');
        $buildingAddress106->setZipcode('1234AA');
        $buildingAddress106->setCity('Woonplaats A');
        $buildingAddress106->setRentalUnitNumber('VHE0000');
        $buildingAddress106->setDaeb(true);
        $buildingAddress106->setVtw($vtw1);
        $buildingAddress106->setResidentialArea($residentialArea6);
        $buildingAddress106->setBuildingType($buildingType6);
        $buildingAddress106->setLivingType($livingType3);
        $buildingAddress106->setCreationTime();
        $buildingAddress106->setLastChangeTime();

        $buildingAddress116 = new BuildingAddress();
        $buildingAddress116->setId(116);
        $buildingAddress116->setConstructionYear(1908);
        $buildingAddress116->setRenovationYear(200);
        $buildingAddress116->setStreetName('Straatnaam A');
        $buildingAddress116->setHouseNumber(10);
        $buildingAddress116->setAddition('A');
        $buildingAddress116->setZipcode('1234AA');
        $buildingAddress116->setCity('Woonplaats A');
        $buildingAddress116->setRentalUnitNumber('VHE0000');
        $buildingAddress116->setDaeb(true);
        $buildingAddress116->setVtw($vtw1);
        $buildingAddress116->setResidentialArea($residentialArea6);
        $buildingAddress116->setBuildingType($buildingType6);
        $buildingAddress116->setLivingType($livingType3);
        $buildingAddress116->setCreationTime();
        $buildingAddress116->setLastChangeTime();

        $buildingAddress126 = new BuildingAddress();
        $buildingAddress126->setId(126);
        $buildingAddress126->setConstructionYear(1908);
        $buildingAddress126->setRenovationYear(200);
        $buildingAddress126->setStreetName('Straatnaam A');
        $buildingAddress126->setHouseNumber(10);
        $buildingAddress126->setAddition('A');
        $buildingAddress126->setZipcode('1234AA');
        $buildingAddress126->setCity('Woonplaats A');
        $buildingAddress126->setRentalUnitNumber('VHE0000');
        $buildingAddress126->setDaeb(true);
        $buildingAddress126->setVtw($vtw1);
        $buildingAddress126->setResidentialArea($residentialArea6);
        $buildingAddress126->setBuildingType($buildingType6);
        $buildingAddress126->setLivingType($livingType3);
        $buildingAddress126->setCreationTime();
        $buildingAddress126->setLastChangeTime();

        $buildingAddress37 = new BuildingAddress();
        $buildingAddress37->setId(37);
        $buildingAddress37->setConstructionYear(2006);
        $buildingAddress37->setRenovationYear(2006);
        $buildingAddress37->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress37->setHouseNumber(10);
        $buildingAddress37->setAddition('A');
        $buildingAddress37->setZipcode('1234AA');
        $buildingAddress37->setCity('Woonplaats A');
        $buildingAddress37->setRentalUnitNumber('VHE0000');
        $buildingAddress37->setDaeb(true);
        $buildingAddress37->setVtw($vtw1);
        $buildingAddress37->setResidentialArea($residentialArea7);
        $buildingAddress37->setBuildingType($buildingType7);
        $buildingAddress37->setLivingType($livingType3);
        $buildingAddress37->setCreationTime();
        $buildingAddress37->setLastChangeTime();

        $buildingAddress47 = new BuildingAddress();
        $buildingAddress47->setId(47);
        $buildingAddress47->setConstructionYear(2006);
        $buildingAddress47->setRenovationYear(2006);
        $buildingAddress47->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress47->setHouseNumber(10);
        $buildingAddress47->setAddition('A');
        $buildingAddress47->setZipcode('1234AA');
        $buildingAddress47->setCity('Woonplaats A');
        $buildingAddress47->setRentalUnitNumber('VHE0000');
        $buildingAddress47->setDaeb(true);
        $buildingAddress47->setVtw($vtw1);
        $buildingAddress47->setResidentialArea($residentialArea7);
        $buildingAddress47->setBuildingType($buildingType7);
        $buildingAddress47->setLivingType($livingType3);
        $buildingAddress47->setCreationTime();
        $buildingAddress47->setLastChangeTime();

        $buildingAddress57 = new BuildingAddress();
        $buildingAddress57->setId(57);
        $buildingAddress57->setConstructionYear(2006);
        $buildingAddress57->setRenovationYear(2006);
        $buildingAddress57->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress57->setHouseNumber(10);
        $buildingAddress57->setAddition('A');
        $buildingAddress57->setZipcode('1234AA');
        $buildingAddress57->setCity('Woonplaats A');
        $buildingAddress57->setRentalUnitNumber('VHE0000');
        $buildingAddress57->setDaeb(true);
        $buildingAddress57->setVtw($vtw1);
        $buildingAddress57->setResidentialArea($residentialArea7);
        $buildingAddress57->setBuildingType($buildingType7);
        $buildingAddress57->setLivingType($livingType3);
        $buildingAddress57->setCreationTime();
        $buildingAddress57->setLastChangeTime();

        $buildingAddress67 = new BuildingAddress();
        $buildingAddress67->setId(67);
        $buildingAddress67->setConstructionYear(2006);
        $buildingAddress67->setRenovationYear(2006);
        $buildingAddress67->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress67->setHouseNumber(10);
        $buildingAddress67->setAddition('A');
        $buildingAddress67->setZipcode('1234AA');
        $buildingAddress67->setCity('Woonplaats A');
        $buildingAddress67->setRentalUnitNumber('VHE0000');
        $buildingAddress67->setDaeb(true);
        $buildingAddress67->setVtw($vtw1);
        $buildingAddress67->setResidentialArea($residentialArea7);
        $buildingAddress67->setBuildingType($buildingType7);
        $buildingAddress67->setLivingType($livingType3);
        $buildingAddress67->setCreationTime();
        $buildingAddress67->setLastChangeTime();

        $buildingAddress77 = new BuildingAddress();
        $buildingAddress77->setId(77);
        $buildingAddress77->setConstructionYear(2006);
        $buildingAddress77->setRenovationYear(2006);
        $buildingAddress77->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress77->setHouseNumber(10);
        $buildingAddress77->setAddition('A');
        $buildingAddress77->setZipcode('1234AA');
        $buildingAddress77->setCity('Woonplaats A');
        $buildingAddress77->setRentalUnitNumber('VHE0000');
        $buildingAddress77->setDaeb(true);
        $buildingAddress77->setVtw($vtw1);
        $buildingAddress77->setResidentialArea($residentialArea7);
        $buildingAddress77->setBuildingType($buildingType7);
        $buildingAddress77->setLivingType($livingType3);
        $buildingAddress77->setCreationTime();
        $buildingAddress77->setLastChangeTime();

        $buildingAddress87 = new BuildingAddress();
        $buildingAddress87->setId(87);
        $buildingAddress87->setConstructionYear(2006);
        $buildingAddress87->setRenovationYear(2006);
        $buildingAddress87->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress87->setHouseNumber(10);
        $buildingAddress87->setAddition('A');
        $buildingAddress87->setZipcode('1234AA');
        $buildingAddress87->setCity('Woonplaats A');
        $buildingAddress87->setRentalUnitNumber('VHE0000');
        $buildingAddress87->setDaeb(true);
        $buildingAddress87->setVtw($vtw1);
        $buildingAddress87->setResidentialArea($residentialArea7);
        $buildingAddress87->setBuildingType($buildingType7);
        $buildingAddress87->setLivingType($livingType3);
        $buildingAddress87->setCreationTime();
        $buildingAddress87->setLastChangeTime();

        $buildingAddress97 = new BuildingAddress();
        $buildingAddress97->setId(97);
        $buildingAddress97->setConstructionYear(2006);
        $buildingAddress97->setRenovationYear(2006);
        $buildingAddress97->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress97->setHouseNumber(10);
        $buildingAddress97->setAddition('A');
        $buildingAddress97->setZipcode('1234AA');
        $buildingAddress97->setCity('Woonplaats A');
        $buildingAddress97->setRentalUnitNumber('VHE0000');
        $buildingAddress97->setDaeb(false);
        $buildingAddress97->setVtw($vtw1);
        $buildingAddress97->setResidentialArea($residentialArea7);
        $buildingAddress97->setBuildingType($buildingType7);
        $buildingAddress97->setLivingType($livingType3);
        $buildingAddress97->setCreationTime();
        $buildingAddress97->setLastChangeTime();

        $buildingAddress107 = new BuildingAddress();
        $buildingAddress107->setId(107);
        $buildingAddress107->setConstructionYear(2006);
        $buildingAddress107->setRenovationYear(2006);
        $buildingAddress107->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress107->setHouseNumber(10);
        $buildingAddress107->setAddition('A');
        $buildingAddress107->setZipcode('1234AA');
        $buildingAddress107->setCity('Woonplaats A');
        $buildingAddress107->setRentalUnitNumber('VHE0000');
        $buildingAddress107->setDaeb(true);
        $buildingAddress107->setVtw($vtw1);
        $buildingAddress107->setResidentialArea($residentialArea7);
        $buildingAddress107->setBuildingType($buildingType7);
        $buildingAddress107->setLivingType($livingType3);
        $buildingAddress107->setCreationTime();
        $buildingAddress107->setLastChangeTime();

        $buildingAddress117 = new BuildingAddress();
        $buildingAddress117->setId(117);
        $buildingAddress117->setConstructionYear(2006);
        $buildingAddress117->setRenovationYear(2006);
        $buildingAddress117->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress117->setHouseNumber(10);
        $buildingAddress117->setAddition('A');
        $buildingAddress117->setZipcode('1234AA');
        $buildingAddress117->setCity('Woonplaats A');
        $buildingAddress117->setRentalUnitNumber('VHE0000');
        $buildingAddress117->setDaeb(true);
        $buildingAddress117->setVtw($vtw1);
        $buildingAddress117->setResidentialArea($residentialArea7);
        $buildingAddress117->setBuildingType($buildingType7);
        $buildingAddress117->setLivingType($livingType3);
        $buildingAddress117->setCreationTime();
        $buildingAddress117->setLastChangeTime();

        $buildingAddress127 = new BuildingAddress();
        $buildingAddress127->setId(127);
        $buildingAddress127->setConstructionYear(2006);
        $buildingAddress127->setRenovationYear(2006);
        $buildingAddress127->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress127->setHouseNumber(10);
        $buildingAddress127->setAddition('A');
        $buildingAddress127->setZipcode('1234AA');
        $buildingAddress127->setCity('Woonplaats A');
        $buildingAddress127->setRentalUnitNumber('VHE0000');
        $buildingAddress127->setDaeb(true);
        $buildingAddress127->setVtw($vtw1);
        $buildingAddress127->setResidentialArea($residentialArea7);
        $buildingAddress127->setBuildingType($buildingType7);
        $buildingAddress127->setLivingType($livingType3);
        $buildingAddress127->setCreationTime();
        $buildingAddress127->setLastChangeTime();

        $buildingAddress38 = new BuildingAddress();
        $buildingAddress38->setId(38);
        $buildingAddress38->setConstructionYear(2026);
        $buildingAddress38->setRenovationYear(2081);
        $buildingAddress38->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress38->setHouseNumber(10);
        $buildingAddress38->setAddition('Bis');
        $buildingAddress38->setZipcode('1234AAB');
        $buildingAddress38->setCity('Woonplaats A');
        $buildingAddress38->setRentalUnitNumber('VHE0000');
        $buildingAddress38->setDaeb(true);
        $buildingAddress38->setVtw($vtw1);
        $buildingAddress38->setResidentialArea($residentialArea8);
        $buildingAddress38->setBuildingType($buildingType8);
        $buildingAddress38->setLivingType($livingType3);
        $buildingAddress38->setCreationTime();
        $buildingAddress38->setLastChangeTime();

        $buildingAddress48 = new BuildingAddress();
        $buildingAddress48->setId(48);
        $buildingAddress48->setConstructionYear(2026);
        $buildingAddress48->setRenovationYear(2081);
        $buildingAddress48->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress48->setHouseNumber(10);
        $buildingAddress48->setAddition('Bis');
        $buildingAddress48->setZipcode('1234AAB');
        $buildingAddress48->setCity('Woonplaats A');
        $buildingAddress48->setRentalUnitNumber('VHE0000');
        $buildingAddress48->setDaeb(true);
        $buildingAddress48->setVtw($vtw1);
        $buildingAddress48->setResidentialArea($residentialArea8);
        $buildingAddress48->setBuildingType($buildingType8);
        $buildingAddress48->setLivingType($livingType3);
        $buildingAddress48->setCreationTime();
        $buildingAddress48->setLastChangeTime();

        $buildingAddress58 = new BuildingAddress();
        $buildingAddress58->setId(58);
        $buildingAddress58->setConstructionYear(2026);
        $buildingAddress58->setRenovationYear(2081);
        $buildingAddress58->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress58->setHouseNumber(10);
        $buildingAddress58->setAddition('Bis');
        $buildingAddress58->setZipcode('1234AAB');
        $buildingAddress58->setCity('Woonplaats A');
        $buildingAddress58->setRentalUnitNumber('VHE0000');
        $buildingAddress58->setDaeb(false);
        $buildingAddress58->setVtw($vtw1);
        $buildingAddress58->setResidentialArea($residentialArea8);
        $buildingAddress58->setBuildingType($buildingType8);
        $buildingAddress58->setLivingType($livingType3);
        $buildingAddress58->setCreationTime();
        $buildingAddress58->setLastChangeTime();

        $buildingAddress68 = new BuildingAddress();
        $buildingAddress68->setId(68);
        $buildingAddress68->setConstructionYear(2026);
        $buildingAddress68->setRenovationYear(2081);
        $buildingAddress68->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress68->setHouseNumber(10);
        $buildingAddress68->setAddition('Bis');
        $buildingAddress68->setZipcode('1234AAB');
        $buildingAddress68->setCity('Woonplaats A');
        $buildingAddress68->setRentalUnitNumber('VHE0000');
        $buildingAddress68->setDaeb(false);
        $buildingAddress68->setVtw($vtw1);
        $buildingAddress68->setResidentialArea($residentialArea8);
        $buildingAddress68->setBuildingType($buildingType8);
        $buildingAddress68->setLivingType($livingType3);
        $buildingAddress68->setCreationTime();
        $buildingAddress68->setLastChangeTime();

        $buildingAddress78 = new BuildingAddress();
        $buildingAddress78->setId(78);
        $buildingAddress78->setConstructionYear(2026);
        $buildingAddress78->setRenovationYear(2081);
        $buildingAddress78->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress78->setHouseNumber(10);
        $buildingAddress78->setAddition('Bis');
        $buildingAddress78->setZipcode('1234AAB');
        $buildingAddress78->setCity('Woonplaats A');
        $buildingAddress78->setRentalUnitNumber('VHE0000');
        $buildingAddress78->setDaeb(true);
        $buildingAddress78->setVtw($vtw1);
        $buildingAddress78->setResidentialArea($residentialArea8);
        $buildingAddress78->setBuildingType($buildingType8);
        $buildingAddress78->setLivingType($livingType3);
        $buildingAddress78->setCreationTime();
        $buildingAddress78->setLastChangeTime();

        $buildingAddress88 = new BuildingAddress();
        $buildingAddress88->setId(88);
        $buildingAddress88->setConstructionYear(2026);
        $buildingAddress88->setRenovationYear(2081);
        $buildingAddress88->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress88->setHouseNumber(10);
        $buildingAddress88->setAddition('Bis');
        $buildingAddress88->setZipcode('1234AAB');
        $buildingAddress88->setCity('Woonplaats A');
        $buildingAddress88->setRentalUnitNumber('VHE0000');
        $buildingAddress88->setDaeb(false);
        $buildingAddress88->setVtw($vtw1);
        $buildingAddress88->setResidentialArea($residentialArea8);
        $buildingAddress88->setBuildingType($buildingType8);
        $buildingAddress88->setLivingType($livingType3);
        $buildingAddress88->setCreationTime();
        $buildingAddress88->setLastChangeTime();

        $buildingAddress98 = new BuildingAddress();
        $buildingAddress98->setId(98);
        $buildingAddress98->setConstructionYear(2026);
        $buildingAddress98->setRenovationYear(2081);
        $buildingAddress98->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress98->setHouseNumber(10);
        $buildingAddress98->setAddition('Bis');
        $buildingAddress98->setZipcode('1234AAB');
        $buildingAddress98->setCity('Woonplaats A');
        $buildingAddress98->setRentalUnitNumber('VHE0000');
        $buildingAddress98->setDaeb(true);
        $buildingAddress98->setVtw($vtw1);
        $buildingAddress98->setResidentialArea($residentialArea8);
        $buildingAddress98->setBuildingType($buildingType8);
        $buildingAddress98->setLivingType($livingType3);
        $buildingAddress98->setCreationTime();
        $buildingAddress98->setLastChangeTime();

        $buildingAddress108 = new BuildingAddress();
        $buildingAddress108->setId(108);
        $buildingAddress108->setConstructionYear(2026);
        $buildingAddress108->setRenovationYear(2081);
        $buildingAddress108->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress108->setHouseNumber(10);
        $buildingAddress108->setAddition('Bis');
        $buildingAddress108->setZipcode('1234AAB');
        $buildingAddress108->setCity('Woonplaats A');
        $buildingAddress108->setRentalUnitNumber('VHE0000');
        $buildingAddress108->setDaeb(true);
        $buildingAddress108->setVtw($vtw1);
        $buildingAddress108->setResidentialArea($residentialArea8);
        $buildingAddress108->setBuildingType($buildingType8);
        $buildingAddress108->setLivingType($livingType3);
        $buildingAddress108->setCreationTime();
        $buildingAddress108->setLastChangeTime();

        $buildingAddress118 = new BuildingAddress();
        $buildingAddress118->setId(118);
        $buildingAddress118->setConstructionYear(2026);
        $buildingAddress118->setRenovationYear(2081);
        $buildingAddress118->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress118->setHouseNumber(10);
        $buildingAddress118->setAddition('Bis');
        $buildingAddress118->setZipcode('1234AAB');
        $buildingAddress118->setCity('Woonplaats A');
        $buildingAddress118->setRentalUnitNumber('VHE0000');
        $buildingAddress118->setDaeb(true);
        $buildingAddress118->setVtw($vtw1);
        $buildingAddress118->setResidentialArea($residentialArea8);
        $buildingAddress118->setBuildingType($buildingType8);
        $buildingAddress118->setLivingType($livingType3);
        $buildingAddress118->setCreationTime();
        $buildingAddress118->setLastChangeTime();

        $buildingAddress128 = new BuildingAddress();
        $buildingAddress128->setId(128);
        $buildingAddress128->setConstructionYear(2026);
        $buildingAddress128->setRenovationYear(2081);
        $buildingAddress128->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress128->setHouseNumber(10);
        $buildingAddress128->setAddition('Bis');
        $buildingAddress128->setZipcode('1234AAB');
        $buildingAddress128->setCity('Woonplaats A');
        $buildingAddress128->setRentalUnitNumber('VHE0000');
        $buildingAddress128->setDaeb(true);
        $buildingAddress128->setVtw($vtw1);
        $buildingAddress128->setResidentialArea($residentialArea8);
        $buildingAddress128->setBuildingType($buildingType8);
        $buildingAddress128->setLivingType($livingType3);
        $buildingAddress128->setCreationTime();
        $buildingAddress128->setLastChangeTime();

        $buildingAddress39 = new BuildingAddress();
        $buildingAddress39->setId(39);
        $buildingAddress39->setConstructionYear(1976);
        $buildingAddress39->setRenovationYear(2001);
        $buildingAddress39->setStreetName('Straatnaam A');
        $buildingAddress39->setHouseNumber(10);
        $buildingAddress39->setAddition('I');
        $buildingAddress39->setZipcode('12334AA');
        $buildingAddress39->setCity('Woonplaats A');
        $buildingAddress39->setRentalUnitNumber('VHE0000');
        $buildingAddress39->setDaeb(true);
        $buildingAddress39->setVtw($vtw1);
        $buildingAddress39->setResidentialArea($residentialArea9);
        $buildingAddress39->setBuildingType($buildingType9);
        $buildingAddress39->setLivingType($livingType3);
        $buildingAddress39->setCreationTime();
        $buildingAddress39->setLastChangeTime();

        $buildingAddress49 = new BuildingAddress();
        $buildingAddress49->setId(49);
        $buildingAddress49->setConstructionYear(1976);
        $buildingAddress49->setRenovationYear(2001);
        $buildingAddress49->setStreetName('Straatnaam A');
        $buildingAddress49->setHouseNumber(10);
        $buildingAddress49->setAddition('I');
        $buildingAddress49->setZipcode('12334AA');
        $buildingAddress49->setCity('Woonplaats A');
        $buildingAddress49->setRentalUnitNumber('VHE0000');
        $buildingAddress49->setDaeb(true);
        $buildingAddress49->setVtw($vtw1);
        $buildingAddress49->setResidentialArea($residentialArea9);
        $buildingAddress49->setBuildingType($buildingType9);
        $buildingAddress49->setLivingType($livingType3);
        $buildingAddress49->setCreationTime();
        $buildingAddress49->setLastChangeTime();

        $buildingAddress59 = new BuildingAddress();
        $buildingAddress59->setId(59);
        $buildingAddress59->setConstructionYear(1976);
        $buildingAddress59->setRenovationYear(2001);
        $buildingAddress59->setStreetName('Straatnaam A');
        $buildingAddress59->setHouseNumber(10);
        $buildingAddress59->setAddition('I');
        $buildingAddress59->setZipcode('12334AA');
        $buildingAddress59->setCity('Woonplaats A');
        $buildingAddress59->setRentalUnitNumber('VHE0000');
        $buildingAddress59->setDaeb(true);
        $buildingAddress59->setVtw($vtw1);
        $buildingAddress59->setResidentialArea($residentialArea9);
        $buildingAddress59->setBuildingType($buildingType9);
        $buildingAddress59->setLivingType($livingType3);
        $buildingAddress59->setCreationTime();
        $buildingAddress59->setLastChangeTime();

        $buildingAddress69 = new BuildingAddress();
        $buildingAddress69->setId(69);
        $buildingAddress69->setConstructionYear(1976);
        $buildingAddress69->setRenovationYear(2001);
        $buildingAddress69->setStreetName('Straatnaam A');
        $buildingAddress69->setHouseNumber(10);
        $buildingAddress69->setAddition('I');
        $buildingAddress69->setZipcode('12334AA');
        $buildingAddress69->setCity('Woonplaats A');
        $buildingAddress69->setRentalUnitNumber('VHE0000');
        $buildingAddress69->setDaeb(true);
        $buildingAddress69->setVtw($vtw1);
        $buildingAddress69->setResidentialArea($residentialArea9);
        $buildingAddress69->setBuildingType($buildingType9);
        $buildingAddress69->setLivingType($livingType3);
        $buildingAddress69->setCreationTime();
        $buildingAddress69->setLastChangeTime();

        $buildingAddress79 = new BuildingAddress();
        $buildingAddress79->setId(79);
        $buildingAddress79->setConstructionYear(1976);
        $buildingAddress79->setRenovationYear(2001);
        $buildingAddress79->setStreetName('Straatnaam A');
        $buildingAddress79->setHouseNumber(10);
        $buildingAddress79->setAddition('I');
        $buildingAddress79->setZipcode('12334AA');
        $buildingAddress79->setCity('Woonplaats A');
        $buildingAddress79->setRentalUnitNumber('VHE0000');
        $buildingAddress79->setDaeb(true);
        $buildingAddress79->setVtw($vtw1);
        $buildingAddress79->setResidentialArea($residentialArea9);
        $buildingAddress79->setBuildingType($buildingType9);
        $buildingAddress79->setLivingType($livingType3);
        $buildingAddress79->setCreationTime();
        $buildingAddress79->setLastChangeTime();

        $buildingAddress89 = new BuildingAddress();
        $buildingAddress89->setId(89);
        $buildingAddress89->setConstructionYear(1976);
        $buildingAddress89->setRenovationYear(2001);
        $buildingAddress89->setStreetName('Straatnaam A');
        $buildingAddress89->setHouseNumber(10);
        $buildingAddress89->setAddition('I');
        $buildingAddress89->setZipcode('12334AA');
        $buildingAddress89->setCity('Woonplaats A');
        $buildingAddress89->setRentalUnitNumber('VHE0000');
        $buildingAddress89->setDaeb(true);
        $buildingAddress89->setVtw($vtw1);
        $buildingAddress89->setResidentialArea($residentialArea9);
        $buildingAddress89->setBuildingType($buildingType9);
        $buildingAddress89->setLivingType($livingType3);
        $buildingAddress89->setCreationTime();
        $buildingAddress89->setLastChangeTime();

        $buildingAddress99 = new BuildingAddress();
        $buildingAddress99->setId(99);
        $buildingAddress99->setConstructionYear(1976);
        $buildingAddress99->setRenovationYear(2001);
        $buildingAddress99->setStreetName('Straatnaam A');
        $buildingAddress99->setHouseNumber(10);
        $buildingAddress99->setAddition('I');
        $buildingAddress99->setZipcode('12334AA');
        $buildingAddress99->setCity('Woonplaats A');
        $buildingAddress99->setRentalUnitNumber('VHE0000');
        $buildingAddress99->setDaeb(true);
        $buildingAddress99->setVtw($vtw1);
        $buildingAddress99->setResidentialArea($residentialArea9);
        $buildingAddress99->setBuildingType($buildingType9);
        $buildingAddress99->setLivingType($livingType3);
        $buildingAddress99->setCreationTime();
        $buildingAddress99->setLastChangeTime();

        $buildingAddress109 = new BuildingAddress();
        $buildingAddress109->setId(109);
        $buildingAddress109->setConstructionYear(1976);
        $buildingAddress109->setRenovationYear(2001);
        $buildingAddress109->setStreetName('Straatnaam A');
        $buildingAddress109->setHouseNumber(10);
        $buildingAddress109->setAddition('I');
        $buildingAddress109->setZipcode('12334AA');
        $buildingAddress109->setCity('Woonplaats A');
        $buildingAddress109->setRentalUnitNumber('VHE0000');
        $buildingAddress109->setDaeb(true);
        $buildingAddress109->setVtw($vtw1);
        $buildingAddress109->setResidentialArea($residentialArea9);
        $buildingAddress109->setBuildingType($buildingType9);
        $buildingAddress109->setLivingType($livingType3);
        $buildingAddress109->setCreationTime();
        $buildingAddress109->setLastChangeTime();

        $buildingAddress119 = new BuildingAddress();
        $buildingAddress119->setId(119);
        $buildingAddress119->setConstructionYear(1976);
        $buildingAddress119->setRenovationYear(2001);
        $buildingAddress119->setStreetName('Straatnaam A');
        $buildingAddress119->setHouseNumber(10);
        $buildingAddress119->setAddition('I');
        $buildingAddress119->setZipcode('12334AA');
        $buildingAddress119->setCity('Woonplaats A');
        $buildingAddress119->setRentalUnitNumber('VHE0000');
        $buildingAddress119->setDaeb(true);
        $buildingAddress119->setVtw($vtw1);
        $buildingAddress119->setResidentialArea($residentialArea9);
        $buildingAddress119->setBuildingType($buildingType9);
        $buildingAddress119->setLivingType($livingType3);
        $buildingAddress119->setCreationTime();
        $buildingAddress119->setLastChangeTime();

        $buildingAddress129 = new BuildingAddress();
        $buildingAddress129->setId(129);
        $buildingAddress129->setConstructionYear(1976);
        $buildingAddress129->setRenovationYear(2001);
        $buildingAddress129->setStreetName('Straatnaam A');
        $buildingAddress129->setHouseNumber(10);
        $buildingAddress129->setAddition('I');
        $buildingAddress129->setZipcode('12334AA');
        $buildingAddress129->setCity('Woonplaats A');
        $buildingAddress129->setRentalUnitNumber('VHE0000');
        $buildingAddress129->setDaeb(true);
        $buildingAddress129->setVtw($vtw1);
        $buildingAddress129->setResidentialArea($residentialArea9);
        $buildingAddress129->setBuildingType($buildingType9);
        $buildingAddress129->setLivingType($livingType3);
        $buildingAddress129->setCreationTime();
        $buildingAddress129->setLastChangeTime();

        $buildingAddress40 = new BuildingAddress();
        $buildingAddress40->setId(40);
        $buildingAddress40->setConstructionYear(1986);
        $buildingAddress40->setRenovationYear(2002);
        $buildingAddress40->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress40->setHouseNumber(10);
        $buildingAddress40->setAddition('X');
        $buildingAddress40->setZipcode('1234AA');
        $buildingAddress40->setCity('Woonplaats A');
        $buildingAddress40->setRentalUnitNumber('VHE0000');
        $buildingAddress40->setDaeb(true);
        $buildingAddress40->setVtw($vtw1);
        $buildingAddress40->setResidentialArea($residentialArea10);
        $buildingAddress40->setBuildingType($buildingType10);
        $buildingAddress40->setLivingType($livingType3);
        $buildingAddress40->setCreationTime();
        $buildingAddress40->setLastChangeTime();

        $buildingAddress50 = new BuildingAddress();
        $buildingAddress50->setId(50);
        $buildingAddress50->setConstructionYear(1986);
        $buildingAddress50->setRenovationYear(2002);
        $buildingAddress50->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress50->setHouseNumber(10);
        $buildingAddress50->setAddition('X');
        $buildingAddress50->setZipcode('1234AA');
        $buildingAddress50->setCity('Woonplaats A');
        $buildingAddress50->setRentalUnitNumber('VHE0000');
        $buildingAddress50->setDaeb(true);
        $buildingAddress50->setVtw($vtw1);
        $buildingAddress50->setResidentialArea($residentialArea10);
        $buildingAddress50->setBuildingType($buildingType10);
        $buildingAddress50->setLivingType($livingType3);
        $buildingAddress50->setCreationTime();
        $buildingAddress50->setLastChangeTime();

        $buildingAddress60 = new BuildingAddress();
        $buildingAddress60->setId(60);
        $buildingAddress60->setConstructionYear(1986);
        $buildingAddress60->setRenovationYear(2002);
        $buildingAddress60->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress60->setHouseNumber(10);
        $buildingAddress60->setAddition('X');
        $buildingAddress60->setZipcode('1234AA');
        $buildingAddress60->setCity('Woonplaats A');
        $buildingAddress60->setRentalUnitNumber('VHE0000');
        $buildingAddress60->setDaeb(true);
        $buildingAddress60->setVtw($vtw1);
        $buildingAddress60->setResidentialArea($residentialArea10);
        $buildingAddress60->setBuildingType($buildingType10);
        $buildingAddress60->setLivingType($livingType3);
        $buildingAddress60->setCreationTime();
        $buildingAddress60->setLastChangeTime();

        $buildingAddress70 = new BuildingAddress();
        $buildingAddress70->setId(70);
        $buildingAddress70->setConstructionYear(1986);
        $buildingAddress70->setRenovationYear(2002);
        $buildingAddress70->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress70->setHouseNumber(10);
        $buildingAddress70->setAddition('X');
        $buildingAddress70->setZipcode('1234AA');
        $buildingAddress70->setCity('Woonplaats A');
        $buildingAddress70->setRentalUnitNumber('VHE0000');
        $buildingAddress70->setDaeb(true);
        $buildingAddress70->setVtw($vtw1);
        $buildingAddress70->setResidentialArea($residentialArea10);
        $buildingAddress70->setBuildingType($buildingType10);
        $buildingAddress70->setLivingType($livingType3);
        $buildingAddress70->setCreationTime();
        $buildingAddress70->setLastChangeTime();

        $buildingAddress80 = new BuildingAddress();
        $buildingAddress80->setId(80);
        $buildingAddress80->setConstructionYear(1986);
        $buildingAddress80->setRenovationYear(2002);
        $buildingAddress80->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress80->setHouseNumber(10);
        $buildingAddress80->setAddition('X');
        $buildingAddress80->setZipcode('1234AA');
        $buildingAddress80->setCity('Woonplaats A');
        $buildingAddress80->setRentalUnitNumber('VHE0000');
        $buildingAddress80->setDaeb(true);
        $buildingAddress80->setVtw($vtw1);
        $buildingAddress80->setResidentialArea($residentialArea10);
        $buildingAddress80->setBuildingType($buildingType10);
        $buildingAddress80->setLivingType($livingType3);
        $buildingAddress80->setCreationTime();
        $buildingAddress80->setLastChangeTime();

        $buildingAddress90 = new BuildingAddress();
        $buildingAddress90->setId(90);
        $buildingAddress90->setConstructionYear(1986);
        $buildingAddress90->setRenovationYear(2002);
        $buildingAddress90->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress90->setHouseNumber(10);
        $buildingAddress90->setAddition('X');
        $buildingAddress90->setZipcode('1234AA');
        $buildingAddress90->setCity('Woonplaats A');
        $buildingAddress90->setRentalUnitNumber('VHE0000');
        $buildingAddress90->setDaeb(true);
        $buildingAddress90->setVtw($vtw1);
        $buildingAddress90->setResidentialArea($residentialArea10);
        $buildingAddress90->setBuildingType($buildingType10);
        $buildingAddress90->setLivingType($livingType3);
        $buildingAddress90->setCreationTime();
        $buildingAddress90->setLastChangeTime();

        $buildingAddress100 = new BuildingAddress();
        $buildingAddress100->setId(100);
        $buildingAddress100->setConstructionYear(1986);
        $buildingAddress100->setRenovationYear(2002);
        $buildingAddress100->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress100->setHouseNumber(10);
        $buildingAddress100->setAddition('X');
        $buildingAddress100->setZipcode('1234AA');
        $buildingAddress100->setCity('Woonplaats A');
        $buildingAddress100->setRentalUnitNumber('VHE0000');
        $buildingAddress100->setDaeb(true);
        $buildingAddress100->setVtw($vtw1);
        $buildingAddress100->setResidentialArea($residentialArea10);
        $buildingAddress100->setBuildingType($buildingType10);
        $buildingAddress100->setLivingType($livingType3);
        $buildingAddress100->setCreationTime();
        $buildingAddress100->setLastChangeTime();

        $buildingAddress110 = new BuildingAddress();
        $buildingAddress110->setId(110);
        $buildingAddress110->setConstructionYear(1986);
        $buildingAddress110->setRenovationYear(2002);
        $buildingAddress110->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress110->setHouseNumber(10);
        $buildingAddress110->setAddition('X');
        $buildingAddress110->setZipcode('1234AA');
        $buildingAddress110->setCity('Woonplaats A');
        $buildingAddress110->setRentalUnitNumber('VHE0000');
        $buildingAddress110->setDaeb(true);
        $buildingAddress110->setVtw($vtw1);
        $buildingAddress110->setResidentialArea($residentialArea10);
        $buildingAddress110->setBuildingType($buildingType10);
        $buildingAddress110->setLivingType($livingType3);
        $buildingAddress110->setCreationTime();
        $buildingAddress110->setLastChangeTime();

        $buildingAddress120 = new BuildingAddress();
        $buildingAddress120->setId(120);
        $buildingAddress120->setConstructionYear(1986);
        $buildingAddress120->setRenovationYear(2002);
        $buildingAddress120->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress120->setHouseNumber(10);
        $buildingAddress120->setAddition('X');
        $buildingAddress120->setZipcode('1234AA');
        $buildingAddress120->setCity('Woonplaats A');
        $buildingAddress120->setRentalUnitNumber('VHE0000');
        $buildingAddress120->setDaeb(true);
        $buildingAddress120->setVtw($vtw1);
        $buildingAddress120->setResidentialArea($residentialArea10);
        $buildingAddress120->setBuildingType($buildingType10);
        $buildingAddress120->setLivingType($livingType3);
        $buildingAddress120->setCreationTime();
        $buildingAddress120->setLastChangeTime();

        $buildingAddress130 = new BuildingAddress();
        $buildingAddress130->setId(130);
        $buildingAddress130->setConstructionYear(1986);
        $buildingAddress130->setRenovationYear(2002);
        $buildingAddress130->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress130->setHouseNumber(10);
        $buildingAddress130->setAddition('X');
        $buildingAddress130->setZipcode('1234AA');
        $buildingAddress130->setCity('Woonplaats A');
        $buildingAddress130->setRentalUnitNumber('VHE0000');
        $buildingAddress130->setDaeb(true);
        $buildingAddress130->setVtw($vtw1);
        $buildingAddress130->setResidentialArea($residentialArea10);
        $buildingAddress130->setBuildingType($buildingType10);
        $buildingAddress130->setLivingType($livingType3);
        $buildingAddress130->setCreationTime();
        $buildingAddress130->setLastChangeTime();

        $buildingAddress131 = new BuildingAddress();
        $buildingAddress131->setId(131);
        $buildingAddress131->setConstructionYear(1986);
        $buildingAddress131->setRenovationYear(2002);
        $buildingAddress131->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress131->setHouseNumber(10);
        $buildingAddress131->setAddition('X');
        $buildingAddress131->setZipcode('1234AA');
        $buildingAddress131->setCity('Woonplaats A');
        $buildingAddress131->setRentalUnitNumber('VHE0000');
        $buildingAddress131->setDaeb(true);
        $buildingAddress131->setVtw($vtw1);
        $buildingAddress131->setResidentialArea($residentialArea10);
        $buildingAddress131->setBuildingType($buildingType10);
        $buildingAddress131->setLivingType($livingType3);
        $buildingAddress131->setCreationTime();
        $buildingAddress131->setLastChangeTime();
        
        $buildingAddress132 = new BuildingAddress();
        $buildingAddress132->setId(132);
        $buildingAddress132->setConstructionYear(1986);
        $buildingAddress132->setRenovationYear(2002);
        $buildingAddress132->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress132->setHouseNumber(10);
        $buildingAddress132->setAddition('X');
        $buildingAddress132->setZipcode('1234AA');
        $buildingAddress132->setCity('Woonplaats A');
        $buildingAddress132->setRentalUnitNumber('VHE0000');
        $buildingAddress132->setDaeb(true);
        $buildingAddress132->setVtw($vtw1);
        $buildingAddress132->setResidentialArea($residentialArea10);
        $buildingAddress132->setBuildingType($buildingType10);
        $buildingAddress132->setLivingType($livingType3);
        $buildingAddress132->setCreationTime();
        $buildingAddress132->setLastChangeTime();
                
        $buildingAddress133 = new BuildingAddress();
        $buildingAddress133->setId(133);
        $buildingAddress133->setConstructionYear(1986);
        $buildingAddress133->setRenovationYear(2002);
        $buildingAddress133->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress133->setHouseNumber(10);
        $buildingAddress133->setAddition('X');
        $buildingAddress133->setZipcode('1234AA');
        $buildingAddress133->setCity('Woonplaats A');
        $buildingAddress133->setRentalUnitNumber('VHE0000');
        $buildingAddress133->setDaeb(true);
        $buildingAddress133->setVtw($vtw1);
        $buildingAddress133->setResidentialArea($residentialArea10);
        $buildingAddress133->setBuildingType($buildingType10);
        $buildingAddress133->setLivingType($livingType3);
        $buildingAddress133->setCreationTime();
        $buildingAddress133->setLastChangeTime();
                
        $buildingAddress134 = new BuildingAddress();
        $buildingAddress134->setId(134);
        $buildingAddress134->setConstructionYear(1986);
        $buildingAddress134->setRenovationYear(2002);
        $buildingAddress134->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress134->setHouseNumber(10);
        $buildingAddress134->setAddition('X');
        $buildingAddress134->setZipcode('1234AA');
        $buildingAddress134->setCity('Woonplaats A');
        $buildingAddress134->setRentalUnitNumber('VHE0000');
        $buildingAddress134->setDaeb(true);
        $buildingAddress134->setVtw($vtw1);
        $buildingAddress134->setResidentialArea($residentialArea10);
        $buildingAddress134->setBuildingType($buildingType10);
        $buildingAddress134->setLivingType($livingType3);
        $buildingAddress134->setCreationTime();
        $buildingAddress134->setLastChangeTime();
                
        $buildingAddress135 = new BuildingAddress();
        $buildingAddress135->setId(135);
        $buildingAddress135->setConstructionYear(1986);
        $buildingAddress135->setRenovationYear(2002);
        $buildingAddress135->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress135->setHouseNumber(10);
        $buildingAddress135->setAddition('X');
        $buildingAddress135->setZipcode('1234AA');
        $buildingAddress135->setCity('Woonplaats A');
        $buildingAddress135->setRentalUnitNumber('VHE0000');
        $buildingAddress135->setDaeb(true);
        $buildingAddress135->setVtw($vtw1);
        $buildingAddress135->setResidentialArea($residentialArea10);
        $buildingAddress135->setBuildingType($buildingType10);
        $buildingAddress135->setLivingType($livingType3);
        $buildingAddress135->setCreationTime();
        $buildingAddress135->setLastChangeTime();
                
        $buildingAddress136 = new BuildingAddress();
        $buildingAddress136->setId(136);
        $buildingAddress136->setConstructionYear(1986);
        $buildingAddress136->setRenovationYear(2002);
        $buildingAddress136->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress136->setHouseNumber(10);
        $buildingAddress136->setAddition('X');
        $buildingAddress136->setZipcode('1234AA');
        $buildingAddress136->setCity('Woonplaats A');
        $buildingAddress136->setRentalUnitNumber('VHE0000');
        $buildingAddress136->setDaeb(true);
        $buildingAddress136->setVtw($vtw1);
        $buildingAddress136->setResidentialArea($residentialArea10);
        $buildingAddress136->setBuildingType($buildingType10);
        $buildingAddress136->setLivingType($livingType3);
        $buildingAddress136->setCreationTime();
        $buildingAddress136->setLastChangeTime();
                
        $buildingAddress137 = new BuildingAddress();
        $buildingAddress137->setId(137);
        $buildingAddress137->setConstructionYear(1986);
        $buildingAddress137->setRenovationYear(2002);
        $buildingAddress137->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress137->setHouseNumber(10);
        $buildingAddress137->setAddition('X');
        $buildingAddress137->setZipcode('1234AA');
        $buildingAddress137->setCity('Woonplaats A');
        $buildingAddress137->setRentalUnitNumber('VHE0000');
        $buildingAddress137->setDaeb(true);
        $buildingAddress137->setVtw($vtw1);
        $buildingAddress137->setResidentialArea($residentialArea10);
        $buildingAddress137->setBuildingType($buildingType10);
        $buildingAddress137->setLivingType($livingType3);
        $buildingAddress137->setCreationTime();
        $buildingAddress137->setLastChangeTime();
               
        $buildingAddress138 = new BuildingAddress();
        $buildingAddress138->setId(138);
        $buildingAddress138->setConstructionYear(1986);
        $buildingAddress138->setRenovationYear(2002);
        $buildingAddress138->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress138->setHouseNumber(10);
        $buildingAddress138->setAddition('X');
        $buildingAddress138->setZipcode('1234AA');
        $buildingAddress138->setCity('Woonplaats A');
        $buildingAddress138->setRentalUnitNumber('VHE0000');
        $buildingAddress138->setDaeb(true);
        $buildingAddress138->setVtw($vtw1);
        $buildingAddress138->setResidentialArea($residentialArea10);
        $buildingAddress138->setBuildingType($buildingType10);
        $buildingAddress138->setLivingType($livingType3);
        $buildingAddress138->setCreationTime();
        $buildingAddress138->setLastChangeTime();
                
        $buildingAddress139 = new BuildingAddress();
        $buildingAddress139->setId(139);
        $buildingAddress139->setConstructionYear(1986);
        $buildingAddress139->setRenovationYear(2002);
        $buildingAddress139->setStreetName('Ą ą Ę ę Straatnaam A');
        $buildingAddress139->setHouseNumber(10);
        $buildingAddress139->setAddition('X');
        $buildingAddress139->setZipcode('1234AA');
        $buildingAddress139->setCity('Woonplaats A');
        $buildingAddress139->setRentalUnitNumber('VHE0000');
        $buildingAddress139->setDaeb(true);
        $buildingAddress139->setVtw($vtw1);
        $buildingAddress139->setResidentialArea($residentialArea10);
        $buildingAddress139->setBuildingType($buildingType10);
        $buildingAddress139->setLivingType($livingType3);
        $buildingAddress139->setCreationTime();
        $buildingAddress139->setLastChangeTime();
        
        $buildingAddress140 = new BuildingAddress();
        $buildingAddress140->setId(140);
        $buildingAddress140->setConstructionYear(2010);
        $buildingAddress140->setRenovationYear(2010);
        $buildingAddress140->setStreetName('Straatnaam A');
        $buildingAddress140->setHouseNumber(102);
        $buildingAddress140->setAddition('');
        $buildingAddress140->setZipcode('1234AA');
        $buildingAddress140->setCity('Woonplaats A');
        $buildingAddress140->setRentalUnitNumber('VHE0000');
        $buildingAddress140->setDaeb(true);
        $buildingAddress140->setVtw($vtw1);
        $buildingAddress140->setResidentialArea($residentialArea4);
        $buildingAddress140->setBuildingType($buildingType4);
        $buildingAddress140->setLivingType($livingType1);
        $buildingAddress140->setCreationTime();
        $buildingAddress140->setLastChangeTime();
                
        $buildingAddress141 = new BuildingAddress();
        $buildingAddress141->setId(141);
        $buildingAddress141->setConstructionYear(2010);
        $buildingAddress141->setRenovationYear(2010);
        $buildingAddress141->setStreetName('Straatnaam A');
        $buildingAddress141->setHouseNumber(102);
        $buildingAddress141->setAddition('');
        $buildingAddress141->setZipcode('1234AA');
        $buildingAddress141->setCity('Woonplaats A');
        $buildingAddress141->setRentalUnitNumber('VHE0000');
        $buildingAddress141->setDaeb(true);
        $buildingAddress141->setVtw($vtw1);
        $buildingAddress141->setResidentialArea($residentialArea4);
        $buildingAddress141->setBuildingType($buildingType4);
        $buildingAddress141->setLivingType($livingType1);
        $buildingAddress141->setCreationTime();
        $buildingAddress141->setLastChangeTime();
                
        $buildingAddress142 = new BuildingAddress();
        $buildingAddress142->setId(142);
        $buildingAddress142->setConstructionYear(2010);
        $buildingAddress142->setRenovationYear(2010);
        $buildingAddress142->setStreetName('Straatnaam A');
        $buildingAddress142->setHouseNumber(102);
        $buildingAddress142->setAddition('');
        $buildingAddress142->setZipcode('1234AA');
        $buildingAddress142->setCity('Woonplaats A');
        $buildingAddress142->setRentalUnitNumber('VHE0000');
        $buildingAddress142->setDaeb(true);
        $buildingAddress142->setVtw($vtw1);
        $buildingAddress142->setResidentialArea($residentialArea4);
        $buildingAddress142->setBuildingType($buildingType4);
        $buildingAddress142->setLivingType($livingType1);
        $buildingAddress142->setCreationTime();
        $buildingAddress142->setLastChangeTime();
                
        $buildingAddress143 = new BuildingAddress();
        $buildingAddress143->setId(143);
        $buildingAddress143->setConstructionYear(2010);
        $buildingAddress143->setRenovationYear(2010);
        $buildingAddress143->setStreetName('Straatnaam A');
        $buildingAddress143->setHouseNumber(102);
        $buildingAddress143->setAddition('');
        $buildingAddress143->setZipcode('1234AA');
        $buildingAddress143->setCity('Woonplaats A');
        $buildingAddress143->setRentalUnitNumber('VHE0000');
        $buildingAddress143->setDaeb(true);
        $buildingAddress143->setVtw($vtw1);
        $buildingAddress143->setResidentialArea($residentialArea4);
        $buildingAddress143->setBuildingType($buildingType4);
        $buildingAddress143->setLivingType($livingType1);
        $buildingAddress143->setCreationTime();
        $buildingAddress143->setLastChangeTime();
                
        $buildingAddress144 = new BuildingAddress();
        $buildingAddress144->setId(144);
        $buildingAddress144->setConstructionYear(2010);
        $buildingAddress144->setRenovationYear(2010);
        $buildingAddress144->setStreetName('Straatnaam A');
        $buildingAddress144->setHouseNumber(102);
        $buildingAddress144->setAddition('');
        $buildingAddress144->setZipcode('1234AA');
        $buildingAddress144->setCity('Woonplaats A');
        $buildingAddress144->setRentalUnitNumber('VHE0000');
        $buildingAddress144->setDaeb(true);
        $buildingAddress144->setVtw($vtw1);
        $buildingAddress144->setResidentialArea($residentialArea4);
        $buildingAddress144->setBuildingType($buildingType4);
        $buildingAddress144->setLivingType($livingType1);
        $buildingAddress144->setCreationTime();
        $buildingAddress144->setLastChangeTime();
                
        $buildingAddress145 = new BuildingAddress();
        $buildingAddress145->setId(145);
        $buildingAddress145->setConstructionYear(2010);
        $buildingAddress145->setRenovationYear(2010);
        $buildingAddress145->setStreetName('Straatnaam A');
        $buildingAddress145->setHouseNumber(102);
        $buildingAddress145->setAddition('');
        $buildingAddress145->setZipcode('1234AA');
        $buildingAddress145->setCity('Woonplaats A');
        $buildingAddress145->setRentalUnitNumber('VHE0000');
        $buildingAddress145->setDaeb(true);
        $buildingAddress145->setVtw($vtw1);
        $buildingAddress145->setResidentialArea($residentialArea4);
        $buildingAddress145->setBuildingType($buildingType4);
        $buildingAddress145->setLivingType($livingType1);
        $buildingAddress145->setCreationTime();
        $buildingAddress145->setLastChangeTime();
                
        $buildingAddress146 = new BuildingAddress();
        $buildingAddress146->setId(146);
        $buildingAddress146->setConstructionYear(2010);
        $buildingAddress146->setRenovationYear(2010);
        $buildingAddress146->setStreetName('Straatnaam A');
        $buildingAddress146->setHouseNumber(102);
        $buildingAddress146->setAddition('');
        $buildingAddress146->setZipcode('1234AA');
        $buildingAddress146->setCity('Woonplaats A');
        $buildingAddress146->setRentalUnitNumber('VHE0000');
        $buildingAddress146->setDaeb(true);
        $buildingAddress146->setVtw($vtw1);
        $buildingAddress146->setResidentialArea($residentialArea4);
        $buildingAddress146->setBuildingType($buildingType4);
        $buildingAddress146->setLivingType($livingType1);
        $buildingAddress146->setCreationTime();
        $buildingAddress146->setLastChangeTime();
                
        $buildingAddress147 = new BuildingAddress();
        $buildingAddress147->setId(147);
        $buildingAddress147->setConstructionYear(2010);
        $buildingAddress147->setRenovationYear(2010);
        $buildingAddress147->setStreetName('Straatnaam A');
        $buildingAddress147->setHouseNumber(102);
        $buildingAddress147->setAddition('');
        $buildingAddress147->setZipcode('1234AA');
        $buildingAddress147->setCity('Woonplaats A');
        $buildingAddress147->setRentalUnitNumber('VHE0000');
        $buildingAddress147->setDaeb(true);
        $buildingAddress147->setVtw($vtw1);
        $buildingAddress147->setResidentialArea($residentialArea4);
        $buildingAddress147->setBuildingType($buildingType4);
        $buildingAddress147->setLivingType($livingType1);
        $buildingAddress147->setCreationTime();
        $buildingAddress147->setLastChangeTime();        
        
        $buildingAddress148 = new BuildingAddress();
        $buildingAddress148->setId(148);
        $buildingAddress148->setConstructionYear(2010);
        $buildingAddress148->setRenovationYear(2010);
        $buildingAddress148->setStreetName('Straatnaam A');
        $buildingAddress148->setHouseNumber(102);
        $buildingAddress148->setAddition('');
        $buildingAddress148->setZipcode('1234AA');
        $buildingAddress148->setCity('Woonplaats A');
        $buildingAddress148->setRentalUnitNumber('VHE0000');
        $buildingAddress148->setDaeb(true);
        $buildingAddress148->setVtw($vtw1);
        $buildingAddress148->setResidentialArea($residentialArea4);
        $buildingAddress148->setBuildingType($buildingType4);
        $buildingAddress148->setLivingType($livingType1);
        $buildingAddress148->setCreationTime();
        $buildingAddress148->setLastChangeTime();        
        
        $buildingAddress149 = new BuildingAddress();
        $buildingAddress149->setId(149);
        $buildingAddress149->setConstructionYear(2010);
        $buildingAddress149->setRenovationYear(2010);
        $buildingAddress149->setStreetName('Straatnaam A');
        $buildingAddress149->setHouseNumber(102);
        $buildingAddress149->setAddition('');
        $buildingAddress149->setZipcode('1234AA');
        $buildingAddress149->setCity('Woonplaats A');
        $buildingAddress149->setRentalUnitNumber('VHE0000');
        $buildingAddress149->setDaeb(true);
        $buildingAddress149->setVtw($vtw1);
        $buildingAddress149->setResidentialArea($residentialArea4);
        $buildingAddress149->setBuildingType($buildingType4);
        $buildingAddress149->setLivingType($livingType1);
        $buildingAddress149->setCreationTime();
        $buildingAddress149->setLastChangeTime();
                
        $buildingAddress150 = new BuildingAddress();
        $buildingAddress150->setId(150);
        $buildingAddress150->setConstructionYear(1888);
        $buildingAddress150->setRenovationYear(2005);
        $buildingAddress150->setStreetName('Straatnaam A');
        $buildingAddress150->setHouseNumber(10);
        $buildingAddress150->setAddition('A');
        $buildingAddress150->setZipcode('1234AA');
        $buildingAddress150->setCity('Woonplaats A');
        $buildingAddress150->setRentalUnitNumber('VHE0000');
        $buildingAddress150->setDaeb(true);
        $buildingAddress150->setVtw($vtw1);
        $buildingAddress150->setResidentialArea($residentialArea5);
        $buildingAddress150->setBuildingType($buildingType5);
        $buildingAddress150->setLivingType($livingType2);
        $buildingAddress150->setCreationTime();
        $buildingAddress150->setLastChangeTime();
                
        $buildingAddress151 = new BuildingAddress();
        $buildingAddress151->setId(151);
        $buildingAddress151->setConstructionYear(1888);
        $buildingAddress151->setRenovationYear(2005);
        $buildingAddress151->setStreetName('Straatnaam A');
        $buildingAddress151->setHouseNumber(10);
        $buildingAddress151->setAddition('A');
        $buildingAddress151->setZipcode('1234AA');
        $buildingAddress151->setCity('Woonplaats A');
        $buildingAddress151->setRentalUnitNumber('VHE0000');
        $buildingAddress151->setDaeb(true);
        $buildingAddress151->setVtw($vtw1);
        $buildingAddress151->setResidentialArea($residentialArea5);
        $buildingAddress151->setBuildingType($buildingType5);
        $buildingAddress151->setLivingType($livingType2);
        $buildingAddress151->setCreationTime();
        $buildingAddress151->setLastChangeTime();
                
        $buildingAddress152 = new BuildingAddress();
        $buildingAddress152->setId(152);
        $buildingAddress152->setConstructionYear(1888);
        $buildingAddress152->setRenovationYear(2005);
        $buildingAddress152->setStreetName('Straatnaam A');
        $buildingAddress152->setHouseNumber(10);
        $buildingAddress152->setAddition('A');
        $buildingAddress152->setZipcode('1234AA');
        $buildingAddress152->setCity('Woonplaats A');
        $buildingAddress152->setRentalUnitNumber('VHE0000');
        $buildingAddress152->setDaeb(true);
        $buildingAddress152->setVtw($vtw1);
        $buildingAddress152->setResidentialArea($residentialArea5);
        $buildingAddress152->setBuildingType($buildingType5);
        $buildingAddress152->setLivingType($livingType2);
        $buildingAddress152->setCreationTime();
        $buildingAddress152->setLastChangeTime();
                
        $buildingAddress153 = new BuildingAddress();
        $buildingAddress153->setId(153);
        $buildingAddress153->setConstructionYear(1888);
        $buildingAddress153->setRenovationYear(2005);
        $buildingAddress153->setStreetName('Straatnaam A');
        $buildingAddress153->setHouseNumber(10);
        $buildingAddress153->setAddition('A');
        $buildingAddress153->setZipcode('1234AA');
        $buildingAddress153->setCity('Woonplaats A');
        $buildingAddress153->setRentalUnitNumber('VHE0000');
        $buildingAddress153->setDaeb(true);
        $buildingAddress153->setVtw($vtw1);
        $buildingAddress153->setResidentialArea($residentialArea5);
        $buildingAddress153->setBuildingType($buildingType5);
        $buildingAddress153->setLivingType($livingType2);
        $buildingAddress153->setCreationTime();
        $buildingAddress153->setLastChangeTime();
                
        $buildingAddress154 = new BuildingAddress();
        $buildingAddress154->setId(154);
        $buildingAddress154->setConstructionYear(1888);
        $buildingAddress154->setRenovationYear(2005);
        $buildingAddress154->setStreetName('Straatnaam A');
        $buildingAddress154->setHouseNumber(10);
        $buildingAddress154->setAddition('A');
        $buildingAddress154->setZipcode('1234AA');
        $buildingAddress154->setCity('Woonplaats A');
        $buildingAddress154->setRentalUnitNumber('VHE0000');
        $buildingAddress154->setDaeb(true);
        $buildingAddress154->setVtw($vtw1);    
        $buildingAddress154->setResidentialArea($residentialArea5);
        $buildingAddress154->setBuildingType($buildingType5);
        $buildingAddress154->setLivingType($livingType2);
        $buildingAddress154->setCreationTime();
        $buildingAddress154->setLastChangeTime();
                       
        $buildingAddress155 = new BuildingAddress();
        $buildingAddress155->setId(155);
        $buildingAddress155->setConstructionYear(1888);
        $buildingAddress155->setRenovationYear(2005);
        $buildingAddress155->setStreetName('Straatnaam A');
        $buildingAddress155->setHouseNumber(10);
        $buildingAddress155->setAddition('A');
        $buildingAddress155->setZipcode('1234AA');
        $buildingAddress155->setCity('Woonplaats A');
        $buildingAddress155->setRentalUnitNumber('VHE0000');
        $buildingAddress155->setDaeb(true);
        $buildingAddress155->setVtw($vtw1);
        $buildingAddress155->setResidentialArea($residentialArea5);
        $buildingAddress155->setBuildingType($buildingType5);
        $buildingAddress155->setLivingType($livingType2);
        $buildingAddress155->setCreationTime();
        $buildingAddress155->setLastChangeTime();
                
        $buildingAddress156 = new BuildingAddress();
        $buildingAddress156->setId(156);
        $buildingAddress156->setConstructionYear(1888);
        $buildingAddress156->setRenovationYear(2005);
        $buildingAddress156->setStreetName('Straatnaam A');
        $buildingAddress156->setHouseNumber(10);
        $buildingAddress156->setAddition('A');
        $buildingAddress156->setZipcode('1234AA');
        $buildingAddress156->setCity('Woonplaats A');
        $buildingAddress156->setRentalUnitNumber('VHE0000');
        $buildingAddress156->setDaeb(true);
        $buildingAddress156->setVtw($vtw1);
        $buildingAddress156->setResidentialArea($residentialArea5);
        $buildingAddress156->setBuildingType($buildingType5);
        $buildingAddress156->setLivingType($livingType2);
        $buildingAddress156->setCreationTime();
        $buildingAddress156->setLastChangeTime();
                
        $buildingAddress157 = new BuildingAddress();
        $buildingAddress157->setId(157);
        $buildingAddress157->setStreetName('Straatnaam A');
        $buildingAddress157->setHouseNumber(10);
        $buildingAddress157->setAddition('A');
        $buildingAddress157->setZipcode('1234AA');
        $buildingAddress157->setCity('Woonplaats A');
        $buildingAddress157->setRentalUnitNumber('VHE0000');
        $buildingAddress157->setDaeb(true);
        $buildingAddress157->setVtw($vtw1);
        $buildingAddress157->setResidentialArea($residentialArea5);
        $buildingAddress157->setBuildingType($buildingType5);
        $buildingAddress157->setLivingType($livingType2);
        $buildingAddress157->setCreationTime();
        $buildingAddress157->setLastChangeTime();
                
        $buildingAddress158 = new BuildingAddress();
        $buildingAddress158->setId(158);
        $buildingAddress158->setConstructionYear(1888);
        $buildingAddress158->setRenovationYear(2005);
        $buildingAddress158->setStreetName('Straatnaam A');
        $buildingAddress158->setHouseNumber(10);
        $buildingAddress158->setAddition('A');
        $buildingAddress158->setZipcode('1234AA');
        $buildingAddress158->setCity('Woonplaats A');
        $buildingAddress158->setRentalUnitNumber('VHE0000');
        $buildingAddress158->setDaeb(true);
        $buildingAddress158->setVtw($vtw1);
        $buildingAddress158->setResidentialArea($residentialArea5);
        $buildingAddress158->setBuildingType($buildingType5);
        $buildingAddress158->setLivingType($livingType2);
        $buildingAddress158->setCreationTime();
        $buildingAddress158->setLastChangeTime();
       
        $buildingAddress159 = new BuildingAddress();
        $buildingAddress159->setId(159);
        $buildingAddress159->setConstructionYear(1888);
        $buildingAddress159->setRenovationYear(2005);
        $buildingAddress159->setStreetName('Straatnaam A');
        $buildingAddress159->setHouseNumber(10);
        $buildingAddress159->setAddition('A');
        $buildingAddress159->setZipcode('1234AA');
        $buildingAddress159->setCity('Woonplaats A');
        $buildingAddress159->setRentalUnitNumber('VHE0000');
        $buildingAddress159->setDaeb(true);
        $buildingAddress159->setVtw($vtw1);
        $buildingAddress159->setResidentialArea($residentialArea5);
        $buildingAddress159->setBuildingType($buildingType5);
        $buildingAddress159->setLivingType($livingType2);
        $buildingAddress159->setCreationTime();
        $buildingAddress159->setLastChangeTime();

        $buildingAddress160 = new BuildingAddress();
        $buildingAddress160->setId(160);
        $buildingAddress160->setConstructionYear(1908);
        $buildingAddress160->setRenovationYear(200);
        $buildingAddress160->setStreetName('Straatnaam A');
        $buildingAddress160->setHouseNumber(10);
        $buildingAddress160->setAddition('A');
        $buildingAddress160->setZipcode('1234AA');
        $buildingAddress160->setCity('Woonplaats A');
        $buildingAddress160->setRentalUnitNumber('VHE0000');
        $buildingAddress160->setDaeb(true);
        $buildingAddress160->setVtw($vtw1);
        $buildingAddress160->setResidentialArea($residentialArea6);
        $buildingAddress160->setBuildingType($buildingType6);
        $buildingAddress160->setLivingType($livingType2);
        $buildingAddress160->setCreationTime();
        $buildingAddress160->setLastChangeTime();
                
        $buildingAddress161 = new BuildingAddress();
        $buildingAddress161->setId(161);
        $buildingAddress161->setConstructionYear(1908);
        $buildingAddress161->setRenovationYear(200);
        $buildingAddress161->setStreetName('Straatnaam A');
        $buildingAddress161->setHouseNumber(10);
        $buildingAddress161->setAddition('A');
        $buildingAddress161->setZipcode('1234AA');
        $buildingAddress161->setCity('Woonplaats A');
        $buildingAddress161->setRentalUnitNumber('VHE0000');
        $buildingAddress161->setDaeb(true);
        $buildingAddress161->setVtw($vtw1);
        $buildingAddress161->setResidentialArea($residentialArea6);
        $buildingAddress161->setBuildingType($buildingType6);
        $buildingAddress161->setLivingType($livingType2);
        $buildingAddress161->setCreationTime();
        $buildingAddress161->setLastChangeTime();
                
        $buildingAddress162 = new BuildingAddress();
        $buildingAddress162->setId(162);
        $buildingAddress162->setConstructionYear(1908);
        $buildingAddress162->setRenovationYear(200);
        $buildingAddress162->setStreetName('Straatnaam A');
        $buildingAddress162->setHouseNumber(10);
        $buildingAddress162->setAddition('A');
        $buildingAddress162->setZipcode('1234AA');
        $buildingAddress162->setCity('Woonplaats A');
        $buildingAddress162->setRentalUnitNumber('VHE0000');
        $buildingAddress162->setDaeb(true);
        $buildingAddress162>setVtw($vtw1);
        $buildingAddress162->setResidentialArea($residentialArea6);
        $buildingAddress162->setBuildingType($buildingType6);
        $buildingAddress162->setLivingType($livingType2);
        $buildingAddress162->setCreationTime();
        $buildingAddress162->setLastChangeTime();
                
        $buildingAddress163 = new BuildingAddress();
        $buildingAddress163->setId(163);
        $buildingAddress163->setConstructionYear(1908);
        $buildingAddress163->setRenovationYear(200);
        $buildingAddress163->setStreetName('Straatnaam A');
        $buildingAddress163->setHouseNumber(10);
        $buildingAddress163->setAddition('A');
        $buildingAddress163->setZipcode('1234AA');
        $buildingAddress163->setCity('Woonplaats A');
        $buildingAddress163->setRentalUnitNumber('VHE0000');
        $buildingAddress163->setDaeb(true);
        $buildingAddress163->setVtw($vtw1);
        $buildingAddress163->setResidentialArea($residentialArea6);
        $buildingAddress163->setBuildingType($buildingType6);
        $buildingAddress163->setLivingType($livingType2);
        $buildingAddress163->setCreationTime();
        $buildingAddress163->setLastChangeTime();
                
        $buildingAddress164 = new BuildingAddress();
        $buildingAddress164->setId(164);
        $buildingAddress164->setConstructionYear(1908);
        $buildingAddress164->setRenovationYear(200);
        $buildingAddress164->setStreetName('Straatnaam A');
        $buildingAddress164->setHouseNumber(10);
        $buildingAddress164->setAddition('A');
        $buildingAddress164->setZipcode('1234AA');
        $buildingAddress164->setCity('Woonplaats A');
        $buildingAddress164->setRentalUnitNumber('VHE0000');
        $buildingAddress164->setDaeb(true);
        $buildingAddress164->setVtw($vtw1);
        $buildingAddress164->setResidentialArea($residentialArea6);
        $buildingAddress164->setBuildingType($buildingType6);
        $buildingAddress164->setLivingType($livingType2);
        $buildingAddress164->setCreationTime();
        $buildingAddress164->setLastChangeTime();
                
        $buildingAddress165 = new BuildingAddress();
        $buildingAddress165->setId(165);
        $buildingAddress165->setConstructionYear(1908);
        $buildingAddress165->setRenovationYear(200);
        $buildingAddress165->setStreetName('Straatnaam A');
        $buildingAddress165->setHouseNumber(10);
        $buildingAddress165->setAddition('A');
        $buildingAddress165->setZipcode('1234AA');
        $buildingAddress165->setCity('Woonplaats A');
        $buildingAddress165->setRentalUnitNumber('VHE0000');
        $buildingAddress165->setDaeb(true);
        $buildingAddress165->setVtw($vtw1);
        $buildingAddress165->setResidentialArea($residentialArea6);
        $buildingAddress165->setBuildingType($buildingType6);
        $buildingAddress165->setLivingType($livingType2);
        $buildingAddress165->setCreationTime();
        $buildingAddress165->setLastChangeTime();
                
        $buildingAddress166 = new BuildingAddress();
        $buildingAddress166->setId(166);
        $buildingAddress166->setConstructionYear(1908);
        $buildingAddress166->setRenovationYear(200);
        $buildingAddress166->setStreetName('Straatnaam A');
        $buildingAddress166->setHouseNumber(10);
        $buildingAddress166->setAddition('A');
        $buildingAddress166->setZipcode('1234AA');
        $buildingAddress166->setCity('Woonplaats A');
        $buildingAddress166->setRentalUnitNumber('VHE0000');
        $buildingAddress166->setDaeb(true);
        $buildingAddress166->setVtw($vtw1);
        $buildingAddress166->setResidentialArea($residentialArea6);
        $buildingAddress166->setBuildingType($buildingType6);
        $buildingAddress166->setLivingType($livingType2);
        $buildingAddress166->setCreationTime();
        $buildingAddress166->setLastChangeTime();
                
        $buildingAddress167 = new BuildingAddress();
        $buildingAddress167->setId(167);
        $buildingAddress167->setConstructionYear(1908);
        $buildingAddress167->setRenovationYear(200);
        $buildingAddress167->setStreetName('Straatnaam A');
        $buildingAddress167->setHouseNumber(10);
        $buildingAddress167->setAddition('A');
        $buildingAddress167->setZipcode('1234AA');
        $buildingAddress167->setCity('Woonplaats A');
        $buildingAddress167->setRentalUnitNumber('VHE0000');
        $buildingAddress167->setDaeb(true);
        $buildingAddress167->setVtw($vtw1);
        $buildingAddress167->setResidentialArea($residentialArea6);
        $buildingAddress167->setBuildingType($buildingType6);
        $buildingAddress167->setLivingType($livingType2);
        $buildingAddress167->setCreationTime();
        $buildingAddress167->setLastChangeTime();
                
        $buildingAddress168 = new BuildingAddress();
        $buildingAddress168->setId(168);
        $buildingAddress168->setConstructionYear(1908);
        $buildingAddress168->setRenovationYear(200);
        $buildingAddress168->setStreetName('Straatnaam A');
        $buildingAddress168->setHouseNumber(10);
        $buildingAddress168->setAddition('A');
        $buildingAddress168->setZipcode('1234AA');
        $buildingAddress168->setCity('Woonplaats A');
        $buildingAddress168->setRentalUnitNumber('VHE0000');
        $buildingAddress168->setDaeb(true);
        $buildingAddress168->setVtw($vtw1);
        $buildingAddress168->setResidentialArea($residentialArea6);
        $buildingAddress168->setBuildingType($buildingType6);
        $buildingAddress168->setLivingType($livingType2);
        $buildingAddress168->setCreationTime();
        $buildingAddress168->setLastChangeTime();
                
        $buildingAddress169 = new BuildingAddress();
        $buildingAddress169->setId(169);
        $buildingAddress169->setConstructionYear(1908);
        $buildingAddress169->setRenovationYear(200);
        $buildingAddress169->setStreetName('Straatnaam A');
        $buildingAddress169->setHouseNumber(10);
        $buildingAddress169->setAddition('A');
        $buildingAddress169->setZipcode('1234AA');
        $buildingAddress169->setCity('Woonplaats A');
        $buildingAddress169->setRentalUnitNumber('VHE0000');
        $buildingAddress169->setDaeb(true);
        $buildingAddress169->setVtw($vtw1);
        $buildingAddress169->setResidentialArea($residentialArea6);
        $buildingAddress169->setBuildingType($buildingType6);
        $buildingAddress169->setLivingType($livingType2);
        $buildingAddress169->setCreationTime();
        $buildingAddress169->setLastChangeTime();
                
        $buildingAddress170 = new BuildingAddress();
        $buildingAddress170->setId(170);
        $buildingAddress170->setConstructionYear(2006);
        $buildingAddress170->setRenovationYear(2006);
        $buildingAddress170->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress170->setHouseNumber(10);
        $buildingAddress170->setAddition('A');
        $buildingAddress170->setZipcode('1234AA');
        $buildingAddress170->setCity('Woonplaats A');
        $buildingAddress170->setRentalUnitNumber('VHE0000');
        $buildingAddress170->setDaeb(true);
        $buildingAddress170->setVtw($vtw1);
        $buildingAddress170->setResidentialArea($residentialArea7);
        $buildingAddress170->setBuildingType($buildingType7);
        $buildingAddress170->setLivingType($livingType2);
        $buildingAddress170->setCreationTime();
        $buildingAddress170->setLastChangeTime();
                
        $buildingAddress171 = new BuildingAddress();
        $buildingAddress171->setId(171);
        $buildingAddress171->setConstructionYear(2006);
        $buildingAddress171->setRenovationYear(2006);
        $buildingAddress171->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress171->setHouseNumber(10);
        $buildingAddress171->setAddition('A');
        $buildingAddress171->setZipcode('1234AA');
        $buildingAddress171->setCity('Woonplaats A');
        $buildingAddress171->setRentalUnitNumber('VHE0000');
        $buildingAddress171->setDaeb(true);
        $buildingAddress171->setVtw($vtw1);
        $buildingAddress171->setResidentialArea($residentialArea7);
        $buildingAddress171->setBuildingType($buildingType7);
        $buildingAddress171->setLivingType($livingType2);
        $buildingAddress171->setCreationTime();
        $buildingAddress171->setLastChangeTime();
                
        $buildingAddress172 = new BuildingAddress();
        $buildingAddress172->setId(172);
        $buildingAddress172->setConstructionYear(2006);
        $buildingAddress172->setRenovationYear(2006);
        $buildingAddress172->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress172->setHouseNumber(10);
        $buildingAddress172->setAddition('A');
        $buildingAddress172->setZipcode('1234AA');
        $buildingAddress172->setCity('Woonplaats A');
        $buildingAddress172->setRentalUnitNumber('VHE0000');
        $buildingAddress172->setDaeb(true);
        $buildingAddress172->setVtw($vtw1);
        $buildingAddress172->setResidentialArea($residentialArea7);
        $buildingAddress172->setBuildingType($buildingType7);
        $buildingAddress172->setLivingType($livingType2);
        $buildingAddress172->setCreationTime();
        $buildingAddress172->setLastChangeTime();
                
        $buildingAddress173 = new BuildingAddress();
        $buildingAddress173->setId(173);
        $buildingAddress173->setConstructionYear(2006);
        $buildingAddress173->setRenovationYear(2006);
        $buildingAddress173->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress173->setHouseNumber(10);
        $buildingAddress173->setAddition('A');
        $buildingAddress173->setZipcode('1234AA');
        $buildingAddress173->setCity('Woonplaats A');
        $buildingAddress173->setRentalUnitNumber('VHE0000');
        $buildingAddress173->setDaeb(true);
        $buildingAddress173->setVtw($vtw1);
        $buildingAddress173->setResidentialArea($residentialArea7);
        $buildingAddress173->setBuildingType($buildingType7);
        $buildingAddress173->setLivingType($livingType2);
        $buildingAddress173->setCreationTime();
        $buildingAddress173->setLastChangeTime();
                
        $buildingAddress174 = new BuildingAddress();
        $buildingAddress174->setId(174);
        $buildingAddress174->setConstructionYear(2006);
        $buildingAddress174->setRenovationYear(2006);
        $buildingAddress174->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress174->setHouseNumber(10);
        $buildingAddress174->setAddition('A');
        $buildingAddress174->setZipcode('1234AA');
        $buildingAddress174->setCity('Woonplaats A');
        $buildingAddress174->setRentalUnitNumber('VHE0000');
        $buildingAddress174->setDaeb(true);
        $buildingAddress174->setVtw($vtw1);
        $buildingAddress174->setResidentialArea($residentialArea7);
        $buildingAddress174->setBuildingType($buildingType7);
        $buildingAddress174->setLivingType($livingType2);
        $buildingAddress174->setCreationTime();
        $buildingAddress174->setLastChangeTime();
                
        $buildingAddress175 = new BuildingAddress();
        $buildingAddress175->setId(175);
        $buildingAddress175->setConstructionYear(2006);
        $buildingAddress175->setRenovationYear(2006);
        $buildingAddress175->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress175->setHouseNumber(10);
        $buildingAddress175->setAddition('A');
        $buildingAddress175->setZipcode('1234AA');
        $buildingAddress175->setCity('Woonplaats A');
        $buildingAddress175->setRentalUnitNumber('VHE0000');
        $buildingAddress175->setDaeb(true);
        $buildingAddress175->setVtw($vtw1);
        $buildingAddress175->setResidentialArea($residentialArea7);
        $buildingAddress175->setBuildingType($buildingType7);
        $buildingAddress175->setLivingType($livingType2);
        $buildingAddress175->setCreationTime();
        $buildingAddress175->setLastChangeTime();
                 
        $buildingAddress176 = new BuildingAddress();
        $buildingAddress176->setId(176);
        $buildingAddress176->setConstructionYear(2006);
        $buildingAddress176->setRenovationYear(2006);
        $buildingAddress176->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress176->setHouseNumber(10);
        $buildingAddress176->setAddition('A');
        $buildingAddress176->setZipcode('1234AA');
        $buildingAddress176->setCity('Woonplaats A');
        $buildingAddress176->setRentalUnitNumber('VHE0000');
        $buildingAddress176->setDaeb(true);
        $buildingAddress176->setVtw($vtw1);
        $buildingAddress176->setResidentialArea($residentialArea7);
        $buildingAddress176->setBuildingType($buildingType7);
        $buildingAddress176->setLivingType($livingType2);
        $buildingAddress176->setCreationTime();
        $buildingAddress176->setLastChangeTime();        
        
        $buildingAddress177 = new BuildingAddress();
        $buildingAddress177->setId(177);
        $buildingAddress177->setConstructionYear(2006);
        $buildingAddress177->setRenovationYear(2006);
        $buildingAddress177->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress177->setHouseNumber(10);
        $buildingAddress177->setAddition('A');
        $buildingAddress177->setZipcode('1234AA');
        $buildingAddress177->setCity('Woonplaats A');
        $buildingAddress177->setRentalUnitNumber('VHE0000');
        $buildingAddress177->setDaeb(true);
        $buildingAddress177->setVtw($vtw1);
        $buildingAddress177->setResidentialArea($residentialArea7);
        $buildingAddress177->setBuildingType($buildingType7);
        $buildingAddress177->setLivingType($livingType2);
        $buildingAddress177->setCreationTime();
        $buildingAddress177->setLastChangeTime();
                
        $buildingAddress178 = new BuildingAddress();
        $buildingAddress178->setId(178);
        $buildingAddress178->setConstructionYear(2006);
        $buildingAddress178->setRenovationYear(2006);
        $buildingAddress178->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress178->setHouseNumber(10);
        $buildingAddress178->setAddition('A');
        $buildingAddress178->setZipcode('1234AA');
        $buildingAddress178->setCity('Woonplaats A');
        $buildingAddress178->setRentalUnitNumber('VHE0000');
        $buildingAddress178->setDaeb(true);
        $buildingAddress178->setVtw($vtw1);
        $buildingAddress178->setResidentialArea($residentialArea7);
        $buildingAddress178->setBuildingType($buildingType7);
        $buildingAddress178->setLivingType($livingType2);
        $buildingAddress178->setCreationTime();
        $buildingAddress178->setLastChangeTime();
                
        $buildingAddress179 = new BuildingAddress();
        $buildingAddress179->setId(179);
        $buildingAddress179->setConstructionYear(2006);
        $buildingAddress179->setRenovationYear(2006);
        $buildingAddress179->setStreetName('Æ æ Œ œ Straatnaam A');
        $buildingAddress179->setHouseNumber(10);
        $buildingAddress179->setAddition('A');
        $buildingAddress179->setZipcode('1234AA');
        $buildingAddress179->setCity('Woonplaats A');
        $buildingAddress179->setRentalUnitNumber('VHE0000');
        $buildingAddress179->setDaeb(true);
        $buildingAddress179->setVtw($vtw1);
        $buildingAddress179->setResidentialArea($residentialArea7);
        $buildingAddress179->setBuildingType($buildingType7);
        $buildingAddress179->setLivingType($livingType2);
        $buildingAddress179->setCreationTime();
        $buildingAddress179->setLastChangeTime();
      
        $buildingAddress180 = new BuildingAddress();
        $buildingAddress180->setId(180);
        $buildingAddress180->setConstructionYear(2026);
        $buildingAddress180->setRenovationYear(2081);
        $buildingAddress180->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress180->setHouseNumber(10);
        $buildingAddress180->setAddition('Bis');
        $buildingAddress180->setZipcode('1234AAB');
        $buildingAddress180->setCity('Woonplaats A');
        $buildingAddress180->setRentalUnitNumber('VHE0000');
        $buildingAddress180->setDaeb(false);
        $buildingAddress180->setVtw($vtw1);
        $buildingAddress180->setResidentialArea($residentialArea8);
        $buildingAddress180->setBuildingType($buildingType8);
        $buildingAddress180->setLivingType($livingType2);
        $buildingAddress180->setCreationTime();
        $buildingAddress180->setLastChangeTime();
                
        $buildingAddress181 = new BuildingAddress();
        $buildingAddress181->setId(181);
        $buildingAddress181->setConstructionYear(2026);
        $buildingAddress181->setRenovationYear(2081);
        $buildingAddress181->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress181->setHouseNumber(10);
        $buildingAddress181->setAddition('Bis');
        $buildingAddress181->setZipcode('1234AAB');
        $buildingAddress181->setCity('Woonplaats A');
        $buildingAddress181->setRentalUnitNumber('VHE0000');
        $buildingAddress181->setDaeb(false);
        $buildingAddress181->setVtw($vtw1);
        $buildingAddress181->setResidentialArea($residentialArea8);
        $buildingAddress181->setBuildingType($buildingType8);
        $buildingAddress181->setLivingType($livingType2);
        $buildingAddress181->setCreationTime();
        $buildingAddress181->setLastChangeTime();
                
        $buildingAddress182 = new BuildingAddress();
        $buildingAddress182->setId(182);
        $buildingAddress182->setConstructionYear(2026);
        $buildingAddress182->setRenovationYear(2081);
        $buildingAddress182->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress182->setHouseNumber(10);
        $buildingAddress182->setAddition('Bis');
        $buildingAddress182->setZipcode('1234AAB');
        $buildingAddress182->setCity('Woonplaats A');
        $buildingAddress182->setRentalUnitNumber('VHE0000');
        $buildingAddress182->setDaeb(false);
        $buildingAddress182->setVtw($vtw1);
        $buildingAddress182->setResidentialArea($residentialArea8);
        $buildingAddress182->setBuildingType($buildingType8);
        $buildingAddress182->setLivingType($livingType2);
        $buildingAddress182->setCreationTime();
        $buildingAddress182->setLastChangeTime();
                
        $buildingAddress183 = new BuildingAddress();
        $buildingAddress183->setId(183);
        $buildingAddress183->setConstructionYear(2026);
        $buildingAddress183->setRenovationYear(2081);
        $buildingAddress183->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress183->setHouseNumber(10);
        $buildingAddress183->setAddition('Bis');
        $buildingAddress183->setZipcode('1234AAB');
        $buildingAddress183->setCity('Woonplaats A');
        $buildingAddress183->setRentalUnitNumber('VHE0000');
        $buildingAddress183->setDaeb(false);
        $buildingAddress183->setVtw($vtw1);
        $buildingAddress183->setResidentialArea($residentialArea8);
        $buildingAddress183->setBuildingType($buildingType8);
        $buildingAddress183->setLivingType($livingType2);
        $buildingAddress183->setCreationTime();
        $buildingAddress183->setLastChangeTime();
                
        $buildingAddress184 = new BuildingAddress();
        $buildingAddress184->setId(184);
        $buildingAddress184->setConstructionYear(2026);
        $buildingAddress184->setRenovationYear(2081);
        $buildingAddress184->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress184->setHouseNumber(10);
        $buildingAddress184->setAddition('Bis');
        $buildingAddress184->setZipcode('1234AAB');
        $buildingAddress184->setCity('Woonplaats A');
        $buildingAddress184->setRentalUnitNumber('VHE0000');
        $buildingAddress184->setDaeb(false);
        $buildingAddress184->setVtw($vtw1);
        $buildingAddress184->setResidentialArea($residentialArea8);
        $buildingAddress184->setBuildingType($buildingType8);
        $buildingAddress184->setLivingType($livingType2);
        $buildingAddress184->setCreationTime();
        $buildingAddress184->setLastChangeTime();
               
        $buildingAddress185 = new BuildingAddress();
        $buildingAddress185->setId(185);
        $buildingAddress185->setConstructionYear(2026);
        $buildingAddress185->setRenovationYear(2081);
        $buildingAddress185->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress185->setHouseNumber(10);
        $buildingAddress185->setAddition('Bis');
        $buildingAddress185->setZipcode('1234AAB');
        $buildingAddress185->setCity('Woonplaats A');
        $buildingAddress185->setRentalUnitNumber('VHE0000');
        $buildingAddress185->setDaeb(false);
        $buildingAddress185->setVtw($vtw1);
        $buildingAddress185->setResidentialArea($residentialArea8);
        $buildingAddress185->setBuildingType($buildingType8);
        $buildingAddress185->setLivingType($livingType2);
        $buildingAddress185->setCreationTime();
        $buildingAddress185->setLastChangeTime();
                
        $buildingAddress186 = new BuildingAddress();
        $buildingAddress186->setId(186);
        $buildingAddress186->setConstructionYear(2026);
        $buildingAddress186->setRenovationYear(2081);
        $buildingAddress186->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress186->setHouseNumber(10);
        $buildingAddress186->setAddition('Bis');
        $buildingAddress186->setZipcode('1234AAB');
        $buildingAddress186->setCity('Woonplaats A');
        $buildingAddress186->setRentalUnitNumber('VHE0000');
        $buildingAddress186->setDaeb(false);
        $buildingAddress186->setVtw($vtw1);
        $buildingAddress186->setResidentialArea($residentialArea8);
        $buildingAddress186->setBuildingType($buildingType8);
        $buildingAddress186->setLivingType($livingType2);
        $buildingAddress186->setCreationTime();
        $buildingAddress186->setLastChangeTime();
                
        $buildingAddress187 = new BuildingAddress();
        $buildingAddress187->setId(187);
        $buildingAddress187->setConstructionYear(2026);
        $buildingAddress187->setRenovationYear(2081);
        $buildingAddress187->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress187->setHouseNumber(10);
        $buildingAddress187->setAddition('Bis');
        $buildingAddress187->setZipcode('1234AAB');
        $buildingAddress187->setCity('Woonplaats A');
        $buildingAddress187->setRentalUnitNumber('VHE0000');
        $buildingAddress187->setDaeb(false);
        $buildingAddress187->setVtw($vtw1);
        $buildingAddress187->setResidentialArea($residentialArea8);
        $buildingAddress187->setBuildingType($buildingType8);
        $buildingAddress187->setLivingType($livingType2);
        $buildingAddress187->setCreationTime();
        $buildingAddress187->setLastChangeTime();
                            
        $buildingAddress188 = new BuildingAddress();
        $buildingAddress188->setId(188);
        $buildingAddress188->setConstructionYear(2026);
        $buildingAddress188->setRenovationYear(2081);
        $buildingAddress188->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
        $buildingAddress188->setHouseNumber(10);
        $buildingAddress188->setAddition('Bis');
        $buildingAddress188->setZipcode('1234AAB');
        $buildingAddress188->setCity('Woonplaats A');
        $buildingAddress188->setRentalUnitNumber('VHE0000');
        $buildingAddress188->setDaeb(false);
        $buildingAddress188->setVtw($vtw1);
        $buildingAddress188->setResidentialArea($residentialArea8);
        $buildingAddress188->setBuildingType($buildingType8);
        $buildingAddress188->setLivingType($livingType2);
        $buildingAddress188->setCreationTime();
        $buildingAddress188->setLastChangeTime();
           
        $buildingAddress189 = new BuildingAddress();
        $buildingAddress189->setId(189);
        $buildingAddress189->setConstructionYear(1976);
        $buildingAddress189->setRenovationYear(2001);
        $buildingAddress189->setStreetName('Straatnaam A');
        $buildingAddress189->setHouseNumber(10);
        $buildingAddress189->setAddition('I');
        $buildingAddress189->setZipcode('12334AA');
        $buildingAddress189->setCity('Woonplaats A');
        $buildingAddress189->setRentalUnitNumber('VHE0000');
        $buildingAddress189->setDaeb(true);
        $buildingAddress189->setVtw($vtw1);
        $buildingAddress189->setResidentialArea($residentialArea9);
        $buildingAddress189->setBuildingType($buildingType9);
        $buildingAddress189->setLivingType($livingType2);
        $buildingAddress189->setCreationTime();
        $buildingAddress189->setLastChangeTime();     
       
        $buildingAddress190 = new BuildingAddress();
        $buildingAddress190->setId(190);
        $buildingAddress190->setConstructionYear(1976);
        $buildingAddress190->setRenovationYear(2001);
        $buildingAddress190->setStreetName('Straatnaam A');
        $buildingAddress190->setHouseNumber(10);
        $buildingAddress190->setAddition('I');
        $buildingAddress190->setZipcode('12334AA');
        $buildingAddress190->setCity('Woonplaats A');
        $buildingAddress190->setRentalUnitNumber('VHE0000');
        $buildingAddress190->setDaeb(true);
        $buildingAddress190->setVtw($vtw10);
        $buildingAddress190->setResidentialArea($residentialArea9);
        $buildingAddress190->setBuildingType($buildingType9);
        $buildingAddress190->setLivingType($livingType2);
        $buildingAddress190->setCreationTime();
        $buildingAddress190->setLastChangeTime();
                
        $buildingAddress191 = new BuildingAddress();
        $buildingAddress191->setId(191);
        $buildingAddress191->setConstructionYear(1976);
        $buildingAddress191->setRenovationYear(2001);
        $buildingAddress191->setStreetName('Straatnaam A');
        $buildingAddress191->setHouseNumber(10);
        $buildingAddress191->setAddition('I');
        $buildingAddress191->setZipcode('12334AA');
        $buildingAddress191->setCity('Woonplaats A');
        $buildingAddress191->setRentalUnitNumber('VHE0000');
        $buildingAddress191->setDaeb(true);
        $buildingAddress191->setVtw($vtw2);
        $buildingAddress191->setResidentialArea($residentialArea9);
        $buildingAddress191->setBuildingType($buildingType9);
        $buildingAddress191->setLivingType($livingType2);
        $buildingAddress191->setCreationTime();
        $buildingAddress191->setLastChangeTime();
                
        $buildingAddress192 = new BuildingAddress();
        $buildingAddress192->setId(192);
        $buildingAddress192->setConstructionYear(1976);
        $buildingAddress192->setRenovationYear(2001);
        $buildingAddress192->setStreetName('Straatnaam A');
        $buildingAddress192->setHouseNumber(10);
        $buildingAddress192->setAddition('I');
        $buildingAddress192->setZipcode('12334AA');
        $buildingAddress192->setCity('Woonplaats A');
        $buildingAddress192->setRentalUnitNumber('VHE0000');
        $buildingAddress192->setDaeb(true);
        $buildingAddress192->setVtw($vtw3);
        $buildingAddress192->setResidentialArea($residentialArea9);
        $buildingAddress192->setBuildingType($buildingType9);
        $buildingAddress192->setLivingType($livingType2);
        $buildingAddress192->setCreationTime();
        $buildingAddress192->setLastChangeTime();
                
        $buildingAddress193 = new BuildingAddress();
        $buildingAddress193->setId(193);
        $buildingAddress193->setConstructionYear(1976);
        $buildingAddress193->setRenovationYear(2001);
        $buildingAddress193->setStreetName('Straatnaam A');
        $buildingAddress193->setHouseNumber(10);
        $buildingAddress193->setAddition('I');
        $buildingAddress193->setZipcode('12334AA');
        $buildingAddress193->setCity('Woonplaats A');
        $buildingAddress193->setRentalUnitNumber('VHE0000');
        $buildingAddress193->setDaeb(true);
        $buildingAddress193->setVtw($vtw4);
        $buildingAddress193->setResidentialArea($residentialArea9);
        $buildingAddress193->setBuildingType($buildingType9);
        $buildingAddress193->setLivingType($livingType2);
        $buildingAddress193->setCreationTime();
        $buildingAddress193->setLastChangeTime();
                
        $buildingAddress194 = new BuildingAddress();
        $buildingAddress194->setId(194);
        $buildingAddress194->setConstructionYear(1976);
        $buildingAddress194->setRenovationYear(2001);
        $buildingAddress194->setStreetName('Straatnaam A');
        $buildingAddress194->setHouseNumber(10);
        $buildingAddress194->setAddition('I');
        $buildingAddress194->setZipcode('12334AA');
        $buildingAddress194->setCity('Woonplaats A');
        $buildingAddress194->setRentalUnitNumber('VHE0000');
        $buildingAddress194->setDaeb(true);
        $buildingAddress194->setVtw($vtw5);
        $buildingAddress194->setResidentialArea($residentialArea9);
        $buildingAddress194->setBuildingType($buildingType9);
        $buildingAddress194->setLivingType($livingType2);
        $buildingAddress194->setCreationTime();
        $buildingAddress194->setLastChangeTime();
                
        $buildingAddress195 = new BuildingAddress();
        $buildingAddress195->setId(195);
        $buildingAddress195->setConstructionYear(1976);
        $buildingAddress195->setRenovationYear(2001);
        $buildingAddress195->setStreetName('Straatnaam A');
        $buildingAddress195->setHouseNumber(10);
        $buildingAddress195->setAddition('I');
        $buildingAddress195->setZipcode('12334AA');
        $buildingAddress195->setCity('Woonplaats A');
        $buildingAddress195->setRentalUnitNumber('VHE0000');
        $buildingAddress195->setDaeb(true);
        $buildingAddress195->setVtw($vtw6);
        $buildingAddress195->setResidentialArea($residentialArea9);
        $buildingAddress195->setBuildingType($buildingType9);
        $buildingAddress195->setLivingType($livingType2);
        $buildingAddress195->setCreationTime();
        $buildingAddress195->setLastChangeTime();
                
        $buildingAddress196 = new BuildingAddress();
        $buildingAddress196->setId(196);
        $buildingAddress196->setConstructionYear(1976);
        $buildingAddress196->setRenovationYear(2001);
        $buildingAddress196->setStreetName('Straatnaam A');
        $buildingAddress196->setHouseNumber(10);
        $buildingAddress196->setAddition('I');
        $buildingAddress196->setZipcode('12334AA');
        $buildingAddress196->setCity('Woonplaats A');
        $buildingAddress196->setRentalUnitNumber('VHE0000');
        $buildingAddress196->setDaeb(true);
        $buildingAddress196->setVtw($vtw7);
        $buildingAddress196->setResidentialArea($residentialArea9);
        $buildingAddress196->setBuildingType($buildingType9);
        $buildingAddress196->setLivingType($livingType2);
        $buildingAddress196->setCreationTime();
        $buildingAddress196->setLastChangeTime();
                
        $buildingAddress197 = new BuildingAddress();
        $buildingAddress197->setId(197);
        $buildingAddress197->setConstructionYear(1976);
        $buildingAddress197->setRenovationYear(2001);
        $buildingAddress197->setStreetName('Straatnaam A');
        $buildingAddress197->setHouseNumber(10);
        $buildingAddress197->setAddition('I');
        $buildingAddress197->setZipcode('12334AA');
        $buildingAddress197->setCity('Woonplaats A');
        $buildingAddress197->setRentalUnitNumber('VHE0000');
        $buildingAddress197->setDaeb(true);
        $buildingAddress197->setVtw($vtw8);
        $buildingAddress197->setResidentialArea($residentialArea9);
        $buildingAddress197->setBuildingType($buildingType9);
        $buildingAddress197->setLivingType($livingType2);
        $buildingAddress197->setCreationTime();
        $buildingAddress197->setLastChangeTime();
                
        $buildingAddress198 = new BuildingAddress();
        $buildingAddress198->setId(198);
        $buildingAddress198->setConstructionYear(1976);
        $buildingAddress198->setRenovationYear(2001);
        $buildingAddress198->setStreetName('Straatnaam A');
        $buildingAddress198->setHouseNumber(10);
        $buildingAddress198->setAddition('I');
        $buildingAddress198->setZipcode('12334AA');
        $buildingAddress198->setCity('Woonplaats A');
        $buildingAddress198->setRentalUnitNumber('VHE0000');
        $buildingAddress198->setDaeb(true);
        $buildingAddress198->setVtw($vtw9);
        $buildingAddress198->setResidentialArea($residentialArea9);
        $buildingAddress198->setBuildingType($buildingType9);
        $buildingAddress198->setLivingType($livingType2);
        $buildingAddress198->setCreationTime();
        $buildingAddress198->setLastChangeTime();
                
        $buildingAddress199 = new BuildingAddress();
        $buildingAddress199->setId(199);
        $buildingAddress199->setConstructionYear(1976);
        $buildingAddress199->setRenovationYear(2001);
        $buildingAddress199->setStreetName('Straatnaam A');
        $buildingAddress199->setHouseNumber(10);
        $buildingAddress199->setAddition('I');
        $buildingAddress199->setZipcode('12334AA');
        $buildingAddress199->setCity('Woonplaats A');
        $buildingAddress199->setRentalUnitNumber('VHE0000');
        $buildingAddress199->setDaeb(true);
        $buildingAddress199->setVtw($vtw10);
        $buildingAddress199->setResidentialArea($residentialArea9);
        $buildingAddress199->setBuildingType($buildingType9);
        $buildingAddress199->setLivingType($livingType2);
        $buildingAddress199->setCreationTime();
        $buildingAddress199->setLastChangeTime();
      
        $block1 = new Block();
        $block1->setId(1);
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
        $block1->setNumberOfBuildingAddresses(34);
        $block1->setCreationTime();
        $block1->setLastChangeTime();

        $block2 = new Block();
        $block2->setId(2);
        $block2->setCode('Æ æ Œ œ ');
        $block2->setName('Ą ą Ę ę ');
        $block2->setFinancialNumber('2222');
        $block2->setDescription('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ ');
        $block2->addBuildingAddress($buildingAddress1);
        $block2->addBuildingAddress($buildingAddress2);
        $block2->addBuildingAddress($buildingAddress10);
        $block2->addBuildingAddress($buildingAddress12);
        $block2->addBuildingAddress($buildingAddress22);
        $block2->setNumberOfBuildingAddresses(5);
        $block2->setCreationTime();
        $block2->setLastChangeTime();

        $block3 = new Block();
        $block3->setId(3);
        $block3->setCode('C001');
        $block3->setName('Complex 20.66-078');
        $block3->setFinancialNumber('3333');
        $block3->setDescription('mobilisatiecomplex');
        $block3->addBuildingAddress($buildingAddress11);
        $block3->setNumberOfBuildingAddresses(1);
        $block3->setCreationTime();
        $block3->setLastChangeTime();

        $block4 = new Block();
        $block4->setId(4);
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
        $block4->setNumberOfBuildingAddresses(16);
        $block4->setCreationTime();
        $block4->setLastChangeTime();

        $block5 = new Block();
        $block5->setId(5);
        $block5->setCode('4567894645321894651846135134894351385678412132002122');
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
        $block5->setNumberOfBuildingAddresses(11);
        $block5->setCreationTime();
        $block5->setLastChangeTime();

        $block6 = new Block();
        $block6->setId(6);
        $block6->setCode('C-20');
        $block6->setName('Z-2076A');
        $block6->setFinancialNumber('6666');
        $block6->setDescription('Zuiderbroek');
        $block6->addBuildingAddress($buildingAddress101);
        $block6->addBuildingAddress($buildingAddress103);
        $block6->setNumberOfBuildingAddresses(2);
        $block6->setCreationTime();
        $block6->setLastChangeTime();

        $block7 = new Block();
        $block7->setId(7);
        $block7->setCode('ɨ ʉ ɯ ɪ ʏ ʊ ø ɘ ɵ ɤ ə ɛ œ ɜ ɞ ʌ ɔ æ ɐ ɶ ɑ ɒ ɚ');
        $block7->setName('ɨ ʉ ɯ ɪ ʏ ʊ ø ɘ ɵ ɤ ə ɛ œ ɜ ɞ ʌ ɔ æ ɐ ɶ ɑ ɒ ɚ');
        $block7->setFinancialNumber('7777');
        $block7->setDescription('ɨ ʉ ɯ ɪ ʏ ʊ ø ɘ ɵ ɤ ə ɛ œ ɜ ɞ ʌ ɔ æ ɐ ɶ ɑ ɒ ɚ');
        $block7->addBuildingAddress($buildingAddress17);
        $block7->addBuildingAddress($buildingAddress28);
        $block7->addBuildingAddress($buildingAddress39);
        $block7->addBuildingAddress($buildingAddress50);
        $block7->setNumberOfBuildingAddresses(4);
        $block7->setCreationTime();
        $block7->setLastChangeTime();

        $block8 = new Block();
        $block8->setId(8);
        $block8->setCode('ʈ ɖ ɟ ɢ ʔ ɱ ɳ ɲ ŋ ɴ ʙ ʀ ɽ ɸ β θ ð ʃ ʒ ʂ ʐ ʝ ɣ χ ʁ ħ ʕ ɦ ɬ ɮ ʋ ɹ ɻ ɰ ɭ ʎ ʟ ʍ ɥ ʜ ʢ ʡ ɕ ʑ ɺ ɧ ɡ ʲ ʷ');
        $block8->setName('ʈ ɖ ɟ ɢ ʔ ɱ ɳ ɲ ŋ ɴ ʙ ʀ ɽ ɸ β θ ð ʃ ʒ ʂ ʐ ʝ ɣ χ ʁ ħ ʕ ɦ ɬ ɮ ʋ ɹ ɻ ɰ ɭ ʎ ʟ ʍ ɥ ʜ ʢ ʡ ɕ ʑ ɺ ɧ ɡ ʲ ʷ');
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
        $block8->setNumberOfBuildingAddresses(68);
        $block8->setCreationTime();
        $block8->setLastChangeTime();

        $block9 = new Block();
        $block9->setId(9);
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
        $block9->setNumberOfBuildingAddresses(9);
        $block9->setCreationTime();
        $block9->setLastChangeTime();
                       
        $buildingTypeSelection1 = new BuildingTypeSelection();
        $buildingTypeSelection1->setId(1);
        $buildingTypeSelection1->setCode('lat1');
        $buildingTypeSelection1->setName('building type 1');
        $buildingTypeSelection1->setblock($block1);
        $buildingTypeSelection1->setbuildingType($buildingType1);
        $buildingTypeSelection1->setCreationTime();
        $buildingTypeSelection1->setLastChangeTime();
        
        $buildingTypeSelection2 = new BuildingTypeSelection();
        $buildingTypeSelection2->setId(2);
        $buildingTypeSelection2->setCode('lat2');
        $buildingTypeSelection2->setName('building type 2');
        $buildingTypeSelection2->setblock($block2);
        $buildingTypeSelection2->setbuildingType($buildingType2);
        $buildingTypeSelection2->setCreationTime();
        $buildingTypeSelection2->setLastChangeTime();
        
        $buildingTypeSelection3 = new BuildingTypeSelection();
        $buildingTypeSelection3->setId(3);
        $buildingTypeSelection3->setCode('lat3');
        $buildingTypeSelection3->setName('building type 3');
        $buildingTypeSelection3->setblock($block3);
        $buildingTypeSelection3->setbuildingType($buildingType3);
        $buildingTypeSelection3->setCreationTime();
        $buildingTypeSelection3->setLastChangeTime();
        
        $buildingTypeSelection4 = new BuildingTypeSelection();
        $buildingTypeSelection4->setId(4);
        $buildingTypeSelection4->setCode('lat4');
        $buildingTypeSelection4->setName('building type 4');
        $buildingTypeSelection4->setblock($block4);
        $buildingTypeSelection4->setbuildingType($buildingType2);
        $buildingTypeSelection4->setCreationTime();
        $buildingTypeSelection4->setLastChangeTime();
        
        $buildingTypeSelection5 = new BuildingTypeSelection();
        $buildingTypeSelection5->setId(5);
        $buildingTypeSelection5->setCode('lat5');
        $buildingTypeSelection5->setName('building type 5');
        $buildingTypeSelection5->setblock($block5);
        $buildingTypeSelection5->setbuildingType($buildingType4);
        $buildingTypeSelection5->setCreationTime();
        $buildingTypeSelection5->setLastChangeTime();
        
        $buildingTypeSelection6 = new BuildingTypeSelection();
        $buildingTypeSelection6->setId(6);
        $buildingTypeSelection6->setCode('lat6');
        $buildingTypeSelection6->setName('building type 6');
        $buildingTypeSelection6->setblock($block6);
        $buildingTypeSelection6->setbuildingType($buildingType6);
        $buildingTypeSelection6->setCreationTime();
        $buildingTypeSelection6->setLastChangeTime();
        
        $buildingTypeSelection7 = new BuildingTypeSelection();
        $buildingTypeSelection7->setId(7);
        $buildingTypeSelection7->setCode('lat7');
        $buildingTypeSelection7->setName('building type 7');
        $buildingTypeSelection7->setblock($block7);
        $buildingTypeSelection7->setbuildingType($buildingType7);
        $buildingTypeSelection7->setCreationTime();
        $buildingTypeSelection7->setLastChangeTime();
        
        $buildingTypeSelection8 = new BuildingTypeSelection();
        $buildingTypeSelection8->setId(8);
        $buildingTypeSelection8->setCode('lat8');
        $buildingTypeSelection8->setName('building type 8');
        $buildingTypeSelection8->setblock($block8);
        $buildingTypeSelection8->setbuildingType($buildingType5);
        $buildingTypeSelection8->setCreationTime();
        $buildingTypeSelection8->setLastChangeTime();
                
        $buildingTypeSelection9 = new BuildingTypeSelection();
        $buildingTypeSelection9->setId(9);
        $buildingTypeSelection9->setCode('lat9');
        $buildingTypeSelection9->setName('building type 9');
        $buildingTypeSelection9->setblock($block9);
        $buildingTypeSelection9->setbuildingType($buildingType1);
        $buildingTypeSelection9->setCreationTime();
        $buildingTypeSelection9->setLastChangeTime();
        
        $housingStock1 = new HousingStock1();
        $housingStock1->setId(1);
        $housingStock1->setCode('DobrCmTest');
        $housingStock1->setName('DobrCm - Test');
        $housingStock1->setDescription('Dit is de standaard test omgeving voor DobroCm');
        $housingStock1->setNumberOfBuildingAddresses(130);
        $housingStock1->setNumberOfBlocks(9);
        $housingStock1->setCreationTime();
        $housingStock1->setLastChangeTime();
        
        $housingStock2 = new HousingStock2();
        $housingStock2->setId(2);
        $housingStock2->setCode('DobrCmTest1');
        $housingStock2->setName('DobrCm - Test1');
        $housingStock2->setDescription('Dit is de standaard test omgeving voor DobroCm1');
        $housingStock2->setNumberOfBuildingAddresses(50);
        $housingStock2->setNumberOfBlocks(9);
        $housingStock2->setCreationTime();
        $housingStock2->setLastChangeTime();
        
        $housingStock3 = new HousingStock3();
        $housingStock3->setId(3);
        $housingStock3->setCode('DobrCmTest2');
        $housingStock3->setName('DobrCm - Test2');
        $housingStock3->setDescription('Dit is de standaard test omgeving voor DobroCm2');
        $housingStock3->setNumberOfBuildingAddresses(90);
        $housingStock3->setNumberOfBlocks(9);
        $housingStock3->setCreationTime();
        $housingStock3->setLastChangeTime();
        
        $owner1 = new Owner();
        $owner1->setId(1);
        $owner1->setHousingStock($housingStock1);
        $owner1->setName('');
        $owner1->setKvk(01234567);
        $owner1->setBtw('NL123456780B01');
        $owner1->setLNumber('');
        
        $owner2 = new Owner();
        $owner2->setId(1);
        $owner2->setHousingStock($housingStock2);
        $owner2->setName('');
        $owner2->setKvk(01234568);
        $owner2->setBtw('NL123456799B01');
        $owner2->setLNumber('');
        
        $owner3 = new Owner();
        $owner3->setId(1);
        $owner3->setHousingStock($housingStock3);
        $owner3->setName('');
        $owner3->setKvk(01234569);
        $owner3->setBtw('NL123456789B01');
        $owner3->setLNumber('');

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
        $buildingAddress200->setHousingStock($housingStock3);
        $buildingAddress201->setHousingStock($housingStock3);
        $buildingAddress202->setHousingStock($housingStock3);
        $buildingAddress203->setHousingStock($housingStock3);
        $buildingAddress204->setHousingStock($housingStock3);
        $buildingAddress205->setHousingStock($housingStock3);
        $buildingAddress206->setHousingStock($housingStock3);
        $buildingAddress207->setHousingStock($housingStock3);
        $buildingAddress208->setHousingStock($housingStock3);
        $buildingAddress209->setHousingStock($housingStock3);
        $buildingAddress210->setHousingStock($housingStock3);
        $buildingAddress211->setHousingStock($housingStock3);
        $buildingAddress212->setHousingStock($housingStock3);
        $buildingAddress213->setHousingStock($housingStock3);
        $buildingAddress214->setHousingStock($housingStock3);
        $buildingAddress215->setHousingStock($housingStock3);
        $buildingAddress216->setHousingStock($housingStock3);
        $buildingAddress217->setHousingStock($housingStock3);
        $buildingAddress218->setHousingStock($housingStock3);
        $buildingAddress219->setHousingStock($housingStock3);
        $buildingAddress220->setHousingStock($housingStock3);
        $buildingAddress221->setHousingStock($housingStock3);
        $buildingAddress222->setHousingStock($housingStock3);
        $buildingAddress223->setHousingStock($housingStock3);
        $buildingAddress224->setHousingStock($housingStock3);
        $buildingAddress225->setHousingStock($housingStock3);
        $buildingAddress226->setHousingStock($housingStock3);
        $buildingAddress227->setHousingStock($housingStock3);
        $buildingAddress228->setHousingStock($housingStock3);
        $buildingAddress229->setHousingStock($housingStock3);
        $buildingAddress230->setHousingStock($housingStock3);
        $buildingAddress231->setHousingStock($housingStock3);
        $buildingAddress232->setHousingStock($housingStock3);
        $buildingAddress233->setHousingStock($housingStock3);
        $buildingAddress234->setHousingStock($housingStock3);
        $buildingAddress235->setHousingStock($housingStock3);
        $buildingAddress236->setHousingStock($housingStock3);
        $buildingAddress237->setHousingStock($housingStock3);
        $buildingAddress238->setHousingStock($housingStock3);
        $buildingAddress239->setHousingStock($housingStock3);
        $buildingAddress240->setHousingStock($housingStock3);
        $buildingAddress241->setHousingStock($housingStock3);
        $buildingAddress242->setHousingStock($housingStock3);
        $buildingAddress243->setHousingStock($housingStock3);
        $buildingAddress244->setHousingStock($housingStock3);
        $buildingAddress245->setHousingStock($housingStock3);
        $buildingAddress246->setHousingStock($housingStock3);
        $buildingAddress247->setHousingStock($housingStock3);
        $buildingAddress248->setHousingStock($housingStock3);
        $buildingAddress249->setHousingStock($housingStock3);
        $buildingAddress250->setHousingStock($housingStock3);
        $buildingAddress251->setHousingStock($housingStock3);
        $buildingAddress252->setHousingStock($housingStock3);
        $buildingAddress253->setHousingStock($housingStock3);
        $buildingAddress254->setHousingStock($housingStock3);
        $buildingAddress255->setHousingStock($housingStock3);
        $buildingAddress256->setHousingStock($housingStock3);
        $buildingAddress257->setHousingStock($housingStock3);
        $buildingAddress258->setHousingStock($housingStock3);
        $buildingAddress259->setHousingStock($housingStock3);
        $buildingAddress260->setHousingStock($housingStock3);
        $buildingAddress261->setHousingStock($housingStock3);
        $buildingAddress262->setHousingStock($housingStock3);
        $buildingAddress263->setHousingStock($housingStock3);
        $buildingAddress264->setHousingStock($housingStock3);
        $buildingAddress265->setHousingStock($housingStock3);
        $buildingAddress266->setHousingStock($housingStock3);
        $buildingAddress267->setHousingStock($housingStock3);
        $buildingAddress268->setHousingStock($housingStock3);
        $buildingAddress269->setHousingStock($housingStock3);
        $buildingAddress270->setHousingStock($housingStock3);

        $buildingAddress1->addBlock($block1);
        $buildingAddress2->addBlock($block1);
        $buildingAddress3->addBlock($block1);
        $buildingAddress4->addBlock($block1);
        $buildingAddress5->addBlock($block1);
        $buildingAddress6->addBlock($block1);
        $buildingAddress7->addBlock($block1);
        $buildingAddress8->addBlock($block1);
        $buildingAddress9->addBlock($block1);
        $buildingAddress10->addBlock($block1);
        $buildingAddress11->addBlock($block1);
        $buildingAddress12->addBlock($block1);
        $buildingAddress13->addBlock($block1);
        $buildingAddress14->addBlock($block1);
        $buildingAddress15->addBlock($block1);
        $buildingAddress16->addBlock($block1);
        $buildingAddress17->addBlock($block1);
        $buildingAddress18->addBlock($block1);
        $buildingAddress19->addBlock($block1);
        $buildingAddress20->addBlock($block1);
        $buildingAddress21->addBlock($block1);
        $buildingAddress22->addBlock($block1);
        $buildingAddress23->addBlock($block1);
        $buildingAddress24->addBlock($block1);
        $buildingAddress25->addBlock($block2);
        $buildingAddress26->addBlock($block2);
        $buildingAddress27->addBlock($block2);
        $buildingAddress28->addBlock($block2);
        $buildingAddress29->addBlock($block2);
        $buildingAddress30->addBlock($block2);
        $buildingAddress31->addBlock($block2);
        $buildingAddress32->addBlock($block2);
        $buildingAddress33->addBlock($block2);
        $buildingAddress34->addBlock($block2);
        $buildingAddress35->addBlock($block2);
        $buildingAddress36->addBlock($block2);
        $buildingAddress37->addBlock($block2);
        $buildingAddress38->addBlock($block2);
        $buildingAddress39->addBlock($block2);
        $buildingAddress40->addBlock($block2);
        $buildingAddress41->addBlock($block2);
        $buildingAddress42->addBlock($block2);
        $buildingAddress43->addBlock($block2);
        $buildingAddress44->addBlock($block2);
        $buildingAddress45->addBlock($block2);
        $buildingAddress46->addBlock($block2);
        $buildingAddress47->addBlock($block2);
        $buildingAddress48->addBlock($block2);
        $buildingAddress49->addBlock($block2);
        $buildingAddress50->addBlock($block2);
        $buildingAddress51->addBlock($block2);
        $buildingAddress52->addBlock($block2);
        $buildingAddress53->addBlock($block2);
        $buildingAddress54->addBlock($block2);
        $buildingAddress55->addBlock($block2);
        $buildingAddress56->addBlock($block2);
        $buildingAddress57->addBlock($block2);
        $buildingAddress58->addBlock($block2);
        $buildingAddress59->addBlock($block2);
        $buildingAddress60->addBlock($block2);
        $buildingAddress61->addBlock($block3);
        $buildingAddress62->addBlock($block3);
        $buildingAddress63->addBlock($block3);
        $buildingAddress64->addBlock($block3);
        $buildingAddress65->addBlock($block3);
        $buildingAddress66->addBlock($block3);
        $buildingAddress67->addBlock($block3);
        $buildingAddress68->addBlock($block3);
        $buildingAddress69->addBlock($block3);
        $buildingAddress70->addBlock($block3);
        $buildingAddress71->addBlock($block3);
        $buildingAddress72->addBlock($block3);
        $buildingAddress73->addBlock($block3);
        $buildingAddress74->addBlock($block3);
        $buildingAddress75->addBlock($block3);
        $buildingAddress76->addBlock($block3);
        $buildingAddress77->addBlock($block3);
        $buildingAddress78->addBlock($block3);
        $buildingAddress79->addBlock($block3);
        $buildingAddress80->addBlock($block3);
        $buildingAddress81->addBlock($block3);
        $buildingAddress82->addBlock($block3);
        $buildingAddress83->addBlock($block3);
        $buildingAddress84->addBlock($block3);
        $buildingAddress85->addBlock($block3);
        $buildingAddress86->addBlock($block3);
        $buildingAddress87->addBlock($block3);
        $buildingAddress88->addBlock($block3);
        $buildingAddress89->addBlock($block3);
        $buildingAddress90->addBlock($block3);
        $buildingAddress91->addBlock($block3);
        $buildingAddress92->addBlock($block3);
        $buildingAddress93->addBlock($block3);
        $buildingAddress94->addBlock($block3);
        $buildingAddress95->addBlock($block3);
        $buildingAddress96->addBlock($block3);
        $buildingAddress97->addBlock($block4);
        $buildingAddress98->addBlock($block4);
        $buildingAddress99->addBlock($block4);
        $buildingAddress100->addBlock($block4);
        $buildingAddress101->addBlock($block4);
        $buildingAddress102->addBlock($block4);
        $buildingAddress103->addBlock($block4);
        $buildingAddress104->addBlock($block4);
        $buildingAddress105->addBlock($block4);
        $buildingAddress106->addBlock($block4);
        $buildingAddress107->addBlock($block4);
        $buildingAddress108->addBlock($block4);
        $buildingAddress109->addBlock($block4);
        $buildingAddress110->addBlock($block4);
        $buildingAddress111->addBlock($block4);
        $buildingAddress112->addBlock($block4);
        $buildingAddress113->addBlock($block4);
        $buildingAddress114->addBlock($block4);
        $buildingAddress115->addBlock($block4);
        $buildingAddress116->addBlock($block4);
        $buildingAddress117->addBlock($block4);
        $buildingAddress118->addBlock($block4);
        $buildingAddress119->addBlock($block4);
        $buildingAddress120->addBlock($block4);
        $buildingAddress121->addBlock($block4);
        $buildingAddress122->addBlock($block4);
        $buildingAddress123->addBlock($block4);
        $buildingAddress124->addBlock($block4);
        $buildingAddress125->addBlock($block4);
        $buildingAddress126->addBlock($block4);
        $buildingAddress127->addBlock($block4);
        $buildingAddress128->addBlock($block4);
        $buildingAddress129->addBlock($block4);
        $buildingAddress130->addBlock($block4);

        $buildingType1->setHousingStock($housingStock);
        $buildingType2->setHousingStock($housingStock);
        $buildingType3->setHousingStock($housingStock);
        $buildingType4->setHousingStock($housingStock);
        $buildingType5->setHousingStock($housingStock);
        $buildingType6->setHousingStock($housingStock);
        $buildingType7->setHousingStock($housingStock);
        $buildingType8->setHousingStock($housingStock);
        $buildingType9->setHousingStock($housingStock);
        $buildingType10->setHousingStock($housingStock);
        $buildingType11->setHousingStock($housingStock);
        $buildingType12->setHousingStock($housingStock);
        $buildingType13->setHousingStock($housingStock);

        $livingType1->setHousingStock($housingStock);
        $livingType2->setHousingStock($housingStock);
        $livingType3->setHousingStock($housingStock);

        $block1->setHousingStock($housingStock);
        $block2->setHousingStock($housingStock);
        $block3->setHousingStock($housingStock);
        $block4->setHousingStock($housingStock);
        $block5->setHousingStock($housingStock);
        $block6->setHousingStock($housingStock);
        $block7->setHousingStock($housingStock);
        $block8->setHousingStock($housingStock);
        $block9->setHousingStock($housingStock);

        $residentialArea1->setHousingStock($housingStock);
        $residentialArea2->setHousingStock($housingStock);
        $residentialArea3->setHousingStock($housingStock);
        $residentialArea4->setHousingStock($housingStock);
        $residentialArea5->setHousingStock($housingStock);
        $residentialArea6->setHousingStock($housingStock);
        $residentialArea7->setHousingStock($housingStock);
        $residentialArea8->setHousingStock($housingStock);
        $residentialArea9->setHousingStock($housingStock);
        $residentialArea10->setHousingStock($housingStock);

        $housingStockOptionSet->setHousingStock($housingStock);
   
        $buildingPlanningSelection1 = new BuildingPlanningSelection();
        $buildingPlanningSelection1->setId(1);
        $buildingPlanningSelection1->setCode('BP1');
        $buildingPlanningSelection1->setName('buildingPlanning 1');
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress1);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress2);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress3);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress4);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress5);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress6);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress7);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress8);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress9);
        $buildingPlanningSelection1->addBuildingAddress(buildingAddress10);
        $buildingPlanningSelection1->setCreationTime();
        $buildingPlanningSelection1->setLastChangeTime();
        
        $buildingPlanningSelection2 = new BuildingPlanningSelection();
        $buildingPlanningSelection2->setId(1);
        $buildingPlanningSelection2->setCode('BP1');
        $buildingPlanningSelection2->setName('buildingPlanning 2');
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress11);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress12);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress13);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress14);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress15);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress16);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress17);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress18);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress19);
        $buildingPlanningSelection2->addBuildingAddress(buildingAddress20);
        $buildingPlanningSelection2->setCreationTime();
        $buildingPlanningSelection2->setLastChangeTime();   
        
        $buildingPlanningSelection3 = new BuildingPlanningSelection();
        $buildingPlanningSelection3->setId(1);
        $buildingPlanningSelection3->setCode('BP1');
        $buildingPlanningSelection3->setName('buildingPlanning 3');
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress21);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress22);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress23);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress24);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress25);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress26);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress27);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress28);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress29);
        $buildingPlanningSelection3->addBuildingAddress(buildingAddress30);
        $buildingPlanningSelection3->setCreationTime();
        $buildingPlanningSelection3->setLastChangeTime();
        
        $buildingPlanningSelection4 = new BuildingPlanningSelection();
        $buildingPlanningSelection4->setId(1);
        $buildingPlanningSelection4->setCode('BP1');
        $buildingPlanningSelection4->setName('buildingPlanning 4');
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress31);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress32);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress33);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress34);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress35);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress36);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress37);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress38);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress39);
        $buildingPlanningSelection4->addBuildingAddress(buildingAddress40);
        $buildingPlanningSelection4->setCreationTime();
        $buildingPlanningSelection4->setLastChangeTime();
        
        $buildingPlanningSelection5 = new BuildingPlanningSelection();
        $buildingPlanningSelection5->setId(1);
        $buildingPlanningSelection5->setCode('BP1');
        $buildingPlanningSelection5->setName('buildingPlanning 5');
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress41);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress42);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress43);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress44);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress45);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress46);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress47);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress48);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress49);
        $buildingPlanningSelection5->addBuildingAddress(buildingAddress50);
        $buildingPlanningSelection5->setCreationTime();
        $buildingPlanningSelection5->setLastChangeTime();
        
        $buildingPlanningSelection6 = new BuildingPlanningSelection();
        $buildingPlanningSelection6->setId(1);
        $buildingPlanningSelection6->setCode('BP1');
        $buildingPlanningSelection6->setName('buildingPlanning 6');
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress51);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress52);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress53);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress54);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress55);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress56);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress57);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress58);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress59);
        $buildingPlanningSelection6->addBuildingAddress(buildingAddress60);
        $buildingPlanningSelection6->setCreationTime();
        $buildingPlanningSelection6->setLastChangeTime();
        
        $buildingPlanningSelection7 = new BuildingPlanningSelection();
        $buildingPlanningSelection7->setId(1);
        $buildingPlanningSelection7->setCode('BP1');
        $buildingPlanningSelection7->setName('buildingPlanning 7');
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress61);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress62);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress63);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress64);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress65);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress66);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress67);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress68);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress69);
        $buildingPlanningSelection7->addBuildingAddress(buildingAddress70);
        $buildingPlanningSelection7->setCreationTime();
        $buildingPlanningSelection7->setLastChangeTime();
        
        $buildingPlanningSelection8 = new BuildingPlanningSelection();
        $buildingPlanningSelection8->setId(1);
        $buildingPlanningSelection8->setCode('BP1');
        $buildingPlanningSelection8->setName('buildingPlanning 8');
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress71);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress72);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress73);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress74);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress75);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress76);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress77);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress78);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress79);
        $buildingPlanningSelection8->addBuildingAddress(buildingAddress80);
        $buildingPlanningSelection8->setCreationTime();
        $buildingPlanningSelection8->setLastChangeTime();
        
        $buildingPlanningSelection9 = new BuildingPlanningSelection();
        $buildingPlanningSelection9->setId(1);
        $buildingPlanningSelection9->setCode('BP1');
        $buildingPlanningSelection9->setName('buildingPlanning 9');
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress81);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress82);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress83);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress84);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress85);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress86);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress87);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress88);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress89);
        $buildingPlanningSelection9->addBuildingAddress(buildingAddress90);
        $buildingPlanningSelection9->setCreationTime();
        $buildingPlanningSelection9->setLastChangeTime();
        
        $buildingPlanningSelection10 = new BuildingPlanningSelection();
        $buildingPlanningSelection10->setId(1);
        $buildingPlanningSelection10->setCode('BP1');
        $buildingPlanningSelection10->setName('buildingPlanning 10');
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress91);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress92);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress93);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress94);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress95);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress96);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress97);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress98);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress99);
        $buildingPlanningSelection10->addBuildingAddress(buildingAddress100);
        $buildingPlanningSelection10->setCreationTime();
        $buildingPlanningSelection10->setLastChangeTime();
        
        $buildingPlanningSelection11 = new BuildingPlanningSelection();
        $buildingPlanningSelection11->setId(1);
        $buildingPlanningSelection11->setCode('BP1');
        $buildingPlanningSelection11->setName('buildingPlanning 11');
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress101);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress102);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress103);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress104);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress105);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress106);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress107);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress108);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress109);
        $buildingPlanningSelection11->addBuildingAddress(buildingAddress110);
        $buildingPlanningSelection11->setCreationTime();
        $buildingPlanningSelection11->setLastChangeTime();
        
        $buildingPlanningSelection12 = new BuildingPlanningSelection();
        $buildingPlanningSelection12->setId(1);
        $buildingPlanningSelection12->setCode('BP1');
        $buildingPlanningSelection12->setName('buildingPlanning 12');
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress111);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress112);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress113);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress114);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress115);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress116);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress117);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress118);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress119);
        $buildingPlanningSelection12->addBuildingAddress(buildingAddress120);
        $buildingPlanningSelection12->setCreationTime();
        $buildingPlanningSelection12->setLastChangeTime();
        
        $buildingPlanningSelection13 = new BuildingPlanningSelection();
        $buildingPlanningSelection13->setId(1);
        $buildingPlanningSelection13->setCode('BP1');
        $buildingPlanningSelection13->setName('buildingPlanning 13');
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress121);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress122);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress123);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress124);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress125);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress126);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress127);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress128);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress129);
        $buildingPlanningSelection13->addBuildingAddress(buildingAddress130);
        $buildingPlanningSelection13->setCreationTime();
        $buildingPlanningSelection13->setLastChangeTime();
        
        $manager->persist($residentialArea1);
        $manager->persist($residentialArea2);
        $manager->persist($residentialArea3);
        $manager->persist($residentialArea4);
        $manager->persist($residentialArea5);
        $manager->persist($residentialArea6);
        $manager->persist($residentialArea7);
        $manager->persist($residentialArea8);
        $manager->persist($residentialArea9);
        $manager->persist($residentialArea10);

        $manager->persist($buildingType1);
        $manager->persist($buildingType2);
        $manager->persist($buildingType3);
        $manager->persist($buildingType4);
        $manager->persist($buildingType5);
        $manager->persist($buildingType6);
        $manager->persist($buildingType7);
        $manager->persist($buildingType8);
        $manager->persist($buildingType9);
        $manager->persist($buildingType10);
        $manager->persist($buildingType11);
        $manager->persist($buildingType12);
        $manager->persist($buildingType13);

        $manager->persist($livingType1);
        $manager->persist($livingType2);
        $manager->persist($livingType3);

        for ($i = 1; $i <= 130; $i++) {
            $manager->persist(${'buildingAddress'.$i});
        }

        $manager->persist($block1);
        $manager->persist($block2);
        $manager->persist($block3);
        $manager->persist($block4);
        $manager->persist($block5);
        $manager->persist($block6);
        $manager->persist($block7);
        $manager->persist($block8);
        $manager->persist($block9);

        $manager->persist($housingStock);

        $manager->flush();
    }

}
