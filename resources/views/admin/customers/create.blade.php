@extends('admin.layouts.master')

@section('title')
    Thêm mới Khách hàng
@endsection

@section('content')

    {{-- Thông báo thành công --}}
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    {{-- Thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.customers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Chống lỗi --}}
        <div class="row">
            <div class="">
                <div class="form-group mb-2">
                    <label for="customer_name" class="form-label">Tên khách hàng:</label>
                    <input type="text" class="form-control" id="customer_name" placeholder="Nhập tên khách hàng"
                        name="customer_name" value="{{ old('customer_name') }}">
                </div>

                <div class="form-group mb-2">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email"
                        value="{{ old('email') }}">
                </div>

                <div class="form-group mb-2">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu"
                        value="{{ old('password') }}">
                </div>

                <div class="form-group mb-2">
                    <label for="phone" class="form-label">Số điện thoại:</label>
                    <input type="text" class="form-control" id="phone" placeholder="Nhập số điện thoại"
                        name="phone" value="{{ old('phone') }}">
                </div>

                <div class="form-group mb-2">
                    <label for="address" class="form-label">Địa chỉ:</label>
                    <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ" name="address"
                        value="{{ old('address') }}">
                </div>

                <div class="form-group mb-2">
                    <label for="role" class="form-label">Vai trò:</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="member">Thành viên</option>
                    </select>
                </div>

                <div class="form-group mb-2">
                    <input type="checkbox" class="form-checkbox" id="active" value="1" name="active"
                        value="{{ old('active') ? 'checked' : '' }}">
                    <label class="form-check-label" for="active">Active?</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5">Thêm mới</button>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary mt-5">Quay lại danh sách</a>
    </form>
@endsection
