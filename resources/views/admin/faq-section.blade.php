@extends('layouts.admin')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">


            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>Add Faq Questions</h4>
                    <a href="all-users.html" class="btn text-white mr-1" type="submit"
                        style="background-color: #142900;">View Section</a>
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Question</label>
                            <input type="text" class="form-control" placeholder="Enter question">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Answer</label>
                            <textarea class="form-control" rows="3" placeholder="Enter answer"></textarea>
                        </div>
                    </form>
                    <div class="card-footer text-right">
                        <button class="btn text-white mr-1" type="submit" style="background-color: #142900;">Submit</button>
                        <button class="btn btn-secondary" type="reset">Reset</button>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="container mt-5">
                    <div class="table-container">
                        <h4 class="mb-4">Website Sections</h4>
                        <table class="table table-bordered">
                            <thead class="table">
                                <tr>
                                    <th>#</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>What Types Of Food Do You Offer?</td>
                                    <td>We offer a variety of delicious dishes, including appetizers, main courses,
                                        desserts, and drinks.</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Do You Offer Catering Services?</td>
                                    <td>Yes, we provide catering services for all types of events.</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </section>

    </div>
@endsection