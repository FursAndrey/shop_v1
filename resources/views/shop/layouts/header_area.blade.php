<header class="header-area">
    <div class="header-top theme-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="welcome-area">
                        <p>Default welcome msg! </p>
                    </div>
                </div>
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
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="account-curr-lang-wrap f-right">
                        <ul>
                            <li class="top-hover"><a href="#">$Doller (US) <i class="icon-arrow-down"></i></a>
                                <ul>
                                    <li><a href="#">Taka (BDT)</a></li>
                                    <li><a href="#">Riyal (SAR)</a></li>
                                    <li><a href="#">Rupee (INR)</a></li>
                                    <li><a href="#">Dirham (AED)</a></li>
                                </ul>
                            </li>
                            <li><a href="#"><img alt="flag" src="{{ asset("img/icon-img/en.jpg") }}"> English  <i class="icon-arrow-down"></i></a>
                                <ul>
                                    <li><a href="#"><img alt="flag" src="{{ asset("img/icon-img/bl.jpg") }}">Bangla </a></li>
                                    <li><a href="#"><img alt="flag" src="{{ asset("img/icon-img/ar.jpg") }}">Arabic</a></li>
                                    <li><a href="#"><img alt="flag" src="{{ asset("img/icon-img/in.jpg") }}">Hindi </a></li>
                                    <li><a href="#"><img alt="flag" src="{{ asset("img/icon-img/sp.jpg") }}">Spanish</a></li>
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
                                    <a href="{{ route('ind_1') }}">HOME</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="{{ route('ind_1') }}">home version 1</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('ind_2') }}">home version 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @routeactive('shop_list')>
                                    <a href="{{ route('shop_list') }}">Category</a>
                                    <ul class="submenu">
                                        @foreach ($categories as $category)
                                            <li><a href="{{ route('shop_list', $category->code) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a>PAGES</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="{{ route('about_us') }}">about us</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('shop_list') }}">shop list</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cart') }}">cart page</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('checkout') }}">checkout</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact') }}">contact us</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('my_account') }}">my account</a>
                                        </li>
                                    </ul>
                                </li>
                                <li @routeactive('about_us')>
                                    <a href="{{ route('about_us') }}">ABOUT</a>
                                </li>
                                <li @routeactive('contact')>
                                    <a href="{{ route('contact') }}">contact us</a>
                                </li>
                                @auth
                                    <li @routeactive('show_order')>
                                        <a href="{{ route('show_order') }}">show orders</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('voyager.dashboard') }}">Admin</a>
                                    </li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-8 col-sm-8 col-7">
                    <div class="search-login-cart-wrapper">
                        <div class="header-search same-style">
                            <button class="search-toggle">
                                <i class="icon-magnifier s-open"></i>
                                <i class="ti-close s-close"></i>
                            </button>
                            <div class="search-content">
                                <form action="#">
                                    <input type="text" placeholder="Search">
                                    <button>
                                        <i class="icon-magnifier"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="header-login same-style">
                            @guest
                                <a href="{{ route('register') }}"><i class="icon-user icons"></i></a>
                            @endguest
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">X</button>
                                </form>
                            @endauth
                        </div>
                        <div class="header-cart same-style">
                            <button class="icon-cart">
                                <i class="icon-handbag"></i>
                                <span class="count-style">
                                    @if ($order != [])
                                        {{ $order->CountProducts }}
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
                                                    <h6>Qty: {{ $product->pivot->count }}</h6>
                                                    <span>${{ $product->PriceForCount }}</span>
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
                                            Total : <span class="shop-total">${{ $order->getOrderSum() }}</span>
                                        @else
                                            Total : <span class="shop-total">$0</span>
                                        @endif
                                    </h4>
                                </div>
                                <div class="shopping-cart-btn">
                                    <a href="{{ route('cart') }}">view cart</a>
                                    <a href="{{ route('checkout') }}">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile-menu-area electro-menu d-md-block col-md-12 col-lg-12 col-12 d-lg-none d-xl-none">
                    <div class="mobile-menu">
                        <nav id="mobile-menu-active">
                            <ul class="menu-overflow">
                                <li><a href="{{ route('ind_1') }}">HOME</a>
                                    <ul>
                                        <li><a href="{{ route('ind_1') }}">home version 1</a></li>
                                        <li><a href="{{ route('ind_2') }}">home version 2</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">pages</a>
                                    <ul>
                                        <li>
                                            <a href="{{ route('about_us') }}">about us</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('shop_list') }}">shop list</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cart') }}">cart page</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('checkout') }}">checkout</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('contact') }}">contact us</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('my_account') }}">my account</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#">Category</a>
                                    <ul>
                                        @foreach ($categories as $category)
                                            <li><a href="{{ route('shop_list') }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="{{ route('contact') }}"> Contact us </a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>