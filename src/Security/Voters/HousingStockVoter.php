<?php

namespace App\Security\Voters;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Strategies\Project;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class HousingStockVoter extends Voter
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

        return $subject instanceof HousingStock;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var HousingStock $housingStock */
        $housingStock = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($user),
            self::VIEW => $this->canView($housingStock, $user),
            self::EDIT => $this->canEdit($user),
            self::DELETE => $this->canDelete($user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(User $user): bool
    {
        return $user::class === User::class;
    }

    private function canView(HousingStock $housingStock, User $user): bool
    {
        return match ($user::class) {
            SubContractorUser::class => $this->canSubContractorView($housingStock, $user),
            ContractorUser::class => $this->canContractorView($housingStock, $user),
            OwnerUser::class => $this->canOwnerView($housingStock, $user),
            User::class => true,
            default => false,
        };
    }

    private function canSubContractorView(HousingStock $housingStock, SubContractorUser $subContractorUser): bool
    {
        foreach ($housingStock->getProjects() as $project) {
            /** @var Project $project */
            if (
                $subContractorUser->getSubcontractor()->getProjects()->exists(fn($key, $subcontractorProject) =>
                    /** @var Project $subcontractorProject */
                    $subcontractorProject->equals($project))
            ) {
                return true;
            }
        }

        return false;
    }

    private function canContractorView(HousingStock $housingStock, ContractorUser $contractorUser): bool
    {
        foreach ($housingStock->getProjects() as $project) {
            /** @var Project $project */
            if (
                $contractorUser->getContractor()->getProjects()->exists(fn($key, $contractorProject) =>
                    /** @var Project $contractorProject */
                    $contractorProject->equals($project))
            ) {
                return true;
            }
        }

        return false;
    }

    private function canOwnerView(HousingStock $housingStock, OwnerUser $ownerUser): bool
    {
        return $housingStock->getOwner()->equals($ownerUser->getOwner());
    }

    private function canEdit(User $user): bool
    {
        return $user::class === User::class;
    }

    private function canDelete(User $user): bool
    {
        return $user::class === User::class;
    }
}