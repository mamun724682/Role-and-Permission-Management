@extends('backend.layouts.master')

@section('title', 'Create Role')

@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Create Role</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li><span>Create Role</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                @include('backend.layouts.partials.logout')
            </div>
        </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="row">
            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Create New Role</h4>
                        <form action="{{ route('admin.roles.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Name</label>
                                <input type="text" name="role" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Permissions</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="permissoinAll">
                                    <label class="form-check-label" for="permissoinAll">All</label>
                                </div>
                                <hr>
                                @forelse($permissions as $permission)
                                    <div class="form-check">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="permissoin{{$permission->id}}">
                                        <label class="form-check-label" for="permissoin{{$permission->id}}">{{ $permission->name }}</label>
                                    </div>
                                @empty
                                @endforelse
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- basic form end -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#permissoinAll').click(function () {
            if($(this).is(':checked')){
                //Check all
                $('input[type=checkbox]').prop('checked', true)
            }else{
                //Uncheck all
                $('input[type=checkbox]').prop('checked', false)
            }
        });
    </script>
@endpush
