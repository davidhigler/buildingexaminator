<?php

namespace App\Security\Voters;

use App\Entity\Authentication\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use LogicException;

class UserVoter
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
        return false;
    }

    private function canView(User $subjectUser, User $user): bool
    {
        return false;
    }

    private function canEdit(User $subjectUser, User $user): bool
    {
        return false;
    }

    private function canDelete(User $subjectUser, User $user): bool
    {
        return false;
    }

}