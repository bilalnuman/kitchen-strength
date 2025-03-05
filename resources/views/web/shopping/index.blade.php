@extends('layouts.app')
<style>
    .shopping-wrapper .remove-btn {
        font-size: 16px !important;
        color: #2c3e1a !important
    }
</style>

@section('content')

@include('layouts.includes.banner', ['title' => 'Shopping Recipes List','page'=>'Shopping'])

    <div class="container d-flex flex-wrap pt-5 shopping-wrapper">
        <a href="/" id="notfound" class="mx-auto pb-4 {{ count($data) ? 'd-none' : '' }}">Start shopping</a>
        <div class="shopping w-100">
            <div id="shopping" class="w-100">
                @if (count($data))
                    <h2 class="title text-center mb-5">Shopping List</h2>
                @endif
                @foreach ($data as $type => $items)
                    <ul class="m-0 p-0 d-flex flex-wrap w-100 category mb-3" id="{{ $type }}">

                        <p class="fcategory-title m-0 w-100 {{ $loop->index > 0 ? 'pt-4' : '' }}">{{ ucfirst($type) }}</p>
                        @foreach ($items as $item)
                            <li class="d-flex align-itmes-center item justify-content-between w-100 mt-2"
                                id="{{ $type }}-{{ $item['id'] }}">

                                <div class="item-label">
                                    <input type="checkbox" checked>
                                    {{ $item['ingredient'] }}
                                </div>
                                <div class="item-quantity d-flex align-items-center">
                                    <span class="pr-1">{{ $item['unit'] }}</span>
                                    <button class="p-0 remove-btn ml-1"
                                        onclick="handleDelete([{{ $item['id'] }}],'shopping',event)">
                                        <i class="fa fa-times" data-type="{{ $type }}"></i>
                                    </button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
            @if (count($data))
                <div class="controls w-100">
                    <div class="toggle">
                        <input type="checkbox" id="mode-toggle">
                        <label for="mode-toggle"></label>
                        <span>M</span>
                        <span>I</span>
                    </div>
                    <div>
                        <button onclick="handleDelete(null,'shopping',event)">Clear List</button>
                        <button>Copy</button>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
