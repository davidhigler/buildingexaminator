<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\SubcontractorUser;
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
#[ORM\Table(name: 'AuthorizationSubcontractorGroups')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class SubcontractorGroup extends IdName
{
    #[ORM\JoinColumn(name: 'subcontractor_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Authorization\Subcontractor::class, inversedBy: 'subcontractorUsers', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A subcontractor user must have a subcontractor')]
    #[OA\Property(ref: '#/components/schemas/Subcontractor')]
    protected Subcontractor $subcontractor;

    #[ORM\JoinTable(name: 'AuthorizationSubcontractorGroupsUsers')]
    #[ORM\ManyToMany(targetEntity: \App\Entity\Authentication\SubcontractorUser::class, inversedBy: 'subcontractorGroups', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/subcontractorUsers')]
    protected Collection $subcontractorUsers;

    #[Pure]
    public function __construct()
    {
        $this->subcontractorUsers = new ArrayCollection();
    }

    public function getSubcontractor(): Subcontractor
    {
        return $this->subcontractor;
    }

    public function getSubcontractorUsers(): Collection
    {
        return $this->subcontractorUsers;
    }

    public function setSubcontractor(Subcontractor $subcontractor): void
    {
        $this->subcontractor = $subcontractor;
    }

    public function addSubcontractorUser(SubcontractorUser $subcontractorUser): void
    {
        $this->subcontractorUsers->add($subcontractorUser);
    }

    public function removeSubcontractorUser(SubcontractorUser $subcontractorUser): void
    {
        $this->subcontractorUsers->removeElement($subcontractorUser);
    }
}