<?php

namespace Messagehub\Entity;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShortMessageRepository::class)]
class ShortMessage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'uuid')]
    private $uuid;

    #[ORM\Column(type: 'text')]
    private $message_text;

    #[ORM\Column(type: 'integer')]
    private $message_author;

    #[ORM\Column(type: 'datetime')]
    private $message_date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getMessageText(): ?string
    {
        return $this->message_text;
    }

    public function setMessageText(string $message_text): self
    {
        $this->message_text = $message_text;

        return $this;
    }

    public function getMessageAuthor(): ?int
    {
        return $this->message_author;
    }

    public function setMessageAuthor(int $message_author): self
    {
        $this->message_author = $message_author;

        return $this;
    }

    public function getMessageDate(): ?\DateTimeInterface
    {
        return $this->message_date;
    }

    public function setMessageDate(\DateTimeInterface $message_date): self
    {
        $this->message_date = $message_date;

        return $this;
    }
}
