@extends('navigation_bar')
@section('content')

  <div class="contact-form">
    <h2>Contact Us</h2>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <form method="post" action="{{ route('contact.submit') }}">
      @csrf
      <div>
        <label for="full_name">Name:</label>
        <input type="text" id="full_name" name="full_name" required>
      </div>
      <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
      </div>
      <div>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
      </div>
      <button type="submit">Send</button>
    </form>

  </div>
    
@endsection