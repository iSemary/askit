<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Question extends Model
{
    //Privacy = Send anonymous
    // IF Privacy = 1 it's anonymous
    // IF Privacy = 0 Not anonymous
    protected $fillable=['from_id','to_id','question_body','privacy','answerd'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
