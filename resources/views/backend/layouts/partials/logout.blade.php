<div class="user-profile pull-right">
    <img class="avatar user-thumb" src="{{ asset('backend/images/author/avatar.png') }}"
         alt="avatar">
    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">{{ auth()->guard('admin')->user()->name }} <i
            class="fa fa-angle-down"></i></h4>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Message</a>
        <a class="dropdown-item" href="#">Settings</a>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <a class="dropdown-item"  onclick="event.preventDefault();
                                                this.closest('form').submit();">Log Out</a>
        </form>
    </div>
</div>
