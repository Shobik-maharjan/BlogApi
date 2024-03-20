<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();

        $data = [

            'status' => 200,
            'blogs' => $blogs
        ];
        return response()->json($data, 200);
    }

    public function createBlog(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => "required",
        ]);

        if ($validator->fails()) {
            $data = [
                'status' => 422,
                "message" => $validator->messages()
            ];
            return response()->json($data, 422);
        } else {
            $blog = new Blog;

            $blog->name = $request->name;
            $blog->description = $request->description;
            $blog->category = $request->category;
            $blog->description = $request->description;
            $blog->tags = $request->tags;

            $blog->save();

            $data = [
                'status' => 200,
                'message' => 'data uploaded successfully'
            ];

            return response()->json($data, 200);
        }
    }
    public function editBlog(Request $request, $id)
    {
        $blog = Blog::find($id);

        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->tags = $request->tags;

        $blog->save();

        $data = [
            'status' => 200,
            'message' => $blog
        ];

        return response()->json($data, 200);
    }

    public function deleteBlog($id)
    {
        $blog = Blog::find($id);
        $blog->delete();

        $data = [
            'status' => 200,
            'message' => "data deleted successfully"
        ];

        return response()->json($data, 200);
    }
}
