@extends('layouts.app')

@section('content')
<div class="container d-flex flex-wrap pt-5" style="max-width: 400px;">
    <div id="shopping" class="w-100">
        <a href="/" id="notfound" class="{{count($data)?'d-none':''}}">Start shopping</a>
        @foreach ($data as $type => $items)
        <ul class="m-0 p-0 d-flex flex-wrap w-100" id="{{$type}}">
            <p class="fw-bold m-0 w-100 {{$loop->index > 0?'pt-4':''}}">{{ ucfirst($type) }}</p>
            @foreach ($items as $item)
            <li class="d-flex align-itmes-center justify-content-between w-100 mt-2" id="{{$type}}-{{$item['id']}}">
                <p class="m-0">{{ $item['ingredient'] }}</p>
                <p class="m-0 d-flex align-itmes-center">{{ $item['unit'] }}
                    <button class="btn p-0 ms-3" onclick="handleDelete({{ $item['id'] }},'shopping')" data-type="{{$type}}">x</button>
                </p>
            </li>
            @endforeach
        </ul>
        @endforeach
    </div>
    @if(count($data))
    <button class="shopping" onclick="handleDelete(null,'shopping')">Delete all</button>
    @endif
</div>
<div class="container d-flex flex-wrap pt-5" style="max-width: 400px;" id="dashboard/users">

    <ul class="m-0 p-0 d-flex flex-wrap w-100" id="users">
        <p>users</p>
        @foreach ($users as $item)
        <li class="d-flex align-itmes-center justify-content-between w-100 mt-2" id="users-{{$item['id']}}">
            <p class="m-0 d-flex align-itmes-center">{{ $item['name'] }}
                <button class="btn p-0 ms-3" onclick="handleDelete({{ $item['id'] }},'dashboard/users')" data-type="users">x</button>
            </p>
        </li>
        @endforeach
    </ul>
</div>
@endsection
