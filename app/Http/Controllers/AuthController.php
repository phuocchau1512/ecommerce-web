<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

public function register(){
    return view('register');
}


public function handleRegister(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'name.required' => 'Vui lòng nhập họ tên',
                'name.min' => 'Họ tên phải ít nhất 3 ký tự',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
                'password.confirmed' => 'Mật khẩu nhập lại không khớp',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Đăng ký thành công');
    }


public function login()
{
    return view('login');
}

public function handleLogin(Request $request)
{
    // 1. Validate
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    // 2. Thử đăng nhập
    if (Auth::attempt($credentials)) {

        // regenerate session để tránh session fixation
        $request->session()->regenerate();

        return redirect('/')
            ->with('success', 'Đăng nhập thành công');
    }

    // 3. Sai email hoặc mật khẩu
    return back()
        ->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])
        ->withInput();
}
}

