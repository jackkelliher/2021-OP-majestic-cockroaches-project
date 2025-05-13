@extends('inc.layout')
@section('title', 'Evidence')
@section('content')

<div class=flexContainer>
    <div class=item>
    <div class="file">
    </div>
    <h2>File you're replacing:</h2>
    <t3><a href="{{ URL::to('/') }}/{{$evidence->location}}">{{$evidence->name}}</a></h3>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2>Please upload your replacement file here</h2>
        </div>
        <div class="panel-body">
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
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('evidence.update', $evidence->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

@endsection