@extends('../shop/layouts/main')

@section('title') Marten - Pet Food eCommerce Bootstrap4 Template @endsection

@section('header_styles')
    @include('../shop/layouts/header_styles_2')
@endsection

@section('content')
    @include('../shop/layouts/header_area')
    @php
        $this_page = 'Checkout';
    @endphp
    @include('../shop/layouts/breadcrumb_area')

        <!-- shopping-cart-area start -->
    <div class="checkout-area pt-95 pb-70">
        <div class="container">
            <h3 class="page-title">checkout</h3>
            <form action="{{ route('confirm_order') }}" method="post">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="billing-info">
                            <label for="user_name">Last Name</label>
                            <input type="text" id="user_name" name="user_name">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="billing-info">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                </div>
                @csrf
                <div class="billing-btn">
                    <button type="submit">Send order</button>
                </div>
            </form>
        </div>
    </div>
    
    @include('../shop/layouts/footer_area')
@endsection

@section('footer_script')
    @include('../shop/layouts/footer_script')
@endsection