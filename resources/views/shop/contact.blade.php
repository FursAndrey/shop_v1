@extends('../shop/layouts/main')

@section('title') @lang('main.favicon_title') @endsection

@section('header_styles')
    @include('../shop/layouts/header_styles_2')
@endsection

@section('content')
    @include('../shop/layouts/header_area')
    @php
        $this_page = 'Contact Us(может добалю)';
    @endphp
    @include('../shop/layouts/breadcrumb_area')

    <div class="contact-area pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ti-location-pin"></i>
                        </div>
                        <div class="contact-info-content">
                            <h4>Our Location</h4>
                            <p>012 345 678 / 123 456 789</p>
                            <p><a href="#">info@example.com</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ti-mobile"></i>
                        </div>
                        <div class="contact-info-content">
                            <h4>Contact us Anytime</h4>
                            <p>Mobile: 012 345 678</p>
                            <p>Fax: 123 456 789</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="ti-email"></i>
                        </div>
                        <div class="contact-info-content">
                            <h4>Write Some Words</h4>
                            <p><a href="#">Support24/7@example.com </a></p>
                            <p><a href="#">info@example.com</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="contact-message-wrapper">
                        <h4 class="contact-title">GET IN TOUCH</h4>
                        <div class="contact-message">
                            <form id="contact-form" action="assets/mail.php" method="post">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="contact-form-style mb-20">
                                            <input name="name" placeholder="Full Name" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="contact-form-style mb-20">
                                            <input name="email" placeholder="Email Address" type="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-form-style mb-20">
                                            <input name="subject" placeholder="Subject" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-form-style">
                                            <textarea name="message" placeholder="Message"></textarea>
                                            <button class="submit btn-style" type="submit">SEND MESSAGE</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="contact-map">
                <div id="map"></div>
            </div>
        </div>
    </div>
    
    @include('../shop/layouts/footer_area')
@endsection

@section('footer_script')
    @include('../shop/layouts/footer_script')
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmGmeot5jcjdaJTvfCmQPfzeoG_pABeWo"></script>
    <script>
        function init() {
            var mapOptions = {
                zoom: 11,
                scrollwheel: false,
                center: new google.maps.LatLng(40.709896, -73.995481),
                styles: 
                [
                    {
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [
                            {
                                "color": "#444444"
                            }
                        ]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#f2f2f2"
                            }
                        ]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [
                            {
                                "saturation": -100
                            },
                            {
                                "lightness": 45
                            }
                        ]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "simplified"
                            }
                        ]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [
                            {
                                "visibility": "off"
                            }
                        ]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [
                            {
                                "color": "#F6AB44"
                            },
                            {
                                "visibility": "on"
                            }
                        ]
                    }
                ]
            };
            var mapElement = document.getElementById('map');
            var map = new google.maps.Map(mapElement, mapOptions);
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(40.709896, -73.995481),
                map: map,
                icon: "{{ asset('img/icon-img/map.png') }}",
                animation:google.maps.Animation.BOUNCE,
                title: 'Snazzy!'
            });
        }
        google.maps.event.addDomListener(window, 'load', init);
    </script>
@endsection