<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- TITLE -->
        <title>CITY SAFE </title>

        <!-- GOOGLE FONT -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Lobster&family=Rubik:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Great+Vibes&family=Lobster&family=Rubik:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Faster+One&family=Great+Vibes&family=Lobster&family=Rubik:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Alkatra&family=Faster+One&family=Great+Vibes&family=Lobster&family=Rubik:wght@300&family=Sail&display=swap" rel="stylesheet">


        <!-- BOOTSTRAP -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

        <!-- ICONS -->
        <script src="https://kit.fontawesome.com/ce7a381eed.js" crossorigin="anonymous"></script>

        <!-- THEMES -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

        <!-- MAIN STYLE -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    </head>


    <body> 
        <div id="page-wrap">


            <!-- HEADER -->
            <header id="header" class="header-v2">

                <!-- HEADER LOGO & MENU -->
                <div class="header_content">
                    <div class="container">
                        <!-- HEADER LOGO
                        <div class="header_logo">
                            <a href="#"><img src="{{ asset('images/e&m_logo2.png') }}" alt=""></a>
                        </div> -->
                        
                        <!-- HEADER MENU -->
                        <nav class="header_menu">

                            <ul class="menu">
                                <li><a href="/">Home</a></li>
                                <li><a href="{{ Route('services') }}">Services</a></li>

                                @if(Session::has('customerlogin'))
                                    <li><a href="{{ Route('crime-report') }}">Report a Crime</a></li>
                                    <li><a href="{{ Route('booking.viewDetails') }}">Details</a></li>
                                    <!-- <li><a href="{{ Route('cancel-reservation') }}">Cancel</a></li> -->
                                    <li><a href="{{ url('logout') }}">Logout</a></li>
                                @else
                                    <li><a href="#" onclick="showLoginNotification()">Report a Crime</a></li>
                                    <li><a href="#" onclick="showLoginNotification()">Details</a></li>
                                    <!-- <li><a href="#" onclick="showLoginNotification()">Cancel</a></li> -->
                                    <li><a href="{{ url('login') }}">Login</a></li>
                                    <li><a href="{{ url('register') }}">Register</a></li>
                                @endif
                                <script>
                                    function showLoginNotification() {
                                        alert("Please log in or register to access this feature.");
                                        window.location.href = "{{ url('login') }}";
                                    }
                                </script>
                                <li><a href="{{ Route('about') }}">About</a></li>
                                <li><a href="{{ Route('contact') }}">Contact</a></li>
                                <li><a href="{{ Route('admin') }}">Admin</a></li>
                            </ul>
                        </nav>
                        <!-- END / HEADER MENU -->
                    </div>
                </div>
                    <!-- END / HEADER LOGO & MENU -->
            </header>
            <!-- END / HEADER -->

            <script>
                var prevScrollpos = window.pageYOffset;
                var isTop = true;

                window.onscroll = function() {
                    var currentScrollPos = window.pageYOffset;

                    if (currentScrollPos === 0) {
                        isTop = true;
                    } else if (isTop && prevScrollpos < currentScrollPos) {
                        isTop = false;
                    }

                    var header = document.getElementById("header");

                    if (isTop) {
                        header.classList.remove("hidden");
                    } else {
                        header.classList.add("hidden");
                    }

                    prevScrollpos = currentScrollPos;
                };

            </script>
            <main>
                @yield('content')
            </main>


        </div>
                    <!-- FOOTER -->
            <footer id="footer">
                <div class="footer_bottom">
                    <div class="container">
                        <p>&copy; 2024 CITY-SAFE HUB All rights reserved.</p>
                    </div>
                </div>
            </footer>
            <!-- END FOOTER -->
    </body>
</html>