@extends('layouts.app')

@section('content')
    @include('layouts.includes.banner', ['title' => 'All Recipes', 'page' => 'Recipes'])
    <!-- recipes starts -->
    <section class="recipe-wrapper py-5">
        <div class="container-fluid px-5">


            <div class="row">
                <div class="col-md-3">
                    <div class="left-content">
                        <div class="heading text-center mb-4">
                            <h1>Recipe Index</h1>
                        </div>
                        <div class="search-container">
                            <div class="search-box">
                                <input type="text" class="form-control search-input" placeholder="Search">
                                <button class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="categories mt-4">
                        <div class="custom-drops">


                            <div class="dropdown mb-3">
                                <div class="custom-dropdown" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Course
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M7 10l5 5 5-5z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Chicken</a>
                                    <a class="dropdown-item" href="#">Vegetarian</a>
                                    <a class="dropdown-item" href="#">Desserts</a>
                                </div>
                            </div>

                            <div class="dropdown mb-3">
                                <div class="custom-dropdown" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Dietary Preference
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M7 10l5 5 5-5z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Spicy</a>
                                    <a class="dropdown-item" href="#">Quick Meals</a>
                                    <a class="dropdown-item" href="#">Healthy</a>
                                </div>
                            </div>

                            <div class="dropdown mb-3">
                                <div class="custom-dropdown" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Method
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M7 10l5 5 5-5z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Spicy</a>
                                    <a class="dropdown-item" href="#">Quick Meals</a>
                                    <a class="dropdown-item" href="#">Healthy</a>
                                </div>
                            </div>

                            <div class="dropdown mb-3">
                                <div class="custom-dropdown" id="dropdownMenuButton" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Cuisine
                                    <div class="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M7 10l5 5 5-5z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Spicy</a>
                                    <a class="dropdown-item" href="#">Quick Meals</a>
                                    <a class="dropdown-item" href="#">Healthy</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="row align-items-center">
                                <!-- Image Grid -->
                                <div class="col-md-6">
                                    <img src="./images/tara-req/img1.jpg" class="img-fluid modal-img" alt="Recipe 1">
                                </div>
                                <!-- Text Section -->
                                <div class="col-md-6 text-center text-md-left">
                                    <div class="logo text-center">
                                        <img src="./images/tara-req/Dark Green 1.png" alt="" class="img-fluid">
                                    </div>
                                    <h1 class="title">Join Strength Kitchen Recipe Clubb <span>👩‍🍳</span></h1>
                                    <ul class="list-unstyled features mt-4">
                                        <li>✨ Easy step-by-step instructions to follow</li>
                                        <li>📜 Full list of ingredients you’ll need</li>
                                        <li>👩‍🍳 Become an Strength pro in no time!</li>
                                    </ul>
                                    <p class="price mt-4">From just <strong>£1.67/m</strong></p>
                                    <a href="#" class="btn btn-danger btn-lg rounded-pill">Let’s Cook</a>
                                    <p class="mt-3"><a href="#" class="login-link">or Login</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-9">
                    <div class="right-side">
                        <div class="row">
                            @foreach ($recipes as $recipe)
                                <div class="col-md-4 mb-3">

                                    <div class="card-container">
                                        <div class="recipe-card">
                                            <div class="card-image">
                                                <a href="{{ route('recipes.show', ['recipe' => $recipe->id]) }}">
                                                    <img src="{{ asset($recipe->thumbnail) }}" alt="Recipe Image"
                                                        class="img-fluid">
                                                </a>
                                                <div class="bookmark-icon" onclick="addToFavorite({{ $recipe->id }})">
                                                    <i class="fas fa-bookmark"></i>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <h5>{{$recipe->title}}</h5>
                                                <p><i class="far fa-clock"></i> {{$recipe->cook_time}} cook</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        <div class="text-center mt-4">
                            <a href="#" class="btn outline-button">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- recipes ends -->
@endsection