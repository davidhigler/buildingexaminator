<?php

namespace App\Entity\Portfolio;

use App\Entity\SuperClasses\IdBagIds;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="PortfolioPublicSpace")
 *
 * @OA\Schema()
 */
class PublicSpace extends IdBagIds
{
    /**
     * @ORM\Column(type="string", length=80, nullable=false)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The name is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=80,
     *      maxMessage="The name can contain a maximum of %limit% characters"
     * )
     *
     * @OA\Property()
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=40, nullable=false)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The type is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      max=40,
     *      maxMessage="The type can contain a maximum of %limit% characters"
     * )
     *
     * @OA\Property()
     */
    private string $type;

    #[Pure]
    public function __construct()
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}