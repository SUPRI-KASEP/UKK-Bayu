<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect based on role
            if ($user->role == 'admin') {
                return redirect()->route('admin.beranda');
            } elseif ($user->role == 'member') {
                return redirect()->route('member.beranda');
            } else {
                return redirect()->route('beranda');
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function showRegisterForm()
    {
        return view('daftar');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);

        // GUNAKAN Hash::make() DARI bcrypt()
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // PERBAIKI: Hash::make()
            'role' => 'member',
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil didaftarkan');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('beranda');
    }
}
