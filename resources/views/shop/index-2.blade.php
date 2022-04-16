@extends('../shop/layouts/main')

@section('title') Marten - Pet Food eCommerce Bootstrap4 Template @endsection

@section('header_styles')
    @include('../shop/layouts/header_styles')
@endsection

@section('content')
    @include('../shop/layouts/header_area')
    @include('../shop/layouts/slider_area_2')
    @include('../shop/layouts/category_area_2')
    @include('../shop/layouts/product_area')
    @include('../shop/layouts/testimonial_area_2')
    @include('../shop/layouts/deal_area_2')
    @include('../shop/layouts/service_area')
    @include('../shop/layouts/footer_area')
    <!-- modal -->
    @include('../shop/layouts/modal_area')
@endsection

@section('footer_script')
    @include('../shop/layouts/footer_script')
@endsection