<!-- Dropdown Structure -->
<nav>
  <div class="nav-wrapper top-nav-wrapper">
    <a href="#!" class="brand-logo"><i class="material-icons large white-text">local_florist</i></a>
    <ul class="right hide-on-med-and-down">
        <?php
            $locale      = App::getLocale();
            $locales     = preg_grep( '/[^.]/', scandir( resource_path() . '/lang' ) );
            $locales_str = join( '|', $locales );
            $url         = preg_replace( '/^('.$locales_str.')\/?/', '', Request::path() );
            $url and $url = '/' .$url;
        ?>
        @foreach( $locales as $locale_name )
            @if ( $locale_name != $locale )
                <li><a href='/{{ $locale_name . $url }}'>{{ $locale_name }}</a></li>
            @else
                <li><a class="red-text" href='#'><b>{{ $locale_name }}</b></a></li>
            @endif
        @endforeach
      @guest
         <li><a href="{{ route('login') }}"><i class="material-icons">lock_open</i></a></li>
<!--         <li><a href="{{ route('register') }}"><i class="material-icons">person_add</i></a></li> -->
      @else
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <li>{{ Auth::user()->name }}</li>
        <li><a href="{{ route('home'  )}}"><i class="material-icons">home</i></a></li>
        <li><a href="{{ route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">lock_outline</i></a></li>
      @endguest
    </ul>
  </div>
</nav>
<pre>
</pre>
