@extends('inc.layout')
@section('title', 'Notes')
@section('content')
<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();
?>
<div class=flexContainer>
    <div class=item>
        <form action="{{route('notes.store')}}" method="post">
            @csrf
            <label for="student">Student: </label>
            <select id="student" name="student" required>
                @if($user->type=="student")
                <option value='{{$user->name}}'> {{$user->name}} </option>
                @else
                <!--Select is used instead of datalist, but users cannot start typing to get a responce-->
                @forelse($student as $student)
                <option value={{$student->name}}>{{$student->name}}</option>
                @empty
                <option disabled value="No Students Available">No Students</option>
                @endforelse
                @endif
            </select>
            <hr />

            <h4>Notes:</h4>
            <textarea style="font-family: sans-serif;" rows="5" name="notes" required></textarea>
            <div class="btn-block">
                <button type="submit" name="addNotes" value="Add">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
