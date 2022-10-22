<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\Item;

class AnimalController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        return view('animal.create');
    }

    public function store(Request $request)
    {
        $animal = new Animal();

        $validated = $request->validate([
            'slug' => 'required|max:255',
            'title' => 'required|max:255',
            'icon_url' => 'max:255',
            'is_seen'  => 'max:1',
            'weight'   => 'max:55',
        ]);

        $animal->slug = $validated['slug'];
        $animal->title = $validated['title'];
        $animal->icon_url = $validated['icon_url'];
        $animal->is_seen = $validated['is_seen'];
        $animal->weight = $validated['weight'];

        $animal->save();

        return redirect()->route('animals.edit', ['id' => $animal->id]);
    }

    public function show($slug)
    {
        $animal = Animal::with('items')->where('slug', $slug)->firstOrFail();

        if($animal->is_seen == 0) {
            return redirect()->route('home');
        }

        $animals_list = Animal::where('is_seen', '=', '1')
        ->orderBy('weight', 'ASC')  
        ->get();

        return view('animal.show', compact('animal', 'animals_list'));
    }

    public function edit($slug)
    {
        $animal = Animal::where('slug', $slug)->firstOrFail();

        return view('animal.edit', compact('animal'));
    }

    public function update(Request $request, $slug)
    {
        $animal = Animal::where('slug', $slug)->firstOrFail();

        if( $request->action == 'delete' ) {
            $animal->delete();

            return redirect()->route('home');
        }

        $validated = $request->validate([
            'slug'     => 'required|max:255',
            'title'    => 'required|max:255',
            'icon_url' => 'max:255',
            'is_seen'  => 'max:1',
            'weight'   => 'max:55',
        ]);

        $animal->slug     = $validated['slug'];
        $animal->title    = $validated['title'];
        $animal->icon_url = $validated['icon_url'];
        $animal->is_seen  = $validated['is_seen'];
        $animal->weight   = $validated['weight'];
        $animal->save();
        //query UPDATE `animals` SET ``=... WHERE `id`=$id

        return back();
    }

    public function destroy($id)
    {
        
    }
}
