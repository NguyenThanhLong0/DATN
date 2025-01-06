@extends('admin.layouts.master')

@section('title')
    Quản lý Khách hàng
@endsection

@section('content')
    {{-- Thông báo thành công --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="white_card card_height_100 mb_30">
                <div class="white_card_header">
                    <div class="box_header m-0">
                        <div class="main-title">
                            <h1 class="m-0">Danh sách Khách hàng</h1>
                        </div>
                    </div>
                </div>
                <div class="white_card_body">
                    <div class="table-responsive">


                        <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">Thêm mới</a>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Điện thoại</th>
                                    <th>Địa chỉ</th>
                                    <th>Vai trò</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->customer_name }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>
                                            <span class="badge {{ $customer->role == 'admin' ? 'bg-info' : 'bg-success' }}">
                                                {{ ucfirst($customer->role) }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge {{ $customer->active ? 'bg-success' : 'bg-danger' }}">
                                                {{ $customer->active ? 'Active' : 'In_Active' }}
                                            </span>
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.customers.show', $customer) }}"
                                                class="btn btn-info">Xem</a>

                                            <a href="{{ route('admin.customers.edit', $customer) }}"
                                                class="btn btn-warning">Sửa</a>
                                                
                                            <form action="{{ route('admin.customers.destroy', $customer) }}"
                                                class="d-inline" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Bạn có chắc chắn chắn muốn xóa không?')"
                                                    class="btn btn-danger">Xóa</button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Phân trang -->
                        <div class="d-flex justify-content-center">{{ $customers->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
