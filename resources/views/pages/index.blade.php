  @extends('inc.layout')
  @section('title', 'Welcome')
  @section('content')
  <?php

  use App\Cohort;
  use App\Evidence;
  use App\Lecturer;
  use App\Student;
  use App\Paper;
  use App\Note;

  $cohorts = Cohort::all();
  $students = Student::all();
  $notes = Note::all();
  $evidence = Evidence::all();
  $lecturers = Lecturer::all();
  $cohorts = Cohort::all();
  $papers = Paper::all();
  ?>
  <div class=flexContainer>
    <div class=item>
      <h2>We have {{$cohorts->count()}} Cohorts</h2>
      <h2>We have {{$students->count()}} Students</h2>
      <h2>We have {{$notes->count()}} Notes</h2>
      <h2>We have {{$evidence->count()}} Evidence</h2>
      <h2>We have {{$papers->count()}} Papers</h2>
      <h2>We have {{$lecturers->count()}} Lecturers</h2>


    </div>
  </div>


  @endsection
