<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $service;

    public function __construct()
    {
        $this->service = new PostService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->service->list(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request);
        return response()->json($this->service->create($request->all()), 201);
    }

    /**
     * Validate data before saving.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validator(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'comment' => 'required',
            'parent_post_id' => 'integer',
            'parent_reply_id' => 'integer'
        ]);
    }
}
