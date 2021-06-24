<?php

namespace App\Entity\SuperClasses;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\MappedSuperclass
 */
class IdTime extends Id
{

    /**
     *
     * @ORM\column(type="datetimetz")
     * @Assert\Type(
     *     type="object",
     *     message="%property% is not a valid %type%"
     * )
     * @var \DateTime
     */
    protected $tijdstip_aanmaak;

    /**
     *
     * @ORM\column(type="datetimetz")
     * @Assert\Type(
     *     type="object",
     *     message="%property% is not a valid %type%"
     * )
     * @var \DateTime
     */
    protected $tijdstip_laatste_wijziging;

    /**
     *
     * @return \DateTime
     */
    public function getTijdstipAanmaak()
    {
        return $this->tijdstip_aanmaak;
    }

    /**
     *
     * @return \DateTime
     */
    public function getTijdstipLaatsteWijziging()
    {
        return $this->tijdstip_laatste_wijziging;
    }

    /**
     *
     * @return void
     */
    public function setTijdstipAanmaak()
    {
        $this->tijdstip_aanmaak = new \DateTime;
    }

    /**
     *
     * @ORM\PreUpdate
     * @return void
     */
    public function setTijdstipLaatsteWijziging()
    {
        $this->tijdstip_laatste_wijziging = new \DateTime;
    }

}