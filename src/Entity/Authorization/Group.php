<?php

namespace App\Entity\Authorization;

use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\Id;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="AuthorizationGroups")
 *
 * @OA\Schema()
 */
class Group extends Id
{

}