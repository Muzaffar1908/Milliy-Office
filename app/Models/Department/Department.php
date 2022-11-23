<?php

namespace App\Models\Department;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
     'dep_name_uz',
     'dep_name_ru',
     'dep_name_en',
     'is_active',
    ];


    public function departmentTable()
    {
        return $this->belongsTo(User::class, 'user_id');
    } 
}
