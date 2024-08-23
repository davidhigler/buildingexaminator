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
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'PortfolioPublicSpaces')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class PublicSpace extends IdBagIds
{
    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'string', length: 80, nullable: false)]
    #[Assert\Type(type: 'string', message: 'The name is not a valid {{ type }}')]
    #[Assert\Length(max: 80, maxMessage: 'The name can contain a maximum of %limit% characters')]
    private string $name;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'string', length: 40, nullable: false)]
    #[Assert\Type(type: 'string', message: 'The type is not a valid {{ type }}')]
    #[Assert\Length(max: 40, maxMessage: 'The type can contain a maximum of %limit% characters')]
    private string $type;

    /**
     * @OA\Property(ref="#/components/schemas/addresses")
     */
    #[ORM\OneToMany(targetEntity: \Address::class, mappedBy: 'publicSpace', fetch: 'EXTRA_LAZY')]
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

    public function getType(): string
    {
        return $this->type;
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getNumberOfAddresses(): int
    {
        return count($this->addresses);
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
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