<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. ตรวจสอบอีเมลและรหัสผ่าน
        $request->authenticate();

        // 2. สร้าง Session ใหม่เพื่อความปลอดภัย
        $request->session()->regenerate();

        // 3. ตรวจสอบสิทธิ์ (Role) ของผู้ใช้ที่เพิ่งล็อกอิน
        $userRole = $request->user()->role;
        
        if ($userRole === 'admin' || $userRole === 'superadmin') {
            // ถ้าเป็นผู้ดูแลระบบ ให้พาไปหน้า Dashboard ของ Admin
            return redirect()->intended(route('admin.dashboard'));
        }

        // ถ้าเป็นผู้ใช้ทั่วไป ให้พาไปหน้า Dashboard ปกติ
        return redirect()->intended(route('dashboard'));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    
}
