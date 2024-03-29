<?php

class Opinion
{
    private ?int $id = null;

    public function __construct(private string $username,private string $content, private int $notation, private ?int $realisationId)
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

    public function getUsername(): string
    {
        return $this->username;
    }
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }


    public function getContent(): string
    {
        return $this->content;
    }
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getNotation(): int
    {
        return $this->notation;
    }
    public function setNotation(int $notation): void
    {
        $this->notation = $notation;
    }

    public function getRealisationId(): ?int
    {
        return $this->realisationId;
    }
    public function setRealisationId(?int $realisationId): void
    {
        $this->realisationId = $realisationId;
    }
}


