@extends('../shop/layouts/main')

@section('title') @lang('main.favicon_title') @endsection

@section('header_styles')
    @include('../shop/layouts/header_styles_2')
@endsection

@section('content')
    @include('../shop/layouts/header_area')
    @php
        $this_page = __('header.menu.cart_page');
    @endphp
    @include('../shop/layouts/breadcrumb_area')

        <!-- shopping-cart-area start -->
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <h3 class="page-title">@lang('order.your_cart_items')</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>@lang('order.img')</th>
                                    <th>@lang('order.product_name')</th>
                                    <th>@lang('order.price_of_one')</th>
                                    <th>@lang('header.basket.qty')</th>
                                    <th>@lang('order.price_for_product')</th>
                                    <th>@lang('order.delete')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($order->products)
                                    @foreach ($order->products as $product)
                                        <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ asset("$product->imgForView") }}" alt="" style="width: 240px;">
                                            </td>
                                            <td class="product-name">{{ $product->full_name }}</td>
                                            <td class="product-price-cart"><span class="amount">{{ $product->price }} {{ $product->curCode }}</span></td>
                                            <td class="product-quantity">
                                                <form action="{{ route('add_product', $product->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="addtocart-btn" title="@lang('main.add_to_cart')">+</button>
                                                </form>
                                                {{ $product->pivot->count }}
                                                <form action="{{ route('remove_product', $product->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="addtocart-btn" title="Remove from cart">-</button>
                                                </form>
                                            </td>
                                            <td class="product-subtotal">{{ $product->PriceForCount }} {{ $product->curCode }}</td>
                                            <td class="product-remove">
                                                <form action="{{ route('remove_this_product', $product->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="addtocart-btn" title="Remove from cart"><i class="ti-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                @if($order != [])
                                    <h5>@lang('header.basket.total'): {{ $order->getOrderSum() }} {{ $product->curCode }}</h5>
                                @endif
                                <div class="cart-shiping-update">
                                    <a href="{{ route('checkout') }}">@lang('header.menu.checkout')</a>
                                </div>
                                <div class="cart-clear">
                                    <form action="{{ route('clear_cart') }}" method="POST">
                                        @csrf
                                        <button type="submit" title="Remove from cart">@lang('order.clear_cart')</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('../shop/layouts/footer_area')
@endsection

@section('footer_script')
    @include('../shop/layouts/footer_script')
@endsection