<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function getTag()
    {
        $tag = Tag::all();

        $data = [
            'status' => 200,
            'tags' => $tag
        ];
        return response()->json($data, 200);
    }

    public function createTag(Request $request)
    {
        $tag = new Tag;

        $tag->tag_name = $request->tag_name;

        $tag->save();

        $data = [
            'status' => 200,
            'message' => "data uploaded successfully"
        ];
        return response()->json($data, 200);
    }

    public function editTag(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->tag_name = $request->tag_name;
        $tag->save();

        $data = [
            'status' => 200,
            'message' => $tag
        ];

        return response()->json($data, 200);
    }

    public function deleteTag($id)
    {
        $tag = Tag::fund($id);
        $tag->delete();

        $data = [
            'status' => 200,
            'message' => "tag deleted successfully"
        ];
        return response()->json($data, 200);
    }
}
