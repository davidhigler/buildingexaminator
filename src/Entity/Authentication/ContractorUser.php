<?php

namespace App\Entity\Authentication;

use App\Entity\Authorization\Contractor;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity()
 *
 * @OA\Schema()
 */
class ContractorUser extends User
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Authorization\Contractor", inversedBy="contractorUsers", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="contractor_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="A contractor user must have a contractor"
     * )
     *
     * @OA\Property(ref="#/components/schemas/Contractor")
     */
    protected Contractor $contractor;

    public function getContractor(): Contractor
    {
        return $this->contractor;
    }

    public function setContractor(Contractor $contractor): void
    {
        $this->contractor = $contractor;
    }
}