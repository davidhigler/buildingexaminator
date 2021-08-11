<?php

namespace App\Entity\Portfolio;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\Id;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="Owners")
 *
 * @OA\Schema()
 */
class Owner extends Id
{
    /**
     * @ORM\OneToOne(targetEntity="HousingStock", inversedBy="owner")
     * @ORM\JoinColumn(name="housingstock_id", referencedColumnName="id")
     * @Assert\Valid()
     */
    protected HousingStock $housingStock;

    /**
     * @ORM\Column(type="string", length=128, nullable=false)
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      min=3,
     *      max=128,
     *      minMessage="%property% must be at least %limit% characters long",
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     *
     * @OA\Property()
     */
    protected string $name;

    /**
     * @ORM\Column(type="integer", nullable=false)
     * @Assert\Type(
     *     type="integer",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      min=8,
     *      max=8,
     *      minMessage="%property% must be at least %limit% characters long",
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     *
     * @OA\Property()
     */
    protected int $kvk;

    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      min=14,
     *      max=14,
     *      minMessage="%property% must be at least %limit% characters long",
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     *
     * @OA\Property()
     */
    protected string $btw;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\AtLeastOneOf({
     *     @Assert\Blank,
     *     @Assert\Length(
     *         min=5,
     *         max=5,
     *         minMessage="%property% must be at least %limit% characters long",
     *         maxMessage="%property% can contain a maximum of %limit% characters"
     *     )
     * })
     *
     * @OA\Property()
     */

    protected string $lNumber;

    public function getHousingStock(): HousingStock
    {
        return $this->housingStock;
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

    public function getLNumber(): string
    {
        return $this->lNumber;
    }

    public function setHousingStock(HousingStock $housingStock): void
    {
        $this->housingStock = $housingStock;
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

    public function setLNumber(string $lNumber): void
    {
        $this->lNumber = $lNumber;
    }
}