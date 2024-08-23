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
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'AuthorizationOwnerGroups')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class OwnerGroup extends IdName
{
    /**
     *
     * @OA\Property(ref="#/components/schemas/Owner")
     */
    #[ORM\JoinColumn(name: 'owner_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: \App\Entity\Authorization\Owner::class, inversedBy: 'ownerUsers', fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'A owner user must have an owner')]
    protected Owner $owner;

    /**
     *
     * @OA\Property(ref="#/components/schemas/ownerUsers")
     */
    #[ORM\JoinTable(name: 'AuthorizationOwnerGroupsUsers')]
    #[ORM\ManyToMany(targetEntity: \App\Entity\Authentication\OwnerUser::class, inversedBy: 'ownerGroups', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
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