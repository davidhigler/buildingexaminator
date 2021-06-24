<?php

namespace App\Entity\SuperClasses;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\MappedSuperclass
 */
class IdTimeIdentification extends IdTime
{
    /**
     *
     * @ORM\column(type="string", length=32)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      max=128,
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     * @var string
     */
    protected $code;

    /**
     *
     * @ORM\column(type="string", length=128)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      max=128,
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     * @var string
     */
    protected $naam;

    /**
     *
     * @ORM\column(type="text", nullable=true)
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @var string
     */
    protected $omschrijving;

    /**
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     *
     * @return string
     */
    public function getOmschrijving()
    {
        return $this->omschrijving;
    }

    /**
     *
     * @param string $code
     * @return void
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     *
     * @param string $naam
     * @return void
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;
    }

    /**
     *
     * @param string $omschrijving
     * @return void
     */
    public function setOmschrijving($omschrijving)
    {
        $this->omschrijving = $omschrijving;
    }

}