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
            $comments = Comment::with('replies.replies')->whereLevel(0)->orderByDesc('id')->get();
            return $comments;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(array $data) : Comment
    {
        try {
            DB::beginTransaction();

            if(array_key_exists('parent_id', $data)) {
                $parentComment = Comment::find($data['parent_id']);
                $level = $parentComment->level + 1;
                if($level < 3) {
                    $data += ['level' => $level];
                } else {
                    $data['parent_id'] = $parentComment->parent_id;
                    $data += ['level' => 2];
                }
            } else {
                $data += ['level' => 0];
            }

            $newComment = $this->storeCommentAction->execute($data);
            DB::commit();
            return $newComment;
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

}
