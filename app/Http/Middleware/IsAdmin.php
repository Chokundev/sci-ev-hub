<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // เช็คว่าผู้ใช้ล็อกอินหรือยัง และมีสิทธิ์เป็น admin หรือ superadmin หรือไม่
        if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')) {
            return $next($request); // ให้ผ่านเข้าไปได้
        }

        // ถ้าไม่ใช่ Admin ให้เด้งกลับไปหน้าหลัก พร้อมแจ้งเตือน
        return redirect('/')->with('error', 'คุณไม่มีสิทธิ์เข้าถึงหน้านี้');
    }
}