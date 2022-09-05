<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\OwnerUser;
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
 * @ORM\Table(name="AuthorizationOwnerGroups")
 *
 * @OA\Schema()
 */
class OwnerGroup extends IdName
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Authentication\OwnerUser", inversedBy="ownerGroups", cascade={"remove"}, fetch="EXTRA_LAZY")
     * @ORM\JoinTable(name="AuthorizationOwnerGroupsUsers")
     *
     * @OA\Property(ref="#/components/schemas/ownerUsers")
     */
    protected Collection $ownerUsers;

    #[Pure]
    public function __construct()
    {
        $this->ownerUsers = new ArrayCollection();
    }

    public function getOwnerUsers(): Collection
    {
        return $this->ownerUsers;
    }

    public function addOwnerUser(OwnerUser $ownerUser): void
    {
        $this->ownerUsers->add($ownerUser);
    }

    public function removeOwnerUser(OwnerUser $ownerUser): void
    {
        $this->ownerUsers->removeElement($ownerUser);
    }
}