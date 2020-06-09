<?php

namespace App\Http\Controllers\Api\Beers;

use App\Comment;
use App\Beers\Beer;
use Illuminate\Http\Request;
use App\Events\CommentCreated;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Beers\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function index(Beer $beer)
    {
        $beer->load([
            'comments',
            'comments.user'
        ]);

        return response()->json([
            'comments' => $beer->comments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beers\Beer  $beer
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Beer $beer)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $comment = $beer->comments()->create([
            'body' => $request->input('body'),
            'user_id' => auth()->id(),
        ]);
        
        $comment->load('user');

        event(new CommentCreated($comment));

        return response()->json([
            'comment' => $comment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Beer $beer, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'body' => 'required',
        ]);

        $comment->update([
            'body' => $request->input('body'),
        ]);
        
        $comment->load('user');

        return response()->json([
            'comment' => $comment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beer $beer, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json([
            'comment' => null,
        ]);
    }
}
