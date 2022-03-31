<?php

namespace App\Services;

use App\Actions\Comments\StoreCommentAction;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CommentService
{

    private $storeCommentAction;

    public function __construct(StoreCommentAction $storeCommentAction)
    {
        $this->storeCommentAction = $storeCommentAction;
    }

    public function getComments() : Collection
    {
        try {
            $comments = Comment::with('replies.replies')->whereLevel(0)->get();
            return $comments;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(array $data) : Comment
    {
        try {
            DB::beginTransaction();
            $comment = $this->storeCommentAction->execute($data);
            DB::commit();
            return $comment;
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
