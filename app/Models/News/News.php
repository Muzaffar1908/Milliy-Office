<?php

namespace App\Models\News;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'cat_id',
      'title_uz',
      'title_ru',
      'title_en',
      'news_image',
      'desctiprion_uz',
      'desctiprion_ru',
      'desctiprion_en',
      'is_active',
    ];

    // public function scopeLastNews()
    // {
    //   $SysLang = \App::getLocale();
    //   return self::query()
    //   ->leftjoin('news_categories', 'news.cat_id', '=', 'news_categories.id')
    //   ->leftjoin('users', 'news.user_id', '=', 'users.id')
    //   ->select('news.id','news.cat_id', 'news.user_id', 'news.user_image', 'news.created_at', 'news.title_'. $SysLang . ' as title', 'news.description_'. $SysLang . ' as small_text', 'news_categories.title_'. $SysLang . ' as cat_title', 'users.id', 'users.first_name')
    //   ->where(array('news.status'=>'1'))
    //   ->orderBy('news.created_at', 'DESC');
    // }

    public function usersNews()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function news_cat()
    {
      return $this->belongsTo(NewsCategory::class, 'cat_id');
    }
}
