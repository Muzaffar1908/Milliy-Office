<?php

namespace App\Models\About;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 
      'about_title_uz',    
      'about_title_ru',    
      'about_title_en',
      'section_number',
      'section_title_uz',    
      'section_title_ru',    
      'section_title_en',
      'is_active',    
    ];

    public function aboutTitle()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
