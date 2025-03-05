@extends('layouts.app')

@section('content')

    <div class="container meal-planner">
        <h2 class="planner-title">My Planner</h2>
        <div class="d-flex planner-container">
            @foreach ($plans as $plan) 
                <a href="{{ route('plans.show', $plan->id) }}">
                    <div>
                        @if (count($plan->days))
                            <div class="plan-card">
                                @foreach ($plan->days as $index => $day)
                                    @if($day->recipe)
                                        <img src="{{ asset($day->recipe->thumbnail) }}" alt="Meal Plan">
                                    @endif
                                @endforeach
                                @if(count($plan->days) < 3)
                                    @for ($i = count($plan->days); $i < 3; $i++)
                                        <div class="empty">
                                        </div>
                                    @endfor
                                @endif
                            </div>
                            <div class="plan-details py-2">
                                <p>{{ $plan->title }}</p>
                            </div>
                        @else
                            @isset($plan)
                                <div>
                                    <a href='{{ route("plans.show", ["plan" => $plan->id]) }}' class="d-flex plan-card-empt">
                                        <div class="empty"> </div>
                                        <div class="empty"> </div>
                                        <div class="empty"> </div>
                                    </a>
                                    <div class="plan-details py-2">
                                        <p>{{ $plan->title }}</p>
                                    </div>
                                </div>
                            @endisset

                        @endif

                    </div>
                </a>
            @endforeach
            <div class="new-plan-card ml-3">
                <i class="fas fa-plus"></i> New Plan
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(() => {
            const csrfToken = $('meta[name="csrf-token"]').attr('content')
            const plannerContainer = $('.planner-container')
            $('.new-plan-card').on('click', async function () {
                try {

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    let res = await fetch('{{ route("plans.store") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-XSRF-TOKEN': csrfToken
                        }
                    });

                    if (!res.ok) {
                        throw new Error('Network response was not ok');
                    }

                    else {
                        res = await res.json()
                        console.log(res)
                        plannerContainer.append(`<div>
                                                                                <a href="plans/${res.plan.id}" class="d-flex plan-card-empt ">
                                                                                <div class="empty"> </div>
                                                                                <div class="empty"> </div>
                                                                                <div class="empty"> </div>
                                                                            </a>
                                                                            <div>${res.plan.title}</div>
                                                                            </div>
                                                                                `)
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            })
        })
        // offcanvas
        // const toggleButton = document.getElementById('toggleOffcanvas');
        // const offcanvas = document.getElementById('offcanvas');
        // const closeButton = document.getElementById('closeOffcanvas');

        // toggleButton.addEventListener('click', () => {
        //     offcanvas.classList.toggle('show');
        // });

        // closeButton.addEventListener('click', () => {
        //     offcanvas.classList.remove('show');
        // });


    </script>
@endsection