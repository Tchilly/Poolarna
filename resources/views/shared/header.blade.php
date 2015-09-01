<header id="header">
    <nav class="navbar navbar-default">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">Poolarna</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li{!! (Route::is('event.index', 'event.show') ? ' class="active"' : '') !!}><a href="/event">Events</a></li>
                @if (Auth::check())
                  <li{!! (Route::is('event.create') ? ' class="active"' : '') !!}><a href="/event/create">Create event</a></li>
                @endif
              </ul>
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    @if (Auth::check())
                      Welcome, {{ Auth::user()->name }} <span class="caret"></span></a>
                    @else
                      Profile <span class="caret"></span></a>
                    @endif
                  <ul class="dropdown-menu">

                    @if (Auth::check())
                      <li><a href="/auth/logout">Sign out</a></li>
                    @else
                      <li><a href="/auth/login">Sign in</a></li>
                      <li><a href="/auth/register">Register</a></li>
                    @endif

                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
</header>
