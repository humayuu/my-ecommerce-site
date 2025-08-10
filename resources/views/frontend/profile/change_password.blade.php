@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"><br><br>
                  @include('frontend.common.user_sidebar');
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h3 class="text-center"><span
                                class="text-danger">Change Password</h3>

                        <div class="card-body">
                            <form method="POST" action="{{ route('user.update.change.password') }}">
                                @csrf
                                 <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Current Password</label>
                                    <input type="password" class="form-control" id="current_password" name="oldpassword">
                                </div>

                                 <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                 <div class="form-group">
                                    <label class="info-title" for="exampleInputEmail2">Confirm Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                                </div>

                                 <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
