@extends('admin.layouts.master')
@section('content')
<form action="{{ route('voucher.update',$list->voucher_id) }}" method="POST">
    @csrf
    @method('put')
    <div>
        <label for="">Code:
            <input type="text" name="code" id="" value="{{ $list-> code }}" >
        </label>
    </div>
    <div>
        <label for="">discount_type:
            <select name="discount_type" id=""value="">
                <option value="0" @php
                    if ($list->discount_type==0) {
                        echo 'selected';
                    }
                @endphp>Value</option>
                <option value="1" @php
                if ($list->discount_type==1) {
                    echo 'selected';
                }
            @endphp>percent value                </option>
            </select>
        </label>
    </div>
    <div>
        <label for="">discount_value:
            <input type="number" name="discount_value" id="" value="{{ $list->discount_value }}">
        </label>
    </div>
    <div>
        <label for="">start_date:
            <input type="date" name="start_date" id="" value="{{ $list->start_date }}">
        </label>
    </div>
    <div>
        <label for="">end_date:
            <input type="date" name="end_date" id=""value="{{ $list->end_date }}">
        </label>
    </div>
    <div>
        <label for="">min_oder_value:
            <input type="number" name="min_oder_value" id=""value="{{ $list->min_oder_value }}">
        </label>
    </div>
    <div>
        <label for="">product_id:
            <input type="text" name="product_id" id=""value="{{ $list->product_id }}">
        </label>
    </div>
    <div>
        <button class="btn btn-success">ADD</button>
    </div>
</form>
@endsection