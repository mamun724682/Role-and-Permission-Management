@extends('backend.layouts.master')

@section('title', 'Edit Role')

@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Edit Role</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                        <li><span>Edit Role</span></li>
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
                        <h4 class="header-title">Edit Role</h4>
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Name</label>
                                <input type="text" name="role" class="form-control" id="exampleInputEmail1"
                                       aria-describedby="emailHelp" value="{{ $role->name }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Permissions</label>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="permissoinAll" {{ \App\Models\User::roleHasPermissions($role, \Spatie\Permission\Models\Permission::all()) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permissoinAll">All</label>
                                </div>
                                <hr>

                                @forelse($permissionGroups as $key => $permissions)
                                    <div class="row mb-2 allCheckbox">
                                        <div class="col-3">
                                            <div class="form-check" onclick="groupCheckByPermission('permissionGroup{{$key}}', 'group_{{$key}}')">
                                                <input type="checkbox" class="form-check-input group_{{$key}}" id="permissionGroup{{$key}}" {{ \App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="permissionGroup{{$key}}">{{ $key }}</label>
                                            </div>
                                        </div>
                                        <div class="col-9 permissions_{{$key}}_group">
                                            @forelse($permissions as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" name="permissions[]"
                                                           value="{{ $permission->name }}" class="form-check-input group_{{$key}}"
                                                           id="permissoin{{$permission->id}}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} onclick="singlePermissionClick('permissionGroup{{$key}}', 'permissions_{{$key}}_group', {{ count($permissions) }})">
                                                    <label class="form-check-label"
                                                           for="permissoin{{$permission->id}}">{{ $permission->name }}</label>
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
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

@push('styles')
    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>
@endpush

@push('scripts')
    <script>
        //One click to check/uncheck all
        $('#permissoinAll').click(function () {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true)
            } else {
                $('input[type=checkbox]').prop('checked', false)
            }
        });

        //One click on group to check/uncheck all permissions under this group
        function groupCheckByPermission(groupId, className) {
            if($('#'+groupId).is(':checked')){
                $('.'+className).prop('checked', true)
            }else{
                $('.'+className).prop('checked', false)
            }

            implementAllChecked()
        }

        //On single permission click to check/uncheck group
        function singlePermissionClick(groupId, permissionGroupClass, totalPermissionInGroup) {
            var totalInputUnderGroup = $('.'+permissionGroupClass+' input:checked').length
            if (totalInputUnderGroup == totalPermissionInGroup){
                $('#'+groupId).prop('checked', true)
            }else{
                $('#'+groupId).prop('checked', false)
            }

            implementAllChecked()
        }

        //All groups and permissions click to check/uncheck 'All checkbox'
        function implementAllChecked() {
            var totalPermissions = "{{ \Spatie\Permission\Models\Permission::count() }}";
            var totalGroups = "{{ count($permissionGroups) }}";
            var totalCheckedbox = $('.allCheckbox input:checked').length;

            if(totalCheckedbox == (parseInt(totalPermissions) + parseInt(totalGroups))){
                $('#permissoinAll').prop('checked', true)
            }else{
                $('#permissoinAll').prop('checked', false)
            }
        }
    </script>
@endpush
