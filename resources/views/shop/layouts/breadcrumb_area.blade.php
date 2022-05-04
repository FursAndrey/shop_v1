<div class="breadcrumb-area pt-95 pb-95 bg-img" style="background-image:url({{ asset($banner->ImgForView) }});">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>{{ $this_page }}</h2>
            <ul>
                <li><a href="{{ route('ind_1') }}">home</a></li>
                <li class="active">{{ $this_page }}</li>
            </ul>
        </div>
    </div>
</div>