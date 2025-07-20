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
class IdName extends Id
{
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 128, nullable: false)]
    #[Assert\NotBlank(message: 'The name may not be empty')]
    #[Assert\Type(type: 'string', message: 'The name is not a valid {{ type }}')]
    #[Assert\Length(max: 128, maxMessage: 'The name can contain a maximum of {{ limit }} characters')]
    #[OA\Property]
    protected string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
