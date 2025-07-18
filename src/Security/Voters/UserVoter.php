<?php

namespace App\Security\Voters;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use LogicException;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
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
        return $subject instanceof User;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var User $subjectUser */
        $subjectUser = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($subjectUser, $user),
            self::VIEW => $this->canView($subjectUser, $user),
            self::EDIT => $this->canEdit($subjectUser, $user),
            self::DELETE => $this->canDelete($subjectUser, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(User $subjectUser, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if (
            $user::class === OwnerUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                $subjectUser::class === OwnerUser::class
                || $subjectUser::class === ContractorUser::class
            )
        ) {
            return true;
        }

        if (
            $user::class === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                $subjectUser::class === ContractorUser::class
                || $subjectUser::class === SubcontractorUser::class
            )
        ) {
            return true;
        }
        return $user::class === SubcontractorUser::class
        && in_array('ROLE_ADMIN', $user->getRoles(), true)
        && $subjectUser::class === SubcontractorUser::class;
    }

    private function canView(User $subjectUser, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if (
            $user::class === OwnerUser::class
            && (
                $subjectUser::class === OwnerUser::class
                || $subjectUser::class === ContractorUser::class
            )
        ) {
            return true;
        }

        if (
            $user::class === ContractorUser::class
            && (
                $subjectUser::class === ContractorUser::class
                || $subjectUser::class === SubcontractorUser::class
            )
        ) {
            return true;
        }
        return $user::class === SubcontractorUser::class
        && $subjectUser::class === SubcontractorUser::class;
    }

    private function canEdit(User $subjectUser, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if (
            $user::class === OwnerUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                $subjectUser::class === OwnerUser::class
                || $subjectUser::class === ContractorUser::class
            )
        ) {
            return true;
        }

        if (
            $user::class === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                $subjectUser::class === ContractorUser::class
                || $subjectUser::class === SubcontractorUser::class
            )
        ) {
            return true;
        }
        return $user::class === SubcontractorUser::class
        && in_array('ROLE_ADMIN', $user->getRoles(), true)
        && $subjectUser::class === SubcontractorUser::class;
    }

    private function canDelete(User $subjectUser, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if (
            $user::class === OwnerUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                $subjectUser::class === OwnerUser::class
                || $subjectUser::class === ContractorUser::class
            )
        ) {
            return true;
        }

        if (
            $user::class === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                $subjectUser::class === ContractorUser::class
                || $subjectUser::class === SubcontractorUser::class
            )
        ) {
            return true;
        }
        return $user::class === SubcontractorUser::class
        && in_array('ROLE_ADMIN', $user->getRoles(), true)
        && $subjectUser::class === SubcontractorUser::class;
    }

}