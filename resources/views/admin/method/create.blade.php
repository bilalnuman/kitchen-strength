@extends('layouts.admin')
@section('content')
    <div class="main-content">
        <section class="section">


            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>Add Methods</h4>

                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('methods.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="featureTitle">Method Name</label>
                            <input type="text" name="name" class="form-control" id="featureTitle" placeholder="Enter Method"
                                required />
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn text-white mr-1" type="submit"
                                style="background-color: #142900;">Submit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>

                </div>
            </div>


            <div class="card">
                <div class="container mt-5">
                    <div class="table-container">
                        <h4 class="mb-4">All Methods</h4>
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($methods as $method)
                                    <tr>
                                        <td>{{ $method->id }}</td>
                                        <td>{{ $method->name }}</td>
                                        <td>
                                            <button class="btn btn-info btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                <!-- More rows can be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </section>

    </div>
@endsection