@extends('admin.layouts.master')
@section('content')
    <h1>Danh sách danh mục</h1>
    @if (session()->has('success'))
    <div class="alert alert-success">
            {{session()->get('success')}}
    </div>
@endif
    <a class="btn btn-success" href="{{route('category.create')}}" role="button">Thêm Mới</a>

        <table class="table table-striped table-hover mt-2 mb-2">
            <thead class="table-light text-center">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Acction</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-center">
                @foreach ($categories as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->description }}</td>
                        <td>{{ $c->created_at }}</td>
                        <td>{{ $c->updated_at }}</td>

                        
                        <td>
                            <div class="btn-group gap-2">
                                <a name="" id="" class="btn btn-info"href="{{route('category.show',$c)}}"role="button">Show</a>
                                <a name="" id="" class="btn btn-warning"href="{{route('category.edit',$c)}}"role="button">edit</a>
                                {{-- <form action="{{ route('category.destroy', $c) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn không?')">Xoá Mềm</button>
                                </form> --}}
                                <form action="{{ route('category.forceDestroy', $c) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Bạn có chắc chắn không?')">Xoá Cứng</button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    {{ $categories->links() }}
@endsection