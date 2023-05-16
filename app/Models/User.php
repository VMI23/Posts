<?php

declare(strict_types=1);


namespace Blog\models;

use stdClass;

class User
{
    private int $id;
    private string $name;
    private string $username;
    private string $email;
    private stdClass $address;
    private string $phone;
    private string $website;
    private stdClass $company;

    public function __construct(
        int $id,
        string $name,
        string $username,
        string $email,
        stdClass $address,
        string $phone,
        string $website,
        stdClass $company
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->address = $address;
        $this->phone = $phone;
        $this->website = $website;
        $this->company = $company;
    }


    public function getId(): int
    {
        return $this->id;
    }


    public function getName(): string
    {
        return $this->name;
    }


    public function getUsername(): string
    {
        return $this->username;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


    public function getAddress(): stdClass
    {
        return $this->address;
    }


    public function getPhone(): string
    {
        return $this->phone;
    }


    public function getWebsite(): string
    {
        return $this->website;
    }


    public function getCompany(): stdClass
    {
        return $this->company;
    }


}