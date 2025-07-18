<?php

namespace App\Security\Voters;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\User;
use App\Entity\Authorization\Contractor;
use App\Entity\Strategies\Project;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ContractorVoter extends Voter
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
        return $subject instanceof Contractor;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Contractor $contractor */
        $contractor = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($contractor, $user),
            self::VIEW => $this->canView($contractor, $user),
            self::EDIT => $this->canEdit($contractor, $user),
            self::DELETE => $this->canDelete($contractor, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(Contractor $contractor, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            /** @var Project $project */
            foreach ($contractor->getProjects() as $project) {
                if (!$accessibleHousingStocks->contains($project->getHousingStock())) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    private function canView(Contractor $contractor, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            /** @var Project $project */
            foreach ($contractor->getProjects() as $project) {
                if ($accessibleHousingStocks->contains($project->getHousingStock())) {
                    return true;
                }
            }
        }
        return $user::class === ContractorUser::class
        && $user->getContractor()->getId() === $contractor->getId();
    }

    private function canEdit(Contractor $contractor, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            /** @var Project $project */
            foreach ($contractor->getProjects() as $project) {
                if ($accessibleHousingStocks->contains($project->getHousingStock())) {
                    return true;
                }
            }
        }
        return $user::class === ContractorUser::class
        && $user->getContractor()->getId() === $contractor->getId()
        && in_array('ROLE_ADMIN', $user->getRoles(), true);
    }

    private function canDelete(Contractor $contractor, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            /** @var Project $project */
            foreach ($contractor->getProjects() as $project) {
                if ($accessibleHousingStocks->contains($project->getHousingStock())) {
                    return true;
                }
            }
        }

        return false;
    }
}