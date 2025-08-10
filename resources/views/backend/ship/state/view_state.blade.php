@extends('admin.admin_master')

@section('main')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">State List</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Division Name</th>
                                            <th>District Name</th>
                                            <th>State Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($states as $state)
                                            <tr>
                                                <td>{{ $state['division']['division_name'] }}</td>
                                                <td>{{ $state['district']['district_name'] }}</td>
                                                <td>{{ $state->state_name }}</td>
                                                <td width=40%>
                                                    <a href="{{ route('state.edit', $state->id) }}" title="Edit Data" class="btn btn-info fa fa-pencil"></a>
                                                    <a href="{{ route('state.delete', $state->id) }}" title="Delete Data" id="delete"
                                                        class="btn btn-danger fa fa-trash"></a>
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


                {{-- _________________ Add State Page________________ --}}

                <div class="col-4">

                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Add State</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <form method="POST" action="{{ route('state.store') }}">
                                    @csrf

                                    <div class="form-group">
                                        <h5>Division Select<span class="text-danger">*</span></h5>
                                        <select name="division_id" class="form-control">
                                            <option value="" selected disabled>Select Division</option>
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->id }}">{{ $division->division_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('division_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <h5>District Select<span class="text-danger">*</span></h5>
                                        <select name="district_id" class="form-control">
                                            <option value="" selected disabled>Select District</option>
                                            @foreach ($districts as $district)
                                                <option value="{{ $district->id }}">{{ $district->district_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('district_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <h5>State Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="state_name" class="form-control">
                                            @error('state_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
            </div>
    </div>

@endsection
