@extends('inc.layout')
@section('title', 'Courses')
@section('content')

<div class=flexContainer>
    <div class=item>
        <h1>Add Course</h1>

        <form action="{{route('cohort.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="subject">Paper:</label><br>

            <select id="subject" name="subject" required>
                @foreach($papers as $p)
                <option value="{{$p->name}}">{{$p->name}} - {{$p->code}}</option>
                @endforeach
            </select>
            <label for="semester">Semester:</label><br>
            <select id="semester" name="semester" required>
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="S">Summer School</option>
            </select>
            <label for="stream">Stream: </label><br>
            <input type="text" name="stream" id="stream" maxlength="2">
            <br>
            <label for="year">Year:</label><br>
            <input type="text" name="year" id="year" maxlength="4" required>
            <br><br>
            <select id="lecturer" name="lecturer">
                @foreach($lecturers as $s)
                <option value="{{$s->name}}">{{$s->name}}</option>
                @endforeach
            </select><br>
            <!-- Using a select input as there is only three options for a semester, the same may be the same for stream but the number of streams depends
                                    on the number of students-->
            <button type="submit">Create Cohort</button>
        </form>
    </div>
</div>
@endsection
