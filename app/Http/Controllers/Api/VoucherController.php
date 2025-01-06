<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Voucher;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list=Voucher::get();
        return response()->json([
            'list'=>$list
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data=new Voucher();
        $data->code=$request->code;
        $data->discount_type=$request->discount_type;
        $data->discount_value=$request->discount_value;
        $data->start_date=$request->start_date;
        $data->end_date=$request->end_date;
        $data->min_oder_value=$request->min_oder_value;
        $data->product_id=$request->product_id;
        
        $data->save();
        return response()->json(['list'=>$data],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $list=Voucher::where('voucher_id',$id)->first();
        if($list==null){
            return response()->json([
                'list'=>'Khong tim thay ban ghi'
            ],200);
        }
        return response()->json([
            'list'=>$list
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $list=Voucher::where('voucher_id',$id);
        $data=[
        'code'=>$request->code,
        'discount_type'=>$request->discount_type,
        'discount_value'=>$request->discount_value,
        'start_date'=>$request->start_date,
        'end_date'=>$request->end_date,
        'min_oder_value'=>$request->min_oder_value,
        'product_id'=>$request->product_id,
        ];     
        // dd($list);

        // $list->update($data);
        $list->update($data);
        return response()->json($list,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $voucher = Voucher::where('voucher_id',$id);
        $voucher->delete();
        return response()->json(['mess'=>'xoa thanh cong'],200);
    }
}
