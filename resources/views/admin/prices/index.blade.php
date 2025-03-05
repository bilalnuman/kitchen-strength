@extends('layouts.admin')

@section('content')
    <div class="main-content">
        <section class="pricing-wrapper">
            <div class="container-pricing">
                <div class="price-header text-center mb-5">
                    <h2 class="section-title">Find Your Perfect Plan</h2>
                </div>
                <div class="row justify-content-center">
                    <!-- Monthly Plan -->
                    @foreach ($prices as $item)
                        <div class="col-md-4 mb-4">
                            <div class="pricing-card">
                                <h5 class="mb-3">{{ $item->title }}</h5>
                                <div class="price">${{ $item->amount }} <span class="duration"><span
                                            class="text-uppercase">{{ $item->currency }}</span>/mo</span></div>
                                <div class="card-footer">{{ $item->payment_type }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection