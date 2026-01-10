<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    // Danh sách user
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,user',
        ], [
            'email.unique' => 'Email đã tồn tại',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Thêm người dùng thành công');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role'  => 'required|in:admin,user',
            'password' => 'nullable|min:6',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        // Nếu có nhập mật khẩu mới thì mới update
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Cập nhật người dùng thành công');
    }


    // Xóa user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Xóa tài khoản thành công');
    }
}
