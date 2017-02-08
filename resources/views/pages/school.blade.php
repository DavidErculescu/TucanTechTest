@extends('layouts/base')

@section('content')
    <h2>Schools</h2>
    <p>
        On this page you can see a list of all the available schools and add new ones.
    </p>

    <table class="table table-striped table-hover" style="border: 1px solid #3498db; border-radius: 5px; ">
        <thead style="border-bottom: 1px solid #3498db;">
        <tr>
            <td style="width: 50px; text-align: center;">#</td>
            <td style="width: auto;">School name</td>
            <td style="width: auto;">School member count</td>
            <td style="width: 190px;"></td>
        </tr>
        </thead>
        <tbody>
            @if(count($schools))
                @foreach ($schools as $school)
                    <tr class="active">
                        <td style="text-align: center;">{{ $school->id }}</td>
                        <td>{{ $school->name }}</td>
                        <td>{{ count($school->members) }}</td>
                        <td style="text-align: center;">
                            <a href="{{ URL::route('school_members_page', ['school_id' => $school->id]) }}" type="button" class="btn btn-xs btn-success">View members</a>
                            <a href="{{ URL::route('school_delete_page', ['school_id' => $school->id]) }}" type="button" class="btn btn-xs btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr><td colspan='4'>There are no schools in the database</td></tr>
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

    <form class="form-horizontal" method="post" action="{{ URL::route('school_add_page') }}">
        <fieldset>
            <legend>Add school</legend>
            <div class="form-group">
                <label for="inputName" class="col-lg-2 control-label">School name</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputName" name="name" placeholder="School name">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add school</button>
                </div>
            </div>
        </fieldset>

        {{ csrf_field() }}
    </form>
@endsection