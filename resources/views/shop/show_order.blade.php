@extends('../shop/layouts/main')

@section('title') @lang('main.favicon_title') @endsection

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
            <h3 class="page-title">@lang('order.orders')</h3>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="table-content table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>@lang('order.id')</th>
                                <th>@lang('order.status')</th>
                                <th>@lang('order.user_name')</th>
                                <th>@lang('order.describtion')</th>
                                <th>@lang('order.price')</th>
                                <th>@lang('order.created_at')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($orders)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="product-thumbnail">{{ $order->id }}</td>
                                        <td class="product-name">{{ $order->status }}</td>
                                        <td class="product-name">{{ $order->user_name }}</td>
                                        <td class="product-name">{{ $order->description }}</td>
                                        <td class="product-price-cart"><span class="amount">{{ $order->sum }} {{ App\Services\Conversion::getCurCodeById($order->currency_id) }}</span></td>
                                        <td class="product-name">{{ $order->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('../shop/layouts/footer_area')
@endsection

@section('footer_script')
    @include('../shop/layouts/footer_script')
@endsection