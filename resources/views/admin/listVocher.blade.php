@extends('admin.layouts.master')
@section('content')
<a href="{{ route('voucher.create') }}"><button class="btn btn-success">Add voucher</button></a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>code</th>
            <th>discount_type</th>
            <th>discount_value</th>
            <th>start_date</th>
            <th>end_date</th>
            <th>min_oder_value</th>
            <th>product</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($list as $key=>$value)
        <tr>
            <td>{{ $value->code }}</td>
            <td>@if ($value->discount_type==0)
                value
                @else
                percent value
            @endif</td>
            <td>{{ $value->discount_value }}</td>
            <td>{{ $value->start_date }}</td>
            <td>{{ $value->end_date }}</td>
            <td>{{ $value->min_oder_value }}</td>
            <td>{{ $value->name }}</td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ route('voucher.edit', $value->voucher_id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('voucher.destroy', $value->voucher_id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </td>
            
        </tr>
        @endforeach
        
    </tbody>
</table>
@endsection
