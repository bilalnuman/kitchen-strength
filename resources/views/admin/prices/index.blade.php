@extends('layouts.admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h4>All Plsnd</h4>
                <a href="{{ route('prices.create') }}" class="btn text-white mr-1" type="submit" style="background-color: #142900;">Add Plan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>title</th>
                                <th>sub title</th>
                                <th>plan detail</th>
                                <th>price</th>
                                <th>currency</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prices as $index=>$price)
                            <tr>
                                <td> {{$index+1}} </td>
                                <td>{{price->title}}</td>
                                <td>{{price->sub_title}}</td>
                                <td>{{price->plan_detail}}</td>
                                <td>{{price->currency}}</td>
                                <td><a href="" class="btn btn-primary m-0 p-1"> <i data-feather="edit"></i> </a>
                                    <a href="#" class="btn btn-danger m-0 p-1"> <i data-feather="trash"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </section>
</div>
@endsection