<?php

namespace App\Entity\Portfolio;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\IdTimeIdentification;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Vtws")
 *
 * @OA\Schema()
 */
class Vtw extends IdTimeIdentification
{
    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The building type may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="The building type is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=128,
     *      maxMessage="The building type can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $buildingType;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The construction year may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="The construction year is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=128,
     *      maxMessage="The construction year can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $constructionYear;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The roof type may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="The roof type is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=128,
     *      maxMessage="The roof type can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $roofType;

    public function getBuildingType(): string
    {
        return $this->buildingType;
    }

    public function getConstructionYear(): string
    {
        return $this->constructionYear;
    }

    public function getRoofType(): string
    {
        return $this->roofType;
    }

    public function setBuildingType(string $buildingType): void
    {
        $this->buildingType = $buildingType;
    }

    public function setConstructionYear(string $constructionYear): void
    {
        $this->constructionYear = $constructionYear;
    }

    public function setRoofType(string $roofType): void
    {
        $this->roofType = $roofType;
    }
}
