<?php

namespace App\Entity\Measurements;

use App\Entity\Portfolio\BuildingAddress;
use App\Entity\SuperClasses\IdTime;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * This object holds a gloss measurement according to ISO 2813
 * https://www.nen.nl/nen-en-iso-2813-2014-en-200455
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="MeasurementsGloss")
 *
 * @OA\Schema()
 */
class GlossIso2813 extends IdTime
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Portfolio\BuildingAddress", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="buildingaddress_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A gloss measurement must have a buildingaddress"
     * )
     *
     * @OA\Property(ref="#/components/schemas/BuildingAddress")
     */
    protected BuildingAddress $buildingAddress;

    /**
     * @ORM\Column(type="integer", length=3, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The gloss units may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="The gloss units is not a valid {{ type }}"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 100
     * )
     *
     * @OA\Property()
     */
    protected int $glossUnits;

    /**
     * @ORM\Column(type="enumglossangle", nullable=true)
     *
     * @Assert\Choice(choices=App\Dbal\EnumGlossAngle::ALLOWED_VALUES, message="Choose a valid gloss angle.")
     *
     * @OA\Property()
     */
    protected string $glossAngle;

    public function __construct(int $glossUnits)
    {
        $this->glossUnits = $glossUnits;
    }

    public function getBuildingAddress(): BuildingAddress
    {
        return $this->buildingAddress;
    }

    public function setBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddress = $buildingAddress;
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