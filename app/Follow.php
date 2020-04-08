<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follow extends Model {
    protected $fillable = ['from_id', 'to_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
