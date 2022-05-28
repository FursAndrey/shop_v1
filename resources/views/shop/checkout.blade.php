@extends('../shop/layouts/main')

@section('title') @lang('main.favicon_title') @endsection

@section('header_styles')
    @include('../shop/layouts/header_styles_2')
@endsection

@section('content')
    @include('../shop/layouts/header_area')
    @php
        $this_page = __('header.menu.checkout');
    @endphp
    @include('../shop/layouts/breadcrumb_area')

        <!-- shopping-cart-area start -->
    <div class="checkout-area pt-95 pb-70">
        <div class="container">
            <h3 class="page-title">@lang('header.menu.checkout')</h3>
            <form action="{{ route('confirm_order') }}" method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        @error('user_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="billing-info">
                            <label for="user_name">@lang('order.user_name')<span style="color:red">*</span></label>
                            <input type="text" id="user_name" name="user_name">
                        </div>
                    </div>
                    @guest
                        <div class="col-lg-12 col-md-12">
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                            <div class="billing-info">
                                <label for="email">@lang('order.user_email')<span style="color:red">*</span></label>
                                <input type="text" id="email" name="email">
                            </div>
                        </div>
                    @endguest
                    <div class="col-lg-12 col-md-12">
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                        <div class="billing-info">
                            <label for="description">@lang('order.describtion')</label>
                            <textarea name="description" id="description" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                @csrf
                <div class="billing-btn">
                    <button type="submit">@lang('order.send')</button>
                </div>
            </form>
        </div>
    </div>
    
    @include('../shop/layouts/footer_area')
@endsection

@section('footer_script')
    @include('../shop/layouts/footer_script')
@endsection