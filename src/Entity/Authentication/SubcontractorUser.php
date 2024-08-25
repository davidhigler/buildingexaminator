<?php

namespace App\Entity\Authentication;

use App\Entity\Authorization\Subcontractor;
use App\Entity\Authorization\SubcontractorGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Entity]
#[OA\Schema(
    schema: 'SubcontractorUsers',
    title: 'Subcontractor users',
    description: 'An array of subcontractor users',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/SubcontractorUser',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema]
class SubcontractorUser extends User
{
    #[ORM\JoinColumn(name: 'subcontractor_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Subcontractor::class, fetch: 'EXTRA_LAZY', inversedBy: 'subcontractorUsers')]
    #[Assert\NotBlank(message: 'A subcontractor user must have a subcontractor')]
    #[OA\Property(ref: '#/components/schemas/Subcontractor')]
    protected Subcontractor $subcontractor;

    #[ORM\ManyToMany(targetEntity: SubcontractorGroup::class, mappedBy: 'subcontractorUsers', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/SubcontractorGroups')]
    protected Collection $subcontractorGroups;

    #[Pure]
    public function __construct()
    {
        $this->subcontractorGroups = new ArrayCollection();
    }

    public function getSubcontractor(): Subcontractor
    {
        return $this->subcontractor;
    }

    public function getSubcontractorGroups(): Collection
    {
        return $this->subcontractorGroups;
    }

    public function setSubcontractor(Subcontractor $subcontractor): void
    {
        $this->subcontractor = $subcontractor;
    }

    public function addSubcontractorGroup(SubcontractorGroup $subcontractorGroup): void
    {
        $this->subcontractorGroups->add($subcontractorGroup);
    }

    public function removeSubcontractorGroup(SubcontractorGroup $subcontractorGroup): void
    {
        $this->subcontractorGroups->removeElement($subcontractorGroup);
    }
}