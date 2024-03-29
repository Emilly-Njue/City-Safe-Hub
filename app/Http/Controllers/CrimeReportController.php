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

    public function show($id)
    {
        // Your logic here, or leave it empty if not needed.
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
        return redirect('report_crime')->with('success', "Report submitted successfully! Your crime report code has been sent to your email. Don't worry, we're not here to judge, just to help. So, whether it's a missing cat, a noise complaint that's louder than a rock concert, or something bigger brewing, click the 'Report' button and let us know.");
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
    
            // Update the report with the assigned officer
            $report->assigned_officer = $officer->name;
    
            // Update the status to 'Being Investigated'
            $report->status = 'Being Investigated';
    
            $report->save();

            // sending the email to user
            $userEmail = $report->email; 
            $Message = "HELLO. \n\nThank you for reporting the crime on City-Safe Hub. Your report has been assigned to officer {$officer->name}. \n\nWarm regards,\nCITY-SAFE HUB.";
            
            Mail::send([], [], function ($message) use ($userEmail, $Message) {
                $message->to($userEmail)
                    ->subject('CASE ASSIGNED TO OFFICER.')
                    ->text($Message);
            });

            // Send email notification to the admin
            $adminEmail = 'city.safe.hub@gmail.com'; 
            Mail::send([], [], function ($message) use ($adminEmail, $report, $officer) {
                $message->to($adminEmail)
                    ->subject('NEW CRIME REPORT ASSIGNED')
                    ->text("A new report has been made.\nWitness/Victim's email: {$report->email}\n\nWitness/Victim: {$report->role}\nCrime: {$report->crime_type}\nCrime description: {$report->description}\nThe location of the crime: {$report->location}\nCrime report reference code: {$report->random_code}\n\nAssigned to Officer: {$officer->name}");
            });

            // sending the email to the assigned officer
            $officerEmail = $officer->email; 
            $Message = "HELLO Officer{$officer->name}. \n\nA new crime report has been assigned to you on City-Safe Hub. \n\nWitness/Victim's email: {$report->email}\nWitness/Victim: {$report->role}\nCrime: {$report->crime_type}\nCrime description: {$report->description}\nThe location of the crime: {$report->location}\nCrime report reference code: {$report->random_code}";

            Mail::send([], [], function ($message) use ($officerEmail, $Message) {
                $message->to($officerEmail)
                    ->subject('CASE ASSIGNED TO YOU.')
                    ->text($Message);
            });

            return redirect()->back()->with('success', 'Case assigned to ' . $officer->name);
        }

        return redirect()->back()->with('error', 'Case is already assigned');
    }

    public function completeInvestigation($id)
    {
        $report = ReportCrimes::findOrFail($id);

        // Check if the status is 'Being Investigated'
        if ($report->status == 'Being Investigated') {
            // Update the status to 'Investigation completed'
            $report->status = 'Investigation completed';
            $report->save();

            // sending the email to user
            $userEmail = $report->email; 
            $Message = "HELLO. \n\nThe investigation on your crime report REF:{$report->random_code} on City-Safe Hub has been completed. \n\nWarm regards,\nCITY-SAFE HUB.";

            Mail::send([], [], function ($message) use ($userEmail, $Message) {
                $message->to($userEmail)
                    ->subject('INVESTIGATION COMPLETED')
                    ->text($Message);
            });

            // Send email notification to the admin
            $adminEmail = 'city.safe.hub@gmail.com'; 
            Mail::send([], [], function ($message) use ($adminEmail, $report) {
                $message->to($adminEmail)
                    ->subject('Investigation Completed')
                    ->text("The investigation on the crime report with REF: {$report->random_code} has been completed.");
            });

            return redirect()->back()->with('success', 'Investigation completed for case ID ' . $report->random_code);
        }

        return redirect()->back()->with('error', 'Case is not assigned to an officer');
    }

    public function inconclusiveInvestigation($id)
    {
        $report = ReportCrimes::findOrFail($id);

        // Check if the status is 'Being Investigated'
        if ($report->status == 'Being Investigated') {
            // Update the status to 'Investigation inconclusive'
            $report->status = 'Investigation inconclusive';
            $report->save();

            // sending the email to user
            $userEmail = $report->email; 
            $Message = "HELLO. \n\nWe regret to inform you that the investigation into your crime report REF: {$report->random_code} has reached an inconclusive outcome. We apologize for any inconvenience this may cause. \n\nWe will continue to monitor the situation and reopen the investigation if new evidence emerges. \n\nPlease remain vigilant and take appropriate precautions. \n\nWarm regards,\nCITY-SAFE HUB.";

            Mail::send([], [], function ($message) use ($userEmail, $Message) {
                $message->to($userEmail)
                    ->subject('Investigation Inconclusive')
                    ->text($Message);
            });

            // Send email notification to the admin
            $adminEmail = 'city.safe.hub@gmail.com'; 
            Mail::send([], [], function ($message) use ($adminEmail, $report) {
                $message->to($adminEmail)
                    ->subject('Investigation Inconclusive')
                    ->text("The investigation on the crime report with REF: {$report->random_code} was inconclusive.");
            });

            return redirect()->back()->with('success', 'Investigation inconclusive for case REF: ' . $report->random_code);
        }

        return redirect()->back()->with('error', 'Case is not assigned to an officer');
    }

    public function generateReport()
    {
        // Retrieve crime reports data
        $reports = ReportCrimes::all();

        // Pass the data to the report view
        $html = view('crime_report_pdf', compact('reports'))->render();

        // Generate the PDF using Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->render();

        // Generate a unique filename for the PDF
        $filename = 'Crime_Reports' . '.pdf';

        // Save the PDF to the storage path
        $pdfPath = storage_path('app/' . $filename);
        file_put_contents($pdfPath, $dompdf->output());

        // Return the PDF as a response or download it
        return response()->download($pdfPath, $filename);
    }

    public function checkProgress()
    {
        return view('check_progress');
    }    
   
    public function checkInvestigationProgress(Request $request)
    {
        try {
            $request->validate([
                'crimeCode' => 'required|exists:report_crimes,random_code',
            ]);
    
            // Retrieve the report based on the entered crime code
            $report = ReportCrimes::where('random_code', $request->crimeCode)->first();
    
            // Check if a report is found
            if ($report) {
                return view('check_progress', ['report' => $report, 'error' => null]);
            } else {
                // Report not found, pass an error message
                $error = 'Crime report not found. Please check the entered code.';
                return view('check_progress', ['report' => null, 'error' => $error]);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging purposes
            \Log::error('Exception in checkInvestigationProgress: ' . $e->getMessage());
    
            // Return a generic error message
            return view('check_progress', ['report' => null, 'error' => 'Crime report not found. Please check the entered code.']);
        }
    }
        
    
}
