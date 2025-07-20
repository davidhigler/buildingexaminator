<?php

declare(strict_types=1);

namespace App\Security\Voters;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Strategies\Project;
use Doctrine\Common\Collections\ArrayCollection;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class BuildingTypeVoter extends Voter
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

        return $subject instanceof BuildingType;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var BuildingType $buildingType */
        $buildingType = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($buildingType, $user),
            self::VIEW => $this->canView($buildingType, $user),
            self::EDIT => $this->canEdit($buildingType, $user),
            self::DELETE => $this->canDelete($buildingType, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(BuildingType $buildingType, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($buildingType->getHousingStock())) {
                return true;
            }
        }

        return false;
    }

    private function canView(BuildingType $buildingType, User $user): bool
    {
        return match ($user::class) {
            SubContractorUser::class => $this->canSubContractorView($buildingType, $user),
            ContractorUser::class => $this->canContractorView($buildingType, $user),
            OwnerUser::class => $this->canOwnerView($buildingType, $user),
            User::class => true,
            default => false,
        };
    }

    private function canSubContractorView(BuildingType $buildingType, SubContractorUser $subContractorUser): bool
    {
        $projects = $subContractorUser->getSubcontractor()->getProjects();

        $userAccessibleAddresses = new ArrayCollection();

        /** @var Project $project */
        foreach ($projects as $project) {
            $projectAddresses = $project->getAddresses();
            foreach ($projectAddresses as $projectAddress) {
                $userAccessibleAddresses->add($projectAddress);
            }
        }

        foreach ($buildingType->getAddresses() as $address) {
            if ($userAccessibleAddresses->contains($address)) {
                return true;
            }
        }

        return false;
    }

    private function canContractorView(BuildingType $buildingType, ContractorUser $contractorUser): bool
    {
        $projects = $contractorUser->getContractor()->getProjects();

        $userAccessibleAddresses = new ArrayCollection();

        /** @var Project $project */
        foreach ($projects as $project) {
            $projectAddresses = $project->getAddresses();
            foreach ($projectAddresses as $projectAddress) {
                $userAccessibleAddresses->add($projectAddress);
            }
        }

        foreach ($buildingType->getAddresses() as $address) {
            if ($userAccessibleAddresses->contains($address)) {
                return true;
            }
        }

        return false;
    }

    private function canOwnerView(BuildingType $buildingType, OwnerUser $ownerUser): bool
    {
        return $buildingType->getHousingStock()->getOwner()->equals($ownerUser->getOwner());
    }

    private function canEdit(BuildingType $buildingType, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($buildingType->getHousingStock())) {
                return true;
            }
        }

        return false;
    }

    private function canDelete(BuildingType $buildingType, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($buildingType->getHousingStock())) {
                return true;
            }
        }

        return false;
    }
}
