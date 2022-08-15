<?php

namespace App\Entity\Authentication;

use App\Entity\Authorization\Owner;
use Doctrine\ORM\Mapping as ORM;
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

    public function getOwner(): Owner
    {
        return $this->owner;
    }

    public function setOwner(Owner $owner): void
    {
        $this->owner = $owner;
    }
}