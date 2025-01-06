@extends('admin.layouts.master')\
@section('title')
    Colors
@endsection
@section('content')
    <h1>Danh sách colors</h1>
    <a class="btn btn-success" href="{{ route('admin.colors.create') }}" role="button">Thêm Mới</a>
    <br>
    @if (session('success'))
        <div class="alert alert-primary">
            {{ session('success') }}
        </div>
    @endif
    @if (session('delete'))
        <div class="alert alert-danger">
            {{ session('delete') }}
        </div>
    @endif
    <br>
    <table class="table table-striped">
        <thead class="table-light text-center">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Hex code</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Acction</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($colors as $color)
                <tr>
                    <td>{{ $color->id }}</td>
                    <td>{{ $color->color_name }}</td>
                    <td>{{ $color->hex_code }}</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($color->created_at)) }}</td>
                    <td>{{ date('d/m/Y H:i:s', strtotime($color->updated_at)) }}</td>


                    <td>
                        <a href="{{ route('admin.colors.show', $color) }}" class="btn btn-info">Xem</a>

                        <a href="{{ route('admin.colors.edit', $color) }}" class="btn btn-warning">Sửa</a>

                        <form action="{{ route('admin.colors.destroy', $color) }}" class="d-inline" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn có chắc chắn chắn muốn xóa không?')"
                                class="btn btn-danger">Xóa</button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $colors->links() }}
@endsection
