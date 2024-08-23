<?php

namespace App\Entity\Portfolio;

use App\Entity\Strategies\Project;
use App\Entity\SuperClasses\IdBagIdsTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'PortfolioAddresses')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Address extends IdBagIdsTime
{
    /**
     *
     * @OA\Property(ref="#/components/schemas/HousingStock")
     */
    #[ORM\JoinColumn(name: 'housingstock_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \HousingStock::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a housingstock')]
    protected HousingStock $housingStock;

    /**
     *
     * @OA\Property(ref="#/components/schemas/Municipality")
     */
    #[ORM\JoinColumn(name: 'municipality_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Municipality::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a municipality')]
    protected Municipality $municipality;

    /**
     *
     * @OA\Property(ref="#/components/schemas/ResidentialArea")
     */
    #[ORM\JoinColumn(name: 'residentialarea_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \ResidentialArea::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a residentialarea')]
    protected ResidentialArea $residentialArea;

    /**
     *
     * @OA\Property(ref="#/components/schemas/Neighbourhood")
     */
    #[ORM\JoinColumn(name: 'neighbourhood_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Neighbourhood::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a neighbourhood')]
    protected Neighbourhood $neighbourhood;

    /**
     * @OA\Property(ref="#/components/schemas/projects")
     */
    #[ORM\ManyToMany(targetEntity: \App\Entity\Strategies\Project::class, mappedBy: 'addresses', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    protected Collection $projects;

    /**
     *
     * @OA\Property(ref="#/components/schemas/Block")
     */
    #[ORM\JoinColumn(name: 'block_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Block::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a block')]
    protected Block $block;

    /**
     *
     * @OA\Property(ref="#/components/schemas/BuildingType")
     */
    #[ORM\JoinColumn(name: 'buildingtype_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \BuildingType::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a buildingtype')]
    protected BuildingType $buildingType;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'string', length: 128, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The rental unit number is not a valid {{ type }}')]
    #[Assert\Length(min: 3, max: 128, minMessage: 'The rental unit number must be at least {{ limit }} characters long', maxMessage: 'The rental unit number can contain a maximum of {{ limit }} characters')]
    protected string $rentalUnitNumber;

    /**
     *
     * @OA\Property()
     */
    #[ORM\JoinColumn(name: 'residence_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Residence::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a residence')]
    protected Residence $residence;

    /**
     *
     * @OA\Property()
     */
    #[ORM\JoinColumn(name: 'building_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Building::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a building')]
    protected Building $building;

    /**
     *
     * @OA\Property()
     */
    #[ORM\JoinColumn(name: 'publicspace_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \PublicSpace::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a public space')]
    protected PublicSpace $publicSpace;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'integer', length: 5, nullable: false)]
    #[Assert\NotBlank(message: 'The house number may not be empty')]
    #[Assert\Type(type: 'integer', message: 'The house number is not a valid {{ type }}')]
    #[Assert\Range(min: 1, max: 99999)]
    protected int $houseNumber;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'string', length: 32, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The addition is not a valid {{ type }}')]
    #[Assert\Length(max: 32, maxMessage: 'The addition can contain a maximum of %limit% characters')]
    protected string $addition;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'string', length: 6, nullable: false)]
    #[Assert\NotBlank(message: 'The zipcode may not be empty')]
    #[Assert\Type(type: 'string', message: 'The zipcode is not a valid {{ type }}')]
    protected string $zipcode;

    /**
     *
     * @OA\Property()
     */
    #[ORM\JoinColumn(name: 'city_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \City::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a city')]
    protected City $city;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'enumorientation', nullable: true)]
    #[Assert\Choice(choices: App\Dbal\EnumOrientationType::ALLOWED_VALUES, message: 'Choose a valid orientation.')]
    protected string $orientation;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'boolean', nullable: false)]
    #[Assert\Type(type: 'bool', message: 'Daeb is not a valid {{ type }}')]
    protected bool $daeb;

    /**
     *
     * @OA\Property(ref="#/components/schemas/Vtw")
     */
    #[ORM\JoinColumn(name: 'vtw_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \Vtw::class, inversedBy: 'addresses', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An address must have a vtw')]
    protected Vtw $vtw;

    #[Pure]
    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getMunicipality(): Municipality
    {
        return $this->municipality;
    }

    public function getResidentialArea(): ResidentialArea
    {
        return $this->residentialArea;
    }

    public function getNeighbourhood(): Neighbourhood
    {
        return $this->neighbourhood;
    }

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function getBlock(): Block
    {
        return $this->block;
    }

    public function getBuildingType(): BuildingType
    {
        return $this->buildingType;
    }

    public function getRentalUnitNumber(): string
    {
        return $this->rentalUnitNumber;
    }

    public function getResidence(): Residence
    {
        return $this->residence;
    }

    public function getBuilding(): Building
    {
        return $this->building;
    }

    public function getPublicSpace(): PublicSpace
    {
        return $this->publicSpace;
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

    public function getCity(): City
    {
        return $this->city;
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

    public function setMunicipality(Municipality $municipality): void
    {
        $this->municipality = $municipality;
    }

    public function setResidentialArea(ResidentialArea $residentialArea): void
    {
        $this->residentialArea = $residentialArea;
    }

    public function setNeighbourhood(Neighbourhood $neighbourhood): void
    {
        $this->neighbourhood = $neighbourhood;
    }

    public function addProject(Project $project): void
    {
        $this->projects->add($project);
    }

    public function removeProject(Project $project): void
    {
        $this->projects->removeElement($project);
    }

    public function setBlock(Block $block): void
    {
        $this->block = $block;
    }

    public function setBuildingType(BuildingType $buildingType): void
    {
        $this->buildingType = $buildingType;
    }

    public function setRentalUnitNumber(string $rentalUnitNumber): void
    {
        $this->rentalUnitNumber = $rentalUnitNumber;
    }

    public function setResidence(Residence $residence): void
    {
        $this->residence = $residence;
    }

    public function setBuilding(Building $building): void
    {
        $this->building = $building;
    }

    public function setPublicSpace(PublicSpace $publicSpace): void
    {
        $this->publicSpace = $publicSpace;
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

    public function setCity(City $city): void
    {
        $this->city = $city;
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
