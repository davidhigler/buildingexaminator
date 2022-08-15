<?php

namespace App\Entity\Authentication;

use App\Entity\Authorization\Subcontractor;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity()
 *
 * @OA\Schema()
 */
class SubcontractorUser extends User
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Authorization\Subcontractor", inversedBy="subcontractorUsers", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="subcontractor_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A subcontractor user must have a subcontractor"
     * )
     *
     * @OA\Property(ref="#/components/schemas/Subcontractor")
     */
    protected Subcontractor $subcontractor;

    public function getSubcontractor(): Subcontractor
    {
        return $this->subcontractor;
    }

    public function setSubcontractor(Subcontractor $subcontractor): void
    {
        $this->subcontractor = $subcontractor;
    }
}