<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanPrice extends Model
{
    protected $table = "plan_prices";
    protected $fillable=['title','sub_title','plan_detail','currency','price'];
}
