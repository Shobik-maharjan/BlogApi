<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Category;
use App\Models\PivotBlogTag;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        try {

            $blogs = Blog::with('tags', 'category')->get();

            $data = [

                'status' => 200,
                'blogs' => $blogs
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function getSingleBlog($id)
    {
        try {

            $blogs = Blog::with('tags', 'category')->find($id);

            $data = [

                'status' => 200,
                'blogs' => $blogs
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function createBlog(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => "required",
                'category_id' => "required",
                // 'tag_id' => 'required|array',
                'category_id' => 'required',
                'image' => 'image|mimes:png,jpg,jpeg'
            ]);

            if ($validator->fails()) {
                $data = [
                    'status' => 422,
                    "message" => $validator->messages()
                ];
                return response()->json($data, 422);
            } else {
                // dd($request->tag_id);
                $blog = new Blog;

                $blog->name = $request->name;
                $blog->description = $request->description;
                $blog->category_id = $request->category_id;
                // $blog->tag_id = ($request->tag_id);

                // $imageName = time() . '.' . $request->image->extension();

                // $blog->image = $request->image->storeAs('images', $imageName);

                $blog->save();
                // $blog->id;
                foreach ($request->tag_id as $data) {
                    $new = PivotBlogTag::insert([
                        'blog_id' => $blog->id,
                        'tag_id' => $data
                    ]);
                }
                $data = [
                    'status' => 200,
                    'message' => 'data uploaded successfully',
                    // 'imagepath' => asset('image/' . $imageName)
                ];

                return response()->json($data, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function addImage(Request $request, $id)
    {
        try {

            Validator::make($request->all(), [
                'image' => 'image|mimes:png,jpg,jpeg'
            ]);

            $imageName = $request->file('image');
            $path = Storage::disk('public')->put('blogImage', $imageName);

            $blog = Blog::find($id);

            $blog->image = $path;

            $blog->save();
            // $imageName = time() . '.' . $request->image->extension();
            // dd($path);

            // $blog->image = $request->image->storeAs($path);

            return response()->json(['message' => 'image added successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function editBlog(Request $request, $id)
    {
        try {
            $blog = Blog::find($id);

            if ($blog != null) {

                $blog->name = $request->name;
                $blog->description = $request->description;
                $blog->category_id = $request->category_id;
                // $blog->tag_id = $request->tag_id;

                $blog->save();

                // $new = DB::table('pivot_blog_tag')->where('blog_id', $id)->delete();
                PivotBlogTag::where("blog_id", $id)->delete();

                foreach ($request->tag_id as $data) {
                    PivotBlogTag::insert([
                        "blog_id" => $id,
                        'tag_id' => $data
                    ]);
                }

                $data = [
                    'status' => 200,
                    'message' => $blog,
                    // 'tag' => $new
                ];

                return response()->json($data, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function deleteBlog($id)
    {
        try {
            $blog = Blog::find($id);
            $blog->delete();

            $data = [
                'status' => 200,
                'message' => "data deleted successfully"
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
