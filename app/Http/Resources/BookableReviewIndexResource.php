<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class BookableReviewIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return
        [
            'rating' => $this->rating,
            'content' => $this->content,
//            'created_at' => Carbon::make($this->created_at)->diffForHumans()
            'created_at' =>$this->created_at
        ];
    }
}
