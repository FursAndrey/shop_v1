<div class="food-category pt-100 pb-70">
    <div class="container">
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-lg-4 col-md-4">
                    <div class="single-food-category-2 text-center mb-30">
                        <div class="single-food-hover">
                            <img src="{{ asset("img/product/food-catigory-1.png") }}" alt="">
                        </div>
                        <h3>{{ $category->name }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>