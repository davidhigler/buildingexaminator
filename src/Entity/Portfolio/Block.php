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
 * @ORM\Table(name="PortfolioBlocks")
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
     * @ORM\OneToMany(targetEntity="Address", mappedBy="block", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/Addresses")
     */
    protected Collection $addresses;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
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
        $this->addresses = new ArrayCollection();
    }

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function getFinancialNumber(): string
    {
        return $this->financialNumber;
    }

    public function setHousingStock(HousingStock $housingStock): void
    {
        $this->housingStock = $housingStock;
    }

    public function addBuildingAddress(Address $address): void
    {
        $this->addresses->add($address);
    }

    public function removeBuildingAddress(Address $address): void
    {
        $this->addresses->removeElement($address);
    }

    public function setFinancialNumber(string $financialNumber): void
    {
        $this->financialNumber = $financialNumber;
    }

}