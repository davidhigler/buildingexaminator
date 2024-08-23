<?php

namespace App\Entity\SuperClasses;

use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\MappedSuperclass]
class Id
{
    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[OA\Property]
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}