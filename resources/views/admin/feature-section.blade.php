@extends('layouts.admin')

@section('content')
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

        
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
              <h4>Add Recipe Feature</h4>
              <a href="all-users.html" class="btn text-white mr-1" type="submit" style="background-color: #142900;">View Section</a>
            </div>
            <div class="card-body">
              <form>
                <div class="form-group">
                  <label for="featureTitle">Feature Title</label>
                  <input type="text" class="form-control" id="featureTitle" placeholder="Enter feature title" required />
                </div>
                <div class="form-group">
                  <label for="featureDescription">Feature Description</label>
                  <textarea class="form-control" id="featureDescription" rows="3" placeholder="Enter feature description" required></textarea>
                </div>
                <div class="form-group">
                  <label for="featureIcon">Feature Icon (FontAwesome or similar)</label>
                  <input type="text" class="form-control" id="featureIcon" placeholder="Enter icon class (e.g., fa fa-star)" required />
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
                  <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th>ID</th>
                        <th>Feature Title</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Diverse Recipes</td>
                        <td>Explore thousands of recipes from around the world for every occasion.</td>
                        <td><i class="fa fa-cutlery"></i></td>
                        <td>
                          <button class="btn btn-info btn-sm">Edit</button>
                          <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                      </tr>
                      <!-- More rows can be dynamically added here -->
                    </tbody>
                  </table>
              </div>
          </div>
          </div>

          
        </section>
        
      </div>
@endsection