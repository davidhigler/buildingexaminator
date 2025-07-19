<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\Vtw;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadVtwData extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $vtws = [
            [
                'code' => 'WT1',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT1R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '1R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT2',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT2R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '2R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT3',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT4',
                'typeDescription' => 'eengezinswoning/senioren-woning',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'tussen 1990 en 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT5',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'tussen 1990 en 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT6',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT7R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '7R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT8',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT9',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'tussen 1990 en 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT10',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT11',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT11R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '11R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT12',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '12',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT13',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '13',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT14',
                'typeDescription' => 'open portiekwoning',
                'buildingTypeDescription' => '14',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT14R',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '14R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT15',
                'typeDescription' => 'open portiekwoning',
                'buildingTypeDescription' => '15',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT15R',
                'typeDescription' => 'renovatie open portiekwoning',
                'buildingTypeDescription' => '15R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT16',
                'typeDescription' => 'etagewoning',
                'buildingTypeDescription' => '16',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT16R',
                'typeDescription' => 'renovatie etagewoning',
                'buildingTypeDescription' => '16R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT17',
                'typeDescription' => 'etagewoning',
                'buildingTypeDescription' => '17',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT17R',
                'typeDescription' => 'renovatie etagewoning',
                'buildingTypeDescription' => '17R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT18',
                'typeDescription' => 'trappenhuisflat Amsterdamse school',
                'buildingTypeDescription' => '18',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT18R',
                'typeDescription' => 'renovatie trappenhuisflat Amsterdamse school',
                'buildingTypeDescription' => '18R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT19',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '19',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT19R',
                'typeDescription' => 'renovatie trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '19R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT20',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '20',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT20R',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '20R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT21',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '21',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT21R',
                'typeDescription' => 'renovatie trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '21R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT22',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '22',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT22R',
                'typeDescription' => 'renovatie trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '22R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT23',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '23',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT24',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '24',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT25',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '25',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT26',
                'typeDescription' => 'trappenhuisflat tot en met 4 lagen',
                'buildingTypeDescription' => '26',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT27',
                'typeDescription' => 'trappenhuis-/corridorflat zgn. Urban villa tot en met 4 lagen',
                'buildingTypeDescription' => '27',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak en hellend dak'
            ],
            [
                'code' => 'WT28',
                'typeDescription' => 'trappenhuis-/corridorflat meer dan 4 lagen',
                'buildingTypeDescription' => '28',
                'constructionYearDescription' => '1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT28R',
                'typeDescription' => 'renovatie-trappenhuis-/corridorflat meer dan 4 lagen',
                'buildingTypeDescription' => '28R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT29',
                'typeDescription' => 'trappenhuis-/corridorflat meer dan 4 lagen',
                'buildingTypeDescription' => '29',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT30',
                'typeDescription' => 'trappenhuis-/corridorflat meer dan 4 lagen',
                'buildingTypeDescription' => '30',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT31',
                'typeDescription' => 'galerijflat tot en met 2 lagen',
                'buildingTypeDescription' => '31',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT32',
                'typeDescription' => 'galerijflat tot en met 4 lagen',
                'buildingTypeDescription' => '32',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT32R',
                'typeDescription' => 'renovatie galerijflat tot en met 4 lagen',
                'buildingTypeDescription' => '32R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT33',
                'typeDescription' => 'galerijflat tot en met 4 lagen',
                'buildingTypeDescription' => '33',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT34',
                'typeDescription' => 'galerijflat tot en met 4 lagen',
                'buildingTypeDescription' => '34',
                'constructionYearDescription' => 'na 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT35',
                'typeDescription' => 'galerijflat meer dan 4 lagen',
                'buildingTypeDescription' => '35',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT35R',
                'typeDescription' => 'renovatie galerijflat meer dan 4 lagen',
                'buildingTypeDescription' => '35R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT36',
                'typeDescription' => 'galerijflat meer dan 4 lagen',
                'buildingTypeDescription' => '36',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT37',
                'typeDescription' => 'galerijflat meer dan 4 lagen',
                'buildingTypeDescription' => '37',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT38R',
                'typeDescription' => 'renovatie galerijmaisonnette meer dan 4 lagen',
                'buildingTypeDescription' => '38R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT39R',
                'typeDescription' => 'renovatie eengezinswoning',
                'buildingTypeDescription' => '39R',
                'constructionYearDescription' => 'voor 1950',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT40',
                'typeDescription' => 'luxe appartementencomplex meer dan 4 lagen',
                'buildingTypeDescription' => '40',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT41',
                'typeDescription' => 'bovenwoning',
                'buildingTypeDescription' => '41',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT42',
                'typeDescription' => 'vinexwoning',
                'buildingTypeDescription' => '42',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT43',
                'typeDescription' => 'galerijflat 2 lagen',
                'buildingTypeDescription' => '43',
                'constructionYearDescription' => 'na 1990',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT44',
                'typeDescription' => 'appartementen in grachtenpand',
                'buildingTypeDescription' => '44',
                'constructionYearDescription' => 'voor 1900',
                'roofTypeDescription' => 'vlak en hellend dak'
            ],
            [
                'code' => 'WT45',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '45',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT46',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '46',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT47',
                'typeDescription' => 'eengezinswoning',
                'buildingTypeDescription' => '47',
                'constructionYearDescription' => 'na 2000',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT48R',
                'typeDescription' => 'Renovatie eengezinswoning',
                'buildingTypeDescription' => '48R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT49',
                'typeDescription' => 'duurzame eengezinswoning',
                'buildingTypeDescription' => '49',
                'constructionYearDescription' => 'na 2015',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT50',
                'typeDescription' => 'duurzame galerij appartementen',
                'buildingTypeDescription' => '50',
                'constructionYearDescription' => 'na 2015',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'WT51R',
                'typeDescription' => 'renovatie eengezinswoning nul op de meter',
                'buildingTypeDescription' => '51R',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT52',
                'typeDescription' => 'energieneutrale eengezinswoning nul op de meter',
                'buildingTypeDescription' => '52',
                'constructionYearDescription' => 'na 2016',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'WT135',
                'typeDescription' => 'energieneutrale appartementencomplex nul op de meter',
                'buildingTypeDescription' => '135',
                'constructionYearDescription' => 'na 2019',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'GT1',
                'typeDescription' => 'aangebouwde garagebox',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'hellend dak'
            ],
            [
                'code' => 'GT2',
                'typeDescription' => 'aangebouwde garagebox',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'GT3',
                'typeDescription' => 'vrijstaande garagebox',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'GT4',
                'typeDescription' => 'garagebox in rij',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'vlak dak'
            ],
            [
                'code' => 'GT5',
                'typeDescription' => 'garagebox onder gebouw',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'GT6',
                'typeDescription' => 'garagebox ondergronds',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'GT7',
                'typeDescription' => 'garagebox bovengronds',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT1',
                'typeDescription' => 'grachtenpand gevel(s) in metselwerk',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT2',
                'typeDescription' => 'grachtenpand gevel(s) gestukadoord en geschilderd',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT3',
                'typeDescription' => 'klassieke (monumentale) kantoorvilla gevel(s) in metselwerk',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT4',
                'typeDescription' => 'klassieke (monumentale) kantoorvilla gevel(s) gestukadoord en geschilderd',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT5',
                'typeDescription' => 'middelhoog jaren zestig-zeventig bouw gevel(s) in metselwerk',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT6',
                'typeDescription' => 'middelhoog jaren zestig-zeventig bouw gevel(s) in beton',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT7',
                'typeDescription' => 'laag gevel(s) in metselwerk',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT8',
                'typeDescription' => 'laag vliesgevel(s)',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT9',
                'typeDescription' => 'laag gevel(s) in natuursteen',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT10',
                'typeDescription' => 'laag gevel(s) in beton',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT11',
                'typeDescription' => 'laag gevel(s) in metaal',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT12',
                'typeDescription' => 'middelhoog gevel(s) metselwerk',
                'buildingTypeDescription' => '12',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT13',
                'typeDescription' => 'middelhoog vliesgevel(s)',
                'buildingTypeDescription' => '13',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT14',
                'typeDescription' => 'middelhoog gevel(s) in natuursteen',
                'buildingTypeDescription' => '14',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT15',
                'typeDescription' => 'middelhoog gevel(s) in beton',
                'buildingTypeDescription' => '15',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT16',
                'typeDescription' => 'middelhoog gevel(s) in metaal',
                'buildingTypeDescription' => '16',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT17',
                'typeDescription' => 'hoog vliesgevel(s)',
                'buildingTypeDescription' => '17',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT18',
                'typeDescription' => 'hoog gevel(s) in natuursteen',
                'buildingTypeDescription' => '18',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT19',
                'typeDescription' => 'hoog gevel(s) in beton',
                'buildingTypeDescription' => '19',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT20',
                'typeDescription' => 'hoog gevel(s) in metaal',
                'buildingTypeDescription' => '20',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT21',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur gevel(s) in metselwerk',
                'buildingTypeDescription' => '21',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT22',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur gevel(s) in isolatiestukwerk',
                'buildingTypeDescription' => '22',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT23',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur in natuursteen',
                'buildingTypeDescription' => '23',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT24',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur in metaal ',
                'buildingTypeDescription' => '24',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT25',
                'typeDescription' => 'kleinschalige kantoorvilla eigentijds moderne architectuur in beton',
                'buildingTypeDescription' => '25',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT26',
                'typeDescription' => 'middelhoog eigetijds klassieke architectuur gevel(s) in metselwerk',
                'buildingTypeDescription' => '26',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT27',
                'typeDescription' => 'laag gevel(s) in metselwerk inclusief parkeergarage',
                'buildingTypeDescription' => '27',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT28R',
                'typeDescription' => 'Revitalisatie kantoorgebouw middelhoog gevels in sierbeton elementen',
                'buildingTypeDescription' => '28R',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'KT40',
                'typeDescription' => 'energieneutraal kantoorgebouw nul op de meter duurzaam gebouw onder moderne architectuur',
                'buildingTypeDescription' => '40',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT1',
                'typeDescription' => 'kleinschalig gevel(s) in metselwerk',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT2',
                'typeDescription' => 'kleinschalig gevel(s) in metaal',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT3',
                'typeDescription' => 'kleinschalig gevel(s) in metselwerk/metaal',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT4',
                'typeDescription' => 'middelschalig gevel(s) in metselwerk',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT5',
                'typeDescription' => 'middelschalig gevel(s) in metaal',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT6',
                'typeDescription' => 'middelschalig gevel(s) in metselwerk/metaal',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT7',
                'typeDescription' => 'grootschalig gevel(s) in metselwerk',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT8',
                'typeDescription' => 'grootschalig gevel(s) in metaal',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT9',
                'typeDescription' => 'grootschalig gevel(s) in metselwerk/metaal',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT10',
                'typeDescription' => 'klein- tot grootschailg gevel(s) en dak in metaal',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT11',
                'typeDescription' => 'combinatiegebouw met showroom/serviceruimte kantoor en bedrijfsruimte',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT12',
                'typeDescription' => 'bedrijfsverzamelgebouw',
                'buildingTypeDescription' => '12',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT13',
                'typeDescription' => 'kleinschalig distrubutiecentrum',
                'buildingTypeDescription' => '13',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT14',
                'typeDescription' => 'grootschalig distrubutiecentrum',
                'buildingTypeDescription' => '14',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT15',
                'typeDescription' => 'garagebedrijf met showroom en kantoren',
                'buildingTypeDescription' => '15',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'BT16',
                'typeDescription' => 'bedrijfsverzamelgebouw prefab betonbouw',
                'buildingTypeDescription' => '16',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT1',
                'typeDescription' => 'individuele winkel / winkel in winkelstraat ouder type',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT2',
                'typeDescription' => 'individuele winkel / winkel in winkelstraat recenter type',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT3',
                'typeDescription' => 'winkel in het centrum niet dekt ouder type',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT4',
                'typeDescription' => 'winkel in het centrum niet dekt recenter type',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT5',
                'typeDescription' => 'winkel in het centrum overdekt ouder type',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT6',
                'typeDescription' => 'winkel in het centrum overdekt recenter type',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT7',
                'typeDescription' => 'kiosk',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT8',
                'typeDescription' => 'solitaire supermakrt',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT9',
                'typeDescription' => 'grootschalige detailhandelsunit',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT10',
                'typeDescription' => 'perifere grootschalige detailhandelsunit',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT11',
                'typeDescription' => 'bouwmarkt',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'WINT23',
                'typeDescription' => 'energieneutraal solitaire supermarkt nul op de meter',
                'buildingTypeDescription' => '23',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT1R',
                'typeDescription' => 'voormalig schoolgebouw',
                'buildingTypeDescription' => '1R',
                'constructionYearDescription' => 'tussen 1900 en 1930',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT2R',
                'typeDescription' => 'voormalig kantoorgebouw',
                'buildingTypeDescription' => '2R',
                'constructionYearDescription' => 'tussen 1970 en 1990',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT3R',
                'typeDescription' => 'voormalig fabrieksgebouw',
                'buildingTypeDescription' => '3R',
                'constructionYearDescription' => 'tussen 1900 en 1930',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT4R',
                'typeDescription' => 'voormalig jongerencentrum',
                'buildingTypeDescription' => '4R',
                'constructionYearDescription' => 'tussen 1950 en 1970',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'HT5R',
                'typeDescription' => 'voormalig kantoorgebouw',
                'buildingTypeDescription' => '5R',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT1',
                'typeDescription' => 'café / restaurant',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT2',
                'typeDescription' => 'hotel kleinschalig',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT3',
                'typeDescription' => 'hotel grootschalig',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT4',
                'typeDescription' => 'bioscoop',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT5',
                'typeDescription' => 'discotheek',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT6',
                'typeDescription' => 'woon-/zorgcomplex',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT7',
                'typeDescription' => 'gemeentehuis',
                'buildingTypeDescription' => '7',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT8',
                'typeDescription' => 'brandweerkazerne',
                'buildingTypeDescription' => '8',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT9',
                'typeDescription' => 'theater middelgroot modern',
                'buildingTypeDescription' => '9',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT10',
                'typeDescription' => 'theater kleinscahig',
                'buildingTypeDescription' => '10',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT11',
                'typeDescription' => 'kleinschalig woon-/zorgcomplex',
                'buildingTypeDescription' => '11',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'OT12',
                'typeDescription' => 'grootschalig woon-/zorgcomplex',
                'buildingTypeDescription' => '12',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT1',
                'typeDescription' => 'woonboederij',
                'buildingTypeDescription' => '1',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT2',
                'typeDescription' => 'woonboederij',
                'buildingTypeDescription' => '2',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT3',
                'typeDescription' => 'vleesvarkensstal',
                'buildingTypeDescription' => '3',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT4',
                'typeDescription' => 'loodsgebouw',
                'buildingTypeDescription' => '4',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT5',
                'typeDescription' => 'pluimveestal',
                'buildingTypeDescription' => '5',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT6',
                'typeDescription' => 'paardenhouderij',
                'buildingTypeDescription' => '6',
                'constructionYearDescription' => 'nvt',
                'roofTypeDescription' => 'nvt'
            ],
            [
                'code' => 'AT7',
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

            if (isset($vtw['typeDescription']) && ($vtw['typeDescription'] !== '' && $vtw['typeDescription'] !== '0')) {
                $vtwObject->setTypeDescription($vtw['typeDescription']);
            }

            if (isset($vtw['buildingTypeDescription']) && ($vtw['buildingTypeDescription'] !== '' && $vtw['buildingTypeDescription'] !== '0')) {
                $vtwObject->setBuildingTypeDescription($vtw['buildingTypeDescription']);
            }

            if (isset($vtw['constructionYearDescription']) && ($vtw['constructionYearDescription'] !== '' && $vtw['constructionYearDescription'] !== '0')) {
                $vtwObject->setConstructionYearDescription($vtw['constructionYearDescription']);
            }

            if (isset($vtw['roofTypeDescription']) && ($vtw['roofTypeDescription'] !== '' && $vtw['roofTypeDescription'] !== '0')) {
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
            $this->addReference('vtw_' . $vtw['code'], $vtwObject);
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