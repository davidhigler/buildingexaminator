<?php

namespace App\Security\Voters;

use App\Entity\Authentication\User;
use App\Entity\Authorization\OwnerGroup;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use LogicException;

class OwnerGroupVoter extends Voter
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

        if (!$subject instanceof OwnerGroup) {
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

        /** @var OwnerGroup $ownerGroup */
        $ownerGroup = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($ownerGroup, $user),
            self::VIEW => $this->canView($ownerGroup, $user),
            self::EDIT => $this->canEdit($ownerGroup, $user),
            self::DELETE => $this->canDelete($ownerGroup, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(OwnerGroup $ownerGroup, User $user): bool
    {
        return true;
    }

    private function canView(OwnerGroup $ownerGroup, User $user): bool
    {
        return true;
    }

    private function canEdit(OwnerGroup $ownerGroup, User $user): bool
    {
        return true;
    }

    private function canDelete(OwnerGroup $ownerGroup, User $user): bool
    {
        return true;
    }
}