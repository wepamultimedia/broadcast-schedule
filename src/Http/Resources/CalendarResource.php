<?php

namespace Wepa\BroadcastSchedule\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CalendarResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'day' => $this->day,
            'time' => $this->time,
            'highlight' => $this->highlight,
            'name' => $this->program->name,
            'description' => $this->description ?? $this->program->description,
            'image' => $this->program->image,
            'on_air' => $this->on_air,
        ];
    }
}
