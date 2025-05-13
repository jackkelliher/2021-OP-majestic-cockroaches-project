@extends('inc.layout')
@section('title', 'Edit '.$paper->name)
@section('content')

<div class=flexContainer>
    <div class=item>

        <form action="{{route('paper.update', $paper->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Name:</label>
            <input type="text" value="{{$paper->name}}" id="name" name="name" class="formInput" required>

            <label for="code">Code:</label>
            <input type="code" value="{{$paper->code}}" id="mail" name="code" class="formInput">

            <label for="level">NCEA Level:</label>
            <input type="text" value="{{$paper->level}}" id="level" name="level" class="formInput" required>

            <!--Select a cohort to add the student to.-->

            <button type="submit">Save</button>
        </form>
    </div>
</div>

@endsection