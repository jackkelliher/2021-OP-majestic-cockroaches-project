@section('title', 'Register')
@include('inc.header')


<main class="signup-form">
    <script src="https://kit.fontawesome.com/b07d89ef49.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <div class="cotainer">
        <div>
            <div>
                <div class="card">

                    <div class="card-body">
                        <form action="{{ route('register.custom') }}" method="POST">
                            @csrf
                            <div>
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name" required autofocus>
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div>
                                <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" required autofocus>
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div>
                                <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>

                            <div>
                                <div class="checkbox">
                                    <label><input type="checkbox" name="remember"> Remember Me</label>
                                </div>
                            </div>

                            <div>
                                <button type="submit">Sign up</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
