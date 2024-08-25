<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\ContractorUser;
use App\Entity\SuperClasses\IdName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'AuthorizationContractorGroups')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema(
    schema: 'ContractorGroups',
    title: 'Contractor groups',
    description: 'An array of contractor groups',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/ContractorGroup',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema]
class ContractorGroup extends IdName
{
    #[ORM\JoinColumn(name: 'contractor_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Authorization\Contractor::class, fetch: 'EXTRA_LAZY', inversedBy: 'contractorUsers')]
    #[Assert\NotBlank(message: 'A contractor user must have a contractor')]
    #[OA\Property(ref: '#/components/schemas/Contractor')]
    protected Contractor $contractor;

    #[ORM\JoinTable(name: 'AuthorizationContractorGroupsUsers')]
    #[ORM\ManyToMany(targetEntity: \App\Entity\Authentication\ContractorUser::class, inversedBy: 'contractorGroups', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/ContractorGroups')]
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