@section('title', 'Login')
@include('inc.header')

<main class="login-form">
<script src="https://kit.fontawesome.com/b07d89ef49.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">    
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <div class="cotainer">
        <div>
            <div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{route('login')}}">
                            @csrf
                            <!--Return a message if login was unsuccessful-->
                            @if(session('success'))
                             <h4>{{session('success')}}</h4>
                            @endif
                            <!--Username field-->
                            <div >
                                <input type="text" placeholder="Username" id="username" class="form-control" name="username" required autofocus>
                            </div>
                            <!--Password field-->
                            <div >
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                            </div>
                            <!--Sign in Button-->
                            <div>
                                <button type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
