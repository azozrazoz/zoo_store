<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ Animal, Item, Tag };

class HomeController extends Controller
{
    function index() {
        $animals_list = Animal::where('is_seen', '=', '1')
        ->orderBy('weight', 'ASC')
        ->get();

        $items_list = Item::all();
        
        $tags = Tag::all()->where('slug', '!=', 'sale');

        return view('main_page', compact('animals_list', 'items_list', 'tags'));
    }

    function info($id = null) {
        $animal = Animal::findOrFail($id);

        return view('infopage.info', compact('id', 'animal'));
    }
}
