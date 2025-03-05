@extends('layouts.app')

@section('content')
<style>
 .image-container{
    flex-direction: column;
    align-items: center;
    position: relative;
    padding-top: calc(100%);
 }
 
 .image-container img{
    object-fit: cover;
    width: 100%;
    height: 100%;
    animation-timeline: auto;
    animation-range-start: normal;
    animation-range-end: normal;
    position: absolute;
    left: 0px;
    top: 0px;
    right: 0px;
    bottom: 0px;
    box-sizing: border-box !important;
    background: linear-gradient(to right, rgb(233, 233, 233), rgb(249, 249, 249), rgb(233, 233, 233)) 0% 0% / 200%;
    animation: 4s linear 0s infinite normal none running loading-gradient;
    border-radius: 8px;
 }
 .new-recipe{
    border: 1px solid red;
    border-radius: 20px;
    border-style: dashed;
    text-align: center;
    cursor: pointer;
 }
 .new-recipe p:first-child{
    font-size: 34px;
    line-height: 24px;
    font-weight: 400;
 }
</style>
<div class="container pt-5">
    @foreach ($data as $plan )
    <div>
        <p>{{$plan->title}}</p>
    </div>
    <div class="row flex-nowrap">
        @foreach ($plan->days as $item)
        <div class="col-3" id="day-container-{{$item->id}}">
            <strong class="pb-3 d-block">Day {{$loop->index+1}}</strong> 
            <div class="new-recipe py-3 {{count($item->recipes)?'d-none':''}}">
                <p class="m-0">+</p>
                <p class="m-0 pt-2">New recipe</p>
            </div>
            
            @foreach ($item->recipes as $recipe)
            <div class="recipe-container mb-5" id="recipe-{{ $recipe->pivot['id'] }}">
                <div class="image-container">
                    <img src="/{{$recipe->thumbnail}}" alt="image" class="img-fluid">
                </div>
                <div class="mt-2 mb-2">{{$recipe->title}}</div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="/assets/icons/clock.svg" alt="">
                        <span class="ps-2">{{$recipe->cook_time}}</span>
                    </div>
                    <img src="/assets/icons/trash.svg" alt="" data-type="recipe" class="botton" onclick="handleDelete([{{ $recipe->pivot['id']}},{{$item->id}}],'plan-days/recipe')">
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
    @endforeach
</div>

@endsection