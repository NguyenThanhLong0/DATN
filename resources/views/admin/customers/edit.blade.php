@extends('admin.layouts.master')

@section('title')
    Cập nhật Khách hàng {{ $customer->customer_name }}
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

    <form action="{{ route('admin.customers.update', $customer) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="customer_name" class="form-label">Tên khách hàng:</label>
            <input type="text" class="form-control" id="customer_name" value="{{ $customer->customer_name }}"
                name="customer_name" placeholder="Nhập tên khách hàng" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" value="{{ $customer->email }}" name="email"
                placeholder="Nhập email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Số điện thoại:</label>
            <input type="text" class="form-control" id="phone" value="{{ $customer->phone }}" name="phone"
                placeholder="Nhập số điện thoại" required>
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ:</label>
            <input type="text" class="form-control" id="address" value="{{ $customer->address }}" name="address"
                placeholder="Nhập địa chỉ" required>
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Vai trò:</label>
            <select class="form-control" id="role" name="role">
                <option value="admin" {{ $customer->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="member" {{ $customer->role == 'member' ? 'selected' : '' }}>Thành viên</option>
            </select>
        </div>

        <div class="form-group">
            <input type="checkbox" name="active" id="active" class="form-checkbox" value="1" {{ old('active', $customer->active ?? 0) ? 'checked' : '' }}>
            <label for="active">Active?</label>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </form>
@endsection
