<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CheckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'response_code' => $this->response_code,
            'response_body' => $this->response_body,
            'is_successfull' => $this->isSuccessfull(),
            'status_text' => $this->statusText(),
            'created_at' => DatetimeResource::make($this->created_at)
        ];
    }
}
