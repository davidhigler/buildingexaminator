<?php

namespace App\Entity\SuperClasses;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\MappedSuperclass
 */
class Id
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     *
     * @OA\Property()
     */
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function objectValuesToArray(): array
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

    public function camelize(string $input, string $separator = '_'): string
    {
        return str_replace($separator, '', ucwords($input, $separator));
    }

}