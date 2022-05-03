@extends('../shop/layouts/main')

@section('title') Marten - Pet Food eCommerce Bootstrap4 Template @endsection

@section('header_styles')
    @include('../shop/layouts/header_styles_2')
@endsection

@section('content')
    @include('../shop/layouts/header_area')
    @php
        $this_page = 'Wishlist';
    @endphp
    @include('../shop/layouts/breadcrumb_area')

        <!-- shopping-cart-area start -->
    <div class="cart-main-area pt-95 pb-100">
        <div class="container">
            <h3 class="page-title">Your cart items</h3>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Until Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($order->products)
                                @foreach ($order->products as $product)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img src="{{ asset("$product->imgForView") }}" alt="" style="width: 240px;"></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{ $product->full_name }}</a></td>
                                        <td class="product-price-cart"><span class="amount">${{ $product->price }}</span></td>
                                        <td class="product-quantity">
                                            <form action="{{ route('add_product', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="addtocart-btn" title="Add to cart">+</button>
                                            </form>
                                            {{ $product->pivot->count }}
                                            <form action="{{ route('remove_product', $product->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="addtocart-btn" title="Remove from cart">-</button>
                                            </form>
                                        </td>
                                        <td class="product-subtotal">${{ $product->PriceForCount }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="shopping-cart-btn">
                <a href="{{ route('checkout') }}">checkout</a>
            </div>
        </div>
    </div>

    @include('../shop/layouts/footer_area')
@endsection

@section('footer_script')
    @include('../shop/layouts/footer_script')
@endsection