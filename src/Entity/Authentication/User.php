<?php

declare(strict_types=1);

namespace App\Entity\Authentication;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as CustomAssert;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[ORM\Table(name: 'AuthenticationUsers')]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\InheritanceType('SINGLE_TABLE')]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[OA\Schema]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::INTEGER)]
    private int $id;


    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING, length: 180, unique: true)]
    #[Assert\NotBlank(message: 'A user must have a email')]
    #[Assert\Email(message: "The email '{{ value }}' is not a valid email.", mode: 'strict')]
    private string $email;

    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::JSON)]
    private array $roles = [];

    #[CustomAssert\PasswordConstraints]
    #[Assert\NotCompromisedPassword]
    #[Assert\NotBlank(message: 'A user must have a password')]
    #[Assert\Length(min: 8, max: 32, minMessage: 'The password must be at least {{ limit }} characters long', maxMessage: 'The password can contain a maximum of {{ limit }} characters')]
    private string $rawPassword;

    /**
     * @var string The hashed password
     *
     */
    #[ORM\Column(type: \Doctrine\DBAL\Types\Types::STRING)]
    #[Assert\NotBlank(message: 'A user must have a password')]
    private string $password;

    public function getId(): int
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials()
    {
    }

    public function getUsername()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getType(): string
    {
        return match (static::class) {
            User::class => 'Dobro',
            OwnerUser::class => 'Owner',
            ContractorUser::class => 'Contractor',
            SubcontractorUser::class => 'Subcontractor',
        };
    }

    public function getAdmin(): bool
    {
        return in_array('ROLE_ADMIN', $this->roles);
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function setRawPassword(string $rawPassword): void
    {
        $this->rawPassword = $rawPassword;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
