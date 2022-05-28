<div class="slider-area">
    <div class="slider-active owl-dot-style owl-carousel">
        @foreach ($products as $product)
            <div class="single-slider pt-100 pb-100 yellow-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12 col-sm-7">
                            <div class="slider-content slider-animated-1 pt-114">
                                <h3 class="animated">We keep pets for pleasure.(может добалю)</h3>
                                <h1 class="animated">{{ $product->short_name }}</h1>
                                <div class="slider-btn">
                                    <a class="animated" href="{{ route('product_details', $product->id) }}">@lang('main.learn_more')</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12 col-sm-5">
                            <div class="slider-single-img slider-animated-1">
                                <img class="animated" src="{{ asset($product->ImgForView) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>