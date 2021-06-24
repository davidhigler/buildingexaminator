<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

use App\Entity\SuperClasses\IdTime;

/**
 *
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="gebouw_adressen")
 */
class GebouwAdres extends IdTime
{
    /**
     *
     * @ORM\ManyToOne(targetEntity="DobroCm\Objects\Portefeuille\Voorraad", inversedBy="gebouw_types")
     * @ORM\JoinColumn(name="voorraad_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var Voorraad
     */
    protected $voorraad;

    /**
     *
     * @ORM\ManyToOne(targetEntity="DobroCm\Objects\Portefeuille\Woonwijk", inversedBy="gebouw_adressen")
     * @ORM\JoinColumn(name="woonwijk_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var Woonwijk
     */
    protected $woonwijk;

    /**
     *
     * @ORM\ManyToOne(targetEntity="DobroCm\Objects\Portefeuille\GebouwType", inversedBy="gebouw_adressen")
     * @ORM\JoinColumn(name="gebouw_type_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var GebouwType
     */
    protected $gebouw_type;

    /**
     *
     * @ORM\ManyToOne(targetEntity="DobroCm\Objects\Portefeuille\WoonType", inversedBy="gebouw_adressen")
     * @ORM\JoinColumn(name="woon_type_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var GebouwType
     */
    protected $woon_type;

    /**
     *
     * @ORM\ManyToMany(targetEntity="DobroCm\Objects\Portefeuille\Complex", inversedBy="gebouw_adressen")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var complex[]
     */
    protected $complexen;

    /**
     *
     * @ORM\column(type="string", length=128, nullable=true)
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
     * @var string
     */
    protected $vhenummer;

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
     *      min=3,
     *      max=128,
     *      minMessage="%property% must be at least %limit% characters long",
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     * @var string
     */
    protected $straatnaam;

    /**
     *
     * @ORM\column(type="integer")
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 9999,
     *      minMessage = "%property% must be at least %limit%",
     *      maxMessage = "%property% must be lower than %limit%"
     * )
     * @var integer
     */
    protected $huisnummer;

    /**
     *
     * @ORM\column(type="string", length=32)
     * @Assert\Type(
     *     type="string",
     *     message="%property% is not a valid %type%"
     * )
     * @Assert\Length(
     *      max=32,
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     * @var string
     */
    protected $toevoeging;

    /**
     *
     * @ORM\column(type="string", length=6)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="string",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 1,
     *      max = 9999,
     *      minMessage = "%property% must be at least %limit%",
     *      maxMessage = "%property% must be lower than %limit%"
     * )
     * @var string
     */
    protected $postcode;

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
     *      min=3,
     *      max=128,
     *      minMessage="%property% must be at least %limit% characters long",
     *      maxMessage="%property% can contain a maximum of %limit% characters"
     * )
     * @var string
     */
    protected $plaats;

    /**
     *
     * @ORM\column(type="integer", nullable=true)
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     * @var integer
     */
    protected $bag_id;

    /**
     *
     * @ORM\column(type="integer", nullable=true)
     * @Assert\NotBlank(
     *      message="%property% may not be empty"
     * )
     * @Assert\Type(
     *      type="integer",
     *      message="%property% is not a valid %type%"
     * )
     * @Assert\Range(
     *      min = 1800,
     *      max = 2100,
     *      minMessage = "%property% must be at least %limit%",
     *      maxMessage = "%property% must be lower than %limit%"
     * )
     * @var integer
     */
    protected $bouwjaar;

    /**
     *
     * @ORM\column(type="integer", nullable=true)
     * @Assert\Regex(
     *      pattern="/(|[\d]{4})/",
     *      message="%property% is not a valid %type%"
     * )
     * @var integer
     */
    protected $renovatiejaar;

    /**
     *
     */
    public function __construct()
    {
        $this->complexen = new ArrayCollection();
    }

    /**
     *
     * @return Voorraad
     */
    public function getVoorraad()
    {
        return $this->voorraad;
    }

    /**
     *
     * @return Woonwijk
     */
    public function getWoonwijk()
    {
        return $this->woonwijk;
    }

    /**
     *
     * @return GebouwType
     */
    public function getGebouwType()
    {
        return $this->gebouw_type;
    }

    /**
     *
     * @return WoonType
     */
    public function getWoonType()
    {
        return $this->woon_type;
    }

    /**
     *
     * @return Complex[]
     */
    public function getComplexen()
    {
        $this->complexen;
    }

    /**
     *
     * @return string
     */
    public function getVhenummer()
    {
        return $this->vhenummer;
    }

    /**
     *
     * @return string
     */
    public function getStraatnaam()
    {
        return $this->straatnaam;
    }

    /**
     *
     * @return integer
     */
    public function getHuisnummer()
    {
        return $this->huisnummer;
    }

    /**
     *
     * @return string
     */
    public function getToevoeging()
    {
        return $this->toevoeging;
    }

    /**
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     *
     * @return string
     */
    public function getPlaats()
    {
        return $this->plaats;
    }

    /**
     *
     * @return string
     */
    public function getBagId()
    {
        return $this->bag_id;
    }

    /**
     *
     * @return integer
     */
    public function getBouwjaar()
    {
        return $this->bouwjaar;
    }

    /**
     *
     * @return integer
     */
    public function getRenovatiejaar()
    {
        return $this->renovatiejaar;
    }

    /**
     *
     * @param Voorraad $voorraad
     * @return void
     */
    public function setVoorraad(Voorraad $voorraad)
    {
        $this->voorraad = $voorraad;
    }

    /**
     *
     * @param Woonwijk $woonwijk
     * @return void
     */
    public function setWoonwijk(Woonwijk $woonwijk)
    {
        $this->woonwijk = $woonwijk;
    }

    /**
     *
     * @param GebouwType $gebouw_type
     * @return void
     */
    public function setGebouwType(GebouwType $gebouw_type)
    {
        $this->gebouw_type = $gebouw_type;
    }

    /**
     *
     * @param WoonType $woon_type
     * @return void
     */
    public function setWoonType(WoonType $woon_type)
    {
        $this->woon_type = $woon_type;
    }

    /**
     *
     * @param Complex $complex
     * @return void
     */
    public function addComplex(Complex $complex)
    {
        $this->complexen->add($complex);
    }

    /**
     *
     * @param Complex $complex
     * @return void
     */
    public function removeComplex(Complex $complex)
    {
        $this->complexen->removeElement($complex);
    }

    /**
     *
     * @param string $vhenummer
     * @return void
     */
    public function setVhenummer($vhenummer)
    {
        $this->vhenummer = $vhenummer;
    }

    /**
     *
     * @param string $straatnaam
     * @return void
     */
    public function setStraatnaam($straatnaam)
    {
        $this->straatnaam = $straatnaam;
    }

    /**
     *
     * @param integer $huisnummer
     * @return void
     */
    public function setHuisnummer($huisnummer)
    {
        $this->huisnummer = $huisnummer;
    }

    /**
     *
     * @param string $toevoeging
     * @return void
     */
    public function setToevoeging($toevoeging)
    {
        $this->toevoeging = $toevoeging;
    }

    /**
     *
     * @param string $postcode
     * @return void
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;
    }

    /**
     *
     * @param string $plaats
     * @return void
     */
    public function setPlaats($plaats)
    {
        $this->plaats = $plaats;
    }

    /**
     *
     * @param integer $bag_id
     * @return void
     */
    public function setBagId($bag_id)
    {
        $this->bag_id = $bag_id;
    }

    /**
     *
     * @param integer $bouwjaar
     * @return void
     */
    public function setBouwjaar($bouwjaar)
    {
        $this->bouwjaar = $bouwjaar;
    }

    /**
     *
     * @param integer $renovatiejaar
     * @return void
     */
    public function setRenovatiejaar($renovatiejaar)
    {
        $this->renovatiejaar = $renovatiejaar;
    }

}