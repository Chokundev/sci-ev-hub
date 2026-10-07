<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage; // <--- สำคัญ
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // ==========================================
        // อัปเดตการชี้ Path ไปที่โฟลเดอร์ public โดยตรง
        // ==========================================
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            
            $filename = 'avatar_' . uniqid() . '.' . strtolower($file->getClientOriginalExtension());
            
            // ใช้ public_path() เพื่อชี้เป้าหมายไปที่โฟลเดอร์จริงหน้าบ้านที่เราเพิ่งสร้าง
            $destinationPath = public_path('storage/avatars');
            
            $file->move($destinationPath, $filename);
            
            // ชื่อที่บันทึกลงฐานข้อมูลยังคงเหมือนเดิม เพื่อให้ดึงไปใช้งานด้วย asset('storage/...') ได้ตามปกติ
            $request->user()->avatar = 'avatars/' . $filename;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        // โค้ดส่วนลบบัญชีคงเดิม
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}