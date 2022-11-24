<?php

namespace App\Models\Specialist;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'spe_name_uz',
      'spe_name_ru',
      'spe_name_en',
      'is_active',
    ];

    public function specialistTable()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
