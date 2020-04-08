<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Profile;
use App\Follow;
use App\Answer;
use App\Role;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'to_id', 'user_name','full_name', 'email', 'password',
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

    public function profile(){
        return $this->hasOne(Profile::class, 'user_id');
    }
    public function follow(){
        return $this->hasMany(Follow::class,'to_id');
    }
    public function question(){
        return $this->hasMany(Question::class,'to_id');
    }
    public function answer(){
        return $this->hasMany(Answer::class,'to_id');
    }
}