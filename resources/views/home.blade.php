@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Congratulations {{ auth()->user()->name }}! 🎉</h5>
                        <p class="mb-4">
                            Access Are Predefine according to <span class="fw-bold">Rangs Motors HR Policy.</span>
                            If you need more access please contact with HR.
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140"
                            alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png">
                    </div>
                </div>
            </div>
        </div>
        <div class="cards">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-center">
                    <div class="avatar flex-shrink-0">
                        <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success"
                            class="rounded">
                    </div>

                </div>
                <span class="fw-semibold d-block text-center  mb-1">Confirmation Date</span>
                <h3 class="card-title text-center mb-2">{{ date('d-m-Y') }}</h3>

            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <img src="{{ asset('assets/kpi.gif') }}" alt="" srcset="" width="100%">
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-center">
                    <div class="avatar flex-shrink-0">
                        <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success"
                            class="rounded">
                    </div>

                </div>
                <span class="fw-semibold d-block text-center  mb-1">Joining Date</span>
                <h3 class="card-title text-center mb-2">{{ date('d-m-Y') }}</h3>

            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-center">
                    <div class="avatar flex-shrink-0">
                        <img src="{{asset('assets/img/icons/unicons/chart-success.png')}}" alt="chart success"
                            class="rounded">
                    </div>

                </div>
                <span class="fw-semibold d-block text-center  mb-1">Confirmation Date</span>
                <h3 class="card-title text-center mb-2">{{ date('d-m-Y') }}</h3>

            </div>
        </div>
    </div> --}}

    {{-- <div class="d-flex justify-content-center">
        <div class="col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('assets/kpi.gif') }}" alt="" srcset="" width="100%">
                </div>
            </div>
        </div>
    </div> --}}

</div>
@endsection
