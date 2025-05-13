<?php

use App\Lecturer; ?>
@extends('inc.layout')
@section('title', 'Courses')
@section('content')

<div class=flexContainer>
    <div class=item>
        <input type="text" id="mySearch" onkeyup="search(5)" placeholder="Search for class names, years or lecturers..">
    </div>
    <div class=item>

        <div id="bottom-table">
            <table id="tables">
                <tr>
                    <th onclick="sortTable(0)">Paper</th>
                    <th onclick="sortTable(1)">Year</th>
                    <th onclick="sortTable(2)">Semester</th>
                    <th onclick="sortTable(3)">Stream</th>
                    <th onclick="sortTable(4)">Lecturer</th>
                    @can('is_admin')
                    <th>Edit/Delete</th>
                    @endcan
                </tr>
                @foreach ($cohorts as $cohort)
                <tr>
                    <td>
                        <a href="{{route('cohort.show', $cohort->id)}}">
                            {{ $cohort->subject }}</a>
                    </td>
                    <td>{{ $cohort->year }}</td>
                    <td>{{ $cohort->semester }}</td>
                    <td>{{ $cohort->stream }}</td>
                    @if(isset($cohort->lecturerId))
                    <?php
                    $l = Lecturer::find($cohort->lecturerId);

                    ?>
                    @endif
                    @if(isset($l->id))
                    <td>
                        @can('check_ownership', $l)
                        <a href="{{route('lecturer.show', $l->id)}}">
                            @endcan
                            {{$l->name}}
                    </td>

                    @else(!isset($cohort->lecturerId))

                    <form method="POST" action="{{ route('assign', $cohort->id ) }}">
                        @csrf
                        <td> @can('is_admin')
                            <select id="lecturer" name="lecturer" required>

                                <option value="N/A" selected>--Assign a Lecturer--</option> <!-- Selected by default-->
                                @foreach($lecturers as $s)
                                <option value="{{$s->name}}">{{$s->name}}</option>
                                @endforeach
                            </select><br>
                            <button type="submit">Assign</button>
                            @endcan
                        </td>
                    </form>

                    @endif
                    @can('is_admin')
                    <td>

                        <div class="icons">
                            <a class="edit" href="{{ route('cohort.edit', $cohort->id) }}"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('cohort.destroy', [$cohort->id]) }}">
                                @csrf
                                @method('DELETE')
        
                                <button type="submit" value="{{$cohort->id}}" class="delete" id="{{$cohort->id}}"><i class="fas fa-trash-alt"></i></button>
                                </form>
                        </div>

                    </td>
                    @endcan
                </tr>
                @endforeach
                
            </table>
        </div>
    </div>
</div>
@endsection