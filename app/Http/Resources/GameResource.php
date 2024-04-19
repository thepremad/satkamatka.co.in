<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'name_hindi'        => $this->name_hindi,
            'today_open_time'   => Carbon::parse($this->today_open_time)->format('h:i a'),
            'today_close_time'  => Carbon::parse($this->today_close_time)->format('h:i a'),
            'result'            => $this->result,
            'declare_close_time'=> $this->declare_close_time,
            'declare_open_time'=> $this->declare_open_time,
            'chart'=> $this->chart,
            'is_running' => isset($this->is_running) ? $this->is_running : '',
        ];
    }
}
