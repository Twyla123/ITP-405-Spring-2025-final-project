<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Recipe;

class CommentController extends Controller
{
    public function store(Request $request, $recipeId)
    {
        $request->validate([
            'body' => 'required|max:1000',
        ]);

        $recipe = Recipe::find($recipeId);

        if ($recipe) {
            $comment = new Comment;
            $comment->body = $request->input('body');
            $comment->user_id = Auth::id();
            $comment->recipe_id = $recipeId;
            $comment->save();

            return redirect()->route('recipes.show', ['id' => $recipeId])
                ->with('success', 'Comment posted.');
        } else {
            return redirect()->route('recipes.index')
                ->with('error', 'Recipe not found.');
        }
    }

    public function edit($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            if (Auth::id() === $comment->user_id) {
                return view('comments.edit', ['comment' => $comment]);
            } else {
                return redirect()->route('recipes.index')
                    ->with('error', 'You are not authorized to edit this comment.');
            }
        } else {
            return redirect()->route('recipes.index')
                ->with('error', 'Comment not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            if (Auth::id() === $comment->user_id) {
                $request->validate([
                    'body' => 'required|max:1000',
                ]);

                $comment->body = $request->input('body');
                $comment->save();

                return redirect()->route('recipes.show', ['id' => $comment->recipe_id])
                    ->with('success', 'Comment updated.');
            } else {
                return redirect()->route('recipes.index')
                    ->with('error', 'You are not authorized to update this comment.');
            }
        } else {
            return redirect()->route('recipes.index')
                ->with('error', 'Comment not found.');
        }
    }

    public function delete($id)
    {
        $comment = Comment::find($id);

        if ($comment) {
            if (Auth::id() === $comment->user_id) {
                $recipeId = $comment->recipe_id;
                $comment->delete();

                return redirect()->route('recipes.show', ['id' => $recipeId])
                    ->with('success', 'Comment deleted.');
            } else {
                return redirect()->route('recipes.index')
                    ->with('error', 'You are not authorized to delete this comment.');
            }
        } else {
            return redirect()->route('recipes.index')
                ->with('error', 'Comment not found.');
        }
    }
}