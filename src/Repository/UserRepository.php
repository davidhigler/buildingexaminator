<?php

namespace App\Repository;

use App\Entity\Authentication\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @extends \Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository<\App\Entity\Authentication\User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $managerRegistry)
    {
        parent::__construct($managerRegistry, User::class);
    }

    public function add(User $user, bool $flush = true): void
    {
        $this->_em->persist($user);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function remove(User $user, bool $flush = true): void
    {
        $this->_em->remove($user);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $passwordAuthenticatedUser, string $newHashedPassword): void
    {
        if (!$passwordAuthenticatedUser instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $passwordAuthenticatedUser::class));
        }

        $passwordAuthenticatedUser->setPassword($newHashedPassword);
        $this->_em->persist($passwordAuthenticatedUser);
        $this->_em->flush();
    }
}
