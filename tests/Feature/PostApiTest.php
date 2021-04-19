<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    private $json_structure = [
        '*' => [
            "id",
            "username",
            "parent_post_id",
            "parent_reply_id",
            "comment",
            "created_at",
            "updated_at",
            "reply" => [
                '*' => [
                    "id",
                    "username",
                    "parent_post_id",
                    "parent_reply_id",
                    "comment",
                    "created_at",
                    "updated_at",
                    "sub_reply" => [
                        '*' => [
                            "id",
                            "username",
                            "parent_post_id",
                            "parent_reply_id",
                            "comment",
                            "created_at",
                            "updated_at",
                        ]
                    ]
                ]
            ]
        ]
    ];
    /**
     * Test if endpoint can create post.
     *
     * @return void
     */
    public function test_must_be_able_to_create_post()
    {
        $data = [
            'username' => 'Test User',
            'comment'  => 'Test Comment',
        ];

        $this->json('POST', route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure($this->json_structure);
    }

    /**
     * Test if endpoint can create post.
     *
     * @return void
     */
    public function test_must_be_able_to_respond_to_a_post()
    {
        $data = [
            'username' => 'Test User',
            'comment' => 'Test Comment',
            'parent_post_id' => '1'
        ];

        $this->json('POST', route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure($this->json_structure);
    }

    /**
     * Test if endpoint can create post.
     *
     * @return void
     */
    public function test_must_be_able_to_respond_to_a_reply()
    {
        $data = [
            'username' => 'Test User',
            'comment'  => 'Test Comment',
            'parent_reply_id' => '1'
        ];

        $this->json('POST', route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJsonStructure($this->json_structure);
    }

    /**
     * Test if endpoint can list posts.
     *
     * @return void
     */
    public function test_must_be_able_to_list_posts()
    {
        $this->json('GET', route('posts.list'))
            ->assertStatus(200)
            ->assertJsonStructure($this->json_structure);
    }
}
