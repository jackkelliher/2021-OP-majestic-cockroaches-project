@extends('inc.layout')

@section('title', 'users')

@section('content')

<div class=flexContainer>
  <div class=item>

    <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
      @csrf

      <h1 class="title">Add user</h1>


      <label for="username">Userame:</label>
      <input type="text" id="username" name="username" class="formInput">

      <label for="password">Password:</label>
      <input type="text" id="password" name="password" class="formInput" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" class="formInput">

      <label for="name">Real Name:</label>
      <input type="text" id="name" name="name" class="formInput" required>

      <button type="submit" class="button1">Add user</button>

    </form>

    <div id="bottom-table">
      <table id="tables">
        <thead>
          <th onclick="sortTable(0)">Name</th>
          <th onclick="sortTable(1)">Email</th>
          <th onclick="sortTable(2)">Username</th>
          <th >Edit/Delete</th>
        </thead>
        <tbody>
          @foreach ($users as $l)
          <tr>
            <td><a href="{{route('user.show', $l->id)}}">{{ $l->name }}</a></td>
            <td>{{ $l->email }}</td>
            <td>{{ $l->username }}</td>
            <td>
              <div class="icons">
                <a class="edit" href="{{ route('user.edit', $l->id) }}"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('user.destroy', [$l->id]) }}">
                  @csrf
                  @method('DELETE')

                  <button type="submit" class="delete" id="{{$l->id}}"><i class="fas fa-trash-alt"></i></button>

                </form>

              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <br><br><br><br>
    </div>
  </div>
</div>
@endsection
