@extends('layouts.app')

@section('content')
    @include('layouts.includes.banner', ['title' => 'Recipes Details', 'page' => 'Recipes'])
    <!-- recipes starts -->
    <div class="detail-wrapper">
        <div class="container">
            <div class="back-page ">
            <a href="{{ route('recipes.show', ['recipe' => $recipe->id]) }}"><i class="fa-solid fa-arrow-left-long"></i> &nbsp; Back</a>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="video-card">
                        <video id="video" preload="metadata">
                            <source src="{{ asset($recipe->video_url) }}" type="video/mp4">
                            Your browser does not support HTML5 video.
                        </video>
                        <div class="controls">
                            <button id="playPauseBtn"><i class="fas fa-play"></i></button>
                            <input type="range" id="seekBar" min="0" value="0">
                            <button id="fullscreenBtn"><i class="fas fa-expand"></i></button>
                        </div>
                        <div class="volume-container">
                            <button id="volumeBtn"><i class="fas fa-volume-up"></i></button>
                            <input type="range" id="volumeBar" class="volume-bar" min="0" max="1" step="0.1" value="1">
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="recipe-detail-content">
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
                </div>
            </div>
        </div>
    </div>
    <!-- recipes ends -->
    <script>



        const video = document.getElementById("video");
        const playPauseBtn = document.getElementById("playPauseBtn");
        const seekBar = document.getElementById("seekBar");
        const volumeBtn = document.getElementById("volumeBtn");
        const volumeBar = document.getElementById("volumeBar");
        const fullscreenBtn = document.getElementById("fullscreenBtn");

        // Function to toggle play and pause
        function togglePlayPause() {
            if (video.paused || video.ended) {
                video.play();
                updatePlayPauseIcon("pause");
            } else {
                video.pause();
                updatePlayPauseIcon("play");
            }
        }

        // Function to update the play/pause button icon
        function updatePlayPauseIcon(state) {
            if (state === "play") {
                playPauseBtn.innerHTML = '<i class="fas fa-play"></i>';
            } else if (state === "pause") {
                playPauseBtn.innerHTML = '<i class="fas fa-pause"></i>';
            }
        }

        // Seek bar functionality
        video.addEventListener("timeupdate", () => {
            seekBar.value = (video.currentTime / video.duration) * 100;
        });

        seekBar.addEventListener("input", () => {
            video.currentTime = (seekBar.value / 100) * video.duration;
        });

        // Volume control functionality
        volumeBar.addEventListener("input", () => {
            video.volume = volumeBar.value;
            if (video.volume === 0) {
                volumeBtn.innerHTML = '<i class="fas fa-volume-mute"></i>';
            } else {
                volumeBtn.innerHTML = '<i class="fas fa-volume-up"></i>';
            }
        });

        volumeBtn.addEventListener("click", () => {
            if (video.volume > 0) {
                video.volume = 0;
                volumeBar.value = 0;
                volumeBtn.innerHTML = '<i class="fas fa-volume-mute"></i>';
            } else {
                video.volume = 1;
                volumeBar.value = 1;
                volumeBtn.innerHTML = '<i class="fas fa-volume-up"></i>';
            }
        });

        // Fullscreen functionality
        fullscreenBtn.addEventListener("click", () => {
            if (video.requestFullscreen) {
                video.requestFullscreen();
            } else if (video.webkitRequestFullscreen) {
                video.webkitRequestFullscreen();
            } else if (video.msRequestFullscreen) {
                video.msRequestFullscreen();
            }
        });

        // Event listeners
        playPauseBtn.addEventListener("click", togglePlayPause);

        video.addEventListener("play", () => {
            updatePlayPauseIcon("pause");
        });

        video.addEventListener("pause", () => {
            updatePlayPauseIcon("play");
        });

        video.addEventListener("ended", () => {
            updatePlayPauseIcon("play");
        });




        // Quantity control functions
        function increase() {
            let quantity = document.getElementById("quantity");
            quantity.value = parseInt(quantity.value) + 1;
        }

        function decrease() {
            let quantity = document.getElementById("quantity");
            if (parseInt(quantity.value) > 1) {
                quantity.value = parseInt(quantity.value) - 1;
            }
        }

        // Toggle functionality for M and I buttons
        document.getElementById("btn-m").addEventListener("click", function () {
            this.classList.toggle("active");
        });

        document.getElementById("btn-i").addEventListener("click", function () {
            this.classList.toggle("active");
        });






    </script>
@endsection