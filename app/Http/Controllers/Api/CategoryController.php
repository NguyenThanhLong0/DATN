<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->latest('id')->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'lấy dữ liệu thành công',
            'data'=>$categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'name'=>[
                'required',
                Rule::unique('categories')
            ],
            'description'=>'nullable'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'massage'=>'Thêm thất bại',
                'error'=>$validator->errors()
            ],400);
        }
       $data = $validator->validated();
        try {
            $category=Category::create($data);
            // dd($data);
            return response()->json([
                'status'=>true,
                'massage'=>'Thêm Thành công',
                'data'=>$category
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>'Lỗi hệ thống',
            ],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json([
            'status' => true,
            'message' => 'Hiển thị thành công',
            'data' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator =Validator::make($request->all(),[
            'name'=>[
                'required',
                Rule::unique('categories')->ignore($category->id)
            ],
            'description'=>'nullable'
        ]);
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'massage'=>'SỬa thất bại',
                'error'=>$validator->errors()
            ],400);
        }
       $data = $validator->validated();
        try {
            $category->update($data);
            // dd($data);
            return response()->json([
                'status'=>true,
                'massage'=>'Sửa Thành công',
                'data'=>$category
            ],201);
        } catch (\Throwable $th) {
            return response()->json([
                'status'=>false,
                'message'=>'Lỗi hệ thống',
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return response()->json([
            'status'=>true,
            'message'=>'Xoá thành công',
        ],200);
    }
}
