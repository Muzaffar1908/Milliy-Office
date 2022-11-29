<?php

namespace App\Models\Employee;

use App\Models\Department\Department;
use App\Models\Position\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
      'user_id', 
      'pos_id',
      'dep_id',
      'slug',
      'user_image',
      'full_name_uz',
      'full_name_ru',
      'full_name_en',
      'email',
      'phone',
      'title_uz',
      'title_ru',
      'title_en',
      'number_of_members',
      'biography_uz',
      'biography_ru',
      'biography_en',
      'responsibilities_uz',
      'responsibilities_ru',
      'responsibilities_en',
      'is_active',
    ];

    public function empuserTable()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function posTable()
    {
      return $this->belongsTo(Position::class, 'pos_id');
    }

    public function depTable()
    {
      return $this->belongsTo(Department::class, 'dep_id');
    }
}
