<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Item;

class TagController extends Controller
{
    public function show($slug) {
        $tag = Tag::with('items')->where('slug', $slug)->take(1)->firstOrFail();
        $animals_list = Animal::where('is_seen', '=', '1')
        ->orderBy('weight', 'ASC')
        ->get();

        $tags = Tag::all()->where('slug', '!=', 'sale');

        $items_list = $tag->items;

        return view('tag.show', compact('animals_list', 'items_list', 'tags'));
    }
}
