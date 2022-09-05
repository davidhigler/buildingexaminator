<?php

namespace App\Entity\Authentication;

use App\Entity\Authorization\Owner;
use App\Entity\Authorization\OwnerGroup;
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
class OwnerUser extends User
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Authorization\Owner", inversedBy="ownerUsers", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A owner user must have an owner"
     * )
     *
     * @OA\Property(ref="#/components/schemas/Owner")
     */
    protected Owner $owner;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Authorization\OwnerGroup", mappedBy="ownerUsers", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/ownerGroups")
     */
    protected Collection $ownerGroups;

    #[Pure]
    public function __construct()
    {
        $this->ownerGroups = new ArrayCollection();
    }

    public function getOwner(): Owner
    {
        return $this->owner;
    }

    public function getOwnerGroups(): Collection
    {
        return $this->ownerGroups;
    }

    public function setOwner(Owner $owner): void
    {
        $this->owner = $owner;
    }

    public function addOwnerGroup(OwnerGroup $ownerGroup): void
    {
        $this->ownerGroups->add($ownerGroup);
    }

    public function removeOwnerGroup(OwnerGroup $ownerGroup): void
    {
        $this->ownerGroups->removeElement($ownerGroup);
    }
}