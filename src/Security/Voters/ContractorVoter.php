<?php

namespace App\Security\Voters;

use App\Entity\Authentication\User;
use App\Entity\Authorization\Contractor;
use App\Entity\Authorization\Owner;
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

        if (!$subject instanceof Contractor) {
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

    /** @TODO Fill in this function */
    private function canCreate(Contractor $contractor, User $user): bool
    {
        return false;
    }

    /** @TODO Fill in this function */
    private function canView(Contractor $contractor, User $user): bool
    {
        return false;
    }

    /** @TODO Fill in this function */
    private function canEdit(Contractor $contractor, User $user): bool
    {
        return false;
    }

    /** @TODO Fill in this function */
    private function canDelete(Contractor $contractor, User $user): bool
    {
        return false;
    }
}