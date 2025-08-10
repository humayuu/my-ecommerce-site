@extends('admin.admin_master')

@section('main')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Total Admin User</h3>
                            <a class="btn btn-info" style="float: right;" href="{{ route('add-admin') }}">Add Admin User</a>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Access</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($adminUser as $user)
                                            <tr>
                                                <td><img class="w-80 img-thumbnail" src="{{ asset($user->profile_photo_path) }}"
                                                        alt=""></td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                @php
                                                    $permissions = [
                                                        'brand' => ['Brand', 'btn-primary'],
                                                        'category' => ['Category', 'btn-secondary'],
                                                        'product' => ['Product', 'btn-success'],
                                                        'slider' => ['Slider', 'btn-danger'],
                                                        'coupons' => ['Coupons', 'btn-warning'],
                                                        'shipping' => ['Shipping', 'btn-info'],
                                                        'blog' => ['Blog', 'btn-light'],
                                                        'setting' => ['Setting', 'btn-dark'],
                                                        'return_order' => ['Return Order', 'btn-primary'],
                                                        'review' => ['Review', 'btn-secondary'],
                                                        'orders' => ['Orders', 'btn-success'],
                                                        'stock' => ['Stock', 'btn-danger'],
                                                        'reports' => ['Reports', 'btn-warning'],
                                                        'all_user' => ['Alluser', 'btn-info'],
                                                        'admin_user_role' => ['AdminUser Role', 'btn-dark'],
                                                    ];
                                                @endphp

                                                <td>
                                                    @foreach ($permissions as $field => [$label, $class])
                                                        @if ($user->$field == 1)
                                                            <span
                                                                class="badge {{ $class }}">{{ $label }}</span>
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td width="25%">
                                                    <a href="{{ route('edit-admin-user', $user->id) }}" title="View Data"
                                                        class="btn btn-info">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <a href="{{ route('delete-admin-user', $user->id) }}" id="delete" title="Invoice Download"
                                                        class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
        </section>
    </div>
@endsection
