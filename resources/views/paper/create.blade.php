@extends('inc.layout')

@section('title', 'Add Paper')

@section('content')

<div class=flexContainer>
    <div class=item>

        <form action="{{route('paper.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="formInput" required>
            <label for="level">NCEA Level:</label>
            <input type="text" id="level" name="level" class="formInput">
            <!--Select a cohort to add the student to.-->

            <button type="submit">Create</button>

        </form>
    </div>
</div>

@endsection