<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::latest()->get();
        return view('recipes.index', ['recipes' => $recipes]);
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'ingredients' => 'required',
            'instructions' => 'required',
            'category' => 'nullable|max:100',
            'image' => 'nullable|url',
        ]);

        $recipe = new Recipe;
        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->instructions = $request->instructions;
        $recipe->category = $request->category;
        $recipe->image = $request->image;
        $recipe->user_id = Auth::id();
        $recipe->save();

        return redirect('/recipes')->with('success', 'Recipe added.');
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', ['recipe' => $recipe]);
    }

    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);

        if (Auth::id() !== $recipe->user_id) {
            abort(403);
        }

        return view('recipes.edit', ['recipe' => $recipe]);
    }

    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        if (Auth::id() !== $recipe->user_id) {
            abort(403);
        }

        $this->validate($request, [
            'title' => 'required|max:255',
            'ingredients' => 'required',
            'instructions' => 'required',
            'category' => 'nullable|max:100',
            'image' => 'nullable|url',
        ]);

        $recipe->title = $request->title;
        $recipe->ingredients = $request->ingredients;
        $recipe->instructions = $request->instructions;
        $recipe->category = $request->category;
        $recipe->image = $request->image;
        $recipe->save();

        return redirect("/recipes/{$recipe->id}")->with('success', 'Recipe updated.');
    }

    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

        if (Auth::id() !== $recipe->user_id) {
            abort(403);
        }

        $recipe->delete();

        return redirect('/recipes')->with('success', 'Recipe deleted.');
    }
}