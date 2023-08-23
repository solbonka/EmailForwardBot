<?php

namespace App;

use App\Service\Type\Config;
use Exception;
use Symfony\Component\Scheduler\Attribute\AsSchedule;
use Symfony\Component\Scheduler\RecurringMessage;
use Symfony\Component\Scheduler\Schedule;
use Symfony\Component\Scheduler\ScheduleProviderInterface;

#[AsSchedule('emailForward')]
class EmailForwardScheduleProvider implements ScheduleProviderInterface
{
    public function __construct(private Config $config)
    {
    }

    /**
     * @throws Exception
     */
    public function getSchedule(): Schedule
    {
        return (new Schedule())->add(RecurringMessage::every('30 seconds', $this->config));
    }
}
