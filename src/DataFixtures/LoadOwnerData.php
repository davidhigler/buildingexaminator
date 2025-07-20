<?php

namespace App\DataFixtures;

use App\Entity\Authorization\Owner;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

/**
 * @author Reiny Griemink <rgriemink@gmail.com>
 */
class LoadOwnerData extends Fixture
{
    public function load(ObjectManager $objectManager): void
    {
        $owners = [
            [
                'name' => 'Dobro BV a',
                'lnumber' => 'L9999',
                'website' => 'https://www.buildingexaminator.nl'
            ],
            [
                'name' => 'Dobro BV b',
                'lnumber' => 'L9998',
                'website' => 'https://www.buildingexaminator.nl'
            ],
            [
                'name' => 'Dobro BV c',
                'lnumber' => 'L9997',
                'website' => 'https://www.buildingexaminator.nl'
            ],
            [
                'name' => 'Stichting Woningbedrijf Warnsveld',
                'lnumber' => 'L2104'
            ],
            [
                'name' => 'Woonstichting De Key',
                'lnumber' => 'L2103'
            ],
            [
                'name' => 'Stichting Goed Wonen Liempde',
                'lnumber' => 'L2101'
            ],
            [
                'name' => 'Noordwijkse Woningstichting',
                'lnumber' => 'L2092'
            ],
            [
                'name' => 'Woonstichtibng De zes Kernen',
                'lnumber' => 'L2090'
            ],
            [
                'name' => 'Stichting Woonplus Schiedam',
                'lnumber' => 'L2085'
            ],
            [
                'name' => 'Stichting Woondiensten Aarwoude',
                'lnumber' => 'L2084'
            ],
            [
                'name' => 'Woningstichting Nieuwkoop',
                'lnumber' => 'L2083'
            ],
            [
                'name' => 'Woningstichting Barneveld',
                'lnumber' => 'L2082'
            ],
            [
                'name' => 'Stichting Woningbedrijf Velsen',
                'lnumber' => 'L2073'
            ],
            [
                'name' => 'Waterweg wonen',
                'lnumber' => 'L2072'
            ],
            [
                'name' => 'Stichting Ymere',
                'lnumber' => 'L2070'
            ],
            [
                'name' => 'Rhenense Woningstichting',
                'lnumber' => 'L2068'
            ],
            [
                'name' => 'Wooncentrum Ouderen St. Zuidrandflat Gouda',
                'lnumber' => 'L2067'
            ],
            [
                'name' => 'Stichting Laurens Wonen ',
                'lnumber' => 'L2066'
            ],
            [
                'name' => 'Stichting Mitros',
                'lnumber' => 'L2058'
            ],
            [
                'name' => 'Ressort Wonen',
                'lnumber' => 'L2056'
            ],
            [
                'name' => 'Woonpartners Midden-Holland',
                'kvk' => 29045958,
                'btw' => 'NL804644433B01',
                'lnumber' => 'L2114',
                'website' => 'https://www.woonpartners-mh.nl'
            ],
            [
                'name' => 'ZorgGoedBrabant',
                'lnumber' => 'L2053'
            ],
            [
                'name' => 'Woonstichting Etten-Leur',
                'lnumber' => 'L2052'
            ],
            [
                'name' => 'Stichting Woonstede',
                'lnumber' => 'L2051'
            ],
            [
                'name' => 'Veron',
                'lnumber' => 'L2047'
            ],
            [
                'name' => 'Stichting Wonen Wierden Enter',
                'lnumber' => 'L2044'
            ],
            [
                'name' => 'Stichting Woonpalet Zeewolde',
                'lnumber' => 'L2014'
            ],
            [
                'name' => 'Stichting DUWO',
                'lnumber' => 'L2004'
            ],
            [
                'name' => 'SHBO',
                'lnumber' => 'L1986'
            ],
            [
                'name' => 'Harmonisch Wonen',
                'lnumber' => 'L1985'
            ],
            [
                'name' => 'SIB Woonservice',
                'lnumber' => 'L1969'
            ],
            [
                'name' => 'Stichting Verzorgd Wonen SHBB',
                'lnumber' => 'L1966'
            ],
            [
                'name' => 'Stichting Jongeren Huisvesting Twente',
                'lnumber' => 'L1964'
            ],
            [
                'name' => 'SSHN',
                'lnumber' => 'L1944'
            ],
            [
                'name' => 'Stichting Huisvesting Vredewold',
                'lnumber' => 'L1933'
            ],
            [
                'name' => 'WoonCompas',
                'kvk' => 24108743,
                'btw' => 'NL002776911B01',
                'lnumber' => 'L2110',
                'website' => 'https://www.wooncompas.nl'
            ],
            [
                'name' => 'Stichting Ouderenhuisvesting Rotterdam',
                'lnumber' => 'L1926'
            ],
            [
                'name' => 'Stichting Vestia Groep',
                'lnumber' => 'L1924'
            ],
            [
                'name' => 'Woonkracht10',
                'lnumber' => 'L1921'
            ],
            [
                'name' => 'Tiwos, Tilburgse Woonstichting',
                'lnumber' => 'L1913'
            ],
            [
                'name' => 'Stichting de Alliantie',
                'lnumber' => 'L1912'
            ],
            [
                'name' => 'Stichting WonenBreburg',
                'lnumber' => 'L1911'
            ],
            [
                'name' => 'WBO Wonen',
                'lnumber' => 'L1910'
            ],
            [
                'name' => 'Stichting Studenten Huisvesting',
                'lnumber' => 'L1909'
            ],
            [
                'name' => 'Brabantse Waard',
                'lnumber' => 'L1906'
            ],
            [
                'name' => 'Woningbouwvereniging Amerongen',
                'lnumber' => 'L1903'
            ],
            [
                'name' => 'Regionale Woningbouwvereniging Samenwerking ',
                'lnumber' => 'L1901'
            ],
            [
                'name' => 'Woningstichting De Volmacht',
                'lnumber' => 'L1899'
            ],
            [
                'name' => 'Woningstichting De Leeuw van Putten',
                'lnumber' => 'L1896'
            ],
            [
                'name' => 'Woonstichting Valburg',
                'lnumber' => 'L1893'
            ],
            [
                'name' => 'Woningbouwvereniging Oudewater',
                'lnumber' => 'L1892'
            ],
            [
                'name' => 'Woningstichting Goede Stede ',
                'lnumber' => 'L1891'
            ],
            [
                'name' => 'Woonstichting Centrada',
                'lnumber' => 'L1888'
            ],
            [
                'name' => 'Stichting Woningbeheer Betuwe',
                'lnumber' => 'L1881'
            ],
            [
                'name' => 'Woningstichting Leusden',
                'lnumber' => 'L1878'
            ],
            [
                'name' => 'Stichting Woonservice Drenthe',
                'lnumber' => 'L1877'
            ],
            [
                'name' => 'Stichting Maasdelta Groep',
                'lnumber' => 'L1876'
            ],
            [
                'name' => 'Stichting Woningcorporaties Het Gooi en Omstreken',
                'lnumber' => 'L1875'
            ],
            [
                'name' => 'Woningbouwvereniging "Lopik"',
                'lnumber' => 'L1866'
            ],
            [
                'name' => 'Woningstichting Putten',
                'lnumber' => 'L1865'
            ],
            [
                'name' => 'Wonen Vierlingsbeek',
                'lnumber' => 'L1864'
            ],
            [
                'name' => 'Oost Flevoland Woondiensten',
                'lnumber' => 'L1861'
            ],
            [
                'name' => 'Wovesto',
                'lnumber' => 'L1857'
            ],
            [
                'name' => 'Woonstichting Gendt',
                'lnumber' => 'L1855'
            ],
            [
                'name' => 'Woningstichting Kleine Meierij',
                'lnumber' => 'L1852'
            ],
            [
                'name' => 'Woningstichting Woensdrecht',
                'lnumber' => 'L1850'
            ],
            [
                'name' => 'Woningbouwvereniging Compaen',
                'lnumber' => 'L1847'
            ],
            [
                'name' => 'Woningstichting De Woonplaats',
                'lnumber' => 'L1842'
            ],
            [
                'name' => 'st. WoonGoed 2-Duizend',
                'lnumber' => 'L1839'
            ],
            [
                'name' => 'Woningvereniging Nederweert',
                'lnumber' => 'L1837'
            ],
            [
                'name' => 'Heuvelrug Wonen',
                'lnumber' => 'L1836'
            ],
            [
                'name' => 'Woningstichting Maasdriel',
                'lnumber' => 'L1835'
            ],
            [
                'name' => 'Woonstichting De Kernen',
                'lnumber' => 'L1825'
            ],
            [
                'name' => 'Laris Wonen en diensten',
                'lnumber' => 'L1821'
            ],
            [
                'name' => 'Stichting Mooiland',
                'lnumber' => 'L1817'
            ],
            [
                'name' => 'Stichting PeelrandWonen',
                'lnumber' => 'L1811'
            ],
            [
                'name' => 'Woningstichting Volksbelang',
                'lnumber' => 'L1807'
            ],
            [
                'name' => 'Mercatus',
                'lnumber' => 'L1804'
            ],
            [
                'name' => 'Woningstichting de Zaligheden',
                'lnumber' => 'L1794'
            ],
            [
                'name' => 'Stichting Acantus Groep',
                'lnumber' => 'L1793'
            ],
            [
                'name' => 'Stichting Thus wonen',
                'lnumber' => 'L1792'
            ],
            [
                'name' => 'Woonstichting Leystromen',
                'lnumber' => 'L1788'
            ],
            [
                'name' => 'Stichting WSG',
                'lnumber' => 'L1787'
            ],
            [
                'name' => 'Stichting Stadlander',
                'lnumber' => 'L1785'
            ],
            [
                'name' => 'Stichting Thuisvester',
                'lnumber' => 'L1781'
            ],
            [
                'name' => 'Staedion',
                'lnumber' => 'L1768'
            ],
            [
                'name' => 'Stichting woCom',
                'lnumber' => 'L1766'
            ],
            [
                'name' => 'Stichting Woonveste',
                'lnumber' => 'L1763'
            ],
            [
                'name' => 'Vieya',
                'lnumber' => 'L1762'
            ],
            [
                'name' => 'Bernardus wonen',
                'lnumber' => 'L1761'
            ],
            [
                'name' => 'Wbv. Reeuwijk',
                'lnumber' => 'L1760'
            ],
            [
                'name' => 'Wetland Wonen Groep',
                'lnumber' => 'L1753'
            ],
            [
                'name' => 'Stichting Woningcorporatie WoonGenoot',
                'lnumber' => 'L1748'
            ],
            [
                'name' => 'Goed Wonen',
                'lnumber' => 'L1745'
            ],
            [
                'name' => 'Stichting Woonservice Urbanus',
                'lnumber' => 'L1723'
            ],
            [
                'name' => 'Woningstichting Goed Wonen',
                'lnumber' => 'L1718'
            ],
            [
                'name' => 'Stichting Viveste',
                'lnumber' => 'L1716'
            ],
            [
                'name' => 'Wbv de Kombinatie',
                'lnumber' => 'L1713'
            ],
            [
                'name' => 'Chr. Woonstichting Patrimonium',
                'lnumber' => 'L1712'
            ],
            [
                'name' => 'Christelijke Woningstichting De Goede Woning',
                'lnumber' => 'L1709'
            ],
            [
                'name' => 'Woonstichting Land van Altena',
                'lnumber' => 'L1704'
            ],
            [
                'name' => 'wbv Beter Wonen',
                'lnumber' => 'L1700'
            ],
            [
                'name' => 'Wonen Limburg',
                'lnumber' => 'L1697'
            ],
            [
                'name' => 'Woningstichting Nijkerk',
                'lnumber' => 'L1693'
            ],
            [
                'name' => 'Ons Huis Woningstichting',
                'lnumber' => 'L1691'
            ],
            [
                'name' => 'Woningstichting St. Joseph',
                'lnumber' => 'L1689'
            ],
            [
                'name' => 'de Woonmensen/SJA',
                'lnumber' => 'L1680'
            ],
            [
                'name' => 'Woningstichting Tubbergen',
                'lnumber' => 'L1678'
            ],
            [
                'name' => 'Steelande wonen',
                'lnumber' => 'L1675'
            ],
            [
                'name' => 'Chr. stichting BCM wonen',
                'lnumber' => 'L1674'
            ],
            [
                'name' => 'Oosterpoort Wooncombinatie',
                'lnumber' => 'L1670'
            ],
            [
                'name' => 'Stichting Woonfriesland',
                'lnumber' => 'L1663'
            ],
            [
                'name' => 'Stichting Woonpartners',
                'lnumber' => 'L1647'
            ],
            [
                'name' => 'Stichting Woonzorg Nederland',
                'lnumber' => 'L1646'
            ],
            [
                'name' => 'Woningbouwvereniging Hoek van Holand',
                'lnumber' => 'L1640'
            ],
            [
                'name' => 'Stichting Accolade',
                'lnumber' => 'L1638'
            ],
            [
                'name' => 'Stichting Wonen Wittem',
                'lnumber' => 'L1622'
            ],
            [
                'name' => 'Kennemerhave',
                'lnumber' => 'L1612'
            ],
            [
                'name' => 'Stichting Woonburg',
                'lnumber' => 'L1606'
            ],
            [
                'name' => 'Woningstichting Gouderak',
                'lnumber' => 'L1598'
            ],
            [
                'name' => 'Woningbouwstichting Lek en Waard Wonen',
                'lnumber' => 'L1597'
            ],
            [
                'name' => 'Woningbouwstichting Cothen',
                'lnumber' => 'L1588'
            ],
            [
                'name' => 'Woningbouwvereniging Nieuw-Lekkerland',
                'lnumber' => 'L1586'
            ],
            [
                'name' => 'Woningbouwvereniging Vecht en Omstreken ',
                'lnumber' => 'L1585'
            ],
            [
                'name' => 'Bouwvereniging Ambt Delden',
                'lnumber' => 'L1584'
            ],
            [
                'name' => 'Zeeuwland',
                'lnumber' => 'L1581'
            ],
            [
                'name' => 'Woningstichting Wuta',
                'lnumber' => 'L1579'
            ],
            [
                'name' => 'Groen Wonen Vlist',
                'lnumber' => 'L1573'
            ],
            [
                'name' => 'Woongoed ZVL',
                'lnumber' => 'L1569'
            ],
            [
                'name' => 'Stichting Woontij',
                'lnumber' => 'L1560'
            ],
            [
                'name' => 'wbv Beter Wonen',
                'lnumber' => 'L1559'
            ],
            [
                'name' => 'Woningbouwvereniging "Goed Wonen"',
                'lnumber' => 'L1550'
            ],
            [
                'name' => 'Poort6',
                'lnumber' => 'L1549'
            ],
            [
                'name' => 'Woongoed GO',
                'lnumber' => 'L1544'
            ],
            [
                'name' => 'Vallei Wonen ',
                'lnumber' => 'L1543'
            ],
            [
                'name' => 'Stichting Lefier',
                'lnumber' => 'L1542'
            ],
            [
                'name' => 'Stichting WOONopMAAT',
                'lnumber' => 'L1533'
            ],
            [
                'name' => 'wbs Samenwerking',
                'lnumber' => 'L1532'
            ],
            [
                'name' => 'Stichting Woningbeheer De Vooruitgang',
                'lnumber' => 'L1525'
            ],
            [
                'name' => 'Rijnhart Wonen',
                'lnumber' => 'L1524'
            ],
            [
                'name' => 'Stichting Wooninc.',
                'lnumber' => 'L1519'
            ],
            [
                'name' => 'Woningstichting SallandWonen',
                'lnumber' => 'L1506'
            ],
            [
                'name' => 'Woningstichting Kamerik',
                'lnumber' => 'L1498'
            ],
            [
                'name' => 'Woningstichting Kessel',
                'lnumber' => 'L1491'
            ],
            [
                'name' => 'Talis',
                'lnumber' => 'L1479'
            ],
            [
                'name' => 'Woonwijze',
                'lnumber' => 'L1471'
            ],
            [
                'name' => 'Stichting Woningbeheer Born-Grevenbicht',
                'lnumber' => 'L1468'
            ],
            [
                'name' => 'Stichting Woonbedrijf SWS.Hhvl',
                'lnumber' => 'L1464'
            ],
            [
                'name' => 'R.K. Woningbouwstichting De Goede Woning',
                'lnumber' => 'L1459'
            ],
            [
                'name' => 'Dunavie',
                'lnumber' => 'L1436'
            ],
            [
                'name' => 'Woningcorporatie Domijn',
                'lnumber' => 'L1426'
            ],
            [
                'name' => 'Stichting Woonbedrijf ieder1',
                'lnumber' => 'L1418'
            ],
            [
                'name' => 'Woningstichting Buitenlust',
                'lnumber' => 'L1415'
            ],
            [
                'name' => 'Woningstichting Hellendoorn',
                'lnumber' => 'L1413'
            ],
            [
                'name' => 'Stichting Woonservice IJsselland',
                'lnumber' => 'L1409'
            ],
            [
                'name' => 'Woningstichting Den Helder',
                'lnumber' => 'L1399'
            ],
            [
                'name' => 'Winingbouwvereniging Maarn',
                'lnumber' => 'L1395'
            ],
            [
                'name' => 'Woningbouwstichting de Gemeenschap',
                'lnumber' => 'L1357'
            ],
            [
                'name' => 'Woningstichting Eendracht',
                'lnumber' => 'L1306'
            ],
            [
                'name' => 'Woningstichting Obbicht & Papenhoven',
                'lnumber' => 'L1247'
            ],
            [
                'name' => 'IJsseldal Wonen',
                'lnumber' => 'L1239'
            ],
            [
                'name' => 'Woonstichting St. Joseph',
                'lnumber' => 'L1236'
            ],
            [
                'name' => 'Woonbeheer Borne',
                'lnumber' => 'L1235'
            ],
            [
                'name' => 'Woningbouwvereniging Bergopwaarts',
                'lnumber' => 'L1226'
            ],
            [
                'name' => 'Stichting VitaalWonen',
                'lnumber' => 'L1217'
            ],
            [
                'name' => 'Stichting 3B Wonen',
                'lnumber' => 'L1215'
            ],
            [
                'name' => 'Woningstichting Urmond',
                'lnumber' => 'L1207'
            ],
            [
                'name' => 'Stichting Woonwaard Noord-Kennemerland',
                'lnumber' => 'L1182'
            ],
            [
                'name' => 'WBV ST WILLIBRORDUS',
                'lnumber' => 'L1164'
            ],
            [
                'name' => 'Baston Wonen',
                'lnumber' => 'L1128'
            ],
            [
                'name' => 'Stichting Rijswijk Wonen',
                'lnumber' => 'L1122'
            ],
            [
                'name' => 'Stichting Nijestee',
                'lnumber' => 'L1109'
            ],
            [
                'name' => 'Wonen Midden-Delfland',
                'lnumber' => 'L1100'
            ],
            [
                'name' => 'Stichting Vidomes',
                'lnumber' => 'L1093'
            ],
            [
                'name' => 'Woningstichting Laarbeek',
                'lnumber' => 'L1082'
            ],
            [
                'name' => 'Stichting Welbions',
                'lnumber' => 'L1064'
            ],
            [
                'name' => 'Stichting Goed Wonen Zederik',
                'lnumber' => 'L1040'
            ],
            [
                'name' => 'Woningstichting Maasvallei Maastricht',
                'lnumber' => 'L1038'
            ],
            [
                'name' => 'Wbv De Goede Woning - Driemond',
                'lnumber' => 'L1034'
            ],
            [
                'name' => 'Sité Woondiensten',
                'lnumber' => 'L1017'
            ],
            [
                'name' => 'Laurentius',
                'lnumber' => 'L1005'
            ],
            [
                'name' => 'Woningbouwvereniging Helpt Elkander ',
                'lnumber' => 'L0992'
            ],
            [
                'name' => 'Maaskant Wonen',
                'lnumber' => 'L0986'
            ],
            [
                'name' => 'de Woningstichting',
                'lnumber' => 'L0979'
            ],
            [
                'name' => 'Omnia Wonen',
                'lnumber' => 'L0968'
            ],
            [
                'name' => 'Casade Woonstichting',
                'lnumber' => 'L0944'
            ],
            [
                'name' => 'Woongoed Middelburg',
                'lnumber' => 'L0943'
            ],
            [
                'name' => 'Stichting Christelijke Woningcorporatie',
                'lnumber' => 'L0939'
            ],
            [
                'name' => 'Eemland Wonen',
                'lnumber' => 'L0936'
            ],
            [
                'name' => "Woonstichting 't Heem",
                'lnumber' => 'L0928'
            ],
            [
                'name' => 'Trifolium Woondiensten Boskoop',
                'lnumber' => 'L0927'
            ],
            [
                'name' => 'Bouwvereniging Woningbelang',
                'lnumber' => 'L0923'
            ],
            [
                'name' => 'Woningstichting St. Joseph Almelo',
                'lnumber' => 'L0921'
            ],
            [
                'name' => 'Stichting Wonion',
                'lnumber' => 'L0898'
            ],
            [
                'name' => 'Stichting Area',
                'lnumber' => 'L0886'
            ],
            [
                'name' => 'Stichting De Woningbouw',
                'lnumber' => 'L0885'
            ],
            [
                'name' => 'Woningstichting Het Grootslag',
                'lnumber' => 'L0883'
            ],
            [
                'name' => 'Stichting De Woonschakel Westfriesland',
                'lnumber' => 'L0876'
            ],
            [
                'name' => 'Stichting Tablis Wonen (Sliedrecht)',
                'lnumber' => 'L0867'
            ],
            [
                'name' => 'Stichting Slagenland Wonen',
                'lnumber' => 'L0861'
            ],
            [
                'name' => 'Stichting Beter Wonen IJsselmuiden',
                'lnumber' => 'L0858'
            ],
            [
                'name' => 'Woonstichting Jutphaas',
                'lnumber' => 'L0837'
            ],
            [
                'name' => 'Stichting ProWonen',
                'lnumber' => 'L0835'
            ],
            [
                'name' => 'Woningbouwvereniging Heerjansdam',
                'lnumber' => 'L0817'
            ],
            [
                'name' => 'Woningstichting Brummen',
                'lnumber' => 'L0782'
            ],
            [
                'name' => 'Stichting GroenWest',
                'lnumber' => 'L0766'
            ],
            [
                'name' => 'Stichting Wonen Delden',
                'lnumber' => 'L0765'
            ],
            [
                'name' => 'Woningbouwvereniging Habeko Wonen',
                'lnumber' => 'L0764'
            ],
            [
                'name' => 'Woningstichting Beter Wonen Vechtdal',
                'lnumber' => 'L0762'
            ],
            [
                'name' => 'Woningstichting Kockengen',
                'lnumber' => 'L0758'
            ],
            [
                'name' => 'Woonstichting Groninger Huis',
                'lnumber' => 'L0740'
            ],
            [
                'name' => 'Patrimonium woonstichting',
                'lnumber' => 'L0734'
            ],
            [
                'name' => 'HW Wonen',
                'lnumber' => 'L0732'
            ],
            [
                'name' => 'Veenendaalse Woningstichting',
                'lnumber' => 'L0705'
            ],
            [
                'name' => 'Rentree',
                'lnumber' => 'L0694'
            ],
            [
                'name' => 'Woonvisie',
                'lnumber' => 'L0689'
            ],
            [
                'name' => 'Stichting Uithuizer Woningbouw',
                'lnumber' => 'L0688'
            ],
            [
                'name' => 'Stichting de Delthe',
                'lnumber' => 'L0686'
            ],
            [
                'name' => 'Woningstichting Ons Doel',
                'lnumber' => 'L0682'
            ],
            [
                'name' => 'Woningstichting Sint Antonius van Padua',
                'lnumber' => 'L0678'
            ],
            [
                'name' => 'Wonen Zuidwest Friesland',
                'lnumber' => 'L0676'
            ],
            [
                'name' => 'WoonInvest',
                'lnumber' => 'L0673'
            ],
            [
                'name' => 'Woningstichting Volksbelang',
                'lnumber' => 'L0672'
            ],
            [
                'name' => 'Woningstichting Domus',
                'lnumber' => 'L0669'
            ],
            [
                'name' => 'Wbv Van Erfgooiers',
                'lnumber' => 'L0667'
            ],
            [
                'name' => 'Woonborg',
                'lnumber' => 'L0666'
            ],
            [
                'name' => 'Woonbron',
                'lnumber' => 'L0665'
            ],
            [
                'name' => 'Woonstichting Vechthorst',
                'lnumber' => 'L0661'
            ],
            [
                'name' => 'Stichting Vivare',
                'lnumber' => 'L0658'
            ],
            [
                'name' => 'Woningstichting Dinteloord',
                'lnumber' => 'L0653'
            ],
            [
                'name' => 'Bouwvereniging Huis & Erf',
                'lnumber' => 'L0643'
            ],
            [
                'name' => 'Stichting Destion',
                'lnumber' => 'L0642'
            ],
            [
                'name' => 'Pré Wonen',
                'lnumber' => 'L0640'
            ],
            [
                'name' => 'Stichting De Sesyter Veste',
                'lnumber' => 'L0637'
            ],
            [
                'name' => 'Wonen Meerssen',
                'lnumber' => 'L0636'
            ],
            [
                'name' => 'Stichting Woningbouw Slochteren',
                'lnumber' => 'L0632'
            ],
            [
                'name' => 'Brederode Wonen',
                'lnumber' => 'L0630'
            ],
            [
                'name' => 'WBV Poortugaal ',
                'lnumber' => 'L0629'
            ],
            [
                'name' => 'Woningstichting Warmunda',
                'lnumber' => 'L0623'
            ],
            [
                'name' => 'Woonstichting SSW',
                'lnumber' => 'L0602'
            ],
            [
                'name' => 'Rondom Wonen',
                'lnumber' => 'L0590'
            ],
            [
                'name' => 'Woningstichting Kennemer Wonen',
                'lnumber' => 'L0583'
            ],
            [
                'name' => 'Omnivera',
                'lnumber' => 'L0582'
            ],
            [
                'name' => 'Woonstichting Hulst',
                'lnumber' => 'L0579'
            ],
            [
                'name' => 'Actium',
                'lnumber' => 'L0574'
            ],
            [
                'name' => 'Sprengenland Wonen',
                'lnumber' => 'L0573'
            ],
            [
                'name' => 'Woonpunt',
                'lnumber' => 'L0571'
            ],
            [
                'name' => 'Stichting Eelder Woningbouw',
                'lnumber' => 'L0568'
            ],
            [
                'name' => 'Stichting WonenCentraal',
                'lnumber' => 'L0565'
            ],
            [
                'name' => 'Stichting Elkien',
                'lnumber' => 'L0553'
            ],
            [
                'name' => 'Stichting R&B Wonen',
                'lnumber' => 'L0543'
            ],
            [
                'name' => 'Stichting QuaWonen',
                'lnumber' => 'L0540'
            ],
            [
                'name' => 'Woningbouwvereniging Laren',
                'lnumber' => 'L0533'
            ],
            [
                'name' => 'Woningstichting Simpelveld',
                'lnumber' => 'L0528'
            ],
            [
                'name' => 'Trudo',
                'lnumber' => 'L0527'
            ],
            [
                'name' => 'Stichting AWV Eigen Haard',
                'lnumber' => 'L0510'
            ],
            [
                'name' => 'FidesWonen',
                'lnumber' => 'L0506'
            ],
            [
                'name' => 'Stichting TBV',
                'lnumber' => 'L0497'
            ],
            [
                'name' => 'Stichting Allee Wonen',
                'lnumber' => 'L0495'
            ],
            [
                'name' => 'Wooncompagnie',
                'lnumber' => 'L0478'
            ],
            [
                'name' => 'Stichting Chr.Woongroep Marenland',
                'lnumber' => 'L0449'
            ],
            [
                'name' => 'Wooncorporatie De Goede Woning',
                'lnumber' => 'L0446'
            ],
            [
                'name' => 'Stichting Rhiant',
                'lnumber' => 'L0439'
            ],
            [
                'name' => 'Woningstichting Haag Wonen',
                'lnumber' => 'L0425'
            ],
            [
                'name' => 'Stichting Clavis',
                'lnumber' => 'L0418'
            ],
            [
                'name' => 'Stichting Arcade mensen en wonen',
                'lnumber' => 'L0410'
            ],
            [
                'name' => 'Havensteder',
                'lnumber' => 'L0392'
            ],
            [
                'name' => 'Woningstichting Naarden',
                'lnumber' => 'L0386'
            ],
            [
                'name' => 'Stichting De Huismeesters',
                'lnumber' => 'L0385'
            ],
            [
                'name' => 'Dudok Wonen',
                'lnumber' => 'L0383'
            ],
            [
                'name' => 'Christelijke Woningstichting Patrimonium',
                'lnumber' => 'L0380'
            ],
            [
                'name' => 'WBV Arnemuiden',
                'lnumber' => 'L0379'
            ],
            [
                'name' => 'Wst Samenwerking Vlaardingen',
                'lnumber' => 'L0371'
            ],
            [
                'name' => 'Stichting UWOON',
                'lnumber' => 'L0369'
            ],
            [
                'name' => 'Woningstichting Wierden en Borgen',
                'lnumber' => 'L0366'
            ],
            [
                'name' => 'Stichting Woonconcept',
                'lnumber' => 'L0363'
            ],
            [
                'name' => 'AWS Beter Wonen',
                'lnumber' => 'L0358'
            ],
            [
                'name' => 'Wonen Wateringen',
                'lnumber' => 'L0354'
            ],
            [
                'name' => 'Viverion',
                'lnumber' => 'L0347'
            ],
            [
                'name' => 'Stichting KleurrijkWonen',
                'lnumber' => 'L0343'
            ],
            [
                'name' => 'Woonstichting Vooruitgang',
                'lnumber' => 'L0333'
            ],
            [
                'name' => 'Woonstichting Vryleve',
                'lnumber' => 'L0331'
            ],
            [
                'name' => 'Provides',
                'lnumber' => 'L0317'
            ],
            [
                'name' => 'SVTwonen Tiel',
                'lnumber' => 'L0315'
            ],
            [
                'name' => 'Woonstichting Triada',
                'lnumber' => 'L0309'
            ],
            [
                'name' => 'Woningstichting Alkemade',
                'lnumber' => 'L0308'
            ],
            [
                'name' => 'Woningbouwvereniging langedijk',
                'lnumber' => 'L0305'
            ],
            [
                'name' => 'de Sleutels',
                'lnumber' => 'L0295'
            ],
            [
                'name' => 'Stichting Zaandamse Volkshuisvesting',
                'lnumber' => 'L0278'
            ],
            [
                'name' => 'Woningstichting Woonwenz',
                'lnumber' => 'L0274'
            ],
            [
                'name' => 'Wassenaarsche Bouwstichting',
                'lnumber' => 'L0272'
            ],
            [
                'name' => 'Woonservice Meander',
                'lnumber' => 'L0271'
            ],
            [
                'name' => 'Stichting ZO Wonen',
                'lnumber' => 'L0269'
            ],
            [
                'name' => 'Stichting Trivire',
                'lnumber' => 'L0267'
            ],
            [
                'name' => 'Woningstichting Heteren',
                'lnumber' => 'L0254'
            ],
            [
                'name' => 'Patrimonium Barendrecht',
                'lnumber' => 'L0248'
            ],
            [
                'name' => 'Stichting Antares Woonservice',
                'lnumber' => 'L0241'
            ],
            [
                'name' => 'Woningstichting Voerendaal',
                'lnumber' => 'L0238'
            ],
            [
                'name' => 'Standvast Wonen',
                'lnumber' => 'L0237'
            ],
            [
                'name' => 'Stichting Mozaïek Wonen',
                'lnumber' => 'L0232'
            ],
            [
                'name' => 'Stichting Elan Wonen',
                'lnumber' => 'L0231'
            ],
            [
                'name' => 'Woningstichting HEEMwonen',
                'lnumber' => 'L0228'
            ],
            [
                'name' => 'Stichting Weller Wonen',
                'lnumber' => 'L0225'
            ],
            [
                'name' => 'Waardwonen',
                'lnumber' => 'L0221'
            ],
            [
                'name' => 'Stichting WormerWonen',
                'lnumber' => 'L0202'
            ],
            [
                'name' => 'Mijande Wonen',
                'lnumber' => 'L0178'
            ],
            [
                'name' => 'Stichting BrabantWonen',
                'lnumber' => 'L0176'
            ],
            [
                'name' => 'Ons Huis',
                'lnumber' => 'L0173'
            ],
            [
                'name' => 'Woningstichting Weststellingwerf',
                'lnumber' => 'L0165'
            ],
            [
                'name' => 'Woningstichting Dinxperlo (WSD)',
                'lnumber' => 'L0160'
            ],
            [
                'name' => 'Woonstichting Stek',
                'lnumber' => 'L0157'
            ],
            [
                'name' => 'Woonstichting ’thuis',
                'lnumber' => 'L0151'
            ],
            [
                'name' => 'R.K. Woningbouwvereniging Zeist',
                'lnumber' => 'L0147'
            ],
            [
                'name' => 'Stichting Volksbelang Vianen',
                'lnumber' => 'L0144'
            ],
            [
                'name' => 'Stichting Stadgenoot',
                'lnumber' => 'L0124'
            ],
            [
                'name' => 'stichting Portaal',
                'lnumber' => 'L0117'
            ],
            [
                'name' => 'Woningstichting Eigen Haard',
                'lnumber' => 'L0108'
            ],
            [
                'name' => 'Woningstichting SWZ',
                'lnumber' => 'L0093'
            ],
            [
                'name' => "l'escaut woonservice",
                'lnumber' => 'L0089'
            ],
            [
                'name' => 'Woningstichtingf Vaals',
                'lnumber' => 'L0082'
            ],
            [
                'name' => 'Stichting Wonen Zuid',
                'lnumber' => 'L0081'
            ],
            [
                'name' => 'Stichting Woonstad Rotterdam',
                'lnumber' => 'L0079'
            ],
            [
                'name' => 'Stichting Wold & Waard',
                'lnumber' => 'L0077'
            ],
            [
                'name' => 'Woningstichting Bergh',
                'lnumber' => 'L0068'
            ],
            [
                'name' => 'Stichting Volkshuisvesting Arnhem',
                'lnumber' => 'L0065'
            ],
            [
                'name' => 'Van Alckmaer voor Wonen',
                'lnumber' => 'L0063'
            ],
            [
                'name' => 'Stichting Parteon',
                'lnumber' => 'L0059'
            ],
            [
                'name' => 'Domesta',
                'lnumber' => 'L0045'
            ],
            [
                'name' => "Stichting Bo-Ex '91",
                'lnumber' => 'L0041'
            ],
            [
                'name' => 'Stichting Lyaemer Wonen',
                'lnumber' => 'L0036'
            ],
            [
                'name' => 'Stichting v/h De Bouwvereniging',
                'lnumber' => 'L0033'
            ],
            [
                'name' => 'deltaWonen',
                'lnumber' => 'L0029'
            ],
            [
                'name' => 'Intermaris',
                'lnumber' => 'L0019'
            ],
            [
                'name' => 'Woningstichting Rochdale',
                'lnumber' => 'L0017'
            ],
            [
                'name' => 'Stichting Zayaz',
                'lnumber' => 'L0013'
            ],
            [
                'name' => 'Wstg Openbaar Belang',
                'lnumber' => 'L0008'
            ],
            [
                'name' => 'Woningstichting Servatius',
                'lnumber' => 'L0005'
            ],
            [
                'name' => 'Wonen Noordwest Friesland',
                'lnumber' => 'L0003'
            ],
            [
                'name' => 'Stichting Eigen Bouw',
                'lnumber' => 'L0001',
            ]
        ];

        foreach ($owners as $owner) {
            $ownerObject = new Owner();

            if (isset($owner['name']) && ($owner['name'] !== '' && $owner['name'] !== '0')) {
                $ownerObject->setName($owner['name']);
            }

            if (isset($owner['kvk']) && ($owner['kvk'] !== 0 && ($owner['kvk'] !== '' && $owner['kvk'] !== '0'))) {
                $ownerObject->setKvk($owner['kvk']);
            }

            if (isset($owner['btw']) && ($owner['btw'] !== 0 && ($owner['btw'] !== '' && $owner['btw'] !== '0'))) {
                $ownerObject->setBtw($owner['btw']);
            }

            if (empty($owner['lnumber'])) {
                throw new RuntimeException("lnumber may not be empty, it's used as a variable reference in the data fixtures.");
            }

            $ownerObject->setLnumber($owner['lnumber']);

            if (isset($owner['website']) && ($owner['website'] !== 0 && ($owner['website'] !== '' && $owner['website'] !== '0'))) {
                $ownerObject->setWebsite($owner['website']);
            }

            $validator = Validation::createValidator();
            $errors = $validator->validate($ownerObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }

                throw new RuntimeException(implode(', ', $messages));
            }

            $objectManager->persist($ownerObject);
            $this->addReference('owner_' . $owner['lnumber'], $ownerObject);
        }

        $objectManager->flush();
    }
}