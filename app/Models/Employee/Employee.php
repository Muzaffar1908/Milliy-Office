<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 
      'emp_id',
      'full_name_uz',
      'full_name_ru',
      'full_name_en',
      'email',
      'phone',
      'is_active',
    ];
}
