<?php

namespace App;

use App\Models\News;
use App\Models\Reporter;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'phone', 'role_id', 'gender', 'birthday', 'image', 'creator_id', 'email', 'password', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userinfo(){
        return $this->hasOne(Reporter::class);
    }

    public function reporter(){
        return $this->hasOne(Reporter::class);
    }

    public function news(){
        return $this->belongsTo(News::class);
    }

    public function allnews(){
        return $this->hasMany(News::class, 'user_id');
    }
}
