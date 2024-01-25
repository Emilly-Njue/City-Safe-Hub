<!-- resources/views/check_progress.blade.php -->

@extends('navigation_bar') 

@section('content')
    <section class="section-investigation-details">
        <div class="container">
            <p style="font-size: 20px;color: white;font-family: 'Alkatra', cursive;font-weight: bold;text-transform: uppercase; margin-left:15%;"> We're the shield that protects your streets, the flashlight that shines on injustice, and the helping hand that picks up the pieces when things go sideways.</p>
            <h2 class="section-title">Check Investigation Progress</h2>
            <form action="{{ route('checkprogress') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="crimeCode">Enter Crime Report Code:</label>
                    <input type="text" id="crimeCode" name="crimeCode" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Check Progress</button>
            </form>

            @if (isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endif



            @if(isset($report))
                <div class="mt-4">
                    <h4 style="color:white; text-transform: uppercase;">Investigation Status:</h4>
                    <p style="color:white;">{{ $report->status }}</p>

                    @if($report->assigned_officer)
                        <h4 style="color:white; text-transform: uppercase;">Officer in Charge:</h4>
                        <p style="color:white;">{{ $report->assigned_officer }}</p>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection
