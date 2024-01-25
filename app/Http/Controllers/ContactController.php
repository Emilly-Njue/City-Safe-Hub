<?php

namespace App\Http\Controllers;

// app/Http/Controllers/ContactController.php

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function submitForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Save the form submission in the database
        $contactSubmission = ContactSubmission::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Sending the email to user
        $userEmail = $contactSubmission->email;
        $userMessage = "HELLO {$contactSubmission->full_name}. \n\nThanks for reaching out to the City-Safe Hub! Your message landed safely in our inbox, and we're currently deciphering its secrets (just kidding, it's already in our system).\n\nWe'll get back to you as soon as possible, usually within 24 hours. Until then, keep up the good work keeping our streets safe!
        \n\nCheers, \nCITY-SAFE HUB.";

        Mail::send([], [], function ($message) use ($userEmail, $userMessage) {
            $message->to($userEmail)
                ->subject('Hey there, citizen! Your message received loud and clear.')
                ->text($userMessage);
        });

        // Sending email notification to the admin
        $adminEmail = 'city.safe.hub@gmail.com';
        $adminMessage = "New Contact Form Submission:\n\nFull Name: {$contactSubmission->full_name}\n\nEmail: {$contactSubmission->email}\n\nSubject: {$contactSubmission->subject}\n\nMessage: {$contactSubmission->message}";

        Mail::send([], [], function ($message) use ($adminEmail, $adminMessage) {
            $message->to($adminEmail)
                ->subject('New Contact Form Submission')
                ->text($adminMessage);
        });

        // Optionally, you can redirect the user or show a success message
        return redirect()->back()->with('success', 'Your message has been submitted successfully! Remember, every tip, every report, every voice matters. Together, we can keep our community safe and shining bright. ✨');
    }
}


