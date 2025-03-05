@extends('layouts.app')

@section('content')
@include('layouts.includes.banner', ['title' => 'All Favourite Recipes', 'page' => 'Favourite recipes'])


    <!-- recipes starts -->
    <section class="recipe-wrapper py-5">
        <div class="container px-5">

            <div class="row">
                @foreach ($user->favouriteRecipes as $recipe)
                    <div class="col-md-4 mb-3">
                        <div class="card-container">
                            <div class="recipe-card">
                                <div class="card-image">
                                    <img src="{{ $recipe->thumbnail }}" alt="Recipe Image">
                                    <div class="bookmark-icon fav" onclick="addToFavorite({{ $recipe->id }})">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h5>{{$recipe->title}}</h5>
                                    <p><i class="far fa-clock"></i> {{ $recipe->cook_time }}  cook</p>

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
    </section>
    <!-- recipes ends -->
@endsection
