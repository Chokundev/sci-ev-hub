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
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // จัดการอัปโหลดรูปโปรไฟล์
        if ($request->hasFile('avatar')) {
            // ถ้ามีรูปเก่าอยู่ ให้ลบทิ้งก่อนเพื่อประหยัดพื้นที่
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            // อัปโหลดรูปใหม่และเก็บ Path
            $user->avatar = $request->file('avatar')->store('avatars', 'public');
        }

        $user->save();

        // ส่งกลับพร้อม session แจ้งเตือนว่าสำเร็จ
        return Redirect::route('profile.edit')->with('success', 'อัปเดตข้อมูลโปรไฟล์เรียบร้อยแล้ว!');
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