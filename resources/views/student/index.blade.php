@extends('inc.layout')
@section('title', 'Students')
@section('content')
<br>
<div class=flexContainer>
    <div class=item>
        <input type="text" id="mySearch" onkeyup="search(3)" placeholder="Search for names..">
    </div>
    <div class=item>
        <table id="tables">
            <tr>
                <th onclick="sortTable(0)">Name</th>
                <th onclick="sortTable(1)">Email</th>
                <th onclick="sortTable(2)">Github</th>
                <th>Edit/Delete</th>
            </tr>
            @foreach($student as $s)
            <tr>
                <td><a id="studentLink" href="{{route('student.show', $s->id)}}">{{$s->name}}</a></td>
                <td>{{$s->email}}</td>
                <td>{{$s->github}}</td>
                <td>
                    <div class="icons">
                        <a class="edit" href="{{ route('student.edit', $s->id) }}"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{ route('student.destroy', [$s->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete" id="{{$s->id}}"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection