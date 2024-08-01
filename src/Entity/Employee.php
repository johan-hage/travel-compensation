<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\DayType;
use App\Enum\TransportType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\Column(type: 'json', enumType: DayType::class)]
    private array $workingDays = [];

    #[ORM\Column(type: 'string', enumType: TransportType::class)]
    private TransportType $transportType;

    #[ORM\Column(type: 'integer')]
    private int $travelDistance;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return DayType[]
     */
    public function getWorkingDays(): array
    {
        return $this->workingDays;
    }

    /**
     * @param DayType[] $workingDays
     */
    public function setWorkingDays(array $workingDays): self
    {
        $this->workingDays = $workingDays;

        return $this;
    }

    public function getTransportType(): TransportType
    {
        return $this->transportType;
    }

    public function setTransportType(TransportType $transportType): self
    {
        $this->transportType = $transportType;

        return $this;
    }

    public function getTravelDistance(): int
    {
        return $this->travelDistance;
    }

    public function setTravelDistance(int $travelDistance): self
    {
        $this->travelDistance = $travelDistance;

        return $this;
    }
}
