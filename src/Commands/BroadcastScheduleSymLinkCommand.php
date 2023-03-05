<?php

namespace Wepa\BroadcastSchedule\Commands;

use Wepa\Core\Commands\BaseSymlinkCommand;

class BroadcastScheduleSymLinkCommand extends BaseSymlinkCommand
{
    protected string $package = 'broadcast-schedule';

    protected $signature = 'broadcast-schedule:sl';
}
