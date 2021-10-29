<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{ asset('backend/images/icon/logo.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li  class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    </li>
                    <li class="{{ request()->routeIs('admin.roles.index') || request()->routeIs('admin.roles.create') || request()->routeIs('admin.roles.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-layout-sidebar-left"></i><span>
                                Role & Permission
                                    </span></a>
                        <ul class="collapse">
                            <li class="{{ request()->routeIs('admin.roles.index') ? 'active' : '' }}"><a href="{{ route('admin.roles.index') }}">All Roles</a></li>
                            <li class="{{ request()->routeIs('admin.roles.create') ? 'active' : '' }}"><a href="{{ route('admin.roles.create') }}">Create Role</a></li>
                        </ul>
                    </li>
                    <li class="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.create') || request()->routeIs('admin.users.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-layout-sidebar-left"></i><span>
                                Users
                                    </span></a>
                        <ul class="collapse">
                            <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}">All Users</a></li>
                            <li class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}"><a href="{{ route('admin.users.create') }}">Create User</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
