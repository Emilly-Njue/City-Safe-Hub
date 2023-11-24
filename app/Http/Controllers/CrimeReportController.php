<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportCrimes;
use App\Models\AddOfficer;
use App\Models\Officer;
use Dompdf\Dompdf;
use PDF; 

use Illuminate\Support\Str;
use Mail;



class CrimeReportController extends Controller
{
    public function reportcrime()
    {
        return view('report_crime');
    }

    public function index()
    {
        // $data = ReportCrimes::all();
        // return view('crime.index', ['data' => $data]);

        $data = ReportCrimes::all();
        $officers = AddOfficer::all(); // Fetch the list of officers

        return view('crime.index', ['data' => $data, 'officers' => $officers]);
    }

    public function create()
    {
        return view('crime.create');
    }


    public function store(Request $request)
    {
        // Validate the form data (you can add more validation rules)
        $request->validate([
            'email' => 'required|email',
            'role' => 'required', 
            'gender' => 'required',
            'title' => 'required',
            'description' => 'required',
            'location' => 'required',
        ]);
    
        // Generate a random code
        $randomCode = Str::random(5);
    
        // Store the report in the database
        $data = new ReportCrimes;
        $data->email = $request->email;
        $data->crime_type = $request->title;
        $data->description = $request->description;
        $data->location = $request->location;
        $data->random_code = $randomCode;
        $data->role = $request->role;
        $data->gender = $request->gender;

        // Set the 'status' field to 'not assigned'
        $data->status = 'no officer assigned';

        $data->save();

        // sending the email to user
        $userEmail = $data->email;
        $Message = "HELLO. \n\nThank you for reporting the crime on City-Safe Hub. Your contribution to community safety is greatly appreciated.\nYour crime report reference code is: $randomCode. \nUse this code to check on the investigation progress. \n\nWarm regards,\nCITY-SAFE HUB.";
        
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
                ->text("A new report has been made.\nWitness/Victim's email: {$data->email}\nWitness/Victim: {$data->role}\nGender: {$data->gender}\nCrime: {$data->crime_type}\nCrime description: {$data->description}\nThe location of the crime: {$data->location}\nCrime report reference code: {$data->random_code}");
        });
       
        // Redirect back to the report crime page and display the success message
        if($request->ref=='front'){
        return redirect('report_crime')->with('success', 'Report submitted successfully! Your crime report code has been sent to your email.');
        }

        return redirect('admin/crime/create')->with('success', 'Reported crime has been recorded.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        ReportCrimes::where('id',$id)->delete();
        return redirect('admin/crime')->with('success','Crime report has been deleted.');
    }

    public function assignOfficer(Request $request, $id)
{
    $report = ReportCrimes::findOrFail($id);

    // Check if the status is 'no officer assigned'
    if ($report->status == 'no officer assigned') {
        // Validate the form data
        $request->validate([
            'officer_id' => 'required|exists:add_officers,id',
        ]);

        // Fetch the officer details
        $officer = AddOfficer::find($request->officer_id);

        // Update the report status with the officer's name
        $report->status = 'Assigned to Officer: ' . $officer->name;
        $report->save();

        return redirect()->back()->with('success', 'Case assigned to ' . $officer->name);
    }

    return redirect()->back()->with('error', 'Case is already assigned');
}

}
