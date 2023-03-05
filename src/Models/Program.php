<?php

namespace Wepa\BroadcastSchedule\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Wepa\BroadcastSchedule\Database\Factories\ProgramFactory;

class Program extends Model
{
    use HasFactory;

    protected $table = 'broadcast_schedule_programs';

    public $timestamps = false;

    protected static function newFactory(): ProgramFactory
    {
        return ProgramFactory::new();
    }

    protected $fillable = [
        'name',
        'description',
        'image',
        'image_alt'
    ];

    public function calendar(): HasMany
    {
        return $this->hasMany(Calendar::class, 'program_id', 'id');
    }
}
