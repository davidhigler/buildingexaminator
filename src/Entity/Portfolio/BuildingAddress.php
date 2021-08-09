<?php

namespace App\Entity\Portfolio;

use App\Entity\Finance\TaxResponsibility;
use App\Entity\Planning\FuturePlans;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Entity\SuperClasses\IdTime;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="BuildingAddresses")
 */
class BuildingAddress extends IdTime
{
    /**
     * @ORM\ManyToOne(targetEntity="HousingStock", inversedBy="buildingAddresses")
     * @ORM\JoinColumn(name="housingstock_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\ManyToOne(targetEntity="ResidentialArea", inversedBy="buildingAddresses", fetch="EAGER")
     * @ORM\JoinColumn(name="residentialarea_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected ResidentialArea $residentialArea;

    /**
     * @ORM\ManyToOne(targetEntity="BuildingType", inversedBy="buildingAddresses", fetch="EAGER")
     * @ORM\JoinColumn(name="buildingtype_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected BuildingType $buildingType;

    /**
     * @ORM\ManyToOne(targetEntity="LivingType", inversedBy="buildingAddresses", fetch="EAGER")
     * @ORM\JoinColumn(name="livingtype_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected LivingType $livingType;

    /**
     * @ORM\ManyToMany(targetEntity="Block", inversedBy="buildingAddresses", mappedBy="buildingAddress")
     * @Assert\Valid()
     */
    protected Collection $blocks;

    protected FuturePlans $futurePlans;

    protected TaxResponsibility $taxResponsibility;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      min=3,
     *      max=128,
     *      minMessage="%property% must be at least %limit% characters long",
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     */
    protected string $rentalUnitNumber;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      min=3,
     *      max=128,
     *      minMessage="%property% must be at least %limit% characters long",
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     */
    protected string $streetName;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 9999
     * )
     */
    protected int $houseNumber;

    /**
     * @ORM\Column(type="string", length=32)
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      max=32,
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     */
    protected string $addition;

    /**
     * @ORM\Column(type="string", length=6)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="string",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 9999
     * )
     */
    protected string $zipcode;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      min=3,
     *      max=128,
     *      minMessage="%property% must be at least %limit% characters long",
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     */
    protected string $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     */
    protected int $bagId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 1800,
     *      max = 2100
     * )
     */
    protected int $constructionYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\Regex(
     *      pattern="/(|[\d]{4})/",
     *      message="%property% is not a valid %type%"
     * )
     */
    protected int $renovationYear;

    #[Pure]
    public function __construct()
    {
        $this->blocks = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getResidentialArea(): ResidentialArea
    {
        return $this->residentialArea;
    }

    public function getBuildingType(): BuildingType
    {
        return $this->buildingType;
    }

    public function getLivingType(): LivingType
    {
        return $this->livingType;
    }

    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    public function getRentalUnitNumber(): string
    {
        return $this->rentalUnitNumber;
    }

    public function getStreetName(): string
    {
        return $this->streetName;
    }

    public function getHouseNumber(): int
    {
        return $this->houseNumber;
    }

    public function getAddition(): string
    {
        return $this->addition;
    }

    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getBagId(): string
    {
        return $this->bagId;
    }

    public function getConstructionYear(): int
    {
        return $this->constructionYear;
    }

    public function getRenovationYear(): int
    {
        return $this->renovationYear;
    }

    public function setHousingStock(HousingStock $housingStock): void
    {
        $this->housingStock = $housingStock;
    }

    public function setResidentialArea(ResidentialArea $residentialArea): void
    {
        $this->residentialArea = $residentialArea;
    }

    public function setBuildingType(BuildingType $buildingType): void
    {
        $this->buildingType = $buildingType;
    }

    public function setLivingType(LivingType $livingType): void
    {
        $this->livingType = $livingType;
    }

    public function addBlock(Block $block): void
    {
        $this->blocks->add($block);
    }

    public function removeBlock(Block $block): void
    {
        $this->blocks->removeElement($block);
    }

    public function setRentalUnitNumber(string $rentalUnitNumber): void
    {
        $this->rentalUnitNumber = $rentalUnitNumber;
    }

    public function setStreetName(string $streetName): void
    {
        $this->streetName = $streetName;
    }

    public function setHouseNumber(int $houseNumber): void
    {
        $this->houseNumber = $houseNumber;
    }

    public function setAddition(string $addition): void
    {
        $this->addition = $addition;
    }

    public function setZipcode(string $zipcode): void
    {
        $this->zipcode = $zipcode;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function setBagId(int $bagId): void
    {
        $this->bagId = $bagId;
    }

    public function setConstructionYear(int $constructionYear): void
    {
        $this->constructionYear = $constructionYear;
    }

    public function setRenovationYear(int $renovationYear): void
    {
        $this->renovationYear = $renovationYear;
    }

}