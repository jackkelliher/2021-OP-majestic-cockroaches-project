@extends('inc.layout')
@section('title', $cohort->subject)
@section('content')

<div class=flexContainer>
    <div class=item>
        <div>
            <h2>Year: {{ $cohort->year }}</h2>
            <h2>Semester: {{ $cohort->semester }}</h2>
            <h2>Stream: {{ $cohort->stream }} </h2>
            @if($user->type =='admin')
            <h2>Lecturer:</h2>
            @if(isset($lecturer))
            <h3>Lecturer: <a href="{{route('lecturer.show', $lecturer->id)}}">{{ $lecturer->name }}</a></h3>
            <h3>Email: {{ $lecturer->email }}</h3>
            @else(!isset($lecturer))
            @can('is_admin')
            <form method="POST" action="{{ route('assign', $cohort->id ) }}">
                @csrf
                <select id="lecturer" name="lecturer" required>
                    <option value="N/A" selected>--Assign a Lecturer--</option> <!-- Selected by default-->
                    @foreach($lecturers as $s)
                    <option value="{{$s->name}}">{{$s->name}}</option>
                    @endforeach
                </select><br>
                <button type="submit">Assign</button>
            </form>
            @endcan
            @endif
            @endif
        </div>
    </div>
    <div class=item>
    @can('check_ownership', $lecturer)
        <h1>Currently Enrolled:</h1>
        @if(count($enrolled)>0)
        @if($user->type =='admin')
        <form method="POST" action="{{ route('status' , $cohort->id )}}" enctype="multipart/form-data">
            @csrf


            <table id="tables">
                <tr>
                    @can('check_ownership', $lecturer)
                    <th onclick="sortTable(0)">Select</th>
                    @endcan
                    <th onclick="sortTable(1)">Name</th>
                    <th onclick="sortTable(2)">Email</th>
                    <th onclick="sortTable(3)">Github</th>

                    <th>Status</th>
                </tr>


                @foreach($enrolled as $s)
                <tr>
                    @can('check_ownership', $lecturer)
                    <td><input type="checkbox" id="students" value="{{$s->enrolmentId}}" name="students[]"></td>
                    @endcan
                    <td><a id="studentLink" href="{{route('student.show', $s->studentId)}}">{{$s->name}}</td></a>
                    <td>{{$s->email}}</td>
                    <td>{{$s->github}}</td>
                    <td>{{$s->getStatusStr()}}</td>
                </tr>

                @endforeach

            </table>

            <button type="submit" name="setStatusBtn" value="fail" id="fail">Fail</button>
            <button type="submit" name="setStatusBtn" value="pass" id="pass">Pass</button>
            <button type="submit" name="setStatusBtn" value="unenroll" id="unenroll">Withdraw</button>
        </form>
        @elseif($user->type =='lecturer')
        <table cellspacing="0" id="tables">
            <tr>
                <th onclick="sortTable(0)">Name</th>
                <th onclick="sortTable(1)">Email</th>
                <th onclick="sortTable(2)">Github</th>

            </tr>
            @foreach($enrolled as $s)
            <tr>
                <td><a id="studentLink" href="{{route('student.show', $s->id)}}">{{$s->name}}</td></a>
                <td>{{$s->email}}</td>
                <td>{{$s->github}}</td>
            </tr>
            @endforeach
        </table>
        @endif
        @else
        <h2>No one is currently enrolled</h2>
        @endif
    </div>
    
    <div class=item>
        <h1>Students Avaliable To Enroll:</h1>
        @if(count($students)>0)
        <form method="POST" action="{{ route('enrolment.store' )}}" enctype="multipart/form-data">
            @csrf

            <table id="tables">
                <thead>
                    <th onclick="sortTable(0)">Select</th>
                    <th onclick="sortTable(1)">Name</th>
                    <th onclick="sortTable(2)">Email</th>
                    <th onclick="sortTable(3)">Github</th>

                    </tr>


                    @foreach($students as $s)
                    <tr>
                        <td><input type="checkbox" id="{{$s->id}}" value="{{$s}}" name="{{$s->id}}"></td>
                        <td><a id="studentLink" href="{{route('student.show', $s->id)}}">{{$s->name}}</td></a>
                        <td>{{$s->email}}</td>
                        <td>{{$s->github}}</td>
                    </tr>
                    @endforeach
            </table>
            <td><button type="submit" id="{{$cohort}}" value="{{$cohort}}" name="{{$cohort}}">Enroll</td>
        </form>
        @else
        <t2>No Students Avaliable</t2>
        @endif
    </div>
    @endcan
</div>
@endsection