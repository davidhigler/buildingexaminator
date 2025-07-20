<?php

declare(strict_types=1);

namespace App\Security\Voters;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use App\Entity\Portfolio\Address;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Strategies\Project;
use Doctrine\Common\Collections\ArrayCollection;
use LogicException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class AddressVoter extends Voter
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

        return $subject instanceof Address;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        /** @var Address $address */
        $address = $subject;

        return match($attribute) {
            self::CREATE => $this->canCreate($address, $user),
            self::VIEW => $this->canView($address, $user),
            self::EDIT => $this->canEdit($address, $user),
            self::DELETE => $this->canDelete($address, $user),
            default => throw new LogicException('This code should not be reached!')
        };
    }

    private function canCreate(Address $address, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($address->getHousingStock())) {
                return true;
            }
        }

        return false;
    }

    private function canView(Address $address, User $user): bool
    {
        return match ($user::class) {
            SubContractorUser::class => $this->canSubContractorView($address, $user),
            ContractorUser::class => $this->canContractorView($address, $user),
            OwnerUser::class => $this->canOwnerView($address, $user),
            User::class => true,
            default => false,
        };
    }

    private function canSubContractorView(Address $address, SubcontractorUser $subcontractorUser): bool
    {
        $projects = $subcontractorUser->getSubcontractor()->getProjects();

        $userAccessibleAddresses = new ArrayCollection();

        /** @var Project $project */
        foreach ($projects as $project) {
            $projectAddresses = $project->getAddresses();
            foreach ($projectAddresses as $projectAddress) {
                $userAccessibleAddresses->add($projectAddress);
            }
        }

        return $userAccessibleAddresses->contains($address);
    }

    private function canContractorView(Address $address, ContractorUser $contractorUser): bool
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

        return $userAccessibleAddresses->contains($address);
    }

    private function canOwnerView(Address $address, OwnerUser $ownerUser): bool
    {
        $accessibleHousingStocks = $ownerUser->getOwner()->getHousingStocks();

        /** @var HousingStock $accessibleHousingStock */
        foreach ($accessibleHousingStocks as $accessibleHousingStock) {
            if ($accessibleHousingStock->getAddresses()->contains($address)) {
                return true;
            }
        }

        return false;
    }

    private function canEdit(Address $address, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($address->getHousingStock())) {
                return true;
            }
        }

        return false;
    }

    private function canDelete(Address $address, User $user): bool
    {
        if ($user::class === User::class) {
            return true;
        }

        if ($user::class === OwnerUser::class) {
            $accessibleHousingStocks = $user->getOwner()->getHousingStocks();

            if ($accessibleHousingStocks->contains($address->getHousingStock())) {
                return true;
            }
        }

        return false;
    }
}
