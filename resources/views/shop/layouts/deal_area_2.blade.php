<div class="deal-area bg-img deal-style-white pt-95 pb-100 bg-img" style="background-image:url({{ asset('img/banner/banner-2.jpg') }});">
    <div class="container">
        <div class="section-title section-title-white text-center mb-50">
            <h4>Best Product</h4>
            <h2>Deal of the Week</h2>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="deal-img wow fadeInLeft">
                    <a href="{{ route('product_details', $bestProduct->id) }}"><img src="{{ asset($bestProduct->ImgForView) }}" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="deal-content">
                    <h3><a href="{{ route('product_details', $bestProduct->id) }}">{{ $bestProduct->short_name }}</a></h3>
                    <div class="deal-pro-price">
                        <span>{{ $bestProduct->price }} {{ $bestProduct->curCode }}</span>
                    </div>
                    <p>{{ $bestProduct->description }}</p>
                    <div class="timer timer-style">(может добалю)
                        <div data-countdown="2019/10/01"></div>
                    </div>
                    <div class="discount-btn mt-35">
                        <a class="btn-style" href="{{ route('product_details', $bestProduct->id) }}">@lang('main.learn_more')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>