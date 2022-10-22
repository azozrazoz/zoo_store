<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Item;
use App\Models\Tag;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $animals_list = Animal::all();

        return view('item.create', compact('animals_list'));
    }

    public function store(Request $request)
    {
        $item = new Item();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'animal_id' => 'max:255',
            'description' => 'max:750',
            'price'  => 'required|max:11',
            'main_image'   => 'max:255',
        ]);

        $item->title = $validated['title'];
        $item->animal_id = $validated['animal_id'];
        $item->description = $validated['description'];
        $item->price = $validated['price'];
        $item->main_image = $validated['main_image'];   
        $item->slug = $this->generate_slug($validated['title']);

        $item->save();

        return redirect()->route('items.edit', ['slug' => $item->slug]);        
    }

    public function show($slug)
    {
        $item = Item::where('slug', '=', $slug)->firstOrFail();

        return view('item.show', compact('item'));
    }

    public function edit($slug)
    {
        $item = Item::with('tags')->where('slug', $slug)->firstOrFail();
        $animals = Animal::all();
        $tags = Tag::all();

        return view('item.edit', compact('item', 'animals', 'tags'));
    }

    public function update(Request $request, $slug)
    {
        $item = Item::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:750',
            'price'  => 'required|max:11',
            'main_image'   => 'max:255',
        ]);

        $item->title = $validated['title'];
        $item->description = $validated['description'];
        $item->price = $validated['price'];
        $item->main_image = $validated['main_image'];

        $item->save();

        return back();
    }

    public function destroy($id)
    {
        //
    }

    public function list() {
        $items = Item::all();
        $animals = Animal::all();

        return view('item.list', compact('items', 'animals'));
    }

    public function update_animal(Request $request, $slug) {
        $item = Item::where('slug', $slug)->firstOrFail();
        $animal = Animal::findOrFail($request->animal_id);

        // dd($item);
        $item->animal()->associate($animal);
        $item->save();
        
        return redirect()->route('items.list');
    }

    public function attach_tag(Request $request, $slug) {
        $item = Item::with('tags')->where('slug', $slug)->firstOrFail();

        $tag_id = $request->tag_id;

        if ($tag_id == 'new') {
            $tag = new Tag();
            $tag->title = $request->new_tag_title;
            $tag->slug = $this->generate_slug($request->new_tag_title);
            $tag->save();
            
            $tag_id = $tag->id;
        }

        if ($item->tags()->where('tag_id', $tag_id)->count() == 0) {
            $item->tags()->attach($tag_id);
        }

        return back();
    }

    public function detach_tag(Request $request, $slug) {
        $item = Item::where('slug', $slug)->firstOrFail();
        $tag_id = $request->tag_id;        

        $item->tags()->detach($tag_id);        

        return back();
    }

    public function search_g($q) {
        $items = Item::where('title', 'LIKE', '%' . $q . '%')->orWhere('description', 'LIKE', '%' . $q . '%')->get();
        return view('item.search', compact('q', 'items'));
    }

    public function search_p(Request $request) {
        $validated = $request->validate([
            'q' => 'required'
        ]);

        return redirect()->route('items.search', ['q' => $validated['q']]);
    }

    public function generate_slug($string)
    {
        $string = mb_strtolower($string, 'UTF-8');

        $slug = '';
        $russian = ['а','б','в','г','д','е','ё','ж','з','и','й','к','л',
                    'м','н','о','п','р','с','т','у','ф','х','ц','ч','ш',
                    'ь','ъ','щ','ы','э','ю','я',' '];
        $latin   = ['a','b','v','g','d','e','e','j','z','i','i','k','l',
                    'm','n','o','p','r','s','t','u','f','h','c','ch','sh',
                    '','','sh','y','e','yu','ya', '_'];
        
        $slug = str_replace($russian, $latin, $string);

        return $slug;
    }

    public function sales() {
        $tag = Tag::with('items')->where('slug', 'sale')->take(1)->firstOrFail();

        $items_list = $tag->items;

        return view('stocks', compact('items_list'));
    }
}
