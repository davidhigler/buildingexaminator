<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\LivingType;
use App\Entity\Portfolio\ResidentialArea;
use App\Entity\Portfolio\Vtw;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * @author Reiny Griemink <rgriemink@gmail.com>
 */
class LoadBuildingAddressesData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $buildingAddresses = [
            [
                'streetName' => 'Löeff Berchmakerstraat',
                'houseNumber' => 6,
                'addition' => 'E',
                'zipcode' => '1105BD',
                'city' => 'Utrecht',
                'rentalUnitNumber' => 'VHE0000',
                'daeb' => true,
                'constructionYear' => 1944,
                'renovationYear' => 1986,
                'vtw' => 'WT 1',
                'housingstock' => 'DobroTest01',
                'residentialarea' => '019313',
                'block' => 'NAP A1',
                'buildingtype' => 'BT1',
                'livingtype' => 'lt1'
            ]
        ];

//        $buildingAddress1->setConstructionYear(1944);
//        $buildingAddress1->setRenovationYear(1986);
//        $buildingAddress1->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress1->setHouseNumber(8);
//        $buildingAddress1->setAddition('E');
//        $buildingAddress1->setZipcode('1105BC');
//        $buildingAddress1->setCity('Utrecht');
//        $buildingAddress1->setRentalUnitNumber('VHE0001');
//        $buildingAddress1->setDaeb(true);
//        $buildingAddress1->setVtw($vtw1);
//        $buildingAddress1->setResidentialArea($residentialArea4);
//        $buildingAddress1->setBuildingType($buildingType2);
//        $buildingAddress1->setLivingType($livingType6);
//
//        $buildingAddress2->setConstructionYear(1944);
//        $buildingAddress2->setRenovationYear(1986);
//        $buildingAddress2->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress2->setHouseNumber(12);
//        $buildingAddress2->setAddition('E');
//        $buildingAddress2->setZipcode('1105BC');
//        $buildingAddress2->setCity('Utrecht');
//        $buildingAddress2->setRentalUnitNumber('VHE0002');
//        $buildingAddress2->setDaeb(false);
//        $buildingAddress2->setVtw($vtw1);
//        $buildingAddress2->setResidentialArea($residentialArea4);
//        $buildingAddress2->setBuildingType($buildingType2);
//        $buildingAddress2->setLivingType($livingType6);
//
//        $buildingAddress3->setConstructionYear(1944);
//        $buildingAddress3->setRenovationYear(1986);
//        $buildingAddress3->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress3->setHouseNumber(6);
//        $buildingAddress3->setAddition('D');
//        $buildingAddress3->setZipcode('1105BC');
//        $buildingAddress3->setCity('Utrecht');
//        $buildingAddress3->setRentalUnitNumber('VHE0003');
//        $buildingAddress3->setDaeb(true);
//        $buildingAddress3->setVtw($vtw1);
//        $buildingAddress3->setResidentialArea($residentialArea4);
//        $buildingAddress3->setBuildingType($buildingType2);
//        $buildingAddress3->setLivingType($livingType6);
//
//        $buildingAddress4->setConstructionYear(1944);
//        $buildingAddress4->setRenovationYear(1986);
//        $buildingAddress4->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress4->setHouseNumber(8);
//        $buildingAddress4->setAddition('D');
//        $buildingAddress4->setZipcode('1105BC');
//        $buildingAddress4->setCity('Utrecht');
//        $buildingAddress4->setRentalUnitNumber('VHE0004');
//        $buildingAddress4->setDaeb(true);
//        $buildingAddress4->setVtw($vtw1);
//        $buildingAddress4->setResidentialArea($residentialArea4);
//        $buildingAddress4->setBuildingType($buildingType2);
//        $buildingAddress4->setLivingType($livingType6);
//
//        $buildingAddress5->setConstructionYear(1944);
//        $buildingAddress5->setRenovationYear(1986);
//        $buildingAddress5->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress5->setHouseNumber(10);
//        $buildingAddress5->setAddition('D');
//        $buildingAddress5->setZipcode('1105BC');
//        $buildingAddress5->setCity('Utrecht');
//        $buildingAddress5->setRentalUnitNumber('VHE0005');
//        $buildingAddress5->setDaeb(true);
//        $buildingAddress5->setVtw($vtw1);
//        $buildingAddress5->setResidentialArea($residentialArea4);
//        $buildingAddress5->setBuildingType($buildingType2);
//        $buildingAddress5->setLivingType($livingType6);
//
//        $buildingAddress6->setConstructionYear(1944);
//        $buildingAddress6->setRenovationYear(1986);
//        $buildingAddress6->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress6->setHouseNumber(12);
//        $buildingAddress6->setAddition('D');
//        $buildingAddress6->setZipcode('1105BC');
//        $buildingAddress6->setCity('Utrecht');
//        $buildingAddress6->setRentalUnitNumber('VHE0006');
//        $buildingAddress6->setDaeb(true);
//        $buildingAddress6->setVtw($vtw1);
//        $buildingAddress6->setResidentialArea($residentialArea4);
//        $buildingAddress6->setBuildingType($buildingType2);
//        $buildingAddress6->setLivingType($livingType6);
//
//        $buildingAddress7->setConstructionYear(1944);
//        $buildingAddress7->setRenovationYear(1986);
//        $buildingAddress7->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress7->setHouseNumber(12);
//        $buildingAddress7->setAddition('X');
//        $buildingAddress7->setZipcode('1105BB');
//        $buildingAddress7->setCity('Utrecht');
//        $buildingAddress7->setRentalUnitNumber('VHE0007');
//        $buildingAddress7->setDaeb(true);
//        $buildingAddress7->setVtw($vtw1);
//        $buildingAddress7->setResidentialArea($residentialArea4);
//        $buildingAddress7->setBuildingType($buildingType2);
//        $buildingAddress7->setLivingType($livingType6);
//
//        $buildingAddress8->setConstructionYear(1944);
//        $buildingAddress8->setRenovationYear(1986);
//        $buildingAddress8->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress8->setHouseNumber(14);
//        $buildingAddress8->setAddition('X');
//        $buildingAddress8->setZipcode('1105BB');
//        $buildingAddress8->setCity('Utrecht');
//        $buildingAddress8->setRentalUnitNumber('VHE0008');
//        $buildingAddress8->setDaeb(true);
//        $buildingAddress8->setVtw($vtw1);
//        $buildingAddress8->setResidentialArea($residentialArea4);
//        $buildingAddress8->setBuildingType($buildingType2);
//        $buildingAddress8->setLivingType($livingType6);
//
//        $buildingAddress9->setConstructionYear(1944);
//        $buildingAddress9->setRenovationYear(1986);
//        $buildingAddress9->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress9->setHouseNumber(16);
//        $buildingAddress9->setAddition('X');
//        $buildingAddress9->setZipcode('1105BB');
//        $buildingAddress9->setCity('Utrecht');
//        $buildingAddress9->setRentalUnitNumber('VHE0009');
//        $buildingAddress9->setDaeb(true);
//        $buildingAddress9->setVtw($vtw19);
//        $buildingAddress9->setResidentialArea($residentialArea4);
//        $buildingAddress9->setBuildingType($buildingType2);
//        $buildingAddress9->setLivingType($livingType6);
//
//        $buildingAddress10->setConstructionYear(1944);
//        $buildingAddress10->setRenovationYear(1986);
//        $buildingAddress10->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress10->setHouseNumber(18);
//        $buildingAddress10->setAddition('X');
//        $buildingAddress10->setZipcode('1105BB');
//        $buildingAddress10->setCity('Utrecht');
//        $buildingAddress10->setRentalUnitNumber('VHE0010');
//        $buildingAddress10->setDaeb(true);
//        $buildingAddress10->setVtw($vtw1);
//        $buildingAddress10->setResidentialArea($residentialArea4);
//        $buildingAddress10->setBuildingType($buildingType2);
//        $buildingAddress10->setLivingType($livingType6);
//
//        $buildingAddress11->setConstructionYear(1944);
//        $buildingAddress11->setRenovationYear(1986);
//        $buildingAddress11->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress11->setHouseNumber(20);
//        $buildingAddress11->setAddition('X');
//        $buildingAddress11->setZipcode('1105BB');
//        $buildingAddress11->setCity('Utrecht');
//        $buildingAddress11->setRentalUnitNumber('VHE0011');
//        $buildingAddress11->setDaeb(true);
//        $buildingAddress11->setVtw($vtw1);
//        $buildingAddress11->setResidentialArea($residentialArea4);
//        $buildingAddress11->setBuildingType($buildingType2);
//        $buildingAddress11->setLivingType($livingType6);
//
//        $buildingAddress12->setConstructionYear(1944);
//        $buildingAddress12->setRenovationYear(1986);
//        $buildingAddress12->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress12->setHouseNumber(6);
//        $buildingAddress12->setAddition('B');
//        $buildingAddress12->setZipcode('1105BB');
//        $buildingAddress12->setCity('Utrecht');
//        $buildingAddress12->setRentalUnitNumber('VHE0012');
//        $buildingAddress12->setDaeb(true);
//        $buildingAddress12->setVtw($vtw1);
//        $buildingAddress12->setResidentialArea($residentialArea4);
//        $buildingAddress12->setBuildingType($buildingType2);
//        $buildingAddress12->setLivingType($livingType6);
//
//        $buildingAddress13->setConstructionYear(1944);
//        $buildingAddress13->setRenovationYear(1986);
//        $buildingAddress13->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress13->setHouseNumber(8);
//        $buildingAddress13->setAddition('B');
//        $buildingAddress13->setZipcode('1105BB');
//        $buildingAddress13->setCity('Utrecht');
//        $buildingAddress13->setRentalUnitNumber('VHE0013');
//        $buildingAddress13->setDaeb(false);
//        $buildingAddress13->setVtw($vtw5);
//        $buildingAddress13->setResidentialArea($residentialArea4);
//        $buildingAddress13->setBuildingType($buildingType2);
//        $buildingAddress13->setLivingType($livingType6);
//
//
//        $buildingAddress14->setConstructionYear(1944);
//        $buildingAddress14->setRenovationYear(1986);
//        $buildingAddress14->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress14->setHouseNumber(10);
//        $buildingAddress14->setAddition('B');
//        $buildingAddress14->setZipcode('1105BB');
//        $buildingAddress14->setCity('Utrecht');
//        $buildingAddress14->setRentalUnitNumber('VHE0014');
//        $buildingAddress14->setDaeb(true);
//        $buildingAddress14->setVtw($vtw1);
//        $buildingAddress14->setResidentialArea($residentialArea4);
//        $buildingAddress14->setBuildingType($buildingType2);
//        $buildingAddress14->setLivingType($livingType6);
//
//        $buildingAddress15->setConstructionYear(1944);
//        $buildingAddress15->setRenovationYear(1986);
//        $buildingAddress15->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress15->setHouseNumber(12);
//        $buildingAddress15->setAddition('B');
//        $buildingAddress15->setZipcode('1105BB');
//        $buildingAddress15->setCity('Utrecht');
//        $buildingAddress15->setRentalUnitNumber('VHE0015');
//        $buildingAddress15->setDaeb(true);
//        $buildingAddress15->setVtw($vtw1);
//        $buildingAddress15->setResidentialArea($residentialArea4);
//        $buildingAddress15->setBuildingType($buildingType2);
//        $buildingAddress15->setLivingType($livingType6);
//
//        $buildingAddress16->setConstructionYear(1944);
//        $buildingAddress16->setRenovationYear(1986);
//        $buildingAddress16->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress16->setHouseNumber(6);
//        $buildingAddress16->setAddition('Bis');
//        $buildingAddress16->setZipcode('1105BB');
//        $buildingAddress16->setCity('Utrecht');
//        $buildingAddress16->setRentalUnitNumber('VHE0016');
//        $buildingAddress16->setDaeb(true);
//        $buildingAddress16->setVtw($vtw1);
//        $buildingAddress16->setResidentialArea($residentialArea4);
//        $buildingAddress16->setBuildingType($buildingType2);
//        $buildingAddress16->setLivingType($livingType6);
//
//        $buildingAddress17->setConstructionYear(1944);
//        $buildingAddress17->setRenovationYear(1986);
//        $buildingAddress17->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress17->setHouseNumber(8);
//        $buildingAddress17->setAddition('Bis');
//        $buildingAddress17->setZipcode('1105BV');
//        $buildingAddress17->setCity('Utrecht');
//        $buildingAddress17->setRentalUnitNumber('VHE0017');
//        $buildingAddress17->setDaeb(true);
//        $buildingAddress17->setVtw($vtw1);
//        $buildingAddress17->setResidentialArea($residentialArea4);
//        $buildingAddress17->setBuildingType($buildingType2);
//        $buildingAddress17->setLivingType($livingType6);
//
//        $buildingAddress18->setConstructionYear(1944);
//        $buildingAddress18->setRenovationYear(1986);
//        $buildingAddress18->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress18->setHouseNumber(10);
//        $buildingAddress18->setAddition('Bis');
//        $buildingAddress18->setZipcode('1105BV');
//        $buildingAddress18->setCity('Utrecht');
//        $buildingAddress18->setRentalUnitNumber('VHE0018');
//        $buildingAddress18->setDaeb(false);
//        $buildingAddress18->setVtw($vtw1);
//        $buildingAddress18->setResidentialArea($residentialArea4);
//        $buildingAddress18->setBuildingType($buildingType2);
//        $buildingAddress18->setLivingType($livingType6);
//
//        $buildingAddress19->setConstructionYear(1944);
//        $buildingAddress19->setRenovationYear(1986);
//        $buildingAddress19->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress19->setHouseNumber(12);
//        $buildingAddress19->setAddition('Bis');
//        $buildingAddress19->setZipcode('1105BV');
//        $buildingAddress19->setCity('Utrecht');
//        $buildingAddress19->setRentalUnitNumber('VHE0019');
//        $buildingAddress19->setDaeb(true);
//        $buildingAddress19->setVtw($vtw1);
//        $buildingAddress19->setResidentialArea($residentialArea4);
//        $buildingAddress19->setBuildingType($buildingType2);
//        $buildingAddress19->setLivingType($livingType6);
//
//        $buildingAddress20->setConstructionYear(1944);
//        $buildingAddress20->setRenovationYear(1986);
//        $buildingAddress20->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress20->setHouseNumber(6);
//        $buildingAddress20->setAddition('A');
//        $buildingAddress20->setZipcode('1105BV');
//        $buildingAddress20->setCity('Utrecht');
//        $buildingAddress20->setRentalUnitNumber('VHE0020');
//        $buildingAddress20->setDaeb(true);
//        $buildingAddress20->setVtw($vtw1);
//        $buildingAddress20->setResidentialArea($residentialArea4);
//        $buildingAddress20->setBuildingType($buildingType2);
//        $buildingAddress20->setLivingType($livingType6);
//
//        $buildingAddress21->setConstructionYear(1944);
//        $buildingAddress21->setRenovationYear(1986);
//        $buildingAddress21->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress21->setHouseNumber(8);
//        $buildingAddress21->setAddition('A');
//        $buildingAddress21->setZipcode('1105BV');
//        $buildingAddress21->setCity('Utrecht');
//        $buildingAddress21->setRentalUnitNumber('VHE0021');
//        $buildingAddress21->setDaeb(true);
//        $buildingAddress21->setVtw($vtw1);
//        $buildingAddress21->setResidentialArea($residentialArea4);
//        $buildingAddress21->setBuildingType($buildingType2);
//        $buildingAddress21->setLivingType($livingType6);
//
//        $buildingAddress22->setConstructionYear(1944);
//        $buildingAddress22->setRenovationYear(1986);
//        $buildingAddress22->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress22->setHouseNumber(10);
//        $buildingAddress22->setAddition('A');
//        $buildingAddress22->setZipcode('1105BV');
//        $buildingAddress22->setCity('Utrecht');
//        $buildingAddress22->setRentalUnitNumber('VHE0022');
//        $buildingAddress22->setDaeb(true);
//        $buildingAddress22->setVtw($vtw1);
//        $buildingAddress22->setResidentialArea($residentialArea4);
//        $buildingAddress22->setBuildingType($buildingType2);
//        $buildingAddress22->setLivingType($livingType6);
//
//        $buildingAddress23->setConstructionYear(1944);
//        $buildingAddress23->setRenovationYear(1986);
//        $buildingAddress23->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress23->setHouseNumber(6);
//        $buildingAddress23->setZipcode('1105BV');
//        $buildingAddress23->setCity('Utrecht');
//        $buildingAddress23->setRentalUnitNumber('VHE0023');
//        $buildingAddress23->setDaeb(true);
//        $buildingAddress23->setVtw($vtw1);
//        $buildingAddress23->setResidentialArea($residentialArea4);
//        $buildingAddress23->setBuildingType($buildingType2);
//        $buildingAddress23->setLivingType($livingType6);
//
//        $buildingAddress24->setConstructionYear(1944);
//        $buildingAddress24->setRenovationYear(1986);
//        $buildingAddress24->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress24->setHouseNumber(8);
//        $buildingAddress24->setZipcode('1105BV');
//        $buildingAddress24->setCity('Utrecht');
//        $buildingAddress24->setRentalUnitNumber('VHE0024');
//        $buildingAddress24->setDaeb(true);
//        $buildingAddress24->setVtw($vtw1);
//        $buildingAddress24->setResidentialArea($residentialArea4);
//        $buildingAddress24->setBuildingType($buildingType2);
//        $buildingAddress24->setLivingType($livingType6);
//
//        $buildingAddress25->setConstructionYear(1944);
//        $buildingAddress25->setRenovationYear(1986);
//        $buildingAddress25->setStreetName('Löeff Berchmakerstraat');
//        $buildingAddress25->setHouseNumber(10);
//        $buildingAddress25->setZipcode('1105BV');
//        $buildingAddress25->setCity('Utrecht');
//        $buildingAddress25->setRentalUnitNumber('VHE0025');
//        $buildingAddress25->setDaeb(true);
//        $buildingAddress25->setVtw($vtw1);
//        $buildingAddress25->setResidentialArea($residentialArea4);
//        $buildingAddress25->setBuildingType($buildingType2);
//        $buildingAddress25->setLivingType($livingType6);
//
//        $buildingAddress26->setConstructionYear(1956);
//        $buildingAddress26->setRenovationYear(2000);
//        $buildingAddress26->setStreetName('Zomersestraatweg');
//        $buildingAddress26->setHouseNumber(1);
//        $buildingAddress26->setAddition('A');
//        $buildingAddress26->setZipcode('3234AT');
//        $buildingAddress26->setCity('Nooitgedacht');
//        $buildingAddress26->setRentalUnitNumber('VHE0026');
//        $buildingAddress26->setDaeb(true);
//        $buildingAddress26->setVtw($vtw14);
//        $buildingAddress26->setResidentialArea($residentialArea6);
//        $buildingAddress26->setBuildingType($buildingType6);
//        $buildingAddress26->setLivingType($livingType2);
//
//        $buildingAddress27->setConstructionYear(2006);
//        $buildingAddress27->setRenovationYear(2006);
//        $buildingAddress27->setStreetName('Zomersestraatweg');
//        $buildingAddress27->setHouseNumber(3);
//        $buildingAddress27->setAddition('A');
//        $buildingAddress27->setZipcode('3234AT');
//        $buildingAddress27->setCity('Nooitgedacht');
//        $buildingAddress27->setRentalUnitNumber('VHE0027');
//        $buildingAddress27->setDaeb(true);
//        $buildingAddress27->setVtw($vtw4);
//        $buildingAddress27->setResidentialArea($residentialArea7);
//        $buildingAddress27->setBuildingType($buildingType7);
//        $buildingAddress27->setLivingType($livingType2);
//
//        $buildingAddress28->setConstructionYear(2020);
//        $buildingAddress28->setStreetName('Zomersestraatweg');
//        $buildingAddress28->setHouseNumber(3);
//        $buildingAddress28->setAddition('Bis');
//        $buildingAddress28->setZipcode('3234AT');
//        $buildingAddress28->setCity('Nooitgedacht');
//        $buildingAddress28->setRentalUnitNumber('VHE0028');
//        $buildingAddress28->setDaeb(true);
//        $buildingAddress28->setVtw($vtw6);
//        $buildingAddress28->setResidentialArea($residentialArea8);
//        $buildingAddress28->setBuildingType($buildingType8);
//        $buildingAddress28->setLivingType($livingType2);
//
//        $buildingAddress29->setConstructionYear(1976);
//        $buildingAddress29->setRenovationYear(2001);
//        $buildingAddress29->setStreetName('Zomersestraatweg');
//        $buildingAddress29->setHouseNumber(3);
//        $buildingAddress29->setAddition('I');
//        $buildingAddress29->setZipcode('3234AT');
//        $buildingAddress29->setCity('Nooitgedacht');
//        $buildingAddress29->setRentalUnitNumber('VHE0029');
//        $buildingAddress29->setDaeb(true);
//        $buildingAddress29->setVtw($vtw1);
//        $buildingAddress29->setResidentialArea($residentialArea9);
//        $buildingAddress29->setBuildingType($buildingType9);
//        $buildingAddress29->setLivingType($livingType2);
//
//        $buildingAddress30->setConstructionYear(1986);
//        $buildingAddress30->setRenovationYear(2002);
//        $buildingAddress30->setStreetName('Zomersestraatweg');
//        $buildingAddress30->setHouseNumber(3);
//        $buildingAddress30->setAddition('X');
//        $buildingAddress30->setZipcode('3234AT');
//        $buildingAddress30->setCity('Nooitgedacht');
//        $buildingAddress30->setRentalUnitNumber('VHE0030');
//        $buildingAddress30->setDaeb(true);
//        $buildingAddress30->setVtw($vtw16);
//        $buildingAddress30->setResidentialArea($residentialArea10);
//        $buildingAddress30->setBuildingType($buildingType10);
//        $buildingAddress30->setLivingType($livingType2);
//
//        $buildingAddress31->setConstructionYear(1954);
//        $buildingAddress31->setRenovationYear(1986);
//        $buildingAddress31->setStreetName('Zomersestraatweg');
//        $buildingAddress31->setHouseNumber(5);
//        $buildingAddress31->setAddition('A');
//        $buildingAddress31->setZipcode('3234AT');
//        $buildingAddress31->setCity('Nooitgedacht');
//        $buildingAddress31->setRentalUnitNumber('VHE0031');
//        $buildingAddress31->setDaeb(true);
//        $buildingAddress31->setVtw($vtw19);
//        $buildingAddress31->setResidentialArea($residentialArea1);
//        $buildingAddress31->setBuildingType($buildingType1);
//        $buildingAddress31->setLivingType($livingType2);
//
//        $buildingAddress32->setConstructionYear(1998);
//        $buildingAddress32->setRenovationYear(2021);
//        $buildingAddress32->setStreetName('Zomersestraatweg');
//        $buildingAddress32->setHouseNumber(5);
//        $buildingAddress32->setAddition('B');
//        $buildingAddress32->setZipcode('3234AT');
//        $buildingAddress32->setCity('Nooitgedacht');
//        $buildingAddress32->setRentalUnitNumber('VHE0032');
//        $buildingAddress32->setDaeb(true);
//        $buildingAddress32->setVtw($vtw1);
//        $buildingAddress32->setResidentialArea($residentialArea2);
//        $buildingAddress32->setBuildingType($buildingType2);
//        $buildingAddress32->setLivingType($livingType3);
//
//        $buildingAddress33->setConstructionYear(1984);
//        $buildingAddress33->setRenovationYear(2000);
//        $buildingAddress33->setStreetName('Zomersestraatweg');
//        $buildingAddress33->setHouseNumber(5);
//        $buildingAddress33->setAddition('Bis');
//        $buildingAddress33->setZipcode('3234AT');
//        $buildingAddress33->setCity('Nooitgedacht');
//        $buildingAddress33->setRentalUnitNumber('VHE0033');
//        $buildingAddress33->setDaeb(true);
//        $buildingAddress33->setVtw($vtw1);
//        $buildingAddress33->setResidentialArea($residentialArea3);
//        $buildingAddress33->setBuildingType($buildingType3);
//        $buildingAddress33->setLivingType($livingType3);
//
//        $buildingAddress34->setConstructionYear(2010);
//        $buildingAddress34->setRenovationYear(2010);
//        $buildingAddress34->setStreetName('Zomersestraatweg');
//        $buildingAddress34->setHouseNumber(7);
//        $buildingAddress34->setAddition('A');
//        $buildingAddress34->setZipcode('3234AT');
//        $buildingAddress34->setCity('Nooitgedacht');
//        $buildingAddress34->setRentalUnitNumber('VHE0034');
//        $buildingAddress34->setDaeb(true);
//        $buildingAddress34->setVtw($vtw1);
//        $buildingAddress34->setResidentialArea($residentialArea4);
//        $buildingAddress34->setBuildingType($buildingType4);
//        $buildingAddress34->setLivingType($livingType3);
//
//        $buildingAddress35->setConstructionYear(1888);
//        $buildingAddress35->setRenovationYear(2005);
//        $buildingAddress35->setStreetName('Zomersestraatweg');
//        $buildingAddress35->setHouseNumber(7);
//        $buildingAddress35->setAddition('B');
//        $buildingAddress35->setZipcode('3234AT');
//        $buildingAddress35->setCity('Nooitgedacht');
//        $buildingAddress35->setRentalUnitNumber('VHE0035');
//        $buildingAddress35->setDaeb(true);
//        $buildingAddress35->setVtw($vtw1);
//        $buildingAddress35->setResidentialArea($residentialArea5);
//        $buildingAddress35->setBuildingType($buildingType5);
//        $buildingAddress35->setLivingType($livingType3);
//
//        $buildingAddress36->setConstructionYear(1908);
//        $buildingAddress36->setRenovationYear(2000);
//        $buildingAddress36->setStreetName('Zomersestraatweg');
//        $buildingAddress36->setHouseNumber(7);
//        $buildingAddress36->setAddition('Bis');
//        $buildingAddress36->setZipcode('3234AT');
//        $buildingAddress36->setCity('Nooitgedacht');
//        $buildingAddress36->setRentalUnitNumber('VHE0036');
//        $buildingAddress36->setDaeb(true);
//        $buildingAddress36->setVtw($vtw1);
//        $buildingAddress36->setResidentialArea($residentialArea6);
//        $buildingAddress36->setBuildingType($buildingType6);
//        $buildingAddress36->setLivingType($livingType3);
//
//        $buildingAddress37->setConstructionYear(2006);
//        $buildingAddress37->setRenovationYear(2006);
//        $buildingAddress37->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress37->setHouseNumber(9);
//        $buildingAddress37->setAddition('A');
//        $buildingAddress37->setZipcode('3234AT');
//        $buildingAddress37->setCity('Nooitgedacht');
//        $buildingAddress37->setRentalUnitNumber('VHE0037');
//        $buildingAddress37->setDaeb(true);
//        $buildingAddress37->setVtw($vtw1);
//        $buildingAddress37->setResidentialArea($residentialArea7);
//        $buildingAddress37->setBuildingType($buildingType7);
//        $buildingAddress37->setLivingType($livingType3);
//
//        $buildingAddress38->setConstructionYear(2026);
//        $buildingAddress38->setRenovationYear(2081);
//        $buildingAddress38->setStreetName('Zomersestraatweg');
//        $buildingAddress38->setHouseNumber(9);
//        $buildingAddress38->setAddition('Bis');
//        $buildingAddress38->setZipcode('3234AT');
//        $buildingAddress38->setCity('Nooitgedacht');
//        $buildingAddress38->setRentalUnitNumber('VHE0038');
//        $buildingAddress38->setDaeb(true);
//        $buildingAddress38->setVtw($vtw1);
//        $buildingAddress38->setResidentialArea($residentialArea8);
//        $buildingAddress38->setBuildingType($buildingType8);
//        $buildingAddress38->setLivingType($livingType3);
//
//        $buildingAddress39->setConstructionYear(1976);
//        $buildingAddress39->setRenovationYear(2001);
//        $buildingAddress39->setStreetName('Zomersestraatweg');
//        $buildingAddress39->setHouseNumber(9);
//        $buildingAddress39->setAddition('I');
//        $buildingAddress39->setZipcode('3234AT');
//        $buildingAddress39->setCity('Nooitgedacht');
//        $buildingAddress39->setRentalUnitNumber('VHE0039');
//        $buildingAddress39->setDaeb(true);
//        $buildingAddress39->setVtw($vtw1);
//        $buildingAddress39->setResidentialArea($residentialArea9);
//        $buildingAddress39->setBuildingType($buildingType9);
//        $buildingAddress39->setLivingType($livingType3);
//
//        $buildingAddress40->setConstructionYear(1986);
//        $buildingAddress40->setRenovationYear(2002);
//        $buildingAddress40->setStreetName('Zomersestraatweg');
//        $buildingAddress40->setHouseNumber(9);
//        $buildingAddress40->setAddition('X');
//        $buildingAddress40->setZipcode('3234AT');
//        $buildingAddress40->setCity('Nooitgedacht');
//        $buildingAddress40->setRentalUnitNumber('VHE0040');
//        $buildingAddress40->setDaeb(true);
//        $buildingAddress40->setVtw($vtw1);
//        $buildingAddress40->setResidentialArea($residentialArea10);
//        $buildingAddress40->setBuildingType($buildingType10);
//        $buildingAddress40->setLivingType($livingType3);
//
//        $buildingAddress41->setConstructionYear(1954);
//        $buildingAddress41->setRenovationYear(1986);
//        $buildingAddress41->setStreetName('Zomersestraatweg');
//        $buildingAddress41->setHouseNumber(10);
//        $buildingAddress41->setAddition('A');
//        $buildingAddress41->setZipcode('3234AT');
//        $buildingAddress41->setCity('Nooitgedacht');
//        $buildingAddress41->setRentalUnitNumber('VHE0041');
//        $buildingAddress41->setDaeb(true);
//        $buildingAddress41->setVtw($vtw178);
//        $buildingAddress41->setResidentialArea($residentialArea1);
//        $buildingAddress41->setBuildingType($buildingType1);
//        $buildingAddress41->setLivingType($livingType2);
//
//        $buildingAddress42->setConstructionYear(1998);
//        $buildingAddress42->setRenovationYear(2021);
//        $buildingAddress42->setStreetName('Straatnaam A');
//        $buildingAddress42->setHouseNumber(10);
//        $buildingAddress42->setAddition('B');
//        $buildingAddress42->setZipcode('3234AT');
//        $buildingAddress42->setCity('Nooitgedacht');
//        $buildingAddress42->setRentalUnitNumber('VHE0042');
//        $buildingAddress42->setDaeb(true);
//        $buildingAddress42->setVtw($vtw2);
//        $buildingAddress42->setResidentialArea($residentialArea2);
//        $buildingAddress42->setBuildingType($buildingType2);
//        $buildingAddress42->setLivingType($livingType3);
//
//        $buildingAddress43->setConstructionYear(1984);
//        $buildingAddress43->setRenovationYear(2000);
//        $buildingAddress43->setStreetName('Zomersestraatweg');
//        $buildingAddress43->setHouseNumber(10);
//        $buildingAddress43->setAddition('Bis');
//        $buildingAddress43->setZipcode('3234AT');
//        $buildingAddress43->setCity('Nooitgedacht');
//        $buildingAddress43->setRentalUnitNumber('VHE0043');
//        $buildingAddress43->setDaeb(true);
//        $buildingAddress43->setVtw($vtw1);
//        $buildingAddress43->setResidentialArea($residentialArea3);
//        $buildingAddress43->setBuildingType($buildingType3);
//        $buildingAddress43->setLivingType($livingType3);
//
//        $buildingAddress44->setConstructionYear(2010);
//        $buildingAddress44->setRenovationYear(2015);
//        $buildingAddress44->setStreetName('Zomersestraatweg');
//        $buildingAddress44->setHouseNumber(10);
//        $buildingAddress44->setAddition('X');
//        $buildingAddress44->setZipcode('3234AT');
//        $buildingAddress44->setCity('Nooitgedacht');
//        $buildingAddress44->setRentalUnitNumber('VHE0044');
//        $buildingAddress44->setDaeb(true);
//        $buildingAddress44->setVtw($vtw1);
//        $buildingAddress44->setResidentialArea($residentialArea4);
//        $buildingAddress44->setBuildingType($buildingType4);
//        $buildingAddress44->setLivingType($livingType3);
//
//        $buildingAddress45->setConstructionYear(1988);
//        $buildingAddress45->setRenovationYear(2005);
//        $buildingAddress45->setStreetName('Zomersestraatweg');
//        $buildingAddress45->setHouseNumber(12);
//        $buildingAddress45->setAddition('A');
//        $buildingAddress45->setZipcode('3234AT');
//        $buildingAddress45->setCity('Nooitgedacht');
//        $buildingAddress45->setRentalUnitNumber('VHE0045');
//        $buildingAddress45->setDaeb(true);
//        $buildingAddress45->setVtw($vtw1);
//        $buildingAddress45->setResidentialArea($residentialArea5);
//        $buildingAddress45->setBuildingType($buildingType5);
//        $buildingAddress45->setLivingType($livingType3);
//
//        $buildingAddress46->setConstructionYear(1958);
//        $buildingAddress46->setRenovationYear(2000);
//        $buildingAddress46->setStreetName('Straatnaam A');
//        $buildingAddress46->setHouseNumber(12);
//        $buildingAddress46->setAddition('B');
//        $buildingAddress46->setZipcode('3234AT');
//        $buildingAddress46->setCity('Nooitgedacht');
//        $buildingAddress46->setRentalUnitNumber('VHE0046');
//        $buildingAddress46->setDaeb(true);
//        $buildingAddress46->setVtw($vtw1);
//        $buildingAddress46->setResidentialArea($residentialArea6);
//        $buildingAddress46->setBuildingType($buildingType6);
//        $buildingAddress46->setLivingType($livingType3);
//
//        $buildingAddress47->setConstructionYear(2006);
//        $buildingAddress47->setRenovationYear(2006);
//        $buildingAddress47->setStreetName('Zomersestraatweg');
//        $buildingAddress47->setHouseNumber(12);
//        $buildingAddress47->setAddition('Bis');
//        $buildingAddress47->setZipcode('3234AT');
//        $buildingAddress47->setCity('Nooitgedacht');
//        $buildingAddress47->setRentalUnitNumber('VHE0047');
//        $buildingAddress47->setDaeb(true);
//        $buildingAddress47->setVtw($vtw1);
//        $buildingAddress47->setResidentialArea($residentialArea7);
//        $buildingAddress47->setBuildingType($buildingType7);
//        $buildingAddress47->setLivingType($livingType3);
//
//        $buildingAddress48->setConstructionYear(2026);
//        $buildingAddress48->setRenovationYear(2081);
//        $buildingAddress48->setStreetName('Zomersestraatweg');
//        $buildingAddress48->setHouseNumber(12);
//        $buildingAddress48->setAddition('X');
//        $buildingAddress48->setZipcode('3234AT');
//        $buildingAddress48->setCity('Nooitgedacht');
//        $buildingAddress48->setRentalUnitNumber('VHE0048');
//        $buildingAddress48->setDaeb(true);
//        $buildingAddress48->setVtw($vtw1);
//        $buildingAddress48->setResidentialArea($residentialArea8);
//        $buildingAddress48->setBuildingType($buildingType8);
//        $buildingAddress48->setLivingType($livingType3);
//
//        $buildingAddress49->setConstructionYear(1976);
//        $buildingAddress49->setRenovationYear(2001);
//        $buildingAddress49->setStreetName('Zomersestraatweg');
//        $buildingAddress49->setHouseNumber(14);
//        $buildingAddress49->setAddition('I');
//        $buildingAddress49->setZipcode('3234AT');
//        $buildingAddress49->setCity('Nooitgedacht');
//        $buildingAddress49->setRentalUnitNumber('VHE0049');
//        $buildingAddress49->setDaeb(true);
//        $buildingAddress49->setVtw($vtw1);
//        $buildingAddress49->setResidentialArea($residentialArea9);
//        $buildingAddress49->setBuildingType($buildingType9);
//        $buildingAddress49->setLivingType($livingType3);
//
//        $buildingAddress50->setConstructionYear(1986);
//        $buildingAddress50->setRenovationYear(2002);
//        $buildingAddress50->setStreetName('Zomersestraatweg');
//        $buildingAddress50->setHouseNumber(14);
//        $buildingAddress50->setAddition('X');
//        $buildingAddress50->setZipcode('3234AT');
//        $buildingAddress50->setCity('Nooitgedacht');
//        $buildingAddress50->setRentalUnitNumber('VHE0050');
//        $buildingAddress50->setDaeb(true);
//        $buildingAddress50->setVtw($vtw1);
//        $buildingAddress50->setResidentialArea($residentialArea10);
//        $buildingAddress50->setBuildingType($buildingType10);
//        $buildingAddress50->setLivingType($livingType3);
//
//        $buildingAddress51->setConstructionYear(1954);
//        $buildingAddress51->setRenovationYear(1986);
//        $buildingAddress51->setStreetName('Straatnaam A');
//        $buildingAddress51->setHouseNumber(10);
//        $buildingAddress51->setAddition('A');
//        $buildingAddress51->setZipcode('1234AA');
//        $buildingAddress51->setCity('Woonplaats A');
//        $buildingAddress51->setRentalUnitNumber('TECH0001');
//        $buildingAddress51->setDaeb(true);
//        $buildingAddress51->setVtw($vtw18);
//        $buildingAddress51->setResidentialArea($residentialArea1);
//        $buildingAddress51->setBuildingType($buildingType1);
//        $buildingAddress51->setLivingType($livingType3);
//
//        $buildingAddress52->setConstructionYear(1998);
//        $buildingAddress52->setRenovationYear(2021);
//        $buildingAddress52->setStreetName('Straatnaam A');
//        $buildingAddress52->setHouseNumber(10);
//        $buildingAddress52->setAddition('A');
//        $buildingAddress52->setZipcode('1234AA');
//        $buildingAddress52->setCity('Woonplaats A');
//        $buildingAddress52->setRentalUnitNumber('TECH0002');
//        $buildingAddress52->setDaeb(true);
//        $buildingAddress52->setVtw($vtw2);
//        $buildingAddress52->setResidentialArea($residentialArea2);
//        $buildingAddress52->setBuildingType($buildingType2);
//        $buildingAddress52->setLivingType($livingType3);
//
//        $buildingAddress53->setConstructionYear(1984);
//        $buildingAddress53->setRenovationYear(2000);
//        $buildingAddress53->setStreetName('Straatnaam A');
//        $buildingAddress53->setHouseNumber(10);
//        $buildingAddress53->setAddition('A');
//        $buildingAddress53->setZipcode('1234AA');
//        $buildingAddress53->setCity('Woonplaats A');
//        $buildingAddress53->setRentalUnitNumber('TECH0003');
//        $buildingAddress53->setDaeb(true);
//        $buildingAddress53->setVtw($vtw1);
//        $buildingAddress53->setResidentialArea($residentialArea3);
//        $buildingAddress53->setBuildingType($buildingType3);
//        $buildingAddress53->setLivingType($livingType3);
//
//        $buildingAddress54->setConstructionYear(2010);
//        $buildingAddress54->setRenovationYear(2015);
//        $buildingAddress54->setStreetName('Straatnaam A');
//        $buildingAddress54->setHouseNumber(102);
//        $buildingAddress54->setAddition('');
//        $buildingAddress54->setZipcode('1234AA');
//        $buildingAddress54->setCity('Woonplaats A');
//        $buildingAddress54->setRentalUnitNumber('TECH0004');
//        $buildingAddress54->setDaeb(true);
//        $buildingAddress54->setVtw($vtw1);
//        $buildingAddress54->setResidentialArea($residentialArea4);
//        $buildingAddress54->setBuildingType($buildingType4);
//        $buildingAddress54->setLivingType($livingType3);
//
//        $buildingAddress55->setConstructionYear(1888);
//        $buildingAddress55->setRenovationYear(2005);
//        $buildingAddress55->setStreetName('Straatnaam A');
//        $buildingAddress55->setHouseNumber(10);
//        $buildingAddress55->setAddition('A');
//        $buildingAddress55->setZipcode('1234AA');
//        $buildingAddress55->setCity('Woonplaats A');
//        $buildingAddress55->setRentalUnitNumber('TECH0005');
//        $buildingAddress55->setDaeb(true);
//        $buildingAddress55->setVtw($vtw1);
//        $buildingAddress55->setResidentialArea($residentialArea5);
//        $buildingAddress55->setBuildingType($buildingType5);
//        $buildingAddress55->setLivingType($livingType3);
//
//        $buildingAddress56->setConstructionYear(1958);
//        $buildingAddress56->setRenovationYear(2000);
//        $buildingAddress56->setStreetName('Straatnaam A');
//        $buildingAddress56->setHouseNumber(10);
//        $buildingAddress56->setAddition('A');
//        $buildingAddress56->setZipcode('1234AA');
//        $buildingAddress56->setCity('Woonplaats A');
//        $buildingAddress56->setRentalUnitNumber('TECH0006');
//        $buildingAddress56->setDaeb(true);
//        $buildingAddress56->setVtw($vtw1);
//        $buildingAddress56->setResidentialArea($residentialArea6);
//        $buildingAddress56->setBuildingType($buildingType6);
//        $buildingAddress56->setLivingType($livingType3);
//
//        $buildingAddress57->setConstructionYear(2006);
//        $buildingAddress57->setRenovationYear(2016);
//        $buildingAddress57->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress57->setHouseNumber(10);
//        $buildingAddress57->setAddition('A');
//        $buildingAddress57->setZipcode('1234AA');
//        $buildingAddress57->setCity('Woonplaats A');
//        $buildingAddress57->setRentalUnitNumber('TECH0007');
//        $buildingAddress57->setDaeb(true);
//        $buildingAddress57->setVtw($vtw1);
//        $buildingAddress57->setResidentialArea($residentialArea7);
//        $buildingAddress57->setBuildingType($buildingType7);
//        $buildingAddress57->setLivingType($livingType3);
//
//        $buildingAddress58->setConstructionYear(2020);
//        $buildingAddress58->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
//        $buildingAddress58->setHouseNumber(10);
//        $buildingAddress58->setAddition('Bis');
//        $buildingAddress58->setZipcode('1234AA');
//        $buildingAddress58->setCity('Woonplaats A');
//        $buildingAddress58->setRentalUnitNumber('TECH0008');
//        $buildingAddress58->setDaeb(false);
//        $buildingAddress58->setVtw($vtw1);
//        $buildingAddress58->setResidentialArea($residentialArea8);
//        $buildingAddress58->setBuildingType($buildingType8);
//        $buildingAddress58->setLivingType($livingType3);
//
//        $buildingAddress59->setConstructionYear(1976);
//        $buildingAddress59->setRenovationYear(2001);
//        $buildingAddress59->setStreetName('Straatnaam A');
//        $buildingAddress59->setHouseNumber(10);
//        $buildingAddress59->setAddition('I');
//        $buildingAddress59->setZipcode('1234AA');
//        $buildingAddress59->setCity('Woonplaats A');
//        $buildingAddress59->setRentalUnitNumber('TECH0009');
//        $buildingAddress59->setDaeb(true);
//        $buildingAddress59->setVtw($vtw1);
//        $buildingAddress59->setResidentialArea($residentialArea9);
//        $buildingAddress59->setBuildingType($buildingType9);
//        $buildingAddress59->setLivingType($livingType3);
//
//        $buildingAddress60->setConstructionYear(1986);
//        $buildingAddress60->setRenovationYear(2002);
//        $buildingAddress60->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress60->setHouseNumber(10);
//        $buildingAddress60->setAddition('X');
//        $buildingAddress60->setZipcode('1234AA');
//        $buildingAddress60->setCity('Woonplaats A');
//        $buildingAddress60->setRentalUnitNumber('TECH0010');
//        $buildingAddress60->setDaeb(true);
//        $buildingAddress60->setVtw($vtw1);
//        $buildingAddress60->setResidentialArea($residentialArea10);
//        $buildingAddress60->setBuildingType($buildingType10);
//        $buildingAddress60->setLivingType($livingType3);
//
//        $buildingAddress61->setConstructionYear(1954);
//        $buildingAddress61->setRenovationYear(1986);
//        $buildingAddress61->setStreetName('Straatnaam A');
//        $buildingAddress61->setHouseNumber(10);
//        $buildingAddress61->setAddition('A');
//        $buildingAddress61->setZipcode('1234AA');
//        $buildingAddress61->setCity('Woonplaats A');
//        $buildingAddress61->setRentalUnitNumber('TECH0011');
//        $buildingAddress61->setDaeb(true);
//        $buildingAddress61->setVtw($vtw121);
//        $buildingAddress61->setResidentialArea($residentialArea1);
//        $buildingAddress61->setBuildingType($buildingType1);
//        $buildingAddress61->setLivingType($livingType3);
//
//        $buildingAddress62->setConstructionYear(1998);
//        $buildingAddress62->setRenovationYear(2021);
//        $buildingAddress62->setStreetName('Straatnaam A');
//        $buildingAddress62->setHouseNumber(10);
//        $buildingAddress62->setAddition('A');
//        $buildingAddress62->setZipcode('1234AA');
//        $buildingAddress62->setCity('Woonplaats A');
//        $buildingAddress62->setRentalUnitNumber('TECH0012');
//        $buildingAddress62->setDaeb(true);
//        $buildingAddress62->setVtw($vtw1);
//        $buildingAddress62->setResidentialArea($residentialArea2);
//        $buildingAddress62->setBuildingType($buildingType2);
//        $buildingAddress62->setLivingType($livingType3);
//
//        $buildingAddress63->setConstructionYear(1984);
//        $buildingAddress63->setRenovationYear(2000);
//        $buildingAddress63->setStreetName('Straatnaam A');
//        $buildingAddress63->setHouseNumber(10);
//        $buildingAddress63->setAddition('A');
//        $buildingAddress63->setZipcode('1234AA');
//        $buildingAddress63->setCity('Woonplaats A');
//        $buildingAddress63->setRentalUnitNumber('TECH0013');
//        $buildingAddress63->setDaeb(true);
//        $buildingAddress63->setVtw($vtw1);
//        $buildingAddress63->setResidentialArea($residentialArea3);
//        $buildingAddress63->setBuildingType($buildingType3);
//        $buildingAddress63->setLivingType($livingType3);
//
//        $buildingAddress64->setConstructionYear(2010);
//        $buildingAddress64->setRenovationYear(2019);
//        $buildingAddress64->setStreetName('Straatnaam A');
//        $buildingAddress64->setHouseNumber(102);
//        $buildingAddress64->setAddition('');
//        $buildingAddress64->setZipcode('1234AA');
//        $buildingAddress64->setCity('Woonplaats A');
//        $buildingAddress64->setRentalUnitNumber('TECH0014');
//        $buildingAddress64->setDaeb(true);
//        $buildingAddress64->setVtw($vtw1);
//        $buildingAddress64->setResidentialArea($residentialArea4);
//        $buildingAddress64->setBuildingType($buildingType4);
//        $buildingAddress64->setLivingType($livingType3);
//
//        $buildingAddress65->setConstructionYear(1888);
//        $buildingAddress65->setRenovationYear(2005);
//        $buildingAddress65->setStreetName('Straatnaam A');
//        $buildingAddress65->setHouseNumber(10);
//        $buildingAddress65->setAddition('A');
//        $buildingAddress65->setZipcode('1234AA');
//        $buildingAddress65->setCity('Woonplaats A');
//        $buildingAddress65->setRentalUnitNumber('TECH0015');
//        $buildingAddress65->setDaeb(true);
//        $buildingAddress65->setVtw($vtw1);
//        $buildingAddress65->setResidentialArea($residentialArea5);
//        $buildingAddress65->setBuildingType($buildingType5);
//        $buildingAddress65->setLivingType($livingType3);
//
//        $buildingAddress66->setConstructionYear(1958);
//        $buildingAddress66->setRenovationYear(2000);
//        $buildingAddress66->setStreetName('Straatnaam A');
//        $buildingAddress66->setHouseNumber(10);
//        $buildingAddress66->setAddition('A');
//        $buildingAddress66->setZipcode('1234AA');
//        $buildingAddress66->setCity('Woonplaats A');
//        $buildingAddress66->setRentalUnitNumber('TECH0016');
//        $buildingAddress66->setDaeb(true);
//        $buildingAddress66->setVtw($vtw1);
//        $buildingAddress66->setResidentialArea($residentialArea6);
//        $buildingAddress66->setBuildingType($buildingType6);
//        $buildingAddress66->setLivingType($livingType3);
//
//        $buildingAddress67->setConstructionYear(2006);
//        $buildingAddress67->setRenovationYear(2016);
//        $buildingAddress67->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress67->setHouseNumber(10);
//        $buildingAddress67->setAddition('A');
//        $buildingAddress67->setZipcode('1234AA');
//        $buildingAddress67->setCity('Woonplaats A');
//        $buildingAddress67->setRentalUnitNumber('TECH0017');
//        $buildingAddress67->setDaeb(true);
//        $buildingAddress67->setVtw($vtw1);
//        $buildingAddress67->setResidentialArea($residentialArea7);
//        $buildingAddress67->setBuildingType($buildingType7);
//        $buildingAddress67->setLivingType($livingType3);
//
//        $buildingAddress68->setConstructionYear(2000);
//        $buildingAddress68->setRenovationYear(2011);
//        $buildingAddress68->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
//        $buildingAddress68->setHouseNumber(10);
//        $buildingAddress68->setAddition('Bis');
//        $buildingAddress68->setZipcode('1234AB');
//        $buildingAddress68->setCity('Woonplaats A');
//        $buildingAddress68->setRentalUnitNumber('TECH0018');
//        $buildingAddress68->setDaeb(false);
//        $buildingAddress68->setVtw($vtw1);
//        $buildingAddress68->setResidentialArea($residentialArea8);
//        $buildingAddress68->setBuildingType($buildingType8);
//        $buildingAddress68->setLivingType($livingType3);
//
//        $buildingAddress69->setConstructionYear(1976);
//        $buildingAddress69->setRenovationYear(2001);
//        $buildingAddress69->setStreetName('Straatnaam A');
//        $buildingAddress69->setHouseNumber(10);
//        $buildingAddress69->setAddition('I');
//        $buildingAddress69->setZipcode('1233AA');
//        $buildingAddress69->setCity('Woonplaats A');
//        $buildingAddress69->setRentalUnitNumber('TECH0019');
//        $buildingAddress69->setDaeb(true);
//        $buildingAddress69->setVtw($vtw1);
//        $buildingAddress69->setResidentialArea($residentialArea9);
//        $buildingAddress69->setBuildingType($buildingType9);
//        $buildingAddress69->setLivingType($livingType3);
//
//        $buildingAddress70->setConstructionYear(1986);
//        $buildingAddress70->setRenovationYear(2002);
//        $buildingAddress70->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress70->setHouseNumber(10);
//        $buildingAddress70->setAddition('X');
//        $buildingAddress70->setZipcode('1234AA');
//        $buildingAddress70->setCity('Woonplaats A');
//        $buildingAddress70->setRentalUnitNumber('TECH0020');
//        $buildingAddress70->setDaeb(true);
//        $buildingAddress70->setVtw($vtw1);
//        $buildingAddress70->setResidentialArea($residentialArea10);
//        $buildingAddress70->setBuildingType($buildingType10);
//        $buildingAddress70->setLivingType($livingType3);
//
//        $buildingAddress71->setConstructionYear(1954);
//        $buildingAddress71->setRenovationYear(1986);
//        $buildingAddress71->setStreetName('Straatnaam A');
//        $buildingAddress71->setHouseNumber(10);
//        $buildingAddress71->setAddition('A');
//        $buildingAddress71->setZipcode('1234AA');
//        $buildingAddress71->setCity('Woonplaats A');
//        $buildingAddress71->setRentalUnitNumber('TECH0021');
//        $buildingAddress71->setDaeb(true);
//        $buildingAddress71->setVtw($vtw23);
//        $buildingAddress71->setResidentialArea($residentialArea1);
//        $buildingAddress71->setBuildingType($buildingType1);
//        $buildingAddress71->setLivingType($livingType3);
//
//        $buildingAddress72->setConstructionYear(1998);
//        $buildingAddress72->setRenovationYear(2021);
//        $buildingAddress72->setStreetName('Straatnaam A');
//        $buildingAddress72->setHouseNumber(10);
//        $buildingAddress72->setAddition('A');
//        $buildingAddress72->setZipcode('1234AA');
//        $buildingAddress72->setCity('Woonplaats A');
//        $buildingAddress72->setRentalUnitNumber('TECH0022');
//        $buildingAddress72->setDaeb(true);
//        $buildingAddress72->setVtw($vtw2);
//        $buildingAddress72->setResidentialArea($residentialArea2);
//        $buildingAddress72->setBuildingType($buildingType2);
//        $buildingAddress72->setLivingType($livingType3);
//
//        $buildingAddress73->setConstructionYear(1984);
//        $buildingAddress73->setRenovationYear(2000);
//        $buildingAddress73->setStreetName('Straatnaam A');
//        $buildingAddress73->setHouseNumber(10);
//        $buildingAddress73->setAddition('A');
//        $buildingAddress73->setZipcode('1234AA');
//        $buildingAddress73->setCity('Woonplaats A');
//        $buildingAddress73->setRentalUnitNumber('TECH0023');
//        $buildingAddress73->setDaeb(true);
//        $buildingAddress73->setVtw($vtw1);
//        $buildingAddress73->setResidentialArea($residentialArea3);
//        $buildingAddress73->setBuildingType($buildingType3);
//        $buildingAddress73->setLivingType($livingType3);
//
//        $buildingAddress74->setConstructionYear(2010);
//        $buildingAddress74->setRenovationYear(2019);
//        $buildingAddress74->setStreetName('Straatnaam A');
//        $buildingAddress74->setHouseNumber(102);
//        $buildingAddress74->setAddition('');
//        $buildingAddress74->setZipcode('1234AA');
//        $buildingAddress74->setCity('Woonplaats A');
//        $buildingAddress74->setRentalUnitNumber('TECH0024');
//        $buildingAddress74->setDaeb(false);
//        $buildingAddress74->setVtw($vtw1);
//        $buildingAddress74->setResidentialArea($residentialArea4);
//        $buildingAddress74->setBuildingType($buildingType4);
//        $buildingAddress74->setLivingType($livingType3);
//
//        $buildingAddress75->setConstructionYear(1888);
//        $buildingAddress75->setRenovationYear(2005);
//        $buildingAddress75->setStreetName('Straatnaam A');
//        $buildingAddress75->setHouseNumber(10);
//        $buildingAddress75->setAddition('A');
//        $buildingAddress75->setZipcode('1234AA');
//        $buildingAddress75->setCity('Woonplaats A');
//        $buildingAddress75->setRentalUnitNumber('TECH0025');
//        $buildingAddress75->setDaeb(true);
//        $buildingAddress75->setVtw($vtw1);
//        $buildingAddress75->setResidentialArea($residentialArea5);
//        $buildingAddress75->setBuildingType($buildingType5);
//        $buildingAddress75->setLivingType($livingType3);
//
//        $buildingAddress76->setConstructionYear(1958);
//        $buildingAddress76->setRenovationYear(2008);
//        $buildingAddress76->setStreetName('Straatnaam A');
//        $buildingAddress76->setHouseNumber(10);
//        $buildingAddress76->setAddition('A');
//        $buildingAddress76->setZipcode('1234AA');
//        $buildingAddress76->setCity('Woonplaats A');
//        $buildingAddress76->setRentalUnitNumber('TECH0026');
//        $buildingAddress76->setDaeb(true);
//        $buildingAddress76->setVtw($vtw1);
//        $buildingAddress76->setResidentialArea($residentialArea6);
//        $buildingAddress76->setBuildingType($buildingType6);
//        $buildingAddress76->setLivingType($livingType3);
//
//        $buildingAddress77->setConstructionYear(2006);
//        $buildingAddress77->setRenovationYear(2016);
//        $buildingAddress77->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress77->setHouseNumber(10);
//        $buildingAddress77->setAddition('A');
//        $buildingAddress77->setZipcode('1234AA');
//        $buildingAddress77->setCity('Woonplaats A');
//        $buildingAddress77->setRentalUnitNumber('TECH0027');
//        $buildingAddress77->setDaeb(true);
//        $buildingAddress77->setVtw($vtw1);
//        $buildingAddress77->setResidentialArea($residentialArea7);
//        $buildingAddress77->setBuildingType($buildingType7);
//        $buildingAddress77->setLivingType($livingType3);
//
//        $buildingAddress78->setConstructionYear(2000);
//        $buildingAddress78->setRenovationYear(2021);
//        $buildingAddress78->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
//        $buildingAddress78->setHouseNumber(10);
//        $buildingAddress78->setAddition('Bis');
//        $buildingAddress78->setZipcode('1234AB');
//        $buildingAddress78->setCity('Woonplaats A');
//        $buildingAddress78->setRentalUnitNumber('TECH0028');
//        $buildingAddress78->setDaeb(true);
//        $buildingAddress78->setVtw($vtw1);
//        $buildingAddress78->setResidentialArea($residentialArea8);
//        $buildingAddress78->setBuildingType($buildingType8);
//        $buildingAddress78->setLivingType($livingType3);
//
//        $buildingAddress79->setConstructionYear(1976);
//        $buildingAddress79->setRenovationYear(2001);
//        $buildingAddress79->setStreetName('Straatnaam A');
//        $buildingAddress79->setHouseNumber(10);
//        $buildingAddress79->setAddition('I');
//        $buildingAddress79->setZipcode('1234AA');
//        $buildingAddress79->setCity('Woonplaats A');
//        $buildingAddress79->setRentalUnitNumber('TECH0029');
//        $buildingAddress79->setDaeb(true);
//        $buildingAddress79->setVtw($vtw1);
//        $buildingAddress79->setResidentialArea($residentialArea9);
//        $buildingAddress79->setBuildingType($buildingType9);
//        $buildingAddress79->setLivingType($livingType3);
//
//        $buildingAddress80->setConstructionYear(1986);
//        $buildingAddress80->setRenovationYear(2002);
//        $buildingAddress80->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress80->setHouseNumber(10);
//        $buildingAddress80->setAddition('X');
//        $buildingAddress80->setZipcode('1234AA');
//        $buildingAddress80->setCity('Woonplaats A');
//        $buildingAddress80->setRentalUnitNumber('TECH0030');
//        $buildingAddress80->setDaeb(true);
//        $buildingAddress80->setVtw($vtw1);
//        $buildingAddress80->setResidentialArea($residentialArea10);
//        $buildingAddress80->setBuildingType($buildingType10);
//        $buildingAddress80->setLivingType($livingType3);
//
//        $buildingAddress81->setConstructionYear(1954);
//        $buildingAddress81->setRenovationYear(1986);
//        $buildingAddress81->setStreetName('Straatnaam A');
//        $buildingAddress81->setHouseNumber(10);
//        $buildingAddress81->setAddition('A');
//        $buildingAddress81->setZipcode('1234AA');
//        $buildingAddress81->setCity('Woonplaats A');
//        $buildingAddress81->setRentalUnitNumber('TECH0031');
//        $buildingAddress81->setDaeb(true);
//        $buildingAddress81->setVtw($vtw27);
//        $buildingAddress81->setResidentialArea($residentialArea1);
//        $buildingAddress81->setBuildingType($buildingType1);
//        $buildingAddress81->setLivingType($livingType3);
//
//        $buildingAddress82->setConstructionYear(1998);
//        $buildingAddress82->setRenovationYear(2021);
//        $buildingAddress82->setStreetName('Straatnaam A');
//        $buildingAddress82->setHouseNumber(10);
//        $buildingAddress82->setAddition('A');
//        $buildingAddress82->setZipcode('1234AA');
//        $buildingAddress82->setCity('Woonplaats A');
//        $buildingAddress82->setRentalUnitNumber('TECH0032');
//        $buildingAddress82->setDaeb(true);
//        $buildingAddress82->setVtw($vtw1);
//        $buildingAddress82->setResidentialArea($residentialArea2);
//        $buildingAddress82->setBuildingType($buildingType2);
//        $buildingAddress82->setLivingType($livingType3);
//
//        $buildingAddress83->setConstructionYear(1984);
//        $buildingAddress83->setRenovationYear(2000);
//        $buildingAddress83->setStreetName('Straatnaam A');
//        $buildingAddress83->setHouseNumber(10);
//        $buildingAddress83->setAddition('A');
//        $buildingAddress83->setZipcode('1234AA');
//        $buildingAddress83->setCity('Woonplaats A');
//        $buildingAddress83->setRentalUnitNumber('TECH0033');
//        $buildingAddress83->setDaeb(true);
//        $buildingAddress83->setVtw($vtw1);
//        $buildingAddress83->setResidentialArea($residentialArea3);
//        $buildingAddress83->setBuildingType($buildingType3);
//        $buildingAddress83->setLivingType($livingType3);
//
//        $buildingAddress84->setConstructionYear(2010);
//        $buildingAddress84->setRenovationYear(2019);
//        $buildingAddress84->setStreetName('Straatnaam A');
//        $buildingAddress84->setHouseNumber(102);
//        $buildingAddress84->setAddition('');
//        $buildingAddress84->setZipcode('1234AA');
//        $buildingAddress84->setCity('Woonplaats A');
//        $buildingAddress84->setRentalUnitNumber('TECH0034');
//        $buildingAddress84->setDaeb(false);
//        $buildingAddress84->setVtw($vtw1);
//        $buildingAddress84->setResidentialArea($residentialArea4);
//        $buildingAddress84->setBuildingType($buildingType4);
//        $buildingAddress84->setLivingType($livingType3);
//
//        $buildingAddress85->setConstructionYear(1988);
//        $buildingAddress85->setRenovationYear(2005);
//        $buildingAddress85->setStreetName('Straatnaam A');
//        $buildingAddress85->setHouseNumber(10);
//        $buildingAddress85->setAddition('A');
//        $buildingAddress85->setZipcode('1234AA');
//        $buildingAddress85->setCity('Woonplaats A');
//        $buildingAddress85->setRentalUnitNumber('TECH0035');
//        $buildingAddress85->setDaeb(true);
//        $buildingAddress85->setVtw($vtw1);
//        $buildingAddress85->setResidentialArea($residentialArea5);
//        $buildingAddress85->setBuildingType($buildingType5);
//        $buildingAddress85->setLivingType($livingType3);
//
//        $buildingAddress86->setConstructionYear(1958);
//        $buildingAddress86->setRenovationYear(2000);
//        $buildingAddress86->setStreetName('Straatnaam A');
//        $buildingAddress86->setHouseNumber(10);
//        $buildingAddress86->setAddition('A');
//        $buildingAddress86->setZipcode('1234AA');
//        $buildingAddress86->setCity('Woonplaats A');
//        $buildingAddress86->setRentalUnitNumber('TECH0036');
//        $buildingAddress86->setDaeb(true);
//        $buildingAddress86->setVtw($vtw1);
//        $buildingAddress86->setResidentialArea($residentialArea6);
//        $buildingAddress86->setBuildingType($buildingType6);
//        $buildingAddress86->setLivingType($livingType3);
//
//        $buildingAddress87->setConstructionYear(2006);
//        $buildingAddress87->setRenovationYear(2016);
//        $buildingAddress87->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress87->setHouseNumber(10);
//        $buildingAddress87->setAddition('A');
//        $buildingAddress87->setZipcode('1234AA');
//        $buildingAddress87->setCity('Woonplaats A');
//        $buildingAddress87->setRentalUnitNumber('TECH0037');
//        $buildingAddress87->setDaeb(true);
//        $buildingAddress87->setVtw($vtw1);
//        $buildingAddress87->setResidentialArea($residentialArea7);
//        $buildingAddress87->setBuildingType($buildingType7);
//        $buildingAddress87->setLivingType($livingType3);
//
//        $buildingAddress88->setConstructionYear(2000);
//        $buildingAddress88->setRenovationYear(2013);
//        $buildingAddress88->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
//        $buildingAddress88->setHouseNumber(10);
//        $buildingAddress88->setAddition('Bis');
//        $buildingAddress88->setZipcode('1234AA');
//        $buildingAddress88->setCity('Woonplaats A');
//        $buildingAddress88->setRentalUnitNumber('TECH0038');
//        $buildingAddress88->setDaeb(false);
//        $buildingAddress88->setVtw($vtw1);
//        $buildingAddress88->setResidentialArea($residentialArea8);
//        $buildingAddress88->setBuildingType($buildingType8);
//        $buildingAddress88->setLivingType($livingType3);
//
//        $buildingAddress89->setConstructionYear(1976);
//        $buildingAddress89->setRenovationYear(2001);
//        $buildingAddress89->setStreetName('Straatnaam A');
//        $buildingAddress89->setHouseNumber(10);
//        $buildingAddress89->setAddition('I');
//        $buildingAddress89->setZipcode('1234AA');
//        $buildingAddress89->setCity('Woonplaats A');
//        $buildingAddress89->setRentalUnitNumber('TECH0039');
//        $buildingAddress89->setDaeb(true);
//        $buildingAddress89->setVtw($vtw1);
//        $buildingAddress89->setResidentialArea($residentialArea9);
//        $buildingAddress89->setBuildingType($buildingType9);
//        $buildingAddress89->setLivingType($livingType3);
//
//        $buildingAddress90->setConstructionYear(1986);
//        $buildingAddress90->setRenovationYear(2002);
//        $buildingAddress90->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress90->setHouseNumber(10);
//        $buildingAddress90->setAddition('X');
//        $buildingAddress90->setZipcode('1234AA');
//        $buildingAddress90->setCity('Woonplaats A');
//        $buildingAddress90->setRentalUnitNumber('TECH0040');
//        $buildingAddress90->setDaeb(true);
//        $buildingAddress90->setVtw($vtw1);
//        $buildingAddress90->setResidentialArea($residentialArea10);
//        $buildingAddress90->setBuildingType($buildingType10);
//        $buildingAddress90->setLivingType($livingType3);
//
//        $buildingAddress91->setConstructionYear(1954);
//        $buildingAddress91->setRenovationYear(1986);
//        $buildingAddress91->setStreetName('Straatnaam A');
//        $buildingAddress91->setHouseNumber(10);
//        $buildingAddress91->setAddition('A');
//        $buildingAddress91->setZipcode('1234AA');
//        $buildingAddress91->setCity('Woonplaats A');
//        $buildingAddress91->setRentalUnitNumber('TECH0041');
//        $buildingAddress91->setDaeb(true);
//        $buildingAddress91->setVtw($vtw42);
//        $buildingAddress91->setResidentialArea($residentialArea1);
//        $buildingAddress91->setBuildingType($buildingType1);
//        $buildingAddress91->setLivingType($livingType3);
//
//        $buildingAddress92->setConstructionYear(1998);
//        $buildingAddress92->setRenovationYear(2021);
//        $buildingAddress92->setStreetName('Straatnaam A');
//        $buildingAddress92->setHouseNumber(10);
//        $buildingAddress92->setAddition('A');
//        $buildingAddress92->setZipcode('1234AA');
//        $buildingAddress92->setCity('Woonplaats A');
//        $buildingAddress92->setRentalUnitNumber('TECH0042');
//        $buildingAddress92->setDaeb(true);
//        $buildingAddress92->setVtw($vtw1);
//        $buildingAddress92->setResidentialArea($residentialArea2);
//        $buildingAddress92->setBuildingType($buildingType2);
//        $buildingAddress92->setLivingType($livingType3);
//
//        $buildingAddress93->setConstructionYear(1984);
//        $buildingAddress93->setRenovationYear(2000);
//        $buildingAddress93->setStreetName('Straatnaam A');
//        $buildingAddress93->setHouseNumber(10);
//        $buildingAddress93->setAddition('A');
//        $buildingAddress93->setZipcode('1234AA');
//        $buildingAddress93->setCity('Woonplaats A');
//        $buildingAddress93->setRentalUnitNumber('TECH0043');
//        $buildingAddress93->setDaeb(true);
//        $buildingAddress93->setVtw($vtw1);
//        $buildingAddress93->setResidentialArea($residentialArea3);
//        $buildingAddress93->setBuildingType($buildingType3);
//        $buildingAddress93->setLivingType($livingType3);
//
//        $buildingAddress94->setConstructionYear(2010);
//        $buildingAddress94->setRenovationYear(2019);
//        $buildingAddress94->setStreetName('Straatnaam A');
//        $buildingAddress94->setHouseNumber(102);
//        $buildingAddress94->setAddition('');
//        $buildingAddress94->setZipcode('1234AA');
//        $buildingAddress94->setCity('Woonplaats A');
//        $buildingAddress94->setRentalUnitNumber('TECH0044');
//        $buildingAddress94->setDaeb(true);
//        $buildingAddress94->setVtw($vtw1);
//        $buildingAddress94->setResidentialArea($residentialArea4);
//        $buildingAddress94->setBuildingType($buildingType4);
//        $buildingAddress94->setLivingType($livingType3);
//
//        $buildingAddress95->setConstructionYear(1988);
//        $buildingAddress95->setRenovationYear(2005);
//        $buildingAddress95->setStreetName('Straatnaam A');
//        $buildingAddress95->setHouseNumber(10);
//        $buildingAddress95->setAddition('A');
//        $buildingAddress95->setZipcode('1234AA');
//        $buildingAddress95->setCity('Woonplaats A');
//        $buildingAddress95->setRentalUnitNumber('TECH0045');
//        $buildingAddress95->setDaeb(true);
//        $buildingAddress95->setVtw($vtw1);
//        $buildingAddress95->setResidentialArea($residentialArea5);
//        $buildingAddress95->setBuildingType($buildingType5);
//        $buildingAddress95->setLivingType($livingType3);
//
//        $buildingAddress96->setConstructionYear(1958);
//        $buildingAddress96->setRenovationYear(2000);
//        $buildingAddress96->setStreetName('Straatnaam A');
//        $buildingAddress96->setHouseNumber(10);
//        $buildingAddress96->setAddition('A');
//        $buildingAddress96->setZipcode('1234AA');
//        $buildingAddress96->setCity('Woonplaats A');
//        $buildingAddress96->setRentalUnitNumber('TECH0046');
//        $buildingAddress96->setDaeb(true);
//        $buildingAddress96->setVtw($vtw1);
//        $buildingAddress96->setResidentialArea($residentialArea6);
//        $buildingAddress96->setBuildingType($buildingType6);
//        $buildingAddress96->setLivingType($livingType3);
//
//        $buildingAddress97->setConstructionYear(2006);
//        $buildingAddress97->setRenovationYear(2016);
//        $buildingAddress97->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress97->setHouseNumber(10);
//        $buildingAddress97->setAddition('A');
//        $buildingAddress97->setZipcode('1234AA');
//        $buildingAddress97->setCity('Woonplaats A');
//        $buildingAddress97->setRentalUnitNumber('TECH0047');
//        $buildingAddress97->setDaeb(false);
//        $buildingAddress97->setVtw($vtw1);
//        $buildingAddress97->setResidentialArea($residentialArea7);
//        $buildingAddress97->setBuildingType($buildingType7);
//        $buildingAddress97->setLivingType($livingType3);
//
//        $buildingAddress98->setConstructionYear(2000);
//        $buildingAddress98->setRenovationYear(2021);
//        $buildingAddress98->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
//        $buildingAddress98->setHouseNumber(10);
//        $buildingAddress98->setAddition('Bis');
//        $buildingAddress98->setZipcode('1234AB');
//        $buildingAddress98->setCity('Woonplaats A');
//        $buildingAddress98->setRentalUnitNumber('TECH0048');
//        $buildingAddress98->setDaeb(true);
//        $buildingAddress98->setVtw($vtw1);
//        $buildingAddress98->setResidentialArea($residentialArea8);
//        $buildingAddress98->setBuildingType($buildingType8);
//        $buildingAddress98->setLivingType($livingType3);
//
//        $buildingAddress99->setConstructionYear(1976);
//        $buildingAddress99->setRenovationYear(2001);
//        $buildingAddress99->setStreetName('Straatnaam A');
//        $buildingAddress99->setHouseNumber(10);
//        $buildingAddress99->setAddition('I');
//        $buildingAddress99->setZipcode('1234AA');
//        $buildingAddress99->setCity('Woonplaats A');
//        $buildingAddress99->setRentalUnitNumber('TECH0049');
//        $buildingAddress99->setDaeb(true);
//        $buildingAddress99->setVtw($vtw1);
//        $buildingAddress99->setResidentialArea($residentialArea9);
//        $buildingAddress99->setBuildingType($buildingType9);
//        $buildingAddress99->setLivingType($livingType3);
//
//        $buildingAddress100->setConstructionYear(1986);
//        $buildingAddress100->setRenovationYear(2002);
//        $buildingAddress100->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress100->setHouseNumber(10);
//        $buildingAddress100->setAddition('X');
//        $buildingAddress100->setZipcode('1234AA');
//        $buildingAddress100->setCity('Woonplaats A');
//        $buildingAddress100->setRentalUnitNumber('TECH0050');
//        $buildingAddress100->setDaeb(true);
//        $buildingAddress100->setVtw($vtw1);
//        $buildingAddress100->setResidentialArea($residentialArea10);
//        $buildingAddress100->setBuildingType($buildingType10);
//        $buildingAddress100->setLivingType($livingType3);
//
//        $buildingAddress101->setConstructionYear(1954);
//        $buildingAddress101->setRenovationYear(1986);
//        $buildingAddress101->setStreetName('Straatnaam A');
//        $buildingAddress101->setHouseNumber(10);
//        $buildingAddress101->setAddition('A');
//        $buildingAddress101->setZipcode('1234AA');
//        $buildingAddress101->setCity('Woonplaats A');
//        $buildingAddress101->setRentalUnitNumber('ALG0001');
//        $buildingAddress101->setDaeb(true);
//        $buildingAddress101->setVtw($vtw45);
//        $buildingAddress101->setResidentialArea($residentialArea1);
//        $buildingAddress101->setBuildingType($buildingType1);
//        $buildingAddress101->setLivingType($livingType3);
//
//        $buildingAddress102->setConstructionYear(1998);
//        $buildingAddress102->setRenovationYear(2021);
//        $buildingAddress102->setStreetName('Straatnaam A');
//        $buildingAddress102->setHouseNumber(10);
//        $buildingAddress102->setAddition('A');
//        $buildingAddress102->setZipcode('1234AA');
//        $buildingAddress102->setCity('Woonplaats A');
//        $buildingAddress102->setRentalUnitNumber('ALG0002');
//        $buildingAddress102->setDaeb(true);
//        $buildingAddress102->setVtw($vtw1);
//        $buildingAddress102->setResidentialArea($residentialArea2);
//        $buildingAddress102->setBuildingType($buildingType2);
//        $buildingAddress102->setLivingType($livingType3);
//
//        $buildingAddress103->setConstructionYear(1984);
//        $buildingAddress103->setRenovationYear(2000);
//        $buildingAddress103->setStreetName('Straatnaam A');
//        $buildingAddress103->setHouseNumber(10);
//        $buildingAddress103->setAddition('A');
//        $buildingAddress103->setZipcode('1234AA');
//        $buildingAddress103->setCity('Woonplaats A');
//        $buildingAddress103->setRentalUnitNumber('ALG0003');
//        $buildingAddress103->setDaeb(true);
//        $buildingAddress103->setVtw($vtw1);
//        $buildingAddress103->setResidentialArea($residentialArea3);
//        $buildingAddress103->setBuildingType($buildingType3);
//        $buildingAddress103->setLivingType($livingType3);
//
//        $buildingAddress104->setConstructionYear(2010);
//        $buildingAddress104->setRenovationYear(2019);
//        $buildingAddress104->setStreetName('Straatnaam A');
//        $buildingAddress104->setHouseNumber(102);
//        $buildingAddress104->setAddition('');
//        $buildingAddress104->setZipcode('1234AA');
//        $buildingAddress104->setCity('Woonplaats A');
//        $buildingAddress104->setRentalUnitNumber('ALG0004');
//        $buildingAddress104->setDaeb(true);
//        $buildingAddress104->setVtw($vtw1);
//        $buildingAddress104->setResidentialArea($residentialArea4);
//        $buildingAddress104->setBuildingType($buildingType4);
//        $buildingAddress104->setLivingType($livingType3);
//
//        $buildingAddress105->setConstructionYear(1988);
//        $buildingAddress105->setRenovationYear(2005);
//        $buildingAddress105->setStreetName('Straatnaam A');
//        $buildingAddress105->setHouseNumber(10);
//        $buildingAddress105->setAddition('A');
//        $buildingAddress105->setZipcode('1234AA');
//        $buildingAddress105->setCity('Woonplaats A');
//        $buildingAddress105->setRentalUnitNumber('ALG0005');
//        $buildingAddress105->setDaeb(false);
//        $buildingAddress105->setVtw($vtw1);
//        $buildingAddress105->setResidentialArea($residentialArea5);
//        $buildingAddress105->setBuildingType($buildingType5);
//        $buildingAddress105->setLivingType($livingType3);
//
//        $buildingAddress106->setConstructionYear(1958);
//        $buildingAddress106->setRenovationYear(2000);
//        $buildingAddress106->setStreetName('Straatnaam A');
//        $buildingAddress106->setHouseNumber(10);
//        $buildingAddress106->setAddition('A');
//        $buildingAddress106->setZipcode('1234AA');
//        $buildingAddress106->setCity('Woonplaats A');
//        $buildingAddress106->setRentalUnitNumber('ALG0006');
//        $buildingAddress106->setDaeb(true);
//        $buildingAddress106->setVtw($vtw1);
//        $buildingAddress106->setResidentialArea($residentialArea6);
//        $buildingAddress106->setBuildingType($buildingType6);
//        $buildingAddress106->setLivingType($livingType3);
//
//        $buildingAddress107->setConstructionYear(2006);
//        $buildingAddress107->setRenovationYear(2016);
//        $buildingAddress107->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress107->setHouseNumber(10);
//        $buildingAddress107->setAddition('A');
//        $buildingAddress107->setZipcode('1234AA');
//        $buildingAddress107->setCity('Woonplaats A');
//        $buildingAddress107->setRentalUnitNumber('ALG0007');
//        $buildingAddress107->setDaeb(true);
//        $buildingAddress107->setVtw($vtw1);
//        $buildingAddress107->setResidentialArea($residentialArea7);
//        $buildingAddress107->setBuildingType($buildingType7);
//        $buildingAddress107->setLivingType($livingType3);
//
//        $buildingAddress108->setConstructionYear(2000);
//        $buildingAddress108->setRenovationYear(2021);
//        $buildingAddress108->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
//        $buildingAddress108->setHouseNumber(10);
//        $buildingAddress108->setAddition('Bis');
//        $buildingAddress108->setZipcode('1234AA');
//        $buildingAddress108->setCity('Woonplaats A');
//        $buildingAddress108->setRentalUnitNumber('ALG0008');
//        $buildingAddress108->setDaeb(true);
//        $buildingAddress108->setVtw($vtw1);
//        $buildingAddress108->setResidentialArea($residentialArea8);
//        $buildingAddress108->setBuildingType($buildingType8);
//        $buildingAddress108->setLivingType($livingType3);
//
//        $buildingAddress109->setConstructionYear(1976);
//        $buildingAddress109->setRenovationYear(2001);
//        $buildingAddress109->setStreetName('Straatnaam A');
//        $buildingAddress109->setHouseNumber(10);
//        $buildingAddress109->setAddition('I');
//        $buildingAddress109->setZipcode('1234AA');
//        $buildingAddress109->setCity('Woonplaats A');
//        $buildingAddress109->setRentalUnitNumber('ALG0009');
//        $buildingAddress109->setDaeb(true);
//        $buildingAddress109->setVtw($vtw1);
//        $buildingAddress109->setResidentialArea($residentialArea9);
//        $buildingAddress109->setBuildingType($buildingType9);
//        $buildingAddress109->setLivingType($livingType3);
//
//        $buildingAddress110->setConstructionYear(1986);
//        $buildingAddress110->setRenovationYear(2002);
//        $buildingAddress110->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress110->setHouseNumber(10);
//        $buildingAddress110->setAddition('X');
//        $buildingAddress110->setZipcode('1234AA');
//        $buildingAddress110->setCity('Woonplaats A');
//        $buildingAddress110->setRentalUnitNumber('ALG0010');
//        $buildingAddress110->setDaeb(true);
//        $buildingAddress110->setVtw($vtw1);
//        $buildingAddress110->setResidentialArea($residentialArea10);
//        $buildingAddress110->setBuildingType($buildingType10);
//        $buildingAddress110->setLivingType($livingType3);
//
//        $buildingAddress111->setConstructionYear(1954);
//        $buildingAddress111->setRenovationYear(1986);
//        $buildingAddress111->setStreetName('Straatnaam A');
//        $buildingAddress111->setHouseNumber(10);
//        $buildingAddress111->setAddition('A');
//        $buildingAddress111->setZipcode('1234AA');
//        $buildingAddress111->setCity('Woonplaats A');
//        $buildingAddress111->setRentalUnitNumber('ALG0011');
//        $buildingAddress111->setDaeb(true);
//        $buildingAddress111->setVtw($vtw67);
//        $buildingAddress111->setResidentialArea($residentialArea1);
//        $buildingAddress111->setBuildingType($buildingType1);
//        $buildingAddress111->setLivingType($livingType3);
//
//        $buildingAddress112->setConstructionYear(1998);
//        $buildingAddress112->setRenovationYear(2021);
//        $buildingAddress112->setStreetName('Straatnaam A');
//        $buildingAddress112->setHouseNumber(10);
//        $buildingAddress112->setAddition('A');
//        $buildingAddress112->setZipcode('1234AA');
//        $buildingAddress112->setCity('Woonplaats A');
//        $buildingAddress112->setRentalUnitNumber('ALG0012');
//        $buildingAddress112->setDaeb(true);
//        $buildingAddress112->setVtw($vtw1);
//        $buildingAddress112->setResidentialArea($residentialArea2);
//        $buildingAddress112->setBuildingType($buildingType2);
//        $buildingAddress112->setLivingType($livingType3);
//
//        $buildingAddress113->setConstructionYear(1984);
//        $buildingAddress113->setRenovationYear(2000);
//        $buildingAddress113->setStreetName('Straatnaam A');
//        $buildingAddress113->setHouseNumber(10);
//        $buildingAddress113->setAddition('A');
//        $buildingAddress113->setZipcode('1234AA');
//        $buildingAddress113->setCity('Woonplaats A');
//        $buildingAddress113->setRentalUnitNumber('ALG0013');
//        $buildingAddress113->setDaeb(true);
//        $buildingAddress113->setVtw($vtw1);
//        $buildingAddress113->setResidentialArea($residentialArea3);
//        $buildingAddress113->setBuildingType($buildingType3);
//        $buildingAddress113->setLivingType($livingType3);
//
//        $buildingAddress114->setConstructionYear(2010);
//        $buildingAddress114->setRenovationYear(2019);
//        $buildingAddress114->setStreetName('Straatnaam A');
//        $buildingAddress114->setHouseNumber(102);
//        $buildingAddress114->setAddition('');
//        $buildingAddress114->setZipcode('1234AA');
//        $buildingAddress114->setCity('Woonplaats A');
//        $buildingAddress114->setRentalUnitNumber('ALG0014');
//        $buildingAddress114->setDaeb(true);
//        $buildingAddress114->setVtw($vtw1);
//        $buildingAddress114->setResidentialArea($residentialArea4);
//        $buildingAddress114->setBuildingType($buildingType4);
//        $buildingAddress114->setLivingType($livingType3);
//
//        $buildingAddress115->setConstructionYear(1988);
//        $buildingAddress115->setRenovationYear(2005);
//        $buildingAddress115->setStreetName('Straatnaam A');
//        $buildingAddress115->setHouseNumber(10);
//        $buildingAddress115->setAddition('A');
//        $buildingAddress115->setZipcode('1234AA');
//        $buildingAddress115->setCity('Woonplaats A');
//        $buildingAddress115->setRentalUnitNumber('ALG0015');
//        $buildingAddress115->setDaeb(true);
//        $buildingAddress115->setVtw($vtw1);
//        $buildingAddress115->setResidentialArea($residentialArea5);
//        $buildingAddress115->setBuildingType($buildingType5);
//        $buildingAddress115->setLivingType($livingType3);
//
//        $buildingAddress116->setConstructionYear(1958);
//        $buildingAddress116->setRenovationYear(2000);
//        $buildingAddress116->setStreetName('Straatnaam A');
//        $buildingAddress116->setHouseNumber(10);
//        $buildingAddress116->setAddition('A');
//        $buildingAddress116->setZipcode('1234AA');
//        $buildingAddress116->setCity('Woonplaats A');
//        $buildingAddress116->setRentalUnitNumber('ALG0016');
//        $buildingAddress116->setDaeb(true);
//        $buildingAddress116->setVtw($vtw1);
//        $buildingAddress116->setResidentialArea($residentialArea6);
//        $buildingAddress116->setBuildingType($buildingType6);
//        $buildingAddress116->setLivingType($livingType3);
//
//        $buildingAddress117->setConstructionYear(2006);
//        $buildingAddress117->setRenovationYear(2016);
//        $buildingAddress117->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress117->setHouseNumber(10);
//        $buildingAddress117->setAddition('A');
//        $buildingAddress117->setZipcode('1234AA');
//        $buildingAddress117->setCity('Woonplaats A');
//        $buildingAddress117->setRentalUnitNumber('ALG0017');
//        $buildingAddress117->setDaeb(true);
//        $buildingAddress117->setVtw($vtw1);
//        $buildingAddress117->setResidentialArea($residentialArea7);
//        $buildingAddress117->setBuildingType($buildingType7);
//        $buildingAddress117->setLivingType($livingType3);
//
//        $buildingAddress118->setConstructionYear(2000);
//        $buildingAddress118->setRenovationYear(2021);
//        $buildingAddress118->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
//        $buildingAddress118->setHouseNumber(10);
//        $buildingAddress118->setAddition('Bis');
//        $buildingAddress118->setZipcode('1234AB');
//        $buildingAddress118->setCity('Woonplaats A');
//        $buildingAddress118->setRentalUnitNumber('ALG0018');
//        $buildingAddress118->setDaeb(true);
//        $buildingAddress118->setVtw($vtw1);
//        $buildingAddress118->setResidentialArea($residentialArea8);
//        $buildingAddress118->setBuildingType($buildingType8);
//        $buildingAddress118->setLivingType($livingType3);
//
//        $buildingAddress119->setConstructionYear(1976);
//        $buildingAddress119->setRenovationYear(2001);
//        $buildingAddress119->setStreetName('Straatnaam A');
//        $buildingAddress119->setHouseNumber(10);
//        $buildingAddress119->setAddition('I');
//        $buildingAddress119->setZipcode('1234AA');
//        $buildingAddress119->setCity('Woonplaats A');
//        $buildingAddress119->setRentalUnitNumber('ALG0019');
//        $buildingAddress119->setDaeb(true);
//        $buildingAddress119->setVtw($vtw1);
//        $buildingAddress119->setResidentialArea($residentialArea9);
//        $buildingAddress119->setBuildingType($buildingType9);
//        $buildingAddress119->setLivingType($livingType3);
//
//        $buildingAddress120->setConstructionYear(1986);
//        $buildingAddress120->setRenovationYear(2002);
//        $buildingAddress120->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress120->setHouseNumber(10);
//        $buildingAddress120->setAddition('X');
//        $buildingAddress120->setZipcode('1234AA');
//        $buildingAddress120->setCity('Woonplaats A');
//        $buildingAddress120->setRentalUnitNumber('ALG0020');
//        $buildingAddress120->setDaeb(true);
//        $buildingAddress120->setVtw($vtw1);
//        $buildingAddress120->setResidentialArea($residentialArea10);
//        $buildingAddress120->setBuildingType($buildingType10);
//        $buildingAddress120->setLivingType($livingType3);
//
//        $buildingAddress121->setConstructionYear(1954);
//        $buildingAddress121->setRenovationYear(1986);
//        $buildingAddress121->setStreetName('Straatnaam A');
//        $buildingAddress121->setHouseNumber(10);
//        $buildingAddress121->setAddition('A');
//        $buildingAddress121->setZipcode('1234AA');
//        $buildingAddress121->setCity('Woonplaats A');
//        $buildingAddress121->setRentalUnitNumber('ALG0021');
//        $buildingAddress121->setDaeb(true);
//        $buildingAddress121->setVtw($vtw58);
//        $buildingAddress121->setResidentialArea($residentialArea1);
//        $buildingAddress121->setBuildingType($buildingType1);
//        $buildingAddress121->setLivingType($livingType3);
//
//        $buildingAddress122->setConstructionYear(1998);
//        $buildingAddress122->setRenovationYear(2021);
//        $buildingAddress122->setStreetName('Straatnaam A');
//        $buildingAddress122->setHouseNumber(10);
//        $buildingAddress122->setAddition('A');
//        $buildingAddress122->setZipcode('1234AA');
//        $buildingAddress122->setCity('Woonplaats A');
//        $buildingAddress122->setRentalUnitNumber('ALG0022');
//        $buildingAddress122->setDaeb(true);
//        $buildingAddress122->setVtw($vtw1);
//        $buildingAddress122->setResidentialArea($residentialArea2);
//        $buildingAddress122->setBuildingType($buildingType2);
//        $buildingAddress122->setLivingType($livingType3);
//
//        $buildingAddress123->setConstructionYear(1984);
//        $buildingAddress123->setRenovationYear(2000);
//        $buildingAddress123->setStreetName('Straatnaam A');
//        $buildingAddress123->setHouseNumber(10);
//        $buildingAddress123->setAddition('A');
//        $buildingAddress123->setZipcode('1234AA');
//        $buildingAddress123->setCity('Woonplaats A');
//        $buildingAddress123->setRentalUnitNumber('ALG0023');
//        $buildingAddress123->setDaeb(true);
//        $buildingAddress123->setVtw($vtw1);
//        $buildingAddress123->setResidentialArea($residentialArea3);
//        $buildingAddress123->setBuildingType($buildingType3);
//        $buildingAddress123->setLivingType($livingType3);
//
//        $buildingAddress124->setConstructionYear(2010);
//        $buildingAddress124->setRenovationYear(2019);
//        $buildingAddress124->setStreetName('Straatnaam A');
//        $buildingAddress124->setHouseNumber(102);
//        $buildingAddress124->setAddition('');
//        $buildingAddress124->setZipcode('1234AA');
//        $buildingAddress124->setCity('Woonplaats A');
//        $buildingAddress124->setRentalUnitNumber('ALG0024');
//        $buildingAddress124->setDaeb(true);
//        $buildingAddress124->setVtw($vtw1);
//        $buildingAddress124->setResidentialArea($residentialArea4);
//        $buildingAddress124->setBuildingType($buildingType4);
//        $buildingAddress124->setLivingType($livingType3);
//
//        $buildingAddress125->setConstructionYear(1988);
//        $buildingAddress125->setRenovationYear(2005);
//        $buildingAddress125->setStreetName('Straatnaam A');
//        $buildingAddress125->setHouseNumber(10);
//        $buildingAddress125->setAddition('A');
//        $buildingAddress125->setZipcode('1234AA');
//        $buildingAddress125->setCity('Woonplaats A');
//        $buildingAddress125->setRentalUnitNumber('ALG0025');
//        $buildingAddress125->setDaeb(true);
//        $buildingAddress125->setVtw($vtw1);
//        $buildingAddress125->setResidentialArea($residentialArea5);
//        $buildingAddress125->setBuildingType($buildingType5);
//        $buildingAddress125->setLivingType($livingType3);
//
//        $buildingAddress126->setConstructionYear(1958);
//        $buildingAddress126->setRenovationYear(2000);
//        $buildingAddress126->setStreetName('Straatnaam A');
//        $buildingAddress126->setHouseNumber(10);
//        $buildingAddress126->setAddition('A');
//        $buildingAddress126->setZipcode('1234AA');
//        $buildingAddress126->setCity('Woonplaats A');
//        $buildingAddress126->setRentalUnitNumber('ALG0026');
//        $buildingAddress126->setDaeb(true);
//        $buildingAddress126->setVtw($vtw1);
//        $buildingAddress126->setResidentialArea($residentialArea6);
//        $buildingAddress126->setBuildingType($buildingType6);
//        $buildingAddress126->setLivingType($livingType3);
//
//        $buildingAddress127->setConstructionYear(2006);
//        $buildingAddress127->setRenovationYear(2016);
//        $buildingAddress127->setStreetName('Æ æ Œ œ Straatnaam A');
//        $buildingAddress127->setHouseNumber(10);
//        $buildingAddress127->setAddition('A');
//        $buildingAddress127->setZipcode('1234AA');
//        $buildingAddress127->setCity('Woonplaats A');
//        $buildingAddress127->setRentalUnitNumber('ALG0027');
//        $buildingAddress127->setDaeb(true);
//        $buildingAddress127->setVtw($vtw1);
//        $buildingAddress127->setResidentialArea($residentialArea7);
//        $buildingAddress127->setBuildingType($buildingType7);
//        $buildingAddress127->setLivingType($livingType3);
//
//        $buildingAddress128->setConstructionYear(2000);
//        $buildingAddress128->setRenovationYear(2021);
//        $buildingAddress128->setStreetName('Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ Straatnaam A');
//        $buildingAddress128->setHouseNumber(10);
//        $buildingAddress128->setAddition('Bis');
//        $buildingAddress128->setZipcode('1234AB');
//        $buildingAddress128->setCity('Woonplaats A');
//        $buildingAddress128->setRentalUnitNumber('ALG0028');
//        $buildingAddress128->setDaeb(true);
//        $buildingAddress128->setVtw($vtw1);
//        $buildingAddress128->setResidentialArea($residentialArea8);
//        $buildingAddress128->setBuildingType($buildingType8);
//        $buildingAddress128->setLivingType($livingType3);
//
//        $buildingAddress129->setConstructionYear(1976);
//        $buildingAddress129->setRenovationYear(2001);
//        $buildingAddress129->setStreetName('Straatnaam A');
//        $buildingAddress129->setHouseNumber(10);
//        $buildingAddress129->setAddition('I');
//        $buildingAddress129->setZipcode('1234AA');
//        $buildingAddress129->setCity('Woonplaats A');
//        $buildingAddress129->setRentalUnitNumber('ALG0029');
//        $buildingAddress129->setDaeb(true);
//        $buildingAddress129->setVtw($vtw1);
//        $buildingAddress129->setResidentialArea($residentialArea9);
//        $buildingAddress129->setBuildingType($buildingType9);
//        $buildingAddress129->setLivingType($livingType3);
//
//        $buildingAddress130->setConstructionYear(1986);
//        $buildingAddress130->setRenovationYear(2002);
//        $buildingAddress130->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress130->setHouseNumber(10);
//        $buildingAddress130->setAddition('X');
//        $buildingAddress130->setZipcode('1234AA');
//        $buildingAddress130->setCity('Woonplaats A');
//        $buildingAddress130->setRentalUnitNumber('ALG0030');
//        $buildingAddress130->setDaeb(true);
//        $buildingAddress130->setVtw($vtw1);
//        $buildingAddress130->setResidentialArea($residentialArea10);
//        $buildingAddress130->setBuildingType($buildingType10);
//        $buildingAddress130->setLivingType($livingType3);
//
//        $buildingAddress131->setConstructionYear(1986);
//        $buildingAddress131->setRenovationYear(2002);
//        $buildingAddress131->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress131->setHouseNumber(10);
//        $buildingAddress131->setAddition('X');
//        $buildingAddress131->setZipcode('1234AA');
//        $buildingAddress131->setCity('Woonplaats A');
//        $buildingAddress131->setRentalUnitNumber('ALG0031');
//        $buildingAddress131->setDaeb(true);
//        $buildingAddress131->setVtw($vtw1);
//        $buildingAddress131->setResidentialArea($residentialArea10);
//        $buildingAddress131->setBuildingType($buildingType10);
//        $buildingAddress131->setLivingType($livingType3);
//
//        $buildingAddress132->setConstructionYear(1986);
//        $buildingAddress132->setRenovationYear(2002);
//        $buildingAddress132->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress132->setHouseNumber(10);
//        $buildingAddress132->setAddition('X');
//        $buildingAddress132->setZipcode('1234AA');
//        $buildingAddress132->setCity('Woonplaats A');
//        $buildingAddress132->setRentalUnitNumber('ALG0032');
//        $buildingAddress132->setDaeb(true);
//        $buildingAddress132->setVtw($vtw1);
//        $buildingAddress132->setResidentialArea($residentialArea10);
//        $buildingAddress132->setBuildingType($buildingType10);
//        $buildingAddress132->setLivingType($livingType3);
//
//        $buildingAddress133->setConstructionYear(1986);
//        $buildingAddress133->setRenovationYear(2002);
//        $buildingAddress133->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress133->setHouseNumber(10);
//        $buildingAddress133->setAddition('X');
//        $buildingAddress133->setZipcode('1234AA');
//        $buildingAddress133->setCity('Woonplaats A');
//        $buildingAddress133->setRentalUnitNumber('ALG0033');
//        $buildingAddress133->setDaeb(true);
//        $buildingAddress133->setVtw($vtw1);
//        $buildingAddress133->setResidentialArea($residentialArea10);
//        $buildingAddress133->setBuildingType($buildingType10);
//        $buildingAddress133->setLivingType($livingType3);
//
//        $buildingAddress134->setConstructionYear(1986);
//        $buildingAddress134->setRenovationYear(2002);
//        $buildingAddress134->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress134->setHouseNumber(10);
//        $buildingAddress134->setAddition('X');
//        $buildingAddress134->setZipcode('1234AA');
//        $buildingAddress134->setCity('Woonplaats A');
//        $buildingAddress134->setRentalUnitNumber('ALG0034');
//        $buildingAddress134->setDaeb(true);
//        $buildingAddress134->setVtw($vtw1);
//        $buildingAddress134->setResidentialArea($residentialArea10);
//        $buildingAddress134->setBuildingType($buildingType10);
//        $buildingAddress134->setLivingType($livingType3);
//
//        $buildingAddress135->setConstructionYear(1986);
//        $buildingAddress135->setRenovationYear(2002);
//        $buildingAddress135->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress135->setHouseNumber(10);
//        $buildingAddress135->setAddition('X');
//        $buildingAddress135->setZipcode('1234AA');
//        $buildingAddress135->setCity('Woonplaats A');
//        $buildingAddress135->setRentalUnitNumber('ALG0035');
//        $buildingAddress135->setDaeb(true);
//        $buildingAddress135->setVtw($vtw1);
//        $buildingAddress135->setResidentialArea($residentialArea10);
//        $buildingAddress135->setBuildingType($buildingType10);
//        $buildingAddress135->setLivingType($livingType3);
//
//        $buildingAddress136->setConstructionYear(1986);
//        $buildingAddress136->setRenovationYear(2002);
//        $buildingAddress136->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress136->setHouseNumber(10);
//        $buildingAddress136->setAddition('X');
//        $buildingAddress136->setZipcode('1234AA');
//        $buildingAddress136->setCity('Woonplaats A');
//        $buildingAddress136->setRentalUnitNumber('ALG0036');
//        $buildingAddress136->setDaeb(true);
//        $buildingAddress136->setVtw($vtw1);
//        $buildingAddress136->setResidentialArea($residentialArea10);
//        $buildingAddress136->setBuildingType($buildingType10);
//        $buildingAddress136->setLivingType($livingType3);
//
//        $buildingAddress137->setConstructionYear(1986);
//        $buildingAddress137->setRenovationYear(2002);
//        $buildingAddress137->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress137->setHouseNumber(10);
//        $buildingAddress137->setAddition('X');
//        $buildingAddress137->setZipcode('1234AA');
//        $buildingAddress137->setCity('Woonplaats A');
//        $buildingAddress137->setRentalUnitNumber('ALG0037');
//        $buildingAddress137->setDaeb(true);
//        $buildingAddress137->setVtw($vtw1);
//        $buildingAddress137->setResidentialArea($residentialArea10);
//        $buildingAddress137->setBuildingType($buildingType10);
//        $buildingAddress137->setLivingType($livingType3);
//
//        $buildingAddress138->setConstructionYear(1986);
//        $buildingAddress138->setRenovationYear(2002);
//        $buildingAddress138->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress138->setHouseNumber(10);
//        $buildingAddress138->setAddition('X');
//        $buildingAddress138->setZipcode('1234AA');
//        $buildingAddress138->setCity('Woonplaats A');
//        $buildingAddress138->setRentalUnitNumber('ALG0038');
//        $buildingAddress138->setDaeb(true);
//        $buildingAddress138->setVtw($vtw1);
//        $buildingAddress138->setResidentialArea($residentialArea10);
//        $buildingAddress138->setBuildingType($buildingType10);
//        $buildingAddress138->setLivingType($livingType3);
//
//        $buildingAddress139->setConstructionYear(1986);
//        $buildingAddress139->setRenovationYear(2002);
//        $buildingAddress139->setStreetName('Ą ą Ę ę Straatnaam A');
//        $buildingAddress139->setHouseNumber(10);
//        $buildingAddress139->setAddition('X');
//        $buildingAddress139->setZipcode('1234AA');
//        $buildingAddress139->setCity('Woonplaats A');
//        $buildingAddress139->setRentalUnitNumber('ALG0039');
//        $buildingAddress139->setDaeb(true);
//        $buildingAddress139->setVtw($vtw1);
//        $buildingAddress139->setResidentialArea($residentialArea10);
//        $buildingAddress139->setBuildingType($buildingType10);
//        $buildingAddress139->setLivingType($livingType3);
//
//        $buildingAddress140->setConstructionYear(2010);
//        $buildingAddress140->setRenovationYear(2019);
//        $buildingAddress140->setStreetName('Straatnaam A');
//        $buildingAddress140->setHouseNumber(102);
//        $buildingAddress140->setAddition('');
//        $buildingAddress140->setZipcode('1234AA');
//        $buildingAddress140->setCity('Woonplaats A');
//        $buildingAddress140->setRentalUnitNumber('ALG0040');
//        $buildingAddress140->setDaeb(true);
//        $buildingAddress140->setVtw($vtw1);
//        $buildingAddress140->setResidentialArea($residentialArea4);
//        $buildingAddress140->setBuildingType($buildingType4);
//        $buildingAddress140->setLivingType($livingType1);
//
//        $buildingAddress141->setConstructionYear(2010);
//        $buildingAddress141->setRenovationYear(2019);
//        $buildingAddress141->setStreetName('Straatnaam A');
//        $buildingAddress141->setHouseNumber(102);
//        $buildingAddress141->setAddition('');
//        $buildingAddress141->setZipcode('1234AA');
//        $buildingAddress141->setCity('Woonplaats A');
//        $buildingAddress141->setRentalUnitNumber('ALG0041');
//        $buildingAddress141->setDaeb(true);
//        $buildingAddress141->setVtw($vtw1);
//        $buildingAddress141->setResidentialArea($residentialArea4);
//        $buildingAddress141->setBuildingType($buildingType4);
//        $buildingAddress141->setLivingType($livingType1);
//
//        $buildingAddress142->setConstructionYear(2010);
//        $buildingAddress142->setRenovationYear(2019);
//        $buildingAddress142->setStreetName('Straatnaam A');
//        $buildingAddress142->setHouseNumber(102);
//        $buildingAddress142->setAddition('');
//        $buildingAddress142->setZipcode('1234AA');
//        $buildingAddress142->setCity('Woonplaats A');
//        $buildingAddress142->setRentalUnitNumber('ALG0042');
//        $buildingAddress142->setDaeb(true);
//        $buildingAddress142->setVtw($vtw1);
//        $buildingAddress142->setResidentialArea($residentialArea4);
//        $buildingAddress142->setBuildingType($buildingType4);
//        $buildingAddress142->setLivingType($livingType1);
//
//        $buildingAddress143->setConstructionYear(2010);
//        $buildingAddress143->setRenovationYear(2019);
//        $buildingAddress143->setStreetName('Straatnaam A');
//        $buildingAddress143->setHouseNumber(102);
//        $buildingAddress143->setAddition('');
//        $buildingAddress143->setZipcode('1234AA');
//        $buildingAddress143->setCity('Woonplaats A');
//        $buildingAddress143->setRentalUnitNumber('ALG0043');
//        $buildingAddress143->setDaeb(true);
//        $buildingAddress143->setVtw($vtw1);
//        $buildingAddress143->setResidentialArea($residentialArea4);
//        $buildingAddress143->setBuildingType($buildingType4);
//        $buildingAddress143->setLivingType($livingType1);
//
//        $buildingAddress144->setConstructionYear(2010);
//        $buildingAddress144->setRenovationYear(2019);
//        $buildingAddress144->setStreetName('Straatnaam A');
//        $buildingAddress144->setHouseNumber(102);
//        $buildingAddress144->setAddition('');
//        $buildingAddress144->setZipcode('1234AA');
//        $buildingAddress144->setCity('Woonplaats A');
//        $buildingAddress144->setRentalUnitNumber('ALG0044');
//        $buildingAddress144->setDaeb(true);
//        $buildingAddress144->setVtw($vtw1);
//        $buildingAddress144->setResidentialArea($residentialArea4);
//        $buildingAddress144->setBuildingType($buildingType4);
//        $buildingAddress144->setLivingType($livingType1);
//
//        $buildingAddress145->setConstructionYear(2010);
//        $buildingAddress145->setRenovationYear(2019);
//        $buildingAddress145->setStreetName('Straatnaam A');
//        $buildingAddress145->setHouseNumber(102);
//        $buildingAddress145->setAddition('');
//        $buildingAddress145->setZipcode('1234AA');
//        $buildingAddress145->setCity('Woonplaats A');
//        $buildingAddress145->setRentalUnitNumber('ALG0045');
//        $buildingAddress145->setDaeb(true);
//        $buildingAddress145->setVtw($vtw1);
//        $buildingAddress145->setResidentialArea($residentialArea4);
//        $buildingAddress145->setBuildingType($buildingType4);
//        $buildingAddress145->setLivingType($livingType1);
//
//        $buildingAddress146->setConstructionYear(2010);
//        $buildingAddress146->setRenovationYear(2019);
//        $buildingAddress146->setStreetName('Straatnaam A');
//        $buildingAddress146->setHouseNumber(102);
//        $buildingAddress146->setAddition('');
//        $buildingAddress146->setZipcode('1234AA');
//        $buildingAddress146->setCity('Woonplaats A');
//        $buildingAddress146->setRentalUnitNumber('ALG0046');
//        $buildingAddress146->setDaeb(true);
//        $buildingAddress146->setVtw($vtw1);
//        $buildingAddress146->setResidentialArea($residentialArea4);
//        $buildingAddress146->setBuildingType($buildingType4);
//        $buildingAddress146->setLivingType($livingType1);
//
//        $buildingAddress147->setConstructionYear(2010);
//        $buildingAddress147->setRenovationYear(2019);
//        $buildingAddress147->setStreetName('Straatnaam A');
//        $buildingAddress147->setHouseNumber(102);
//        $buildingAddress147->setAddition('');
//        $buildingAddress147->setZipcode('1234AA');
//        $buildingAddress147->setCity('Woonplaats A');
//        $buildingAddress147->setRentalUnitNumber('ALG0047');
//        $buildingAddress147->setDaeb(true);
//        $buildingAddress147->setVtw($vtw1);
//        $buildingAddress147->setResidentialArea($residentialArea4);
//        $buildingAddress147->setBuildingType($buildingType4);
//        $buildingAddress147->setLivingType($livingType1);
//
//        $buildingAddress148->setConstructionYear(2010);
//        $buildingAddress148->setRenovationYear(2019);
//        $buildingAddress148->setStreetName('Straatnaam A');
//        $buildingAddress148->setHouseNumber(102);
//        $buildingAddress148->setAddition('');
//        $buildingAddress148->setZipcode('1234AA');
//        $buildingAddress148->setCity('Woonplaats A');
//        $buildingAddress148->setRentalUnitNumber('ALG0048');
//        $buildingAddress148->setDaeb(true);
//        $buildingAddress148->setVtw($vtw1);
//        $buildingAddress148->setResidentialArea($residentialArea4);
//        $buildingAddress148->setBuildingType($buildingType4);
//        $buildingAddress148->setLivingType($livingType1);
//
//        $buildingAddress149->setConstructionYear(2010);
//        $buildingAddress149->setRenovationYear(2019);
//        $buildingAddress149->setStreetName('Straatnaam A');
//        $buildingAddress149->setHouseNumber(102);
//        $buildingAddress149->setAddition('');
//        $buildingAddress149->setZipcode('1234AA');
//        $buildingAddress149->setCity('Woonplaats A');
//        $buildingAddress149->setRentalUnitNumber('ALG0049');
//        $buildingAddress149->setDaeb(true);
//        $buildingAddress149->setVtw($vtw1);
//        $buildingAddress149->setResidentialArea($residentialArea4);
//        $buildingAddress149->setBuildingType($buildingType4);
//        $buildingAddress149->setLivingType($livingType1);
//
//        $buildingAddress150->setConstructionYear(1988);
//        $buildingAddress150->setRenovationYear(2005);
//        $buildingAddress150->setStreetName('Kerkstraat');
//        $buildingAddress150->setHouseNumber(1);
//        $buildingAddress150->setAddition('');
//        $buildingAddress150->setZipcode('9021KL');
//        $buildingAddress150->setCity('Bedum');
//        $buildingAddress150->setRentalUnitNumber('ALG0050');
//        $buildingAddress150->setDaeb(true);
//        $buildingAddress150->setVtw($vtw164);
//        $buildingAddress150->setResidentialArea($residentialArea5);
//        $buildingAddress150->setBuildingType($buildingType5);
//        $buildingAddress150->setLivingType($livingType2);
//
//        $buildingAddress151->setConstructionYear(1988);
//        $buildingAddress151->setRenovationYear(2005);
//        $buildingAddress151->setStreetName('Kerkstraat');
//        $buildingAddress151->setHouseNumber(3);
//        $buildingAddress151->setAddition('');
//        $buildingAddress151->setZipcode('9021KL');
//        $buildingAddress151->setCity('Bedum');
//        $buildingAddress151->setRentalUnitNumber('E-0001');
//        $buildingAddress151->setDaeb(true);
//        $buildingAddress151->setVtw($vtw164);
//        $buildingAddress151->setResidentialArea($residentialArea5);
//        $buildingAddress151->setBuildingType($buildingType5);
//        $buildingAddress151->setLivingType($livingType2);
//
//        $buildingAddress152->setConstructionYear(1988);
//        $buildingAddress152->setRenovationYear(2005);
//        $buildingAddress152->setStreetName('Kerkstraat');
//        $buildingAddress152->setHouseNumber(5);
//        $buildingAddress152->setAddition('');
//        $buildingAddress152->setZipcode('9021KL');
//        $buildingAddress152->setCity('Bedum');
//        $buildingAddress152->setRentalUnitNumber('E-0002');
//        $buildingAddress152->setDaeb(true);
//        $buildingAddress152->setVtw($vtw164);
//        $buildingAddress152->setResidentialArea($residentialArea5);
//        $buildingAddress152->setBuildingType($buildingType5);
//        $buildingAddress152->setLivingType($livingType2);
//
//        $buildingAddress153->setConstructionYear(1988);
//        $buildingAddress153->setRenovationYear(2005);
//        $buildingAddress153->setStreetName('Kerkstraat');
//        $buildingAddress153->setHouseNumber(7);
//        $buildingAddress153->setAddition('');
//        $buildingAddress153->setZipcode('9021KL');
//        $buildingAddress153->setCity('Bedum');
//        $buildingAddress153->setRentalUnitNumber('E-0003');
//        $buildingAddress153->setDaeb(true);
//        $buildingAddress153->setVtw($vtw164);
//        $buildingAddress153->setResidentialArea($residentialArea5);
//        $buildingAddress153->setBuildingType($buildingType5);
//        $buildingAddress153->setLivingType($livingType2);
//
//        $buildingAddress154->setConstructionYear(1988);
//        $buildingAddress154->setRenovationYear(2005);
//        $buildingAddress154->setStreetName('Kerkstraat');
//        $buildingAddress154->setHouseNumber(9);
//        $buildingAddress154->setAddition('');
//        $buildingAddress154->setZipcode('9021KL');
//        $buildingAddress154->setCity('Bedum');
//        $buildingAddress154->setRentalUnitNumber('E-0004');
//        $buildingAddress154->setDaeb(true);
//        $buildingAddress154->setVtw($vtw164);
//        $buildingAddress154->setResidentialArea($residentialArea5);
//        $buildingAddress154->setBuildingType($buildingType5);
//        $buildingAddress154->setLivingType($livingType2);
//
//        $buildingAddress155->setConstructionYear(1988);
//        $buildingAddress155->setRenovationYear(2005);
//        $buildingAddress155->setStreetName('Kerkstraat');
//        $buildingAddress155->setHouseNumber(9);
//        $buildingAddress155->setAddition('A');
//        $buildingAddress155->setZipcode('9021KL');
//        $buildingAddress155->setCity('Bedum');
//        $buildingAddress155->setRentalUnitNumber('E-0005');
//        $buildingAddress155->setDaeb(true);
//        $buildingAddress155->setVtw($vtw164);
//        $buildingAddress155->setResidentialArea($residentialArea5);
//        $buildingAddress155->setBuildingType($buildingType5);
//        $buildingAddress155->setLivingType($livingType2);
//
//        $buildingAddress156->setConstructionYear(1988);
//        $buildingAddress156->setRenovationYear(2005);
//        $buildingAddress156->setStreetName('Bergweg');
//        $buildingAddress156->setHouseNumber(2);
//        $buildingAddress156->setAddition('');
//        $buildingAddress156->setZipcode('9451GV');
//        $buildingAddress156->setCity('Bedum');
//        $buildingAddress156->setRentalUnitNumber('E-0006');
//        $buildingAddress156->setDaeb(true);
//        $buildingAddress156->setVtw($vtw54);
//        $buildingAddress156->setResidentialArea($residentialArea5);
//        $buildingAddress156->setBuildingType($buildingType5);
//        $buildingAddress156->setLivingType($livingType2);
//
//        $buildingAddress157->setConstructionYear(1988);
//        $buildingAddress157->setStreetName('Bergweg');
//        $buildingAddress157->setHouseNumber(4);
//        $buildingAddress157->setAddition('');
//        $buildingAddress157->setZipcode('9451GV');
//        $buildingAddress157->setCity('Bedum');
//        $buildingAddress157->setRentalUnitNumber('E-0007');
//        $buildingAddress157->setDaeb(true);
//        $buildingAddress157->setVtw($vtw54);
//        $buildingAddress157->setResidentialArea($residentialArea5);
//        $buildingAddress157->setBuildingType($buildingType5);
//        $buildingAddress157->setLivingType($livingType2);
//
//        $buildingAddress158->setConstructionYear(1988);
//        $buildingAddress158->setRenovationYear(2005);
//        $buildingAddress158->setStreetName('Bergweg');
//        $buildingAddress158->setHouseNumber(6);
//        $buildingAddress158->setAddition('');
//        $buildingAddress158->setZipcode('9451GV');
//        $buildingAddress158->setCity('Bedum');
//        $buildingAddress158->setRentalUnitNumber('E-0008');
//        $buildingAddress158->setDaeb(true);
//        $buildingAddress158->setVtw($vtw54);
//        $buildingAddress158->setResidentialArea($residentialArea5);
//        $buildingAddress158->setBuildingType($buildingType5);
//        $buildingAddress158->setLivingType($livingType2);
//
//        $buildingAddress159->setConstructionYear(1988);
//        $buildingAddress159->setRenovationYear(2005);
//        $buildingAddress159->setStreetName('Bergweg');
//        $buildingAddress159->setHouseNumber(8);
//        $buildingAddress159->setAddition('');
//        $buildingAddress159->setZipcode('9451GV');
//        $buildingAddress159->setCity('Bedum');
//        $buildingAddress159->setRentalUnitNumber('E-0009');
//        $buildingAddress159->setDaeb(true);
//        $buildingAddress159->setVtw($vtw54);
//        $buildingAddress159->setResidentialArea($residentialArea5);
//        $buildingAddress159->setBuildingType($buildingType5);
//        $buildingAddress159->setLivingType($livingType2);
//
//        $buildingAddress160->setConstructionYear(1958);
//        $buildingAddress160->setRenovationYear(2000);
//        $buildingAddress160->setStreetName('Bergweg');
//        $buildingAddress160->setHouseNumber(10);
//        $buildingAddress160->setAddition('');
//        $buildingAddress160->setZipcode('9451GV');
//        $buildingAddress160->setCity('Bedum');
//        $buildingAddress160->setRentalUnitNumber('E-0010');
//        $buildingAddress160->setDaeb(true);
//        $buildingAddress160->setVtw($vtw54);
//        $buildingAddress160->setResidentialArea($residentialArea6);
//        $buildingAddress160->setBuildingType($buildingType6);
//        $buildingAddress160->setLivingType($livingType2);
//
//        $buildingAddress161->setConstructionYear(1978);
//        $buildingAddress161->setRenovationYear(2000);
//        $buildingAddress161->setStreetName('Strümwegh');
//        $buildingAddress161->setHouseNumber(97);
//        $buildingAddress161->setAddition('A');
//        $buildingAddress161->setZipcode('4234GA');
//        $buildingAddress161->setCity('Bedum');
//        $buildingAddress161->setRentalUnitNumber('E-0011');
//        $buildingAddress161->setDaeb(true);
//        $buildingAddress161->setVtw($vtw54);
//        $buildingAddress161->setResidentialArea($residentialArea6);
//        $buildingAddress161->setBuildingType($buildingType6);
//        $buildingAddress161->setLivingType($livingType2);
//
//        $buildingAddress162->setConstructionYear(1978);
//        $buildingAddress162->setRenovationYear(2000);
//        $buildingAddress162->setStreetName('Strümwegh');
//        $buildingAddress162->setHouseNumber(99);
//        $buildingAddress162->setAddition('A');
//        $buildingAddress162->setZipcode('4234GA');
//        $buildingAddress162->setCity('Bedum');
//        $buildingAddress162->setRentalUnitNumber('E-0012');
//        $buildingAddress162->setDaeb(true);
//        $buildingAddress162->setVtw($vtw1);
//        $buildingAddress162->setResidentialArea($residentialArea6);
//        $buildingAddress162->setBuildingType($buildingType6);
//        $buildingAddress162->setLivingType($livingType2);
//
//        $buildingAddress163->setConstructionYear(1958);
//        $buildingAddress163->setRenovationYear(2000);
//        $buildingAddress163->setStreetName('Strümwegh');
//        $buildingAddress163->setHouseNumber(101);
//        $buildingAddress163->setAddition('A');
//        $buildingAddress163->setZipcode('4234GA');
//        $buildingAddress163->setCity('Bedum');
//        $buildingAddress163->setRentalUnitNumber('E-0013');
//        $buildingAddress163->setDaeb(true);
//        $buildingAddress163->setVtw($vtw1);
//        $buildingAddress163->setResidentialArea($residentialArea6);
//        $buildingAddress163->setBuildingType($buildingType6);
//        $buildingAddress163->setLivingType($livingType2);
//
//        $buildingAddress164->setConstructionYear(1978);
//        $buildingAddress164->setRenovationYear(2000);
//        $buildingAddress164->setStreetName('Strümwegh');
//        $buildingAddress164->setHouseNumber(103);
//        $buildingAddress164->setAddition('A');
//        $buildingAddress164->setZipcode('4234GA');
//        $buildingAddress164->setCity('Bedum');
//        $buildingAddress164->setRentalUnitNumber('E-0014');
//        $buildingAddress164->setDaeb(true);
//        $buildingAddress164->setVtw($vtw1);
//        $buildingAddress164->setResidentialArea($residentialArea6);
//        $buildingAddress164->setBuildingType($buildingType6);
//        $buildingAddress164->setLivingType($livingType2);
//
//        $buildingAddress165->setConstructionYear(1978);
//        $buildingAddress165->setRenovationYear(2000);
//        $buildingAddress165->setStreetName('Strümwegh');
//        $buildingAddress165->setHouseNumber(105);
//        $buildingAddress165->setAddition('');
//        $buildingAddress165->setZipcode('4234GA');
//        $buildingAddress165->setCity('Bedum');
//        $buildingAddress165->setRentalUnitNumber('E-0015');
//        $buildingAddress165->setDaeb(true);
//        $buildingAddress165->setVtw($vtw1);
//        $buildingAddress165->setResidentialArea($residentialArea6);
//        $buildingAddress165->setBuildingType($buildingType6);
//        $buildingAddress165->setLivingType($livingType2);
//
//        $buildingAddress166->setConstructionYear(1978);
//        $buildingAddress166->setRenovationYear(2000);
//        $buildingAddress166->setStreetName('Strümwegh');
//        $buildingAddress166->setHouseNumber(107);
//        $buildingAddress166->setAddition('');
//        $buildingAddress166->setZipcode('4234GA');
//        $buildingAddress166->setCity('Bedum');
//        $buildingAddress166->setRentalUnitNumber('E-0016');
//        $buildingAddress166->setDaeb(true);
//        $buildingAddress166->setVtw($vtw1);
//        $buildingAddress166->setResidentialArea($residentialArea6);
//        $buildingAddress166->setBuildingType($buildingType6);
//        $buildingAddress166->setLivingType($livingType2);
//
//        $buildingAddress167->setConstructionYear(1978);
//        $buildingAddress167->setRenovationYear(2000);
//        $buildingAddress167->setStreetName('Strümwegh');
//        $buildingAddress167->setHouseNumber(109);
//        $buildingAddress167->setAddition('');
//        $buildingAddress167->setZipcode('4234GA');
//        $buildingAddress167->setCity('Bedum');
//        $buildingAddress167->setRentalUnitNumber('E-0017');
//        $buildingAddress167->setDaeb(true);
//        $buildingAddress167->setVtw($vtw1);
//        $buildingAddress167->setResidentialArea($residentialArea6);
//        $buildingAddress167->setBuildingType($buildingType6);
//        $buildingAddress167->setLivingType($livingType2);
//
//        $buildingAddress168->setConstructionYear(1978);
//        $buildingAddress168->setRenovationYear(2000);
//        $buildingAddress168->setStreetName('Strümwegh');
//        $buildingAddress168->setHouseNumber(111);
//        $buildingAddress168->setAddition('');
//        $buildingAddress168->setZipcode('4234GA');
//        $buildingAddress168->setCity('Bedum');
//        $buildingAddress168->setRentalUnitNumber('E-0018');
//        $buildingAddress168->setDaeb(true);
//        $buildingAddress168->setVtw($vtw1);
//        $buildingAddress168->setResidentialArea($residentialArea6);
//        $buildingAddress168->setBuildingType($buildingType6);
//        $buildingAddress168->setLivingType($livingType2);
//
//        $buildingAddress169->setConstructionYear(1978);
//        $buildingAddress169->setRenovationYear(2000);
//        $buildingAddress169->setStreetName('Strümwegh');
//        $buildingAddress169->setHouseNumber(2);
//        $buildingAddress169->setAddition('A');
//        $buildingAddress169->setZipcode('4234GA');
//        $buildingAddress169->setCity('Bedum');
//        $buildingAddress169->setRentalUnitNumber('E-0019');
//        $buildingAddress169->setDaeb(true);
//        $buildingAddress169->setVtw($vtw1);
//        $buildingAddress169->setResidentialArea($residentialArea7);
//        $buildingAddress169->setBuildingType($buildingType7);
//        $buildingAddress169->setLivingType($livingType2);
//
//        $buildingAddress170->setConstructionYear(1978);
//        $buildingAddress170->setRenovationYear(2000);
//        $buildingAddress170->setStreetName('Strümwegh');
//        $buildingAddress170->setHouseNumber(4);
//        $buildingAddress170->setAddition('A');
//        $buildingAddress170->setZipcode('4234GA');
//        $buildingAddress170->setCity('Bedum');
//        $buildingAddress170->setRentalUnitNumber('E-0020');
//        $buildingAddress170->setDaeb(true);
//        $buildingAddress170->setVtw($vtw1);
//        $buildingAddress170->setResidentialArea($residentialArea7);
//        $buildingAddress170->setBuildingType($buildingType7);
//        $buildingAddress170->setLivingType($livingType2);
//
//        $buildingAddress171->setConstructionYear(1978);
//        $buildingAddress171->setRenovationYear(2000);
//        $buildingAddress171->setStreetName('Grote Strümwegh');
//        $buildingAddress171->setHouseNumber(6);
//        $buildingAddress171->setAddition('A');
//        $buildingAddress171->setZipcode('9234FA');
//        $buildingAddress171->setCity('Groningen');
//        $buildingAddress171->setRentalUnitNumber('E-0021');
//        $buildingAddress171->setDaeb(true);
//        $buildingAddress171->setVtw($vtw1);
//        $buildingAddress171->setResidentialArea($residentialArea7);
//        $buildingAddress171->setBuildingType($buildingType7);
//        $buildingAddress171->setLivingType($livingType2);
//
//        $buildingAddress172->setConstructionYear(1978);
//        $buildingAddress172->setRenovationYear(2000);
//        $buildingAddress172->setStreetName('Grote Strümwegh');
//        $buildingAddress172->setHouseNumber(8);
//        $buildingAddress172->setAddition('A');
//        $buildingAddress172->setZipcode('9034GH');
//        $buildingAddress172->setCity('Groningen');
//        $buildingAddress172->setRentalUnitNumber('E-0022');
//        $buildingAddress172->setDaeb(true);
//        $buildingAddress172->setVtw($vtw1);
//        $buildingAddress172->setResidentialArea($residentialArea7);
//        $buildingAddress172->setBuildingType($buildingType7);
//        $buildingAddress172->setLivingType($livingType2);
//
//        $buildingAddress173->setConstructionYear(1978);
//        $buildingAddress173->setRenovationYear(2000);
//        $buildingAddress173->setStreetName('Grote Strümwegh');
//        $buildingAddress173->setHouseNumber(10);
//        $buildingAddress173->setAddition('A');
//        $buildingAddress173->setZipcode('9034GH');
//        $buildingAddress173->setCity('Groningen');
//        $buildingAddress173->setRentalUnitNumber('E-0023');
//        $buildingAddress173->setDaeb(true);
//        $buildingAddress173->setVtw($vtw1);
//        $buildingAddress173->setResidentialArea($residentialArea7);
//        $buildingAddress173->setBuildingType($buildingType7);
//        $buildingAddress173->setLivingType($livingType2);
//
//        $buildingAddress174->setConstructionYear(1978);
//        $buildingAddress174->setRenovationYear(2000);
//        $buildingAddress174->setStreetName('Grote Strümwegh');
//        $buildingAddress174->setHouseNumber(12);
//        $buildingAddress174->setAddition('A');
//        $buildingAddress174->setZipcode('9034GH');
//        $buildingAddress174->setCity('Groningen');
//        $buildingAddress174->setRentalUnitNumber('E-0024');
//        $buildingAddress174->setDaeb(true);
//        $buildingAddress174->setVtw($vtw1);
//        $buildingAddress174->setResidentialArea($residentialArea7);
//        $buildingAddress174->setBuildingType($buildingType7);
//        $buildingAddress174->setLivingType($livingType2);
//
//        $buildingAddress175->setConstructionYear(1978);
//        $buildingAddress175->setRenovationYear(2000);
//        $buildingAddress175->setStreetName('Grote Strümwegh');
//        $buildingAddress175->setHouseNumber(14);
//        $buildingAddress175->setAddition('A');
//        $buildingAddress175->setZipcode('9034GH');
//        $buildingAddress175->setCity('Groningen');
//        $buildingAddress175->setRentalUnitNumber('E-0025');
//        $buildingAddress175->setDaeb(true);
//        $buildingAddress175->setVtw($vtw20);
//        $buildingAddress175->setResidentialArea($residentialArea7);
//        $buildingAddress175->setBuildingType($buildingType7);
//        $buildingAddress175->setLivingType($livingType2);
//
//        $buildingAddress176->setConstructionYear(1978);
//        $buildingAddress176->setRenovationYear(2000);
//        $buildingAddress176->setStreetName('Grote Strümwegh');
//        $buildingAddress176->setHouseNumber(16);
//        $buildingAddress176->setAddition('A');
//        $buildingAddress176->setZipcode('9034GH');
//        $buildingAddress176->setCity('Groningen');
//        $buildingAddress176->setRentalUnitNumber('E-0026');
//        $buildingAddress176->setDaeb(true);
//        $buildingAddress176->setVtw($vtw20);
//        $buildingAddress176->setResidentialArea($residentialArea7);
//        $buildingAddress176->setBuildingType($buildingType7);
//        $buildingAddress176->setLivingType($livingType4);
//
//        $buildingAddress177->setConstructionYear(2006);
//        $buildingAddress177->setRenovationYear(2022);
//        $buildingAddress177->setStreetName('æŒRǿndestraat');
//        $buildingAddress177->setHouseNumber(18);
//        $buildingAddress177->setAddition('A');
//        $buildingAddress177->setZipcode('9034GH');
//        $buildingAddress177->setCity('Groningen');
//        $buildingAddress177->setRentalUnitNumber('E-0027');
//        $buildingAddress177->setDaeb(true);
//        $buildingAddress177->setVtw($vtw20);
//        $buildingAddress177->setResidentialArea($residentialArea7);
//        $buildingAddress177->setBuildingType($buildingType7);
//        $buildingAddress177->setLivingType($livingType4);
//
//        $buildingAddress178->setConstructionYear(2006);
//        $buildingAddress178->setRenovationYear(2022);
//        $buildingAddress178->setStreetName('æŒRǿndestraat');
//        $buildingAddress178->setHouseNumber(20);
//        $buildingAddress178->setAddition('A');
//        $buildingAddress178->setZipcode('9034GH');
//        $buildingAddress178->setCity('Groningen');
//        $buildingAddress178->setRentalUnitNumber('E-0028');
//        $buildingAddress178->setDaeb(true);
//        $buildingAddress178->setVtw($vtw20);
//        $buildingAddress178->setResidentialArea($residentialArea7);
//        $buildingAddress178->setBuildingType($buildingType7);
//        $buildingAddress178->setLivingType($livingType4);
//
//        $buildingAddress179->setConstructionYear(2006);
//        $buildingAddress179->setRenovationYear(2022);
//        $buildingAddress179->setStreetName('æŒRǿndestraat');
//        $buildingAddress179->setHouseNumber(22);
//        $buildingAddress179->setAddition('Bis');
//        $buildingAddress179->setZipcode('9034GH');
//        $buildingAddress179->setCity('Groningen');
//        $buildingAddress179->setRentalUnitNumber('E-0029');
//        $buildingAddress179->setDaeb(true);
//        $buildingAddress179->setVtw($vtw1);
//        $buildingAddress179->setResidentialArea($residentialArea8);
//        $buildingAddress179->setBuildingType($buildingType8);
//        $buildingAddress179->setLivingType($livingType2);
//
//        $buildingAddress180->setConstructionYear(2006);
//        $buildingAddress180->setRenovationYear(2022);
//        $buildingAddress180->setStreetName('æŒRǿndestraat');
//        $buildingAddress180->setHouseNumber(4);
//        $buildingAddress180->setAddition('Bis');
//        $buildingAddress180->setZipcode('9034GR');
//        $buildingAddress180->setCity('Groningen');
//        $buildingAddress180->setRentalUnitNumber('E-0030');
//        $buildingAddress180->setDaeb(false);
//        $buildingAddress180->setVtw($vtw1);
//        $buildingAddress180->setResidentialArea($residentialArea8);
//        $buildingAddress180->setBuildingType($buildingType8);
//        $buildingAddress180->setLivingType($livingType2);
//
//        $buildingAddress181->setConstructionYear(2006);
//        $buildingAddress181->setRenovationYear(2022);
//        $buildingAddress181->setStreetName('æŒRǿndestraat');
//        $buildingAddress181->setHouseNumber(6);
//        $buildingAddress181->setAddition('Bis');
//        $buildingAddress181->setZipcode('9034GR');
//        $buildingAddress181->setCity('Groningen');
//        $buildingAddress181->setRentalUnitNumber('E-0031');
//        $buildingAddress181->setDaeb(false);
//        $buildingAddress181->setVtw($vtw2);
//        $buildingAddress181->setResidentialArea($residentialArea8);
//        $buildingAddress181->setBuildingType($buildingType8);
//        $buildingAddress181->setLivingType($livingType2);
//
//        $buildingAddress182->setConstructionYear(2006);
//        $buildingAddress182->setRenovationYear(2022);
//        $buildingAddress182->setStreetName('æŒRǿndestraat');
//        $buildingAddress182->setHouseNumber(8);
//        $buildingAddress182->setAddition('Bis');
//        $buildingAddress182->setZipcode('9034GR');
//        $buildingAddress182->setCity('Groningen');
//        $buildingAddress182->setRentalUnitNumber('E-0032');
//        $buildingAddress182->setDaeb(false);
//        $buildingAddress182->setVtw($vtw3);
//        $buildingAddress182->setResidentialArea($residentialArea8);
//        $buildingAddress182->setBuildingType($buildingType8);
//        $buildingAddress182->setLivingType($livingType2);
//
//        $buildingAddress183->setConstructionYear(2006);
//        $buildingAddress183->setRenovationYear(2022);
//        $buildingAddress183->setStreetName('æŒRǿndestraat');
//        $buildingAddress183->setHouseNumber(10);
//        $buildingAddress183->setAddition('Bis');
//        $buildingAddress183->setZipcode('9034GR');
//        $buildingAddress183->setCity('Groningen');
//        $buildingAddress183->setRentalUnitNumber('E-0033');
//        $buildingAddress183->setDaeb(false);
//        $buildingAddress183->setVtw($vtw4);
//        $buildingAddress183->setResidentialArea($residentialArea8);
//        $buildingAddress183->setBuildingType($buildingType8);
//        $buildingAddress183->setLivingType($livingType2);
//
//        $buildingAddress184->setConstructionYear(2006);
//        $buildingAddress184->setRenovationYear(2022);
//        $buildingAddress184->setStreetName('æŒRǿndestraat');
//        $buildingAddress184->setHouseNumber(12);
//        $buildingAddress184->setAddition('Bis');
//        $buildingAddress184->setZipcode('9034GR');
//        $buildingAddress184->setCity('Groningen');
//        $buildingAddress184->setRentalUnitNumber('E-0034');
//        $buildingAddress184->setDaeb(false);
//        $buildingAddress184->setVtw($vtw5);
//        $buildingAddress184->setResidentialArea($residentialArea8);
//        $buildingAddress184->setBuildingType($buildingType8);
//        $buildingAddress184->setLivingType($livingType2);
//
//        $buildingAddress185->setConstructionYear(2006);
//        $buildingAddress185->setRenovationYear(2022);
//        $buildingAddress185->setStreetName('æŒRǿndestraat');
//        $buildingAddress185->setHouseNumber(14);
//        $buildingAddress185->setAddition('Bis');
//        $buildingAddress185->setZipcode('9034GR');
//        $buildingAddress185->setCity('Groningen');
//        $buildingAddress185->setRentalUnitNumber('E-0035');
//        $buildingAddress185->setDaeb(false);
//        $buildingAddress185->setVtw($vtw6);
//        $buildingAddress185->setResidentialArea($residentialArea8);
//        $buildingAddress185->setBuildingType($buildingType8);
//        $buildingAddress185->setLivingType($livingType2);
//
//        $buildingAddress186->setConstructionYear(2006);
//        $buildingAddress186->setRenovationYear(2022);
//        $buildingAddress186->setStreetName('æŒRǿndestraat');
//        $buildingAddress186->setHouseNumber(16);
//        $buildingAddress186->setAddition('Bis');
//        $buildingAddress186->setZipcode('9034GR');
//        $buildingAddress186->setCity('Groningen');
//        $buildingAddress186->setRentalUnitNumber('E-0036');
//        $buildingAddress186->setDaeb(false);
//        $buildingAddress186->setVtw($vtw7);
//        $buildingAddress186->setResidentialArea($residentialArea8);
//        $buildingAddress186->setBuildingType($buildingType8);
//        $buildingAddress186->setLivingType($livingType2);
//
//        $buildingAddress187->setConstructionYear(2006);
//        $buildingAddress187->setRenovationYear(2022);
//        $buildingAddress187->setStreetName('æŒRǿndestraat');
//        $buildingAddress187->setHouseNumber(18);
//        $buildingAddress187->setAddition('Bis');
//        $buildingAddress187->setZipcode('9034GR');
//        $buildingAddress187->setCity('Groningen');
//        $buildingAddress187->setRentalUnitNumber('E-0037');
//        $buildingAddress187->setDaeb(false);
//        $buildingAddress187->setVtw($vtw8);
//        $buildingAddress187->setResidentialArea($residentialArea8);
//        $buildingAddress187->setBuildingType($buildingType8);
//        $buildingAddress187->setLivingType($livingType2);
//
//        $buildingAddress188->setConstructionYear(2006);
//        $buildingAddress188->setRenovationYear(2022);
//        $buildingAddress188->setStreetName('æŒRǿndestraat');
//        $buildingAddress188->setHouseNumber(20);
//        $buildingAddress188->setAddition('Bis');
//        $buildingAddress188->setZipcode('9034GR');
//        $buildingAddress188->setCity('Groningen');
//        $buildingAddress188->setRentalUnitNumber('E-0038');
//        $buildingAddress188->setDaeb(false);
//        $buildingAddress188->setVtw($vtw9);
//        $buildingAddress188->setResidentialArea($residentialArea8);
//        $buildingAddress188->setBuildingType($buildingType8);
//        $buildingAddress188->setLivingType($livingType2);
//
//        $buildingAddress189->setConstructionYear(1976);
//        $buildingAddress189->setRenovationYear(2001);
//        $buildingAddress189->setStreetName('æŒRǿndestraat');
//        $buildingAddress189->setHouseNumber(22);
//        $buildingAddress189->setAddition('Bis');
//        $buildingAddress189->setZipcode('9034GR');
//        $buildingAddress189->setCity('Groningen');
//        $buildingAddress189->setRentalUnitNumber('E-0039');
//        $buildingAddress189->setDaeb(true);
//        $buildingAddress189->setVtw($vtw10);
//        $buildingAddress189->setResidentialArea($residentialArea8);
//        $buildingAddress189->setBuildingType($buildingType8);
//        $buildingAddress189->setLivingType($livingType2);
//
//        $buildingAddress190->setConstructionYear(1976);
//        $buildingAddress190->setRenovationYear(2001);
//        $buildingAddress190->setStreetName('æŒRǿndestraat');
//        $buildingAddress190->setHouseNumber(22);
//        $buildingAddress190->setAddition('I');
//        $buildingAddress190->setZipcode('9034GR');
//        $buildingAddress190->setCity('Groningen');
//        $buildingAddress190->setRentalUnitNumber('E-0040');
//        $buildingAddress190->setDaeb(true);
//        $buildingAddress190->setVtw($vtw10);
//        $buildingAddress190->setResidentialArea($residentialArea9);
//        $buildingAddress190->setBuildingType($buildingType9);
//        $buildingAddress190->setLivingType($livingType2);
//
//        $buildingAddress191->setConstructionYear(1976);
//        $buildingAddress191->setRenovationYear(2001);
//        $buildingAddress191->setStreetName('æŒRǿndestraat');
//        $buildingAddress191->setHouseNumber(20);
//        $buildingAddress191->setAddition('I');
//        $buildingAddress191->setZipcode('9034FR');
//        $buildingAddress191->setCity('Groningen');
//        $buildingAddress191->setRentalUnitNumber('E-0041');
//        $buildingAddress191->setDaeb(true);
//        $buildingAddress191->setVtw($vtw2);
//        $buildingAddress191->setResidentialArea($residentialArea9);
//        $buildingAddress191->setBuildingType($buildingType9);
//        $buildingAddress191->setLivingType($livingType2);
//
//        $buildingAddress192->setConstructionYear(1976);
//        $buildingAddress192->setRenovationYear(2001);
//        $buildingAddress192->setStreetName('æŒRǿndestraat');
//        $buildingAddress192->setHouseNumber(2);
//        $buildingAddress192->setAddition('I');
//        $buildingAddress192->setZipcode('9034FR');
//        $buildingAddress192->setCity('Groningen');
//        $buildingAddress192->setRentalUnitNumber('E-0042');
//        $buildingAddress192->setDaeb(true);
//        $buildingAddress192->setVtw($vtw3);
//        $buildingAddress192->setResidentialArea($residentialArea9);
//        $buildingAddress192->setBuildingType($buildingType9);
//        $buildingAddress192->setLivingType($livingType2);
//
//        $buildingAddress193->setConstructionYear(1976);
//        $buildingAddress193->setRenovationYear(2001);
//        $buildingAddress193->setStreetName('æŒRǿndestraat');
//        $buildingAddress193->setHouseNumber(4);
//        $buildingAddress193->setAddition('I');
//        $buildingAddress193->setZipcode('9034FR');
//        $buildingAddress193->setCity('Groningen');
//        $buildingAddress193->setRentalUnitNumber('E-0043');
//        $buildingAddress193->setDaeb(true);
//        $buildingAddress193->setVtw($vtw4);
//        $buildingAddress193->setResidentialArea($residentialArea9);
//        $buildingAddress193->setBuildingType($buildingType9);
//        $buildingAddress193->setLivingType($livingType2);
//
//        $buildingAddress194->setConstructionYear(1976);
//        $buildingAddress194->setRenovationYear(2001);
//        $buildingAddress194->setStreetName('æŒRǿndestraat');
//        $buildingAddress194->setHouseNumber(6);
//        $buildingAddress194->setAddition('I');
//        $buildingAddress194->setZipcode('9034FR');
//        $buildingAddress194->setCity('Groningen');
//        $buildingAddress194->setRentalUnitNumber('E-0044');
//        $buildingAddress194->setDaeb(true);
//        $buildingAddress194->setVtw($vtw5);
//        $buildingAddress194->setResidentialArea($residentialArea9);
//        $buildingAddress194->setBuildingType($buildingType9);
//        $buildingAddress194->setLivingType($livingType2);
//
//        $buildingAddress195->setConstructionYear(1976);
//        $buildingAddress195->setRenovationYear(2001);
//        $buildingAddress195->setStreetName('æŒRǿndestraat');
//        $buildingAddress195->setHouseNumber(8);
//        $buildingAddress195->setAddition('I');
//        $buildingAddress195->setZipcode('9034FR');
//        $buildingAddress195->setCity('Groningen');
//        $buildingAddress195->setRentalUnitNumber('E-0045');
//        $buildingAddress195->setDaeb(true);
//        $buildingAddress195->setVtw($vtw6);
//        $buildingAddress195->setResidentialArea($residentialArea9);
//        $buildingAddress195->setBuildingType($buildingType9);
//        $buildingAddress195->setLivingType($livingType2);
//
//        $buildingAddress196->setConstructionYear(1976);
//        $buildingAddress196->setRenovationYear(2001);
//        $buildingAddress196->setStreetName('æŒRǿndestraat');
//        $buildingAddress196->setHouseNumber(10);
//        $buildingAddress196->setAddition('I');
//        $buildingAddress196->setZipcode('9034FR');
//        $buildingAddress196->setCity('Groningen');
//        $buildingAddress196->setRentalUnitNumber('E-0046');
//        $buildingAddress196->setDaeb(true);
//        $buildingAddress196->setVtw($vtw7);
//        $buildingAddress196->setResidentialArea($residentialArea9);
//        $buildingAddress196->setBuildingType($buildingType9);
//        $buildingAddress196->setLivingType($livingType2);
//
//        $buildingAddress197->setConstructionYear(1976);
//        $buildingAddress197->setRenovationYear(2001);
//        $buildingAddress197->setStreetName('æŒRǿndestraat');
//        $buildingAddress197->setHouseNumber(12);
//        $buildingAddress197->setAddition('I');
//        $buildingAddress197->setZipcode('9034FR');
//        $buildingAddress197->setCity('Groningen');
//        $buildingAddress197->setRentalUnitNumber('E-0047');
//        $buildingAddress197->setDaeb(true);
//        $buildingAddress197->setVtw($vtw8);
//        $buildingAddress197->setResidentialArea($residentialArea9);
//        $buildingAddress197->setBuildingType($buildingType9);
//        $buildingAddress197->setLivingType($livingType2);
//
//        $buildingAddress198->setConstructionYear(1976);
//        $buildingAddress198->setRenovationYear(2001);
//        $buildingAddress198->setStreetName('æŒRǿndestraat');
//        $buildingAddress198->setHouseNumber(14);
//        $buildingAddress198->setAddition('I');
//        $buildingAddress198->setZipcode('9034FR');
//        $buildingAddress198->setCity('Groningen');
//        $buildingAddress198->setRentalUnitNumber('E-0048');
//        $buildingAddress198->setDaeb(true);
//        $buildingAddress198->setVtw($vtw9);
//        $buildingAddress198->setResidentialArea($residentialArea9);
//        $buildingAddress198->setBuildingType($buildingType9);
//        $buildingAddress198->setLivingType($livingType2);
//
//        $buildingAddress199->setConstructionYear(1976);
//        $buildingAddress199->setRenovationYear(2001);
//        $buildingAddress199->setStreetName('æŒRǿndestraat');
//        $buildingAddress199->setHouseNumber(16);
//        $buildingAddress199->setAddition('I');
//        $buildingAddress199->setZipcode('9034FR');
//        $buildingAddress199->setCity('Groningen');
//        $buildingAddress199->setRentalUnitNumber('E-0049');
//        $buildingAddress199->setDaeb(true);
//        $buildingAddress199->setVtw($vtw10);
//        $buildingAddress199->setResidentialArea($residentialArea9);
//        $buildingAddress199->setBuildingType($buildingType9);
//        $buildingAddress199->setLivingType($livingType2);
//
//        $buildingAddress200->setConstructionYear(1976);
//        $buildingAddress200->setRenovationYear(2001);
//        $buildingAddress200->setStreetName('æŒRǿndestraat');
//        $buildingAddress200->setHouseNumber(18);
//        $buildingAddress200->setAddition('I');
//        $buildingAddress200->setZipcode('9034FR');
//        $buildingAddress200->setCity('Groningen');
//        $buildingAddress200->setRentalUnitNumber('E-0050');
//        $buildingAddress200->setDaeb(true);
//        $buildingAddress200->setVtw($vtw10);
//        $buildingAddress200->setResidentialArea($residentialArea9);
//        $buildingAddress200->setBuildingType($buildingType9);
//        $buildingAddress200->setLivingType($livingType2);
//
//        $buildingAddress201->setConstructionYear(1950);
//        $buildingAddress201->setStreetName('Ferdinand Bolstraat');
//        $buildingAddress201->setHouseNumber(1);
//        $buildingAddress201->setAddition('');
//        $buildingAddress201->setZipcode('8021ES');
//        $buildingAddress201->setCity('Zwolle');
//        $buildingAddress201->setBagId('0193200000008586');
//        $buildingAddress201->setRentalUnitNumber('ALG1010');
//        $buildingAddress201->setDaeb(true);
//        $buildingAddress201->setVtw($vtw4);
//        $buildingAddress201->setResidentialArea($residentialArea2);
//        $buildingAddress201->setBuildingType($buildingType14);
//        $buildingAddress201->setLivingType($livingType1);
//
//        $buildingAddress202->setConstructionYear(1950);
//        $buildingAddress202->setStreetName('Ferdinand Bolstraat');
//        $buildingAddress202->setHouseNumber(7);
//        $buildingAddress202->setAddition('');
//        $buildingAddress202->setZipcode('8021ES');
//        $buildingAddress202->setCity('Zwolle');
//        $buildingAddress202->setBagId('0193200000031259');
//        $buildingAddress202->setRentalUnitNumber('ALG1010');
//        $buildingAddress202->setDaeb(true);
//        $buildingAddress202->setVtw($vtw4);
//        $buildingAddress202->setResidentialArea($residentialArea2);
//        $buildingAddress202->setBuildingType($buildingType13);
//        $buildingAddress202->setLivingType($livingType1);
//
//        $buildingAddress203->setConstructionYear(1950);
//        $buildingAddress203->setStreetName('Ferdinand Bolstraat');
//        $buildingAddress203->setHouseNumber(13);
//        $buildingAddress203->setAddition('');
//        $buildingAddress203->setZipcode('8021ES');
//        $buildingAddress203->setCity('Zwolle');
//        $buildingAddress203->setBagId('0193200000042469');
//        $buildingAddress203->setRentalUnitNumber('ALG1010');
//        $buildingAddress203->setDaeb(true);
//        $buildingAddress203->setVtw($vtw4);
//        $buildingAddress203->setResidentialArea($residentialArea2);
//        $buildingAddress203->setBuildingType($buildingType14);
//        $buildingAddress203->setLivingType($livingType1);
//
//        $buildingAddress204->setConstructionYear(1950);
//        $buildingAddress204->setStreetName('Ferdinand Bolstraat');
//        $buildingAddress204->setHouseNumber(15);
//        $buildingAddress204->setAddition('');
//        $buildingAddress204->setZipcode('8021ES');
//        $buildingAddress204->setCity('Zwolle');
//        $buildingAddress204->setBagId('0193200000008587');
//        $buildingAddress204->setRentalUnitNumber('ALG1010');
//        $buildingAddress204->setDaeb(true);
//        $buildingAddress204->setVtw($vtw4);
//        $buildingAddress204->setResidentialArea($residentialArea2);
//        $buildingAddress204->setBuildingType($buildingType14);
//        $buildingAddress204->setLivingType($livingType1);
//
//        $buildingAddress205->setConstructionYear(1950);
//        $buildingAddress205->setStreetName('Ferdinand Bolstraat');
//        $buildingAddress205->setHouseNumber(17);
//        $buildingAddress205->setAddition('');
//        $buildingAddress205->setZipcode('8021ES');
//        $buildingAddress205->setCity('Zwolle');
//        $buildingAddress205->setBagId('0193200000042470');
//        $buildingAddress205->setRentalUnitNumber('ALG1010');
//        $buildingAddress205->setDaeb(true);
//        $buildingAddress205->setVtw($vtw4);
//        $buildingAddress205->setResidentialArea($residentialArea2);
//        $buildingAddress205->setBuildingType($buildingType14);
//        $buildingAddress205->setLivingType($livingType1);
//
//        $buildingAddress206->setConstructionYear(1950);
//        $buildingAddress206->setStreetName('Ferdinand Bolstraat');
//        $buildingAddress206->setHouseNumber(21);
//        $buildingAddress206->setAddition('');
//        $buildingAddress206->setZipcode('8021ES');
//        $buildingAddress206->setCity('Zwolle');
//        $buildingAddress206->setBagId('0193200000019892');
//        $buildingAddress206->setRentalUnitNumber('ALG1010');
//        $buildingAddress206->setDaeb(true);
//        $buildingAddress206->setVtw($vtw4);
//        $buildingAddress206->setResidentialArea($residentialArea2);
//        $buildingAddress206->setBuildingType($buildingType14);
//        $buildingAddress206->setLivingType($livingType1);
//
//        $buildingAddress207->setConstructionYear(1950);
//        $buildingAddress207->setStreetName('Govert Flinckstraat');
//        $buildingAddress207->setHouseNumber(8);
//        $buildingAddress207->setAddition('');
//        $buildingAddress207->setZipcode('8021ET');
//        $buildingAddress207->setCity('Zwolle');
//        $buildingAddress207->setBagId('0193200000008721');
//        $buildingAddress207->setRentalUnitNumber('ALG1010');
//        $buildingAddress207->setDaeb(true);
//        $buildingAddress207->setVtw($vtw4);
//        $buildingAddress207->setResidentialArea($residentialArea2);
//        $buildingAddress207->setBuildingType($buildingType13);
//        $buildingAddress207->setLivingType($livingType1);
//
//
//        $buildingAddress208->setConstructionYear(1950);
//        $buildingAddress208->setStreetName('Van Miereveltstraat');
//        $buildingAddress208->setHouseNumber(4);
//        $buildingAddress208->setAddition('');
//        $buildingAddress208->setZipcode('8021ER');
//        $buildingAddress208->setCity('Zwolle');
//        $buildingAddress208->setBagId('0193200000007151');
//        $buildingAddress208->setRentalUnitNumber('ALG1010');
//        $buildingAddress208->setDaeb(true);
//        $buildingAddress208->setVtw($vtw4);
//        $buildingAddress208->setResidentialArea($residentialArea2);
//        $buildingAddress208->setBuildingType($buildingType14);
//        $buildingAddress208->setLivingType($livingType1);
//
//        $buildingAddress209->setConstructionYear(1950);
//        $buildingAddress209->setStreetName('Van Miereveltstraat');
//        $buildingAddress209->setHouseNumber(10);
//        $buildingAddress209->setAddition('');
//        $buildingAddress209->setZipcode('8021ER');
//        $buildingAddress209->setCity('Zwolle');
//        $buildingAddress209->setBagId('0193200000014782');
//        $buildingAddress209->setRentalUnitNumber('ALG1010');
//        $buildingAddress209->setDaeb(true);
//        $buildingAddress209->setVtw($vtw4);
//        $buildingAddress209->setResidentialArea($residentialArea2);
//        $buildingAddress209->setBuildingType($buildingType14);
//        $buildingAddress209->setLivingType($livingType1);
//
//        $buildingAddress210->setConstructionYear(1950);
//        $buildingAddress210->setStreetName('Van Miereveltstraat');
//        $buildingAddress210->setHouseNumber(16);
//        $buildingAddress210->setAddition('');
//        $buildingAddress210->setZipcode('8021ER');
//        $buildingAddress210->setCity('Zwolle');
//        $buildingAddress210->setBagId('0193200000037358');
//        $buildingAddress210->setRentalUnitNumber('ALG1010');
//        $buildingAddress210->setDaeb(true);
//        $buildingAddress210->setVtw($vtw4);
//        $buildingAddress210->setResidentialArea($residentialArea2);
//        $buildingAddress210->setBuildingType($buildingType14);
//        $buildingAddress210->setLivingType($livingType1);
//
//        $buildingAddress211->setConstructionYear(1950);
//        $buildingAddress211->setStreetName('Van Miereveltstraat');
//        $buildingAddress211->setHouseNumber(18);
//        $buildingAddress211->setAddition('');
//        $buildingAddress211->setZipcode('8021ER');
//        $buildingAddress211->setCity('Zwolle');
//        $buildingAddress211->setBagId('0193200000014785');
//        $buildingAddress211->setRentalUnitNumber('ALG1010');
//        $buildingAddress211->setDaeb(true);
//        $buildingAddress211->setVtw($vtw4);
//        $buildingAddress211->setResidentialArea($residentialArea2);
//        $buildingAddress211->setBuildingType($buildingType14);
//        $buildingAddress211->setLivingType($livingType1);
//
//        $buildingAddress212->setConstructionYear(1950);
//        $buildingAddress212->setStreetName('Van Miereveltstraat');
//        $buildingAddress212->setHouseNumber(20);
//        $buildingAddress212->setAddition('');
//        $buildingAddress212->setZipcode('8021ER');
//        $buildingAddress212->setCity('Zwolle');
//        $buildingAddress212->setBagId('0193200000033623');
//        $buildingAddress212->setRentalUnitNumber('ALG1010');
//        $buildingAddress212->setDaeb(true);
//        $buildingAddress212->setVtw($vtw4);
//        $buildingAddress212->setResidentialArea($residentialArea2);
//        $buildingAddress212->setBuildingType($buildingType14);
//        $buildingAddress212->setLivingType($livingType1);
//
//        $buildingAddress213->setConstructionYear(1950);
//        $buildingAddress213->setStreetName('Van Miereveltstraat');
//        $buildingAddress213->setHouseNumber(24);
//        $buildingAddress213->setAddition('');
//        $buildingAddress213->setZipcode('8021ER');
//        $buildingAddress213->setCity('Zwolle');
//        $buildingAddress213->setBagId('0193200000052584');
//        $buildingAddress213->setRentalUnitNumber('ALG1010');
//        $buildingAddress213->setDaeb(true);
//        $buildingAddress213->setVtw($vtw4);
//        $buildingAddress213->setResidentialArea($residentialArea2);
//        $buildingAddress213->setBuildingType($buildingType14);
//        $buildingAddress213->setLivingType($livingType1);

        foreach ($buildingAddresses as $buildingAddress) {
            $buildingAddressObject = new BuildingAddress();
            
            if (!empty($buildingAddress['streetName'])) {
                $buildingAddressObject->setStreetName($buildingAddress['streetName']);
            }

            if (!empty($buildingAddress['houseNumber'])) {
                $buildingAddressObject->setHouseNumber($buildingAddress['houseNumber']);
            }

            if (!empty($buildingAddress['addition'])) {
                $buildingAddressObject->setAddition($buildingAddress['addition']);
            }

            if (!empty($buildingAddress['zipcode'])) {
                $buildingAddressObject->setZipcode($buildingAddress['zipcode']);
            }

            if (!empty($buildingAddress['city'])) {
                $buildingAddressObject->setCity($buildingAddress['city']);
            }

            if (!empty($buildingAddress['rentalUnitNumber'])) {
                $buildingAddressObject->setRentalUnitNumber($buildingAddress['rentalUnitNumber']);
            }

            if (!empty($buildingAddress['daeb'])) {
                $buildingAddressObject->setDaeb($buildingAddress['daeb']);
            }

            if (!empty($buildingAddress['constructionYear'])) {
                $buildingAddressObject->setConstructionYear($buildingAddress['constructionYear']);
            }

            if (!empty($buildingAddress['renovationYear'])) {
                $buildingAddressObject->setRenovationYear($buildingAddress['renovationYear']);
            }

            if (!empty($buildingAddress['vtw'])) {
                /** @var Vtw $vtw */
                $vtw = $this->getReference($buildingAddress['vtw']);
                $buildingAddressObject->setVtw($vtw);
            }

            if (!empty($buildingAddress['housingstock'])) {
                /** @var HousingStock $housingStock */
                $housingStock = $this->getReference($buildingAddress['housingstock']);
                $buildingAddressObject->setHousingStock($housingStock);
            }

            if (!empty($buildingAddress['residentialarea'])) {
                /** @var ResidentialArea $residentialarea */
                $residentialarea = $this->getReference($buildingAddress['residentialarea']);
                $buildingAddressObject->setResidentialArea($residentialarea);
            }

            if (!empty($buildingAddress['block'])) {
                /** @var Block $block */
                $block = $this->getReference($buildingAddress['block']);
                $buildingAddressObject->setBlock($block);
            }

            if (!empty($buildingAddress['buildingtype'])) {
                /** @var BuildingType $buildingtype */
                $buildingtype = $this->getReference($buildingAddress['buildingtype']);
                $buildingAddressObject->setBuildingType($buildingtype);
            }

            if (!empty($buildingAddress['livingtype'])) {
                /** @var LivingType $livingtype */
                $livingtype = $this->getReference($buildingAddress['livingtype']);
                $buildingAddressObject->setLivingType($livingtype);
            }
        }
    }

    public function getDependencies(): array
    {
        return [
            LoadVtwsData::class,
            LoadHousingStocksData::class,
            LoadResidentialAreasData::class,
            LoadBlocksData::class,
            LoadBuildingTypesData::class,
            LoadLivingTypesData::class
        ];
    }
}
