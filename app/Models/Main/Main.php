<?php

namespace App\Models\Main;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'logo_title_uz',
      'logo_title_ru',
      'logo_title_en',
      'title_uz',
      'title_ru',
      'title_en',
      'description_uz',
      'description_ru',
      'description_en',
      'youtobe_id',
      'background_image',
      'is_active'
    ];

    public function mainPage()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
