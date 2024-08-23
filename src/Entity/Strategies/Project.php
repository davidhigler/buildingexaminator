<?php

namespace App\Entity\Strategies;

use App\Entity\Authorization\Contractor;
use App\Entity\Authorization\Subcontractor;
use App\Entity\Portfolio\Address;
use App\Entity\Portfolio\HousingStock;
use App\Entity\SuperClasses\IdCodeName;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'StrategiesProjects')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Project extends IdCodeName
{
    /**
     *
     * @OA\Property(ref="#/components/schemas/HousingStock")
     */
    #[ORM\JoinColumn(name: 'housingstock_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Portfolio\HousingStock::class, inversedBy: 'projects', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A project must have a housingstock')]
    protected HousingStock $housingStock;

    /**
     *
     * @OA\Property(ref="#/components/schemas/contractors")
     */
    #[ORM\JoinTable(name: 'StrategiesProjectsContractors')]
    #[ORM\ManyToMany(targetEntity: \App\Entity\Authorization\Contractor::class, inversedBy: 'projects', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    protected Collection $contractors;

    /**
     *
     * @OA\Property(ref="#/components/schemas/subcontractors")
     */
    #[ORM\JoinTable(name: 'StrategiesProjectsSubcontractors')]
    #[ORM\ManyToMany(targetEntity: \App\Entity\Authorization\Subcontractor::class, inversedBy: 'projects', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    protected Collection $subcontractors;

    /**
     *
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    #[ORM\JoinTable(name: 'StrategiesProjectsAddresses')]
    #[ORM\ManyToMany(targetEntity: \App\Entity\Portfolio\Address::class, inversedBy: 'projects', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    protected Collection $addresses;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'datetimetz')]
    #[Assert\Type(type: 'object', message: 'The creation time is not a valid {{ type }}')]
    private DateTime $preferredStartDate;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'datetimetz')]
    #[Assert\Type(type: 'object', message: 'The creation time is not a valid {{ type }}')]
    private DateTime $actualStartDate;
    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'datetimetz')]
    #[Assert\Type(type: 'object', message: 'The creation time is not a valid {{ type }}')]
    private DateTime $preferredEndDate;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'datetimetz')]
    #[Assert\Type(type: 'object', message: 'The creation time is not a valid {{ type }}')]
    private DateTime $actualEndDate;

    #[Pure]
    public function __construct()
    {
        $this->contractors = new ArrayCollection();
        $this->subcontractors = new ArrayCollection();
        $this->addresses = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getContractors(): Collection
    {
        return $this->contractors;
    }

    public function getSubcontractors(): Collection
    {
        return $this->subcontractors;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function getPreferredStartDate(): DateTime
    {
        return $this->preferredStartDate;
    }

    public function getActualStartDate(): DateTime
    {
        return $this->actualStartDate;
    }

    public function getPreferredEndDate(): DateTime
    {
        return $this->preferredEndDate;
    }

    public function getActualEndDate(): DateTime
    {
        return $this->actualEndDate;
    }

    public function setHousingStock(HousingStock $housingStock): void
    {
        $this->housingStock = $housingStock;
    }

    public function addContractor(Contractor $contractor): void
    {
        $this->contractors->add($contractor);
    }

    public function removeContractor(Contractor $contractor): void
    {
        $this->contractors->removeElement($contractor);
    }

    public function addSubcontractor(Subcontractor $subcontractor): void
    {
        $this->subcontractors->add($subcontractor);
    }

    public function removeSubcontractor(Subcontractor $subcontractor): void
    {
        $this->subcontractors->removeElement($subcontractor);
    }

    public function addAddress(Address $address): void
    {
        $this->addresses->add($address);
    }

    public function removeAddress(Address $address): void
    {
        $this->addresses->removeElement($address);
    }

    public function setPreferredStartDate(DateTime $preferredStartDate): void
    {
        $this->preferredStartDate = $preferredStartDate;
    }

    public function setActualStartDate(DateTime $actualStartDate): void
    {
        $this->actualStartDate = $actualStartDate;
    }

    public function setPreferredEndDate(DateTime $preferredEndDate): void
    {
        $this->preferredEndDate = $preferredEndDate;
    }

    public function setActualEndDate(DateTime $actualEndDate): void
    {
        $this->actualEndDate = $actualEndDate;
    }

    public function equals(self $project): bool
    {
        return $this->getId() === $project->getId();
    }
}