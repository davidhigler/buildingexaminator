<?php

namespace App\Entity\Images;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\SuperClasses\IdTime;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'ImagesDetails')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Detail extends IdTime
{

}