@extends('layouts.app')

<style>
    .planner-container {
        display: flex;
        align-items: center;
        position: relative;
    }

    .planner-container .arrow {
        font-size: 20px;
        cursor: pointer;
        padding: 10px;
        position: absolute;
        top: -60px;
        right: 60px;

    }

    .meal-plan-days .day-wrapper {
        overflow: hidden;
        width: 100%;
    }

    .meal-plan-days .day-container {
        display: flex;
        transition: transform 0.3s ease-in-out;
        gap: 10px;
    }

    .day {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 250px;
        margin-right: 10px;
        position: relative;
    }

    .day-label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .recipe-list {
        display: flex;
        flex-direction: column;
        /* Recipes will stack vertically */
        gap: 10px;
        align-items: center;
        margin-bottom: 10px;
    }

    .recipe-box {
        border: 1px dashed #142900;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        width: 250px;
        /* min-height: 50px; */
        border-radius: 15px;
        order: 20000;
        height: fit-content;
    }

    .day-wrapper .card {
        width: 250px !important;
        position: relative;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .day-recipes .card img {
        /* border-top-left-radius: 10px;
  border-top-right-radius: 10px; */
        height: 150px;
        object-fit: cover;
    }

    .day-recipes .card-body {
        text-align: start;
        padding: 10px;
    }

    .day-recipes .card-body .card-title {
        font-size: 14px;
        font-weight: 500;
    }

    .delete-icon {
        position: absolute;
        bottom: 14px;
        right: 14px;
        cursor: pointer;
        font-size: 15px;
        color: var(--dark-green);
    }
</style>
@section('content')

    <section class="plan-wrapper py-5">
        <div class="container">
            <!-- Header Section -->
            <div class="header">
                @if($plan)
                    <div>
                        <h1 class="header-title" id="mealPlanTitle" ondblclick="editTitle()">Meal Plan {{ $plan->title }}</h1>
                    </div>
                @endif
                <div class="d-flex align-items-center">
                    <a href="planner.html" class="shopping-list-btn">All Plans</a>
                    <button class="shopping-list-btn ml-3" id="toggleOffcanvas">Shopping List</button>
                    <div class="dropdown ml-2">
                        <button class="btn" type="button" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Edit Plan</a>
                            <a class="dropdown-item" href="#">Delete Plan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas" id="offcanvas">
                <div class="offcanvas-header">
                    <h5>Shopping List</h5>
                    <button class="btn btn-close btn-sm" id="closeOffcanvas"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="offcanvas-body">
                    <div class="recipe-method-content">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <span class="mr-2">For</span>
                                <button class="btn btn-light btn-sm quantity-btn" onclick="decrease()">-</button>
                                <input type="text" class="form-control text-center mx-2 quantity-input" id="quantity"
                                    value="24" readonly>
                                <button class="btn btn-light btn-sm quantity-btn" onclick="increase()">+</button>
                            </div>


                            <div class="toggle-container" id="toggleButton">
                                <span class="toggle-text toggle-m">M</span>
                                <span class="toggle-text toggle-i">I</span>
                                <div class="toggle-circle"></div>
                            </div>

                        </div>

                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>1 pack</td>
                                    <td>Ready rolled shortcrust or puff pastry</td>
                                    <td><input type="checkbox" class="custom-checkbox"></td>
                                </tr>
                                <tr>
                                    <td>1 jar</td>
                                    <td>Rich fruit mincemeat</td>
                                    <td><input type="checkbox" class="custom-checkbox"></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Small egg</td>
                                    <td><input type="checkbox" class="custom-checkbox"></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Icing sugar</td>
                                    <td><input type="checkbox" class="custom-checkbox"></td>
                                </tr>
                            </tbody>
                        </table>

                        <hr>

                        <div class="shipping-btn text-center">
                            <button class="shopping-list-btn ml-3" id="toggleOffcanvas">Copy to clipboard</button>
                        </div>



                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider"></div>

        </div>
        <div class="container-fluid mt-4 meal-plan-days mx-5">
            <button id="addDay" class="btn shopping-list-btn" onclick="addDay()">+ Add Day</button>
            @isset($plan)
                <div class="planner-container mt-3">
                    <i class="fas fa-chevron-left arrow mr-5" id="prevDay"></i>
                    <div class="day-wrapper mt-4">
                        <div class="day-container" id="days">

                            @if ($plan->days)
                                @foreach ($plan->days as $index => $day)
                                    <div class="d-flex flex-col" id="day-{{ $day->id }}">
                                        <div class="text-center day-label">Day {{ $index + 1 }}</div>
                                        @if ($day->recipes)
                                            @foreach ($day->recipes as $index => $recipe)
                                                <div class="recipe-list m-0">
                                                    <div class="card {{count($day->recipes) > 1 ? 'my-2' : 'my-2' }}">
                                                        <img src={{ asset($recipe->thumbnail) }} class="card-img-top">
                                                        <div class="card-body">
                                                            <h6 class="card-title">{{ $recipe->title }}</h6>
                                                            <div><i class="far fa-clock"></i>{{ formatTotalTime($recipe->prep_time) }}</div>
                                                            <i class="far fa-trash-alt delete-icon"
                                                                onclick="handleDeleteRecipe(event,{{$recipe->pivot->id}})"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="recipe-box {{ count($day->recipes) ? 'mt-2' : 'mt-2' }}"
                                            onclick="openRecipeModal({{ $day->id }})">+ New Recipe</div>
                                    </div>
                                @endforeach
                            @endif
                            <!-- Days will be generated here -->
                        </div>
                    </div>
                    <!-- <i class="fas fa-chevron-right arrow" id="nextDay"></i> -->
                </div>
            @endisset
        </div>


        <!-- Recipe Selection Modal -->
        <div class="modal fade day-recipes" id="recipeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">All Recipes</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="left-content">

                            <div class="search-container1">
                                <div class="search-box1">
                                    <input type="text" class="form-control search-input1" placeholder="Search">
                                    <button class="search-btn1">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">


                                <div class="categories">
                                    <div class="custom-drops">


                                        <div class="dropdown mb-3">
                                            <div class="custom-dropdown" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                Courses
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
                                                Diet
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
                                                Dish
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
                            <div class="col-md-9">
                                <div class="row" style="max-height: 400px; overflow-y: auto;">
                                    @foreach ($recipes as $recipe)
                                        <div class="col-md-4 mb-3">
                                            <div class="card" onclick="addRecipe({{ $recipe }})">
                                                <img src={{ asset($recipe->thumbnail) }} class="card-img-top">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $recipe->title }}</h6>
                                                    <div><i
                                                            class="far fa-clock pr-2"></i>{{ formatTotalTime($recipe->cook_time) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>


        async function addDay() {

            const planId ={{ Request::route('plan') }}
                const lastDay = document.querySelectorAll(".day-label");
            let dyaN = lastDay?.length ? lastDay.length + 1 : 1
            let res = await postData(planId, '', 'plan-days/add');
            res = await res.json();

            if (res.success) {
                const container = document.getElementById("days");
                const newRecipeWrapper = document.createElement("div");
                newRecipeWrapper.id = `day-${res?.id}`

                const newRecipeLabel = document.createElement("div");
                newRecipeLabel.classList.add("text-center", "day-label", 'mb-1');
                newRecipeLabel.textContent = `Day ${dyaN}`;

                const newRecipeBox = document.createElement("div");
                newRecipeBox.classList.add("recipe-box", 'mt-3');
                newRecipeBox.textContent = "+ New Recipe";

                newRecipeWrapper.appendChild(newRecipeLabel);
                newRecipeWrapper.appendChild(newRecipeBox);

                newRecipeBox.addEventListener("click", () => {
                    openRecipeModal(res.id);
                });

                newRecipeWrapper.appendChild(newRecipeBox);
                container.appendChild(newRecipeWrapper);
            }
        }



        function openRecipeModal(dayNumber) {
            $('#recipeModal').modal('show');
            dayid = dayNumber;
        }

        async function addRecipe(recipe, plan_day_id) {
            let res = await postData(dayid, recipe.id, 'plan-days/recipe')
            res = await res.json();
            if (res.success) {
                let recipeCard = createRecipeCard(recipe.title, res.id, recipe.thumbnail, recipe.cook_time, dayid);

                let recipeList = document.getElementById(`day-${dayid}`);
                recipeList.classList.add('d-flex', 'flex-col')
                if (recipeList) {
                    recipeList.appendChild(recipeCard);
                }
            }

            $('#recipeModal').modal('hide');
        }

        async function postData(plan_day_id, recipe_id = null, endPoint) {
            try {
               

                const csrfToken = $('meta[name="csrf-token"]').attr('content')

                const response = await fetch(`http://127.0.0.1:8000/${endPoint}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ plan_day_id, recipe_id })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                return response
            } catch (error) {
                console.error('Error:', error);
            }
        }

        function createRecipeCard(name, recipeId, imgSrc, time, dayNumber) {

            let card = document.createElement("div");
            card.className = "card";
            card.innerHTML = `                                                                                                      <img src="http://127.0.0.1:8000/${imgSrc}" class="card-img-top">
                                                                                                                                                <div class="card-body">
                                                                                                                                                    <h6 class="card-title">${name}</h6>
                                                                                                                                                    <div><i class="far fa-clock"></i> ${time} min</div>
                                                                                                                                                    <i class="far fa-trash-alt delete-icon"></i>                                
                                                                                                                                                </div>
                                                                                                                                            `;

            let deleteIcon = card.querySelector(".delete-icon");
            deleteIcon.addEventListener("click", (event) => {
                handleDeleteRecipe(event, recipeId);
            });

            return card;
        }


        async function handleDeleteRecipe(event, id) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content')

            const response = await fetch(`http://127.0.0.1:8000/plan-days/recipe/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
            });
            res = await response.json()

            if (res.success) {
                event.target.parentElement.parentElement.remove()
            }
        }



        const toggleButton = document.getElementById('toggleOffcanvas');
        const offcanvas = document.getElementById('offcanvas');
        const closeButton = document.getElementById('closeOffcanvas');

        toggleButton.addEventListener('click', () => {
            offcanvas.classList.toggle('show');
        });

        closeButton.addEventListener('click', () => {
            offcanvas.classList.remove('show');

        });


    </script>
@endsection