<?php

namespace App\Entity\Authentication;

use App\Entity\Authorization\Owner;
use App\Entity\Authorization\OwnerGroup;
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
    schema: 'OwnerUsers',
    title: 'Owner users',
    description: 'An array of owner users',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/OwnerUser',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema]
class OwnerUser extends User
{
    #[ORM\JoinColumn(name: 'owner_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Owner::class, fetch: 'EXTRA_LAZY', inversedBy: 'ownerUsers')]
    #[Assert\NotBlank(message: 'A owner user must have an owner')]
    #[OA\Property(ref: '#/components/schemas/Owner')]
    protected Owner $owner;

    #[ORM\ManyToMany(targetEntity: OwnerGroup::class, mappedBy: 'ownerUsers', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/OwnerGroups')]
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