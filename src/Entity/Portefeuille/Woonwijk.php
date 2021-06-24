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
 * @ORM\Table(name="woonwijken")
 */
class Woonwijk extends IdTimeIdentification
{
    /**
     *
     * @ORM\OneToMany(targetEntity="DobroCm\Objects\Portefeuille\GebouwAdres", mappedBy="woonwijk", fetch="EXTRA_LAZY")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var GebouwAdres[]
     */
    protected $gebouw_adressen;

    /**
     *
     */
    public function __construct()
    {
        $this->gebouw_adressen = new ArrayCollection();
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

}