<?php

namespace App\Entity\Parameter;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParameterRepository")
 */
class Parameter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $keyIndex;

    /**
     * @ORM\Column(type="text")
     */
    protected $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyIndex(): ?string
    {
        return $this->keyIndex;
    }

    public function setKeyIndex(string $keyIndex): self
    {
        $this->keyIndex = $keyIndex;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}