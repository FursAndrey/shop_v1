@extends('../shop/layouts/main')

@section('title') @lang('main.favicon_title') @endsection

@section('header_styles')
    @include('../shop/layouts/header_styles')
@endsection

@section('content')
    @include('../shop/layouts/header_area')
    @php
        $this_page = __('product.title_page');
    @endphp
    @include('../shop/layouts/breadcrumb_area')

    <div class="shop-area pt-95 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-img">
                        <div class="labels">
                            @if ($sku->product->isNew())
                                <span class="succes">@lang('main.new')</span>
                            @endif
                            @if ($sku->product->isHit())
                                <span class="danger">@lang('main.hit')</span>
                            @endif
                            @if ($sku->product->isRecomended())
                                <span class="warning">@lang('main.recomended')</span>
                            @endif
                        </div>
                        <img id="zoompro" src="{{ asset($sku->product->ImgForView) }}" data-zoom-image="{{ asset($sku->product->ImgForView) }}" alt="zoom"/>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-content">
                        <h2>
                            {{ $sku->product->short_name }}
                        </h2>
                        <div class="product-price">
                            <span class="new">{{ $sku->price }} {{ $sku->product->curCode }}</span>
                        </div>
                        @if($sku->count > 0)
                            <div class="in-stock">
                                <span><i class="ion-android-checkbox-outline"></i>@lang('product.in_stock')</span>
                            </div>
                        @else
                            <div>@lang('main.not_in_stock')</div>
                        @endif
                        <div class="sku">
                            <span>SKU#: {{ $sku->id }}</span>
                        </div>
                        <p>{{ $sku->product->description }}</p>
                        <div class="product-list-action">
                            <div class="product-list-action-left">
                                @if ($sku->count > 0)
                                    <form action="{{ route('add_product', $sku->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="addtocart-btn" title="@lang('main.add_to_cart')">
                                            <i class="ion-bag"></i>
                                            @lang('main.add_to_cart')
                                        </button>
                                    </form>
                                @else
                                    <span>@lang('main.not_in_stock')</span>
                                @endif
                            </div>
                            <div class="product-list-action-right">&nbsp;</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="description-review-area pb-100">
        <div class="container">
            <div class="description-review-wrapper gray-bg pt-40">
                <div class="description-review-topbar nav text-center">
                    <a class="active" data-toggle="tab" href="#des-details1">@lang('order.describtion')</a>
                    <a data-toggle="tab" href="#des-details2">@lang('order.more_inf')</a>
                </div>
                <div class="tab-content description-review-bottom">
                    <div id="des-details1" class="tab-pane active">
                        <div class="product-description-wrapper">
                            <p>{{ $sku->product->description }}</p>
                        </div>
                    </div>
                    <div id="des-details2" class="tab-pane">
                        <div class="product-anotherinfo-wrapper">
                            <ul>
                                <li><span>@lang('order.product_name_short'):</span>{{ $sku->product->short_name }}</li>
                                @isset($sku->product->properties)
                                    @foreach ($sku->propertyOptions as $propertyOption)
                                        <li><span>{{ $propertyOption->property->name }}:</span> {{ $propertyOption->name }} </li>
                                    @endforeach
                                @endisset
                            </ul>
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