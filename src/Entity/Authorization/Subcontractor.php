<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Strategies\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\IdCodeName;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="AuthorizationSubcontractors")
 *
 * @OA\Schema()
 */
class Subcontractor extends IdCodeName
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Authentication\SubcontractorUser", mappedBy="subcontractor", cascade={"remove"})
     *
     * @OA\Property(ref="#/components/schemas/ids")
     */
    protected Collection $subcontractorUsers;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Strategies\Project", mappedBy="subcontractors", cascade={"remove"}, fetch="EXTRA_LAZY")
     *
     * @OA\Property(ref="#/components/schemas/projects")
     */
    protected Collection $projects;

    /**
     * @ORM\Column(type="integer", length=8, nullable=true)
     *
     * @Assert\Type(
     *     type="integer",
     *     message="The KVK number is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *     min=8,
     *     max=8,
     *     exactMessage="The KVK number must be exactly {{ limit }} characters long"
     * )
     *
     * @OA\Property()
     */
    protected int $kvk;

    /**
     * @ORM\Column(type="string", length=14, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The BTW number is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *     min=14,
     *     max=14,
     *     exactMessage="The BTW number must be exactly {{ limit }} characters long"
     * )
     *
     * @OA\Property()
     */
    protected string $btw;

    /**
     * @ORM\Column(type="string", length=256, nullable=true)
     *
     * @Assert\Type(
     *     type="string",
     *     message="The website is not a valid {{ type }}"
     * )
     * @Assert\Length(
     *      min=8,
     *      max=256,
     *      minMessage="The website must be at least {{ limit }} characters long",
     *      maxMessage="The website can contain a maximum of {{ limit }} characters"
     * )
     * @Assert\Url(
     *      protocols = {"https"},
     *      message = "The website '{{ value }}' is not a valid url"
     * )
     *
     * @OA\Property()
     */
    protected string $website;

    #[Pure]
    public function __construct()
    {
        $this->subcontractorUsers = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getSubcontractorUsers(): Collection
    {
        return $this->subcontractorUsers;
    }

    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function getKvk(): int
    {
        return $this->kvk;
    }

    public function getBtw(): string
    {
        return $this->btw;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function addSubcontractorUser(SubcontractorUser $subcontractorUser): void
    {
        $this->subcontractorUsers->add($subcontractorUser);
    }

    public function removeSubcontractorUser(SubcontractorUser $subcontractorUser): void
    {
        $this->subcontractorUsers->removeElement($subcontractorUser);
    }

    public function addProject(Project $project): void
    {
        $this->projects->add($project);
    }

    public function removeProject(Project $project): void
    {
        $this->projects->removeElement($project);
    }

    public function setKvk(int $kvk): void
    {
        $this->kvk = $kvk;
    }

    public function setBtw(string $btw): void
    {
        $this->btw = $btw;
    }

    public function setWebsite(string $website): void
    {
        $this->website = $website;
    }
}