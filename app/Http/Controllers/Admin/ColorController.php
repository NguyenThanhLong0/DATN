<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ColorController extends Controller
{
    //
    public function index(){
        $colors = Color::query()->orderBy("id","desc")->paginate(10);
        return view("admin.colors.index",compact("colors"));
    }
    public function create(){
        return view("admin.colors.create");
    }
    public function store(Request $request){
        $data = $request->validate([
            "color_name"=> ["required","string",'unique:colors'],
            "hex_code"=> ["required","string",'unique:colors'],
        ]);
        try {
            Color::create($data);
            return redirect()->route('admin.colors.index')->with('success','Thêm mới thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('success', 'Thêm thất bại');
        }
       
    }
    public function edit(Color $color){
        return view('admin.colors.edit',compact('color'));
    }
    public function update(Request $request,Color $color){
        $data = $request->validate([
            "color_name"=> ["required","string",Rule::unique("colors")->ignore($color->id)],
            "hex_code"=> ["required","string",Rule::unique("colors")->ignore($color->id)],
        ]);
        try {
            $color->update($data);
            return redirect()->route("admin.colors.index")->with("success","Cập nhập thành công");
        }catch (\Throwable $th) {
            return redirect()->back()->with("success","Cập nhập thất bại!");
        }
    }
    public function destroy(Color $color){
        $color->delete();
        return redirect()->back()->with("delete","Xóa thành công");
    }
}
