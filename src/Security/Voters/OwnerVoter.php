<?php

namespace App\Security\Voters;

use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\User;
use App\Entity\Authorization\Owner;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class OwnerVoter extends Voter
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

        return $subject instanceof Owner;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Owner $owner */
        $owner = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($user),
            self::VIEW => $this->canView($owner, $user),
            self::EDIT => $this->canEdit($owner, $user),
            self::DELETE => $this->canDelete($user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(User $user): bool
    {
        return $user::class === User::class;
    }

    private function canView(Owner $owner, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        return $user::class === OwnerUser::class
        && $user->getOwner()->getId() === $owner->getId();
    }

    private function canEdit(Owner $owner, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        return $user::class === OwnerUser::class
        && $user->getOwner()->getId() === $owner->getId()
        && in_array('ROLE_ADMIN', $user->getRoles(), true);
    }

    private function canDelete(User $user): bool
    {
        return $user::class === User::class;
    }
}