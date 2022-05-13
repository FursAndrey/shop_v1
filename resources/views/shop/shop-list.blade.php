@extends('../shop/layouts/main')

@section('title') Marten - Pet Food eCommerce Bootstrap4 Template @endsection

@section('header_styles')
    @include('../shop/layouts/header_styles')
@endsection

@section('content')
    @include('../shop/layouts/header_area')
    @php
        $this_page = 'Shop Page';
    @endphp
    @include('../shop/layouts/breadcrumb_area')

    <div class="shop-area pt-100 pb-100 gray-bg">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9">
                    <div class="shop-topbar-wrapper">
                        <div class="product-sorting-wrapper">
                            <div class="product-show shorting-style">
                                <label>Showing <span>1-20</span> of <span>100</span> Results</label>
                                <select>
                                    <option value="">12</option>
                                    <option value="">24</option>
                                    <option value="">36</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid-list-options">
                            <ul class="view-mode">
                                <li><a href="#product-grid" data-view="product-grid"><i class="ti-layout-grid4-alt"></i></a></li>
                                <li class="active"><a href="#product-list" data-view="product-list"><i class="ti-align-justify"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="grid-list-product-wrapper">
                        <div class="product-view product-list">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="product-width col-lg-6 col-xl-4 col-md-6 col-sm-6">
                                        <div class="product-wrapper mb-10">
                                            <div class="product-img">
                                                <div class="labels">
                                                    @if ($product->isNew())
                                                        <span class="succes">Новинка</span>
                                                    @endif
                                                    @if ($product->isHit())
                                                        <span class="danger">Хит продаж</span>
                                                    @endif
                                                    @if ($product->isRecomended())
                                                        <span class="warning">Рекомендуемое</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('product_details', $product->id) }}">
                                                    <img src="{{ asset($product->ImgForView) }}" style="width:270px; height:265px" alt="">
                                                </a>
                                                <div class="product-action">
                                                    <a title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                                        <i class="ti-plus"></i>
                                                    </a>
                                                    <form action="{{ route('add_product', $product->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" title="Add to cart">
                                                            <i class="ti-shopping-cart"></i>
                                                            Add to cart
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="product-action-wishlist">
                                                    <a title="Wishlist" href="#">
                                                        <i class="ti-heart"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <h4><a href="{{ route('product_details', $product->id) }}">{{ $product->short_name }}</a></h4>
                                                <div class="product-price">
                                                    <span class="new">${{ $product->price }}</span>
                                                </div>
                                            </div>
                                            <div class="product-list-content">
                                                <h4><a href="#">{{ $product->short_name }}</a></h4>
                                                <div class="product-price">
                                                    <span class="new">${{ $product->price }}</span>
                                                </div>
                                                <p>{{ $product->description }}</p>
                                                <div class="product-list-action">
                                                    <div class="product-list-action-left">
                                                        <form action="{{ route('add_product', $product->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="addtocart-btn" title="Add to cart">
                                                                <i class="ion-bag"></i>
                                                                Add to cart
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="product-list-action-right">
                                                        <a title="Wishlist" href="#"><i class="ti-heart"></i></a>
                                                        <a title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#"><i class="ti-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <div class="shop-widget">
                            <h4 class="shop-sidebar-title">Search Products</h4>
                            <div class="shop-search mt-25 mb-50">
                                <form class="shop-search-form">
                                    <input type="text" placeholder="Find a product">
                                    <button type="submit">
                                        <i class="icon-magnifier"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <form method="GET" action="{{ route('shop_list', $this_category) }}">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Filter By Price</h4>
                                <div class="price_filter mt-25">
                                    <div id="slider-range"></div>
                                    <div class="price_slider_amount">
                                        <div class="label-input">
                                            <label>price : </label>
                                            <span id="amount"></span>
                                            <input type="hidden" id="min_price" name="min_price">
                                            <input type="hidden" id="max_price" name="max_price">
                                        </div>
                                    </div>
                                </div>
                                @foreach (['hit' => 'Хит продаж', 'new' => 'Новинка', 'recomended' => 'Рекомендуемое'] as $code => $label)
                                    <?
                                    if (request()->has($code)) {
                                        $checked = 'checked';
                                    } else {
                                        $checked = '';
                                    }
                                    ?>
                                    <p>
                                        <label for="{{ $code }}">
                                            <input type="checkbox" id="{{ $code }}" name="{{ $code }}" style="width: 16px; height: 16px" {{ $checked }}>
                                            <span style="margin: 0 14px;">{{ $label }}</span>
                                        </label>
                                    </p>
                                @endforeach
                                <button type="submit">Filter</button>
                                <a href="{{ route('shop_list', $this_category) }}">Сбросить фильтр</a>
                            </div>
                        </form>
                        <div class="shop-widget mt-50">
                            <h4 class="shop-sidebar-title">Category </h4>
                                <div class="shop-list-style mt-20">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('shop_list', $category->code) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('../shop/layouts/footer_area')
    <!-- modal -->
    @include('../shop/layouts/modal_area')
@endsection

@section('footer_script')
    @include('../shop/layouts/footer_script')
@endsection