@extends('layouts.admin')

@section('title', 'จัดการผู้ใช้งานระบบ')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-gray-800">รายชื่อผู้ใช้งานทั้งหมด</h2>
            <p class="text-sm text-gray-500">จัดการสิทธิ์การเข้าถึงระบบและบัญชีผู้ใช้</p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-500 text-sm border-b border-gray-100">
                    <th class="p-4 font-medium rounded-tl-xl">ชื่อผู้ใช้</th>
                    <th class="p-4 font-medium">อีเมล</th>
                    <th class="p-4 font-medium">วันที่สมัคร</th>
                    <th class="p-4 font-medium">สิทธิ์การใช้งาน (Role)</th>
                    <th class="p-4 font-medium rounded-tr-xl">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                    <td class="p-4 font-semibold text-gray-800">
                        {{ $user->name }}
                        @if($user->id === Auth::id())
                            <span class="ml-2 px-2 py-0.5 bg-blue-100 text-blue-700 text-[10px] rounded-full">คุณ</span>
                        @endif
                    </td>
                    <td class="p-4 text-gray-600">{{ $user->email }}</td>
                    <td class="p-4 text-gray-500 text-sm">{{ $user->created_at->format('d/m/Y') }}</td>
                    
                    <!-- ส่วนอัปเดต Role -->
                    <td class="p-4">
                        <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            @method('PUT')
                            <select name="role" class="px-3 py-1 bg-white border border-gray-200 rounded-lg text-sm outline-none focus:border-cyan-500 transition {{ $user->id === Auth::id() ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $user->id === Auth::id() ? 'disabled' : '' }}>
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>ผู้ใช้ทั่วไป</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>แอดมิน</option>
                                <option value="superadmin" {{ $user->role == 'superadmin' ? 'selected' : '' }}>ซูเปอร์แอดมิน</option>
                            </select>
                            @if($user->id !== Auth::id())
                                <button type="submit" class="text-blue-500 hover:text-blue-700 text-sm font-medium">อัปเดต</button>
                            @endif
                        </form>
                    </td>

                    <!-- ปุ่มลบผู้ใช้ -->
                    <td class="p-4">
                        @if($user->id !== Auth::id())
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าต้องการลบบัญชีนี้?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">ลบ</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection