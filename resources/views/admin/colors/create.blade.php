@extends('admin.layouts.master')\
@section('title')
    Colors
@endsection
@section('content')
    <h1>Thêm mới colors</h1>
    @if (session('success'))
    <div class="alert alert-primary">
        {{ session('message') }}
    </div>
@endif
    <form action="{{ route('admin.colors.store')}}" method="post">
        @csrf
        <div class="mb-3">
            <label for="color_name" class="form-label">Name color:</label>
            <input type="text" name="color_name" id="" class="form-control" placeholder="Enter your color_name">
            @error('color_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="hex_code" class="form-label">hex code:</label>
            <input type="text" name="hex_code" id="" class="form-control" placeholder="Enter your hex_code">
            @error('hex_code')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">ADD</button>
    </form>
   
@endsection
