<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [""];
    // protected $fillable = ['title', 'thumbnail', 'video_url', 'prep_time', 'cook_time', 'description', 'dish_id', 'course_id', 'method_id', 'diet_id'];


    public function comments()
    {
        return $this->hasMany(Comment::class, 'recipe_id');
    }

    public function favouritedByUsers()
    {
        return $this->belongsToMany(User::class, 'favourite_recipes', 'recipe_id', 'user_id')
            ->withTimestamps();
    }

    public function planDays()
    {
        return $this->belongsToMany(PlanDay::class, 'plan_day_recipe', 'recipe_id', 'plan_day_id')
            ->withTimestamps();
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
    public function methods()
    {
        return $this->hasMany(RecipeMethod::class);
    }
    public function nutrition()
    {
        return $this->hasMany(Nutrition::class);
    }

}
