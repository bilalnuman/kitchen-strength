@extends('layouts.admin')

@section('content')
<div class="main-content">
    <form class="section">


        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4>Add User</h4>
                <a href="{{route('users.index')}}" class="btn text-white mr-1" type="submit" style="background-color: #142900;">All Users</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" placeholder="Enter First Name">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" placeholder="Enter Last Name">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" placeholder="Enter Username">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email Address">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input type="text" class="form-control" placeholder="Enter Phone Number">
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label>Select Role</label>
                            <select class="form-control">
                                <option>Select User Role</option>
                                <option>Admin</option>
                                <option>Normal User</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" placeholder="Enter Phone Number">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn text-white mr-1" type="submit" style="background-color: #142900;">Submit</button>
                    <button class="btn btn-secondary" type="reset">Reset</button>
                </div>
            </div>
        </div>


    </form>

</div>
@endsection