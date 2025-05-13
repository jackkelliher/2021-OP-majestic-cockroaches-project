<?php

use App\Lecturer;

$assigned = Lecturer::find($cohort->lecturerId);
?>
@extends('inc.layout')
@section('title', 'Courses')
@section('content')

<div class=flexContainer>
    <div class=item>
        @if(isset($cohort->lecturerId))
        <?php
        $l = Lecturer::find($cohort->lecturerId);
        ?>
        @endif
        @can('check_ownership', $l)
        <h1>Edit Cohort</h1>

        <form action="{{route('cohort.update', $cohort->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="subject">Subject:</label><br>

            <select id="subject" name="subject" required>
                <option value="{{$cohort->subject}}" selected>{{$cohort->subject}} </option> <!-- Selected by default-->
                @foreach($papers as $p)
                <option value="{{$p->name}}">{{$p->name}} - {{$p->code}}</option>
                @endforeach
            </select>
            <label for="semester">Semester:</label><br>
            <select id="semester" name="semester" required>
                <option value="{{$cohort->semester}}" selected>{{$cohort->semester}}</option> <!-- Selected by default-->
                <option value="1">Semester 1</option>
                <option value="2">Semester 2</option>
                <option value="S">Summer School</option>
            </select>
            <label for="stream">Stream: </label><br>
            <input type="text" value="{{$cohort->stream}}" name="stream" id="stream" maxlength="2">
            <br>
            <label for="year">Year:</label><br>
            <input type="text" name="year" value="{{$cohort->year}}" id="year" maxlength="4" required>
            <br><br>
            <select id="lecturer" name="lecturer">
                @if(!(is_null($assigned)))
                <option value="{{$assigned->name}}" selected>{{$assigned->name}}</option> <!-- Selected by default-->
                @endif
                @foreach($lecturers as $s)
                <option value="{{$s->name}}">{{$s->name}}</option>
                @endforeach
            </select><br>
            <!-- Using a select input as there is only three options for a semester, the same may be the same for stream but the number of streams depends
                                    on the number of students-->
            <button type="submit">Save Cohort</button>
        </form>
        @else
        <h1>Unauthorized</h1>
        <h3>Please log in as an administrator to view this page</h3>
        @endcan
    </div>
</div>
@endsection
