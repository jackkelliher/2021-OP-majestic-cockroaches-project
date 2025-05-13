@extends('inc.layout')
@section('title', 'Evidence')
@section('content')

<div class=flexContainer>
    <div class=item>
        <h2>{{$evidence->title}}</h2>
        <h2>{{$evidence->image}}</h2>
        <h2>{{$evidence->student_id}}</h2>
    </div>
</div>

@endsection