<?php

namespace App\Entity\Portefeuille;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use App\Entity\SuperClasses\IdTimeIdentification;

/**
 *
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="gebouw_selecties")
 */
class GebouwSelectie extends IdTimeIdentification
{
    /**
     *
     * @ORM\ManyToOne(targetEntity="DobroCm\Objects\Portefeuille\Complex", inversedBy="gebouw_selecties")
     * @ORM\JoinColumn(name="complex_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var Complex
     */
    protected $complex;

    /**
     *
     * @ORM\ManyToOne(targetEntity="DobroCm\Objects\Portefeuille\GebouwType", inversedBy="gebouw_selecties")
     * @ORM\JoinColumn(name="gebouw_type_id", referencedColumnName="id")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var Gebouwtype
     */
    protected $gebouw_type;

    /**
     *
     * @ORM\OneToOne(targetEntity="DobroCm\Objects\Portefeuille\GebouwSelectieOptieSet", mappedBy="gebouw_selectie")
     * @Assert\Valid(
     *      deep=true
     * )
     * @var GebouwSelectieOptieSet
     */
    protected $gebouw_selectie_optie_set;

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     *
     * @return Complex
     */
    public function getComplex()
    {
        return $this->complex;
    }

    /**
     *
     * @return Gebouwtype
     */
    public function getGebouwType()
    {
        return $this->gebouw_type;
    }

    /**
     *
     * @return GebouwSelectieOptieSet
     */
    public function getGebouwSelectieOptieSet()
    {
        return $this->gebouw_selectie_optie_set;
    }

    /**
     *
     * @param Complex $complex
     * @return void
     */
    public function setComplex(Complex $complex)
    {
        $this->complex = $complex;
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
     * @param GebouwSelectieOptieSet $gebouw_selectie_optie_set
     * @return void
     */
    public function setGebouwSelectieOptieSet(GebouwSelectieOptieSet $gebouw_selectie_optie_set)
    {
        $this->gebouw_selectie_optie_set = $gebouw_selectie_optie_set;
    }

}