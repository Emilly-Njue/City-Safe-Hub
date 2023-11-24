@extends('admin_layout')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Report A Crime
                <a href="{{ url('admin/crime') }}" class="float-right btn btn-success btn-sm">View All Reported Crimes</a>
            </h6>
        </div>
        <div class="card-body">

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p class="text-danger">{{ $error }}</p>
                @endforeach
            @endif
            @if(Session::has('success'))
                <p class="text-success">{{ session('success') }}</p>
            @endif
            <div class="table-responsive">
                <form method="post" enctype="multipart/form-data" action="{{ url('admin/crime-report.store') }}">
                    @csrf
                    <table class="table table-bordered">
                        <tr>
                            <th>Email:</th>
                            <td>
                                <input type="email" name="email" placeholder="ENTER YOUR EMAIL" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Are you a victim or a witness?</th>
                            <td>
                                <select name="role" class="form-control" required>
                                    <option value="" disabled selected>Choose one</option>
                                    <option value="Victim">Victim</option>
                                    <option value="Witness">Witness</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                            <td>
                                <select name="gender" class="form-control" required>
                                    <option value="" disabled selected>Choose gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Crime:</th>
                            <td>
                                <select name="title" class="form-control" required>
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
                        </select>                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>
                                <textarea name="description" required placeholder="PLEASE GIVE MORE DETAILS"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Location:</th>
                            <td>
                                <input type="text" name="location" required placeholder="WHERE IT HAPPENED">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <script>
                // Email validation using regular expression
                var emailInput = document.querySelector("input[name='email']");
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
        </div>
    </div>
@endsection
