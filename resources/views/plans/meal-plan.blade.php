@extends('layouts.app')

@section('content')
    <!-- Latest Menus Starts  -->
    <section class="menu-section py-5">
        <div class="container">

            <!-- Tabs Navigation -->
            <div class="navigation d-flex justify-content-between">
                <ul class="nav nav-pills mb-4" id="menuTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#latest">Meal Plan Collection</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#popular">All Meal Plans</a>
                    </li>


                </ul>

                <form class="form-inline mb-4">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"
                        style="border: 1px solid  #142800; border-radius: 8px;">
                    <button class="btn outline-button my-sm-0" type="submit"
                        style="border: 1px solid #142800; border-radius: 8px; padding: .375rem .75rem;">Search</button>
                </form>
            </div>

            <!-- Tabs Content -->
            <div class="tab-content menu-content">
                <!-- Latest Tab -->
                <div class="tab-pane fade show active" id="latest">
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <a href="plan-details.html">
                                <div class="card">
                                    <img src="./images/img1.jpg" alt="Dish">
                                    <div class="card-body p-2">
                                        <div class="card-title">Vegitarian Meal Plan</div>
                                        <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                            consectetur?</p>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img2.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img3.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img4.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img5.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img6.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img5.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img1.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="text-center mt-4">
                        <a href="#" class="btn outline-button">Load More</a>
                    </div>
                </div>

                <!-- Popular Tab -->
                <div class="tab-pane fade" id="popular">
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <a href="recipe-detail.html">
                                <div class="card">
                                    <img src="./images/img1.jpg" alt="Dish">
                                    <div class="card-body p-2">
                                        <div class="card-title">Vegitarian Meal Plan</div>
                                        <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                            consectetur?</p>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <div class="avatar">
                                            <img src="./images/ava4.jpg" alt="" class="img-fluid">
                                        </div>
                                        <div class="w-50">
                                            <h6 class="avatar-name">
                                                Lakshi Den
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img3.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div class="avatar">
                                        <img src="./images/ava2.jpg" alt="" class="img-fluid">
                                    </div>
                                    <div class="w-50">
                                        <h6 class="avatar-name">
                                            Lakshi Den
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img2.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div class="avatar">
                                        <img src="./images/ava4.jpg" alt="" class="img-fluid">
                                    </div>
                                    <div class="w-50">
                                        <h6 class="avatar-name">
                                            Lakshi Den
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="./images/img4.jpg" alt="Dish">
                                <div class="card-body p-2">
                                    <div class="card-title">Vegitarian Meal Plan</div>
                                    <p class="meal-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ea,
                                        consectetur?</p>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <div class="avatar">
                                        <img src="./images/ava1.jpg" alt="" class="img-fluid">
                                    </div>
                                    <div class="w-50">
                                        <h6 class="avatar-name">
                                            Lakshi Den
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>






                    </div>
                    <div class="text-center mt-4">
                        <a href="#" class="btn outline-button">Load More</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Latest Menus Ends  -->
@endsection