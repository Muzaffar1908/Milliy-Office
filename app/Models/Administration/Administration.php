<?php

namespace App\Models\Administration;

use App\Models\Position\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'pos_id',
      'user_image',
      'full_name_uz',
      'full_name_ru',
      'full_name_en',
      'email',
      'phone',
      'title_uz',
      'title_ru',
      'title_en',
      'biography_uz',
      'biography_ru',
      'biography_en',
      'responsibilities_uz',
      'responsibilities_ru',
      'responsibilities_en',
    ];

    public function administrationTable()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function positionTable()
    {
        return $this->belongsTo(Position::class, 'pos_id');
    }
}
