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
     *
     * @Assert\NotBlank(
     *     message="A block must have a housingstock"
     * )
     *
     * @OA\Property(ref="#/components/schemas/HousingStock")
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\OneToMany(targetEntity="BuildingAddress", mappedBy="block", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/buildingAddresses")
     */
    protected Collection $buildingAddresses;

    /**
     * @ORM\OneToMany(targetEntity="BuildingTypeSelection", mappedBy="block", fetch="EXTRA_LAZY")
     *
     * @OA\Property()
     */
    protected Collection $buildingTypeSelection;

    /**
     * @ORM\Column(type="string", length=128)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The financial number is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=128,
     *      maxMessage="The financial number can contain a maximum of {{ limit }} characters"
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
        return count($this->buildingAddresses);
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