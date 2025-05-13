@extends('inc.layout')
@section('title', 'View Enrollment')
@section('content')

<div class='enrolmentView'>
  <br>
  <form action="{{route('enrolment.index')}}" method="HEAD">
    @method('HEAD')
    @csrf
    <button type="submit"> Back</button>
  </form>

<br>
<br>
<table id="tables">
<thead>
    <th scope="col">Name</th>
    <th scope="col">Subject</th>
    <th scope="col">Year</th>
    <th scope="col">Semester</th>
    <th scope="col">Stream</th>
    <th scope="col">Student ID</th>
    <th scope="col">email</th>
    <th scope="col">Github</th>
    <thead>

    <tr>
      <td scope="row">{{$enrolment->name}}</td>
      <td>{{$enrolment->subject}}</td>
      <td>{{$enrolment->year}}</td>
      <td>{{$enrolment->semester}}</td>
      <td>{{$enrolment->stream}}</td>
      <td>{{$enrolment->studentId}}</td>
      <td>{{$enrolment->email}}</td>
      <td>{{$enrolment->studentGithubUsername}}</td>
      <td></td>
    </tr>

  </table>
</div>
@endsection