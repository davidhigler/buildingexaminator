<?php

namespace App\Security\Voters;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\User;
use App\Entity\Authorization\Subcontractor;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class SubcontractorVoter extends Voter
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
        return $subject instanceof Subcontractor;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Subcontractor $subcontractor */
        $subcontractor = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($subcontractor, $user),
            self::VIEW => $this->canView($subcontractor, $user),
            self::EDIT => $this->canEdit($subcontractor, $user),
            self::DELETE => $this->canDelete($subcontractor, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(Subcontractor $subcontractor, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if (
            $user::class === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
        ) {
            $accesibleProjects = $user->getContractor()->getProjects();
            foreach ($subcontractor->getProjects() as $project) {
                if (!$accesibleProjects->contains($project)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    private function canView(Subcontractor $subcontractor, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === ContractorUser::class) {
            $accesibleProjects = $user->getContractor()->getProjects();
            foreach ($subcontractor->getProjects() as $project) {
                if ($accesibleProjects->contains($project)) {
                    return true;
                }
            }
        }

        return false;
    }

    private function canEdit(Subcontractor $subcontractor, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if (
            $user::class === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
        ) {
            $accesibleProjects = $user->getContractor()->getProjects();
            foreach ($subcontractor->getProjects() as $project) {
                if ($accesibleProjects->contains($project)) {
                    return true;
                }
            }
        }

        return false;
    }

    private function canDelete(Subcontractor $subcontractor, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if (
            $user::class === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
        ) {
            $accesibleProjects = $user->getContractor()->getProjects();
            foreach ($subcontractor->getProjects() as $project) {
                if (!$accesibleProjects->contains($project)) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }
}