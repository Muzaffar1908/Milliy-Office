<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
      'address_uz',    
      'address_ru',    
      'address_en',
      'phone',
      'email',
      'started_at',    
      'stopped_at',    
    ];
}
