@extends('layouts.admin')

@section('content')
<div class="main-content">
    <section class="section">


        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Add Price Plan</h4>
                <a href="{{route('prices.index')}}" class="btn text-white mr-1" type="submit" style="background-color: #142900;">All Price Plans</a>
            </div>
            <form class="card-body" method="post" action="{{route('prices.store')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Plan Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter First Name">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Plan Subtitle</label>
                            <input type="text" name="sub_title" class="form-control" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Plan Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Enter Last Name">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Plan currency Type</label>
                            <select type="text" name="currency" class="form-control" placeholder="Enter Last Name">
                                <option value="">Select currency type</option>
                                <option value="$">Dollor</option>
                            </select>
                        </div>
                    </div>
                    <div class="ck-edit p-4 w-100">
                        <h4>Plan Detail</h4>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12">
                                <textarea class="summernote" name="notes">

                                </textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>

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
@endsection