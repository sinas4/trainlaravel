<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificationCode extends Model
{
    protected $fillable = [
        'phone', 'code', 'is_used', 'expires_at'
    ];
    
    protected $casts = [
        'expires_at' => 'datetime',
        'is_used' => 'boolean',
    ];
    
    public function isExpired()
    {
        return now()->gt($this->expires_at);
    }
    
    public static function generateCode($phone)
    {
        // حذف کدهای قبلی
        self::where('phone', $phone)->delete();
        
        // ساخت کد جدید
        $code = rand(100000, 999999);
        
        return self::create([
            'phone' => $phone,
            'code' => $code,
            'expires_at' => now()->addMinutes(5),
            'is_used' => false,
        ]);
    }
}