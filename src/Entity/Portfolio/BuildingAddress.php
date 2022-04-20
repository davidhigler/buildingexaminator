<?php

namespace App\Entity\Portfolio;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTime;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PortfolioBuildingAddresses")
 *
 * @OA\Schema()
 */
class BuildingAddress extends IdTime
{
    /**
     * @ORM\ManyToOne(targetEntity="HousingStock", inversedBy="buildingAddresses", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="housingstock_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A buildingaddress must have a housingstock"
     * )
     *
     * @OA\Property(ref="#/components/schemas/HousingStock")
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\ManyToOne(targetEntity="ResidentialArea", inversedBy="buildingAddresses", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="residentialarea_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A buildingaddress must have a residentialarea"
     * )
     *
     * @OA\Property(ref="#/components/schemas/ResidentialArea")
     */
    protected ResidentialArea $residentialArea;

    /**
     * @ORM\ManyToOne(targetEntity="Block", inversedBy="buildingAddresses", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="block_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A buildingaddress must have a block"
     * )
     *
     * @OA\Property(ref="#/components/schemas/Block")
     */
    protected Block $block;

    /**
     * @ORM\ManyToOne(targetEntity="BuildingType", inversedBy="buildingAddresses", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="buildingtype_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A buildingaddress must have a buildingtype"
     * )
     *
     * @OA\Property(ref="#/components/schemas/BuildingType")
     */
    protected BuildingType $buildingType;

    /**
     * @ORM\ManyToOne(targetEntity="LivingType", inversedBy="buildingAddresses", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="livingtype_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A buildingaddress must have a livingtype"
     * )
     *
     * @OA\Property(ref="#/components/schemas/LivingType")
     */
    protected LivingType $livingType;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The rental unit number is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      min=3,
     *      max=128,
     *      minMessage="The rental unit number must be at least {{ limit }} characters long",
     *      maxMessage="The rental unit number can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $rentalUnitNumber;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The street name may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="The street name is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      min=3,
     *      max=128,
     *      minMessage="The street name must be at least {{ limit }} characters long",
     *      maxMessage="The street name can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $streetName;

    /**
     * @ORM\Column(type="integer", length=5, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The house number may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="The house number is not a valid {{ type }}"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 99999
     * )
     *
     * @OA\Property()
     */
    protected int $houseNumber;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The addition is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=32,
     *      maxMessage="The addition can contain a maximum of %limit% characters"
     * )
     *
     * @OA\Property()
     */
    protected string $addition;

    /**
     * @ORM\Column(type="string", length=6, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The zipcode may not be empty"
     * )
     * @Assert\Type(
     *      type="string",
     *      message="The zipcode is not a valid {{ type }}"
     * )
     *
     * @OA\Property()
     */
    protected string $zipcode;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The city may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="The city is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      min=3,
     *      max=128,
     *      minMessage="The city must be at least {{ limit }} characters long",
     *      maxMessage="The city can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $city;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Assert\Type(
     *      type="integer",
     *      message="The BAG id is not a valid {{ type }}"
     * )
     *
     * @OA\Property()
     */
    protected int $bagId;

    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The construction year may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="The construction year is not a valid {{ type }}"
     * )
     * @Assert\Range(
     *      min = 1800,
     *      max = 2100
     * )
     *
     * @OA\Property()
     */
    protected int $constructionYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     *
     * @Assert\Type(
     *      type="integer",
     *      message="The construction year is not a valid {{ type }}"
     * )
     * @Assert\Range(
     *      min = 1800,
     *      max = 2100
     * )
     *
     * @OA\Property()
     */
    protected int $renovationYear;

    /**
     * @ORM\Column(type="enumorientation", nullable=true)
     *
     * @Assert\Choice(choices=App\Dbal\EnumOrientationType::ALLOWED_VALUES, message="Choose a valid orientation.")
     *
     * @OA\Property()
     */
    protected string $orientation;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @Assert\Type(
     *     type="bool",
     *     message="Daeb is not a valid {{ type }}"
     * )
     *
     * @OA\Property()
     */
    protected bool $daeb;

    /**
     * @ORM\ManyToOne(targetEntity="Vtw", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="vtw_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A buildingaddress must have a vtw"
     * )
     *
     * @OA\Property(ref="#/components/schemas/Vtw")
     */
    protected Vtw $vtw;

    #[Pure]
    public function __construct()
    {
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getResidentialArea(): ResidentialArea
    {
        return $this->residentialArea;
    }

    public function getBlock(): Block
    {
        return $this->block;
    }

    public function getBuildingType(): BuildingType
    {
        return $this->buildingType;
    }

    public function getLivingType(): LivingType
    {
        return $this->livingType;
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

    public function getOrientation(): string
    {
        return $this->orientation;
    }

    public function getDaeb(): bool
    {
        return $this->daeb;
    }

    public function getVtw(): Vtw
    {
        return $this->vtw;
    }

    public function setHousingStock(HousingStock $housingStock): void
    {
        $this->housingStock = $housingStock;
    }

    public function setResidentialArea(ResidentialArea $residentialArea): void
    {
        $this->residentialArea = $residentialArea;
    }

    public function setBlock(Block $block): void
    {
        $this->block = $block;
    }

    public function setBuildingType(BuildingType $buildingType): void
    {
        $this->buildingType = $buildingType;
    }

    public function setLivingType(LivingType $livingType): void
    {
        $this->livingType = $livingType;
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

    public function setOrientation(string $orientation): void
    {
        $this->orientation = $orientation;
    }

    public function setDaeb(bool $daeb): void
    {
        $this->daeb = $daeb;
    }

    public function setVtw(Vtw $vtw): void
    {
        $this->vtw = $vtw;
    }

}
