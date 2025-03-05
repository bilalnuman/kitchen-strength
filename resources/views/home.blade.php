@extends('layouts.app')

@section('content')

    @isset($banners)
        <div class="banner" style="background-image:url('{{$banners->thumbnail}}')">
            <div class="banner-content">
                <h1>Embrace a sustainable way of eating that works best for your body and lifestyle.</h1>
                <a href="#" class="custom-btn btn mt-4">Let's Cook</a>
            </div>
        </div>
    @endisset
    @if(count($recipes))
        <section class="features-section">
            <div class="container">
                <h2 class="section-title">Recipe Features</h2>
                <div class="row text-center">
                    <!-- Feature 1 -->
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <h5 class="feature-title">Diverse Recipes</h5>
                            <p class="feature-description">
                                Explore thousands of recipes from around the world for every occasion.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                            <h5 class="feature-title">Healthy Options</h5>
                            <p class="feature-description">
                                Discover nutritious and delicious recipes tailored for healthy eating.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h5 class="feature-title">Quick Recipes</h5>
                            <p class="feature-description">
                                Find time-saving recipes for busy schedules without compromising taste.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 4 -->
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h5 class="feature-title">Top-Rated Dishes</h5>
                            <p class="feature-description">
                                Browse the best-rated recipes loved by our community.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 5 -->
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <h5 class="feature-title">Shopping List</h5>
                            <p class="feature-description">
                                Generate a custom shopping list based on your selected recipes.
                            </p>
                        </div>
                    </div>
                    <!-- Feature 6 -->
                    <div class="col-md-4 mb-4">
                        <div class="card feature-card">
                            <div class="feature-icon">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h5 class="feature-title">Save Your Favorites</h5>
                            <p class="feature-description">
                                Create a personal collection of your favorite recipes for easy access.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="feature-wrapper">
            <div class="container">
                <div class="heading text-center mt-5">
                    <h1>Latest Recipe</h1>
                </div>
                <div class="row py-5 align-items-center">
                    <div class="col-md-6 mb-3">
                        <div class="feature-img">
                            <img src="{{ $recipes[0]->thumbnail }}" alt="" class="img-fluid rounded">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="feature-content">

                            <h2 class="">{{ $recipes[0]->title }}</h2>
                            <p class="py-2">{{ $recipes[0]->description }}</p>
                            <div class="mt-4 d-flex align-items-center">
                                <a href="#" class="btn outline-button">Cook Now</a>
                                <p><i class="far fa-clock ml-3 mt-3"></i> {{ $recipes[0]->cook_time }} cook</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <!-- dish slider starts -->
        <section class="slider-wripper py-5">

            <div class="container-fluid">
                <div class="slider-header px-3">
                    <h2 class="slider-title">All Recipes</h2>
                    <a href="{{route('recipes.index')}}" class="btn outline-button btn-sm mb-3" style="padding: 7px 15px;">View
                        All</a>
                </div>

            </div>
            <div class="food-slider">
                @foreach ($recipes as $recipe)
                    <div class="card mb-3">
                        <div class="card-container">
                            <div class="recipe-card">
                                <div class="card-image">
                                    <img src="{{ $recipe->thumbnail }}" alt="Recipe Image">
                                    <div class="bookmark-icon">
                                        <i class="fas fa-bookmark"></i>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <h5>{{ $recipe->title }}</h5>
                                    <p><i class="far fa-clock"></i> {{ $recipe->cook_time }} cook</p>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            </div>
        </section>


        <section class="slider-wripper py-5">

            <div class="container-fluid">
                <div class="slider-header px-3 {{$dinnerRecipes ? '' : 'd-block'}}">
                    <h2 class="slider-title">Dinner Recipes</h2>
                    @if ($dinnerRecipes)
                        <a href="{{route('recipes.index')}}" class="btn outline-button btn-sm mb-3" style="padding: 7px 15px;">View
                            All</a>
                    @else
                        <div class="text-center">Data not found</div>
                    @endif

                </div>

            </div>
            @isset($dinnerRecipes)
                <div class="food-slider">
                    @foreach ($dinnerRecipes->recipes as $recipe)
                        <div class="card mb-3">
                            <div class="card-container">
                                <div class="recipe-card">
                                    <div class="card-image">
                                        <img src="{{ $recipe->thumbnail }}" alt="Recipe Image">
                                        <div class="bookmark-icon">
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <h5>{{ $recipe->title }}</h5>
                                        <p><i class="far fa-clock"></i> {{ $recipe->cook_time }} cook</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                </div>
            @endisset
        </section>


        <section class="slider-wripper py-5">

            <div class="container-fluid">
                <div class="slider-header px-3 {{$sweetRecipes ? '' : 'd-block'}}">
                    <h2 class="slider-title">Sweet Recipes</h2>
                    @if ($sweetRecipes)
                        <a href="{{route('recipes.index')}}" class="btn outline-button btn-sm mb-3" style="padding: 7px 15px;">View
                            All</a>
                    @else
                        <div class="text-center">Data not found</div>
                    @endif

                </div>

            </div>
            @isset($sweetRecipes)
                <div class="food-slider">
                    @foreach ($sweetRecipes->recipes as $recipe)
                        <div class="card mb-3">
                            <div class="card-container">
                                <div class="recipe-card">
                                    <div class="card-image">
                                        <img src="{{ $recipe->thumbnail }}" alt="Recipe Image">
                                        <div class="bookmark-icon">
                                            <i class="fas fa-bookmark"></i>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <h5>{{ $recipe->title }}</h5>
                                        <p><i class="far fa-clock"></i> {{ $recipe->cook_time }} cook</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                </div>
            @endisset
        </section>

        <!-- testimonial section starts -->

        <section id="testimonials" class="testimonials py-4">
            <div class="container">
                <div class="row text-center mb-4">
                    <div class="col-12">
                        <h2 class="section-title mt-4">Client Testimonials</h2>
                        <p class="section-subtitle">Our clients' feedback drives us forward</p>
                    </div>
                </div>

                <div class="row">
                    <!-- Testimonial 1 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p class="testimonial-text">"The food was absolutely amazing! The flavors were rich, and the
                                    presentation was top-notch. I would highly recommend this place to everyone!"</p>

                                <div class="star-rating">
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star">★</span>
                                </div>
                            </div>
                            <div class="testimonial-author">
                                <img src="./images/tara-req/ava1.jpg" alt="Client" class="testimonial-avatar">
                                <h4 class="author-name">Jessica Brown</h4>
                                <!-- Star Rating -->

                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 2 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p class="testimonial-text">"A truly delightful experience. The ambiance was perfect, and the
                                    dishes were prepared to perfection. Will definitely return!"</p>
                                <div class="star-rating">
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star">★</span>
                                    <span class="star">★</span>
                                </div>
                            </div>
                            <div class="testimonial-author">
                                <img src="./images/tara-req/ava2.jpg" alt="Client" class="testimonial-avatar">
                                <h4 class="author-name">Michael Johnson</h4>
                                <!-- Star Rating -->

                            </div>
                        </div>
                    </div>

                    <!-- Testimonial 3 -->
                    <div class="col-md-4 col-sm-6">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <p class="testimonial-text">"An unforgettable dining experience. The food was flavorful, the
                                    service was exceptional, and the whole experience was worth every penny."</p>
                                <div class="star-rating">
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                    <span class="star filled">★</span>
                                </div>
                            </div>
                            <div class="testimonial-author">
                                <img src="./images/tara-req/ava3.jpg" alt="Client" class="testimonial-avatar">
                                <h4 class="author-name">Sarah Williams</h4>
                                <!-- Star Rating -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section Starts -->
        <section id="faq" class="faq-section py-5">
            <div class="container">
                <div class="row text-center mb-3">
                    <div class="col-12">
                        <h2 class="section-title">Frequently Asked Questions</h2>
                        <p class="section-subtitle">Everything you need to know</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div id="accordion" class="accordion">
                            <!-- Accordion Item 1 -->
                            <div class="card faq-card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                            What types of food do you offer?
                                        </button>
                                        <span class="arrow-icon">
                                            <i class="fa fa-chevron-down"></i>
                                        </span>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body text-dark">
                                        We offer a variety of delicious dishes, including appetizers,
                                        main courses, desserts, and drinks, all made with fresh
                                        ingredients.
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 2 -->
                            <div class="card faq-card">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            Do you offer catering services?
                                        </button>
                                        <span class="arrow-icon">
                                            <i class="fa fa-chevron-down"></i>
                                        </span>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Yes! We offer catering services for events such as weddings,
                                        parties, and corporate gatherings. Contact us for more details.
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 3 -->
                            <div class="card faq-card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            How can I place an order?
                                        </button>
                                        <span class="arrow-icon">
                                            <i class="fa fa-chevron-down"></i>
                                        </span>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        You can place an order through our website or by calling our
                                        customer service team. We offer delivery and pick-up options.
                                    </div>
                                </div>
                            </div>

                            <!-- Accordion Item 4 -->
                            <div class="card faq-card">
                                <div class="card-header" id="headingFour">
                                    <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Do you offer vegan or gluten-free options?
                                        </button>
                                        <span class="arrow-icon">
                                            <i class="fa fa-chevron-down"></i>
                                        </span>
                                    </h5>
                                </div>
                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                                    <div class="card-body">
                                        Yes, we offer vegan and gluten-free options. Please check our
                                        menu or contact us for more information.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- FAQ Section Ends -->
@endsection

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>


<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
<script>
    $(document).ready(function () {
        // Toggle search bar
        $('#search-icon').click(function () {
            $('#search-bar').slideToggle('slow');
        });
    });

    $(document).ready(function () {
        $('.food-slider').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: true,
            infinite: true,
            arrows: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1
                }
            }
            ]
        });
    });






    // 3D Effect on Hover
    $(document).ready(function () {
        $('.about-card').hover(function () {
            $(this).addClass('animate__animated animate__pulse');
        }, function () {
            $(this).removeClass('animate__animated animate__pulse');
        });

        // Scale the avatar image on hover
        $('.about-card').hover(function () {
            $(this).find('.avatar').css('transform', 'scale(1.1)');
        }, function () {
            $(this).find('.avatar').css('transform', 'scale(1)');
        });
    });

    // Optional JS for additional effects (you can add or modify as needed)
    document.querySelectorAll('.testimonial-card').forEach(card => {
        card.addEventListener('mouseover', () => {
            card.style.transform = "scale(1.05)";
            card.style.boxShadow = "0 20px 50px rgba(0, 0, 0, 0.2)";
        });
        card.addEventListener('mouseout', () => {
            card.style.transform = "scale(1)";
            card.style.boxShadow = "0 15px 40px rgba(0, 0, 0, 0.1)";
        });
    });
</script>