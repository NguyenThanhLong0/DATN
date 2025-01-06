<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->latest('id')->paginate(10);
        return view('admin/categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin/categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>[
                'required',
                Rule::unique('categories')
            ],
            'description'=>'nullable'
        ]);
       
        try {
            Category::create($data);
            // dd($data);
            return back()->with('success','Thao tác thành công');
            // return redirect()->route('category.index')->with('success','Thao tác thành công');
        } catch (\Throwable $th) {
            return back()->with('success','Thêm thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin/categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin/categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'=>[
                'required',
                Rule::unique('categories')->ignore($category->id)
            ],
            'description'=>'nullable'
        ]);
        try {
           $category->update($data);
            return back()->with('success','Thao tác thành công');
        } catch (\Throwable $th) {
            return back()->with('success','Thao tác thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return back()->with('success','Xoá thành công');
        } catch (\Throwable $th) {
            return back()->with('success','Thao tác thất bại');
        }
    }
    public function forceDestroy(Category $category)
    {
        try {
            $category->forceDelete();
            return back()->with('success','Xoá thành công');
        } catch (\Throwable $th) {
            return back()->with('success','Thao tác thất bại');
        }
    }
}
