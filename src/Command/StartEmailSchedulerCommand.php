<?php

namespace App\Command;

use App\EmailForwardScheduleProvider;
use App\MessageHandler\EmailForwardMessageHandler;
use App\Service\Type\Config;
use Exception;
use Longman\TelegramBot\Telegram;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Scheduler\Scheduler;

class StartEmailSchedulerCommand extends Command
{
    protected static $defaultName = 'StartEmailScheduler:command';

    public function __construct(private Telegram $telegram, private Config $config, string $name = null)
    {
        parent::__construct($name);
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $scheduleProvider = new EmailForwardScheduleProvider($this->config);
        $schedule = $scheduleProvider->getSchedule();
        $scheduler = new Scheduler(
            [
                Config::class => new EmailForwardMessageHandler($this->telegram),
            ],
            [
                $schedule,
            ]
        );
        $scheduler->run();
    }
}
