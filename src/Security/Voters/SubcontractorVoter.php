<?php

namespace App\Security\Voters;

use App\Entity\Authentication\User;
use App\Entity\Authorization\Contractor;
use App\Entity\Authorization\Owner;
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

        if (!$subject instanceof Subcontractor) {
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

    /** @TODO Fill in this function */
    private function canCreate(Subcontractor $contractor, User $user): bool
    {
        return false;
    }

    /** @TODO Fill in this function */
    private function canView(Subcontractor $contractor, User $user): bool
    {
        return false;
    }

    /** @TODO Fill in this function */
    private function canEdit(Subcontractor $contractor, User $user): bool
    {
        return false;
    }

    /** @TODO Fill in this function */
    private function canDelete(Subcontractor $contractor, User $user): bool
    {
        return false;
    }
}