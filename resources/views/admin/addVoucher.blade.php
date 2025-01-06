@extends('admin.layouts.master')
@section('content')
<form action="{{ route('voucher.store') }}" method="POST">
    @csrf
    <div>
        <label for="">Code:
            <input type="text" name="code" id="">
        </label>
    </div>
    <div>
        <label for="">discount_type:
            <select name="discount_type" id="">
                <option value="0">Value</option>
                <option value="1">percent value                </option>
            </select>
        </label>
    </div>
    <div>
        <label for="">discount_value:
            <input type="number" name="discount_value" id="">
        </label>
    </div>
    <div>
        <label for="">start_date:
            <input type="date" name="start_date" id="">
        </label>
    </div>
    <div>
        <label for="">end_date:
            <input type="date" name="end_date" id="">
        </label>
    </div>
    <div>
        <label for="">min_oder_value:
            <input type="number" name="min_oder_value" id="">
        </label>
    </div>
    <div>
        <label for="">product_id:
            <input type="text" name="product_id" id="">
        </label>
    </div>
    <div>
        <button class="btn btn-success">ADD</button>
    </div>
</form>
@endsection