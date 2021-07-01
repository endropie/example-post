<?php

namespace App\Http\Resources;

use Endropie\ApiToolkit\Http\Resource;

class PostResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            $this->mergeAttributes(),
            $this->mergeInclude('user', new UserResource($this->user))
        ];
    }
}
