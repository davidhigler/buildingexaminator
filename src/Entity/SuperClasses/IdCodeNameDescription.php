<?php

namespace App\Entity\SuperClasses;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\MappedSuperclass
 */
class IdCodeNameDescription extends IdCodeName
{
    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The description is not a valid {{ type }}"
     * )
     *
     * @OA\Property()
     */
    protected string $description;

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}