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
 * @ORM\Table(name="complexen")
 */
class Complex extends IdTimeIdentification
{
    /**
     *
     * @ORM\ManyToOne(targetEntity="DobroCm\Objects\Portefeuille\Voorraad", inversedBy="complexen")
     * @ORM\JoinColumn(name="voorraad_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var Voorraad
     */
    protected $voorraad;

    /**
     * @ORM\ManyToMany(targetEntity="DobroCm\Objects\Portefeuille\GebouwAdres", inversedBy="complexen")
     * @ORM\JoinTable(name="link_gebouw_adressen_complexen")
     * @var GebouwAdres[]
     */
    protected $gebouw_adressen;

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
    protected $aantal_gebouw_adressen = 0;

    /**
     * @ORM\OneToMany(targetEntity="DobroCm\Objects\Portefeuille\GebouwSelectie", mappedBy="complex", fetch="EXTRA_LAZY")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var GebouwSelectie[]
     */
    protected $gebouw_selecties;

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
    protected $financieel_nummer;

    /**
     *
     */
    public function __construct()
    {
        $this->gebouw_adressen = new ArrayCollection();
        $this->gebouw_selecties = new ArrayCollection();
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
     * @return GebouwAdres[]
     */
    public function getGebouwAdressen()
    {
        return $this->gebouw_adressen;
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
     * @return GebouwSelectie[]
     */
    public function getGebouwSelecties()
    {
        return $this->gebouw_selecties;
    }

    /**
     *
     * @return string
     */
    public function getFinancieelNummer()
    {
        return $this->financieel_nummer;
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
     * @param GebouwAdres $gebouw_adres
     * @return void
     */
    public function addGebouwAdres(GebouwAdres $gebouw_adres)
    {
        $this->gebouw_adressen->add($gebouw_adres);
    }

    /**
     *
     * @param GebouwAdres $gebouw_adres
     * @return void
     */
    public function removeGebouwAdres(GebouwAdres $gebouw_adres)
    {
        $this->gebouw_adressen->removeElement($gebouw_adres);
    }

    /**
     *
     * param integer $aantal_gebouw_adressen
     * @return void
     */
    public function setAantalGebouwAdressen($aantal_gebouw_adressen)
    {
        $this->aantal_gebouw_adressen = $aantal_gebouw_adressen;
    }

    /**
     *
     * @param GebouwSelectie $gebouw_selectie
     * @return void
     */
    public function addGebouwSelectie(GebouwSelectie $gebouw_selectie)
    {
        $this->gebouw_selecties->add($gebouw_selectie);
    }

    /**
     *
     * @param GebouwSelectie $gebouw_selectie
     * @return void
     */
    public function removeGebouwSelectie(GebouwSelectie $gebouw_selectie)
    {
        $this->gebouw_selecties->removeElement($gebouw_selectie);
    }

    /**
     *
     * @param string $financieel_nummer
     * @return void
     */
    public function setFinancieelNummer($financieel_nummer)
    {
        $this->financieel_nummer = $financieel_nummer;
    }

}