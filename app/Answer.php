<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Answer extends Model
{
    protected $fillable=['question_id','from_id','to_id','answer_body'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
