<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    protected $api_token;

    public function token($token) {
      $this->token = $token;
      return $this; 
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
           "id" => $this->id,
           "role" => $this->role,
           "name" => $this->name,
           "email" => $this->email,
           "api_token" => $this->token,
           "created_at" => $this->created_at  
        ];
    }

    public function with($request) {
      return [
       "meta" => [ 
        "api_token" => bcrypt($this->email)
       ], 
      ];
    }
}
