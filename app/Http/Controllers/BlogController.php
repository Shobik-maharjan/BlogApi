<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('tags')->get();

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
            'category_id' => "required",
            'tag_id' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg'
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
            $blog->category_id = $request->category_id;
            $blog->tag_id = $request->tag_id;

            $imageName = time() . '.' . $request->image->extension();

            $blog->image = $request->image->storeAs('images', $imageName);

            $blog->save();

            $data = [
                'status' => 200,
                'message' => 'data uploaded successfully',
                'imagepath' => asset('image/' . $imageName)
            ];

            return response()->json($data, 200);
        }
    }
    public function editBlog(Request $request, $id)
    {
        $blog = Blog::find($id);

        if ($blog != null) {

            $blog->name = $request->name;
            $blog->description = $request->description;
            $blog->category_id = $request->category_id;
            $blog->tag_id = $request->tag_id;

            $blog->save();

            $data = [
                'status' => 200,
                'message' => $blog
            ];

            return response()->json($data, 200);
        }
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
