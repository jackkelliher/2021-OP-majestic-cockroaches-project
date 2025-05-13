@extends('inc.layout')
@section('title', 'Profile')
@section('content')
<div class=flexContainer>
    <div class=item>
        <h1>{{ $user->name }}</h1>
        <h3>Email: {{ $user->email }}</h3>
        <h3>Username: {{ $user->username }}</h3>
        
        <a class="styledLink" href="{{ route('user.edit', $user->id) }}">Edit</a>
    </div>
</div>


@endsection
