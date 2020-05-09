<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TweetController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tweets = $request->user()->tweets()->with('user')->get();
        return $tweets;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body'  => ['required']
        ]);

        $tweets = $request->user()->tweets()->create([
            'body'  => $request->body
        ])->load('user');

        return $tweets;
    }
}
