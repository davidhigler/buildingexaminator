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
 * @ORM\Table(name="gebouw_typen")
 */
class GebouwType extends IdTimeIdentification
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
     * @ORM\OneToMany(targetEntity="DobroCm\Objects\Portefeuille\GebouwAdres", mappedBy="gebouw_type", fetch="EXTRA_LAZY")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var GebouwAdres[]
     */
    protected $gebouw_adressen;

    /**
     *
     * @ORM\OneToMany(targetEntity="DobroCm\Objects\Portefeuille\GebouwSelectie", mappedBy="gebouw_type", fetch="EXTRA_LAZY")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var GebouwSelectie[]
     */
    protected $gebouw_selecties;

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
     * @return GebouwSelectie[]
     */
    public function getGebouwSelecties()
    {
        return $this->gebouw_selecties;
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

}