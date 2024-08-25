<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\OwnerUser;
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
#[ORM\Table(name: 'AuthorizationOwnerGroups')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema(
    schema: 'OwnerGroups',
    title: 'Owner groups',
    description: 'An array of owner groups',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/OwnerGroup',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema]
class OwnerGroup extends IdName
{
    #[ORM\JoinColumn(name: 'owner_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Owner::class, fetch: 'EXTRA_LAZY', inversedBy: 'ownerUsers')]
    #[Assert\NotBlank(message: 'A owner user must have an owner')]
    #[OA\Property(ref: '#/components/schemas/Owner')]
    protected Owner $owner;

    #[ORM\JoinTable(name: 'AuthorizationOwnerGroupsUsers')]
    #[ORM\ManyToMany(targetEntity: OwnerUser::class, inversedBy: 'ownerGroups', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/OwnerUsers')]
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