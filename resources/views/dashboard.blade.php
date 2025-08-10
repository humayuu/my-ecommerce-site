@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">

                <div class="col-md-2">
                    @include('frontend.common.user_sidebar');
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span class="text-danger">Hi......</span><strong>{{ Auth::user()->name }}</strong> Welcome to Ecommerce Website</h3>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
