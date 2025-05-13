@extends('inc.layout')
@section('title', 'Edit '.$student->name)
@section('content')
<div class=flexContainer>
    <div class=item>

        <form action="{{route('student.update', $student->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" value="{{$student->name}}" id="name" name="name" class="formInput" required>

            <label for="email">Email:</label>
            <input type="email" value="{{$student->email}}" id="mail" name="email" class="formInput">

            <label for="Github">Github:</label>
            <input type="text" value="{{$student->github}}" id="github" name="github" class="formInput" required>

            <!--Select a cohort to add the student to.-->

            <button type="submit">Save</button>
        </form>
    </div>
</div>
@endsection