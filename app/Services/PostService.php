<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Models\Post;

class PostService {
    protected $post;

    /**
     * List posts
     * 
     * @return PostResource
     */
    public function list() 
    {
        return PostResource::collection(
            Post::where('parent_post_id', null)
                ->where('parent_reply_id', null)
                ->with([
                    'reply' => function($query) {
                        $query->with(['subReply' => function ($query2) {
                                $query2->orderBy('created_at', 'DESC');
                            }])
                            ->orderBy('created_at', 'DESC');
                    }
                ])
                ->orderBy('created_at', 'DESC')
                ->get()
        );
    }

    /**
     * Create post
     *
     * @param mixed $data
     * @return PostResource;
     */
    public function create($data)
    {
        try {
            $post = Post::create($data);
            return PostResource::collection(
                Post::where('parent_post_id', null)
                    ->where('parent_reply_id', null)
                    ->with([
                        'reply' => function($query) {
                            $query->with(['subReply' => function ($query2) {
                                    $query2->orderBy('created_at', 'DESC');
                                }])
                                ->orderBy('created_at', 'DESC');
                        }
                    ])
                    ->orderBy('created_at', 'DESC')
                    ->get()
            );
        } catch (Throwable $e) {
            return response()->json([
                "success" => false,
                "message" => $e,
                "data" => $data
            ], 400);
        }
    }
}