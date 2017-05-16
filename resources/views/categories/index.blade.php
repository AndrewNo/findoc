@extends('base')

@section('links')
@endsection

@section('content')
    <h3>Categories</h3>
    <div class="active_accounts">
        <h3>Income categories:</h3>
        <table class="account">
            @if(\App\Models\Category::where('type', '=', 'income')->count() != 0)
                <tr>
                    <th>Pic</th>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($categories as $category)
                @if($category->type == 'income')
                    <tr>
                        <td><img src="{{ asset($category->pic) }}" alt=""></td>
                        <td>{{ $category->title }}</td>
                        <td class="edit">
                            <button><a href="category/{{ $category->id }}"><i class="fa fa-pencil"
                                                                              aria-hidden="true"></i></a>
                            </button>
                        </td>
                        <td class="delete">
                            <form action="/category/destroy/{{ $category->id }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>

    <div class="inactive_accounts">
        <h3>Outcome categories:</h3>
        <table class="account">
            @if(\App\Models\Category::where('type', '=', 'outcome')->count() != 0)
                <tr>
                    <th>Pic</th>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            @endif
            @foreach($categories as $category)
                @if($category->type == 'outcome')
                    <tr>
                        <td><img src="{{ asset($category->pic) }}" alt=""></td>
                        <td>{{ $category->title }}</td>
                        <td class="edit">
                            <button><a href="category/{{ $category->id }}"><i class="fa fa-pencil"
                                                                              aria-hidden="true"></i></a>
                            </button>
                        </td>
                        <td class="delete">
                            <form action="/category/destroy/{{ $category->id }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <button type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </table>
    </div>
@endsection