<?php

namespace App\Http\Resources;

use Endropie\ApiToolkit\Http\Resource;

class UserResource extends Resource
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
            $this->mergeField('email', $this->email),
            $this->mergeField('mobile', $this->mobile),
            $this->mergeField('ability', $this->ability),
            $this->mergeInclude('profile', new ProfileResource($this->profile), function ($vm) {
                $vm->default(['id', 'fullname']);
            }),
            $this->mergeField('created_at', $this->created_at),
            $this->mergeField('updated_at', $this->updated_at),
        ];
    }

    public function withResponse($request, $response)
    {
        return [
            'test' => 123
        ];
    }
}
