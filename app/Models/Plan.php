<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['title','user_id'];
    // protected $fillable = ['title','description','price','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function days()
    {
        return $this->hasMany(PlanDay::class);
    }
}
