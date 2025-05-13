@extends('inc.layout')
@section('title', $paper->name)
@section('content')

<div class=flexContainer>
    <div class=item>

        <h3>Name: {{ $paper->name }}</h3>
        <h3>Code: {{ $paper->code }}</h3>
        <h3>NCEA Level: {{ $paper->level }}</h3>
        <a href="{{ route('paper.edit', $paper->id) }}">Edit</a>
    </div>
</div>

@endsection