<?php

declare(strict_types = 1);

namespace App\User\Application\CommandHandler\User;

use App\User\Application\Command\User\UpdateUserCommand;
use App\User\Domain\Entity\Address;
use App\User\Domain\Entity\Interest;
use App\User\Domain\Entity\Role;
use App\User\Domain\Entity\Skill;
use App\User\Domain\Entity\User;
use App\User\Domain\Service\User\WriterService\UserWriterService;

class UpdateUserCommandHandler
{
    public function __construct(
        private readonly UserWriterService $userWriterService,
        private User $user,
        private array $addresses = [],
        private array $roles = [],
        private array $skills = [],
        private array $interests = []
    ) {}

    public function __invoke(UpdateUserCommand $command): void
    {
        $this->setUser($command);
        $this->setRoles($command);
        $this->setAddresses($command);
        $this->setSkills($command);
        $this->setInterests($command);

        $this->userWriterService->updateUserInDB(
            $this->user,
            $this->addresses,
            $this->roles,
            $this->skills,
            $this->interests
        );
    }

    private function setUser(UpdateUserCommand $command): void
    {
        $this->user = $command->user;
        $this->user->setFirstName($command->{User::COLUMN_FIRST_NAME});
        $this->user->setLastName($command->{User::COLUMN_LAST_NAME});
        $this->user->setPhone($command->{User::COLUMN_PHONE});
        $this->user->setEmail($command->{User::COLUMN_EMAIL});
        $this->user->setActive($command->{User::COLUMN_ACTIVE});
        $this->user->setBornOn($command->{User::COLUMN_BORN_ON});
    }

    private function setAddresses(UpdateUserCommand $command): void
    {
        foreach ($command->addresses as $item) {
            $address = new Address();
            $address->setStreet($item[Address::COLUMN_STREET]);
            $address->setPostcode($item[Address::COLUMN_POSTCODE]);
            $address->setCity($item[Address::COLUMN_CITY]);
            $address->setCountry($item[Address::COLUMN_COUNTRY]);
            $address->setStreet($item[Address::COLUMN_STREET]);
            $address->setType($item[Address::COLUMN_TYPE]);
            $address->setUser($this->user);

            $this->addresses[] = $address;
        }
    }

    private function setRoles(UpdateUserCommand $command): void
    {
        $this->roles = [];
        foreach ($command->roles as $item) {
            $role = new Role();
            $role->setName($item);
            $role->setUser($this->user);

            $this->roles[] = $role;
        }
    }

    private function setSkills(UpdateUserCommand $command): void
    {
        $this->skills = [];
        foreach ($command->skills as $item) {
            $skill = new Skill();
            $skill->setName($item);
            $skill->setUser($this->user);

            $this->skills[] = $skill;
        }
    }

    private function setInterests(UpdateUserCommand $command): void
    {
        $this->interests = [];
        foreach ($command->interests as $item) {
            $interest = new Interest();
            $interest->setName($item);
            $interest->setUser($this->user);

            $this->interests[] = $interest;
        }
    }
}