<?php

namespace App\Entity\SuperClasses;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\MappedSuperclass
 */
class IdName
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     *
     * @OA\Property()
     */
    protected int $id;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The name may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="The name is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=128,
     *      maxMessage="The name can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}