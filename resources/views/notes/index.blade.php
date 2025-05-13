@extends('inc.layout')
@section('title', 'Notes')
@section('content')
<div class=flexContainer>
    <div class=item>
        <div class=item>
                <input type="text" id="mySearch" onkeyup="search(3)" placeholder="Search for names or id..">
        </div>
        @if(count($notes)>0)
        <table id='tables'>
            <tr>
                <th onclick="sortTable(0)">Student Name</th>
                <th onclick="sortTable(1)">Notes</th>
                <th onclick="sortTable(2)">Student ID</th>
            </tr>
            @foreach($notes as $n)
            <tr>
                <td><p>{{$n->student_name}}</p></td>
                <td><p>{{$n->notes}}</p></td>
                <td><p>{{$n->student_id}}</p></td>
            </tr>

            @endforeach
        </table>
        @else
        <h2>No notes have been uploaded</h2>
        @endif

    </div>
</div>

@endsection