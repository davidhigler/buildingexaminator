<?php

namespace App\Entity\SuperClasses;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\MappedSuperclass
 */
class IdBagIds extends Id
{
    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The bag object id may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="The bag object id is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=32,
     *      maxMessage="The bag object id can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $objectId;

    /**
     * @ORM\Column(type="string", length=32, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The bag identification may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="The bag identification is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=32,
     *      maxMessage="The bag identification can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $identification;

    public function getObjectId(): string
    {
        return $this->objectId;
    }

    public function getIdentification(): string
    {
        return $this->identification;
    }

    public function setObjectId(string $objectId): void
    {
        $this->objectId = $objectId;
    }

    public function setIdentification(string $identification): void
    {
        $this->identification = $identification;
    }
}