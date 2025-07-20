<?php

declare(strict_types=1);

namespace App\Entity\Authorization;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Strategies\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use JetBrains\PhpStorm\Pure;
use OpenApi\Attributes as OA;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\SuperClasses\IdCodeName;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'AuthorizationContractors')]
#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
#[OA\Schema]
class Contractor extends IdCodeName
{
    #[ORM\OneToMany(targetEntity: ContractorUser::class, mappedBy: 'contractor', cascade: ['remove'])]
    #[OA\Property(ref: '#/components/schemas/ids')]
    protected Collection $contractorUsers;

    #[ORM\ManyToMany(targetEntity: Project::class, mappedBy: 'contractors', cascade: ['remove'], fetch: 'EXTRA_LAZY')]
    #[OA\Property(ref: '#/components/schemas/projects')]
    protected Collection $projects;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER, length: 8, nullable: true)]
    #[Assert\Type(type: 'integer', message: 'The KVK number is not a valid {{ type }}')]
    #[Assert\Length(min: 8, max: 8, exactMessage: 'The KVK number must be exactly {{ limit }} characters long')]
    #[OA\Property]
    protected int $kvk;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 14, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The BTW number is not a valid {{ type }}')]
    #[Assert\Length(min: 14, max: 14, exactMessage: 'The BTW number must be exactly {{ limit }} characters long')]
    #[OA\Property]
    protected string $btw;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 256, nullable: true)]
    #[Assert\Type(type: 'string', message: 'The website is not a valid {{ type }}')]
    #[Assert\Length(min: 8, max: 256, minMessage: 'The website must be at least {{ limit }} characters long', maxMessage: 'The website can contain a maximum of {{ limit }} characters')]
    #[Assert\Url(message: "The website '{{ value }}' is not a valid url", protocols: ['https'])]
    #[OA\Property]
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
