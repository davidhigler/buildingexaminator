<?php

declare(strict_types=1);

namespace App\Entity\Images;

use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\SuperClasses\IdTime;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'ImagesFloorPlans')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class FloorPlan extends IdTime
{

}
