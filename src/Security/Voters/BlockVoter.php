<?php

namespace App\Security\Voters;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use App\Entity\Portfolio\Block;
use App\Entity\Strategies\Project;
use Doctrine\Common\Collections\ArrayCollection;
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

        return $subject instanceof Block;
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
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($block->getHousingStock())) {
                return true;
            }
        }

        return false;
    }

    private function canView(Block $block, User $user): bool
    {
        return match ($user::class) {
            SubContractorUser::class => $this->canSubContractorView($block, $user),
            ContractorUser::class => $this->canContractorView($block, $user),
            OwnerUser::class => $this->canOwnerView($block, $user),
            User::class => true,
            default => false,
        };
    }

    private function canSubContractorView(Block $block, SubcontractorUser $user): bool
    {
        $projects = $user->getSubcontractor()->getProjects();

        $userAccessibleAddresses = new ArrayCollection();

        /** @var Project $project */
        foreach ($projects as $project) {
            $projectAddresses = $project->getAddresses();
            foreach ($projectAddresses as $projectAddress) {
                $userAccessibleAddresses->add($projectAddress);
            }
        }

        foreach ($block->getAddresses() as $address) {
            if ($userAccessibleAddresses->contains($address)) {
                return true;
            }
        }

        return false;
    }

    private function canContractorView(Block $block, ContractorUser $user): bool
    {
        $projects = $user->getContractor()->getProjects();

        $userAccessibleAddresses = new ArrayCollection();

        /** @var Project $project */
        foreach ($projects as $project) {
            $projectAddresses = $project->getAddresses();
            foreach ($projectAddresses as $projectAddress) {
                $userAccessibleAddresses->add($projectAddress);
            }
        }

        foreach ($block->getAddresses() as $address) {
            if ($userAccessibleAddresses->contains($address)) {
                return true;
            }
        }

        return false;
    }

    private function canOwnerView(Block $block, OwnerUser $user): bool
    {
        return $block->getHousingStock()->getOwner()->equals($user->getOwner());
    }

    private function canEdit(Block $block, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($block->getHousingStock())) {
                return true;
            }
        }

        return false;
    }

    private function canDelete(Block $block, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($block->getHousingStock())) {
                return true;
            }
        }

        return false;
    }
}