<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'method',
    ];

    /**
     * Foydalanuvchi bilan bog'lanish (Kim to'lov qilgan).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * To'lovga tegishli zakazlar (agar bir to'lovga bir nechta order bo'lsa).
     * Hozircha one-to-one bo'lsa ham, ko'p bo'lishi mumkin deb one-to-many qilinmoqda.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
