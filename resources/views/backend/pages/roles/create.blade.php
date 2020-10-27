@extends('backend.layouts.master')

@section('title')
    Roles
@endsection

@section('styles')
@endsection

@section('admin-content')
    <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Role Create</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                                <li><span>Roles</span></li>
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
                    <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Add New Role</h4>
                                        
                                        @include('backend.layouts.partials.message')

                                        <form action="{{ route('admin.roles.store') }}" method="post">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control" id="role" placeholder="Enter role">
                                            </div>
                                            <h4>Permissions</h4>
                                            @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" class="form-check-input" id="checkPermission{{ $permission->id }}">
                                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                            @endforeach

                                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
@endsection

@section('scripts')
    
@endsection