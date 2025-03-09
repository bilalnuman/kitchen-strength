@extends('layouts.admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4>All Users</h4>
                <a href="{{ route('users.store') }}" class="btn text-white mr-1" type="submit" style="background-color: #142900;">Add User</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>phone Number</th>
                                <th>Date</th>
                                <th>Role</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index=>$user)
                            @if ($user->role !== 'admin')
                            <tr>
                                <td>
                                    {{$index+1}}
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>+3847653874</td>
                                <td>{{$user->created_at}}</td>
                                <td>
                                    <div class="badge badge-shadow" style="background-color: #d7ffa4;">{{$user->role}}</div>
                                </td>
                                <td>
                                    @if ($user->image)
                                    <img alt="{{asset($user->image)}}" src="{{asset('assets/img/users/user-5.png')}}" width="35">
                                    @else
                                    <span>N/A</span>
                                    @endif

                                </td>
                                <td><a href="" class="btn btn-primary m-0 p-1"> <i data-feather="edit"></i> </a>
                                    <a href="#" class="btn btn-danger m-0 p-1"> <i data-feather="trash"></i> </a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </section>
</div>
@endsection