<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrimeReport;
use Illuminate\Support\Str;
use Mail;



class CrimeReportController extends Controller
{
    public function reportcrime()
    {
        return view('report_crime');
    }

    public function store(Request $request)
    {
        // Validate the form data (you can add more validation rules)
        $request->validate([
            'email' => 'required|email',
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
        ]);
    
        // Generate a random code
        $randomCode = Str::random(5);
    
        // Store the report in the database
        $data = new CrimeReport;
        $data->email = $request->email;
        $data->crime_type = $request->title;
        $data->description = $request->description;
        $data->location = $request->location;
        $data->random_code = $randomCode;
        $data->save();

        // sending the email to user
        $userEmail = $data->email;
        $Message = "HELLO. \n\nThank you for reporting the crime on City-Safe Hub. Your contribution to community safety is greatly appreciated.\nYour crime report code is: $randomCode. \nUse this code to check on the investigation progress. \n\nWarm regards,\nCITY-SAFE HUB.";
        
        Mail::send([], [], function ($message) use ($userEmail, $Message) {
            $message->to($userEmail)
                ->subject('Thank You for Reporting a Crime on City-Safe Hub')
                ->text($Message);
        });

        // Send email notification to the admin
        $adminEmail = 'city.safe.hub@gmail.com'; 
        Mail::send([], [], function ($message) use ($adminEmail, $data) {
            $message->to($adminEmail)
                ->subject('New Crime Report')
                ->text("A new report has been made.\n\nWitness/Victim's email: {$data->email}\n\nCrime: {$data->crime_type}\n\nCrime description: {$data->description}\n\nThe location of the crime: {$data->location}\n\nCrime report code: {$data->random_code}");
        });
       
        // Redirect back to the report crime page and display the success message
        return redirect('report_crime')->with('success', 'Report submitted successfully! Your crime report code has been sent to your email.');
    } 
}
