<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagsResource;
use App\Models\Tag;
use App\Models\Thesis;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    // Alle Tags anzeigen
    public function index() {
        return TagsResource::collection(Tag::all());
    }
    // Einzige Tags anzeigen
    public function show($id) {
        $tag = Tag::find($id);
        return new TagsResource($tag);
    }
    //Tags speichern
    public function store(Request $request) {
        $tag = Tag::create($request->all());
        return new TagsResource($tag);
    }
    //Tags ändern
    public function update(Request $request, $id) {
        $tags = Tag::find($id);
        $tags->update($request->all());
        return new TagsResource($tags);
    }
    //Tags löschen
    public function destroy($id) {
        Tag::destroy($id);
        return response(null, 204);
    }

    //Tag nach Titel suchen
    public function search($title) {
        
    }
}
