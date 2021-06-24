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
 * @ORM\Table(name="gebouw_selectie_optie_sets")
 */
class GebouwSelectieOptieSet extends Id
{

    /**
     *
     * @ORM\OneToOne(targetEntity="DobroCm\Objects\Portefeuille\GebouwSelectie", inversedBy="gebouw_selectie_optie_set")
     * @ORM\JoinColumn(name="gebouw_selectie_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var GebouwSelectie
     */
    protected $gebouw_selectie;

    /**
     *
     * @return GebouwSelectie
     */
    public function getGebouwSelectie()
    {
        return $this->gebouw_selectie;
    }

    /**
     *
     * @param GebouwSelectie $gebouw_selectie
     * @return void
     */
    public function setGebouwSelectie(GebouwSelectie $gebouw_selectie)
    {
        $this->gebouw_selectie = $gebouw_selectie;
    }

}