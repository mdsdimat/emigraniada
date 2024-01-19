<?php

declare(strict_types=1);

namespace App\Infrastructure\DTO\Splitwise;

use JsonSerializable;

class SplitwiseMember implements JsonSerializable
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->firstName = $data['first_name'] ?? '';
        $this->lastName = $data['last_name'] ?? '';
        $this->email = $data['email'] ?? '';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->getFullName(),
            'email' => $this->email,
        ];
    }
}
