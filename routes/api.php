<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('comments', CommentController::class)->only(['index', 'store']);
