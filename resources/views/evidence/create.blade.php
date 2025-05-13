@extends('inc.layout')
@section('title', 'Add Evidence')
@section('content')

<div class=flexContainer>
    <div class=item>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.
        <ul>
            @foreach ($errors->all() as $error)
            @if($error=="The 0 field is required.")
            <li>Either a file or url is required.</li>
            @else
            <li>{{ $error }}</li>
            @endif
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('evidence.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <!--Step1 -->
        <div class=item>
            <h2>Step 1.</h2>
            <h4>Select upload type</h4>
            <div class="switch-box">


                <div class="switch">

                    <label for="uploadType">URL</label><br>
                    <input type="radio" id="upload-url" name="uploadType" value="url">
                </div>
                <div class="switch">
                    <label for="uploadType">File Upload</label><br>
                    <input type="radio" id="upload-file" name="uploadType" value="file" checked>
                </div>
            </div>
            <div class="file">
                <h2>Step 2.</h2>
                <label for="file">Select file:</label>

                <input type="file" name="file" class="form-control">
                <br>
            </div>
            <div class="url" style="display:none">
                <h2>Step 2.</h2>
                <label for="url">Enter URL</label>
                <input type="url" name="url" class="form-control">
                <br>
            </div>
        </div>
        <!--Step2 -->
        <div class=item>
            <h2>Step 3.</h2>
            <label for="itemName">Alter upload name:</label>

            <input  type="text" name="itemName" class="form-control">
            <br>
        </div>
        <!--Step3 -->
        <div class=item>
            <h2>Step 4.</h2>
            <h4>Select user type</h4>
            <div class="switch-box">
                <div class="switch">
                    <label for="selectUser">Student</label><br>
                    <input type="radio" id="select-student" name="selectUser" value="student" checked>
                </div>
                <div class="switch">
                    <label for="selectUser">Lecturer</label><br>
                    <input type="radio" id="select-lecturer" name="selectUser" value="lecturer">
                </div>
            </div>
            <div class="student">
                <h2>Step 5.</h2>
                <label for="students">Select student:</label>
                <select name="student" id="student" class="form-control">
                    <option></option>
                    @foreach($students as $student)

                    <option value={{$student->id}}>{{$student->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="lecturer" style="display:none">
                <h2>Step 5.</h2>
                <label for="lecturers">Select lecturer:</label>
                <select name="lecturer" id="lecturer" class="form-control">
                    <option></option>
                    @foreach($lecturers as $lecturer)

                    <option value={{$lecturer->id}}>{{$lecturer->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!--Step4 -->
        <div class=item>

            <h2>Step 6.</h2>
            <button type="submit" class="btn btn-success">Upload</button>

        </div>

    </form>
</div>

<script>
    const urlBtn = document.querySelector('#upload-url');
    const fileBtn = document.querySelector('#upload-file');
    const fileDiv = document.querySelector('.file');
    const urlDiv = document.querySelector('.url');

    urlBtn.onclick = function() {
        fileDiv.style.display = "none";
        urlDiv.style.display = "block";
    }
    fileBtn.onclick = function() {
        fileDiv.style.display = "block";
        urlDiv.style.display = "none";
    }

    const studentBtn = document.querySelector('#select-student');
    const lecturerBtn = document.querySelector('#select-lecturer');
    const studentDiv = document.querySelector('.student');
    const lecturerDiv = document.querySelector('.lecturer');
    studentBtn.onclick = function() {
        lecturerDiv.style.display = "none";
        studentDiv.style.display = "block";
    }
    lecturerBtn.onclick = function() {
        lecturerDiv.style.display = "block";
        studentDiv.style.display = "none";
    }
</script>
@endsection