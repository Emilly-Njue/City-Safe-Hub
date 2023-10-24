<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddOfficer;

class AddOfficerController extends Controller
{
    public function index()
    {
        $officers = AddOfficer::all();
        return view('add_officers.index', ['officers' => $officers]);
    }

    public function create()
    {
        return view ('add_officers.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'badge_number' => 'required|unique:add_officers',
            'rank' => 'required',
        ]);

        $officer = new AddOfficer;
        $officer->name = $request->name;
        $officer->badge_number = $request->badge_number;
        $officer->rank = $request->rank;
        $officer->save();

        return redirect()->route('add_officers.create')->with('success', 'Officer has been added.');
    }

    public function show($id)
    {
        $officer = AddOfficer::find($id);
        return view('add_officers.show', ['officer' => $officer]);
    }

    public function edit($id)
    {
        $officer = AddOfficer::find($id);
        return view('add_officers.edit', ['officer' => $officer]);
    }
     
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'badge_number' => 'required|unique:add_officers,badge_number,' . $id,
            'rank' => 'required',
        ]);

        $officer = AddOfficer::find($id);
        $officer->name = $request->name;
        $officer->badge_number = $request->badge_number;
        $officer->rank = $request->rank;
        $officer->save();

        return redirect('admin/add_officers/'.$id.'/edit')->with('success', 'Officer data has been updated.');
    }

    public function destroy($id)
    {
        $officer = AddOfficer::find($id);
        $officer->delete();
        return redirect()->route('add_officers.index')->with('success', 'Officer data has been deleted.');
    }
}
