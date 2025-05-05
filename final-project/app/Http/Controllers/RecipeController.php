<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'ingredients' => 'required',
            'instructions' => 'required',
            'category' => 'nullable|max:100',
            'image' => 'nullable|url',
        ]);

        $recipe = new Recipe;
        $recipe->title = $request->input('title');
        $recipe->ingredients = $request->input('ingredients');
        $recipe->instructions = $request->input('instructions');
        $recipe->category = $request->input('category');
        $recipe->image = $request->input('image');
        $recipe->user_id = Auth::id();
        $recipe->save();

        return redirect()->route('recipes.index')->with('success', 'Recipe created.');
    }

    public function show($id)
    {
        $recipe = Recipe::find($id);

        if ($recipe) {
            return view('recipes.show', ['recipe' => $recipe]);
        } else {
            return redirect()->route('recipes.index')->with('error', 'Recipe not found.');
        }
    }

    public function edit($id)
    {
        $recipe = Recipe::find($id);

        if ($recipe) {
            if (Auth::id() === $recipe->user_id) {
                return view('recipes.edit', ['recipe' => $recipe]);
            } else {
                return redirect()->route('recipes.index')->with('error', 'You are not authorized to edit this recipe.');
            }
        } else {
            return redirect()->route('recipes.index')->with('error', 'Recipe not found.');
        }
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);

        if ($recipe) {
            if (Auth::id() === $recipe->user_id) {
                $request->validate([
                    'title' => 'required|max:255',
                    'ingredients' => 'required',
                    'instructions' => 'required',
                    'category' => 'nullable|max:100',
                    'image' => 'nullable|url',
                ]);

                $recipe->title = $request->input('title');
                $recipe->ingredients = $request->input('ingredients');
                $recipe->instructions = $request->input('instructions');
                $recipe->category = $request->input('category');
                $recipe->image = $request->input('image');
                $recipe->save();

                return redirect()->route('recipes.show', ['id' => $id])->with('success', 'Recipe updated.');
            } else {
                return redirect()->route('recipes.index')->with('error', 'You are not authorized to edit this recipe.');
            }
        } else {
            return redirect()->route('recipes.index')->with('error', 'Recipe not found.');
        }
    }

    public function delete($id)
    {
        $recipe = Recipe::find($id);

        if ($recipe) {
            if (Auth::id() === $recipe->user_id) {
                $recipe->delete();
                return redirect()->route('recipes.index')->with('success', 'Recipe deleted.');
            } else {
                return redirect()->route('recipes.index')->with('error', 'You are not authorized to delete this recipe.');
            }
        } else {
            return redirect()->route('recipes.index')->with('error', 'Recipe not found.');
        }
    }
}