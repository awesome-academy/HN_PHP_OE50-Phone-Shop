<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vietpro Mobile Shop</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bower_components/user/css/cart.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/user/css/success.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/user/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/user/css/home.css') }}">
    <link href="{{ asset('bower_components/css/font-awesome.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('bower_components/user/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('bower_components/user/js/bootstrap.js') }}"></script>
</head>

<body>
    <!-- Header -->
    <div id="header">
        <div class="container">
            <div class="row">
                <div id="logo" class="col-lg-3 col-md-2 col-sm-12">
                    <a href="{{ route('home') }}"><img src="{{ asset('bower_components/user/images/logo.png') }}" alt="" /></a>
                </div>
                <div id="search-box" class="col-lg-3 col-md-5 col-sm-12 mt-1">
                    <form class="d-flex" action="{{ route('users.search') }}" method="GET">
                        <input class="form-control" type="text" name="key" placeholder="Tìm kiếm" aria-label="Search">
                        <button class="btn" type="submit">{{ __('Search') }}</button>
                    </form>
                </div>
                <div class="col-lg-2 col-md-1 col-sm-12 mt-1">
                    <div id="cart-notify">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Language') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="{{ route('lang', ['lang' => 'vi']) }}" id="lang">{{ __('VI') }}</a>
                                <br>
                                <a href="{{ route('lang', ['lang' => 'en']) }}" id="lang">{{ __('EN') }}</a>
                            </div>
                        </li>
                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-12 mt-1">
                    @if (Auth::check())
                    <div class="nav-item dropdown">
                        <a id="navbarDropdown notification" class="nav-link notification noti-num" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-bell-o"></i>
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span class="noti" id="noti-quantity">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </a>
                        <div class="dropdown-menu" id="dropdown-noti" aria-labelledby="dropdownMenuButton">
                            <a href="{{ route('users.readall.noti') }}" class="real-all">{{ __('Đánh dấu đã đọc') }}</a>
                            <li class="notification-list">
                                @foreach (auth()->user()->notifications as $item)
                                <a class="dropdown-item dropdown-item-underline" href="{{ route('users.read.noti', $item->id) }}">
                                    <div class="{{ $item->read_at ? 'readed' : 'read' }}">
                                        {{ __('Your order') }}
                                        <strong>
                                            @switch ($item->data['status'])
                                                @case (config('auth.orderStatus.pending'))
                                                    {{ __('Pending') }}
                                                    @break
                                                @case (config('auth.orderStatus.processing'))
                                                    {{ __('Processing') }}
                                                    @break
                                                @case (config('auth.orderStatus.delivering'))
                                                    {{ __('Delivering') }}
                                                    @break
                                                @case (config('auth.orderStatus.complete'))
                                                    {{ __('Complete') }}
                                                    @break
                                                @case (config('auth.orderStatus.cancel'))
                                                    {{ __('Cancel') }}
                                                    @break
                                                @case (config('auth.orderStatus.rejected'))
                                                    {{ __('Rejected') }}
                                                    @break
                                            @endswitch
                                        </strong>
                                        <br>
                                        <small class="box {{ $item->read_at ? 'readed' : 'read' }}">{{ $item->created_at->diffForHumans()}}</small>
                                    </div>
                                </a>    
                                @endforeach
                            </li>
                        </div>
                    </div>
                    @endif
                </div>
                <div id="cart-notify" class="col-lg-3 col-md-3 col-sm-12 mt-1">
                    @guest
                    @if (Route::has('login'))
                        <a class="btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @endif
                    |
                    @if (Route::has('register'))
                        <a class="btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->fullname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                    @csrf
                                    <input type="submit" value="{{ __('logout') }}">
                                </form>
                            </div>
                        </li>
                    @endif
                    <a href="{{ route('users.cart.showCart') }}" id="cart">Giỏ hàng <span>{{ Cart::count() }}</span></a>
                    <div class="clear"></div>
                </div>
                <div id="menu-collapse" class="navbar navbar-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->
    <!-- Main -->
    <div class="container">
        @yield('content')
    </div>
    <!-- End Main -->
    <!-- Footer -->
    <div id="footer-top">
        <div class="container">
            <div class="row">
                <div id="logo-f" class="col-lg-3 col-md-6 col-sm-12">
                    <a href="#"><img src="{{ asset('bower_components/user/images/logo-footer.png') }}" alt=""></a>
                    <p>{{ __('intro_shop') }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 service">
                    <h2>{{ __('Address') }}</h2>
                    <p>{{ __('Ha Noi') }}</p>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 service">
                    <h2>{{ __('Service') }}</h2>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 service">
                    <h2>{{ __('Hotline') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-bot">
        <div class="container">
        </div>
    </div>
    <!-- End Footer -->
    @auth
        <script>
            window.translations = {!! $translation !!};
            window.user = {{ Auth::id() }};
        </script>
    @endauth
    <script src="{{ asset('js/notification.js') }}"></script>
</body>

</html>
