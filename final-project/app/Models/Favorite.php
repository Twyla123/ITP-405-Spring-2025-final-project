<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store($recipeId)
    {
        $exists = Favorite::where('user_id', Auth::id())
            ->where('recipe_id', $recipeId)
            ->exists();

        if (!$exists) {
            $favorite = new Favorite;
            $favorite->user_id = Auth::id();
            $favorite->recipe_id = $recipeId;
            $favorite->save();
        }

        return back()->with('success', 'Recipe favorited.');
    }

    public function destroy($id)
    {
        $favorite = Favorite::findOrFail($id);

        if (Auth::id() !== $favorite->user_id) {
            abort(403);
        }

        $favorite->delete();

        return back()->with('success', 'Removed from favorites.');
    }

    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())
            ->with('recipe')
            ->latest()
            ->get();

        return view('favorites.index', ['favorites' => $favorites]);
    }
}
