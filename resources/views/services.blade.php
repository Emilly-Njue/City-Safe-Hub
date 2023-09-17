@extends('navigation_bar')
@section('content')

        <!-- SERVICES -->
    <section class="services">

        <div class="services-container">

            <div class="service" style="background-image: url('images/investigate1.jpeg')">
                <div class="description">
                    <h2>Crime Reporting</h2>
                    <p>Report non-emergency crimes and <br>incidents online. Your reports help us<br> track and address issues in <br>your community, <br>making it a safer place for everyone.</p>
                </div>
            </div>


            <div class="service" style="background-image: url('images/traffic-lights.jpeg')">
                <div class="description">
                    <h2>traffic Safety</h2>
                    <p>Learn about our efforts to promote <br>traffic safety,including traffic laws, <br>road safety tips, and resources to <br>reduce accidents and improve road <br>conditions.</p>
                    <a href="https://www.example.com/external-article" target="_blank">Read More</a>        
                </div>
            </div>


            <div class="service" style="background-image: url('images/emergency.jpeg')">
                <div class="description">
                    <h2>Emergency Response</h2>
                    <p>We provide rapid emergency response<br> services 24/7 to ensure the safety and <br>well-being of our community members<br> during critical situations.<br> Your safety is our top priority.</p>            
                </div>
            </div>

            <div class="service" style="background-image: url('images/community.jpeg')">
                <div class="description">
                    <h2>Community Policing</h2>
                    <p>Our officers are actively engaged in<br>community policing, fostering positive<br>relationships, and collaborating with<br>residents to create safer neighborhoods.<br>Together, we build trust and unity.</p>
                </div>
            </div>


            <div class="service" style="background-image: url('images/crime.jpeg')">
                <div class="description">
                    <h2>Crime Prevention</h2>
                    <p>Participate in our crime prevention<br>programs and workshops designed to<br>educate residents on safety measures,<br>crime awareness, and how to protect<br>your home and property.</p>
                </div>
            </div>
        </div>

        <!-- Navigation arrows -->
        <div class="scroll-left" onclick="scrollservices('left')">&#9664;</div>
        <div class="scroll-right" onclick="scrollservices('right')">&#9654;</div>

        <script>
            // JavaScript to control horizontal scrolling
            function scrollservices(direction) {
                const servicesContainer = document.querySelector('.services-container');
                
                // Define the scroll amount
                const scrollAmount = 400; // Adjust as needed
                
                if (direction === 'left') {
                    servicesContainer.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                } else if (direction === 'right') {
                    servicesContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                }
            }

        </script>

    </section>
@endsection