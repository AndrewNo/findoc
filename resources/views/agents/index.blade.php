@extends('base')

@section('content')
    <h3>Sellers</h3>
    <div class="active_accounts">
        <table class="account">
            @if(\App\Models\Agent::all()->count() != 0)
                <tr>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($agents as $agent)
                <tr>
                    <td>{{ $agent->title }}</td>
                    <td class="edit">
                        <button><a href="agent/{{ $agent->id }}"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i></a>
                        </button>
                    </td>
                    <td class="delete">
                        <form action="/agent/destroy/{{ $agent->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('delete') }}
                            <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection