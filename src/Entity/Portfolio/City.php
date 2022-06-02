<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdBagIds;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PortfolioCities")
 *
 * @OA\Schema()
 */
class City extends IdBagIds
{
    /**
     * @ORM\Column(type="string", length=80, nullable=false)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The name is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=80,
     *      maxMessage="The name can contain a maximum of %limit% characters"
     * )
     *
     * @OA\Property()
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity="Address", mappedBy="publicSpace", fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    protected Collection $addresses;

    #[Pure]
    public function __construct()
    {
        $this->addresses = new ArrayCollection();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addAddress(Address $address): void
    {
        $this->addresses->add($address);
    }

    public function removeAddress(Address $address): void
    {
        $this->addresses->removeElement($address);
    }
}