@extends('admin.layouts.master')\
@section('title')
   Update Colors
@endsection
@section('content')
    <h1>Cập nhập colors</h1>
    @if (session('success'))
        <div class="alert alert-primary">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('admin.colors.update', $color)}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="color_name" class="form-label">Name color:</label>
            <input type="text" name="color_name" id="" class="form-control" placeholder="Enter your color_name" value="{{$color->color_name}}">
            @error('color_name')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="hex_code" class="form-label">hex code:</label>
            <input type="text" name="hex_code" id="" class="form-control" placeholder="Enter your hex_code" value="{{$color->hex_code}}">
            @error('hex_code')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
   
@endsection
