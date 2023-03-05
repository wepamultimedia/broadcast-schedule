<?php

namespace Wepa\BroadcastSchedule\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Wepa\BroadcastSchedule\Http\Resources\CalendarResource;
use Wepa\BroadcastSchedule\Models\Calendar;

class CalendarController extends Controller
{
    public function getDay(string $day = null): AnonymousResourceCollection
    {
        if (! $day) {
            $day = date('l');
        }

        $day = Str::lower($day);
        $calendar = Calendar::where('day', $day)->orderBy('time', 'asc')->get();
        $calendar = $this->onAir($calendar);

        return CalendarResource::collection($calendar);
    }

    public function onAir(Collection $calendar): Collection
    {
        $total = count($calendar);
        $calendar->map(function ($item, $key) use ($total, $calendar) {
            $now = Carbon::now()->timestamp;
            if ($key + 1 < $total) {
                if ($item->timeString < $now and $calendar[$key + 1]->timeString > $now) {
                    $item->on_air = true;
                } else {
                    $item->on_air = false;
                }
            } else {
                $item->on_air = false;
            }
        });

        return $calendar;
    }
}
