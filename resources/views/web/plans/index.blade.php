@extends('layouts.app')
<style>
    .shopping-wrapper .remove-btn {
        font-size: 16px !important;
        color: #2c3e1a !important
    }
</style>

@section('content')


    <style>
        body {
            background-color: #2c3e1a;

        }

        @font-face {
            font-family: 'Perfectly Nineties';
            src: url('./fonts/PerfectlyNineties-Semibold.otf') format('opentype');
            font-weight: 600;
            /* You can adjust the weight */
            font-style: italic;
            /* Italic style */
        }

        /* Pricing Section Styles */
        .pricing-section {
            font-family: 'Poppins', sans-serif;
            color: #fff;
            padding: 4rem 0rem;
        }

        .section-title {
            font-size: 3rem;
            margin-bottom: 20px;
            font-family: 'Perfectly Nineties', sans-serif;

        }

        .section-description {
            font-size: 1.2rem;
            margin-bottom: 40px;
        }

        /* Pricing Cards */
        .pricing-card {
            background: #efffc8;
            color: #142900;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transform: perspective(1000px) rotateX(0deg);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .pricing-card:hover {
            transform: perspective(1000px) rotateX(-5deg);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
        }

        .card-header {
            background: #fff;
            padding: 30px 20px;
            text-align: center;
            font-family: 'Perfectly Nineties', sans-serif;
            color: #2c3e1a;

        }

        .plan-title {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .plan-price {
            font-size: 2.5rem;
            color: #2c3e1a;
        }

        .plan-price span {
            font-size: 1.2rem;
        }

        .card-body {
            padding: 30px 20px;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .features-list li {
            display: flex;
            /* align-items: center; */
            justify-content: left;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .features-list li i {
            color: #142900;
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .popular {
            border: 2px solid #d7ff4a;
            transform: scale(1.05);
        }

        /* Buttons */
        .btn-primary,
        .btn-success {
            font-size: 1.2rem;
            padding: 10px 30px;
            border-radius: 30px;
            transition: transform 0.3s ease, background 0.3s ease;
            background-color: #2c3e1a;
            color: #fff;
            border: none;

        }

        .btn-primary:hover,
        .btn-success:hover {
            transform: scale(1.1);
            background: #142900;
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pricing-card {
                margin-bottom: 30px;
            }
        }
    </style>
    <div class="container-fluid">
        <section class="pricing-section">
            <div class="container">
                <div class="text-center">
                    <h1 class="section-title">Choose Your Plan</h1>
                    <p class="section-description">Find the perfect plan tailored to your needs.</p>
                </div>
                <div class="row justify-content-center">
                    <!-- Basic Plan -->
                    @foreach ($plans as $plan)                        

                        <div class="col-md-4">
                            <div class="pricing-card">
                                <div class="card-header">
                                    <h3 class="plan-title">{{ $plan->title }}</h3>
                                    <p class="plan-price"><span>{{ $plan->currency }} </span>{{ $plan->price }}<span></span></p>
                                    @php
    $cleanedTitle = strtolower(str_replace(' ', '', $plan->title));
    $monthlyPrice = ($cleanedTitle === 'quarterly') ?  $plan->price / 4 
                 : (($cleanedTitle === 'monthly') ? $plan->price 
                 : $plan->price / 12);
@endphp

<small>{{ $plan->currency }} {{ round($monthlyPrice, 2) }} per month</small>



                                    <p>Charged £4.33 every month on a rolling basis. Cancel anytime</p>
                                </div>
                                <div class="card-body">
                                    <ul class="features-list">
                                        <li><i class="fas fa-check-circle"></i>Exclusive monthly recipes by a nutritionist
                                        </li>
                                        <li><i class="fas fa-check-circle"></i>100+ recipes with everyday ingredients</li>
                                        <li><i class="fas fa-check-circle"></i>Easy meal planning with pre-designed plans
                                        </li>
                                        <li><i class="fas fa-check-circle"></i>Save your favourite recipes</li>
                                        <li><i class="fas fa-check-circle"></i>Flexible grocery list to suit your needs</li>

                                    </ul>
                                    <div class="text-center">
                                        <a href="#" class="btn btn-primary">Choose Plan</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection