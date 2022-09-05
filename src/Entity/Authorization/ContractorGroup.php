<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\ContractorUser;
use App\Entity\SuperClasses\IdName;
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
 * @ORM\Table(name="AuthorizationContractorGroups")
 *
 * @OA\Schema()
 */
class ContractorGroup extends IdName
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Authentication\ContractorUser", inversedBy="contractorGroups", cascade={"remove"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="AuthorizationContractorGroupsUsers")
     *
     * @OA\Property(ref="#/components/schemas/contractorGroups")
     */
    protected Collection $contractorUsers;

    #[Pure]
    public function __construct()
    {
        $this->contractorUsers = new ArrayCollection();
    }

    public function getContractor(): Contractor
    {
        return $this->contractor;
    }

    public function getContractorUsers(): Collection
    {
        return $this->contractorUsers;
    }

    public function setContractor(Contractor $contractor): void
    {
        $this->contractor = $contractor;
    }

    public function addContractorUser(ContractorUser $contractorUser): void
    {
        $this->contractorUsers->add($contractorUser);
    }

    public function removeContractorUser(ContractorUser $contractorUser): void
    {
        $this->contractorUsers->removeElement($contractorUser);
    }
}