<?php

namespace App\Actions\Comments;

use App\Models\Comment;

class StoreCommentAction
{
    public function execute(array $data)
    {
        $comment = Comment::create($data);
        return $comment;
    }
}
