<?php

namespace App\Http\Controllers;

use App\Http\Resources\ThesisResource as ThesesResource;
use App\Models\Thesis;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\ThesesRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;

class ThesisController extends Controller
{
    // Alle Theses anzeigen
    public function index() {
        return ThesesResource::collection(Thesis::all());
        //return Thesis::all();
    }
    // Einzige Thesis anzeigen
    public function show($id) {
        $thesis = Thesis::find($id);
        return new ThesesResource($thesis);
        //return Thesis::find($id);
    }
    //Thesis speichern
    public function store(ThesesRequest $request) {
        $thesis = Thesis::create($request->all());
        return new ThesesResource($thesis);
    }
    //Thesis ändern
    public function update(ThesesRequest $request, $id) {
        $thesis = Thesis::find($id);
        $thesis->update($request->all());
        return new ThesesResource($thesis);
    }
    //Thesis löschen
    public function destroy($id) {
        Thesis::destroy($id);
        return response(null, 204);
    }
    //Thesis nach Titel suchen
    public function search($title) {
        return Thesis::where('title', 'like', '%'.$title.'%')->get();
    }
    /* 
    public function getTheses() {
        $theses = Thesis::all();
       $thesisTag = Thesis::find(1);

        foreach ($thesisTag->tags as $tag) {
            $theses->$tag;
        } 
        return $theses;
    }
*/

    /*
    public function get_thesis($id) {
        $thesis = Thesis::find($id);
        return response()->json($thesis);
    }
*/
/*
    public function saveTheses(Request $request) {
        $thesis = new Thesis;


        if($request->has('image') && !empty($request->image)) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/'),$imageName);
            $path = ('public/images/'.$imageName);

            $thesis->image = $path;
        }  

        $thesis->title     = $request->title;
        $thesis->publisher = $request->publisher;
        $thesis->proglang  = $request->proglang;
        $thesis->description  = $request->description;

        if($thesis->save()) {
            return response()->json(['status' => true, 'message' => 'Thesis added successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some trouble']);
        }
    }
*/
    /* public function updateTheses(Request $request, $id) {
        $thesis = Thesis::where('id', $id)->first();


         if($request->has('image') && !empty($request->image)) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/'),$imageName);
            $path = ('public/images/'.$imageName);

            $thesis->image = $path;
        }  

        $thesis->titel     = $request->titel;
        $thesis->publisher = $request->publisher;
        $thesis->proglang  = $request->proglang;
        $thesis->description  = $request->description;

        if($thesis->save()) {
            return response()->json(['status' => true, 'message' => 'Thesis updated successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some trouble']);
        }
    }

    public function deleteThesis($id) {
        $thesis = Thesis::find($id);
        if($thesis->delete()) {
            return response()->json(['status' => true, 'message' => 'Thesis deleted successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some trouble']);
        }
    } */
}
