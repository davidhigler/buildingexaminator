<?php

namespace App\Entity\Images;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\SuperClasses\IdTime;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="ImagesFacades")
 *
 * @OA\Schema()
 */
class Facade extends IdTime
{

}