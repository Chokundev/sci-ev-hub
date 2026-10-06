<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestDrive;
use Illuminate\Http\Request;

class TestDriveController extends Controller
{
    // แสดงรายการจองคิวทดลองขับทั้งหมด
    public function index()
    {
        // ดึงข้อมูลการจอง พร้อมข้อมูล User และ Product เรียงตามวันที่อัปเดตล่าสุด
        $testDrives = TestDrive::with(['user', 'product'])->latest()->get();
        return view('admin.test-drives.index', compact('testDrives'));
    }

    // อัปเดตสถานะคิวทดลองขับ
    public function updateStatus(Request $request, TestDrive $testDrive)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $testDrive->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'อัปเดตสถานะคิวทดลองขับสำเร็จแล้ว!');
    }
}