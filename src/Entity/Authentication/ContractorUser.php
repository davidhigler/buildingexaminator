<?php

namespace App\Entity\Authentication;

use App\Entity\Authorization\Contractor;
use App\Entity\Authorization\ContractorGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity()
 *
 * @OA\Schema()
 */
class ContractorUser extends User
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Authorization\Contractor", inversedBy="contractorUsers", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="contractor_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A contractor user must have a contractor"
     * )
     *
     * @OA\Property(ref="#/components/schemas/Contractor")
     */
    protected Contractor $contractor;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Authorization\ContractorGroup", mappedBy="contractorUsers", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/contractorGroups")
     */
    protected Collection $contractorGroups;

    #[Pure]
    public function __construct()
    {
        $this->contractorGroups = new ArrayCollection();
    }

    public function getContractor(): Contractor
    {
        return $this->contractor;
    }

    public function getContractorGroups(): Collection
    {
        return $this->contractorGroups;
    }

    public function setContractor(Contractor $contractor): void
    {
        $this->contractor = $contractor;
    }

    public function addContractorGroup(ContractorGroup $contractorGroup): void
    {
        $this->contractorGroups->add($contractorGroup);
    }

    public function removeContractorGroup(ContractorGroup $contractorGroup): void
    {
        $this->contractorGroups->removeElement($contractorGroup);
    }
}