<div class="product-area pt-95 pb-70 gray-bg">
    <div class="container">
        <div class="section-title text-center mb-55">
            <h4>Most Populer</h4>
            <h2>Recent Products</h2>
        </div>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="product-wrapper mb-10">
                        <div class="product-img">
                            <a href="{{ route('product_details', $product->id) }}">
                                <img src="{{ asset($product->ImgForView) }}" alt="" style="width:270px; height:265px">
                            </a>
                            <div class="product-action">
                                <a title="Quick View" data-toggle="modal" data-target="#exampleModal" href="#">
                                    <i class="ti-plus"></i>
                                </a>
                                @if ($product->count > 0)
                                    <form action="{{ route('add_product', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="addtocart-btn" title="Add to cart">
                                            <i class="ti-shopping-cart"></i>
                                        </button>
                                    </form>
                                @else
                                    <span>Нет на складе</span>
                                @endif
                            </div>
                            <div class="product-action-wishlist">
                                <a title="Wishlist" href="#">
                                    <i class="ti-heart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-content">
                            <h4><a href="{{ route('product_details', $product->id) }}">{{ $product->short_name }}</a></h4>
                            <div class="product-price">
                                <span class="new">${{ $product->price }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>