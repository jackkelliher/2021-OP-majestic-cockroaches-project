@extends('layouts.layout')
@section('title', 'Enrollment')
@section('content')

<div class="pageContent">
    <h1>Students Enrolled: </h1>
    <br>
    @foreach($cohort as $c)
    <h2>{{$c->subject}} {{$c->year}} Semester {{($c->semester)}} Stream {{$c->stream}}</h2>
    <table id="tables">
        <thead>
            <th onclick="sortTable(0)">ID</th>
            <th onclick="sortTable(1)">Name</th>
            <th onclick="sortTable(2)">Github</th>
            <thead>
                @foreach($enrolment as $e)
                @if($e->cohortId==$c->id)
                <tr></tr>
                <td>{{$e->studentId}}</td>
                <td>{{$e->$name}}</td>
                <td>{{$e->$email}}</td>
                <td>{{$e->github}}</td>
                </tr>
                @endif
                @endforeach
    </table>
    @endforeach

</div>

@endsection