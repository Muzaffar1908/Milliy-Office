<?php

namespace App\Models\Partner;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id',
      'image',
      'image_url',
      'is_active',
    ];

    public function partnerTable()
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
