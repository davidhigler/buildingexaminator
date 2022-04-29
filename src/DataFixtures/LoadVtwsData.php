<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\Vtw;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadVtwsData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $vtws = [
            [
                'code' => 'WT 1',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 1R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '1R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 2',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 2R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '2R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 3',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 4',
                'typeDescription' => 'eengezinswoning/senioren-woning',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'tussen 1990 en 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 5',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'tussen 1990 en 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 6',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 7R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '7R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 8',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 9',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'tussen 1990 en 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 10',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 11',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 11R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '11R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 12',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '12',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 13',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '13',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 14',
                'typeDescription' => 'open portiekwoning',
                'buildingTypeDescription' => '14',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 14R',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '14R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 15',
                'typeDescription' => 'open portiekwoning',
                'buildingTypeDescription' => '15',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 15R',
                'typeDescription' => 'renovatie open portiekwoning',
                'buildingTypeDescription' => '15R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 16',
                'typeDescription' => 'etagewoning',
                'buildingTypeDescription' => '16',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 16R',
                'typeDescription' => 'renovatie etagewoning',
                'buildingTypeDescription' => '16R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 17',
                'typeDescription' => 'etagewoning',
                'buildingTypeDescription' => '17',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 17R',
                'typeDescription' => 'renovatie etagewoning',
                'buildingTypeDescription' => '17R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 18',
                'typeDescription' => 'trappenhuisflat Amsterdamse school',
                'buildingTypeDescription' => '18',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 18R',
                'typeDescription' => 'renovatie trappenhuisflat Amsterdamse school',
                'buildingTypeDescription' => '18R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 19',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '19',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 19R',
                'typeDescription' => 'renovatie trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '19R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 20',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '20',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 20R',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '20R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 21',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '21',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 21R',
                'typeDescription' => 'renovatie trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '21R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 22',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '22',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 22R',
                'typeDescription' => 'renovatie trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '22R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 23',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '23',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 24',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '24',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 25',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '25',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 26',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '26',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 27',
                'typeDescription' => 'trappenhuis-/corridorflat zgn. Urban villa tot en met 4 lagen',
                'buildingTypeDescription' => '27',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak en hellend dak'
            ],
            [
                'code' => 'WT 28',
                'typeDescription' => 'trappenhuis-/corridorflat meer dan 4 lagen',
                'buildingTypeDescription' => '28',
                'constructionYearDescription' => '1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 28R',
                'typeDescription' => 'renovatie-trappenhuis-/corridorflat meer dan 4 lagen',
                'buildingTypeDescription' => '28R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 29',
                'typeDescription' => 'trappenhuis-/corridorflat meer dan 4 lagen',
                'buildingTypeDescription' => '29',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 30',
                'typeDescription' => 'trappenhuis-/corridorflat meer dan 4 lagen',
                'buildingTypeDescription' => '30',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 31',
                'typeDescription' => 'galerijflat tot en met 2 lagen',
                'buildingTypeDescription' => '31',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 32',
                'typeDescription' => 'galerijflat tot en met 4 lagen',
                'buildingTypeDescription' => '32',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 32R',
                'typeDescription' => 'renovatie galerijflat tot en met 4 lagen',
                'buildingTypeDescription' => '32R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 33',
                'typeDescription' => 'galerijflat tot en met 4 lagen',
                'buildingTypeDescription' => '33',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 34',
                'typeDescription' => 'galerijflat tot en met 4 lagen',
                'buildingTypeDescription' => '34',
                'constructionYearDescription' => 'na 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 35',
                'typeDescription' => 'galerijflat meer dan 4 lagen',
                'buildingTypeDescription' => '35',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 35R',
                'typeDescription' => 'renovatie galerijflat meer dan 4 lagen',
                'buildingTypeDescription' => '35R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 36',
                'typeDescription' => 'galerijflat meer dan 4 lagen',
                'buildingTypeDescription' => '36',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 37',
                'typeDescription' => 'galerijflat meer dan 4 lagen',
                'buildingTypeDescription' => '37',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 38R',
                'typeDescription' => 'renovatie galerijmaisonnette meer dan 4 lagen',
                'buildingTypeDescription' => '38R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 39R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '39R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 40',
                'typeDescription' => 'luxe appartementencomplex meer dan 4 lagen',
                'buildingTypeDescription' => '40',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 41',
                'typeDescription' => 'bovenwoning',
                'buildingTypeDescription' => '41',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 42',
                'typeDescription' => 'vinexwoning',
                'buildingTypeDescription' => '42',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 43',
                'typeDescription' => 'galerijflat 2 lagen',
                'buildingTypeDescription' => '43',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 44',
                'typeDescription' => 'appartementen in grachtenpand',
                'buildingTypeDescription' => '44',
                'constructionYearDescription' => 'voor 1900',
                'roofTypeDescription' => 'vlak en hellend dak'
            ],
            [
                'code' => 'WT 45',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '45',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 46',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '46',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 47',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '47',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 48R',
                'typeDescription' => 'Renovatie eengezinswoning',
                'buildingTypeDescription' => '48R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 49',
                'typeDescription' => 'duurzame eengezinswoning',
                'buildingTypeDescription' => '49',
                'constructionYearDescription' => 'na 2015',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 50',
                'typeDescription' => 'duurzame galerij appartementen',
                'buildingTypeDescription' => '50',
                'constructionYearDescription' => 'na 2015',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT 51R',
                'typeDescription' => 'renovatie eengezinswoning nul op de meter',
                'buildingTypeDescription' => '51R',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 52',
                'typeDescription' => 'energieneutrale eengezinswoning nul op de meter',
                'buildingTypeDescription' => '52',
                'constructionYearDescription' => 'na 2016',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT 135',
                'typeDescription' => 'energieneutrale appartementencomplex nul op de meter',
                'buildingTypeDescription' => '135',
                'constructionYearDescription' => 'na 2019',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'GT 1',
                'typeDescription' => 'aangebouwde garagebox',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'GT 2',
                'typeDescription' => 'aangebouwde garagebox',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'GT 3',
                'typeDescription' => 'vrijstaande garagebox',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'GT 4',
                'typeDescription' => 'garagebox in rij',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'GT 5',
                'typeDescription' => 'garagebox onder gebouw',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'GT 6',
                'typeDescription' => 'garagebox ondergronds',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'GT 7',
                'typeDescription' => 'garagebox bovengronds',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 1',
                'typeDescription' => 'grachtenpand gevel(s) in metselwerk',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 2',
                'typeDescription' => 'grachtenpand gevel(s) gestukadoord en geschilderd',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 3',
                'typeDescription' => 'klassieke (monumentale) kantoorvilla gevel(s) in metselwerk',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 4',
                'typeDescription' => 'klassieke (monumentale) kantoorvilla gevel(s) gestukadoord en geschilderd',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 5',
                'typeDescription' => 'middelhoog jaren zestig-zeventig bouw gevel(s) in metselwerk',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 6',
                'typeDescription' => 'middelhoog jaren zestig-zeventig bouw gevel(s) in beton',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 7',
                'typeDescription' => 'laag gevel(s) in metselwerk',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 8',
                'typeDescription' => 'laag vliesgevel(s)',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 9',
                'typeDescription' => 'laag gevel(s) in natuursteen',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 10',
                'typeDescription' => 'laag gevel(s) in beton',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 11',
                'typeDescription' => 'laag gevel(s) in metaal',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 12',
                'typeDescription' => 'middelhoog gevel(s) metselwerk',
                'buildingTypeDescription' => '12',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 13',
                'typeDescription' => 'middelhoog vliesgevel(s)',
                'buildingTypeDescription' => '13',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 14',
                'typeDescription' => 'middelhoog gevel(s) in natuursteen',
                'buildingTypeDescription' => '14',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 15',
                'typeDescription' => 'middelhoog gevel(s) in beton',
                'buildingTypeDescription' => '15',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 16',
                'typeDescription' => 'middelhoog gevel(s) in metaal',
                'buildingTypeDescription' => '16',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 17',
                'typeDescription' => 'hoog vliesgevel(s)',
                'buildingTypeDescription' => '17',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 18',
                'typeDescription' => 'hoog gevel(s) in natuursteen',
                'buildingTypeDescription' => '18',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 19',
                'typeDescription' => 'hoog gevel(s) in beton',
                'buildingTypeDescription' => '19',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 20',
                'typeDescription' => 'hoog gevel(s) in metaal',
                'buildingTypeDescription' => '20',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 21',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur gevel(s) in metselwerk',
                'buildingTypeDescription' => '21',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 22',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur gevel(s) in isolatiestukwerk',
                'buildingTypeDescription' => '22',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 23',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur in natuursteen',
                'buildingTypeDescription' => '23',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 24',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur in metaal ',
                'buildingTypeDescription' => '24',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 25',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur in beton',
                'buildingTypeDescription' => '25',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 26',
                'typeDescription' => 'middelhoog eigetijds klassieke architectuur gevel(s) in metselwerk',
                'buildingTypeDescription' => '26',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 27',
                'typeDescription' => 'laag gevel(s) in metselwerk inclusief parkeergarage',
                'buildingTypeDescription' => '27',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 28R',
                'typeDescription' => 'Revitalisatie kantoorgebouw middelhoog gevels in sierbeton elementen',
                'buildingTypeDescription' => '28R',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT 40',
                'typeDescription' => 'energieneutraal kantoorgebouw nul op de meter duurzaam gebouw onder moderne architectuur',
                'buildingTypeDescription' => '40',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 1',
                'typeDescription' => 'kleinschalig gevel(s) in metselwerk',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 2',
                'typeDescription' => 'kleinschalig gevel(s) in metaal',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 3',
                'typeDescription' => 'kleinschalig gevel(s) in metselwerk/metaal',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 4',
                'typeDescription' => 'middelschalig gevel(s) in metselwerk',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 5',
                'typeDescription' => 'middelschalig gevel(s) in metaal',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 6',
                'typeDescription' => 'middelschalig gevel(s) in metselwerk/metaal',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 7',
                'typeDescription' => 'grootschalig gevel(s) in metselwerk',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 8',
                'typeDescription' => 'grootschalig gevel(s) in metaal',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 9',
                'typeDescription' => 'grootschalig gevel(s) in metselwerk/metaal',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 10',
                'typeDescription' => 'klein- tot grootschailg gevel(s) en dak in metaal',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 11',
                'typeDescription' => 'combinatiegebouw met showroom/serviceruimte kantoor en bedrijfsruimte',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 12',
                'typeDescription' => 'bedrijfsverzamelgebouw',
                'buildingTypeDescription' => '12',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 13',
                'typeDescription' => 'kleinschalig distrubutiecentrum',
                'buildingTypeDescription' => '13',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 14',
                'typeDescription' => 'grootschalig distrubutiecentrum',
                'buildingTypeDescription' => '14',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 15',
                'typeDescription' => 'garagebedrijf met showroom en kantoren',
                'buildingTypeDescription' => '15',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT 16',
                'typeDescription' => 'bedrijfsverzamelgebouw prefab betonbouw',
                'buildingTypeDescription' => '16',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 1',
                'typeDescription' => 'individuele winkel / winkel in winkelstraat ouder type',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 2',
                'typeDescription' => 'individuele winkel / winkel in winkelstraat recenter type',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 3',
                'typeDescription' => 'winkel in het centrum niet dekt ouder type',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 4',
                'typeDescription' => 'winkel in het centrum niet dekt recenter type',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 5',
                'typeDescription' => 'winkel in het centrum overdekt ouder type',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 6',
                'typeDescription' => 'winkel in het centrum overdekt recenter type',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 7',
                'typeDescription' => 'kiosk',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 8',
                'typeDescription' => 'solitaire supermakrt',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 9',
                'typeDescription' => 'grootschalige detailhandelsunit',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 10',
                'typeDescription' => 'perifere grootschalige detailhandelsunit',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 11',
                'typeDescription' => 'bouwmarkt',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT 23',
                'typeDescription' => 'energieneutraal solitaire supermarkt nul op de meter',
                'buildingTypeDescription' => '23',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT 1R',
                'typeDescription' => 'voormalig schoolgebouw',
                'buildingTypeDescription' => '1R',
                'constructionYearDescription' => 'tussen 1900 en 1930',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT 2R',
                'typeDescription' => 'voormalig kantoorgebouw',
                'buildingTypeDescription' => '2R',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT 3R',
                'typeDescription' => 'voormalig fabrieksgebouw',
                'buildingTypeDescription' => '3R',
                'constructionYearDescription' => 'tussen 1900 en 1930',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT 4R',
                'typeDescription' => 'voormalig jongerencentrum',
                'buildingTypeDescription' => '4R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT 5R',
                'typeDescription' => 'voormalig kantoorgebouw',
                'buildingTypeDescription' => '5R',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 1',
                'typeDescription' => 'café / restaurant',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 2',
                'typeDescription' => 'hotel kleinschalig',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 3',
                'typeDescription' => 'hotel grootschalig',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 4',
                'typeDescription' => 'bioscoop',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 5',
                'typeDescription' => 'discotheek',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 6',
                'typeDescription' => 'woon-/zorgcomplex',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 7',
                'typeDescription' => 'gemeentehuis',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 8',
                'typeDescription' => 'brandweerkazerne',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 9',
                'typeDescription' => 'theater middelgroot modern',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 10',
                'typeDescription' => 'theater kleinscahig',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 11',
                'typeDescription' => 'kleinschalig woon-/zorgcomplex',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT 12',
                'typeDescription' => 'grootschalig woon-/zorgcomplex',
                'buildingTypeDescription' => '12',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT 1',
                'typeDescription' => 'woonboederij',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT 2',
                'typeDescription' => 'woonboederij',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT 3',
                'typeDescription' => 'vleesvarkensstal',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT 4',
                'typeDescription' => 'loodsgebouw',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT 5',
                'typeDescription' => 'pluimveestal',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT 6',
                'typeDescription' => 'paardenhouderij',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT 7',
                'typeDescription' => 'melkveestal',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ]
        ];

        foreach ($vtws as $vtw) {
            $vtwObject = new Vtw();

            if (empty($vtw['code'])) {
                throw new RuntimeException('code may not be empty, it\'s used as a variable reference in the data fixtures.');
            } else {
                $vtwObject->setCode($vtw['code']);
            }

            if (!empty($vtw['typeDescription'])) {
                $vtwObject->setTypeDescription($vtw['typeDescription']);
            }

            if (!empty($vtw['buildingTypeDescription'])) {
                $vtwObject->setBuildingTypeDescription($vtw['buildingTypeDescription']);
            }

            if (!empty($vtw['constructionYearDescription'])) {
                $vtwObject->setConstructionYearDescription($vtw['constructionYearDescription']);
            }

            if (!empty($vtw['roofTypeDescription'])) {
                $vtwObject->setRoofTypeDescription($vtw['roofTypeDescription']);
            }

            $validator = Validation::createValidator();
            $errors = $validator->validate($vtwObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($vtwObject);
            $this->addReference($vtw['code'], $vtwObject);
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