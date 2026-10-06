@extends('layouts.admin')

@section('title', 'จัดการผู้ใช้งานระบบ')

@section('content')
<div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-10">
    
    <!-- ส่วนหัวของหน้า -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-6">
        <div>
            <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">รายชื่อผู้ใช้งานทั้งหมด</h2>
            <p class="text-sm text-gray-500 mt-1">จัดการบัญชีผู้ใช้งาน และกำหนดสิทธิ์การเข้าถึงระบบ (Role)</p>
        </div>
    </div>

    <!-- ตารางแสดงผู้ใช้งาน -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="text-[11px] font-bold tracking-widest text-gray-400 uppercase border-b-2 border-gray-100">
                    <th class="p-4 pl-0">ผู้ใช้งาน (User)</th>
                    <th class="p-4">วันที่สมัคร</th>
                    <th class="p-4">สิทธิ์การใช้งาน (Role)</th>
                    <th class="p-4 text-right pr-0">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                @php
                    // จัดการรูปโปรไฟล์ลูกค้า
                    $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=FFFFFF&background=111827';
                @endphp
                <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors group">
                    
                    <!-- ข้อมูลผู้ใช้งานพร้อม Avatar -->
                    <td class="p-4 pl-0">
                        <div class="flex items-center gap-4">
                            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-11 h-11 rounded-full object-cover border border-gray-200">
                            <div>
                                <div class="flex items-center gap-2">
                                    <p class="font-bold text-gray-900 text-lg leading-tight">{{ $user->name }}</p>
                                    @if($user->id === Auth::id())
                                        <span class="px-2 py-0.5 bg-black text-white text-[10px] font-bold uppercase tracking-widest rounded-full">You</span>
                                    @endif
                                </div>
                                <p class="text-xs text-gray-500 font-medium">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>

                    <td class="p-4 text-gray-600 font-medium">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    
                    <!-- ป้ายแสดงสิทธิ์ (Role Badge) -->
                    <td class="p-4">
                        <span class="px-3 py-1.5 text-[10px] font-bold tracking-widest uppercase rounded-full border 
                            {{ $user->role == 'user' ? 'bg-gray-50 text-gray-600 border-gray-200' : '' }}
                            {{ $user->role == 'admin' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                            {{ $user->role == 'superadmin' ? 'bg-purple-50 text-purple-700 border-purple-200' : '' }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    
                    <td class="p-4 pr-0 text-right">
                        <!-- ปุ่มเปิด Modal จัดการ -->
                        <button onclick="openUserModal('{{ $user->id }}')" class="inline-flex items-center gap-2 px-5 py-2 bg-white border-2 border-gray-200 text-gray-900 rounded-full text-sm font-bold hover:border-black transition-all">
                            จัดการ
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- ========================================== -->
<!-- Modals สำหรับจัดการผู้ใช้งาน -->
<!-- ========================================== -->
@foreach ($users as $user)
@php
    $avatarUrl = $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&color=FFFFFF&background=111827';
    $isSelf = $user->id === Auth::id(); // เช็คว่าเป็นบัญชีตัวเองหรือไม่
@endphp

<div id="userModal-{{ $user->id }}" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeUserModal('{{ $user->id }}')"></div>
    
    <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col transform transition-all">
        
        <!-- Header -->
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-1">User Account</p>
                <h3 class="text-2xl font-extrabold text-gray-900 tracking-tight">การจัดการบัญชี</h3>
            </div>
            <button onclick="closeUserModal('{{ $user->id }}')" class="text-gray-400 hover:text-black transition-colors p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <!-- Body -->
        <div class="px-8 py-8 overflow-y-auto flex-1 custom-scrollbar space-y-8">
            
            @if($isSelf)
                <!-- แจ้งเตือนกรณีเป็นบัญชีตัวเอง -->
                <div class="bg-gray-900 text-white p-5 rounded-2xl flex items-start gap-4 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 flex-shrink-0 text-yellow-400"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3Z" /></svg>
                    <div>
                        <h4 class="font-bold text-sm tracking-wide">นี่คือบัญชีของคุณเอง</h4>
                        <p class="text-xs text-gray-400 mt-1">เพื่อความปลอดภัย ระบบไม่อนุญาตให้คุณปรับลดสิทธิ์ หรือลบบัญชีของตัวคุณเองในหน้านี้ได้</p>
                    </div>
                </div>
            @endif

            <!-- Profile Info -->
            <div class="flex items-center gap-5">
                <img src="{{ $avatarUrl }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-100 shadow-sm">
                <div>
                    <h4 class="text-2xl font-extrabold text-gray-900 tracking-tight">{{ $user->name }}</h4>
                    <p class="text-sm font-medium text-gray-500">{{ $user->email }}</p>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mt-2">Joined: {{ $user->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <!-- ฟอร์มอัปเดต Role (แบบการ์ดตัวเลือก SVG) -->
            <div>
                <p class="text-[11px] font-bold tracking-widest text-gray-400 uppercase mb-3">System Role</p>
                <form id="roleForm-{{ $user->id }}" action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 gap-4">
                        <!-- ตัวเลือก: ผู้ใช้ทั่วไป (User) -->
                        <label class="{{ $isSelf ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}">
                            <input type="radio" name="role" value="user" class="peer hidden" {{ $user->role == 'user' ? 'checked' : '' }} {{ $isSelf ? 'disabled' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all {{ !$isSelf ? 'hover:border-gray-300 peer-checked:border-gray-900 peer-checked:bg-gray-50' : 'peer-checked:border-gray-400' }}">
                                <div class="flex items-center gap-3 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-600"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">User (ผู้ใช้ทั่วไป)</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-8">สามารถสั่งจองรถยนต์ ทดลองขับ และจัดการโปรไฟล์ส่วนตัวได้</span>
                            </div>
                        </label>

                        <!-- ตัวเลือก: แอดมิน (Admin) -->
                        <label class="{{ $isSelf ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}">
                            <input type="radio" name="role" value="admin" class="peer hidden" {{ $user->role == 'admin' ? 'checked' : '' }} {{ $isSelf ? 'disabled' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all {{ !$isSelf ? 'hover:border-blue-200 peer-checked:border-blue-600 peer-checked:bg-blue-50/50' : 'peer-checked:border-blue-300' }}">
                                <div class="flex items-center gap-3 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-600"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" /></svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Admin (ผู้ดูแลระบบ)</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-8">เข้าถึงแผงควบคุม จัดการสินค้า คำสั่งซื้อ และคิวทดลองขับได้ทั้งหมด</span>
                            </div>
                        </label>

                        <!-- ตัวเลือก: ซูเปอร์แอดมิน (Superadmin) -->
                        <label class="{{ $isSelf ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}">
                            <input type="radio" name="role" value="superadmin" class="peer hidden" {{ $user->role == 'superadmin' ? 'checked' : '' }} {{ $isSelf ? 'disabled' : '' }}>
                            <div class="border-2 border-gray-100 rounded-2xl p-4 transition-all {{ !$isSelf ? 'hover:border-purple-200 peer-checked:border-purple-600 peer-checked:bg-purple-50/50' : 'peer-checked:border-purple-300' }}">
                                <div class="flex items-center gap-3 mb-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-purple-600"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
                                    <span class="font-bold text-gray-900 text-sm uppercase tracking-wide">Superadmin</span>
                                </div>
                                <span class="block text-xs text-gray-500 ml-8">สิทธิ์ขั้นสูงสุด ควบคุมได้ทุกฟังก์ชันรวมถึงการกำหนดสิทธิ์ผู้ใช้งานอื่น</span>
                            </div>
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-8 py-5 border-t border-gray-100 bg-gray-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
            @if(!$isSelf)
                <!-- ฟอร์มลบผู้ใช้ (ซ่อนถ้าเป็นตัวเอง) -->
                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('ยืนยันการลบบัญชี {{ $user->name }}? บัญชีนี้จะถูกลบออกจากระบบอย่างถาวร');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold tracking-wide uppercase transition-colors px-2 py-1">
                        ลบผู้ใช้งาน
                    </button>
                </form>
            @else
                <div></div> <!-- Placeholder ดันปุ่มไปทางขวา -->
            @endif

            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button type="button" onclick="closeUserModal('{{ $user->id }}')" class="w-full sm:w-auto px-6 py-3 border-2 border-gray-200 text-gray-700 font-bold rounded-full hover:border-gray-400 transition-colors">
                    ปิดหน้าต่าง
                </button>
                
                @if(!$isSelf)
                    <button type="button" onclick="document.getElementById('roleForm-{{ $user->id }}').submit();" class="w-full sm:w-auto px-8 py-3 bg-black text-white font-bold rounded-full hover:bg-gray-800 shadow-lg hover:shadow-xl transition-all">
                        อัปเดตสิทธิ์
                    </button>
                @endif
            </div>
        </div>

    </div>
</div>
@endforeach

<!-- Script สำหรับควบคุม Modal -->
<script>
    function openUserModal(id) {
        const modal = document.getElementById('userModal-' + id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeUserModal(id) {
        const modal = document.getElementById('userModal-' + id);
        if (modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    }
</script>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 20px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #d1d5db; }
</style>
@endsection