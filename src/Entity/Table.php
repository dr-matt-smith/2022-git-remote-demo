<?php

namespace App\Entity;

use App\Repository\TableRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: '`table`')]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;


    #[ORM\Column(type: 'integer')]
    private $TableCapacity;

    #[ORM\ManyToOne(targetEntity: Status::class, inversedBy: 'tables')]
    private $statusType;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getTableCapacity(): ?int
    {
        return $this->TableCapacity;
    }

    public function setTableCapacity(int $TableCapacity): self
    {
        $this->TableCapacity = $TableCapacity;

        return $this;
    }

    public function getStatusType(): ?Status
    {
        return $this->statusType;
    }

    public function setStatusType(?Status $statusType): self
    {
        $this->statusType = $statusType;

        return $this;
    }
}
