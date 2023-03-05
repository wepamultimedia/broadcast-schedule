<?php

namespace Wepa\BroadcastSchedule\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wepa\BroadcastSchedule\BroadcastSchedule
 */
class BroadcastSchedule extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Wepa\BroadcastSchedule\BroadcastSchedule::class;
    }
}
