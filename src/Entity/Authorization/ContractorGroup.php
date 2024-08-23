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
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'AuthorizationContractorGroups')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class ContractorGroup extends IdName
{
    /**
     *
     * @OA\Property(ref="#/components/schemas/Contractor")
     */
    #[ORM\JoinColumn(name: 'contractor_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Authorization\Contractor::class, inversedBy: 'contractorUsers', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A contractor user must have a contractor')]
    protected Contractor $contractor;

    /**
     *
     * @OA\Property(ref="#/components/schemas/contractorGroups")
     */
    #[ORM\JoinTable(name: 'AuthorizationContractorGroupsUsers')]
    #[ORM\ManyToMany(targetEntity: \App\Entity\Authentication\ContractorUser::class, inversedBy: 'contractorGroups', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
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