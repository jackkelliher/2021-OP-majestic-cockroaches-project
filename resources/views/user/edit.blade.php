@extends('inc.layout')
@section('title', 'Edit '.$user->name)
@section('content')
<div class=flexContainer>
    @can('check_ownership', $user)
    <div class=item>
        <form action="{{route('user.update', $user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <label for="name">Name:</label>
            <input type="text" id="name" value="{{$user->name}}" name="name" class="formInput" required>


            <label for="username">Userame:</label>
            <input type="text" id="username" value="{{$user->username}}" name="username" class="formInput" required>


            <label for="email">Email:</label>
            <input type="email" id="email" value="{{$user->email}}" name="email" class="formInput" required>


            <button type="submit">Save</button>
        </form>
    </div>
    @else
    <h1>Unauthorized</h1>
    <h3>Please log in as an administrator to view this page</h3>
    @endcan
</div>
@endsection
