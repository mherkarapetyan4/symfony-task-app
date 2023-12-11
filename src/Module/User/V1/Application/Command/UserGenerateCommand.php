<?php

declare(strict_types=1);

namespace App\Module\User\V1\Application\Command;

use App\Module\User\V1\Domain\Service\UserGenerateService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:create-user')]
final class UserGenerateCommand extends Command
{
    public function __construct(private readonly UserGenerateService $service)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->service->run();

        return Command::SUCCESS;
    }
}