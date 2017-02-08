@extends('layouts/base')

@section('content')
    <h2>Members {{ isset($selected_school) ? "of ".$selected_school->name : "" }}</h2>
    <p>
        On this page you can see a list of all the members and add new ones.
    </p>

    <table class="table table-striped table-hover" style="border: 1px solid #3498db; border-radius: 5px; ">
        <thead style="border-bottom: 1px solid #3498db;">
        <tr>
            <td style="width: 50px; text-align: center;">#</td>
            <td>Member name</td>
            <td>Member email</td>
            <td>Member schools</td>
            <td style="width: 80px;"></td>
        </tr>
        </thead>
        <tbody>
            @if(count($members))
                @foreach($members as $member)
                    <tr class="active">
                        <td style="text-align: center;">{{ $member->id }}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->email }}</td>
                        <td>
                            @foreach($member->schools as $no => $school)
                                <a href="{{ URL::route('school_members_page', ['school_id' => $school->id]) }}" type="button" class="btn btn-xs btn-info">{{ $school->name }}</a>
                            @endforeach
                        </td>
                        <td style="text-align: center;">
                            <a href="{{ URL::route('member_delete_page', ['member_id' => $member->id]) }}" type="button" class="btn btn-xs btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan='4'>There are no members in the database</td></tr>
            @endif
        </tbody>
    </table>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @else
        @if (session('save_status'))
            <div class="alert alert-success">
                {{ session('save_status') }}
            </div>
        @endif
    @endif

    <form class="form-horizontal" method="post" action="{{ URL::route('member_add_page') }}">
        <fieldset>
            <legend>Add member</legend>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">Member name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="Member name" value="{{ Input::old('name') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Member email</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Member email" value="{{ Input::old('email') }}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputSchools" class="col-lg-2 control-label">Member schools</label>
                <div class="col-lg-10">
                    <select  class="form-control" id="inputSchools" name="schools[]" multiple>
                        @foreach($schools as $school)
                            <option value='{{ $school->id }}' {{ isset($selected_school) ? ( $selected_school->id == $school->id ? "selected='selected'" : "" ) : "" }}>{{ $school->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add member</button>
                </div>
            </div>
        </fieldset>

        {{ csrf_field() }}
    </form>
@endsection