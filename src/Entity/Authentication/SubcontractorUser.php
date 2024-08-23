<?php

namespace App\Entity\Authentication;

use App\Entity\Authorization\Subcontractor;
use App\Entity\Authorization\SubcontractorGroup;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema()
 */
#[ORM\Entity]
class SubcontractorUser extends User
{
    /**
     *
     * @OA\Property(ref="#/components/schemas/Subcontractor")
     */
    #[ORM\JoinColumn(name: 'subcontractor_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Authorization\Subcontractor::class, inversedBy: 'subcontractorUsers', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A subcontractor user must have a subcontractor')]
    protected Subcontractor $subcontractor;

    /**
     * @OA\Property(ref="#/components/schemas/subcontractorGroups")
     */
    #[ORM\ManyToMany(targetEntity: \App\Entity\Authorization\SubcontractorGroup::class, mappedBy: 'subcontractorUsers', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
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