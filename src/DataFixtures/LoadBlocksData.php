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

class LoadBlocksData extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $blocks = [
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