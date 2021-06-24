<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\Id;

/**
 *
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="voorraad_optie_sets")
 */
class VoorraadOptieSet extends Id
{

    /**
     *
     * @ORM\OneToOne(targetEntity="DobroCm\Objects\Portefeuille\Voorraad", inversedBy="voorraad_optie_set")
     * @ORM\JoinColumn(name="voorraad_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var Voorraad
     */
    protected $voorraad;

    /**
     *
     */
    public function __construct()
    {

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
     * @param Voorraad $voorraad
     * @return void
     */
    public function setVoorraad(Voorraad $voorraad)
    {
        $this->voorraad = $voorraad;
    }

}