<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AddOfficer;
use App\Models\Officer;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class OfficerController extends Controller
{    
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            // $data=Officer::all();
            // return view ('officers.index', ['data'=>$data]);

            // Eager load the 'officer' relationship to ensure it's always loaded
            $data = Officer::with('addOfficer')->get();

            return view('officers.index', ['data' => $data]);
        }
    
        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            $officer=AddOfficer::all();
            return view ('officers.create', ['officer'=>$officer]);
        }
    
        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
            $data=new Officer;
            // $data->officer_id=$request->of_id;
            // $data->name=$request->name;
            $data->officer_id = $request->of_id;

            // Fetch the name based on the selected 'of_id'
            $selectedOfficer = AddOfficer::find($request->of_id);
            $data->name = $selectedOfficer->name;
            $data->description = $request->description; 
    
            // Handle image uploads
            if ($request->hasFile('images')) {
                $images = $request->file('images');
        
                foreach ($images as $index => $image) {
                    $imageName = Str::random(40) . '.' . $image->getClientOriginalExtension();
                    $image->storeAs('public/images', $imageName);
                    $data->{"image" . ($index + 1)} = $imageName;
                }
            }
    
            $data->save();
    
            return redirect('admin/officers/create')->with('success', 'Data has been added.');
        }
    
        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
            $data = Officer::findOrFail($id);
        
            return view('officers.show', ['data' => $data]);
        
        }
    
        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
            $officer=AddOfficer::all();
            $data=Officer::find($id);
            return view ('officers.edit', ['data'=>$data, 'officer'=>$officer]);   
    
        }
    
        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {
            $data = Officer::find($id);
            $data->officer_id = $request->of_id;

            // Fetch the name based on the selected 'of_id'
            $selectedOfficer = AddOfficer::find($request->of_id);
            $data->name = $selectedOfficer->name;

            // Update the description
            $data->description = $request->description;

            $data->save();

            return redirect('admin/officers/'.$id.'/edit')->with('success', 'Officer Data Has Been Updated.');
        }

    
        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
            Officer::where('id', $id)->delete();
            return redirect('admin/officers/')->with('success', 'Officer Data Has Been Deleted.');
        }
    }
