<?php

namespace App\Http\Controllers;

use App\Entities\Member;
use App\Entities\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Input;

class SchoolController extends BaseController
{
    public function listSchools() {
        $viewData = [];
        $viewData['schools'] = School::all();

        return view('pages/school', $viewData);
    }

    public function listMembers($schoolId) {
        $viewData = [];
        $viewData['selected_school'] =  School::find($schoolId);
        $viewData['schools'] = School::all();
        $viewData['members'] =  $viewData['selected_school']->members;

        return view('pages/member', $viewData);
    }

    public function addSchool(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:schools|max:255'
        ]);

        $school = new School();
        $school->name = Input::get('name');
        $school->save();

        return redirect()->route("school_page")->with('save_status', 'School added!');
    }

    public  function deleteSchool($schoolId) {
        $school = School::find($schoolId);

        if (count($school->members)) {
            return back()->withErrors(['School has members! Please delete all its members before deleting this school.']);
        }

        $school->delete();
        return back()->with('save_status', 'School deleted!');
    }
}