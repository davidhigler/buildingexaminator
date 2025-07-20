<?php

declare(strict_types=1);

namespace App\Entity\Measurements;

use App\Entity\Portfolio\Address;
use App\Entity\SuperClasses\IdTimeScore;
use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * This object holds an adhesion measurement according to SKH 05-01 publication
 * https://www.skh.nl/downloads/05-01-nl-bepaling-van-de-hechting-van-verf-op-hout-2018.pdf
 *
 */
#[ORM\Table(name: 'MeasurementsAdhesionSkh0501')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class AdhesionSkh0501 extends IdTimeScore
{
    #[ORM\JoinColumn(name: 'address_id', referencedColumnName: 'id')]
    #[ORM\ManyToOne(targetEntity: Address::class, fetch: 'EXTRA_LAZY')]
    #[Assert\NotBlank(message: 'An adhesion measurement must have an address')]
    #[OA\Property(ref: '#/components/schemas/Address')]
    protected Address $address;

    #[ORM\Column(type: 'integer', length: 3, nullable: false)]
    #[Assert\NotBlank(message: 'The procent detachment may not be empty')]
    #[Assert\Type(type: 'integer', message: 'The procent detachment is not a valid {{ type }}')]
    #[Assert\Range(min: 1, max: 100)]
    #[OA\Property]
    protected int $procentDetachment;

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getProcentDetachment(): int
    {
        return $this->procentDetachment;
    }

    public function setProcentDetachment(int $procentDetachment): void
    {
        $this->procentDetachment = $procentDetachment;
    }
}
