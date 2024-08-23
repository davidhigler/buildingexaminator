<?php

namespace App\Entity\Authorization;

use App\Entity\Authentication\ContractorUser;
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
 *
 * @OA\Schema()
 */
#[ORM\Table(name: 'AuthorizationContractors')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class Contractor extends IdCodeName
{
    /**
     * @OA\Property(ref="#/components/schemas/ids")
     */
    #[ORM\OneToMany(targetEntity: \App\Entity\Authentication\ContractorUser::class, mappedBy: 'contractor', cascade: ['remove'])]
    protected Collection $contractorUsers;

    /**
     * @OA\Property(ref="#/components/schemas/projects")
     */
    #[ORM\ManyToMany(targetEntity: \App\Entity\Strategies\Project::class, mappedBy: 'contractors', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    protected Collection $projects;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'integer', length: 8, nullable: true)]
    #[Assert\Type(type: 'integer', message: 'The KVK number is not a valid {{ type }}')]
    #[Assert\Length(min: 8, max: 8, exactMessage: 'The KVK number must be exactly {{ limit }} characters long')]
    protected int $kvk;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'string', length: 14, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The BTW number is not a valid {{ type }}')]
    #[Assert\Length(min: 14, max: 14, exactMessage: 'The BTW number must be exactly {{ limit }} characters long')]
    protected string $btw;

    /**
     *
     *
     * @OA\Property()
     */
    #[ORM\Column(type: 'string', length: 256, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The website is not a valid {{ type }}')]
    #[Assert\Length(min: 8, max: 256, minMessage: 'The website must be at least {{ limit }} characters long', maxMessage: 'The website can contain a maximum of {{ limit }} characters')]
    #[Assert\Url(protocols: ['https'], message: "The website '{{ value }}' is not a valid url")]
    protected string $website;

    #[Pure]
    public function __construct()
    {
        $this->contractorUsers = new ArrayCollection();
        $this->projects = new ArrayCollection();
    }

    public function getContractorUsers(): Collection
    {
        return $this->contractorUsers;
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

    public function addContractorUser(ContractorUser $contractorUser): void
    {
        $this->contractorUsers->add($contractorUser);
    }

    public function removeContractorUser(ContractorUser $contractorUser): void
    {
        $this->contractorUsers->removeElement($contractorUser);
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