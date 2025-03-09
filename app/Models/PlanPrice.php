<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanPrice extends Model
{
    protected $fillable=['title','sub_title','plan_detail','currency','price'];
}
