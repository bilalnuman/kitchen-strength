@extends('layouts.app')

@section('content')

    @include('layouts.includes.banner', ['title' => 'About Us','page'=>'About'])
    <section class="about-us-section py-5">
        <div class="container text-center">
            <!-- Heading -->
            <h2 class="about-title mb-4">Who We Are</h2>
            <!-- Content -->
            <p class="about-text mb-4">
                Welcome to our world of Strngth Food! We are passionate about bringing you a rich variety of recipes that
                inspire creativity in your kitchen. From traditional comfort food to innovative gourmet dishes, our platform
                is designed to cater to food lovers of all kinds.

                Discover recipes that are crafted with care, offering step-by-step instructions to make cooking an enjoyable
                experience. Whether you're a seasoned chef or just starting your cooking journey, our collection will guide
                you to create meals that are not just delicious but also memorable.

                Explore flavors from around the world, learn new techniques, and elevate your cooking skills. We’re here to
                make your culinary adventures exciting, fun, and rewarding. Let’s cook, share, and celebrate the joy of food
                together!
            </p>
            <!-- Buttons -->
            <!-- <div class="action-buttons mb-4">
              <button class="btn btn-learn-more">Learn More</button>
              <button class="btn btn-contact-us">Contact Us</button>
            </div> -->
            <!-- Social Icons -->
            <!-- <div class="social-icons">
              <a href="#" class="social-icon facebook-icon" title="Facebook"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="social-icon twitter-icon" title="Twitter"><i class="fab fa-twitter"></i></a>
              <a href="#" class="social-icon instagram-icon" title="Instagram"><i class="fab fa-instagram"></i></a>
            </div> -->


            <!-- About us starts -->


            <div class="row py-5">
                <!-- Team Member 1 -->
                <div class="col-md-4 col-sm-6">
                    <div class="card about-card">
                        <div class="card-body">
                            <div class="avatar-wrapper">
                                <img src="./images/ava1.jpg" alt="Team Member" class="avatar">
                            </div>
                            <h4 class="card-title">John Doe</h4>
                            <p class="card-text">Head Chef</p>
                            <p class="card-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec
                                odio. Praesent libero. Sed cursus ante dapibus diam.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-md-4 col-sm-6">
                    <div class="card about-card">
                        <div class="card-body">
                            <div class="avatar-wrapper">
                                <img src="./images/ava4.jpg" alt="Team Member" class="avatar">
                            </div>
                            <h4 class="card-title">Jane Smith</h4>
                            <p class="card-text">Pastry Chef</p>
                            <p class="card-description">Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor
                                auctor. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-md-4 col-sm-6">
                    <div class="card about-card">
                        <div class="card-body">
                            <div class="avatar-wrapper">
                                <img src="./images/ava5.jpg" alt="Team Member" class="avatar">
                            </div>
                            <h4 class="card-title">Alex Johnson</h4>
                            <p class="card-text">Sous Chef</p>
                            <p class="card-description">Etiam porta sem malesuada magna mollis euismod. Nam adipiscing erat
                                ut cursus congue. Integer maximus, nisi vitae gravida placerat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About us ends -->
        </div>
    </section>


    <section class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="about-content">
                        <h1 class="title">Welcome to Strength Kitchen Recipes</h1>
                        <p class="description">
                            Discover a world of delicious recipes crafted with love and passion. Whether you're an
                            experienced chef or a home cook, our curated recipes are here to inspire and delight your taste
                            buds.
                        </p>
                        <a href="#recipes" class="btn btn-contact-us">Explore Recipes</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-image">
                        <img src="{{ asset('assets/img/recipe-single.png') }}" alt="Delicious Food"
                            class="img-fluid shadow-lg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="join-us-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-content">
                    <h2>Join us whenever, wherever you want.</h2>
                    <ul>
                        <li>Weekly Live Classes</li>
                        <li>The On-Demand Library</li>
                        <li>Exclusive Mayfair + Hampstead In-Studio Classes</li>
                    </ul>
                </div>
                <div class="col-md-6 button-content">
                    <button class="btn btn-secondary join-demand">Join Us Live</button>
                    <button class="btn btn-secondary join-demand">Join Us On-Demand</button>
                </div>
            </div>
        </div>
    </section>
@endsection