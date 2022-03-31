<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Http\Resources\Comments\CommentCollection;
use App\Http\Resources\Comments\CommentResource;
use App\Http\Resources\ErrorResource;
use App\Services\CommentService;

class CommentController extends Controller
{
    private $service;

    public function __construct(CommentService $service)
    {
        $this->service = $service;
    }

    public function index() : CommentCollection
    {
        try {
            $comments = $this->service->getComments();
            return CommentCollection::make($comments);
        } catch (\Throwable $th) {
            return ErrorResource::make($th)->response()->setStatusCode(400);
        }
    }

    public function store(StoreCommentRequest $request)
    {
        try {
            $data = $request->safe()->only(['post_id', 'parent_id', 'level', 'username', 'content']);
            $comment = $this->service->store($data);
            return CommentResource::make($comment);
        } catch (\Throwable $th) {
            return ErrorResource::make($th)->response()->setStatusCode(400);
        }
    }
}
