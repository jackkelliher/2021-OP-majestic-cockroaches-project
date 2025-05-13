<?php

use App\Cohort;
use Illuminate\Support\Facades\Auth;
use App\Lecturer;
use App\Paper;
use App\Student;

$user = Auth::user();
if ($user->type == 'admin') {
    $paper = Paper::all();
    $cohorts = Cohort::select('year')->distinct()->get();
}
if ($user->type == "lecturer") {
    $l = Lecturer::where('name', $user->name)->first();
    $cohorts = Cohort::where('lecturerId', $l->id)->select('year')->distinct()->get();
}
if ($user->type == "student") {
    $student = Student::where('username', $user->username)->first();
}

?>
@if($user->type =='admin')
<nav class="navbar">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-list">

                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link">Home</a>
                </li>
                <div class="dropdown">
                    <li class="nav-item">
                        Students<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('student.index')}}" class="nav-link">View All</a>
                        <a href="{{route('student.create')}}" class="nav-link">Add New</a>
                        @foreach($cohorts as $c)
                        <a href="{{route('enrolled', $c->year)}}" class="nav-link">{{$c->year}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="dropdown">
                    <li class="nav-item">
                        Courses<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('cohort.index')}}" class="nav-link">View All</a>
                        @can('is_admin')
                        <a href="{{route('cohort.create')}}" class="nav-link">Add New</a>
                        @endcan
                        @foreach($cohorts as $c)
                        <a href="{{route('year', $c->year)}}" class="nav-link">{{$c->year}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="dropdown">
                    <li class="nav-item">
                        Papers<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('paper.index')}}" class="nav-link">View All</a>
                        <a href="{{route('paper.create')}}" class="nav-link">Add New</a>
                        @foreach($paper as $p)
                        <a href="{{route('paper.show', $p->id)}}" class="nav-link">{{$p->name}}</a>
                        @endforeach
                    </div>
                </div>
                <div class="dropdown">
                    <li class="nav-item">
                        Evidence<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('evidence.index')}}" class="nav-link">View All</a>
                        <a href="{{route('evidence.create')}}" class="nav-link">Add New</a>
                    </div>
                </div>
                <div class="dropdown">
                    <li class="nav-item">
                        Notes<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('notes.index')}}" class="nav-link">View All</a>
                        <a href="{{route('notes.create')}}" class="nav-link">Add New</a>
                    </div>
                </div>
                @can('is_admin')
                <div class="dropdown" dusk="lecturer-button">
                    <li class="nav-item">
                        Lecturers<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('lecturer.index')}}" class="nav-link">View All</a>
                        <a href="{{route('lecturer.create')}}" class="nav-link">Add New</a>
                    </div>
                </div>
                @endcan
                <div class="dropdown">
                    <li class="nav-item">
                        Profile<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('profile')}}">{{$user->name}}</a>
                        <a href="{{route('logout')}}" class="nav-link">Logout</a>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
@elseif($user->type=='lecturer')
<nav class="navbar">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-list">

                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link">Home</a>
                </li>

                <div class="dropdown">
                    <li class="nav-item">
                        Cohorts<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>

                    <div class="dropdown-content">
                        <a href="{{route('cohort.index')}}" class="nav-link">View All</a>
                        @foreach($cohorts as $c)
                        <a href="{{route('year', $c->year)}}" class="nav-link">{{$c->year}}</a>
                        @endforeach
                    </div>
                </div>

                <div class="dropdown">
                    <li class="nav-item">
                        Evidence<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('evidence.index')}}" class="nav-link">View All</a>
                        <a href="{{route('evidence.create')}}" class="nav-link">Add New</a>
                    </div>
                </div>
                <div class="dropdown">
                    <li class="nav-item">
                        Notes<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('notes.index')}}" class="nav-link">View All</a>
                        <a href="{{route('notes.create')}}" class="nav-link">Add New</a>
                    </div>
                </div>


                <div class="dropdown">
                    <li class="nav-item">
                        Profile<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('lecturer.edit', $l->id)}}">Edit Profile</a>
                        <a href="{{route('logout')}}" class="nav-link">Logout</a>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
@elseif($user->type=='student')
<nav class="navbar">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-list">

                <li class="nav-item">
                    <a href="{{route('user.index')}}" class="nav-link">Home</a>
                </li>



                <div class="dropdown">
                    <li class="nav-item">
                        Evidence<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">

                        <a href="{{route('evidence.create')}}" class="nav-link">Add New</a>
                    </div>
                </div>
                <div class="dropdown">
                    <li class="nav-item">
                        Notes<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">

                        <a href="{{route('notes.create')}}" class="nav-link">Add New</a>
                    </div>
                </div>


                <div class="dropdown">
                    <li class="nav-item">
                        Profile<i class="fa fa-caret-down" style="display:contents"></i>
                    </li>
                    <div class="dropdown-content">
                        <a href="{{route('student.edit',$student->id)}}">Edit Profile</a>
                        <a href="{{route('logout')}}" class="nav-link">Logout</a>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
@endif