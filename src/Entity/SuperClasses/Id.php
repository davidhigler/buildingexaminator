<?php

namespace App\Entity\SuperClasses;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\MappedSuperclass
 */
class Id
{
    /**
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @param integer $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @return array
     */
    public function objectValuesToArray()
    {
        $result = array();
        foreach ($this as $property => $value) {
            $getter = 'get' . $this->camelize($property);
            if (method_exists($this, $getter)) {
                $result[$property] = $this->$getter();
            }
        }
        return $result;
    }

    /**
     *
     * @param string $input
     * @param string $separator
     * @return string
     */
    public function camelize($input, $separator = '_')
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }

}