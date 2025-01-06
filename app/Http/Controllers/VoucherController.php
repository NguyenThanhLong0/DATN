<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $list=DB::table('voucher')->join('product','voucher.product_id','=','product.product_id')->get();
        return view('admin.listVocher')->with([
            'list'=>$list,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.addVoucher');
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
        return redirect()->route('voucher.index')->with(['list'=>$data]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
         //
         $list=Voucher::where('voucher_id',$id)->first();
        //  dd($list);
         return view('admin.updateVoucher')->with(['list'=>$list]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
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
        return redirect()->route('voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    $voucher = Voucher::where('voucher_id',$id);
        $voucher->delete();
        return redirect()->route('voucher.index');
    }
}
