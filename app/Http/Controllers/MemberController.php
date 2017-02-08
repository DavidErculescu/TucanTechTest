<?php

namespace App\Http\Controllers;

use App\Entities\Member;
use App\Entities\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Input;


class MemberController extends BaseController
{
    public function listMembers() {
        $viewData = [];
        $viewData['members'] = Member::with('schools')->get();
        $viewData['schools'] = School::all();

        return view('pages/member', $viewData);
    }

    public function addMember(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'email|required|unique:members',
            'schools' => 'required'
        ]);

        $member = new Member();
        $member->name = Input::get('name');
        $member->email = Input::get('email');
        $member->save();

        foreach (Input::get('schools') as $schoolId) {
            School::find($schoolId)->members()->save($member);
        }

        return back()->with('save_status', 'Member added!');
    }

    public  function deleteMember($memberId) {
        $member = Member::find($memberId);
        $member->schools()->sync([]);
        $member->delete();

        return back()->with('save_status', 'Member deleted!');
    }
}