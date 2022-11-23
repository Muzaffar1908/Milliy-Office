<?php

namespace App\Models\Gallery;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 
      'image',
      'youtobe_id',
      'is_active',
    ];

    public function gallTable()
    {
      return  $this->belongsTo(User::class, 'user_id');
    }
}
