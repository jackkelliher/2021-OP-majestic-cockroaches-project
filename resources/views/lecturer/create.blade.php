@extends('inc.layout')
@section('title', 'Add Lecturer')
@section('content')
<div class=flexContainer>
    @can('is_admin')
    <div class=item>
        <form action="{{route('lecturer.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="username">Userame:</label>
            <input type="text" id="username" name="username" class="formInput" required>

            <label for="password">Password:</label>
            <input type="text" id="password" name="password" class="formInput" required>

            <label for="mail">Email:</label>
            <input type="email" id="email" name="email" class="formInput" required>

            <label for="Github">Real Name:</label>
            <input type="text" id="name" name="name" class="formInput" required>


            <button type="submit">+</button>
        </form>
    </div>
    @else
    <h1>Unauthorized</h1>
    <h3>Please log in as an administrator to view this page</h3>
    @endcan
</div>
@endsection
