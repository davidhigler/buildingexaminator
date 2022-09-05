<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\SubcontractorUser;
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
class SubcontractorGroup extends IdName
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Authorization\Subcontractor", inversedBy="subcontractorUsers", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="subcontractor_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A subcontractor user must have a subcontractor"
     * )
     *
     * @OA\Property(ref="#/components/schemas/Subcontractor")
     */
    protected Subcontractor $subcontractor;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Authentication\SubcontractorUser", inversedBy="subcontractorGroups", cascade={"remove"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="AuthorizationSubcontractorGroupsUsers")
     *
     * @OA\Property(ref="#/components/schemas/subcontractorUsers")
     */
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