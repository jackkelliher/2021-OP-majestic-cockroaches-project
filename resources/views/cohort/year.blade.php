<?php

use App\Lecturer; ?>
@extends('inc.layout')
@section('title', $year)
@section('content')

<div class=flexContainer>
    <div>
        @if(count($summer)>0)
        <div id="summer">
            <h2>Summer School</h2>
            <table id="tables">
                <tr>
                    <th onclick="sortTable(0)">Subject</th>
                    <th onclick="sortTable(1)">Stream</th>
                    <th onclick="sortTable(2)">Lecturer</th>
                    <th>Edit/Delete</th>
                </tr>

                @foreach ($summer as $cohort)
                <tr>
                    <td><a href="{{route('cohort.show', $cohort->id)}}">{{ $cohort->subject }}</a></td>

                    <td>{{ $cohort->stream }}</td>
                    @if(isset($cohort->lecturerId))
                    <?php
                    $l = Lecturer::find($cohort->lecturerId);

                    ?>
                    @endif
                    @if(isset($l->id))
                    <td>
                        @can('check_ownership', $user)
                        <a href="{{route('lecturer.show', $l->id)}} /">
                            @endcan
                            {{$l->name}}
                    </td>

                    @else(!isset($cohort->lecturerId))
                    <form method="POST" action="{{ route('assign', $cohort->id ) }}">
                        @csrf
                        <td> <select id="lecturer" name="lecturer" required>
                                <option value="N/A" selected>--Assign a Lecturer--</option> <!-- Selected by default-->
                                @foreach($lecturers as $s)
                                <option value="{{$s->name}}">{{$s->name}}</option>
                                @endforeach
                            </select><br>
                            <button type="submit">Assign</button>
                        </td>
                    </form>

                    @endif
                    <td>
                        @can('check_ownership', $user)
                        <div class="icons">
                            <a class="edit" href="{{ route('cohort.edit', $cohort->id) }}"><i class="fas fa-edit"></i></a>

                            <form method="POST" action="{{ route('cohort.destroy', [$cohort->id]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete" id="{{$cohort->id}}"><i class="fas fa-trash-alt"></i></button>

                            </form>

                        </div>
                        @endcan
                    </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>
    @endif
    <div>
        <div id="first">
            @if(count($first)>0)
            <h2>First Semester</h2>
            <table id="tables">
                <tr>
                    <th onclick="sortTable(0)">Subject</th>
                    <th onclick="sortTable(1)">Stream</th>
                    <th onclick="sortTable(2)">Lecturer</th>
                    <th>Edit/Delete</th>
                </tr>

                @foreach ($first as $cohort)
                <tr>
                    <td><a href="{{route('cohort.show', $cohort->id)}}">{{ $cohort->subject }}</a></td>

                    <td>{{ $cohort->stream }}</td>
                    @if(isset($cohort->lecturerId))
                    <?php
                    $l = Lecturer::find($cohort->lecturerId);

                    ?>
                    @endif
                    @if(isset($l->id))
                    <td>
                        @can('check_ownership', $user)
                        <a href="{{route('lecturer.show', $l->id)}} /">
                            @endcan
                            {{$l->name}}
                    </td>

                    @else(!isset($cohort->lecturerId))
                    <form method="POST" action="{{ route('assign', $cohort->id ) }}">
                        @csrf
                        <td> <select id="lecturer" name="lecturer" required>
                                <option value="N/A" selected>--Assign a Lecturer--</option> <!-- Selected by default-->
                                @foreach($lecturers as $s)
                                <option value="{{$s->name}}">{{$s->name}}</option>
                                @endforeach
                            </select><br>
                            <button type="submit">Assign</button>
                        </td>
                    </form>

                    @endif
                    <td>
                        @can('check_ownership', $user)
                        <div class="icons">
                            <a class="edit" href="{{ route('cohort.edit', $cohort->id) }}"><i class="fas fa-edit"></i></a>

                            <form method="POST" action="{{ route('cohort.destroy', [$cohort->id]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete" id="{{$cohort->id}}"><i class="fas fa-trash-alt"></i></button>

                            </form>

                        </div>
                        @endcan
                    </td>
                </tr>
                @endforeach



            </table>
        </div>
    </div>
    @endif
    <div>
        <div id="second">
            @if(count($second)>0)
            <h2>Second Semester</h2>
            <table id="tables">
                <tr>
                    <th onclick="sortTable(0)">Subject</th>
                    <th onclick="sortTable(1)">Stream</th>
                    <th onclick="sortTable(2)">Lecturer</th>
                    <th>Edit/Delete</th>
                </tr>

                @foreach ($second as $cohort)
                <tr>
                    <td><a href="{{route('cohort.show', $cohort->id)}}">{{ $cohort->subject }}</a></td>

                    <td>{{ $cohort->stream }}</td>
                    @if(isset($cohort->lecturerId))
                    <?php
                    $l = Lecturer::find($cohort->lecturerId);

                    ?>
                    @endif
                    @if(isset($l->id))
                    <td>
                        @can('check_ownership', $user)
                        <a href="{{route('lecturer.show', $l->id)}} /">
                            @endcan
                            {{$l->name}}
                    </td>

                    @else(!isset($cohort->lecturerId))
                    <form method="POST" action="{{ route('assign', $cohort->id ) }}">
                        @csrf
                        <td> <select id="lecturer" name="lecturer" required>
                                <option value="N/A" selected>--Assign a Lecturer--</option> <!-- Selected by default-->
                                @foreach($lecturers as $s)
                                <option value="{{$s->name}}">{{$s->name}}</option>
                                @endforeach
                            </select><br>
                            <button type="submit">Assign</button>
                        </td>
                    </form>

                    @endif
                    <td>
                        @can('check_ownership', $user)
                        <div class="icons">
                            <a class="edit" href="{{ route('cohort.edit', $cohort->id) }}"><i class="fas fa-edit"></i></a>

                            <form method="POST" action="{{ route('cohort.destroy', [$cohort->id]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete" id="{{$cohort->id}}"><i class="fas fa-trash-alt"></i></button>

                            </form>

                        </div>
                        @endcan
                    </td>
                </tr>
                @endforeach

            </table>
        </div>
    </div>
    @endif
</div>


@endsection