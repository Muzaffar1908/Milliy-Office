<?php

namespace App\Models\News;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'category_name_uz',
      'category_name_ru',
      'category_name_en',
      'is_active',
    ];

    public function usersTable()
    {
       return $this->belongsTo(User::class, 'user_id');
    }

    public function news()
    {
      return $this->hasMany(News::class, 'cat_id', 'id');
    }
}
