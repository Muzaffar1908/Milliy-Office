<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\About\About;
use App\Models\Administration\Administration;
use App\Models\Department\Department;
use App\Models\Employee\Employee;
use App\Models\Gallery\Gallery;
use App\Models\Main\Main;
use App\Models\News\News;
use App\Models\News\NewsCategory;
use App\Models\Partner\Partner;
use App\Models\Position\Position;
use App\Models\Specialist\Specialist;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'user_name',
        'gender',
        'user_image',
        'email',
        'phone',
        'password',
        'roll',
    ];

    public function users()
    {
        return $this->hasOne(NewsCategory::class, 'user_id', 'id');
    }

    public function news()
    {
        return $this->hasOne(News::class, 'user_id', 'id');
    }

    public function main()
    {
        return $this->hasOne(Main::class, 'user_id', 'id');
    }

    public function about()
    {
        return $this->hasOne(About::class, 'user_id', 'id');
    }

    public function partner()
    {
        return $this->hasOne(Partner::class, 'user_id', 'id');
    }

    public function gallery()
    {
        return $this->hasOne(Gallery::class, 'user_id', 'id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'user_id', 'id');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'user_id', 'id');
    }

    public function administration()
    {
        return $this->hasOne(Administration::class, 'user_id', 'id');
    }

    public function employee()
    {
        return $this->hasMany(Employee::class, 'user_id', 'id');
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
