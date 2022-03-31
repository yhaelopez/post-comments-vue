<?php

namespace App\Http\Resources\Comments;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'type' => 'comment',
            'attributes' => [
                'id' => $this->id,
                'post_id' => $this->post_id,
                'parent_id' => $this->parent_id,
                'level' => $this->level,
                'username' => $this->username,
                'content' => $this->content,
                'replies' => CommentCollection::make($this->replies),
            ],
        ];
    }
}
