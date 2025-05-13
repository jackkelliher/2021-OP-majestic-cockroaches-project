@extends('inc.layout')
@section('title', 'Lecturers')
@section('content')
<div class=flexContainer>
  @can('is_admin')
  <div class=item>
      <input type="text" id="mySearch" onkeyup="search(3)" placeholder="Search for class names, years or lecturers..">
  </div>
  <div class=item>
    <div id="bottom-table">
      <table id="tables">
        <tr>
          <th onclick="sortTable(0)">Name</th>
          <th onclick="sortTable(1)">Email</th>
          <th onclick="sortTable(2)">Username</th>
          <th>Delete</th>
        </tr>
        <tbody>
          @foreach ($lecturers as $l)
          <tr>
            <td><a href="{{route('lecturer.show', $l->id)}}"><p>{{ $l->name }}</p></a></td>
            <td><p>{{ $l->email }}</p></td>
            <td><p>{{ $l->username }}</p></td>
            <td>
              <div class="icons">
                <a class="edit" href="{{ route('lecturer.edit', $l->id) }}"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('lecturer.destroy', [$l->id]) }}">
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
  @else
  <h1>Unauthorized</h1>
  <h3>Please log in as an administrator to view this page</h3>
  @endcan
</div>
@endsection
