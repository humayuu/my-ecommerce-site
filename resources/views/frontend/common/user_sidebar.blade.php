@php

    $id = Auth::user()->id;
    $user = App\Models\User::find($id);

@endphp
<img class="card-img-top" style="border-radius: 50%"
    src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/' . $user->profile_photo_path) : url('upload/no_image.jpg') }}"
    width="100%" height="100%">
<br><br>
<ul class="list-group list-group-flush">
    <a class="btn btn-primary btn-sm btn-block" href="{{ route('dashboard') }}">Home</a>
    <a class="btn btn-primary btn-sm btn-block" href="{{ route('user.profile') }}">Profile Update</a>
    <a class="btn btn-primary btn-sm btn-block" href="{{ route('my.order') }}">My Order</a>
    <a class="btn btn-primary btn-sm btn-block" href="{{ route('return-order-list') }}">Return Order</a>
    <a class="btn btn-primary btn-sm btn-block" href="{{ route('cancel-order') }}">Cancel Order</a>
    <a class="btn btn-primary btn-sm btn-block" href="#">Change Password</a>
    <a class="btn btn-danger btn-sm btn-block" href="{{ route('user.logout') }}">Logout</a>
</ul>
