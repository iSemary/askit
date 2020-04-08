<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Profile extends Model
{
    // Data In relationship
    protected $fillable =['user_id','avatar','bio','country'];

    //One to one
    public function user(){
        return $this->belongsTo(User::class);
    }
}
