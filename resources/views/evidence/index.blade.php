@extends('inc.layout')
@section('title', 'Evidence')
@section('content')

<div class=flexContainer>
    <div class=item>
        @if(!$evidence->isEmpty())
        <div class="file">

            <h1>All evidence Files:</h1>
            <table class="evidenceTable">
                <tr>
                    <th>File</th>
                    <th>File Type</th>
                    <th>User Type</th>
                    <th>User's Name</th>
                    <th>Uploaded</th>
                    <th>Delete</th>
                </tr>
                @foreach($evidence as $file)
                <?php
                $userID = $file->userId;
                if ($file->userType == "student") {
                    foreach ($students as $s) {
                        if ($s->id == $userID) {
                            $userName = $s->name;
                        }
                    }
                }
                if ($file->userType == "lecturer") {
                    foreach ($lecturer as $s) {
                        if ($s->id == $userID) {
                            $userName = $s->name;
                        }
                    }
                }

                ?>
                <tr>
                    @if($file->type!="url")
                    <td><a href="{{ URL::to('/') }}/{{$file->location}}">{{$file->name}}</a></td>
                    @else
                    <td><a href="{{$file->location}}">{{$file->name}}</a></td>
                    @endif
                    <td>{{$file->type}}</td>
                    <td>{{$file->userType}}</td>
                    @if($file->userType =="student")
                    <td><a id="studentLink" href="{{route('student.show', $userID)}}">{{$userName}}</a></td>
                    @endif
                    @if($file->userType =="lecturer")
                    <td><a id="lecturerLink" href="{{route('lecturer.show', $userID)}}">{{$userName}}</a></td>
                    @endif
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
        <h1>No files currently uploaded</h1>
        @endif


    </div>

    @endsection