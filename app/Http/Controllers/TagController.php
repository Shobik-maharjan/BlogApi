<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    public function getTag()
    {
        try {

            $tag = Tag::all();

            $data = [
                'status' => 200,
                'tags' => $tag
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function createTag(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tag' => 'required|unique:tags',
            ]);
            if ($validator->fails()) {
                $data = [
                    'status' => 422,
                    "message" => $validator->messages()
                ];
                return response()->json($data, 422);
            } else {

                $tag = new Tag;

                $tag->tag = $request->tag;

                $tag->save();

                $data = [
                    'status' => 200,
                    'message' => "data uploaded successfully"
                ];
                return response()->json($data, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function editTag(Request $request, $id)
    {
        try {

            $tag = Tag::find($id);
            $tag->tag = $request->tag;
            $tag->save();

            $data = [
                'status' => 200,
                'message' => $tag
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function deleteTag($id)
    {
        try {

            $tag = Tag::fund($id);
            $tag->delete();

            $data = [
                'status' => 200,
                'message' => "tag deleted successfully"
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
