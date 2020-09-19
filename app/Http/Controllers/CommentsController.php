<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request) {
        $comment = new Comment($request->all());

        $comment->user_id = Auth::user()->id;

        $comment->save();

        return redirect()->route('show_article', $request->article_id);
    }
}
