<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TeamRepository")
 */
class Team
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $player1name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $player1external;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $player1number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $player2name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $player2external;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $player2number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tournament", inversedBy="teams")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tournament;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer1name(): ?string
    {
        return $this->player1name;
    }

    public function setPlayer1name(string $player1name): self
    {
        $this->player1name = $player1name;

        return $this;
    }

    public function getPlayer1external(): ?bool
    {
        return $this->player1external;
    }

    public function setPlayer1external(bool $player1external): self
    {
        $this->player1external = $player1external;

        return $this;
    }

    public function getPlayer1number(): ?string
    {
        return $this->player1number;
    }

    public function setPlayer1number(?string $player1number): self
    {
        $this->player1number = $player1number;

        return $this;
    }

    public function getPlayer2name(): ?string
    {
        return $this->player2name;
    }

    public function setPlayer2name(string $player2name): self
    {
        $this->player2name = $player2name;

        return $this;
    }

    public function getPlayer2external(): ?bool
    {
        return $this->player2external;
    }

    public function setPlayer2external(bool $player2external): self
    {
        $this->player2external = $player2external;

        return $this;
    }

    public function getPlayer2number(): ?string
    {
        return $this->player2number;
    }

    public function setPlayer2number(?string $player2number): self
    {
        $this->player2number = $player2number;

        return $this;
    }

    public function getTournament(): ?Tournament
    {
        return $this->tournament;
    }

    public function setTournament(?Tournament $tournament): self
    {
        $this->tournament = $tournament;

        return $this;
    }
}
