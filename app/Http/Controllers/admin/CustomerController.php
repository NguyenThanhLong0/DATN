<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    const PARTH_VIEW = 'admin.customers.';

    public function index()
    {
        $customers = Customer::latest('id')->paginate(5);

        return view(self::PARTH_VIEW . __FUNCTION__, compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PARTH_VIEW . __FUNCTION__);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'required|in:admin,member',
            'active' => ['nullable', Rule::in([0, 1])],
        ]);

        try {
            $data = $request->only(['customer_name', 'email', 'password', 'phone', 'address', 'role']);

            $data['password'] = bcrypt($data['password']);
            
            $data['active'] = $request->has('active') ? 1 : 0;

            Customer::create($data);

            return redirect()->route('admin.customers.index')
                ->with('success', 'Thêm mới khách hàng thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Thêm mới khách hàng thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view(self::PARTH_VIEW . __FUNCTION__, compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view(self::PARTH_VIEW . __FUNCTION__, compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'required|in:admin,member',
            'active' => ['nullable', Rule::in([0, 1])],
        ]);

        try {
            $data = $request->only(['customer_name', 'email', 'phone', 'address', 'role']);
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->input('password'));
            }
            $data['active'] = $request->has('active') ? 1 : 0;

            $customer->update($data);

            return redirect()->route('admin.customers.index')
                ->with('success', 'Cập nhật khách hàng thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Cập nhật khách hàng thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();

            return redirect()->route('admin.customers.index')
                ->with('success', 'Xóa khách hàng thành công!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Xóa khách hàng thất bại!');
        }
    }
}
