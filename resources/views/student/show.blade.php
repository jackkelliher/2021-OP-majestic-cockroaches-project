@extends('inc.layout')
@section('title', $student->name)
@section('content')
<div class=flexContainer>
    <div class=item>



        <h1> <a href="{{route('student.edit', $student->id)}}"><i class="fas fa-user-edit"></i></a></h1>

        <h3>Email: {{ $student->email }}</h3>
        <h3>Github: {{ $student->github }}</h3>

        @if(isset($enrolment))
        <table id="tables"style="border-style: none; margin-left: 12%;">
        <thead>
                <th onclick="sortTable(0)">Paper</th>
                <th onclick="sortTable(1)">Year</th>
                <th onclick="sortTable(2)">Semester</th>
                <th onclick="sortTable(3)">Stream</th>
                <th onclick="sortTable(4)">Status</th>
                <th style="border-style: none; visibility: collapse"></th>
                <thead>
            @foreach($enrolment as $e)
            <tr>
                <td><a href="{{route('cohort.show', $e->cohortId)}}">{{ $e->subject }}</a></td>
                <td>{{$e->year}}</td>
                <td>{{$e->semester}}</td>
                <td>{{$e->stream}}</td>
                <td>{{$e->status}}</td>
                <form method="POST" action="{{ route('enrolment.destroy', $e->enrolmentId) }}">
                    @csrf
                    @method('DELETE')
                    @if($e->status=="Enrolled")
                    <td style="border-style: none"><button type="submit" id="{{$e->id}}">Unenroll</button></td>
                    @endif

                </form>
            </tr>
            @endforeach
        </table>
        @else
        <h2>{{$student->name}} has not enrolled in any papers</h2>
        @endif
        <br>
        <h1>Files</h1>
        @if(isset($evidence)&& $evidence->count()>0)

        <div class="studentsFile">
            <h2>All Uploaded Files:</h2>


            <table id="tables">
                <thead>
                    <th onclick="sortTable(0)">File</th>
                    <th>Edit</th>
                </thead>

                </tr>
                @foreach($enrolment as $e)
                <tr>
                    <td><a href="{{route('cohort.show', $e->cohortId)}}">{{ $e->subject }}</a></td>
                    <td>{{$e->year}}</td>
                    <td>{{$e->semester}}</td>
                    <td>{{$e->stream}}</td>

                    <form method="POST" action="{{ route('enrolment.destroy', $e->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <td><button type="submit" id="{{$e->id}}">Unenroll</td>
                    </form>
                </tr>
                @endforeach
            </table>
            @else
            <h2>{{$student->name}} has not enrolled in any papers</h2>
            @endif
            <br>
            <h1>Files</h1>
            @if(isset($evidence)&& $evidence->count()>0)

            <div class="studentsFile">
                <h2>All Uploaded Files:</h2>
                <table class="StudentFileTable">
                    <tr>
                        <th>File</th>
                        <th>File Type</th>
                        <th>Uploaded</th>
                        <th>Delete</th>
                    </tr>

                    @foreach($evidence as $file)
                    <tr>
                        @if($file->type!="url")
                        <td><a href="{{ URL::to('/') }}/{{$file->location}}">{{$file->name}}</a></td>
                        @else
                        <td><a href="{{$file->location}}">{{$file->name}}</a></td>
                        @endif
                        <td>{{$file->type}}</td>
                        <td>{{$file->updated_at}}</td>
                        <form class="alterButtons" action="{{route('evidence.destroy', $file->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <td><button type="submit"><i class="fas fa-trash-alt"></i></button></td>
                        </form>
                    </tr>

                    @endforeach
                </table>
            </div>
            @else

            <h3>{{$student->name}} has not uploaded any files</h3>
            @endif


            <h1>Notes</h1>
            @if(isset($notes)&& $notes->count()>0)
            @foreach($notes as $note)
            <h3>{{$note->notes}}
                <h3>
                    @endforeach
                    @else
                    <h3>{{$student->name}} has no notes</h3>
                    @endif
        </div>


    </div>
    @endsection