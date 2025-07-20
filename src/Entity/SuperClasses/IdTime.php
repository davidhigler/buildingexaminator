<?php

declare(strict_types=1);

namespace App\Entity\SuperClasses;

use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\MappedSuperclass]
class IdTime extends Id
{
    #[ORM\Column(type: 'datetimetz')]
    #[Assert\Type(type: 'object', message: 'The creation time is not a valid {{ type }}')]
    #[OA\Property]
    protected DateTime $creationTime;

    #[ORM\Column(type: 'datetimetz')]
    #[Assert\Type(type: 'object', message: 'The last change time is not a valid {{ type }}')]
    #[OA\Property]
    protected DateTime $lastChangeTime;

    public function getCreationTime(): DateTime
    {
        return $this->creationTime;
    }

    public function getLastChangeTime(): DateTime
    {
        return $this->lastChangeTime;
    }

    public function setCreationTime(): void
    {
        $this->creationTime = new DateTime;
    }

    public function setLastChangeTime(): void
    {
        $this->lastChangeTime = new DateTime;
    }
}
