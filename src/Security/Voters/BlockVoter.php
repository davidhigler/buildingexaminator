<?php

namespace App\Security\Voters;

use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\User;
use App\Entity\Portfolio\Block;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BlockVoter extends Voter
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

        if (!$subject instanceof Block) {
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

        /** @var Block $block */
        $block = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($block, $user),
            self::VIEW => $this->canView($block, $user),
            self::EDIT => $this->canEdit($block, $user),
            self::DELETE => $this->canDelete($block, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(Block $block, User $user): bool
    {
        if (
            get_class($user) === User::class
            || get_class($user) === OwnerUser::class
        ) {
            return true;
        }

        return false;
    }

    private function canView(Block $block, User $user): bool
    {
        return false;
    }

    private function canEdit(Block $block, User $user): bool
    {
        if (
            get_class($user) === User::class
            || get_class($user) === OwnerUser::class
        ) {
            return true;
        }

        return false;
    }

    private function canDelete(Block $block, User $user): bool
    {
        if (
            get_class($user) === User::class
            || get_class($user) === OwnerUser::class
        ) {
            return true;
        }

        return false;
    }
}