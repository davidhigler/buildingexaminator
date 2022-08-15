<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\OwnerUser;
use App\Entity\Portfolio\HousingStock;
use App\Entity\SuperClasses\Id;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="AuthorizationOwners")
 *
 * @OA\Schema()
 */
class Owner extends Id
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Portfolio\HousingStock", mappedBy="owner", cascade={"remove"})
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $housingStocks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Authentication\OwnerUser", mappedBy="owner", cascade={"remove"})
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $ownerUsers;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The name is not a valid {{ type }}"
     * )
     * @Assert\NotBlank(
     *     message="The name can not be empty"
     * )
     * @Assert\Length(
     *     min=3,
     *     max=128,
     *     minMessage="The name must be at least {{ limit }} characters long",
     *     maxMessage="The name can contain a maximum of {{ limit }} characters"
     * )
     *
     * @OA\Property()
     */
    protected string $name;

    /**
     * @ORM\Column(type="integer", length=8, nullable=true)
     *
     * @Assert\Type(
     *     type="integer",
     *     message="The KVK number is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *     min=8,
     *     max=8,
     *     exactMessage="The KVK number must be exactly {{ limit }} characters long"
     * )
     *
     * @OA\Property()
     */
    protected int $kvk;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The BTW number is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *     min=14,
     *     max=14,
     *     exactMessage="The BTW number must be exactly {{ limit }} characters long"
     * )
     *
     * @OA\Property()
     */
    protected string $btw;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The L number is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *     min=5,
     *     max=5,
     *     exactMessage="The L number must be axactly {{ limit }} characters long"
     * )
     *
     * @OA\Property()
     */
    protected string $lnumber;

    /**
     * @ORM\Column(type="string", length=256, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The website is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      min=8,
     *      max=256,
     *      minMessage="The website must be at least {{ limit }} characters long",
     *      maxMessage="The website can contain a maximum of {{ limit }} characters"
     * )
     * @Assert\Url(
     *      protocols = {"https"},
     *      message = "The website '{{ value }}' is not a valid url"
     * )
     *
     * @OA\Property()
     */
    protected string $website;

    #[Pure]
    public function __construct()
    {
        $this->housingStocks = new ArrayCollection();
        $this->ownerUsers = new ArrayCollection();
    }

    public function getHousingStocks(): Collection
    {
        return $this->housingStocks;
    }

    public function getOwnerUsers(): Collection
    {
        return $this->ownerUsers;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKvk(): int
    {
        return $this->kvk;
    }

    public function getBtw(): string
    {
        return $this->btw;
    }

    public function getLnumber(): string
    {
        return $this->lnumber;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function addHousingStock(HousingStock $housingStock): void
    {
        $this->housingStocks->add($housingStock);
    }

    public function removeHousingStock(HousingStock $housingStock): void
    {
        $this->housingStocks->removeElement($housingStock);
    }

    public function addOwnerUser(OwnerUser $ownerUser): void
    {
        $this->ownerUsers->add($ownerUser);
    }

    public function removeOwnerUser(OwnerUser $ownerUsers): void
    {
        $this->ownerUsers->removeElement($ownerUsers);
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setKvk(int $kvk): void
    {
        $this->kvk = $kvk;
    }

    public function setBtw(string $btw): void
    {
        $this->btw = $btw;
    }

    public function setLnumber(string $lnumber): void
    {
        $this->lnumber = $lnumber;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }
}