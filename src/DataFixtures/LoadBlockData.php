<?php

namespace App\DataFixtures;

use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\HousingStock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use RuntimeException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validation;

class LoadBlockData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $blocks = [
            /**
             * Blocks for housing stock DobroTest01
             */
            [
                'code' => 'NAP A1',
                'name' => 'Napoleoncomplex',
                'financialNumber' => '1111',
                'description' => 'Frans',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'Æ æ Œ œ ',
                'name' => 'Ą ą Ę ę ',
                'financialNumber' => '2222',
                'description' => 'Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ ',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'C001',
                'name' => 'Complex 20.66-078',
                'financialNumber' => '3333',
                'description' => 'mobilisatiecomplex',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'mobilisatiecomplex',
                'name' => 'Complex 20028123',
                'financialNumber' => '4444',
                'description' => 'Laptop 3',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => '4567894645',
                'name' => 'áé200',
                'financialNumber' => '5555',
                'description' => 'Wijk 12',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'C-20',
                'name' => 'Z-2076A',
                'financialNumber' => '6666',
                'description' => 'Zuiderbroek',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'ɨʉɯɪʏʊøɘɵɤəɛœɜɞʌɔæɐɶɑɒɚ',
                'name' => 'ɨ ʉ ɯ ɪ ʏ ʊ ø ɘ ɵ ɤ ə ɛ œ ɜ ɞ ʌ ɔ æ ɐ ɶ ɑ ɒ ɚ',
                'financialNumber' => '7777',
                'description' => 'ɨ ʉ ɯ ɪ ʏ ʊ ø ɘ ɵ ɤ ə ɛ œ ɜ ɞ ʌ ɔ æ ɐ ɶ ɑ ɒ ɚ',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'ʈɖɟɢʔɱɳɲŋɴʙʀɽɸβθðʃʒʂʐ',
                'name' => 'ʈ ɖ ɟ ɢ ʔ ɱ ɳ ɲ ŋ ɴ ʙ ʀ ɽ ɸ β θɭ ʎ ʟ ʍ ɥ ʜ ʢ ʡ ɕ ʑ ɺ ɧ ɡ ʲ ʷ',
                'financialNumber' => '8888',
                'description' => 'ʈ ɖ ɟ ɢ ʔ ɱ ɳ ɲ ŋ ɴ ʙ ʀ ɽ ɸ β θ ð ʃ ʒ ʂ ʐ ʝ ɣ χ ʁ ħ ʕ ɦ ɬ ɮ ʋ ɹ ɻ ɰ ɭ ʎ ʟ ʍ ɥ ʜ ʢ ʡ ɕ ʑ ɺ ɧ ɡ ʲ ʷ',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'ID 899',
                'name' => 'Complex 899',
                'financialNumber' => '9999',
                'description' => 'Á á Ć ć É é Í í Ó ó Ń ń Ś ś Ú ú Ý ý Ź ź Ǿ ǿ À à È è Ì ì Ò ò Ù ù Â â Ê ê Ĝ ĝ Ĥ ĥ Î î Ĵ ĵ Ô ô Û û Ä ä Ë ë Ï ï Ö ö Ü ü ÿ Ã ã Ñ ñ Õ õ Ũ ũ Å å Ç ç Ş ş Č č Ď ď Ğ ğ Ř ř Š š Ť ť Ŭ ŭ Ł ł  Ő ő Ű ű Ø ø Ā ā Ē ē Ī ī Ō ō Ū ū ß Æ æ Œ œ Ð ð Þ þ Ą ą Ę ę Ż ż  ı ˁ ḥ ẖ ḫ ḳ ś ṯ ḏ Ꜣ ỉ ',
                'housingstock' => 'DobroTest01'
            ],
            [
                'code' => 'ID 123',
                'name' => 'ALG1010',
                'financialNumber' => '5154',
                'description' => 'ALG1010',
                'housingstock' => 'DobroTest01'
            ],
            /**
             * Blocks for housing stock DobroTest02
             */
            [
                'code' => 'ALG1003',
                'name' => 'Algemeen 1003',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1006',
                'name' => 'Algemeen 1006',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1018',
                'name' => 'Algemeen 1018',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1019',
                'name' => 'Algemeen 1019',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1017',
                'name' => 'Algemeen 1017',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1014',
                'name' => 'Algemeen 1014',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1010',
                'name' => 'Algemeen 1010',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1011',
                'name' => 'Algemeen 1011',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1013',
                'name' => 'Algemeen 1013',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1020',
                'name' => 'Algemeen 1020',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1022',
                'name' => 'Algemeen 1022',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1402',
                'name' => 'Algemeen 1402',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1028',
                'name' => 'Algemeen 1028',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1024',
                'name' => 'Algemeen 1024',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1025',
                'name' => 'Algemeen 1025',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1027',
                'name' => 'Algemeen 1027',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1023',
                'name' => 'Algemeen 1023',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1034',
                'name' => 'Algemeen 1034',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1036',
                'name' => 'Algemeen 1036',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1037',
                'name' => 'Algemeen 1037',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1039',
                'name' => 'Algemeen 1039',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1030',
                'name' => 'Algemeen 1030',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1031',
                'name' => 'Algemeen 1031',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1032',
                'name' => 'Algemeen 1032',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1035',
                'name' => 'Algemeen 1035',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1033',
                'name' => 'Algemeen 1033',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1042',
                'name' => 'Algemeen 1042',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1041',
                'name' => 'Algemeen 1041',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1046',
                'name' => 'Algemeen 1046',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1040',
                'name' => 'Algemeen 1040',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1045',
                'name' => 'Algemeen 1045',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1048',
                'name' => 'Algemeen 1048',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1049',
                'name' => 'Algemeen 1049',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1058',
                'name' => 'Algemeen 1058',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1528',
                'name' => 'Algemeen 1528',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1051',
                'name' => 'Algemeen 1051',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1580',
                'name' => 'Algemeen 1580',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1529',
                'name' => 'Algemeen 1529',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1062',
                'name' => 'Algemeen 1062',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1061',
                'name' => 'Algemeen 1061',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1064',
                'name' => 'Algemeen 1064',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1069',
                'name' => 'Algemeen 1069',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1066',
                'name' => 'Algemeen 1066',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1068',
                'name' => 'Algemeen 1068',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1079',
                'name' => 'Algemeen 1079',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1070',
                'name' => 'Algemeen 1070',
                'housingstock' => 'DobroTest02'
            ],
            [
                'code' => 'ALG1073',
                'name' => 'Algemeen 1073',
                'housingstock' => 'DobroTest02'
            ]
        ];

        foreach ($blocks as $block) {
            $blockObject = new Block();

            if (empty($block['code'])) {
                throw new RuntimeException('code may not be empty, it\'s used as a variable reference in the data fixtures.');
            } else {
                $blockObject->setCode($block['code']);
            }

            if (!empty($block['name'])) {
                $blockObject->setName($block['name']);
            }

            if (!empty($block['financialNumber'])) {
                $blockObject->setFinancialNumber($block['financialNumber']);
            }

            if (!empty($block['description'])) {
                $blockObject->setDescription($block['description']);
            }

            if (!empty($block['housingstock'])) {
                /** @var HousingStock $housingStock */
                $housingStock = $this->getReference($block['housingstock']);
                $blockObject->setHousingStock($housingStock);
            }

            $blockObject->setCreationTime();
            $blockObject->setLastChangeTime();

            $validator = Validation::createValidator();
            $errors = $validator->validate($blockObject);
            if (count($errors) > 0) {
                $messages = [];
                foreach ($errors as $error) {
                    /** @var ConstraintViolation $error */
                    $messages[] = $error->getMessage();
                }
                throw new RuntimeException(implode(', ', $messages));
            }

            $manager->persist($blockObject);
            $this->addReference($block['code'], $blockObject);
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