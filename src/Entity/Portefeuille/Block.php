<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTimeIdentification;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Blocks")
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
     * @ORM\ManyToMany(targetEntity="BuildingAddress", inversedBy="blocks")
     * @ORM\JoinTable(name="linkbuildingaddressenandblocks")
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
     */
    protected int $numberOfBuildingAddresses = 0;

    /**
     * @ORM\OneToMany(targetEntity="BuildingSelection", mappedBy="block", fetch="EXTRA_LAZY")
     * @Assert\Valid()
     */
    protected Collection $buildingSelection;

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
     */
    protected string $financialNumber;

    public function __construct()
    {
        $this->buildingAddresses = new ArrayCollection();
        $this->buildingSelection = new ArrayCollection();
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

    public function getBuildingSelection(): Collection
    {
        return $this->buildingSelection;
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

    public function addBuildingSelection(BuildingSelection $buildingSelection): void
    {
        $this->buildingSelection->add($buildingSelection);
    }

    public function removeBuildingSelection(BuildingSelection $buildingSelection): void
    {
        $this->buildingSelection->removeElement($buildingSelection);
    }

    public function setFinancialNumber(string $financialNumber): void
    {
        $this->financialNumber = $financialNumber;
    }

}