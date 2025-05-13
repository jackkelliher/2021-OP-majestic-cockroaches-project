@extends('inc.layout')
@section('title', 'Notes')
@section('content')
<div class=flexContainer>
    <div class=item>
        <h2>{{$notes->student_name}}</h2>
        <h2>{{$notes->notes}}</h2>
        <h2>{{$notes->student_id}}</h2>
    </div>
</div>
@endsection
