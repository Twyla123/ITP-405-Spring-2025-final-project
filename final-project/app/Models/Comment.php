<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $recipeId)
    {
        $this->validate($request, [
            'body' => 'required|max:1000',
        ]);

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->user_id = Auth::id();
        $comment->recipe_id = $recipeId;
        $comment->save();

        return back()->with('success', 'Comment added.');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        return view('comments.edit', ['comment' => $comment]);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $this->validate($request, [
            'body' => 'required|max:1000',
        ]);

        $comment->body = $request->body;
        $comment->save();

        return redirect()->back()->with('success', 'Comment updated.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
