@extends('inc.layout')
@section('title', 'Papers')
@section('content')

<div class=flexContainer>
    <div class=item>
        @if(count($papers)>0)
        <table id="tables">
            <thead>
                <th onclick="sortTable(0)">Name</th>
                <th onclick="sortTable(1)">Code</th>
                <th onclick="sortTable(2)">NCEA Level</th>
                <th>Edit/Delete</th>
                </tr>
                @foreach($papers as $p)
                <tr>
                    <td><a href="{{route('paper.show', $p->id)}}">{{$p->name}}</a></td>
                    <td>{{$p->code}}</td>
                    <td>{{$p->level}}</td>
                    <td>
                        <div class="icons">
                            <a class="edit" href="{{ route('paper.edit', $p->id) }}"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{ route('paper.destroy', [$p->id]) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete" id="{{$p->id}}"><i class="fas fa-trash-alt"></i></button>

                            </form>

                        </div>
                    </td>
                </tr>

                @endforeach
        </table>
        @else
        <h2>No papers have been created</h2>
        @endif

    </div>
</div>

@endsection