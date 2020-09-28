<?php

namespace App\Http\Resources;

use App\Http\resources\user as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    protected $guarded = [];
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'posts',
                'post_id' => $this->id,
                'attributes' => [
                    'posted_by' => new UserResource($this->user),
                    'body' => $this->body,
                    'likes' => new LikeCollection($this->likes),
                    'image' => url($this->image),
                    'posted_at' => $this->created_at->diffForHumans(),
                ],
                'links' => [
                    'self' => url('/posts/' . $this->id),
                ]
            ]
        ];
    }
}
