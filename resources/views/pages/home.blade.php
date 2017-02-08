@extends('layouts/base')

@section('content')
    <div class="jumbotron">
        <h1>Welcome,</h1>
        <p>
            This is my way of solving the given requirements. As per those requirements this demo can add members with name and e-mail for each and then assinged them to one or many schools.
        </p>
        <p>
            Beside the required members, my demo can also manage schools. I have solved the <i>many-to-many</i> relation between members and schools using an association table.
        </p>
        <p>
            In order to be able to use the demo you have to set it up.
            <br/>
            First create a database and update the <b><i>"./config/database.php"</i></b> file with the correct DB connection details.
            <br/>
            After you've done that run the following command <b><i>"php artisan migrate"</i></b> to create the required tables.
        </p>
        <small>
            Dev time: (approx.) 4 hours
            <br/>
            UI improvements: (approx.) 1 hours
        </small>
    </div>
@endsection