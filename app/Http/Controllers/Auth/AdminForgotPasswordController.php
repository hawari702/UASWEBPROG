<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminForgotPasswordController extends Controller
{
    public function create()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        // Cek apakah nama dan email cocok
        $user = User::where('email', $request->email)
                    ->where('name', $request->name)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Nama dan email tidak ditemukan.'
            ]);
        }

        // Generate token
        $token = Str::random(60);
        
        // Simpan token
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now()
            ]
        );

        // Redirect ke form reset password dengan token
        return redirect()->route('admin.password.reset', ['token' => $token])
                        ->with('status', 'Silakan reset password Anda.');
    }

    public function resetForm(Request $request, $token)
    {
        return view('auth.admin-reset-password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token
        \DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->delete();

        return redirect()->route('admin.login')
                        ->with('status', 'Password berhasil direset!');
    }
} 