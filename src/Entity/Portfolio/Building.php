<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdBagIds;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PortfolioBuilding")
 *
 * @OA\Schema()
 */
class Building extends IdBagIds
{
    /**
     * @ORM\Column(type="integer", nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The construction year may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="The construction year is not a valid {{ type }}"
     * )
     * @Assert\Range(
     *      min = 1800,
     *      max = 2100
     * )
     *
     * @OA\Property()
     */
    protected int $constructionYear;

    /**
     * @ORM\Column(type="enumbuildingstatus", nullable=true)
     *
     * @Assert\Choice(choices=App\Dbal\EnumBuildingStatusType::ALLOWED_VALUES, message="Choose a valid building status type.")
     *
     * @OA\Property()
     */
    private string $status;

    /**
     * @ORM\Column(type="integer", length=5, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The residence count number may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="The residence count is not a valid {{ type }}"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 99999
     * )
     *
     * @OA\Property()
     */
    private int $residenceCount;

    /**
     * @ORM\Column(type="integer", length=5, nullable=false)
     *
     * @Assert\NotBlank(
     *      message="The surface area number may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="The surface area is not a valid {{ type }}"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 99999
     * )
     *
     * @OA\Property()
     */
    private int $surfaceArea;

    #[Pure]
    public function __construct()
    {
    }

    public function getConstructionYear(): int
    {
        return $this->constructionYear;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getResidenceCount(): int
    {
        return $this->residenceCount;
    }

    public function getSurfaceArea(): int
    {
        return $this->surfaceArea;
    }

    public function setConstructionYear(int $constructionYear): void
    {
        $this->constructionYear = $constructionYear;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setResidenceCount(int $residenceCount): void
    {
        $this->residenceCount = $residenceCount;
    }

    public function setSurfaceArea(int $surfaceArea): void
    {
        $this->surfaceArea = $surfaceArea;
    }
}