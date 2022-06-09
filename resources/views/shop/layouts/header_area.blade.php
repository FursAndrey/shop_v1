<header class="header-area">
    <div class="header-top theme-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="welcome-area">
                        <p>@lang('header.default_welcome_msg')</p>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="account-curr-lang-wrap f-right">
                        <ul>
                            <li class="top-hover"><a href="#">{{ session('currency', 'BYN') }}<i class="icon-arrow-down"></i></a>
                                <ul>
                                    @foreach (App\Services\Conversion::getCurrencies() as $currency)
                                        <li><a href="{{ route('changeCurrency', $currency->code) }}">{{ $currency->code }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="top-hover"><a href="#">@lang('header.set_locale') ({{ App::getLocale() }}) <i class="icon-arrow-down"></i></a>
                                <ul>
                                    <li><a href="{{ route('changeLocale', 'ru') }}"><img alt="flag" src="{{ asset("img/icon-img/ru.png") }}"> Russian </a></li>
                                    <li><a href="{{ route('changeLocale', 'en') }}"><img alt="flag" src="{{ asset("img/icon-img/en.jpg") }}"> English </a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom transparent-bar">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-4 col-5">
                    <div class="logo pt-39">
                        <a href="{{ route('ind_1') }}"><img alt="" src="{{ asset("img/logo/logo.png") }}"></a>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-7 d-none d-lg-block">
                    <div class="main-menu text-center">
                        <nav>
                            <ul>
                                <li @routeactive('ind_1') @routeactive('ind_2')>
                                    <a href="{{ route('ind_1') }}">@lang('header.menu.home_page')</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="{{ route('ind_1') }}">@lang('header.menu.home_page_v1')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('ind_2') }}">@lang('header.menu.home_page_v2')</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @routeactive('shop_list')>
                                    <a href="{{ route('shop_list') }}">@lang('header.menu.сategory')</a>
                                    <ul class="submenu">
                                        @foreach ($categories as $category)
                                            <li><a href="{{ route('shop_list', $category->code) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a>@lang('header.menu.pages')</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="{{ route('about_us') }}">@lang('header.menu.about_us')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('shop_list') }}">@lang('header.menu.shop_list')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cart') }}">@lang('header.menu.cart_page')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('checkout') }}">@lang('header.menu.checkout')</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact') }}">@lang('header.menu.contact_us')</a>
                                        </li>
                                        @auth
                                            <li>
                                                <a href="{{ route('my_account') }}">@lang('header.menu.my_account')</a>
                                            </li>
                                        @endauth
                                    </ul>
                                </li>
                                <li @routeactive('about_us')>
                                    <a href="{{ route('about_us') }}">@lang('header.menu.about_us')</a>
                                </li>
                                <li @routeactive('contact')>
                                    <a href="{{ route('contact') }}">@lang('header.menu.contact_us')</a>
                                </li>
                                @auth
                                    <li @routeactive('show_order')>
                                        <a href="{{ route('show_order') }}">@lang('header.menu.show_orders')</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('voyager.dashboard') }}">@lang('header.menu.admin')</a>
                                    </li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-8 col-sm-8 col-7">
                    <div class="search-login-cart-wrapper">
                        <div class="header-login same-style">
                            @guest
                                <a href="{{ route('register') }}" title="@lang('header.basket.login')"><i class="icon-user icons"></i></a>
                            @endguest
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" title="@lang('header.basket.logout')">X</button>
                                </form>
                            @endauth
                        </div>
                        <div class="header-cart same-style" title="@lang('header.menu.cart_page')">
                            <button class="icon-cart">
                                <i class="icon-handbag"></i>
                                <span class="count-style">
                                    @if ($order != [])
                                        {{ count($order->products) }}
                                    @else
                                        0
                                    @endif
                                </span>
                            </button>
                            <div class="shopping-cart-content">
                                <ul>
                                    @isset($order->products)
                                        @foreach ($order->products as $product)
                                            <li class="single-shopping-cart">
                                                <div class="shopping-cart-img">
                                                    <a href="#"><img alt="" src="{{ asset("$product->imgForView") }}" style="width: 82px;"></a>
                                                </div>
                                                <div class="shopping-cart-title">
                                                    <h4><a href="#">{{ $product->full_name }}</a></h4>
                                                    <h6>@lang('header.basket.qty'): {{ $product->countInOrder }}</h6>
                                                    <span>{{ $product->PriceForCount }} {{ $curCode }}</span>
                                                </div>
                                                <div class="shopping-cart-delete">
                                                    <form action="{{ route('remove_product', $product->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" title="Remove from cart">X</button>
                                                    </form>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endisset
                                </ul>
                                <div class="shopping-cart-total">
                                    <h4>
                                        @if ($order != [])
                                            @lang('header.basket.total') : <span class="shop-total">{{ $order->getOrderSum() }} {{ $curCode }}</span>
                                        @else
                                            @lang('header.basket.total') : <span class="shop-total">0 {{ $curCode }}</span>
                                        @endif
                                    </h4>
                                </div>
                                <div class="shopping-cart-btn">
                                    <a href="{{ route('cart') }}">@lang('header.menu.cart_page')</a>
                                    <a href="{{ route('checkout') }}">@lang('header.menu.checkout')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="flashes">
    @if (session()->has('succes'))
        <p class="succes">{{ session()->get('succes') }}</p>
    @endif
    @if (session()->has('error'))
        <p class="error">{{ session()->get('error') }}</p>
    @endif
    @if (session()->has('warning'))
        <p class="warning">{{ session()->get('warning') }}</p>
    @endif
</div>