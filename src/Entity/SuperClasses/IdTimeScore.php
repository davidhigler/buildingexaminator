<?php

namespace App\Entity\SuperClasses;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\MappedSuperclass]
class IdTimeScore extends IdTime
{
    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'enumconditionscore', nullable: false)]
    #[Assert\Choice(choices: App\Dbal\EnumConditionScoreType::ALLOWED_VALUES, message: 'Choose a valid condition score.')]
    protected string $conditionScore;

    public function getConditionScore(): string
    {
        return $this->conditionScore;
    }

    public function setConditionScore(string $conditionScore): void
    {
        $this->conditionScore = $conditionScore;
    }
}