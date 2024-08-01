<?php

declare(strict_types=1);

namespace App\Report;

use App\Entity\Employee;
use App\Enum\DayType;
use App\Enum\TransportType;
use DateInterval;
use DateTime;
use DateTimeImmutable;

class CompensationReport
{
    /**
     * @param Employee[] $employees
     */
    public function generate(array $employees): array
    {
        $paymentDate = new DateTimeImmutable('first Monday of next month');
        $startDate = new DateTimeImmutable(date('Y-m-01'));
        $endDate = new DateTimeImmutable(date(sprintf('Y-m-%d', date('t'))));

        return array_map(function ($employee) use ($startDate, $endDate, $paymentDate) {
            $workedDaysAmount = $this->getWorkedDaysAmount($startDate, $endDate, $employee->getWorkingDays());
            $traveledDistance = $workedDaysAmount * $employee->getTravelDistance() * 2;
            $compensation = $this->getCompensation($employee->getTransportType(), $traveledDistance);
            $formattedCompensation = number_format($compensation / 100, 2, ',', '.');

            return [
                'employee' => $employee->getName(),
                'transport' => $employee->getTransportType()->name,
                'traveled distance' => $traveledDistance,
                'compensation' => $formattedCompensation,
                'payment date' => $paymentDate->format('Y-m-d'),
            ];
        }, $employees);
    }

    private function getCompensation(TransportType $transport, int $distance): int
    {
        return match ($transport) {
            TransportType::Car => $distance * 10,
            TransportType::Bike => ($distance > 5 ? 100 : 50) * $distance,
            TransportType::Bus, TransportType::Train => $distance * 25,
            default => throw new \Exception('Unknown Transport type.'),
        };
    }

    /**
     * @param DayType[] $workingOnDays
     */
    private function getWorkedDaysAmount(
        DateTimeImmutable $startDate,
        DateTimeImmutable $endDate,
        array $workingOnDays
    ): int {
        $workedDays = 0;

        $periodStartDate = DateTime::createFromImmutable($startDate);
        $periodEndDate = DateTime::createFromImmutable($endDate);

        while ($periodStartDate <= $periodEndDate) {
            $dayOfWeek = DayType::from((int) $periodStartDate->format('N')); // Numeric representation of the day of the week

            if (in_array($dayOfWeek, $workingOnDays)) {
                $workedDays++;
            }

            $periodStartDate->add(new DateInterval('P1D'));
        }

        return $workedDays;
    }
}
