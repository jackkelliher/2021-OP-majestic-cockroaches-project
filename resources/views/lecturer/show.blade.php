@extends('inc.layout')
@section('title', $lecturer->name)
@section('content')
<div class=flexContainer>
    @can('check_ownership', $lecturer)
    <div class=item>
        <h1> <a href="{{ route('lecturer.edit', $lecturer->id) }}"><i class="fas fa-user-edit"></i></a></h1>
        <h3>Email: {{ $lecturer->email }}</h3>
        <h3>Username: {{ $lecturer->username }}</h3>

        <table id="tables">
            <tr>
                <th onclick="sortTable(0)">Paper</th>
                <th onclick="sortTable(1)">Year</th>
                <th onclick="sortTable(2)">Semester</th>
                <th onclick="sortTable(3)">Stream</th>
                <th onclick="sortTable(4)">Unassign</th>
            </tr>
            @foreach($cohorts as $c)
            <tr>
                <td><a href="{{route('cohort.show', $c->id)}}">{{ $c->subject }}</a></td>
                <td>{{$c->year}}</td>
                <td>{{$c->semester}}</td>
                <td>{{$c->stream}}</td>
                <form method="POST" action="{{ route('unassign', $c->id) }}">
                    @csrf

                    <td><button type="submit" id="{{$c->id}}">Unassign</button></td>

                </form>
            </tr>
            @endforeach
        </table>
        <br>
    </div>
    @else
    <h1>Unauthorized</h1>
    <h3>Please log in as an administrator to view this page</h3>
    @endcan
</div>
@endsection
