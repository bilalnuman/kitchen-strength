@extends('layouts.admin')
@section('content')
    <div class="main-content">
        <section class="section">


            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>Add Recipe</h4>
                    <a href="{{ route('recipes.index') }}" class="btn text-white mr-1" type="submit"
                        style="background-color: #142900;">All Recipes</a>
                </div>
                <form method="post" action="{{ route('recipes.store') }}" class="card-body" enctype="multipart/form-data">

                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Recipe Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter Recipe Title">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="">Recipe thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control" placeholder="Enter Recipe Title">
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="">Recipe Description</label>
                                <textarea name="description" id="" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Courses</label>
                                <select class="form-control" name="course_id">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Diet</label>
                                <select class="form-control" name="diet_id">
                                    @foreach ($diets as $diet)
                                        <option value="{{ $diet->id }}">{{ $diet->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Method</label>
                                <select class="form-control" name="method_id">
                                    @foreach ($methods as $method)
                                        <option value="{{ $method->id }}">{{ $method->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label>Dish</label>
                                <select class="form-control" name="dish_id">
                                    @foreach ($dishes as $dish)
                                        <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="col-md-12 mb-3">
                            <h4>Ingredients</h4>
                            <div class="ingredient-items">
                                <div class="form-row mb-2" id="ingredients">
                                    <div class="col">
                                        <input type="text" class="form-control" name="ingredients[0][ingredient]"
                                            placeholder="Enter Recipe name" >
                                    </div>
                                    <div class="d-flex">
                                        <div class="col">
                                            <input type="text" class="form-control" name="ingredients[0][unit]"
                                                placeholder="Enter Unit">
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="ingredients[0][type]"
                                                placeholder="Enter Type" >
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-primary add-more col-auto px-3 h-fit" index="1"
                                        onclick="addMore(event,'ingredient-items')">Add
                                        More</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <h4>Methods</h4>
                            <div id="dynamicForm">
                                <div class="step-container">
                                    <div class="form-row mb-2 step">
                                        <div class="col">
                                            <label><strong>Step 1</strong></label>
                                            <textarea name="methods[0][instruction]" class="form-control"
                                                placeholder="Description" ></textarea>
                                        </div>
                                        <div class="col">
                                            <label>Image</label>
                                            <input type="file" name="methods[0][image]" class="form-control-file">
                                        </div>
                                        <button type="button" class="btn btn-primary add-more col-auto px-3 h-fit" index="1"
                                            onclick="addMore(event,'step-container')">Add New
                                            Step</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-12 mb-3">
                            <h4>Nutrition</h4>
                            <div class="row mb-2">
                                <div class="col-md-5">
                                    <label>Name</label>
                                </div>
                                <div class="col-md-5">
                                    <label>Unit</label>
                                </div>
                            </div>



                            <div id="nutrition-container" class="nutrition-container">
                                <div class="row mb-2 nutrition-row">
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="nutritions[0][title]"
                                            placeholder="Enter Name">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" name="nutritions[0][unit_weight]"
                                            placeholder="Enter Unit">
                                    </div>
                                    <button type="button" class="btn btn-primary add-more col-auto px-3 h-fit" index="1"
                                        onclick="addMore(event,'nutrition-container')">Add New
                                        Step</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="">Prepair Time</label>
                                <input type="number" class="form-control" name="prep_time" placeholder="Enter Prep Time">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="">Cook Time</label>
                                <input type="number" name="cook_time" class="form-control" placeholder="Enter cook time">
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="">Recipe Video</label>
                                <input type="file" name="video" id="videoUpload" accept="video/*">
                                <!-- <input type="file" name="video" id="videoFile" style="display:none;"> -->
                                <!-- <input type="hidden" name="thumbnail" id="thumbnailData"> -->
                            </div>
                        </div>


                    </div>
                    <div class="ck-edit p-4">
                        <h4>Recipe Notes</h4>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                            <div class="col-sm-12">
                                <textarea class="summernote" name="notes"></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>

                        </div>
                    </div>
                    <div class="ck-edit p-4">
                        <h4>Cooking Tips</h4>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                            <div class="col-sm-12">
                                <textarea class="summernote" name="cooking_tips"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="ck-edit p-4">
                        <h4>Storage Instructions</h4>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                            <div class="col-sm-12">
                                <textarea class="summernote" name="storage_instructions"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="card-footer text-right">
                        <button class="btn text-white mr-1" type="submit" style="background-color: #142900;">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </form>
            </div>

        </section>

    </div>

    <script>
        function addMore(e, parent) {
            if (e.target.innerHTML === 'remove') {
                document.getElementById(e.target.parentNode.id).remove();
            } else {
                let rowIndex = 1;
                const ingredientsContainer = document.querySelector(`.${parent}`);
                rowIndex = Number(e.target.getAttribute('index'));
                e.target.setAttribute('index', rowIndex + 1);
                const newIngredientRow = ingredientsContainer.children[0].cloneNode(true);
                const inputs = newIngredientRow.querySelectorAll('input');
                inputs.forEach(input => input.value = '');

                newIngredientRow.querySelectorAll('input').forEach(input => {
                    const name = input.name;
                    input.name = name.replace(/\[\d+\]/, `[${rowIndex}]`);
                });
                newIngredientRow.querySelectorAll('textarea').forEach(textarea => {
                    const name = textarea.name;
                    textarea.name = name.replace(/\[\d+\]/, `[${rowIndex}]`);
                });

                ingredientsContainer.appendChild(newIngredientRow);
                newIngredientRow.children[2].innerHTML = "remove";
                newIngredientRow.children[2].style = "background:red; min-width:93px";
                newIngredientRow.children[2].parentNode.id = `row${rowIndex}`;
            }
        }
    </script>

@endsection