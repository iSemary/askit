
<ul class="navbar-nav ml-auto ">
    <li class="nav-item dropdown p-1">
        <form action="{{route('profile.find')}}" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="value" id="searchBar" style="display: none;" placeholder="Search for users...">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-search" @if(Request::is('search')){{'style=color:#007bff;border-color:#007bff;font-size:18px;'}} @else {{'style=font-size:18px;'}}@endif></i></span>
                </div>
            </div>
        </form>
    </li>
    @if(Auth::user()->is_admin == '1')
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{route('dashboard.index')}}" @if(Request::is('dashboard')){{'style=color:#007bff;'}}@endif>
            <i class="fas fa-tachometer-alt"></i>
        </a>
    </li>
    @endif
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{route('home.index')}}" @if(Request::is('home')){{'style=color:#007bff;'}}@endif>
            <i class="fas fa-home"></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{route('profile.questions')}}" @if(Request::is('questions')){{'style=color:#007bff;'}}@endif >
            <i class="fas fa-question"></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="{{route('profile.friends')}}" @if(Request::is('friends')){{'style=color:#007bff;'}}@endif >
            <i class="fas fa-user-friends"></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="/{{Auth::user()->user_name}}">
            <i class="fas fa-user-circle" @if(Request::is(Auth::user()->user_name)){{'style=color:#007bff;'}}@endif ></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-bell"></i>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fas fa-cog" @if(Request::is('settings')){{'style=color:#007bff;'}}@endif></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('settings.index') }}">Settings</a>
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                @csrf
            </form>
        </div>
    </li>
</ul>