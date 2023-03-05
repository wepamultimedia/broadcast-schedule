<?php

namespace Wepa\BroadcastSchedule\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Wepa\BroadcastSchedule\Database\Factories\CalendarFactory;

class Calendar extends Model
{
    use HasFactory;

    protected $table = 'broadcast_schedule_calendars';

    public $timestamps = false;

    public bool $on_air = false;

    protected static function newFactory(): CalendarFactory
    {
        return CalendarFactory::new();
    }

    public function time(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('H:i:s', $value)->format('H:i'),
        );
    }

    public function timeString(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d').' '.$this->time.':00')->timestamp,
        );
    }

    protected $fillable = [
        'program_id',
        'day',
        'time',
        'description',
        'highlight',
    ];

    public function program(): HasOne
    {
        return $this->hasOne(Program::class, 'id', 'program_id');
    }
}
