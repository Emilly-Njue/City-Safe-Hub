@extends('navigation_bar')
@section('content')
    <section class="slider-section">
        <div class="slider owl-carousel">
            <div class="item">
                <div class="slide-text">
                    <h1>City-Safe Hub</h1>
                    <h2>Protecting, Serving, Caring.</h2>
                    <p>Think of us as your silent guardian, the watchful eye in the sky, the Robin to your Batman.</p>
                </div>
                <img src="images/police1.jpeg">
            </div>
            <div class="item">
                <img src="images/police2.jpg">
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $('.slider.owl-carousel').owlCarousel({
                    loop:true,
                    margin:0,
                    autoplay:true,
                    autoplayTimeout:5000, // 5 seconds
                    responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:1
                    },
                    1000:{
                        items:1
                    }
                    }
                })
            });

        </script>
    </section> 

@endsection