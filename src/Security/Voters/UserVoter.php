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

        if (!$subject instanceof User) {
            return false;
        }

        return true;
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
        if (get_class($user) === User::class) {
            return true;
        }

        if (
            get_class($user) === OwnerUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                get_class($subjectUser) === OwnerUser::class
                || get_class($subjectUser) === ContractorUser::class
            )
        ) {
            return true;
        }

        if (
            get_class($user) === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                get_class($subjectUser) === ContractorUser::class
                || get_class($subjectUser) === SubcontractorUser::class
            )
        ) {
            return true;
        }

        if (
            get_class($user) === SubcontractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && get_class($subjectUser) === SubcontractorUser::class
        ) {
            return true;
        }

        return false;
    }

    private function canView(User $subjectUser, User $user): bool
    {
        if (get_class($user) === User::class) {
            return true;
        }

        if (
            get_class($user) === OwnerUser::class
            && (
                get_class($subjectUser) === OwnerUser::class
                || get_class($subjectUser) === ContractorUser::class
            )
        ) {
            return true;
        }

        if (
            get_class($user) === ContractorUser::class
            && (
                get_class($subjectUser) === ContractorUser::class
                || get_class($subjectUser) === SubcontractorUser::class
            )
        ) {
            return true;
        }

        if (
            get_class($user) === SubcontractorUser::class
            && get_class($subjectUser) === SubcontractorUser::class
        ) {
            return true;
        }

        return false;
    }

    private function canEdit(User $subjectUser, User $user): bool
    {
        if (get_class($user) === User::class) {
            return true;
        }

        if (
            get_class($user) === OwnerUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                get_class($subjectUser) === OwnerUser::class
                || get_class($subjectUser) === ContractorUser::class
            )
        ) {
            return true;
        }

        if (
            get_class($user) === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                get_class($subjectUser) === ContractorUser::class
                || get_class($subjectUser) === SubcontractorUser::class
            )
        ) {
            return true;
        }

        if (
            get_class($user) === SubcontractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && get_class($subjectUser) === SubcontractorUser::class
        ) {
            return true;
        }

        return false;
    }

    private function canDelete(User $subjectUser, User $user): bool
    {
        if (get_class($user) === User::class) {
            return true;
        }

        if (
            get_class($user) === OwnerUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                get_class($subjectUser) === OwnerUser::class
                || get_class($subjectUser) === ContractorUser::class
            )
        ) {
            return true;
        }

        if (
            get_class($user) === ContractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && (
                get_class($subjectUser) === ContractorUser::class
                || get_class($subjectUser) === SubcontractorUser::class
            )
        ) {
            return true;
        }

        if (
            get_class($user) === SubcontractorUser::class
            && in_array('ROLE_ADMIN', $user->getRoles(), true)
            && get_class($subjectUser) === SubcontractorUser::class
        ) {
            return true;
        }

        return false;
    }

}