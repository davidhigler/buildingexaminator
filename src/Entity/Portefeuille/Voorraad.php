<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTimeIdentification;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="voorraden")
 */
class Voorraad extends IdTimeIdentification
{

    /**
     *
     * @ORM\OneToMany(targetEntity="DobroCm\Objects\Portefeuille\Complex", mappedBy="voorraad", cascade={"remove"}, fetch="EXTRA_LAZY")
     * @var Complex[]
     */
    protected $complexen;

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
     *      min = 0,
     *      max = 9999,
     *      minMessage = "%property% must be at least %limit%",
     *      maxMessage = "%property% must be lower than %limit%"
     * )
     * @var integer
     */
    protected $aantal_complexen = 0;

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
     *      min = 0,
     *      max = 999999,
     *      minMessage = "%property% must be at least %limit%",
     *      maxMessage = "%property% must be lower than %limit%"
     * )
     * @var integer
     */
    protected $aantal_gebouw_adressen = 0;

    /**
     *
     * @ORM\OneToMany(targetEntity="DobroCm\Objects\Portefeuille\GebouwType", mappedBy="voorraad", cascade={"remove"}, fetch="EXTRA_LAZY")
     * @var GebouwType[]
     */
    protected $gebouw_types;

    /**
     *
     * @ORM\OneToOne(targetEntity="DobroCm\Objects\Portefeuille\VoorraadOptieSet", cascade={"remove"}, mappedBy="voorraad")
     * @var VoorraadOptieSet
     */
    protected $voorraad_optie_set;

    /**
     *
     */
    public function __construct()
    {
        $this->complexen = new ArrayCollection();
        $this->gebouw_types = new ArrayCollection();
    }

    /**
     *
     * @return Complex[]
     */
    public function getComplexen()
    {
        return $this->complexen;
    }

    /**
     *
     * @return integer
     */
    public function getAantalComplexen()
    {
        return $this->aantal_complexen;
    }

    /**
     *
     * @return integer
     */
    public function getAantalGebouwAdressen()
    {
        return $this->aantal_gebouw_adressen;
    }

    /**
     *
     * @return GebouwType[]
     */
    public function getGebouwTypes()
    {
        return $this->gebouw_types;
    }

    /**
     *
     * @return VoorraadOptieSet
     */
    public function getVoorraadOptieSet()
    {
        return $this->voorraad_optie_set;
    }

    /**
     *
     * @var Complex $complex
     * @return void
     */
    public function addComplex(Complex $complex)
    {
        $this->complexen->add($complex);
    }

    /**
     *
     * @var Complex $complex
     * @return void
     */
    public function removeComplex(Complex $complex)
    {
        $this->complexen->removeElement($complex);
    }

    /**
     *
     * param integer $aantal_complexen
     * @return void
     */
    public function setAantalComplexen($aantal_complexen)
    {
        $this->aantal_complexen = $aantal_complexen;
    }

    /**
     *
     * @param integer $aantal_gebouw_adressen
     * @return void
     */
    public function setAantalGebouwAdressen($aantal_gebouw_adressen)
    {
        $this->aantal_gebouw_adressen = $aantal_gebouw_adressen;
    }

    /**
     *
     * @var GebouwType $gebouw_type
     * @return void
     */
    public function addGebouwType(GebouwType $gebouw_type)
    {
        $this->gebouw_types->add($gebouw_type);
    }

    /**
     *
     * @var GebouwType $gebouw_type
     * @return void
     */
    public function removeGebouwType(GebouwType $gebouw_type)
    {
        $this->gebouw_types->removeElement($gebouw_type);
    }

    /**
     *
     * @var VoorraadOptieSet $voorraad_optie_set
     * @return void
     */
    public function setVoorraadOptieSet(VoorraadOptieSet $voorraad_optie_set)
    {
        $this->voorraad_optie_set = $voorraad_optie_set;
    }

}