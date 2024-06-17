<?php

class Pricing
{
    private ?int $id = null;

    public function __construct(private string $contact_mode,private string $firstname,private string $lastname, private string $email, private string $tel, private ?string $city, private ?string $message, private ?array $details, private ?string $photo_path)
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getContact_mode(): string
    {
        return $this->contact_mode;
    }
    public function setcontact_mode(string $contact_mode): void
    {
        $this->contact_mode = $contact_mode;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTel(): string
    {
        return $this->tel;
    }
    public function setTel(string $tel): void
    {
        $this->tel = $tel;
    }

    public function getCity(): string
    {
        return $this->city;
    }
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getDetails(): ?array
    {
        return $this->details;
    }
    public function setDetails(array $details): void
    {
        $this->details = $details;
    }

    public function getPhoto_path(): ?string
    {
        return $this->photo_path;
    }
    public function setphoto_path(string $photo_path): void
    {
        $this->photo_path = $photo_path;
    }

}


