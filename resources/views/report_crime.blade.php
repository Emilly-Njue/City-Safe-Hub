@extends('navigation_bar')
@section('content')
    <section id="crime">

        <div class="report-crime">
            <form method="POST" action="{{ route('crime-report.store') }}">
                @csrf
                <h2 style="font-size:20px;">Got the scoop on crime? Spill the beans (anonymously!), hero.</h2>
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{session('success')}}
                    </div>
                @endif

                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="ENTER YOUR EMAIL" required>
                </div>
                
                <div class="form-group">
                    <label for="role">Are you a victim or a witness?</label>
                    <select name="role" id="role" class="form-control" required>
                        <option value="" disabled selected>Choose one</option>
                        <option value="Victim">Victim</option>
                        <option value="Witness">Witness</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="" disabled selected>Choose gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">Crime:</label>
                    <select name="title" id="title" class="form-control" required>
                        <option value="" disabled selected>Select an option</option>
                        <option value="Assault">Assault</option>
                        <option value="Burglary">Burglary/Robbery/Theft</option>
                        <option value="Vandalism">Vandalism</option>
                        <option value="Fraud">Fraud</option>
                        <option value="Harassment">Harassment/Stalking</option>
                        <option value="Domestic Violence">Domestic Violence</option>
                        <option value="Carjacking">Carjacking</option>
                        <option value="Kidnapping">Kidnapping</option>
                        <option value="Drug Offense">Drug Offense</option>
                        <option value="Sexual Assault">Sexual Assault</option>
                        <option value="Shoplifting">Shoplifting</option>
                        <option value="Child Abuse">Child Abuse</option>
                        <option value="Environmental Crime">Environmental Crime</option>
                        <option value="Trespassing">Trespassing</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>

                <div>
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" required placeholder="PLEASE GIVE MORE DETAILS" required></textarea>
                </div>

                <div>
                    <label for="location">Location:</label>
                    <input type="text" name="location" id="location" required placeholder="WHERE IT HAPPENED" required>
                </div>

                <button type="submit" class="btn btn-primary">Submit
                    <input type="hidden" name="ref" value="front">
                </button>
            </form>
        </div>

        <script>
            // Email validation using regular expression
            var emailInput = document.getElementById("email");
                emailInput.addEventListener("input", function () {
                var email = emailInput.value;
                var emailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                if (!email.match(emailPattern)) {
                    emailInput.setCustomValidity("Please enter a valid email address.");
                } else {
                    emailInput.setCustomValidity("");
                }
            });
        </script>
    </section>
@endsection