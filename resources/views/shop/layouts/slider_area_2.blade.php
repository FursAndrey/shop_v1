<div class="slider-area">
    <div class="slider-active owl-dot-style owl-carousel">
        @foreach ($products as $product)
            <div class="single-slider pt-215 pb-228 bg-img" style="background-image:url({{ asset($product->ImgForView) }});">
                <div class="container">
                    <div class="slider-content slider-content-white slider-animated-2 text-center">
                        <h3 class="animated">We keep pets for pleasure.</h3>
                        <h1 class="animated">{{ $product->short_name }}<br>For all Pets</h1>
                        <div class="slider-btn">
                            <a class="animated" href="{{ route('sku_details', $product->id) }}">@lang('main.learn_more')</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>