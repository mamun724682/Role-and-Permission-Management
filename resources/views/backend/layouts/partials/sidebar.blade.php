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
                    @if(auth()->guard('admin')->user()->can('dashboard.view'))
                        <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('admin.dashboard') }}"><i class="ti-dashboard"></i><span>dashboard</span></a>
                        </li>
                    @endif
                    @if(auth()->guard('admin')->user()->hasAnyPermission(['role.view', 'role.create', 'role.edit']))
                        <li class="{{ request()->routeIs('admin.roles.index') || request()->routeIs('admin.roles.create') || request()->routeIs('admin.roles.edit') ? 'active' : '' }}">
                            <a href="javascript:void(0)" aria-expanded="true"><i
                                    class="ti-layout-sidebar-left"></i><span>
                                Role & Permission
                                    </span></a>
                            <ul class="collapse">
                                @if(auth()->guard('admin')->user()->can('role.view'))
                                    <li class="{{ request()->routeIs('admin.roles.index') ? 'active' : '' }}"><a
                                            href="{{ route('admin.roles.index') }}">All Roles</a></li>
                                @endif
                                @if(auth()->guard('admin')->user()->can('role.create'))
                                    <li class="{{ request()->routeIs('admin.roles.create') ? 'active' : '' }}"><a
                                            href="{{ route('admin.roles.create') }}">Create Role</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    @if(auth()->guard('admin')->user()->hasAnyPermission(['admin.view', 'admin.create', 'admin.edit']))
                        <li class="{{ request()->routeIs('admin.admins.index') || request()->routeIs('admin.admins.create') || request()->routeIs('admin.admins.edit') ? 'active' : '' }}">
                            <a href="javascript:void(0)" aria-expanded="true"><i
                                    class="ti-layout-sidebar-left"></i><span>
                                Admins
                                    </span></a>
                            <ul class="collapse">
                                @if(auth()->guard('admin')->user()->can('admin.view'))
                                    <li class="{{ request()->routeIs('admin.admins.index') ? 'active' : '' }}"><a
                                            href="{{ route('admin.admins.index') }}">All Admins</a></li>
                                @endif
                                @if(auth()->guard('admin')->user()->can('admin.create'))
                                    <li class="{{ request()->routeIs('admin.admins.create') ? 'active' : '' }}"><a
                                            href="{{ route('admin.admins.create') }}">Create Admin</a></li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    <li class="{{ request()->routeIs('admin.users.index') || request()->routeIs('admin.users.create') || request()->routeIs('admin.users.edit') ? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i
                                class="ti-layout-sidebar-left"></i><span>
                                Users
                                    </span></a>
                        <ul class="collapse">
                            <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}"><a
                                    href="{{ route('admin.users.index') }}">All Users</a></li>
                            <li class="{{ request()->routeIs('admin.users.create') ? 'active' : '' }}"><a
                                    href="{{ route('admin.users.create') }}">Create User</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
