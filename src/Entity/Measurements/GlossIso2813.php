<?php

namespace App\Entity\Measurements;

use App\Entity\Portfolio\Address;
use App\Entity\SuperClasses\IdTimeScore;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * This object holds a gloss measurement according to ISO 2813
 * https://www.nen.nl/nen-en-iso-2813-2014-en-200455
 *
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'MeasurementsGlossIso2813')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class GlossIso2813 extends IdTimeScore
{
    /**
     *
     * @OA\Property(ref="#/components/schemas/Address")
     */
    #[ORM\JoinColumn(name: 'address_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Portfolio\Address::class, fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A gloss measurement must have an address')]
    protected Address $address;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'integer', length: 3, nullable: false)]
    #[Assert\NotBlank(message: 'The gloss units may not be empty')]
    #[Assert\Type(type: 'integer', message: 'The gloss units is not a valid {{ type }}')]
    #[Assert\Range(min: 1, max: 100)]
    protected int $glossUnits;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'enumglossangle', nullable: true)]
    #[Assert\Choice(choices: App\Dbal\EnumGlossAngle::ALLOWED_VALUES, message: 'Choose a valid gloss angle.')]
    protected string $glossAngle;

    public function __construct(int $glossUnits)
    {
        $this->glossUnits = $glossUnits;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getGlossUnits(): int
    {
        return $this->glossUnits;
    }

    public function setGlossUnits(int $glossUnits): void
    {
        $this->glossUnits = $glossUnits;
    }

    public function getGlossAngle(): string
    {
        return $this->glossAngle;
    }

    public function setGlossAngle(string $glossAngle): void
    {
        $this->glossAngle = $glossAngle;
    }
}