@extends('inc.layout')
@section('title', 'Add Student')
@section('content')
<div class=flexContainer>
    <div class=item>

        <form action="{{route('student.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!--Return a message that student was created-->
            @if(session('success'))
            <h3 style="color:silver;">{{session('success')}}</h4>
                @endif
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="formInput" required>

                <label for="email">Email:</label>
                <input type="email" id="mail" name="email" class="formInput" required>

                <label for="Github">Github:</label>
                <input type="text" id="github" name="github" class="formInput">

                <!--Select a cohort to add the student to.-->

                <button type="submit">Create</button>
        </form>
    </div>
</div>
@endsection
