<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            
            // แก้ไขกฎของ avatar เพื่อไม่ใช้คำสั่ง image หรือ mimes
            'avatar' => [
                'nullable',
                'file',
                'max:2048', // ไม่เกิน 2MB
                function ($attribute, $value, $fail) {
                    // สร้างกฎเช็คนามสกุลไฟล์ด้วยตัวเอง
                    if ($value) {
                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                        // ใช้ getClientOriginalExtension() ซึ่งไม่ต้องพึ่งพา php_fileinfo
                        $extension = strtolower($value->getClientOriginalExtension());
                        
                        if (!in_array($extension, $allowedExtensions)) {
                            $fail('ไฟล์รูปโปรไฟล์ต้องเป็นนามสกุล: jpg, jpeg, png, gif หรือ webp เท่านั้นครับ');
                        }
                    }
                },
            ],
        ];
    }
}