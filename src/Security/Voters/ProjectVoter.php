<?php

namespace App\Security\Voters;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Strategies\Project;
use Doctrine\Common\Collections\ArrayCollection;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ProjectVoter extends Voter
{
    const CREATE = 'create';
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    protected function supports(string $attribute, $subject): bool
    {
        if (
            !in_array(
                $attribute,
                [
                    self::CREATE,
                    self::VIEW,
                    self::EDIT,
                    self::DELETE
                ]
            )
        ) {
            return false;
        }
        return $subject instanceof Project;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Project $project */
        $project = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($project, $user),
            self::VIEW => $this->canView($project, $user),
            self::EDIT => $this->canEdit($project, $user),
            self::DELETE => $this->canDelete($project, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(Project $project, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($project->getHousingStock())) {
                return true;
            }
        }

        return false;
    }

    private function canView(Project $project, User $user): bool
    {
        return match ($user::class) {
            SubContractorUser::class => $this->canSubContractorView($project, $user),
            ContractorUser::class => $this->canContractorView($project, $user),
            OwnerUser::class => $this->canOwnerView($project, $user),
            User::class => true,
            default => false,
        };
    }

    private function canSubContractorView(Project $project, SubcontractorUser $user): bool
    {
        $projects = $user->getSubcontractor()->getProjects();
        return $projects->contains($project);
    }

    private function canContractorView(Project $project, ContractorUser $user): bool
    {
        $projects = $user->getContractor()->getProjects();
        return $projects->contains($project);
    }

    private function canOwnerView(Project $project, OwnerUser $user): bool
    {
        $housingStocks = $user->getOwner()->getHousingStocks();

        $userAccessibleProjects = new ArrayCollection();

        /** @var HousingStock $housingStock */
        foreach ($housingStocks as $housingStock) {
            foreach ($housingStock->getProjects() as $project) {
                $userAccessibleProjects->add($project);
            }
        }
        return $userAccessibleProjects->contains($project);
    }

    private function canEdit(Project $project, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($project->getHousingStock())) {
                return true;
            }
        }

        return false;
    }

    private function canDelete(Project $project, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($project->getHousingStock())) {
                return true;
            }
        }

        return false;
    }
}