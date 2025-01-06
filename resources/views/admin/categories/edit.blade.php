@extends('admin.layouts.master')
@section('content')
<div class="mb-5">
    <h1>Sửa Danh Mục</h1>
</div>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if (session()->has('success'))
        <div class="alert alert-success">
                {{session()->get('success')}}
        </div>
    @endif
<div class="container">
    <form method="post" action="{{route('category.update',$category)}}">
        @csrf
        @method('PUT')
        <div class="mb-3 row">
            <label for="name" class="col-4 col-form-label">Name</label>
            <div class="col-8">
                <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}" />
            </div>
        </div>
        <div class="mb-3 row">
            <label for="description" class="col-4 col-form-label">Description</label>
            <div class="col-8">
                <textarea name="description" class="form-control" id="description" cols="30" rows="5">{{$category->description}}</textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-primary">
                    Sửa
                </button>
            </div>
        </div>
    </form>
</div>
@endsection