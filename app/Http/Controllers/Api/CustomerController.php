<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::query()->latest('id')->paginate(5);

        return response()->json($customers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'required|in:admin,member',
            'active' => ['nullable', Rule::in([0, 1])],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->only(['customer_name', 'email', 'phone', 'address', 'role']);

            $data['password'] = bcrypt($request->input('password'));

            $data['active'] = $request->has('active') ? 1 : 0;

            $customer = Customer::create($data);

            return response()->json(['message' => 'Thêm mới thành công!', 'customer' => $customer], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Thêm mới thất bại!'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'required|in:admin,member',
            'active' => ['nullable', Rule::in([0, 1])],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $data = $request->only(['customer_name', 'email', 'phone', 'address', 'role']);

            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }
            $data['active'] = $request->has('active') ? 1 : 0;

            $customer->update($data);

            return response()->json(['message' => 'Sửa thành công!', 'customer' => $customer], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Sửa thất bại!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();

            return response()->json(['message' => 'Xóa thành công!'], 204);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Xóa thất bại!'], 500);
        }
    }
}
