<?php

declare(strict_types=1);

namespace App\Tests\Report;

use App\Entity\Employee;
use App\Enum\DayType;
use App\Enum\TransportType;
use App\Report\CompensationReport;
use PHPUnit\Framework\TestCase;

class CompensationReportTest extends TestCase
{
    private CompensationReport $report;

    protected function setUp(): void
    {
        parent::setUp();

        $this->report = new CompensationReport();
    }

    public function testGenerate(): void
    {
        $name = 'Piet';
        $employee = $this->createConfiguredMock(Employee::class, [
            'getId' => 1,
            'getName' => $name,
            'getWorkingDays' => [DayType::Monday, DayType::Friday],
            'getTransportType' => TransportType::Car,
            'getTravelDistance' => 52,
        ]);
        $data = $this->report->generate([$employee]);

        $this->assertCount(1, $data);

        $this->assertSame($name, $data[0]['employee']);
        $this->assertSame(TransportType::Car->name, $data[0]['transport']);
        $this->assertSame(936, $data[0]['traveled distance']);
        $this->assertSame('93,60', $data[0]['compensation']);
        $this->assertSame('2024-09-02', $data[0]['payment date']);
    }
}
