<?php

namespace App\Entity\Portfolio;

use App\Entity\Authorization\Owner;
use App\Entity\Strategies\Project;
use App\Entity\SuperClasses\IdTimeIdentification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'PortfolioHousingStocks')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class HousingStock extends IdTimeIdentification
{
    #[ORM\JoinColumn(name: 'owner_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Owner::class, fetch: 'EXTRA_LAZY', inversedBy: 'housingStocks')]
    #[Assert\NotBlank(message: 'A housingstock must have an owner')]
    #[OA\Property(ref: '#/components/schemas/Owner')]
    protected Owner $owner;

    #[ORM\OneToMany(targetEntity: \App\Entity\Strategies\Project::class, mappedBy: 'housingStock', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/projects')]
    protected Collection $projects;

    #[ORM\OneToMany(targetEntity: Block::class, mappedBy: 'housingStock', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/blocks')]
    protected Collection $blocks;

    #[ORM\OneToMany(targetEntity: BuildingType::class, mappedBy: 'housingStock', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/buildingTypes')]
    protected Collection $buildingTypes;

    #[ORM\OneToMany(targetEntity: Address::class, mappedBy: 'housingStock', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/addresses')]
    protected Collection $addresses;

    #[Pure]
    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->blocks = new ArrayCollection();
        $this->buildingTypes = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

    public function getOwner(): Owner
    {
        return $this->owner;
    }

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    public function getNumberOfBlocks(): int
    {
        return count($this->blocks);
    }

    public function getBuildingTypes(): Collection
    {
        return $this->buildingTypes;
    }
    
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function setOwner(Owner $owner): void
    {
        $this->owner = $owner;
    }

    public function addProject(Project $project): void
    {
        $this->projects->add($project);
    }

    public function removeProject(Project $project): void
    {
        $this->projects->removeElement($project);
    }

    public function addBlock(Block $block): void
    {
        $this->blocks->add($block);
    }

    public function removeBlock(Block $block): void
    {
        $this->blocks->removeElement($block);
    }

    public function addBuildingType(BuildingType $buildingType): void
    {
        $this->buildingTypes->add($buildingType);
    }

    public function removeBuildingType(BuildingType $buildingType): void
    {
        $this->buildingTypes->removeElement($buildingType);
    }
    
    public function addAddress(Address $address): void
    {
        $this->addresses->add($address);
    }
    
    public function removeAddress(Address $address): void
    {
        $this->addresses->removeElement($address);
    }

}