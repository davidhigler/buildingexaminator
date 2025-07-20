<?php

declare(strict_types=1);

namespace App\Entity\Portfolio;

use App\Dbal\EnumOrientationType;
use App\Entity\Strategies\Project;
use App\Entity\SuperClasses\IdBagIdsTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'PortfolioAddresses')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class Address extends IdBagIdsTime
{
    #[ORM\JoinColumn(name: 'housingstock_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: HousingStock::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a housingstock')]
    #[OA\Property(ref: '#/components/schemas/HousingStock')]
    protected HousingStock $housingStock;

    #[ORM\JoinColumn(name: 'municipality_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Municipality::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a municipality')]
    #[OA\Property(ref: '#/components/schemas/Municipality')]
    protected Municipality $municipality;

    #[ORM\JoinColumn(name: 'residentialarea_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: ResidentialArea::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a residentialarea')]
    #[OA\Property(ref: '#/components/schemas/ResidentialArea')]
    protected ResidentialArea $residentialArea;

    #[ORM\JoinColumn(name: 'neighbourhood_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Neighbourhood::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a neighbourhood')]
    #[OA\Property(ref: '#/components/schemas/Neighbourhood')]
    protected Neighbourhood $neighbourhood;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'addresses', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/projects')]
    protected Collection $projects;

    #[ORM\JoinColumn(name: 'block_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Block::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a block')]
    #[OA\Property(ref: '#/components/schemas/Block')]
    protected Block $block;

    #[ORM\JoinColumn(name: 'buildingtype_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: BuildingType::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a buildingtype')]
    #[OA\Property(ref: '#/components/schemas/BuildingType')]
    protected BuildingType $buildingType;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 128, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The rental unit number is not a valid {{ type }}')]
    #[Assert\Length(min: 3, max: 128, minMessage: 'The rental unit number must be at least {{ limit }} characters long', maxMessage: 'The rental unit number can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $rentalUnitNumber;

    #[ORM\JoinColumn(name: 'residence_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Residence::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a residence')]
    #[OA\Property]
    protected Residence $residence;

    #[ORM\JoinColumn(name: 'building_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Building::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a building')]
    #[OA\Property]
    protected Building $building;

    #[ORM\JoinColumn(name: 'publicspace_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: PublicSpace::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a public space')]
    #[OA\Property]
    protected PublicSpace $publicSpace;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER, length: 5, nullable: false)]
    #[Assert\NotBlank(message: 'The house number may not be empty')]
    #[Assert\Type(type: 'integer', message: 'The house number is not a valid {{ type }}')]
    #[Assert\Range(min: 1, max: 99999)]
    #[OA\Property]
    protected int $houseNumber;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 32, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The addition is not a valid {{ type }}')]
    #[Assert\Length(max: 32, maxMessage: 'The addition can contain a maximum of %limit% characters')]
    #[OA\Property]
    protected string $addition;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 6, nullable: false)]
    #[Assert\NotBlank(message: 'The zipcode may not be empty')]
    #[Assert\Type(type: 'string', message: 'The zipcode is not a valid {{ type }}')]
    #[OA\Property]
    protected string $zipcode;

    #[ORM\JoinColumn(name: 'city_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: City::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a city')]
    #[OA\Property]
    protected City $city;

    #[ORM\Column(type: 'enumorientation', nullable: true)]
    #[Assert\Choice(choices: EnumOrientationType::ALLOWED_VALUES, message: 'Choose a valid orientation.')]
    #[OA\Property]
    protected string $orientation;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::BOOLEAN, nullable: false)]
    #[Assert\Type(type: 'bool', message: 'Daeb is not a valid {{ type }}')]
    #[OA\Property]
    protected bool $daeb;

    #[ORM\JoinColumn(name: 'vtw_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Vtw::class, fetch: 'EXTRA_LAZY', inversedBy: 'addresses')]
    #[Assert\NotBlank(message: 'An address must have a vtw')]
    #[OA\Property(ref: '#/components/schemas/Vtw')]
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
