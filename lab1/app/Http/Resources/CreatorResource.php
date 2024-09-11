<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreatorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
   
    public function toArray($request)
    {
        if (!$this->resource instanceof \App\Models\User) {
            throw new \Exception('Invalid resource type'). get_class($this->postedBy);
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            // Add any other fields you want to expose
        ];
    }
}
