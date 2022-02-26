<?php

namespace App\Http\Controllers;

use App\Models\Thesis;
use App\Models\Tag;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function getTheses() {
        $theses = Thesis::all();
        $thesisTag = Thesis::find(1);

        foreach ($thesisTag->tags as $tag) {
            $theses->$tag;
        }
        return $theses;
    }

    public function getTags() {
        $tags = Tag::all();
        return $tags;
    }

    public function get_thesis($id) {
        $thesis = Thesis::find($id);
       return response()->json($thesis);
    }

    public function saveTheses(Request $request) {
        $thesis = new Thesis;

        $thesisTag = Thesis::find(1);

        foreach ($thesisTag->tags as $tag) {
            $thesis->$tag;
        }

        // Validate (size is in KB)
         /* $request->validate([
            'image' => 'required|file|image|size:1024|dimensions:max_width=500,max_height=500',
        ]);  */

        //$newPath = $request->image->store('image', 'public');

        //$contents = file_get_contents($request->image->$newPath());

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
            return response()->json(['status' => true, 'message' => 'Thesis added successfully']);
        } else {
            return response()->json(['status' => false, 'message' => 'There is some trouble']);
        }
    }

    public function updateTheses(Request $request, $id) {
        $thesis = Thesis::where('id', $id)->first();

        // Validate (size is in KB)
         /* $request->validate([
            'image' => 'required|file|image|size:1024|dimensions:max_width=500,max_height=500',
        ]);  */

        //$newPath = $request->image->store('image', 'public');

        //$contents = file_get_contents($request->image->$newPath());

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
    }
}
