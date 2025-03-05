@extends('layouts.admin')

@section('content')
    <div class="main-content">
        <section class="section">


            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4>Add banner section</h4>
                    <a href="all-users.html" class="btn text-white mr-1" type="submit"
                        style="background-color: #142900;">View Section</a>
                </div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="sectionTitle">Section Title</label>
                            <input type="text" class="form-control" id="sectionTitle" placeholder="Enter section title">
                        </div>
                        <div class="form-group">
                            <label for="sectionDescription">Description</label>
                            <textarea class="form-control" id="sectionDescription" rows="4"
                                placeholder="Enter description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="backgroundImage">Background Image</label>
                            <input type="file" class="form-control-file" id="backgroundImage">
                        </div>
                        <div class="form-group">
                            <label for="buttonText">Button Text</label>
                            <input type="text" class="form-control" id="buttonText" placeholder="Enter button text">
                        </div>
                        <div class="form-group">
                            <label for="buttonLink">Button Link</label>
                            <input type="url" class="form-control" id="buttonLink" placeholder="Enter button link">
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
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Button Text</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Embrace Sustainable Eating</td>
                                    <td>A way of eating that works for your body...</td>
                                    <td>Join Now</td>
                                    <td>
                                        <button class="btn btn-info btn-sm action-btn">Update</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Healthy Lifestyle</td>
                                    <td>Promote healthy habits every day...</td>
                                    <td>Learn More</td>
                                    <td>
                                        <button class="btn btn-info btn-sm action-btn">Update</button>

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