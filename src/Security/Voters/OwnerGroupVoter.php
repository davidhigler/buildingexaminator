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

        return match($attribute) {
            self::CREATE => $this->canCreate(),
            self::VIEW => $this->canView(),
            self::EDIT => $this->canEdit(),
            self::DELETE => $this->canDelete(),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(): bool
    {
        return true;
    }

    private function canView(): bool
    {
        return true;
    }

    private function canEdit(): bool
    {
        return true;
    }

    private function canDelete(): bool
    {
        return true;
    }
}