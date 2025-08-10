<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\ShipState;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;

class ShippingAreaController extends Controller
{
    // Function for Redirect to division view page
    public function DivisionView()
    {
        $divisions = ShipDivision::orderBy('id', 'DESC')
            ->get();
        return view('backend.ship.view_division', compact('divisions'));
    }


    // Function for store Division
    public function DivisionStore(Request $request)
    {
        $request->validate([
            'division_name' => 'required'
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'Division Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // Function for Edit Division
    public function DivisionEdit($id)
    {
        $division = ShipDivision::findOrFail($id);

        return view('backend.ship.edit_division', compact('division'));
    }

    // Function for Update Division
    public function DivisionUpdate(Request $request, $id)
    {
        $request->validate([
            'division_name' => 'required'
        ]);

        ShipDivision::findOrFail($id)
            ->update([
                'division_name' => $request->division_name,
                'updated_at' => Carbon::now()
            ]);

        $notification = [
            'message' => 'Division Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('manage-division')->with($notification);
    }

    // Function for Delete Division
    public function DivisionDelete($id)
    {
        ShipDivision::findOrFail($id)
            ->delete();

        $notification = [
            'message' => 'Division Delete Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->route('manage-division')->with($notification);
    }


    // ------------------------------Ship District ------------------------//

    // Function for Manage Ship District
    public function DistrictView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')
            ->get();
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')
            ->get();
        return view('backend.ship.district.view_district', compact('divisions', 'districts'));
    }

    // Function for Store Ship District
    public function DistrictStore(Request $request)
    {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required'
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'District Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // Function for Edit Ship District
    public function DistrictEdit($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')
            ->get();
        $district = ShipDistrict::findOrFail($id);

        return view('backend.ship.district.edit_district', compact('district', 'divisions'));
    }

    // Function for Update District
    public function DistrictUpdate(Request $request, $id)
    {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required'
        ]);

        ShipDistrict::findOrFail($id)
            ->update([
                'division_id' => $request->division_id,
                'district_name' => $request->district_name,
                'updated_at' => Carbon::now()
            ]);

        $notification = [
            'message' => 'District Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('manage-district')->with($notification);
    }

    // Function for Delete District
    public function DistrictDelete($id)
    {
        ShipDistrict::findOrFail($id)
            ->delete();

        $notification = [
            'message' => 'District Delete Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->route('manage-district')->with($notification);
    }

    // ------------------------------Ship State ------------------------//

    // Function for Manage Ship District
    public function StateView()
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')
            ->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')
            ->get();
        $states = ShipState::with('division', 'district')
            ->orderBy('id', 'DESC')
            ->get();
        return view('backend.ship.state.view_state', compact('divisions', 'districts', 'states'));
    }

    // Function for Store State
    public function StateStore(Request $request)
    {
        $request->validate([
            'district_id' => 'required',
            'division_id' => 'required',
            'state_name' => 'required'
        ]);

        ShipState::insert([
            'district_id' => $request->district_id,
            'division_id' => $request->division_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now()
        ]);

        $notification = [
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    // Function for Return Edit Page
    public function StateEdit($id)
    {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')
            ->get();
        $districts = ShipDistrict::orderBy('district_name', 'ASC')
            ->get();

        $state = ShipState::findOrFail($id);

        return view('backend.ship.state.edit_state', compact('divisions', 'districts', 'state'));
    }

    // Function for Update State Record
    public function StateUpdate(Request $request, $id)
    {
        $request->validate([
            'district_id' => 'required',
            'division_id' => 'required',
            'state_name' => 'required'
        ]);

        ShipState::findOrFail($id)
            ->update([
                'district_id' => $request->district_id,
                'division_id' => $request->division_id,
                'state_name' => $request->state_name,
                'updated_at' => Carbon::now()
            ]);

        $notification = [
            'message' => 'State Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('manage-state')->with($notification);
    }

    // Function for Delete State Record
    public function StateDelete($id)
    {
        ShipState::findOrFail($id)
            ->delete();

        $notification = [
            'message' => 'State Delete Successfully',
            'alert-type' => 'error'
        ];

        return redirect()->route('manage-state')->with($notification);
    }
}
