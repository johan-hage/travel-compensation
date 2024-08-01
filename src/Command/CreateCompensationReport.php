<?php

declare(strict_types=1);

namespace App\Command;

use App\Report\CompensationReport;
use App\Repository\EmployeeRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(
    name: 'app:create-compensation-report',
    description: 'Create a CSV report of monthly travel compensation by employee.'
)]
class CreateCompensationReport extends Command
{
    public function __construct(
        private readonly EmployeeRepository $employeeRepository,
        private readonly CompensationReport $compensationReport,
        private readonly SerializerInterface $serializer,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Generating report.');

        $employees = $this->employeeRepository->findAll();

        $data = $this->compensationReport->generate($employees);
        $fileName = sprintf('compensation_report_%s.csv', date('YmdHis'));

        file_put_contents($fileName, $this->serializer->encode($data, 'csv', [CsvEncoder::DELIMITER_KEY => ';']));

        $output->writeln(sprintf('Done generating report "%s".', $fileName));

        return Command::SUCCESS;
    }
}
