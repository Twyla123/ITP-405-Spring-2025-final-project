<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Recipe;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', '=', Auth::id())
        ->with('recipe')
        ->get();

        #dd($favorites->toArray());

        return view('favorites.index', ['favorites' => $favorites]);
    }

    public function store($recipeId)
    {
        $recipe = Recipe::find($recipeId);

        if ($recipe) {
            $existing = Favorite::where('user_id', '=', Auth::id())
                ->where('recipe_id', '=', $recipeId)
                ->first();

            if (!$existing) {
                $favorite = new Favorite;
                $favorite->user_id = Auth::id();
                $favorite->recipe_id = $recipeId;
                $favorite->save();
            }

            return redirect()->route('recipes.show', ['id' => $recipeId])
                ->with('success', 'Recipe favorited.');
        } else {
            return redirect()->route('recipes.index')
                ->with('error', 'Recipe not found.');
        }
    }

    public function delete($id)
    {
        $favorite = Favorite::find($id);

        if ($favorite) {
            if (Auth::id() === $favorite->user_id) {
                $favorite->delete();

                return redirect()->route('favorites.index')
                    ->with('success', 'Removed from favorites.');
            } else {
                return redirect()->route('favorites.index')
                    ->with('error', 'You are not authorized to delete this favorite.');
            }
        } else {
            return redirect()->route('favorites.index')
                ->with('error', 'Favorite not found.');
        }
    }
}