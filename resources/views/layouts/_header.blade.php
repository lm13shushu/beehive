<nav class="navbar navbar-default navbar-static-top"> 
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                beehive
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav" style="margin-left:100px;">
                <li style="width:300px;height:48px; line-height:48px;">
                    @yield('searchType')
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">登录</a></li>
                    <li><a href="{{ route('register') }}">注册</a></li>
                @else
                    <li>
                        <span aria-hidden="true">
                            <button class="glyphicon glyphicon-plus btn btn-default" data-toggle="modal" data-target="#myModal" style="background-color: #f5f5f5;height:48px;border:0;"></button>
                        </span>
                    </li>
                    <li>
                        <a href="{{ route('notifications.index') }}" class="notifications-badge" style="margin-top: -2px;">
                            <span class="badge badge-{{ Auth::user()->notification_count > 0 ? 'hint' : 'fade' }} " title="消息提醒">
                                {{ Auth::user()->notification_count }}
                            </span>
                        </a>
                    </li>
                    <li><a href="{{  route('users.index')  }}"><span class="glyphicon glyphicon-plus glyphicon-th-list"></span></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="user-avatar pull-left" style="margin-right:8px; margin-top:-5px;">
                                <img src="{{ Auth::user()->avatar }}" class="img-circle" width="30px" height="30px">
                            </span>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            @can('manage_contents')
                                <li>
                                    <a href="{{ url(config('administrator.uri')) }}">
                                        <span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span>
                                        管理后台
                                    </a>
                                </li>
                            @endcan
                            <li>
                                <a href="{{ route('users.show', Auth::id()) }}">
                                    <span class="glyphicon glyphicon-user"></span>&nbsp;个人页面
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.edit', Auth::id()) }}">
                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;资料编辑
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    <span class="glyphicon glyphicon-log-out"></span>&nbsp;退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
