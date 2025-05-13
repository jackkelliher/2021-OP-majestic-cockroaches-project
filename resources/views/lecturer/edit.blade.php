@extends('inc.layout')
@section('title', 'Edit '.$lecturer->name)
@section('content')
<div class=flexContainer>
    @can('check_ownership', $lecturer)
    <div class=item>
        <form action="{{route('lecturer.update', $lecturer->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Name:</label>
            <input type="text" id="name" value="{{$lecturer->name}}" name="name" class="formInput" required>


            <label for="username">Userame:</label>
            <input type="text" id="username" value="{{$lecturer->username}}" name="username" class="formInput" required>


            <label for="email">Email:</label>
            <input type="email" id="email" value="{{$lecturer->email}}" name="email" class="formInput" required>


            <button type="submit">Save</button>
        </form>
    </div>
    @else
    <h1>Unauthorized</h1>
    <h3>Please log in as an administrator to view this page</h3>
    @endcan
</div>
@endsection
