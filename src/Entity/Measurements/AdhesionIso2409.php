<?php

namespace App\Entity\Measurements;

use App\Entity\Portfolio\BuildingAddress;
use App\Entity\SuperClasses\IdTime;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * This object holds an adhesion measurement according to ISO 2409
 * https://www.nen.nl/nen-en-iso-2409-2020-en-275977
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="MeasurementsAdhesionIso2409")
 *
 * @OA\Schema()
 */
class AdhesionIso2409 extends IdTime
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Portfolio\BuildingAddress", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="buildingaddress_id", referencedColumnName="id")
     *
     * @Assert\NotBlank(
     *     message="An adhesion measurement must have a buildingaddress"
     * )
     *
     * @OA\Property(ref="#/components/schemas/BuildingAddress")
     */
    protected BuildingAddress $address;

    /**
     * @ORM\Column(type="integer", length=3, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The procent detachment may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="The procent detachment is not a valid {{ type }}"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 100
     * )
     *
     * @OA\Property()
     */
    protected int $procentDetachment;

    public function __construct(int $procentDetachment)
    {
        $this->procentDetachment = $procentDetachment;
    }

    public function getAddress(): BuildingAddress
    {
        return $this->address;
    }

    public function setAddress(BuildingAddress $address): void
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