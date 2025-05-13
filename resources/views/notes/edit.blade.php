@extends('inc.layout')
@section('title', 'Notes')
@section('content')
<div class=flexContainer>
    <div class=item>
        <form action="{{route('notes.update', $student->id)}}" method="post">
            @csrf
            @method('PUT')
            <h1>Notes</h1>

            <label for="student">Student: </label>
            <select id="student" name="student" required>
                <!--Select is used instead of datalist, but users cannot start typing to get a responce-->
                @forelse($student as $student)
                <option value={{$student->name}}>{{$student->name}}</option>
                @empty
                <option disabled value="No Students Available">No Students</option>
                @endforelse
            </select>

            <h4>Notes:</h4>
            <textarea style="font-family: sans-serif;" rows="5" name="notes" required></textarea>
            <div class="btn-block">
                <button type="submit" name="addNotes" value="Add">Submit Note</button>
            </div>
        </form>
    </div>
</div>
@endsection 
