<?php

namespace App\Models\Position;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = [
        'pos_name_uz',
        'pos_name_ru',
        'pos_name_en',
        'is_active',
    ];

    public function positionTable()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
}
