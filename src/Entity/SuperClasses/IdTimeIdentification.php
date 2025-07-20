<?php

declare(strict_types=1);

namespace App\Entity\SuperClasses;

use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\MappedSuperclass]
class IdTimeIdentification extends IdTime
{
    #[ORM\Column(type: 'string', length: 32, nullable: false)]
    #[Assert\NotBlank(message: 'The code may not be empty')]
    #[Assert\Type(type: 'string', message: 'The code is not a valid {{ type }}')]
    #[Assert\Length(max: 32, maxMessage: 'The code can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $code;

    #[ORM\Column(type: 'string', length: 128, nullable: false)]
    #[Assert\NotBlank(message: 'The name may not be empty')]
    #[Assert\Type(type: 'string', message: 'The name is not a valid {{ type }}')]
    #[Assert\Length(max: 128, maxMessage: 'The name can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $name;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Assert\Type(type: 'string', message: 'The description is not a valid {{ type }}')]
    #[OA\Property]
    protected ?string $description = null;

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
