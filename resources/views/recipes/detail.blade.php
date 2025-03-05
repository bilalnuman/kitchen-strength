@extends('layouts.app')

@section('content')
    @include('layouts.includes.banner', ['title' => 'Recipes Details', 'page' => 'Recipes'])
    <!-- recipes starts -->
    <div class="detail-wrapper mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="detail-img">
                        <!-- <img src="./images/about.jpg" alt="Image"> -->
                        <a href="{{ route('recipes.cooking', ['id' => $recipe->id]) }}">
                            <img src="{{ asset($recipe->thumbnail) }}" alt="Recipe Image" class="img-fluid">
                            <button type="button" class="btn-play" data-toggle="modal"
                                data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-target="#videoModal">
                                <span></span>
                            </button>
                        </a>
                        <button class="share-btn" data-toggle="modal" data-target="#exampleModal"><i
                                class="fa fa-share"></i></button>
                        <button class="book-btn" onclick="addToFavorite({{ $recipe->id }})">
                            <i class="fa fa-bookmark"></i></button>
                        <button class="shopping-btn"><i class="fa-solid fa-cart-plus"></i></button>
                    </div>
                </div>



                <div class="col-lg-6">
                    <div class="recipe-detail-content">
                        <h2 class="about-title">{{ $recipe->title }}</h2>
                        <p>{{ $recipe->description }}</p>
                        <div class="rating-container">
                            <div class="stars">
                                <div class="star" data-value="1"></div>
                                <div class="star" data-value="2"></div>
                                <div class="star" data-value="3"></div>
                                <div class="star" data-value="4"></div>
                                <div class="star active" data-value="5"></div>
                            </div>

                        </div>

                        <div class="cooking-time">
                            <div class="d-flex align-items-center py-3">
                                <div class="text-center">
                                    <h6 class="time-label">Prep</h6>
                                    <p class="time-value">{{ formatTotalTime($recipe->prep_time) }}
                                    </p>
                                </div>
                                <div class="text-center ml-4">
                                    <h6 class="time-label">Cook</h6>
                                    <p class="time-value"> {{ formatTotalTime($recipe->cook_time) }}
                                    </p>
                                </div>
                                <div class="text-center ml-4">
                                    <h6 class="time-label">Total</h6>
                                    <p class="time-value">{{ formatTotalTime($recipe->cook_time, $recipe->prep_time) }}</p>
                                </div>
                                <a href="{{ route('recipes.cooking', ['id' => $recipe->id]) }}"
                                    class="btn btn-cook d-flex align-items-center ml-4">

                                    <i class="fas fa-fire mr-2"></i> Cook
                                </a>
                            </div>
                        </div>

                        <div class="recipe-method">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active border-0" id="pills-home-tab" data-toggle="pill"
                                        data-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true"> <i class="fa-solid fa-bowl-food"></i> Ingredients</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link border-0" id="pills-method-tab" data-toggle="pill"
                                        data-target="#pills-method" type="button" role="tab" aria-controls="pills-method"
                                        aria-selected="false"> <i class="fa-solid fa-kitchen-set"></i> Method</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link border-0" id="pills-nut-tab" data-toggle="pill"
                                        data-target="#pills-nut" type="button" role="tab" aria-controls="pills-nut"
                                        aria-selected="true"> <i class="fa-brands fa-nutritionix"></i> Nutrition</button>
                                </li>

                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab">
                                    <div class="recipe-method-content">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="mr-2">For</span>
                                                <button class="btn btn-light btn-sm quantity-btn"
                                                    onclick="decrease()">-</button>
                                                <input type="text" class="form-control text-center mx-2 quantity-input"
                                                    id="quantity" value="24" readonly>
                                                <button class="btn btn-light btn-sm quantity-btn"
                                                    onclick="increase()">+</button>
                                            </div>


                                            <div class="toggle-container" id="toggleButton">
                                                <span class="toggle-text toggle-m">M</span>
                                                <span class="toggle-text toggle-i">I</span>
                                                <div class="toggle-circle"></div>
                                            </div>

                                        </div>

                                        <table class="table table-borderless">
                                            <tbody>
                                                @foreach ($recipe->ingredients as $ingredient)                                              
                                                    <tr>
                                                        <td>{{ $ingredient->unit }} {{ $ingredient->type }}</td>
                                                        <td>{{ $ingredient->ingredient }}</td>
                                                        <td><input type="checkbox" class="custom-checkbox"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        <hr>

                                        <div class="shipping-btn text-right">
                                            <button class="btn"><i class="fa fa-plus"></i> Add To Shopping List</button>
                                        </div>



                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-nut" role="tabpanel" aria-labelledby="pills-nut-tab">

                                    <div class="nutrition-section">
                                        <h5>Nutrition Per Serving <span class="read-more">(Read more)</span></h5>
                                        <div class="nutrition-cards">
                                            @foreach ($recipe->nutrition as $nutrition)  
                                                <div class="nutrition-card">
                                                    <div class="nutrition-value">{{ $nutrition->unit_weight }}</div>
                                                    <div class="nutrition-label">{{ $nutrition->title }}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-method" role="tabpanel"
                                    aria-labelledby="pills-method-tab">

                                    <div class="method-content">
                                        @foreach ($recipe->methods as $index => $method)                                       

                                            <div class="step">
                                                <strong>Step {{ $index + 1 }}</strong>
                                                <p>{{ $method->instruction }}</p>
                                                <img src="{{ asset($method->image) }}" alt="Step 1">
                                            </div>
                                        @endforeach
                                        <hr>
                                        <!-- recipe notes -->

                                        <div class="recipe-notes">
                                            <strong>Recipe Notes</strong>
                                            {!! $recipe->notes !!}
                                        </div>

                                        <hr>

                                        <div class="recipe-notes">
                                            <strong>Cooking Tips</strong>
                                            {!! $recipe->cooking_tips !!}
                                        </div>

                                        <hr>

                                        <div class="recipe-notes">
                                            <strong>Storage Instructions</strong>
                                            {!! $recipe->storage_instructions !!}
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="comment mt-4">
                        <h5 class="font-weight-bold">Comments</h5>
                        <div class="d-flex align-items-start comment-box p-3 rounded">
                            <div class="profile-icon bg-danger text-white text-center font-weight-bold">
                                T
                            </div>
                            <div class="flex-grow-1 mx-3">
                                <textarea class="form-control comment-textarea"
                                    placeholder="Ask a question, add your thoughts, post your creation..."
                                    rows="3"></textarea>
                            </div>
                            <div class="image-upload-icon text-center">
                                <i class="fas fa-image"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- recipes ends -->
@endsection