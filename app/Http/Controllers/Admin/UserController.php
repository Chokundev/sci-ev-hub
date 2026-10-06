<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // แสดงรายการผู้ใช้ทั้งหมด
    public function index()
    {
        // ดึงข้อมูลผู้ใช้ทั้งหมด เรียงตามวันที่สมัครล่าสุด
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    // อัปเดตสิทธิ์การใช้งาน (Role)
    public function updateRole(Request $request, User $user)
    {
        // ป้องกันไม่ให้เปลี่ยนสิทธิ์ตัวเองผ่านหน้านี้ (ป้องกันการเผลอปลดสิทธิ์ตัวเอง)
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'คุณไม่สามารถเปลี่ยนสิทธิ์ของตัวคุณเองได้');
        }

        $request->validate([
            'role' => 'required|in:user,admin,superadmin'
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', 'อัปเดตสิทธิ์ของ ' . $user->name . ' เป็น ' . $request->role . ' สำเร็จแล้ว');
    }

    // ลบผู้ใช้งาน
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'คุณไม่สามารถลบบัญชีของตัวคุณเองได้');
        }

        $user->delete();
        return redirect()->back()->with('success', 'ลบบัญชีผู้ใช้เรียบร้อยแล้ว');
    }
}