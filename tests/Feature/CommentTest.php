<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use WithFaker;

    public function test_all_comments_can_be_fetched()
    {
        $this->withoutExceptionHandling();

        $response = $this->getJson(route('api.v1.comments.index'), [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $response->assertOk($response);
    }

    public function test_a_comment_can_be_created()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('api.v1.comments.store'), [
            'post_id' => 1,
            'username' => $this->faker->userName(),
            'content' => $this->faker->paragraph(),
        ],[
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        $comment = json_decode($response->getContent());
        $response->assertJson([
            'data' => [
                'type' => 'comment',
                'attributes' => [
                    'parent_id' => $comment->data->attributes->parent_id,
                    'post_id' => $comment->data->attributes->post_id,
                    'id' => $comment->data->attributes->id,
                    'username' => $comment->data->attributes->username,
                    'content' => $comment->data->attributes->content,
                    'level' => $comment->data->attributes->level,
                ]
            ]
        ]);
    }
}
