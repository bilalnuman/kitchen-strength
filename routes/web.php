<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DietController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\FavouriteRecipeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PlanDayController;
use App\Http\Controllers\PlanDayRecipeController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeMethodController;
use App\Http\Controllers\ShoppingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password-reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password-reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {

    Route::middleware(['admin'])->group(function () {
        Route::prefix('dashboard')->group(function (): void {
            Route::get('/', [AdminController::class, 'dashboard']);
            Route::resource('users', UserController::class);
            Route::resource('courses', CourseController::class);
            Route::resource('diets', DietController::class);
            Route::resource('dishes', DishController::class);
            Route::resource('methods', MethodController::class);
            Route::resource('prices', PriceController::class);
            Route::resource('recipes', RecipeController::class);
        });
    });
    
    Route::prefix('')->group(function (): void {
        Route::get('plan-prices', [PriceController::class,'planPrice'])->name('plan.prices');
    });



    Route::resource('plans', PlanController::class);
    Route::resource('ingredients', IngredientController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('accounts', AccountController::class);
    Route::resource('nutritions', NutritionController::class);

    Route::get('/meal-plan', [PlanController::class, 'mealPlan'])->name('meal-plan');
    Route::get('/get-latest-recipe', [RecipeController::class, 'getLatestRecipe']);
    Route::post('/plan-days/add', [PlanDayController::class, 'store']);

    Route::delete('/plan-days/{id}/delete', [PlanDayController::class, 'delete']);
    Route::get('/plan-days/recipe', [PlanDayRecipeController::class, 'index']);
    Route::post('/plan-days/recipe', [PlanDayRecipeController::class, 'store']);
    Route::delete('/plan-days/recipe/{id}', [PlanDayRecipeController::class, 'delete']);


    Route::post('/shopping', [ShoppingController::class, 'store'])->name('shopping.store');
    Route::get('/shoppings', [ShoppingController::class, 'index'])->name('shopping.index');
    Route::delete('/shopping/{id}', [ShoppingController::class, 'delete'])->name('shopping.delete');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/favourites', [FavouriteRecipeController::class, 'getFavouriteRecipes'])->name('favourite.index');
    Route::get('/favourite/{id}', [FavouriteRecipeController::class, 'toggleFavoutire'])->name('favourite');
    Route::get('recipes/cooking/{id}', [RecipeController::class, 'cooking'])->name('recipes.cooking');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about-us');
Route::get('/recipes', [RecipeController::class, 'getRecipes'])->name('web.recipes');
Route::get('/recipes/search', [RecipeController::class, 'search']);
