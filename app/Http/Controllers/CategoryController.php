<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function getCategory()
    {
        try {

            $category = Category::all();

            $data = [
                'status' => 200,
                'category' => $category
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => $e->getMessage()], 400);
        }
    }

    public function createCategory(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'category' => 'required'
            ]);

            if ($validator->fails()) {
                $data = [
                    'status' => 412,
                    "message" => $validator->error()
                ];
                return response()->json($data, 412);
            } else {

                $category = new Category;
                $category->category = $request->category;
                $category->save();

                $data = [
                    'status' => 200,
                    'message' => 'category added successfully'
                ];
                return response()->json($data, 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function editCategory(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            $category->category = $request->category;
            $category->save();

            $data = [
                'status' => 200,
                'message' => $category
            ];

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


    public function deleteCategory($id)
    {
        try {
            $category = Category::find($id);

            $category->delete();

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
