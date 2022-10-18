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
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="StrategiesProjects")
 *
 * @OA\Schema()
 */
class Project extends IdCodeName
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Portfolio\HousingStock", inversedBy="projects", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="housingstock_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A project must have a housingstock"
     * )
     *
     * @OA\Property(ref="#/components/schemas/HousingStock")
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Authorization\Contractor", inversedBy="projects", cascade={"remove"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="StrategiesProjectsContractors")
     *
     * @OA\Property(ref="#/components/schemas/contractors")
     */
    protected Collection $contractors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Authorization\Subcontractor", inversedBy="projects", cascade={"remove"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="StrategiesProjectsSubcontractors")
     *
     * @OA\Property(ref="#/components/schemas/subcontractors")
     */
    protected Collection $subcontractors;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Portfolio\Address", inversedBy="projects", cascade={"remove"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="StrategiesProjectsAddresses")
     *
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    protected Collection $addresses;

    /**
     * @ORM\Column(type="datetimetz")
     *
     * @Assert\Type(
     *     type="object",
     *     message="The creation time is not a valid {{ type }}"
     * )
     *
     * @OA\Property()
     */
    private DateTime $preferredStartDate;

    /**
     * @ORM\Column(type="datetimetz")
     *
     * @Assert\Type(
     *     type="object",
     *     message="The creation time is not a valid {{ type }}"
     * )
     *
     * @OA\Property()
     */
    private DateTime $actualStartDate;
    /**
     * @ORM\Column(type="datetimetz")
     *
     * @Assert\Type(
     *     type="object",
     *     message="The creation time is not a valid {{ type }}"
     * )
     *
     * @OA\Property()
     */
    private DateTime $preferredEndDate;

    /**
     * @ORM\Column(type="datetimetz")
     *
     * @Assert\Type(
     *     type="object",
     *     message="The creation time is not a valid {{ type }}"
     * )
     *
     * @OA\Property()
     */
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