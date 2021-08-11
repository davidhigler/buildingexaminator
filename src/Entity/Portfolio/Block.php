<?php

namespace App\Entity\Portfolio;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\IdTimeIdentification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Blocks")
 *
 * @OA\Schema()
 */
class Block extends IdTimeIdentification
{
    /**
     * @ORM\ManyToOne(targetEntity="HousingStock", inversedBy="blocks")
     * @ORM\JoinColumn(name="housingstock_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\ManyToMany(targetEntity="BuildingAddress", mappedBy="blocks")
     * @ORM\JoinTable(name="linkbuildingaddressesandblocks")
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $buildingAddresses;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 0,
     *      max = 9999
     * )
     *
     * @OA\Property()
     */
    protected int $numberOfBuildingAddresses = 0;

    /**
     * @ORM\OneToMany(targetEntity="BuildingTypeSelection", mappedBy="block", fetch="EXTRA_LAZY")
     * @Assert\Valid()
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $buildingTypeSelection;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      max=128
     * )
     *
     * @OA\Property()
     */
    protected string $financialNumber;

    #[Pure]
    public function __construct()
    {
        $this->buildingAddresses = new ArrayCollection();
        $this->buildingTypeSelection = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getBuildingAddresses(): Collection
    {
        return $this->buildingAddresses;
    }

    public function getNumberOfBuildingAddresses(): int
    {
        return $this->numberOfBuildingAddresses;
    }

    public function getBuildingTypeSelection(): Collection
    {
        return $this->buildingTypeSelection;
    }

    public function getFinancialNumber(): string
    {
        return $this->financialNumber;
    }

    public function setHousingStock(HousingStock $housingStock): void
    {
        $this->housingStock = $housingStock;
    }

    public function addBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddresses->add($buildingAddress);
    }

    public function removeBuildingAddress(BuildingAddress $buildingAddress): void
    {
        $this->buildingAddresses->removeElement($buildingAddress);
    }

    public function setNumberOfBuildingAddresses($numberOfBuildingAddresses): void
    {
        $this->numberOfBuildingAddresses = $numberOfBuildingAddresses;
    }

    public function addBuildingSelection(BuildingTypeSelection $buildingSelection): void
    {
        $this->buildingTypeSelection->add($buildingSelection);
    }

    public function removeBuildingSelection(BuildingTypeSelection $buildingSelection): void
    {
        $this->buildingTypeSelection->removeElement($buildingSelection);
    }

    public function setFinancialNumber(string $financialNumber): void
    {
        $this->financialNumber = $financialNumber;
    }

}