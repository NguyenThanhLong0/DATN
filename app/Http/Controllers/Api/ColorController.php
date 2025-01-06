<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ColorController extends Controller
{
    //
    public function index(){
        try {
            $colors = Color::query()->latest('id')->paginate(10);
            return response()->json([
                'message' => 'Hiển thị thành công',
                'satus' => true,
                'data' => $colors
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'lỗi',
                'satus'=> false,
            ]);
        }
    }
    public function show($id){
        try {
            $colors = Color::query()->findOrFail($id);
            return response()->json([
                'message'=> 'Chi tiết',
                'status'=> true,
                'data'=> $colors
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=> 'Không tìm thấy bản ghi nào',
                'status'=> false
            ]);
        }
    }
    public function store(Request $request){
        $data = $request->all();
        $validatior = Validator::make($data, [
            'color_name'=> 'require|string|unique:colors',
            'hex_code'=> 'require|string|unique:colors',
        ]);
        try {
             $colors = Color::create($data);
             return response()->json([
                'message'=> 'Thêm mới thành công!!',
                'status'=> true,
                'data'=> $colors
             ]);
        } catch (\Throwable $th) {
           return response()->json([
            'message'=> 'Thêm mới thất bại',
            'status'=> false
           ]);
        }
    }
    public function update(Request $request, Color $color)
    {
        $data = $request->validate([
            "color_name"=> ["required","string",Rule::unique("colors")->ignore($color->id)],
            "hex_code"=> ["required","string",Rule::unique("colors")->ignore($color->id)],
        ]);
        try {
           $color->update($data);
           return response()->json([
            'message'=> 'Cập nhập thành công',
            'status'=> true
           ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message'=> 'Cập nhập thất bại',
                'status'=> false
               ]);
        }
    }   
    public function destroy($id){
        try {
            $colors = Color::query()->findOrFail($id);
            $colors->delete();
            return response()->json([
                'message'=> 'Xóa thành công',
                'status'=> true,
            ]) ;
        } catch (\Throwable $th) {
            return response()->json([
                'message'=> 'Xóa thất bại',
                'status'=> false
            ]);
        }
    }
}
